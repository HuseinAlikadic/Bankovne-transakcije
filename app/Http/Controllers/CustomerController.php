<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Rate;
use App\Models\Account;

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
      $kreiranjeNovogRacuna=Account::get();
      return view('customer/novi_racun',['kreiranjeNovogRacuna'=>$kreiranjeNovogRacuna]);
    }

    public function kreiranje_novog_racuna()
    {
    
      // save account
       
      return redirect('novi-racun');
    }
}