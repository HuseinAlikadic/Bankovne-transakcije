<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();
Route::get('/', [App\Http\Controllers\HomeController::class, 'pocetna_stranica'])->name('pocetna');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'pocetna_stranica'])->name('pocetna');
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/korisnici', [App\Http\Controllers\CustomerController::class, 'prikazivanje_korisnika'])->name('korisnici');
Route::post('/kreiranje-korisnika', [App\Http\Controllers\CustomerController::class, 'kreiranje_novog_korisnika'])->name('NoviKorisnik');
Route::get('/ispis-korisnika', [App\Http\Controllers\CustomerController::class, 'ispis_svih_korisnika'])->name('IspisKorisnika');
Route::get('/transakcije-korisnika', [App\Http\Controllers\TransactionController::class, 'transakcije_izmedzu_korisnika'])->name('TransakcijeKorisnika');
Route::post('/transakcije-pojedinacne', [App\Http\Controllers\TransactionController::class, 'pojedinacne_transakcije_izmedzu_racuna'])->name('TransakcijeKorisnikaPojedinacne');
Route::get('/novi-racun', [App\Http\Controllers\CustomerController::class, 'otvaranje_novog_racuna'])->name('OtvaranjeNovogRacuna');
Route::post('/kreiran-novi-racun', [App\Http\Controllers\CustomerController::class, 'kreiranje_novog_racuna'])->name('KreiranjeNovogRacuna');
Route::get('/kreiran-novi-kredit', [App\Http\Controllers\CustomerController::class, 'kreiranje_novog_kredita'])->name('KreiranjeNovogKredita');
Route::post('/novi-kredit-kreiran', [App\Http\Controllers\CustomerController::class, 'spasavanje_u_bazu_novog_racuna'])->name('NoviKreditSpasen');