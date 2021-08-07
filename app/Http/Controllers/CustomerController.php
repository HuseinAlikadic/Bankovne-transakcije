<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Rate;
use App\Models\Account;
use Illuminate\Support\Facades\DB;
use App\Models\FinancialInstitution;
use App\Models\Credit;
use App\Models\PostingKnjizenje;
use Carbon\carbon;
use App\Services\PayUService\Exception;
use Illuminate\Support\Facades\Log;

class CustomerController extends Controller
{
    public function prikazivanje_korisnika()
    {
      $korisnici= Customer::leftJoin('rates','rates.id','=','customers.rating_id')
      ->get(); 
      $rejtingKupca= Rate::get();
      
        return view('customer/kreiranje_korisnika',['korisnici'=>$korisnici,'rejtingKupca'=>$rejtingKupca]);
    }

  
    public function kreiranje_novog_korisnika(Request $request)
    {
      $validacija=request()->validate([
        'first_name'=>'required',
        'last_name'=>'required',
        'date_of_birth'=>'required',
        'address'=>'required',
      ]);
      
  
    $noviKorisnik= new Customer;
    $noviKorisnik->first_name=$request->first_name;
    $noviKorisnik->last_name=$request->last_name;
    $noviKorisnik->date_of_birth=$request->date_of_birth;
    $noviKorisnik->address=$request->address;  
    // $noviKorisnik->rating_id=2;  
    $noviKorisnik->save();
    // dd($request);
      return redirect('korisnici');
    }

    public function ispis_svih_korisnika()
    {
      $sortirani_korisnici=Customer::select('first_name','last_name','address')
      ->orderBy('last_name')      
      ->get(); 

      
      return view('ispis_korisnika/ispis_korisnika',['sortirani_korisnici'=>$sortirani_korisnici]);
    }

    public function otvaranje_novog_racuna()
    {   
      $mojArray['zaKorisnika']=Customer::select(DB::raw('CONCAT(first_name," ",last_name) as imeIprezime '),'id')
      ->get();
      $mojArray['finansiskeInstitucije']=FinancialInstitution::get();
 
      return view('customer/novi_racun')->with($mojArray);
    }

    public function kreiranje_novog_racuna(Request $request)
    {
      $noviRacunZaPostojecegKorisnika = new Account;
      $noviRacunZaPostojecegKorisnika->custumer_id=$request->custumer_i;
      $noviRacunZaPostojecegKorisnika->broj_racuna=$request->broj_racuna;
      $noviRacunZaPostojecegKorisnika->bilans_racuna=$request->bilans_racuna;
      $noviRacunZaPostojecegKorisnika->financial_institution_id=$request->financial_institution_id;
      $noviRacunZaPostojecegKorisnika->save();
           
      return redirect('novi-racun')->with('noviRacun','Uspješno kreiran novi račun.');
    }

    public function kreiranje_novog_kredita()
    {
      $noviKreditiZaPostojeceKorisnike['kreditPoKorisniku']=Credit::get();
      $noviKreditiZaPostojeceKorisnike['korisniciKredita']=Customer::select(DB::raw('CONCAT(first_name," ",last_name) AS imeIprezime'),'id')
      ->get();
      
      return view('customer/novi_kredit')->with($noviKreditiZaPostojeceKorisnike);
    }

    public function spasavanje_u_bazu_novog_racuna(Request $request)
    {

      $noviKreditZaPostojeceKorisnike= new Credit;

      $noviKreditZaPostojeceKorisnike->custumer_id=$request->custumer_id;
      $noviKreditZaPostojeceKorisnike->original_term=$request->original_term;
      $noviKreditZaPostojeceKorisnike->remaining_term=$request->remaining_term;
      $noviKreditZaPostojeceKorisnike->credit_amount=$request->credit_amount;
      $noviKreditZaPostojeceKorisnike->curent_credit_amount=$request->curent_credit_amount;
      $noviKreditZaPostojeceKorisnike->save();

      // Prilikom uplate potrebno je smanjivati vrijednost kolone curent_credit_amount   kada dođem do zadatka

      return redirect('kreiran-novi-kredit')->with('kreiran','Uspiješno dodan kredit');
    }

    public function ispis_racuna_po_korisniku()
    {
      $myArray['sviRacuniOdKorisnika']=Account::leftJoin('customers','accounts.custumer_id','=','customers.id')
      ->select(DB::raw('CONCAT(customers.first_name," ",customers.last_name) AS imeIprezime'),
      'accounts.broj_racuna','accounts.bilans_racuna','accounts.custumer_id')
      ->orderBy('imeIprezime')
      ->get();
     

      //prikaz sume vrijednosti bilanse korisnika 
      // $myArray['sviRacuniOdKorisnika']=Account::leftJoin('customers','accounts.custumer_id','=','customers.id')
      // ->selectRaw( 'CONCAT(customers.first_name," ",customers.last_name) AS imeIprezime ,
      //          sum(accounts.bilans_racuna) AS bb ,
      // accounts.broj_racuna,accounts.bilans_racuna,accounts.custumer_id')
      // ->orderBy('imeIprezime','ASC')
      // ->groupBy('imeIprezime')
      // ->get();
      return view('ispis_korisnika/ispis_racuna_po_korisniku')->with($myArray);
    }

    public function ispis_kredita_po_korisniku()
    {
      $myArray['kreditiKorisnika']=Credit::leftJoin('customers','customers.id','=','credits.custumer_id')
      ->select(DB::raw('CONCAT(customers.first_name," ",customers.last_name)AS imePrezime'),             
      'credits.original_term','credits.remaining_term','credits.credit_amount','credits.curent_credit_amount')
      ->orderBy('imePrezime')
      ->get();

      $myArray['sumaPoKorisniku']=Credit::leftJoin('customers','customers.id','=','credits.custumer_id')
      ->select(DB::raw('CONCAT(customers.first_name," ",customers.last_name)AS imePrezime'), 
               DB::raw('sum(credits.curent_credit_amount)AS sumaKredita'),   
      'credits.original_term','credits.remaining_term','credits.credit_amount','credits.curent_credit_amount','credits.custumer_id')
      ->orderBy('imePrezime')
      ->groupBy('credits.custumer_id')
      // ->where('credits.custumer_id')
      ->get();
      
      
      return view('ispis_korisnika/ispis_kredita')->with($myArray);
    }

    public function pojedinacne_transakcije_korisnika()
    {
    $myArray['korisnici']=Account::all();

      return view('customer/transakcije_korisnika_vjezba')->with($myArray);
    }

    public function transakcije_korisnika_pojedinacne(Request $request)
    {
      DB::beginTransaction();
    try {
        $id_from_account=$request->get('id_from_account');
        $id_to_account=$request->get('id_to_account');
        $iznos_transakcije=$request->get('money_value'); 
     //knjiženje promjena sa računa na račun(account)
     $account_from_financial_institution_id=Account::where('id',$id_from_account)->value('financial_institution_id');


        $novaTransakcija= new PostingKnjizenje;
        $novaTransakcija->money_value=$iznos_transakcije;
        $novaTransakcija->id_from_account=$id_from_account;
        $novaTransakcija->id_to_account=$id_to_account;
        $novaTransakcija->financial_institutions_id=$account_from_financial_institution_id;
        $novaTransakcija->booking_date=Carbon::now()->format('Y-m-d');
        $novaTransakcija->save(); 
        
        //smanjujem vrijednost bilansa accountu from
        $account_from_biance_orginalni=Account::where('id',$id_from_account)->value('bilans_racuna');
        
        $bilansRacunaAccountaFrom=$account_from_biance_orginalni-$iznos_transakcije;
        $updateAccountFrom=Account::find($id_from_account);
        $updateAccountFrom->bilans_racuna=$bilansRacunaAccountaFrom;
        $updateAccountFrom->save();

        //povećanje vrijednost bilansa accountu to
        $account_to_bilance=Account::where('id',$id_to_account)->value('bilans_racuna'); 
        // dd($updateAccountFrom);

        $bilansAccountTo=$account_to_bilance+$iznos_transakcije;
        $updateAccountTo=Account::find($id_to_account);
        $updateAccountTo->bilans_racuna=$bilansAccountTo;
        $updateAccountTo->save();
        
        DB::commit();
   
      return redirect('/transakcija-kredita');
     } 
    catch (\Exception $e) {
      DB::rollback();
      Log::info( $e->getMessage());

      return redirect('/transakcija-kredita')->with('upozorenje','There was an error');
    }
    }
    
}