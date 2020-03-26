@extends('adm.layouts.body')

@section('content')
<div class="row content-box">
    <div class="col-md-12"><h3 class="page-header">Adauga un utilizator nou</h3></div>
    <form action="{{ route('admin.user.store') }}" method="post">
        @csrf
        <input type="hidden" name="_data" value="create_user" />
        <div class="col-sm-3">
            <div class="form-group">
                <label for="my-input">Stare Cont</label>
                <select name="status" class="form-control" id="">
                    <option value="0">Alege...</option>
                    <option value="1">Activ</option>
                    <option value="2">Inactiv</option>
                </select>
            </div>

            <div class="form-group">
                <label for="my-input">Rol</label>
                <select name="rol" class="form-control" id="">
                    <option value="0">Alege...</option>
                    @foreach($roles as $rank)
                    <option value="{{ $rank->id }}">{{ $rank->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-sm-9">
            <div class="form-group col-md-6 @error('first_name') has-error @enderror">
                <label for="my-input">Nume</label>
                <input id="my-input" class="form-control" type="text" name="first_name" value="{{ old('first_name') }}" required />
                @error('first_name')
                    <span class="help-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group col-md-6 @error('last_name') has-error @enderror">
                <label for="my-input">Prenume</label>
                <input id="my-input" class="form-control" type="text" name="last_name" value="{{ old('last_name') }}" required >
                @error('last_name')
                    <span class="help-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group col-md-6 @error('user_name') has-error @enderror">
                <label for="my-input">Nume Utilizator</label>
                <input id="my-input" class="form-control" type="text" name="user_name" value="{{ old('user_name') }}" required >
                @error('user_name')
                    <span class="help-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group col-md-6 @error('email') has-error @enderror">
                <label for="my-input">E-Mail</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                @error('email')
                    <span class="help-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group col-md-6 @error('password') has-error @enderror">
                <label for="my-input">Parola</label>
                <input id="my-input" class="form-control" type="password" name="password">
                @error('password')
                    <span class="help-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group col-md-6 @error('confirm_password') has-error @enderror">
                <label for="my-input">Confirma Parola</label>
                <input id="my-input" class="form-control" type="password" name="confirm_password">
                @error('confirm_password')
                    <span class="help-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="col-md-12">
                <br><br>
                <a href="{{ route('admin.user.index') }}" class="btn btn-sm btn-danger">Renunta</a>
                <button class="btn btn-sm btn-success" type="submit">Creaza Utilizator</button>
            </div>
        </div>
    </form>
</div>
@endsection