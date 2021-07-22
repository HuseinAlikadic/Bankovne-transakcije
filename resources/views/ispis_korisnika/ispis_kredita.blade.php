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
</div>
@endsection
@section('VuePodaci')
<script>
var app = new Vue({
    el: '#app',
    name: 'IspisKreditaPoKorisniku',
    data: function() {
        return {
            kreditiKorisnika: <?=$kreditiKorisnika?>

        }
    },
});
</script>
@endsection