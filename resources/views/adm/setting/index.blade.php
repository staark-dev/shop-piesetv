@extends('adm.layouts.body')

{{-- Add custom CSS to head on base template --}}
@section('customcss')
@endsection

@section('content')
    <form action="" method="post" class="form row">
        @csrf
        <div class="form-group col-md-6">
            <label for="">Nume Site</label>
            <input id="" class="form-control" type="text" value="{{ $data['app']['name'] }}" name="site_title">
        </div>

        <div class="form-group col-md-6">
            <label for="">URL Site</label>
            <input id="" class="form-control" type="text" value="{{ $data['app']['url'] }}" name="site_url">
        </div>

        <div class="form-group col-md-6">
            <label for="">Limba</label>
            <input id="" class="form-control" type="text" value="{{ $data['app']['locale'] }}" name="site_lang">
        </div>

        <div class="form-group col-md-6">
            <label for="">Cheie Aplicatie</label>
            <input id="" class="form-control" type="text" value="{{ $data['app']['key'] }}" name="key_site">
        </div>

        <div class="form-group col-md-6">
            <label for="">Google AdSense HTML code:</label>
            {!! Form::textarea('adense', '', ['class' => 'form-control']) !!}
        </div>
        
        <div class="form-group col-md-6">
            <label for="">Mod de întreținere</label>
            <input id="" class="form-control" type="text" placeholder="Introdu textul pentru a pune site in modul intretiere" name="maintenance_site">
        </div>

        <div class="form-group col-md-12">
            <input type="submit" class="btn btn-success" value="Salveaza">
        </div>
    </form>
@endsection

@section('scripts')
    
@endsection