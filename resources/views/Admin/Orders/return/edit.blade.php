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
                    <h1 class="m-0 text-dark">Add Add Invoice</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('slide') }}">Add Invoice</a></li>
                        <li class="breadcrumb-item active">Add Add Invoice</li>
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
                        @include('admin.include.message')
                        <!-- form start -->
                        {!! Form::model($order, ['method'=>'PATCH','route'=>['madmin.orderreturn.update',$order->id]]) !!}
                        <div class="card-body">
                            <div class="row text-center">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="item" class="">Product/Services</label>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="purchase_price" class="">Sales Price</label>
                                    </div>
                                </div>

                                <div class="col-md-1">
                                    <div class="form-group">
                                        <label for="qty" class="">Quantity</label>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="total" class="">Total</label>

                                    </div>
                                </div>
                                <hr>
                                <div class="col-md-1">

                                </div>

                            </div>
                            @foreach($values as $value)
                                    <?php
                                    $item = App\Models\Product::find($value->product_id);
                                    ?>
                                <div class="row main_row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input class="form-control item" value="{{ $item->title }}" id="item" type="text" name="title[]">
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <input class="form-control sales_price" value="{{ $value->price }}" id="sales_price" type="text" name="price[]">
                                        </div>
                                    </div>


                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <input class="form-control qty" value="{{ $value->qty }}" id="qty" type="text" name="qty[]">
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <input class="form-control total" value="{{ $value->total }}" id="total" type="text" name="total[]" readonly>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="col-md-1">
                                        <div class="form-group">
                                            {{--                                        <label for="action" class="small remove-label">Remove</label>--}}
                                            <div class="btn btn-danger remove_row" id="action" type="text">X</div>
                                        </div>
                                    </div>

                                </div>
                            @endforeach
                            <div class="row">
                                <div id="add_row" class="btn btn-success input_left">+Add</div>
                            </div><hr>
                            <div class="row">
                                <div class="col-md-5 offset-md-2">
                                    <div class="left-info">

                                        <div class="form-group form-inline">
                                            {!! Form::label('name', 'Invoice', ['class' => 'col-sm-4 small'])!!}
                                            <div class="col-sm-8">
                                                <input class="form-control input_left" id="invoice" type="text" name="invoice" value="{{$order->invoice_no}}" readonly>
                                            </div>
                                        </div>

                                        <div class="form-group form-inline">
                                            {!! Form::label('name', 'Challan', ['class' => 'col-sm-4 small'])!!}
                                            <div class="col-sm-8">
                                                <input class="form-control input_left" id="challan_no" type="text" name="challan_no" value="{{$order->callan_no}}" readonly>
                                            </div>
                                        </div>


                                        <div class="form-group row">
                                            {!! Form::label('name', 'Client Info', ['class' => 'col-sm-4 small'])!!}
                                            <div class="col-sm-8">
                                                <input class="form-control input_left" id="challan_no" type="text" name="client_id" value="{{$client->name}}" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="right-info">
                                        <div class="form-group form-inline">
                                            <label for="sub_total" class="small">Sub Total</label>&nbsp;
                                            <input class="form-control input_left" id="sub_total" type="text" name="sub_total" value="{{$order->subtotal}}">
                                        </div>

                                        <div class="form-group form-inline">
                                            <label for="discount" class="small">Discount</label>&nbsp;
                                            <input class="form-control input_left" id="discount"  type="text" name="discount" value="{{$order->discount}}">
                                        </div>

                                        <div class="form-group form-inline">
                                            <label for="vat" class="small">VAT (%)</label>&nbsp;
                                            <input class="form-control input_left" id="vat"  type="text" name="vat" value="{{$order->vat}}">
                                        </div>

                                        <div class="form-group form-inline">
                                            <label for="delivery_charge" class="small">Delivery Charge</label>&nbsp;
                                            <input class="form-control  input_left" id="delivery_charge" type="text" name="delivery_charge" value="{{$order->delivary_charge}}">
                                        </div>

                                        <div class="form-group form-inline">
                                            <label for="grand_total" class="small">Grand Total</label>&nbsp;
                                            <input class="form-control input_left" id="grand_total" type="text" name="grand_total" value="{{ $order->total }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 offset-md-2">
                                    <label for="note" class="text-right">Note:</label>&nbsp;
                                </div>
                                <div class="col-md-8 form-inline">
                                    {!! Form::textarea('note', null, ['class'=>'form-control input_left','id'=>'note','cols'=>'100', 'rows' => 5]) !!}
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">

                            <button  onclick="window.history.back()" class="btn btn-default">Cancel</button>
                            <button type="submit" class="btn btn-info  float-right">Update</button>
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

        $(document).ready(function(){
            $('#add_row').click(function(){
                var item_row = $(".main_row").first();
                $(".main_row").last().after(item_row[0].outerHTML);

            });

            $(document).on('click', '.remove_row', function(){
                $(this).closest(".main_row").remove();
            });

            $(document).on("keyup", '.item', function(){
                var search_term = $(this).val();
                var item_index = $('.item').index(this);
                localStorage.setItem("item_index",item_index);
                $(this).autocomplete({
                    source: function(request, response){
                        $.ajax({
                            url: "{{ route('madmin.get_sku_item') }}",
                            method: "POST",
                            dataType: "JSON",
                            data: { search_term:search_term, token: '{{csrf_token()}}' },
                            success: function(data){
                                response($.map(data, function (item) {
                                    return {
                                        label: item.value,
                                        value: item.value,
                                    };
                                }));
                            },

                        });
                    },
                });
            });

            $(document).on('click', '.ui-menu-item-wrapper', function(item_index){
                var product = $(this).text();
                var sales_index = localStorage.getItem("item_index");
                //var item_index = $('.item').index(this);
                //var sales_price = $('.sales_price').eq(qty_index).val();
                $.ajax({
                    url: "{{ route('madmin.get_price') }}",
                    method: "POST",
                    dataType: "JSON",
                    data: { search_term:product, token: '{{csrf_token()}}' },
                    success: function(data){
                        $(".sales_price")[sales_index].value = data;
                    },
                });
            });

            // suppliers_id auto complete
            $(document).on("keyup", '#suppliers_id', function(){
                var search_term = $(this).val();
                $(this).autocomplete({
                    source: function(request, response){
                        $.ajax({
                            url: "",
                            method: "POST",
                            dataType: "JSON",
                            data: { search_term:search_term, token: '{{csrf_token()}}' },
                            success: function(data){
                                //response(data);
                                response($.map(data, function (item) {
                                    return {
                                        label: item.company_name,
                                        value: item.company_name
                                    };
                                }));
                            },
                        });
                    },
                });
            });
            // count sub total
            function count_sub_total()
            {
                var class_total = $('.total');
                var total_price = 0;
                for(var i = 0; i < class_total.length; i++)
                {
                    if ($(class_total[i]))
                    {
                        total_price += parseFloat($(class_total[i]).val());
                    }
                }
                $('#sub_total').val(total_price);
            }

            function count_grand_total()
            {
                //var current_grand_total = $('#grand_total').val();
                var sub_total = parseFloat($('#sub_total').val());
                var discount = parseFloat($('#discount').val());
                var vat = parseFloat($('#vat').val());
                var total_vat = (sub_total * vat)/100;
                var delivery_charge = parseFloat($('#delivery_charge').val());

                var total = sub_total + total_vat + delivery_charge - discount;

                $('#grand_total').val(total);


            }

            // on keyup purchase price multiply with quantity & place to total.
            $(document).on("keyup", '.sales_price', function(){
                var sales_price = $(this).val();
                var pp_index = $('.sales_price').index(this);
                var qty = $('.qty').eq(pp_index).val();
                var total = sales_price * qty;
                $('.total')[pp_index].value = total;
                count_sub_total();
                count_grand_total();

            });

            // on keyup quantity  multiply with purchase price & place to total.
            $(document).on("keyup", '.qty', function(){
                var qty = $(this).val();
                var qty_index = $('.qty').index(this);
                var sales_price = $('.sales_price').eq(qty_index).val();
                var total = sales_price * qty;
                $('.total')[qty_index].value = total;
                count_sub_total();
                count_grand_total();
            });
            $(document).on("keyup", '#discount', function(){
                count_grand_total();
            });
            $(document).on("keyup", '#vat', function(){
                count_grand_total();
            });
            $(document).on("keyup", '#delivery_charge', function(){
                count_grand_total();
            });


            //add code above.
        });

        $( function() {
            $( "#order_date" ).datepicker();
        });

        $( function() {
            $( "#received_date" ).datepicker();
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
