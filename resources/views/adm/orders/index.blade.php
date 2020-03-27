@extends('adm.layouts.body')

{{-- Add custom CSS to head on base template --}}
@section('customcss')
<style>
.table-wrapper {
    background: #fff;
    padding: 20px 25px;
    margin: 30px auto;
    border-radius: 3px;
    box-shadow: 0 1px 1px rgba(0,0,0,.05);
}

.table-title {
    color: #fff;
    background: #4b5366;
    padding: 16px 25px;
    margin: -20px -25px 10px;
    border-radius: 3px 3px 0 0;
}

.table-title h2 {
    margin: 5px 0 0;
    font-size: 24px;
}

.table-title .btn {
    font-size: 13px;
    border: none;
}

.table-wrapper .btn {
    float: right;
    color: #333;
    background-color: #fff;
    border-radius: 3px;
    border: none;
    outline: none !important;
    margin-left: 10px;
}

.table-wrapper .btn.btn-primary {
    color: #fff;
    background: #03A9F4;
}
</style>
@endsection

@section('content')
<div class="table-wrapper">
    <div class="table-title">
        <div class="row">
            <div class="col-sm-4">
                <h2>Detalii <b>Comenzii</b></h2>
            </div>
            <div class="col-sm-8">						
                <a href="#" class="btn btn-primary"><span class="glyphicon glyphicon-refresh"></span> <span>Lista de actualizare</span></a>
                <a href="#" class="btn btn-info"><span class="glyphicon glyphicon-file"></span> <span>Exportați în Excel</span></a>
            </div>
        </div>
    </div>
    <p>Nu sunt date disponibile momentan</p>
</div>
@endsection

{{-- Add custom scripts to head on base template --}}
@section('scripts')
@endsection