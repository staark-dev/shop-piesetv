@extends('adm.layouts.body')

@section('content')
<div class="row content-box">
    <h3>Adauga o sub categorie</h3>
    <hr>
    <form action="{{ route('admin.cat.sub.store') }}" class="form" method="post">
        @csrf

        <div class="form-group col-md-6">
            <label for="">Nume Categorie</label>
            <input class="form-control" type="text" name="name" required>
        </div>

        <div class="form-group col-md-6">
            <label for="">Parinte</label>
            <select id="my-select" class="form-control custom-select" name="parent">
                <option>Alege...</option>
                @foreach ($cat->all() as $item)
                <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group col-md-6 clearfix center-box">
            <input type="submit" value="Adauga" class="btn btn-sm btn-success">
            <a href="{{ route('admin.cat.index') }}" class="btn btn-sm btn-danger">Renunta</a>
        </div>
    </form>
</div>
@endsection