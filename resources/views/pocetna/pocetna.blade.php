@extends('layouts.app')

@section('content')
<div class="container">
    <div>
        <a a href="{{ route('korisnici') }}" type="button" class="btn btn-secondary">Kreiraj korisnika</a>
        <a a href="{{ route('IspisKorisnika') }}" type="button" class="btn btn-secondary">Lista korisnika</a>
        <a a href="{{ route('TransakcijeKorisnika') }}" type="button" class="btn btn-secondary">Transakcije</a>
        <a a href="{{ route('OtvaranjeNovogRacuna') }}" type="button" class="btn btn-secondary">Otvaranje računa</a>
        <a a href="{{ route('KreiranjeNovogKredita') }}" type="button" class="btn btn-secondary">Novi kredit</a>
        <a a href="{{ route('IspisRacuna') }}" type="button" class="btn btn-secondary">Ispis računa</a>
        <a a href="{{ route('IspisKredita') }}" type="button" class="btn btn-secondary">Ispis kredita</a>
    </div>
    <br>
    <div>
        <p>Ovo je početna stranica sa nekim informacijama koje ću naknadno ubaciti!!! </p>
    </div>
</div>
@endsection
@section('VuePodaci')
<script>
var app = new Vue({
    el: '#app',
    name: 'husein',
    data: function() {
        return {
            husein: 55,
        }
    },
});
</script>
@endsection