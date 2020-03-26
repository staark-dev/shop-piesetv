@extends('adm.layouts.body')

@section('content')
<div class="row content-box">
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