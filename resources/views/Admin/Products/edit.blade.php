@extends('Admin.layouts.master')

@section('content')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-beta/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css" rel="stylesheet">
    <link href="https://bootstrap-tagsinput.github.io/bootstrap-tagsinput/examples/assets/app.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <style>
        .label-info {
            background-color: #5bc0de;
            display: inline-block;
            padding: 0.2em 0.6em 0.3em;
            font-size: 75%;
            font-weight: 700;
            line-height: 1;
            color: #fff;
            text-align: center;
            white-space: nowrap;
            vertical-align: baseline;
            border-radius: 0.25em;
        }
        body{ font-family:calibri;}
        .twitter-typeahead { display:initial !important; }
        .bootstrap-tagsinput {line-height:40px;display:block !important;}
        .bootstrap-tagsinput .tag {background:#09F;padding:5px;border-radius:4px;}
        .tt-hint {top:2px !important;}
        .tt-input{vertical-align:baseline !important;}
        .typeahead { border: 1px solid #CCCCCC;border-radius: 4px;padding: 8px 12px;width: 300px;font-size:1.5em;}
        .tt-menu { width:300px; }
        span.twitter-typeahead .tt-suggestion {padding: 10px 20px;	border-bottom:#CCC 1px solid;cursor:pointer;}
        span.twitter-typeahead .tt-suggestion:last-child { border-bottom:0px; }
        .demo-label {font-size:1.5em;color: #686868;font-weight: 500;}
        .bgcolor {max-width: 440px;height: 200px;background-color: #c3e8cb;padding: 40px 70px;border-radius:4px;margin:20px 0px;}
        #preview img { max-height: 50px; border: 1px solid #686868; margin-right: 5px;}
        #preview{ width: 100%}
    </style>
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4 class="m-0 text-dark">Add Product</h4>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('slide') }}">Product</a></li>
                        <li class="breadcrumb-item active">Add Product</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-md-12">
                    @include('Admin.include.message')
                </div>
            </div>
            {!! Form::model($product, ['method'=>'PATCH','route'=>['madmin.products.update', $product->id],'class'=>'form-horizontal', 'files'=>true]) !!}
            <div class="row">
                <div class="col-md-9">
                    <div class="card card-info">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        {!! Form::label('name', 'Title', ['class' => 'col-sm-12 col-form-label']) !!}
                                        <div class="col-sm-12">
                                            {!! Form::text('title', null, ['class'=>'form-control','id'=>'receiver','required']) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        {!! Form::label('name', 'Content', ['class' => 'col-sm-12 col-form-label']) !!}
                                        <div class="col-sm-12">
                                            {!! Form::textarea('content', null, ['class'=>'form-control','id'=>'summernote', 'rows'=>3]) !!}
                                            {{--                                            <textarea name="content" class="form-control" id="summernote" rows="4" cols="50" required></textarea>--}}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        {!! Form::label('name', 'Specification', ['class' => 'col-sm-12 col-form-label']) !!}
                                        <div class="col-sm-12">
                                            {!! Form::textarea('specification', null, ['class'=>'form-control','id'=>'summernote2', 'rows'=>3]) !!}
                                            {{--                                            <textarea name="specification" class="form-control" id="summernote2" rows="4" cols="50" required></textarea>--}}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        {!! Form::label('name', 'Warrenty', ['class' => 'col-sm-12 col-form-label']) !!}
                                        <div class="col-sm-12">
                                            {!! Form::textarea('warrenty', null, ['class'=>'form-control','id'=>'summernote3', 'rows'=>3]) !!}

                                            {{--                                            <textarea name="warrenty" class="form-control" id="summernote3" rows="4" cols="50" required>--}}
                                            {{--                                                Compressor 05 (Five) Years <br>--}}
                                            {{--Spare Parts 1 (One) Year<br>--}}
                                            {{--After Sales Service 1 (One) Year--}}
                                            {{--                                            </textarea>--}}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        {!! Form::label('name', 'SKU', ['class' => 'col-sm-4 col-form-label']) !!}
                                        <div class="col-sm-8">
                                            {!! Form::text('sku', null, ['class'=>'form-control','id'=>'receiver']) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        {!! Form::label('name', 'Qty', ['class' => 'col-sm-4 col-form-label']) !!}
                                        <div class="col-sm-8">
                                            {!! Form::number('qty', null, ['class'=>'form-control','id'=>'receiver','required']) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">

                                    <div class="form-group row">
                                        {!! Form::label('name', 'Regular Price', ['class' => 'col-sm-2 col-form-label']) !!}
                                        <div class="col-sm-4">
                                            {!! Form::number('regular_price', null, ['class'=>'form-control','id'=>'receiver']) !!}
                                        </div>
                                        {!! Form::label('name', 'Sales Price', ['class' => 'col-sm-2 col-form-label']) !!}
                                        <div class="col-sm-4">
                                            {!! Form::number('sales_price', null, ['class'=>'form-control','id'=>'receiver']) !!}
                                        </div>
                                    </div>

                                    {{--                                    <div class="form-group row">--}}
                                    {{--                                        {!! Form::label('name', 'Qty', ['class' => 'col-sm-4 col-form-label']) !!}--}}
                                    {{--                                        <div class="col-sm-8">--}}
                                    {{--                                            {!! Form::number('stock_qty', 1, ['class'=>'form-control','id'=>'receiver','required']) !!}--}}
                                    {{--                                        </div>--}}
                                    {{--                                    </div>--}}


                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        {!! Form::label('name', 'Gallery', ['class' => 'col-sm-2']) !!}
                                        <div class="col-sm-10">
                                            {!! Form::file('gallery[]', ['class'=>'form-control-file','id'=>'files', 'multiple']) !!}
                                            <div id="preview"></div>
                                            @if($product->gallery !=NULL)
                                                @php
                                                    $vars=explode(',',$product->gallery);
                                                @endphp
                                                <div class="row">
                                                    @foreach($vars as $val)
                                                        <div class="col-sm-2">
                                                            <img src="{{ asset('public/images/product/'.$val) }}" alt="" class="img-thumbnail">
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        {!! Form::label('name', 'Featured', ['class' => 'col-sm-2']) !!}
                                        <div class="col-sm-4">
                                            {!! Form::select('featured', ['No' => 'No','Yes' => 'Yes'],null,['class'=>'form-control','id'=>'receiver']); !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if($attributes!=NULL)
                        <div class="card card-info">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        @foreach($attributes as $attribute)
                                            @php
                                                $atts=\App\Models\Atribute::where('parent_id',$attribute->id)->get();
                                            @endphp
                                            <div class="form-group row">
                                                {!! Form::label('name', $attribute->name, ['class' => 'col-sm-2']) !!}
                                                <div class="col-sm-8">
                                                    @foreach($atts as $color)
                                                        <label>{!! Form::checkbox($attribute->value.'d[]',"$color->id",null,['class'=>"$attribute->value",'id'=>"$attribute->value"]); !!} {{ $color->name }}&nbsp; </label>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endforeach
                                        @if($product->color !=NULL)
                                            @php
                                                $colors=explode(',',$product->color);
                                            @endphp
                                            <script type="text/javascript">
                                                @foreach($colors as $val)
                                                $("input.color[value={{ $val }}]").prop('checked', true);
                                                @endforeach
                                            </script>
                                        @endif
                                        @if($product->size !=NULL)
                                            @php
                                                $sizes=explode(',',$product->size);
                                            @endphp
                                            <script type="text/javascript">
                                                $(document).ready(function (e) {
                                                    @foreach($sizes as $size)
                                                        $("input.size[value={{ $size }}]").prop('checked', true);
                                                    @endforeach
                                                });
                                            </script>
                                        @endif
                                        @if($product->blade !=NULL)
                                            @php
                                                $blades=explode(',',$product->blade);
                                            @endphp
                                            <script type="text/javascript">
                                                $(document).ready(function (e) {
                                                    @foreach($blades as $blade)
                                                    $("input.blade[value={{ $blade }}]").prop('checked', true);
                                                    @endforeach
                                                });
                                            </script>
                                        @endif
                                        {{--                                <div class="form-group row">--}}
                                        {{--                                    {!! Form::label('name', 'Size', ['class' => 'col-sm-2']) !!}--}}
                                        {{--                                    <div class="col-sm-8">--}}
                                        {{--                                        @foreach($sizes as $size)--}}
                                        {{--                                            {!! Form::checkbox('sized[]',"$size->value",null,['class'=>'','id'=>'receiver']); !!} {{ $size->name }}&nbsp;--}}
                                        {{--                                        @endforeach--}}
                                        {{--                                    </div>--}}
                                        {{--                                </div>--}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="card card-info">
                        <div class="card-header">
                            SEO Information
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        {!! Form::label('name', 'Meta TAG', ['class' => 'col-sm-12 col-form-label']) !!}
                                        <div class="col-sm-12">
                                            @php
                                                $tags=\App\Models\ProductTag::where('product_id',$product->id)->join('tags', 'product_tags.tags_id', '=', 'tags.id')->get();
                                                $arra=[];
                                                foreach ($tags as $tag){
                                                    $arra[]=$tag->title;
                                                }
                                                //dd($arra)
                                            @endphp
                                            <input type="text" id="tag1" value="{{ implode(',',$arra ?? '') }}" class="form-control" name="tag"  />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        {!! Form::label('name', 'Meta Title', ['class' => 'col-sm-12 col-form-label']) !!}
                                        <div class="col-sm-12">
                                            {!! Form::text('meta_title', null, ['class'=>'form-control','id'=>'receiver']) !!}
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        {!! Form::label('name', 'Meta Keyword', ['class' => 'col-sm-12 col-form-label']) !!}
                                        <div class="col-sm-12">
                                            {!! Form::textarea('meta_keyword', null, ['class'=>'form-control','id'=>'receiver', 'rows' => 1]) !!}
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        {!! Form::label('name', 'Meta Description', ['class' => 'col-sm-12 col-form-label']) !!}
                                        <div class="col-sm-12">
                                            {!! Form::textarea('meta_description', null, ['class'=>'form-control','id'=>'receiver', 'rows'=>1]) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>


                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card-info">
                        <div class="card-body">
                            <div class="form-group row">
                                {!! Form::label('name', 'Status', ['class' => 'col-sm-12']) !!}
                                <div class="col-sm-12">
                                    {!! Form::select('status', ['Active' => 'Active','Pending' => 'Pending'],null,['class'=>'form-control','id'=>'receiver','required']); !!}
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-info">Update</button>
                            <button  onclick="window.history.back()" class="btn btn-danger float-right">Cancel</button>
                        </div>
                    </div>

                    <div class="card card-info">
                        <div class="card-body">
                            <div class="form-group row">
                                {!! Form::label('name', 'Category', ['class' => 'col-sm-12 col-form-label']) !!}
                                <div class="col-sm-12">
                                    {!! Form::select('category_id', ['0'=>'Select Category']+$parents,null,['class'=>'form-control','id'=>'parent_cat','required']); !!}
                                </div>
                            </div>
                            <div class="form-group row">
                                {!! Form::label('name', 'Sub Category', ['class' => 'col-sm-12 col-form-label']) !!}
                                <div class="col-sm-12">
                                    {!! Form::select('sub_category_id', ['0'=>'Sub Category']+$sub_cats,null,['class'=>'form-control','id'=>'sub_cat']); !!}
                                </div>
                            </div>
                            <div class="form-group row">
                                {!! Form::label('name', 'Spacial Category', ['class' => 'col-sm-12 col-form-label']) !!}
                                <div class="col-sm-12">
                                    {!! Form::select('spacialcat_id', ['0'=>'Category']+$spacials,null,['class'=>'form-control']); !!}
                                </div>
                            </div>
                            <div class="form-group row">
                                {!! Form::label('name', 'Brand', ['class' => 'col-sm-12 col-form-label']) !!}
                                <div class="col-sm-12">
                                    {!! Form::select('brand_id', ['0'=>'Select Brand']+$brands,null,['class'=>'form-control','id'=>'receiver']); !!}
                                </div>
                            </div>
                            <div class="form-group row">
                                {!! Form::label('name', 'Unit', ['class' => 'col-sm-12 col-form-label']) !!}
                                <div class="col-sm-12">
                                    {!! Form::select('unit_id', $units,null,['class'=>'form-control','id'=>'receiver']); !!}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card card-info">
                        <div class="card-header">
                            Featured Images
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    @if($product->images)
                                        <img id="preview-image-before-upload" src="{{ asset('public') }}/images/product/{{ $product->images }}"  style="width: 100%" class="img-thumbnail">
                                    @else
                                        <img id="preview-image-before-upload" src="{{ asset('public') }}/admin/notfindproduct.png"  style="width: 100%" class="img-thumbnail">
                                    @endif
                                        {!! Form::file('images', ['class'=>'form-control-file','id'=>'image']) !!}
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
            <!-- /.row (main row) -->
            {!! Form::close() !!}
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    <script src="{{ asset('public/admin') }}/js/jquery-1.11.2.min.js"></script>
    <script src="{{ asset('public/admin') }}/js/typeahead.js"></script>
    <script src="{{ asset('public/admin') }}/js/bootstrap-tagsinput.js"></script>
    <!-- /.content -->
    <script type="text/javascript">
        var data ='{!! json_encode($values) !!}';
        var countries = new Bloodhound({
            datumTokenizer: Bloodhound.tokenizers.obj.whitespace('text'),
            queryTokenizer: Bloodhound.tokenizers.whitespace,
            local: jQuery.parseJSON(data)
            {{--remote: {--}}
            {{--    url: '{{ route('madmin.tags') }}?q=%QUERY',--}}
            {{--    filter: function(list) {--}}
            {{--        return $.map(list, function(name) {--}}
            {{--            return { name: name }; });--}}
            {{--    }--}}
            {{--}--}}
        });
        countries.initialize();

        $('#tag1').tagsinput({
            typeaheadjs: {
                name: 'countries',
                displayKey: 'value',
                valueKey: 'value',
                source: countries.ttAdapter()
            }
        });
    </script>
@endsection
@section('script')
<script type="text/javascript">
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $("#parent_cat").change(function()
        {
          var id = $(this).val();
            $.ajax({
                  url: '{{ route('madmin.change_sub_category') }}',
                  type:'POST',
                  data :{ id:id, token: '{{csrf_token()}}' } ,
                  //dataType:'JSON',
                  success: function(responce){
                    $("#sub_cat").html("");
                    for(var i = 0; i < responce.length; i++)
                    {
                        console.log(responce[i].id);

                        $("#sub_cat").append("<option value="+responce[i].id+">"+responce[i].title+"</option>");
                    }
                  }
              });
        });

    $(document).ready(function() {
        $('#summernote').summernote();
        $('#summernote2').summernote();
        $('#summernote3').summernote();
    });
    $(document).ready(function (e) {
        $('#image').change(function(){
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#preview-image-before-upload').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        });
        const preview = (file) => {
            const fr = new FileReader();
            fr.onload = () => {
                const img = document.createElement("img");
                img.src = fr.result;  // String Base64
                img.alt = file.name;
                document.querySelector('#preview').append(img);
            };
            fr.readAsDataURL(file);
        };

        document.querySelector("#files").addEventListener("change", (ev) => {
            if (!ev.target.files) return; // Do nothing.
            [...ev.target.files].forEach(preview);
        });

    });
</script>
@endsection

