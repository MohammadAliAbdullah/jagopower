@extends('Admin.layouts.master')

@section('content')
    <script src="http://code.jquery.com/jquery-1.10.2.js"></script>  
    <script src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"> 
    <link rel="stylesheet" href="{{asset('public')}}/assets/css/bootstrap/css/bootstrap-tokenfield.min.css"> 

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Add Voucher</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('slide') }}">Voucher</a></li>
                        <li class="breadcrumb-item active">Add Voucher</li>
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
                    <div class="card card-info">
                    {{--                <div class="card-header">--}}
                    {{--                    <h3 class="card-title">Horizontal Form</h3>--}}
                    {{--                </div>--}}
                    <!-- /.card-header -->
                    @include('Admin.include.message')
                    <!-- form start -->
                        {!! Form::open(['method'=>'POST','route'=>'madmin.vouchers.store','class'=>'form-horizontal', 'files'=>true]) !!}
                        <div class="card-body">

                            <div class="form-group row">
                                {!! Form::label('name', 'Type', ['class' => 'col-sm-4 col-form-label']) !!}
                                <div class="col-sm-8">
                                    {{ Form::radio('type', 'Shop', true) }} Shop Voucher &nbsp;
                                    {{ Form::radio('type', 'Product', false) }} Product Voucher
                                </div>
                            </div>


                            <div class="form-group row to_change">
                                {!! Form::label('name', 'Voucher Name:', ['class' => 'col-sm-4 col-form-label']) !!}
                                <div class="col-sm-8">
                                    {!! Form::text('name', null, ['class'=>'form-control','id'=>'receiver','required']) !!}
                                </div>
                            </div>
                            

                            <div class="form-group row">
                                {!! Form::label('name', 'Code', ['class' => 'col-sm-4 col-form-label']) !!}
                                <div class="col-sm-8">
                                    {!! Form::text('code', null, ['class'=>'form-control','id'=>'receiver','required']) !!}
                                </div>
                            </div>

                            <div class="form-group row">
                                {!! Form::label('name', 'Start', ['class' => 'col-sm-4 col-form-label']) !!}
                                <div class="col-sm-8">
                                    {!! Form::text('startdate', null, ['class'=>'form-control','id'=>'startdate','required']) !!}
                                </div>
                            </div>

                            <div class="form-group row">
                                {!! Form::label('name', 'End', ['class' => 'col-sm-4 col-form-label']) !!}
                                <div class="col-sm-8">
                                    {!! Form::text('enddate', null, ['class'=>'form-control','id'=>'enddate','required']) !!}
                                </div>
                            </div>

                            <div class="form-group row">
                                {!! Form::label('name', 'Reword Type', ['class' => 'col-sm-4 col-form-label']) !!}
                                <div class="col-sm-8">
                                    {{ Form::radio('rewordtype', 'Discount', false) }} Discount &nbsp;
                                    {{ Form::radio('rewordtype', 'Cashback', false) }} Cashback
                                </div>
                            </div>

                            <div class="form-group row">
                                {!! Form::label('name', 'Discount Type | Amount', ['class' => 'col-sm-4 col-form-label']) !!}
                                <div class="col-sm-4">
                                    {!! Form::select('amount_type', ['Fix Amount' => 'Fix Amount','Percentage' => 'Percentage'],null,['class'=>'form-control','id'=>'receiver','required']) !!}
                                </div>
                                <div class="col-sm-4">
                                    {!! Form::text('discount_amount', null, ['class'=>'form-control','id'=>'receiver','required']) !!}
                                </div>
                            </div>

                            <div class="form-group row">
                                {!! Form::label('name', 'Minimum Basket Price', ['class' => 'col-sm-4 col-form-label']) !!}
                                <div class="col-sm-8">
                                    {!! Form::text('min_amount', null, ['class'=>'form-control','id'=>'receiver','required']) !!}
                                </div>
                            </div>

                            <div class="form-group row">
                                {!! Form::label('name', 'Voucher Quantiy', ['class' => 'col-sm-4 col-form-label']) !!}
                                <div class="col-sm-8">
                                    {!! Form::text('voucher_limit', null, ['class'=>'form-control','id'=>'receiver','required']) !!}
                                </div>
                            </div>

                            
                            

                            <div class="form-group row">
                                {!! Form::label('name', 'Status', ['class' => 'col-sm-4 col-form-label']) !!}
                                <div class="col-sm-8">
                                    {!! Form::select('status', ['Pending' => 'Pending','Ongoing' => 'Ongoing', 'Upcomming' => 'Upcomming'],null,['class'=>'form-control','id'=>'receiver','required']); !!}
                                </div>
                            </div>


                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">

                            <button type="submit" class="btn btn-info">Submit</button>
                            <button  onclick="window.history.back()" class="btn btn-default float-right">Cancel</button>
                        </div>
                        <!-- /.card-footer -->
                        {!! Form::close() !!}

                    </div>
                </div>

            </div>
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
@section('script')

<script src="{{asset('public')}}/assets/css/bootstrap/js/bootstrap-tokenfield.min.js"></script>

<script type="text/javascript">

    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $( function() {
        $( "#startdate" ).datepicker({
             dateFormat: 'y-m-d'
        });
      } );

    $( function() {
        $( "#enddate" ).datepicker({
             dateFormat: 'y-m-d'
        });
      } );

    var to_add = '<div class="form-group row manupulated_row">{!! Form::label("name", "Product", ["class" => "col-sm-4 col-form-label"]) !!}<div class="col-sm-8"><div class="row product_inc" style="margin-bottom:10px;"><div class="col-md-8">{!! Form::text("product_id[]", null, ["class"=>"form-control product_id","id"=>"receiver","required"]) !!}</div><div class="col-md-4 text-right"><a class="btn btn-danger remove_row">-</a></div></div><div class="text-right" ><br><a class="btn btn-primary" id="add_row_voucher">+Add</a></div></div></div>';

    $(document).on('change', 'input[type=radio][name=type]', function() {
        var manupulated_row = $('.manupulated_row');
        if (this.value == 'Shop') {
            manupulated_row.remove();
        }
        else if (this.value == 'Product') {
            if (manupulated_row.length < 1) {
                $(".to_change").before(to_add);
            };  
        }
    });


    $(document).on('click', '#add_row_voucher', function() {
        var product_inc = $(".product_inc").first();
        $(".product_inc").last().after(product_inc[0].outerHTML);
    });

    $(document).on('click', '.remove_row', function(){
        $(this).closest(".product_inc").remove();
    });

    $(document).on("keyup", '.product_id', function(){
        var search_term = $(this).val();
        $(this).autocomplete({
            source: function(request, response){
                $.ajax({
                    url: "{{ route('madmin.get_product_id') }}",
                    method: "POST",
                    dataType: "JSON",
                    data: { search_term:search_term, token: '{{csrf_token()}}' },
                    success: function(data){
                         response($.map(data, function (item) {
                            return {
                                label: item.title,
                                value: item.title
                            };
                        }));
                    }, 
                });
            },
        });
    });


    




</script>

@endsection
