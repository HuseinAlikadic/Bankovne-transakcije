@extends('layouts.app')
@section('content')
    <div class="container" id="app">
        <p>huhu</p>
        <form action="/transakcija-kredita-pojedinacne" method="POST">
            @csrf
            <div class="form-group">
                <label for="sel1">Transakcija sa računa:</label>
                <select class="form-control " name="id_from_account">
                    <option value="">Select</option>
                    <option :value="item.id" v-for="item in korisnici">@{{item.broj_racuna}}</option>
                </select>
    
            </div>
    
            <div class="form-group">
                <label for="sel1">Transakcija na račun:</label>
                <select class="form-control " name="id_to_account">
                    <option value="">Select</option>
                    <option :value="item.id" v-for="item in korisnici" >@{{ item.broj_racuna }}</option>
                </select>
            </div>
            <div class="form-group">
                <label for="usr">Iznos transakcije:</label>
                <input type="number" class="form-control" name="money_value">
            </div>
            <button type="submit" class="btn btn-primary ">Submit</button>
    
        </form>
        <div>
            @if (session('upozorenje'))
            <div class="alert alert-danger" role="alert">
                {{ session('upozorenje') }}
            </div>
            @endif
        </div>
        <div>
            <example-component></example-component>
        </div>
        
    </div>
  
@endsection

@section('VuePodaci')
<script>
var app = new Vue({
    el: '#app',
    name: 'korisniciTransakcijeVjezba',
    data: function() {
        return {
            korisnici:<?= $korisnici?>
           
        }
    },
 
});

</script>
@endsection