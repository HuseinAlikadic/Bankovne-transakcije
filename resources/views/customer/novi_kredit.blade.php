@extends('layouts.app')

@section('content')

<div class="container">
    <div>
        <p>Neke informacije o kreditima i sl..</p>
    </div>
    <div>
        <form action="/novi-kredit-kreiran" method="POST">
            @csrf
            <div class="form-group">
                <label for="sel1">Select list:</label>
                <select class="form-control" name="custumer_id">
                    <option value="">Select</option>
                    <option :value="item.id" v-for="item in korisniciKredita">@{{item.imeIprezime}}</option>

                </select>
            </div>
            <div class="form-group">
                <label for="comment">Orginalni uslovi:</label>
                <textarea class="form-control" rows="5"></textarea>
            </div>
            <div class="form-group">
                <label for="comment">Dodatni uslovi:</label>
                <textarea class="form-control" rows="5"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
</div>

@endsection
@section('VuePodaci')
<script>
var app = new Vue({
    el: '#app',
    name: 'NoviKredit',
    data: function() {
        return {
            kreditPoKorisniku: <?=$kreditPoKorisniku?>,
            korisniciKredita: <?=$korisniciKredita?>
        }
    },
});
</script>
@endsection