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
    background: #75b9da;
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
</style>
@endsection

@section('content')
    @if (session('noAccess'))
    <div class="alert alert-warning">
        {{ session('noAccess') }}
    </div>
    @endif

    @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
    @endif

    <div class="table-wrapper">
        <div class="table-title">
            <div class="row">
                <div class="col-sm-4">
                    <h2>Gestionează <b>Categorii</b></h2>
                </div>
                <div class="col-sm-8">
                    <a href="{{ route('admin.cat.sub.create') }}" class="btn btn-warning"><span class="glyphicon glyphicon-plus-sign"></span> <span>Adauga Sub Categorie</span></a>
                    <a href="{{ route('admin.cat.create') }}" class="btn btn-primary"><span class="glyphicon glyphicon-plus-sign"></span> <span>Adauga Categorie</span></a>
                    <a href="#" class="btn btn-danger"><span class="glyphicon glyphicon-minus-sign"></span> <span>Stege tot</span></a>
                </div>
            </div>
        </div>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nume</th>						
                    <th>Data Creare</th>
                    <th>URL</th>
                    <th>Brand-uri</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cat as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d/m/Y') }}</td>
                    <td>{{ route('cat.view', ['slug' => $item->slug]) }}</td>
                    <td>{{ $item->sub_categories->count() }}</td>
                    <td>
                        <a href="#" class="edit"><span class="glyphicon glyphicon-cog"></span></a>&nbsp;
                        <a href="#" class="delete" data-toggle="modal"><span class="glyphicon glyphicon-trash"></span></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="clearfix">
            <div class="hint-text">Afișând <b>{{ $cat->count() }}</b> din <b>{{ $cat->total() }}</b> de înregistrări</div>
            {{ $cat->links() }}
        </div>
    </div>

<div class="row content-box" style="display: none;">


    <div class="col-md-12">
        <h3>Categorii</h3>
        <hr>
    </div>
    <div class="col-md-6 clearfix text-right pull-right">
        <a href="{{ route('admin.cat.create') }}" class="btn bnt-xs btn-primary clearfix" style="margin: 5px 5px;"><span class="glyphicon glyphicon-ok"></span> Adauga Categorie</a>
        <a href="{{ route('admin.cat.sub.create') }}" class="btn bnt-xs btn-warning clearfix" style="margin: 5px 5px;"><span class="glyphicon glyphicon-list-alt"></span> Adauga Sub Categorie</a>
        <a href="#" class="btn bnt-xs btn-danger clearfix" style="margin: 5px 5px;"><span class="glyphicon glyphicon-trash"></span> Sterge</a>
    </div>

    <div class="col-lg clearfix table-responsive">
        <table class="table table-bordered">
            <tbody class="thead table-dark">
                <tr>
                    <td>#</td>
                    <td style="width: 220px">Nume</td>
                    <td>Slug</td>
                    <td class="text-center" style="width:60px">Marcheaza</td>
                </tr>
            </tbody>
            <tfoot>
                @foreach ($cat as $item)
                    <tr>
                        <td @if(!empty($item->sub_categories)) rowspan="{{ $item->sub_categories->count()+1 }}" @endif>{{ $item->id }}</td>
                        <td>{{ $item->name }}<br />Added {{ $item->created_at->diffForHumans() }}</td>
                        <td>{{ $item->slug }}</td>
                        <td class="text-center"><input name="cat_id" type="checkbox"></td>
                    </tr>
                    @if(!empty($item->sub_categories))
                    @foreach ($item->sub_categories as $sub)
                        <tr>
                            <td>&nbsp;»<strong> {{ $sub->name }}</strong></td>
                            <td>{{ $sub->slug }}</td>
                            <td class="text-center"><input name="sub_cat_id" type="checkbox"></td>
                        </tr>
                    @endforeach
                    @endif
                @endforeach
            </tfoot>
        </table>
    </div>
</div>
@endsection