@extends('adm.layouts.body')

{{-- Add custom CSS to head on base template --}}
@section('customcss')
<link rel="stylesheet" href="{{ asset('adm/css/modals.css') }}">

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
    background: #4e71f0d6;
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
    border-radius: 3px;
    border: none;
    color: #fff;
    outline: none !important;
    margin-left: 10px;
}

.table-wrapper .btn.btn-primary {
    color: #fff;
    background: #5cb85c;
}

table.table tr th, table.table tr td {
    border-color: #e9e9e9;
    padding: 12px 15px;
    vertical-align: middle;
}

table.table td a.delete {
    color: #F44336;
    font-size: 15px;
}

table.table td  a.edit {
    font-size: 15px;
    color: #f0ad4e;
} 

table.table td  a.view {
    font-size: 15px;
}

table.table tr th, table.table tr td {
    border-color: #e9e9e9;
    padding: 12px 15px;
    vertical-align: middle;
}

table.table-striped tbody tr:nth-of-type(odd) {
    background-color: #fcfcfc;
}

table.table tr th, table.table tr td {
    border-color: #e9e9e9;
    padding: 12px 15px;
    vertical-align: middle;
}

.pagination {
    float: right;
    margin: 0 0 5px !important;
}

.pagination li a, .pagination li span {
    border: none;
    font-size: 13px;
    min-width: 30px;
    min-height: 30px;
    color: #999;
    margin: 0 2px;
    line-height: 30px;
    border-radius: 2px !important;
    text-align: center;
    padding: 0 6px;
}
.pagination li a:hover {
    color: #666;
}	
.pagination li.active a, .pagination li.active a.page-link {
    background: #03A9F4;
}
.pagination li.active a:hover {        
    background: #0397d6;
}
.pagination li.disabled i {
    color: #ccc;
}
.pagination li i {
    font-size: 16px;
    padding-top: 6px
}

.pagination li.active a, .pagination li.active a.page-link {
    background: #03A9F4;
}

.hint-text {
    float: left;
    margin-top: 10px;
    font-size: 13px;
}

.row.post-task .col-md-6 {
    margin: 0 0 2px;
    line-height: 35px;
    font-size: 12px;
    font-weight: 700;
}
</style>
@endsection

@section('content')
<div class="table-wrapper table-responsive">
    <div class="table-title">
        <div class="row">
            <div class="col-sm-4">
                <h2>Gestionează <b>Task-urile</b></h2>
            </div>
            <div class="col-sm-8">
                <a href="#" class="btn btn-success"><span class="glyphicon glyphicon-plus-sign"></span> <span>Adauga Task</span></a>
            </div>
        </div>
    </div>
    <div class="row post-task">
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-4">Sterge Cache</div>
                <div class="col-md-2"><button class="btn btn-info btn-sm" type="submit">Sterge</button></div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="row">
                <div class="col-md-4">Optimizarea templat-uri</div>
                <div class="col-md-2"><button class="btn btn-info btn-sm" type="submit">Sterge</button></div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="row">
                <div class="col-md-4">Sterge Sesiuni</div>
                <div class="col-md-2"><button class="btn btn-info btn-sm" type="submit">Sterge</button></div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="row">
                <div class="col-md-4">Optimizarea URL-uri</div>
                <div class="col-md-2"><button class="btn btn-info btn-sm" type="submit">Sterge</button></div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="row">
                <div class="col-md-4">Auto Sitemap</div>
                <div class="col-md-2"><button class="btn btn-success btn-sm" type="submit">Genereaza</button></div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="row">
                <div class="col-md-4">Verifica DB Migration</div>
                <div class="col-md-2"><button class="btn btn-warning btn-sm" type="submit">Verifica</button></div>
            </div>
        </div>
    </div>
    <div class="clearfix">
    </div>
</div>
@endsection