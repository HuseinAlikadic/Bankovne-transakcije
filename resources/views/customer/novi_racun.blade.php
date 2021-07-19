@extends('layouts.app')

@section('content')
<div class="container">
    <div>
        <p>Ovo je početna stranica sa nekim informacijama za otvaranje novog računa!!! </p>
    </div>
    <br>
    <div>
        <form action="/kreiran-novi-racun" method="POST">
            @csrf
            <div class="form-row">
                <div class="col">
                    <div class="form-group">
                        <label for="sel1">Select korisnika:</label>
                        <select class="form-control">
                            <option value="">Select</option>
                            <option value="" v-for="item in kreiranjeNovogRacuna">@{{item.custumer_id}}</option>
                        </select>
                    </div>
                </div>
                <div class="col">
                    <label for="sel1">Broj računa:</label>
                    <input type="number" class="form-control" placeholder="Enter password">
                </div>
                <div class="col">
                    <label for="sel1">Iznos uplate:</label>
                    <input type="number" class="form-control" placeholder="Enter password">
                </div>
                <div class="col">

                    <div class="form-group">
                        <label for="sel1">Select finansiske institucije:</label>
                        <select class="form-control" id="sel1">
                            <option>1</option>
                        </select>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary otvaranjeRacunaButtons ">Save</button>

            </div>
        </form>
    </div>
    <br>

</div>
@endsection
@section('VuePodaci')
<script>
var app = new Vue({
    el: '#app',
    name: 'OtvaranjeNovogRacuna',
    data: function() {
        return {
            kreiranjeNovogRacuna: <?=$kreiranjeNovogRacuna?>
        }
    },
});
</script>
@endsection