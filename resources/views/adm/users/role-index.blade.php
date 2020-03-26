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

    <div class="well">
        <h4>Roluri</h4>
    </div>
    
    <div class="row">
        @foreach($roles as $rol)
        <div class="col-md-8">
            <div class="col-sm-3">{{ $rol->name }}</div>
            <div class="col-sm-6">
                @foreach ($rol->users as $user)
                    <strong>{{ $user->name }}</strong>@if(!$loop->last), @endif
                @endforeach
            </div>
            <hr>
        </div>
        @endforeach
    </div>
</div>
@endsection