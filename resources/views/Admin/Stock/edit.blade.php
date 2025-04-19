@extends('Admin.layouts.master')

@section('content')
      <script src="http://code.jquery.com/jquery-1.10.2.js"></script>  
      <script src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"> 
        <link rel="stylesheet" href="/resources/demos/style.css">
 <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Adjustment
                        <a href="{{ route('madmin.adjustment.add') }}" class="btn btn-primary">Adjustment edit</a>
                    </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Adjustment</a></li>
                        <li class="breadcrumb-item active">Adjustment edit</li>
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
                        @include('Admin.include.message')
                        <!-- form start -->
                        {!! Form::open(['method'=>'POST','route'=>['madmin.adjustment.update', 'id' => $adjustment->id],'class'=>'form-horizontal', 'files'=>true]) !!}
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-8">

                                    <div class="form-group row">
                                        <label for="product" class="small col-md-4">Product</label>&nbsp;
                                        <input class="form-control input_left  col-md-8" id="product" value="{{$adjustment->product->title}}" type="text" name="product">
                                    </div>

                                    <div class="form-group form-inline">
                                        <label for="sku" class="small">Sku</label>&nbsp;
                                        <input readonly class="form-control input_left" id="sku" value="{{$adjustment->sku}}" type="text" name="sku">
                                    </div>

                                    <div class="form-group form-inline">
                                        <label for="action_qty" class="small">Action Qty</label>&nbsp;
                                        <input class="form-control input_left" id="action_qty" value="{{$adjustment->action_qty}}" type="text" name="action_qty">
                                    </div>

                                    

                                </div>
                                <div class="col-md-4">
                                    
                                    <div class="form-group form-inline">
                                        <label for="sized" class="small">Sized</label>&nbsp;
                                        <input class="form-control input_left" id="sized" value="{{$adjustment->sized}}" type="text" name="sized">
                                    </div>

                                    <div class="form-group form-inline">
                                        <label for="stock_qty" class="small">Stock Qty</label>&nbsp;
                                        <input readonly class="form-control input_left" id="stock_qty" value="{{$adjustment->stock_qty}}" type="text" name="stock_qty">
                                    </div>

                                    <div class="form-group form-inline">
                                        <label for="type" class="small">Type</label>&nbsp;
                                        <select name="type" id="type" class="form-control input_left">
                                            <option {{ $adjustment->type=='In'?'selected':'' }} value="In">In</option>
                                            <option {{ $adjustment->type=='Out'?'selected':'' }} value="Out">Out</option>
                                            <option {{ $adjustment->type=='Damage'?'selected':'' }} value="Damage">Damage</option>
                                        </select>
                                    </div>

                                    <div class="form-group form-inline">
                                        <label for="status" class="small">Status</label>&nbsp;
                                        <select name="status" id="status" class="form-control input_left">
                                            <option {{ $adjustment->status=='Active'?'selected':'' }} value="Active">Active</option>
                                            <option {{ $adjustment->status=='Pending'?'selected':'' }} value="Pending">Pending</option>
                                        </select>
                                    </div>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group form-inline">
                                        <label for="note" class="small">Note</label>&nbsp;
                                        <textarea class="form-control input_left" cols="60" id="note" type="text" name="note">{{$adjustment->note}}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-info">Submit</button>
                            <button  onclick="window.history.back()" class="btn btn-default float-right">Cancel</button>
                        </div>
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
    $(document).on("keyup", '#product', function(){
        var search_term = $(this).val();
        $("#product").autocomplete({
            source: function(request, response){
                $.ajax({
                    url: "{{ route('madmin.get_adjustment_sku') }}",
                    method: "POST",
                    dataType: "JSON",
                    data: { search_term:search_term, token: '{{csrf_token()}}' },
                    success: function(data){
                        //response(data);
                         response($.map(data, function (item) {
                            return {
                                label: item.title,
                                pass_val: item.sku, 
                            };

                        }));
                    }, 
                });
            },
            select: function (event, ui) {
                var label = ui.item.label;
                var sku = ui.item.pass_val;
                $('#sku').val(sku);
                $.ajax({
                    url: "{{ route('madmin.get_adjustment_qty') }}",
                    method: "POST",
                    dataType: "JSON",
                    data: { sku:sku, token: '{{csrf_token()}}' },
                    success: function(data){
                        $('#stock_qty').val(data);
                    }, 
                });
            },
        });
    });
</script>
@endsection

@section("style")
    <style type="text/css">
        .input_left{
            margin-left: auto;
        }
    </style>
@endsection