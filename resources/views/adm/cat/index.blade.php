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

<div class="table-wrapper table-responsive">
    <div class="table-title">
        <div class="row">
            <div class="col-sm-4">
                <h2>Gestionează <b>Categorii</b></h2>
            </div>
            <div class="col-sm-8">
                <a href="{{ route('admin.cat.sub.create') }}" class="btn btn-warning"><span class="glyphicon glyphicon-plus-sign"></span> <span>Adauga Sub Categorie</span></a>
                <a href="{{ route('admin.cat.create') }}" class="btn btn-primary"><span class="glyphicon glyphicon-plus-sign"></span> <span>Adauga Categorie</span></a>
                <a href="#myModal" data-toggle="modal" class="btn btn-danger"><span class="glyphicon glyphicon-minus-sign"></span> <span>Stege tot</span></a>
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
                    <a href="#deleteCategoriesModal" class="delete" data-categories="{{ $item->id }}" data-toggle="modal"><span class="glyphicon glyphicon-trash"></span></a>
                </td>
            </tr>
            @forelse ($item->sub_categories as $sub)
                <tr>
                    <td>{{ $sub->id }}</td>
                    <td>&nbsp;»<strong> {{ $sub->name }}</strong></td>
                    <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d/m/Y') }}</td>
                    <td>{{ route('cat.view', ['slug' => $sub->slug]) }}</td>
                    <td>-</td>
                    <td>
                        <a href="#" class="edit"><span class="glyphicon glyphicon-cog"></span></a>&nbsp;
                        <a href="#deleteSubCategoriesModal" class="delete" data-sub_categories="{{ $sub->id }}" data-toggle="modal"><span class="glyphicon glyphicon-trash"></span></a>
                    </td>
                </tr>
            @empty
                
            @endforelse
            @endforeach
        </tbody>
    </table>
    <div class="clearfix">
        <div class="hint-text">Afișând <b>{{ $cat->count() }}</b> din <b>{{ $cat->total() }}</b> de înregistrări</div>
        {{ $cat->links() }}
    </div>
</div>

@include('adm.layouts.modal.master', [
    'modal' => [
        'id' => 'deleteCategoriesModal',
        'title' => 'Stergere Categorie',
        'body' => 'Esti sigut ca vrei sa stergi acesta categorie ?<br />Aceasta actiune face ca datele sa nu mai pot fii recuperate.',
        'btn' => '<button class="btn btn-sm btn-danger" id="delete">Sterge</button>'
    ]
])

@include('adm.layouts.modal.master', [
    'modal' => [
        'id' => 'deleteSubCategoriesModal',
        'title' => 'Stergere Sub Categorie',
        'body' => 'Esti sigut ca vrei sa stergi acesta sub categorie ?<br />Aceasta actiune face ca datele sa nu mai pot fii recuperate.',
        'btn' => '<button class="btn btn-sm btn-danger" id="delete">Sterge</button>'
    ]
])

@include('adm.layouts.modal.delete');
@endsection

@section('scripts')
<script>
$('#deleteCategoriesModal').on('shown.bs.modal', function (event) {
    var submit = $(this).find('#delete');
    var button = $(event.relatedTarget);
    var cat_id = button.data('categories');
    
    var parent = $(this);
    submit.on('click', function() {
        $.ajax({
            type: 'POST',
            url: '/admin/cat/' + cat_id,
            data: {
                '_token': $('meta[name="csrf-token"]').attr('content'),
                '_method': 'DELETE'
            },
            success: function(result) {
                parent.modal('hide');
                setTimeout(function() {
                    window.location.reload();
                }, 2000);
            }
        });
    });
});

$('#deleteSubCategoriesModal').on('shown.bs.modal', function (event) {
    var submit = $(this).find('#delete');
    var button = $(event.relatedTarget);
    var cat_id = button.data('sub_categories');
    
    var parent = $(this);
    submit.on('click', function() {
        $.ajax({
            type: 'POST',
            url: 'admin/cat/sub/' + cat_id,
            data: {
                '_token': $('meta[name="csrf-token"]').attr('content'),
                '_method': 'DELETE'
            },
            success: function(result) {
                parent.modal('hide');
                setTimeout(function() {
                    window.location.reload();
                }, 2000);
            }
        });
    });
});
</script>
@endsection