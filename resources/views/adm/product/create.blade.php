@extends('adm.layouts.body')

@section('content')
<div class="content-box-large">
    <form action="{{ route('admin.product.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-8">
                <div class="form-group @error('title') has-error @enderror">
                    <label>Nume Produs</label>
                    <input class="form-control" name="title" value="{{ old('title') }}" placeholder="Nume Produs" type="text">
                    @error('title')
                    <span class="help-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group @error('product_body') has-error @enderror">
                    <label>Descriere produs</label>
                    <textarea id="tinymce_basic" name="product_body" aria-hidden="false" style="display: block;">{{ old('product_body') }}</textarea>
                    @error('product_body')
                    <span class="help-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Numar de telefon</label>
                    <input class="form-control" name="product_telefon" value="{{ old('product_telefon') }}" placeholder="(+40) 72 xxx x574" type="text">
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">Galerie (Afisare imagini temporar)</div>
                    <div class="panel-body">
                        <div id="gallery_show">
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel panel-warning">
                    <div class="panel-heading" style="padding: 10px 15px 35px;">
                        <div class="panel-title">Imaginea Principala</div>
                    </div>
                    <div class="panel-body">
                        <img style="margin: 0px auto 20px; max-width: 100%;" class="preview thumbnail" src="{{ Storage::disk('public')->url('images/download.png') }}" alt="">
                        <input type="file" name="product_image" class="btn btn-default" id="product_image" />
                    </div>
                    @error('product_image')
                    <span class="help-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="panel panel-danger">
                    <div class="panel-heading" style="padding: 10px 15px 25px;">
                        <div class="panel-title">Categorie</div>
                    </div>
                    <div class="panel-body">
                        <select multiple="multiple" name="categories" class="form-control" id="select-1">
                            @foreach ($cat as $item)
                                <option @if(old('categories') == $item->id)selected @endif value="{{ $item->id }}"><strong>{{ $item->name }}</strong></option>
                            @endforeach
                        </select>

                        @error('categories')
                        <span class="help-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="panel panel-info">
                    <div class="panel-heading" style="padding: 10px 15px 25px;">
                        <div class="panel-title">Sub Categorie</div>
                    </div>
                    <div class="panel-body">
                        <select multiple="multiple" name="sub_categories" class="form-control" id="select-1">
                            @foreach ($cat as $item)
                                @if(!empty($item->sub_categories))
                                    @foreach ($item->sub_categories as $items)
                                    <option value="{{ $items->id }}">{{ $item->name }}&nbsp;- {{ $items->name }}</option>
                                    @endforeach
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <hr>
                <div class="form-group col-md-4">
                    <label for="my-input">Galerie</label>
                    <div class="input-group control-group increment" >
                        <input type="file" multiple="multiple" name="product_gallery[]" id="product_gallery_files" class="form-control">
                        <div class="input-group-btn"> 
                            <button class="btn btn-success" type="button"><i class="glyphicon glyphicon-plus"></i>Add</button>
                        </div>
                    </div>
                </div>

                <div class="form-group col-md-4 @error('product_price') has-error @enderror">
                    <label>Pret</label>
                    <div class="input-group col-md">
                        <input class="form-control" id="append" value="{{ old('product_price') }}" name="product_price" type="text">
                        <span class="input-group-addon">.00</span>
                    </div>
                    @error('product_price')
                    <span class="help-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group col-md-4 @error('product_stock') has-error @enderror">
                    <label>Stock</label>
                    <div class="input-group col-md">
                        <input class="form-control" name="product_stock" value="{{ old('product_stock') }}" id="append" type="text">
                        <span class="input-group-addon">buc.</span>
                    </div>
                    @error('product_stock')
                        <span class="help-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                
                <div class="col-md-12">
                    <hr>
                    <button class="btn btn-default" type="submit">
                        Cancel
                    </button>
                    <button class="btn btn-primary" type="submit">
                        <i class="fa fa-save"></i>
                        Submit
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<link rel="stylesheet" type="text/css" href="{{ asset('adm/vendors/bootstrap-wysihtml5/src/bootstrap-wysihtml5.css') }}">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script src="{{ asset('adm/vendors/bootstrap-wysihtml5/lib/js/wysihtml5-0.3.0.js') }}"></script>
<script src="{{ asset('adm/vendors/bootstrap-wysihtml5/src/bootstrap-wysihtml5.js') }}"></script>
<script type="text/javascript" src="{{ asset('adm/vendors/tinymce/js/tinymce/tinymce.min.js') }}"></script>
<script src="{{ asset('adm/js/custom.js') }}"></script>
<script>
// jQuery Image show
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('img.preview.thumbnail').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

var imagesPreview = function() {
    var $preview = $('#gallery_show').empty();
    if (this.files) $.each(this.files, readAndPreview);

    function readAndPreview(i, file) {
        if (!/\.(jpe?g|png|gif)$/i.test(file.name)) {
            return alert(file.name + " is not an image");
        }

        var reader = new FileReader();

        $(reader).on("load", function() {
            console.log(this.result);
            $($.parseHTML('<img class="thumbnail" style="margin: 0px 5px 20px;max-width: 30%;float: left;" />')).attr('src', this.result).appendTo($preview);
            //$preview.append($("<img class='thumbnail' style='margin: 0px auto 20px;max-width: 30%;float: left;' />", { src: this.result }));
        });

        reader.readAsDataURL(file);
    };
};


$(document).ready(function() {
    $("input[name='product_image']").on("change", function() {
        readURL(this);
    });

    $("#product_gallery_files").on("change", imagesPreview);
});

    // Tiny MCE
tinymce.init({
    selector: "#tinymce_basic",
    plugins: [
        "advlist autolink lists link image charmap print preview anchor",
        "searchreplace visualblocks code fullscreen",
        "insertdatetime media table contextmenu paste"
    ],
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
});

// Tiny MCE
tinymce.init({
    selector: "#tinymce_full",
    plugins: [
        "advlist autolink lists link image charmap print preview hr anchor pagebreak",
        "searchreplace wordcount visualblocks visualchars code fullscreen",
        "insertdatetime media nonbreaking save table contextmenu directionality",
        "emoticons template paste textcolor"
    ],
    toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
    toolbar2: "print preview media | forecolor backcolor emoticons",
    image_advtab: true,
    templates: [
        {title: 'Test template 1', content: 'Test 1'},
        {title: 'Test template 2', content: 'Test 2'}
    ]
});
</script>
@endsection