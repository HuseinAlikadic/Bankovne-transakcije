<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PostingKnjizenje;
use App\Models\Account;
use Carbon\carbon;
use App\Services\PayUService\Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TransactionController extends Controller
{
    public function transakcije_izmedzu_korisnika()
    {
        $akaunti=Account::get();

        
        return view ('transakcije/transakcije_korisnici',['akaunti'=>$akaunti]);
    }
    public function pojedinacne_transakcije_izmedzu_racuna( Request $request)
    {
        DB::beginTransaction();
        try{
        // 1.provjeriti u taceli accounts da li accout_from ima dovoljno novca
        $acountFrom=$request->get('id_from_account');
        $acountTo=$request->get('id_to_account');
        $iznos_transakcije=$request->get('money_value');
        // dd($iznos_transakcije);
        // acount from podaci
        $accountFromBilance=Account::where('id','=',$acountFrom)->value('bilans_racuna');
        $finansiskaInstitucijaTransakcija=Account::where('id','=',$acountFrom)->value('financial_institution_id');
       
        // acount to podaci
        $accountToBilance=Account::where('id','=',$acountTo)->value('bilans_racuna');
        $finansijskeInstitucijeTransakcijeTo=Account::where('id','=',$acountTo)->value('financial_institution_id');

       if($iznos_transakcije>$accountFromBilance){
        //    poslati poruku korisniku nema dovoljno para
        return redirect('/transakcije-korisnika')->with('upozorenje','Nema dovoljno novca na računu pošiljaoca!!!');
       }
       if($acountFrom==$acountTo){

        return redirect('/transakcije-korisnika')->with('racuni','Ne možete poslati novac, brojevi računa se poklapaju !!!');
       }
       else{
           $novoKnjizenje= new PostingKnjizenje();
           $novoKnjizenje->money_value=$iznos_transakcije;
           $novoKnjizenje->id_from_account=$acountFrom;
           $novoKnjizenje->id_to_account=$acountTo;
           $novoKnjizenje->financial_institutions_id=$finansiskaInstitucijaTransakcija;
           $novoKnjizenje->booking_date=Carbon::now()->format('Y-m-d');
           $novoKnjizenje->save();

            // promjena vrijednosti na računu sa kojeg šaljemo
           $trenutniBalansAcountaFrom=$accountFromBilance-$iznos_transakcije;
           $updateAcountaFrom=Account::find($acountFrom);
           $updateAcountaFrom->bilans_racuna=$trenutniBalansAcountaFrom;
           $updateAcountaFrom->save();

            // promjena na računu koji prima novćana sredstva
           $trenutniIznosBilansaAccountaTo=$accountToBilance+$iznos_transakcije;
           $updateAccountTo=Account::find($acountTo);
           $updateAccountTo->bilans_racuna=$trenutniIznosBilansaAccountaTo;
           $updateAccountTo->save();
           
       }
        DB::commit();
        return redirect('/transakcije-korisnika');

    }catch (\Exception $e) {
        DB::rollback();
       Log::info( $e->getMessage());
        return redirect('/transakcije-korisnika')->with(['upozorenje','Neka poruka za korisnika da nisu podaci OK']);
    }

    }
}