@extends('layouts.app')

@section('content')
<div class="card mx-auto" style="max-width:520px; margin-top:40px;">
    <article class="card-body">
        <header class="mb-4"><h4 class="card-title">{{ __('Creaza un cont') }}</h4></header>
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="form-row">
                <div class="col form-group">
                    <label>Nume</label>
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col form-group">
                    <label>Prenume</label>
                    <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" required autocomplete="name" autofocus>

                    @error('last_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label>Email</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <small class="form-text text-muted">Nu va împărtășiti niciodată e-mailul cu altcineva.</small>
            </div>

            <div class="form-group">
                <label class="custom-control custom-radio custom-control-inline">
                    <input class="custom-control-input" checked="" type="radio" name="gender" value="1">
                    <span class="custom-control-label">Barbat</span>
                </label>
                <label class="custom-control custom-radio custom-control-inline">
                    <input class="custom-control-input" type="radio" name="gender" value="2">
                    <span class="custom-control-label">Femeie</span>
                </label>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                  <label>Oras</label>
                  <input type="text" name="city" class="form-control">
                </div> <!-- form-group end.// -->
                <div class="form-group col-md-6">
                    <label>Judet</label>
                    <select id="inputState" name="jud" class="form-control">
                        <option>Alege...</option>
                        <option selected="">Bucuresti</option>
                        <option>Brasov</option>
                        <option>Bacau</option>
                        <option>Arad</option>
                        <option>Cluj</option>
                    </select>
                </div> <!-- form-group end.// -->
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>Parola</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group col-md-6">
                    <label>Confirma Parola</label>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                </div>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block"> Register  </button>
            </div>

            <div class="form-group"> 
                <label class="custom-control custom-checkbox"> <input type="checkbox" class="custom-control-input" checked=""> <div class="custom-control-label"> I am agree with <a href="#">terms and contitions</a>  </div> </label>
            </div>
        </form>
    </article>
</div>
@endsection
