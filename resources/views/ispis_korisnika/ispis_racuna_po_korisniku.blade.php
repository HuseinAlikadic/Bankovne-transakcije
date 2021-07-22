@extends('layouts.app')

@section('content')
<div class="container">
    <div>
        <p> List all accounts of one customer with their current balance. </p>
    </div>
    <br>
    <div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Ime i prezime</th>
                    <th>Računi</th>
                    <th>Bilansa</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="item in sviRacuniOdKorisnika">
                    <td>@{{item.imeIprezime}}</td>
                    <td>@{{item.broj_racuna}}</td>
                    <td><span class="text-right"> @{{item.bilans_racuna}} KM </span></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
@section('VuePodaci')
<script>
var app = new Vue({
    el: '#app',
    name: 'IspisKorisnikaItrenutneBilanse',
    data: function() {
        return {
            sviRacuniOdKorisnika: <?=$sviRacuniOdKorisnika?>,

        }
    },
});
</script>
@endsection