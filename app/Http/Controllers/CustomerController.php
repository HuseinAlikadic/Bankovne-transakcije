<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Rate;
use App\Models\Account;
use Illuminate\Support\Facades\DB;
use App\Models\FinancialInstitution;
use App\Models\Credit;

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
      $noviRacunZaPostojecegKorisnika->custumer_id=$request->custumer_id;
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
dd($request);

      return redirect('kreiran-novi-kredit');
    }
}