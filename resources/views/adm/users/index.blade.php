@extends('adm.layouts.body')

@section('customcss')
<link rel="stylesheet" href="{{ asset('adm/css/modals.css') }}">

<style>
    .table-wrapper {
        background: #fff;
        padding: 20px 25px;
        margin: 0px 0 20px;
        border-radius: 3px;
        box-shadow: 0 1px 1px rgba(0,0,0,.05);
    }

    .table-title {
        padding-bottom: 15px;
        background: #435d7d;
        color: #fff;
        padding: 16px 30px;
        margin: -20px -25px 10px;
        border-radius: 3px 3px 0 0;
    }

    .table-title h2 {
        margin: 5px 0 0;
        font-size: 24px;
    }

    .table-title .btn {
        color: #fff;
        float: right;
        font-size: 13px;
        border: none;
        min-width: 50px;
        border-radius: 2px;
        border: none;
        outline: none !important;
        margin-left: 10px;
    }

    .table {
        width: 100%;
        max-width: 100%;
        margin-bottom: 20px;
    }

    table {
        background-color: transparent;
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

    table.table td a.edit {
        color: #2196F3;
        font-size: 15px;
    }

    table.table td a {
        font-weight: bold;
        color: #566787;
        display: inline-block;
        text-decoration: none;
        outline: none !important;
    }

    table.table td a.delete {
        color: #F44336;
        font-size: 15px;
    }

    .pagination {
        float: right;
        margin: 0 0 5px !important;
    }

    .hint-text {
        float: left;
        margin-top: 10px;
        font-size: 13px;
    }

    table.table .avatar {
        border-radius: 50%;
        vertical-align: middle;
        margin-right: 10px;
        width: 40px;
    }

	.status {
		font-size: 30px;
		margin: 2px 2px 0 0;
		display: inline-block;
		vertical-align: middle;
		line-height: 10px;
	}
    .text-success {
        color: #10c469;
    }
    .text-info {
        color: #62c9e8;
    }
    .text-warning {
        color: #FFC107;
    }
    .text-danger {
        color: #ff5b5b;
    }
    .pagination {
        float: right;
        margin: 0 0 5px;
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
            <div class="col-sm-6">
                <h2>Gestionează <b>Utilizatori</b></h2>
            </div>
            <div class="col-sm-6">
                <a href="{{ route('admin.user.create') }}" class="btn btn-success"><span class="glyphicon glyphicon-plus-sign"></span> Adauga utilizator</a>
                <a href="#myModal" class="btn btn-danger" data-toggle="modal"><i class="glyphicon glyphicon-minus-sign"></i> <span>Sterge tot</span></a>
                <a href="{{ route('admin.role.index') }}" class="btn btn-primary"><span class="glyphicon glyphicon-tower"></span> Roluri</a>
            </div>
        </div>
    </div>
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>#</th>
                <th>Nume</th>
                <th>Data înregistrării</th>
                <th>Rol</th>
                <th>Stare</th>
                <th>Actiuni</th>
            </tr>
        </thead>
        <tbody>
            @foreach($user as $users)
            <tr>
                <td>{{ $users->id }}</td>
                <td>
                    <img src="{{ Storage::disk('public')->url($users->avatar) }}" class="avatar" alt="Avatar">
                    {{ $users->first_name }} {{ $users->last_name }}
                </td>
                <td>
                    {{ \Carbon\Carbon::parse($users->created_at)->format('d/m/Y') }}
                </td>
                <td>
                    @foreach(json_decode($users->roles, true) as $rank)
                    {{ $rank['name'] }}
                    @endforeach
                </td>
                <td>
                    @if($users->email_verified_at != null)
                    <span class="status text-success">•</span>
                    Activ
                    @else
                    <span class="status text-warning">•</span>
                    Inactiv
                    @endif
                </td>
                <td>
                    @if(Auth::user()->id != 1 && $users->id != 1 || Auth::user()->id == 1 )
                        <a href="{{ route('admin.user.edit', ['user' => $users->id]) . '?section=profile' }}" class="edit"><span class="glyphicon glyphicon-cog"></span></a>&nbsp;
                    @endif

                    @if($users->id == 1 || $users->id == 2)
                    @else
                    <a href="#deleteEmployeeModal" class="delete" data-user="{{ $users->name }}" data-whatever="{{ $users->id }}" data-toggle="modal"><span class="glyphicon glyphicon-trash"></span></a>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="clearfix">
        <div class="hint-text">Afișând <b>{{ $user->count() }}</b> din <b>{{ $user->total() }}</b> de înregistrări</div>
        {{ $user->links() }}
    </div>
</div>

@include('adm.layouts.modal.master', [
    'modal' => [
        'id' => 'deleteEmployeeModal',
        'title' => 'Sterge un utilizator',
        'body' => 'Esti sigut ca vrei sa stergi acest utilizator ?<br /><span class="user_msg"></span>Aceasta actiune face ca datele sa nu mai pot fii recuperate.',
        'btn' => '<button class="btn btn-sm btn-danger" id="delete">Sterge</button>'
    ]
])

@include('adm.layouts.modal.delete');
@endsection

@section('scripts')
<script>
$('#deleteEmployeeModal').on('shown.bs.modal', function (event) {
    var submit = $(this).find('#delete');
    var button = $(event.relatedTarget);
    var user_id = button.data('whatever');
    var user_name = button.data('user');
    
    $(this).find(".modal-title").text('Stergere cont utilizator ' + user_name);
    $(this).find('.user_msg').replaceWith('Contul utilizatorului <u>'+ user_name +'</u> definitiv, si nu va mai putea fii recuperat.<br />');
    
    var parent = $(this);
    submit.on('click', function() {
        $.ajax({
            type: 'POST',
            url: '/admin/user/' + user_id,
            data: {
                '_token': $('meta[name="csrf-token"]').attr('content'),
                '_method': 'DELETE'
            },
            success: function(result) {
                console.log('User #'+ user_id +' has been deleted.');
                parent.modal('hide');
            }
        });
    });
});
</script>
@endsection