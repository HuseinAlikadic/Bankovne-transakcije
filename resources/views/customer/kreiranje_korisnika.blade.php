@extends('layouts.app')

@section('content')
<div class="container">
    <div>
        <p>Kreirajte novog korisnika. </p>
        <br>
        <button type="button" class="btn btn-primary" @click="dodajKorisnika()">
            Novi kijent
        </button>
        <!-- The Modal -->
        <div class="modal" id="dodajNovogKorisnika">
            <div class="modal-dialog">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Modal Heading</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <form action="/kreiranje-korisnika" method="POST">
                        @csrf
                        <!-- Modal body -->
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="usr">Ime:</label>
                                <input type="text" class="form-control" name="first_name" required>
                            </div>
                            <div class="form-group">
                                <label for="usr">Prezime:</label>
                                <input type="text" class="form-control" name="last_name" required>
                            </div>
                            <div class="form-group">
                                <label for="usr">Datum rođenja:</label>
                                <input id="datepicker" type="date" class="form-control date-of-birth-change-format " name="date_of_birth" required>
                                {{-- kada bi mijenjao format datuma preko vue komponente --}}
                                {{-- <vuejs-datepicker :language="fr"></vuejs-datepicker> --}}
                            </div>
                            <!-- <p>@error('date_of_birth') {{$message}} @enderror</p> -->
                            <div class="form-group">
                                <label for="usr">Adresa:</label>
                                <input type="text" class="form-control" name="address" required>
                            </div>

                            <!-- <div class="form-group">
                                <label for="sel1">Rejting:</label>
                                <select class="form-control" name="rating_id">
                                    <option value="">Select</option>
                                    <option :value="item.id" v-for="item in rejtingKupca">@{{item.type}}</option>

                                </select>
                            </div> -->
                        </div>

                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <br>

    <div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Ime</th>
                    <th>Prezime</th>
                    <th>Datum rođenja</th>
                    <th>Adresa</th>
                    <th>Razredna klasa</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="item in korisnici">
                    <td>@{{item.first_name}}</td>
                    <td>@{{item.last_name}}</td>
                    <td>@{{item.date_of_birth}}</td>
                    <td>@{{item.address}}</td>
                    <td>@{{item.type}}</td>
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
    name: 'korisnici',
    data: function() {
        return {

            korisnici: <?=$korisnici ?>,
            rejtingKupca: <?=$rejtingKupca?>,
            noviKorisnici: {}
        }
    },
    mounted() {
     
    },
    methods: {
        dodajKorisnika: function() {
            this.noviKorisnici = this.korisnici;
            $('#dodajNovogKorisnika').modal('toggle');
        }
    },
});
</script>
@endsection
