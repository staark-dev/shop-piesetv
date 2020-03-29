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
    background: #f0ad4ed6;
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
                <h2>Gestionează <b>Produse</b></h2>
            </div>
            <div class="col-sm-8">
                <a href="{{ route('admin.product.create') }}" class="btn btn-success"><span class="glyphicon glyphicon-plus-sign"></span> <span>Adauga Produs</span></a>
                <a href="#myModal" class="btn btn-danger" data-toggle="modal"><span class="glyphicon glyphicon-minus-sign"></span> <span>Stege tot</span></a>
            </div>
        </div>
    </div>
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>#</th>
                <th style="width: 250px;">Nume</th>
                <th style="width: 60px;">URL</th>
                <th>Categorie</th>
                <th>Pret</th>
                <th>Cantitate</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>
                        <img src="{{ Storage::disk('public')->url('images/items/' . $product->image) }}" alt="" style="border-radius: 10%;vertical-align: middle;margin-right: 10px;width: 70px;" />
                        <span class="prod-title">{{ $product->title }}</span>
                    </td>
                    <td>{{ route('product.view', ['slug' => $product->slug]) }}</td>
                    <td>{{ $product->categories->name }}</td>
                    <td>{{ $product->price }} RON</td>
                    <td>{{ $product->stock }} buc.</td>
                    <td>
                        <a href="{{ route('admin.product.show', ['product' => $product->id]) }}" class="view"><span class="glyphicon glyphicon-eye-open"></span></a>&nbsp;
                        <a href="{{ route('admin.product.edit', ['product' => $product->id]) }}" class="edit"><span class="glyphicon glyphicon-cog"></span></a>&nbsp;
                        <a href="#deleteProductModal" class="delete" data-product="{{ $product->id }}" data-toggle="modal"><span class="glyphicon glyphicon-trash"></span></a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="clearfix">
        <div class="hint-text">Afișând <b>{{ $products->count() }}</b> din <b>{{ $products->total() }}</b> de înregistrări</div>
        {{ $products->links() }}
    </div>
</div>

@include('adm.layouts.modal.master', [
    'modal' => [
        'id' => 'deleteProductModal',
        'title' => 'Sterge un produs',
        'body' => 'Esti sigut ca vrei sa stergi acest produs ?<br /><span class="user_msg"></span>Aceasta actiune face ca datele sa nu mai pot fii recuperate.',
        'btn' => '<button class="btn btn-sm btn-danger" id="delete">Sterge</button>'
    ]
])

@include('adm.layouts.modal.delete');
@endsection

@section('scripts')
<script>
$('#deleteProductModal').on('shown.bs.modal', function (event) {
    var submit = $(this).find('#delete');
    var button = $(event.relatedTarget);
    var product_id = button.data('product');
    
    $(this).find(".modal-title").text('Stergere produs');
    
    var parent = $(this);
    submit.on('click', function() {
        $.ajax({
            type: 'POST',
            url: '/admin/product/' + product_id,
            data: {
                '_token': $('meta[name="csrf-token"]').attr('content'),
                '_method': 'DELETE'
            },
            success: function(result) {
                parent.modal('hide');
                window.location.reload();
            }
        });
    });
});
</script>
@endsection