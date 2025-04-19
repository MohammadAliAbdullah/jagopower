@extends('Admin.layouts.master')

@section('content')
    <script src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"> 

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Add Discount</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('slide') }}">Discount</a></li>
                        <li class="breadcrumb-item active">Add Discount</li>
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
                        {!! Form::model($discount, ['method'=>'PATCH','route'=>['madmin.discounts.update', $discount->id],'class'=>'form-horizontal', 'files'=>true]) !!}
                        <div class="card-body">

                            <div class="form-group row">
                                {!! Form::label('name', 'Discount Name:', ['class' => 'col-sm-4 col-form-label']) !!}
                                <div class="col-sm-8">
                                    {!! Form::text('discount_name', null, ['class'=>'form-control','id'=>'receiver','required']) !!}
                                </div>
                            </div>

                            <div class="form-group row">
                                {!! Form::label('name', 'Start', ['class' => 'col-sm-4 col-form-label']) !!}
                                <div class="col-sm-8">
                                    {!! Form::text('start_date', null, ['class'=>'form-control','id'=>'startdate','required']) !!}
                                </div>
                            </div>

                            <div class="form-group row">
                                {!! Form::label('name', 'End', ['class' => 'col-sm-4 col-form-label']) !!}
                                <div class="col-sm-8">
                                    {!! Form::text('end_date', null, ['class'=>'form-control','id'=>'enddate','required']) !!}
                                </div>
                            </div>
                            

                            <div class="form-group row">
                                {!! Form::label('name', "Product", ['class' => 'col-sm-4 col-form-label']) !!}
                                <div class="col-sm-8">
                                    @foreach($product_ids as $id)
                                        <div class="row product_inc" style="margin-bottom:10px;">
                                            <div class="col-md-8">
                                            {!! Form::text('product_id[]', $id, ['class'=>'form-control product_id','id'=>'receiver','required']) !!}
                                            </div>
                                            <div class="col-md-4 text-right">
                                                <a class="btn btn-danger remove_row">-</a>
                                            </div>

                                        </div>
                                    @endforeach
                                    <div class="text-right" ><br>
                                        <a class="btn btn-primary" id="add_row_discount">+Add</a>
                                    </div>
                                    
                                </div>
                                
                            </div>

                            <div class="form-group row">
                                {!! Form::label('name', 'Discount Quantiy', ['class' => 'col-sm-4 col-form-label']) !!}
                                <div class="col-sm-8">
                                    {!! Form::text('limit_qty', null, ['class'=>'form-control','id'=>'receiver','required']) !!}
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

    
    $('#add_row_discount').click(function(){
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
                    url: "{{ route('madmin.get_discount_product_id') }}",
                    method: "POST",
                    dataType: "JSON",
                    data: { search_term:search_term, token: '{{csrf_token()}}' },
                    success: function(data){
                        //response(data);
                         response($.map(data, function (item) {
                            return {
                                label: item.title,
                                value: item.id
                            };
                        }));
                    }, 
                });
            },
        });
    });



</script>

@endsection
