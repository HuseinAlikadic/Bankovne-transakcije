@extends('layouts.app')

@section('content')
<div class="container">
    <div>
        <p>List all credits of one customer with their original term, remaining term, original credit
            amount and the current credit amount.</p>
    </div>
    <br>
    <div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Ime prezime</th>
                    <th>Orginalni uslovi</th>
                    <th>Dodatni uslovi</th>
                    <th>Iznos kredita</th>
                    <th>Trenutni kreditni iznos</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="item in kreditiKorisnika">
                    <td>@{{item.imePrezime}}</td>
                    <td>@{{item.original_term}}</td>
                    <td><span v-if="item.remaining_term==null"> No data</span> <span
                            v-else>@{{item.remaining_term}}</span></td>
                    <td>@{{item.credit_amount}}</td>
                    <td>@{{item.curent_credit_amount}}</td>
                </tr>

            </tbody>
        </table>
    </div>
    <br>
    <div>
        <p>Suma kreditnih vrijednosti korisnika:</p>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Ime prezime</th>
                    <th>Trenutni kreditni iznos</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="item in sumaPoKorisniku">
                    <td>@{{item.imePrezime}}</td>
                    <td>@{{item.sumaKredita}} KM</td>
                </tr>

            </tbody>
        </table>
    </div>
    <br>
    <p>Ukupno kredita @{{ukupnaSumaKredita}}</p>
    <p>Trenutni korisnici sa kreditm iznad 150 Km</p>
    <ul v-for="item in kreditiIznad">
        <li>@{{item.imePrezime}} @{{item.curent_credit_amount}} KM</li>
    </ul>
</div>
@endsection
@section('VuePodaci')
<script>
var app = new Vue({
    el: '#app',
    name: 'IspisKreditaPoKorisniku',
    data: function() {
        return {
            kreditiKorisnika: <?=$kreditiKorisnika?>,
            sumaPoKorisniku: <?=$sumaPoKorisniku?>,
            ukupnaSumaKredita: 0,
            kreditiIznad: []


        }
    },
    mounted() {
        this.kreditiKorisnika.forEach(element => {
            this.ukupnaSumaKredita += element.curent_credit_amount
            if (element.curent_credit_amount > 150) {
                this.kreditiIznad.push(element)

            }
        });
    },
    computed: {

    },


});
</script>
@endsection