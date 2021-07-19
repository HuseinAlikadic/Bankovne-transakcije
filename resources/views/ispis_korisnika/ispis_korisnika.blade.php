@extends('layouts.app')

@section('content')
<div class="container">
    <div>
        <p>Korisnici sortirani po prezimenu. </p>
    </div>
    <br>
    <div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Ime</th>
                    <th>Prezime</th>
                    <th>Adresa</th>
                </tr>
            </thead>
            <tbody>
                @foreach($sortirani_korisnici as $item)
                <tr>
                    <td>{{$item->first_name}}</td>
                    <td>{{$item->last_name}}</td>
                    <td>{{$item->address}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
@section('VuePodaci')
<script>
var app = new Vue({
    el: '#app',
    name: 'IspisKorisnika',
    data: function() {
        return {
            sortiraniKorisnici: <?=$sortirani_korisnici?>
        }
    },
});
</script>
@endsection