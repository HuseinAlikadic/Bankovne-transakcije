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
                        <select class="form-control" name="custumer_id" required>
                            <option value="">Select</option>
                            <option :value="item.id" v-for="item in zaKorisnika">@{{item.imeIprezime}}
                            </option>
                        </select>
                    </div>
                </div>
                <div class="col">
                    <label for="sel1">Broj računa:</label>
                    <input type="number" class="form-control" name="broj_racuna" required>
                </div>
                <div class="col">
                    <label for="sel1">Iznos uplate:</label>
                    <input type="number" class="form-control" name="bilans_racuna" required>
                </div>
                <div class="col">

                    <div class="form-group">
                        <label for="sel1">Select finansiske institucije:</label>
                        <select class="form-control" name="financial_institution_id" required>
                            <option value="">Select</option>
                            <option :value="item.id" v-for="item in finansiskeInstitucije">@{{item.name_of_bank}}
                            </option>
                        </select>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary otvaranjeRacunaButtons ">Save</button>

            </div>
        </form>
    </div>
    <br>
    @if (session('noviRacun'))
    <div class="alert alert-danger" role="alert">
        {{ session('noviRacun') }}
    </div>
    @endif
</div>
@endsection
@section('VuePodaci')
<script>
var app = new Vue({
    el: '#app',
    name: 'OtvaranjeNovogRacuna',
    data: function() {
        return {
            finansiskeInstitucije: <?=$finansiskeInstitucije?>,
            zaKorisnika: <?=$zaKorisnika?>,

        }
    },
});
</script>
@endsection