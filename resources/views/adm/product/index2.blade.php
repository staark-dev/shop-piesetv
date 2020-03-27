@extends('adm.layouts.body')

@section('content')
<div class="row">
    <div class="col-lg-6">
        <div class="pull-left" style="padding: 20px 0;">
            <div class="panel-title" style="float: left;line-height: 0;font-size: 30px;margin-right: 10px;">
                <span class="glyphicon glyphicon-list-alt"></span> <h4 style="font-size: 24px;font-weight: 800;float: right;margin-left: 5px;margin-top: 1px;">Produse</h4>
            </div>
            <a href="{{ route('admin.product.create') }}" class="btn btn-sm btn-success"><i class="glyphicon glyphicon-plus-sign"></i> Adauga Nou</a>
            <a href="#" class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-trash"></i> Sterge tot</a>
        </div>
    </div>
</div>
    <div class="content-box-large mt-5">
        <div class="panel-body">
            @php
            foreach ($products as $item) {
                $data2[] = [
                    'checkbox' => '<input data-index="'. $item->id .'" name="btSelectItem" type="checkbox">',
                    'id' => $item->id,
                    'name' => $item->title,
                    'slug' => $item->slug,
                    'cat' => $item->categories->name,
                    'price' => $item->price . ' RON',
                    'stock' => $item->stock . ' buc.',
                    'action' => '
                        <a data-toggle="modal" href="#" data-whatever="'. $item->id .'" data-target="#deleteProduct" class="btn btn-sm btn-danger" style="float: right;margin-bottom: 5px;"><i class="glyphicon glyphicon-remove"></i> Delete</a>
                        <a style="margin-bottom: 2px;float: right;clear: both;" href="https://upgrade.shop-piesetv.ro/admin/product/'. $item->id .'/edit" class="btn btn-sm btn-info" style="margin-bottom: 2px;"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
                        <a style="float: right;margin-bottom: 2px;margin-right: 5px;" href="https://upgrade.shop-piesetv.ro/admin/product/'. $item->id .'" class="btn btn-sm btn-warning" style="float: left; margin-bottom: 2px;"><i class="glyphicon glyphicon-eye-open"></i> View</a>
                    '
                ];
            }
            @endphp
            <table id="table" data-toggle="table" data-pagination="true" data-search="true"></table>
        </div>
    </div>
@endsection

@section('scripts')
<div class="modal fade" id="deleteProduct" tabindex="-1" role="dialog" aria-labelledby="deleteProduct" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="myModalLabel">Stergere produs</h4>
        </div>
        <div class="modal-body">
            <h3>Esti sigur ca vrei sa stergi acest produs ?</h3>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="button" id="delete" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
</div>

<style>
table#table th {
    background: #74b9ce26;
    font-size: 14px;
    color: #15395f;
}
</style>
<link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.16.0/dist/bootstrap-table.min.css">
<script src="https://unpkg.com/bootstrap-table@1.16.0/dist/bootstrap-table.min.js"></script>
<link rel="stylesheet" href="https://unpkg.com/@fortawesome/fontawesome-free@5.12.1/css/all.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://unpkg.com/bootstrap-table@1.16.0/dist/bootstrap-table.min.js"></script>
<script>
$('#table').bootstrapTable({
    classes: 'table table-hover',
    sortOrder: 'desc',
    sortName: 'name',
    searchAlign: 'right',
    showRefresh: true,
    pagination: true,
    sortStable: true,
    showButtonIcons: true,
    columns: [{
        checkbox: true,
        title: ''
    }, {
        field: 'id',
        title: 'ID'
    }, {
        field: 'name',
        title: 'Nume Produs',
        width: '240px'
    }, {
        field: 'slug',
        title: 'URL Produs'
    }, {
        field: 'cat',
        title: 'Categorie'
    }, {
        field: 'price',
        title: 'Pret'
    }, {
        field: 'stock',
        title: 'Stock'
    }, {
        field: 'action',
        title: 'Actiuni',
        width: '150px'
    }],
    data: @php print_r (json_encode($data2)) @endphp
});

$('#deleteProduct').on('shown.bs.modal', function (event) {
    var submit = $(this).find('#delete');
    var button = $(event.relatedTarget);
    var idProduct = button.data('whatever');
    var parent = $(this);
    submit.on('click', function() {
        $.ajax({
            type: 'POST',
            url: '/admin/product/' + idProduct,
            data: {
                '_token': $('meta[name="csrf-token"]').attr('content'),
                '_method': 'DELETE'
            },
            success: function(result) {
                console.log(result);
                parent.modal('hide');
            }
        });
    });
});
</script>
@endsection