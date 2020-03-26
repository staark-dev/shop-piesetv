@extends('adm.layouts.body')

@section('content')
<div class="row content-box">
    <div class="col-md-12">
        <h3 class="page-header">Modifica profil :: {{ $user->name }}
        @if($user->email_verified_at == null)
        <form action="{{ route('admin.user.activate', ['user' => $user->id]) }}" method="post">
            @csrf
            <p class="pull-right clearfix" style="margin-right: 20px; margin-top: -25px;">
                <button class="btn btn-sm btn-warning"><span class="glyphicon glyphicon-chevron-down"></span> Activeaza</button>
            </p>
            </form>
        @endif
        </h3>
    </div>
    <form action="{{ route('admin.user.update', ['user' => $user->id]) }}" class="form" method="post" enctype="multipart/form-data">
        {{ method_field('PUT') }}
        @csrf
        <div class="col-sm-3">
            <div class="text-center">
                <img src="{{ Storage::disk('public')->url($user->avatar) }}" class="avatar img-circle img-thumbnail" alt="avatar">
                <h6>Upload a different photo...</h6>
                <input type="file" name="user_avatar" class="btn btn-info btn-xs">
            </div>
            <br>
            <div class="text-center">
                @if($user->email_verified_at == null)
                    <button type="button" class="btn btn-danger btn-xs active">Acest cont nu a fost verificat de un admin.</button>
                @else
                    <button type="button" class="btn btn-success btn-xs active">Utilizator verificat {{ $user->email_verified_at->diffForHumans() }}</button>
                @endif
                <br>
                <br>
                Membru din {{ $user->created_at->diffForHumans() }}
                <br>
                @if($user->updated_at != null)
                Ultima logare: {{ $user->updated_at->diffForHumans() }}
                @endif
            </div>
            <br>
            <ul class="list-group">
                <li class="list-group-item text-muted panel panel-warning">Activity <i class="fa fa-dashboard fa-1x"></i></li>
                <li class="list-group-item text-right"><span class="pull-left"><strong>Comenzii</strong></span> 0</li>
                <li class="list-group-item text-right"><span class="pull-left"><strong>Comenzii anulate</strong></span> 0</li>
                <li class="list-group-item text-right"><span class="pull-left"><strong>Produse Favorite</strong></span> 0</li>
                <li class="list-group-item text-right"><span class="pull-left"><strong>Comenzi in asteptare</strong></span> 0</li>
            </ul>
        </div>

        <div class="col-sm-9" style="border-left: 1px solid #dddddd75; padding: 10px 20px; min-height: 560px">
            <ul class="nav nav-pills">
                <li @if(!request()->hasAny(['tab'])) class="active" @endif><a href="?section=profile">Profil</a></li>
                <li @if(request()->query('tab') == "roles") class="active" @endif><a href="?section=profile&tab=roles">Roluri</a></li>
                <li @if(request()->query('tab') == "security") class="active" @endif><a href="?section=profil&tab=security">Securitate</a></li>
                <li @if(request()->query('tab') == "order") class="active" @endif><a href="?section=profil&tab=order&id={{ $user->id }}">Comenzii</a></li>
            </ul>

            <div class="tab-content">
                @if(!request()->hasAny(['tab']))
                <div class="tab-pane active" id="profile">
                    <div class="form-group">
                        <div class="col-xs-6">
                            <label for=""><h4>Nume</h4></label>
                            <input type="text" class="form-control" name="first_name" id="first_name" value="{{ $user->first_name }}" />
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-xs-6">
                            <label for=""><h4>Prenume</h4></label>
                            <input type="text" class="form-control" name="last_name" id="first_name" value="{{ $user->last_name }}" />
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-xs-6">
                            <label for=""><h4>Nume Utilizator</h4></label>
                            <input type="text" class="form-control" name="user_name" id="first_name" value="{{ $user->name }}" />
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-xs-6">
                            <label for=""><h4>Email</h4></label>
                            <input type="text" class="form-control" name="user_mail" id="mail" value="{{ $user->email }}" />
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-xs-6">
                            <label for=""><h4>Telefon</h4></label>
                            <div class="input-group">
                                <span class="input-group-addon">+40</span>
                                <input id="Mobile" name="phone" class="form-control" value="{{ $user->telefon }}" type="text">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-xs-6">
                            <label for=""><h4>Judet</h4></label>
                            <input type="text" class="form-control" name="judet" id="phone" value="{{ $user->judet }}" />
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-xs-6">
                            <label for=""><h4>Oras</h4></label>
                            <input type="text" class="form-control" name="oras" id="phone" value="{{ $user->city }}" />
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-xs-6">
                            <label for=""><h4>Data de nastere</h4></label>
                            <input type="date" class="form-control" name="birthday" id="" value="{{ $user->birthday }}" disabled />
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-xs-6">
                            <label for=""><h4>Sex</h4></label>
                            <input type="text" class="form-control" name="sex" id="" value="Barbat" disabled="">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-xs-6">
                            <label for=""><h4>Rank</h4></label>

                            <button class="form-control btn btn-info active btn-xs" type="button">Admin</button>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="col-md-12">
                            <br>
                            <br>
                            <input type="hidden" name="page_profile" />
                            <button class="btn btn-success" type="submit">Salveaza</button>
                            <a href="{{ route('admin.user.index') }}" class="btn btn-danger">Renunta</a>
                        </div>
                    </div>
                </div>
                @endif

                @if(request()->query('tab') == "roles")
                <div class="tab-pane active" id="role">
                    <div class="form-group">
                        <div class="col-xs-6">
                            <label for="my-select"><h4>Grad</h4></label>
                            
                            <select id="my-select" class="form-control" name="roles">
                                @foreach ($roles as $role)
                                    <option @if($user->role_id == $role->id)selected @endif value="{{ $role->id }}">{{ $role['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-12">
                            <br>
                            <br>
                            <input type="hidden" name="page_roles" />
                            <button class="btn btn-success" type="submit">Salveaza</button>
                            <a href="{{ route('admin.user.index') }}" class="btn btn-danger">Renunta</a>
                        </div>
                    </div>
                </div>
                @endif

                @if(request()->query('tab') == "security")
                <div class="tab-pane active" id="role">
                    <div class="form-group @error('user_password_confirm') has-error @enderror @error('user_password') has-error @enderror">
                        <div class="col-xs-6">
                            <label for=""><h4>Parola</h4></label>
                            <input class="form-control" name="user_password" type="password" placeholder="*********">
                            @error('user_password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-xs-6">
                            <label for=""><h4>Confirma Parola</h4></label>
                            <input class="form-control" name="user_password_confirm" type="password" placeholder="*********">
                            @error('user_password_confirm')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <br>
                            <br>
                            <input type="hidden" name="page_reset_password" />
                            <button class="btn btn-success" type="submit">Salveaza</button>
                            <a href="{{ route('admin.user.index') }}" class="btn btn-danger">Renunta</a>
                        </div>
                    </div>
                </div>
                @endif

                @if(request()->query('tab') == "order")
                <div class="tab-pane active" id="role">
                    <br><br>
                    <div class="col-md-12 panel-warning">
                        <div class="content-box-header panel-heading">
                            <div class="panel-title ">Comenzii Utilizator</div>
                        </div>

                        <div class="content-box-large box-with-header">
                            <p>Nu sunt informatii disponibile momentan</p>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </form>
</div>
@endsection

@section('scripts')
    <style>
        .list-group-item.panel-warning {
            border-color: #faebcc;
            background: #faebcc;
            color: #484848;
            font-size: 14px;
        }
    </style>
@endsection