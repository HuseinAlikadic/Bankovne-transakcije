@extends('layouts.app')

@section('content')
<div class="container">
    <form action="/transakcije-pojedinacne" method="POST">
        @csrf
        <div class="form-group">
            <label for="sel1">Transakcija sa računa:</label>
            <select class="form-control " name="id_from_account">
                <option value="">Select</option>
                <option v-for="item in akaunti" :value="item.id">@{{item.broj_racuna}}</option>
            </select>

        </div>

        <div class="form-group">
            <label for="sel1">Transakcija na račun:</label>
            <select class="form-control " name="id_to_account">
                <option value="">Select</option>
                <option v-for="item in akaunti" :value="item.id">@{{item.broj_racuna}}</option>
            </select>
        </div>
        <div class="form-group">
            <label for="usr">Iznos transakcije:</label>
            <input type="number" class="form-control" name="money_value">
        </div>
        <button type="submit" class="btn btn-primary ">Submit</button>

    </form>
    <br>
    <div>
        <p>Transakcije informacijama koje ću naknadno ubaciti!!! </p>
        @if (session('upozorenje'))
        <div class="alert alert-danger" role="alert">
            {{ session('upozorenje') }}
        </div>
        @endif
        @if (session('racuni'))
        <div class="alert alert-danger" role="alert">
            {{ session('racuni') }}
        </div>
        @endif

    </div>
</div>
@endsection
@section('VuePodaci')
<script>
var app = new Vue({
    el: '#app',
    name: 'Transakcije',
    data: function() {
        return {
            akaunti: <?=$akaunti?>,

        }
    },
});
</script>
@endsection