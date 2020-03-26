@extends('adm.layouts.body')

@section('content')
<div class="row content-box">
    <h3>Adauga o categorie</h3>
    <hr>
    <form action="{{ route('admin.cat.store') }}" class="form" method="post">
        @csrf

        <div class="form-group col-md-6">
            <label for="">Nume Categorie</label>
            <input class="form-control" type="text" name="name" required>
        </div>

        <div class="form-group col-md-4">
            <label for="">URL Categorie</label>
            <input class="form-control" type="text" name="slug">
            <span class="help-block small">Optional, in mod automat se auto creaza.</span>
        </div>

        <div class="form-group col-md-6 clearfix center-box">
            <input type="submit" value="Adauga" class="btn btn-sm btn-success">
            <a href="{{ route('admin.cat.index') }}" class="btn btn-sm btn-danger">Renunta</a>
        </div>
    </form>
</div>
@endsection