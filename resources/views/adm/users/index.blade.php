@extends('adm.layouts.body')

@section('content')
<div class="content-box-large">
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
    <div class="btn-toolbar">
        <a href="{{ route('admin.user.create') }}" class="btn btn-primary"><span class="glyphicon glyphicon-user"></span> Adauga utilizator</a>
        <a href="{{ route('admin.role.index') }}" class="btn btn-primary"><span class="glyphicon glyphicon-tower"></span> Roluri</a>
    </div>
    <br>
    <br>
    <div class="well">
        <form action="#" method="post">
            <div class="form-group">
                <label for="my-input">Email Utilizator / Username</label>
                <input id="my-input" class="form-control" type="text" name="">
            </div>
        </form>
        <table class="table">
        <thead>
            <tr>
            <th>#</th>
            <th>Prenume</th>
            <th>Nume</th>
            <th>Utilizator</th>
            <th>Rol</th>
            <th style="width: 84px;"></th>
            </tr>
        </thead>
        <tbody>
            @foreach($user as $users)
            <tr>
                <td>{{ $users->id }}</td>
                <td>{{ $users->first_name }}</td>
                <td>{{ $users->last_name }}</td>
                <td>{{ $users->name }}</td>
                <td>
                    @foreach(json_decode($users->roles, true) as $rank)
                    @if($rank['id'] == 1)
                    <button class="btn btn-success btn-xs"><span class="glyphicon glyphicon-tower"></span> {{ $rank['name'] }}</button>
                    @elseif($rank['id'] == 3)
                    <button class="btn btn-success btn-xs"><span class="glyphicon glyphicon-star"></span> {{ $rank['name'] }}</button>
                    @else
                    {{ $rank['name'] }}
                    @endif
                    @endforeach
                </td>
                <td>
                    <a href="{{ route('admin.user.edit', ['user' => $users->id]) . '?section=profile' }}" class="btn btn-warning btn-xs pull-left"><span class="glyphicon glyphicon-edit"></span></a>&nbsp;
                    <a href="#myModal" class="btn btn-danger btn-xs">
                        <span class="glyphicon glyphicon-minus-sign"></span>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
        </table>
    </div>
</div>
<div class="modal small hide fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel">Delete Confirmation</h3>
    </div>
    <div class="modal-body">
        <p class="error-text">Are you sure you want to delete the user?</p>
    </div>
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
        <button class="btn btn-danger" data-dismiss="modal">Delete</button>
    </div>
</div>
@endsection