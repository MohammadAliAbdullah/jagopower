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
                    <h1 class="m-0 text-dark">Create Invoice</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('slide') }}">Invoice</a></li>
                        <li class="breadcrumb-item active">Create Invoice</li>
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
                        {!! Form::model($order, ['method'=>'PATCH','route'=>['madmin.local-sale.update', $order->id],'class'=>'form-horizontal', 'files'=>true]) !!}
                        <div class="card-body">
                            <table class="table">
                              <thead>
                                <tr>
                                  <th scope="col">Item</th>
                                  <th scope="col">Colored</th>
                                  <th scope="col">Sized</th>
                                  <th scope="col">Sales price</th>
                                  <th scope="col">Quantity</th>
                                  <th scope="col">Total</th>
                                </tr>
                              </thead>
                              <tbody>
                                @foreach($order_details as $details)
                                <?php 
                                    $item = App\Models\Product::find($details->product_id);
                                ?>
                                <tr class='main_row'>
                                  <th><input class="item" id="item" type="text" name="item[]" value="{{ $item->title }}"></th>
                                  <td>
                                    <select class="colored" id="colored" type="text" name="colored[]">
                                        <option value="">Color</option>
                                        @foreach($colors as $color)
                                            <option value="{{ $color->value }}"  {{ $details->colored == $color->value ?"selected":"" }}>{{$color->name}}</option>
                                        @endforeach
                                    </select>
                                  </td>
                                  <td>
                                    <select class=" sized" id="sized" type="text" name="sized[]">
                                        <option value="">Size</option>
                                        @foreach($sizes as $size)
                                            <option value="{{ $size->value }}" {{ $details->sized == $size->value ?"selected":"" }}>{{$size->name}}</option>
                                        @endforeach
                                    </select>
                                  </td>
                                  <td><input class="sales_price" id="sales_price" type="text" name="sales_price[]" value="{{ $details->price }}"></td>
                                  <td><input class=" qty" id="qty" type="text" name="qty[]" value="{{ $details->qty }}" ></td>
                                  <td><input class="total" id="total" type="text" name="total[]" value="{{ $details->total }}"></td>
                                  <td><div class="btn btn-danger remove_row" id="action" type="text">X</div></td>
                                </tr>
                                @endforeach
                              </tbody>
                            </table>
                            
                            <div class="row">
                                <div id="add_row" class="btn btn-success input_left">+Add</div>
                            </div><hr>
                           

                            <div class="row">
                                <div class="col-md-6 ">
                                   <div class="left-info">

                                        <div class="form-group form-inline">
                                            <label for="invoice" class="small">Invoice</label>&nbsp;
                                            <input class="input_left" id="invoice" type="text" name="invoice" value="{{$order->invoice_no}}">
                                        </div>

                                        <div class="form-group form-inline">
                                            <label for="challan_no" class="small">Challan</label>&nbsp;
                                            <input class=" input_left" id="challan_no" type="text" name="challan_no" value="{{$order->callan_no}}">
                                        </div>

                                        <div class="form-group form-inline">
                                            <label for="customer_id" class="small">Customer name</label>&nbsp;
                                            <select class="customer_id" id="customer_id" type="text" name="customer_id">
                                                <option value="">Select customer</option>
                                                @foreach($customers as $customer)
                                                <option value="{{ $customer->id }}" {{ $customer->id == $order->customer_id ?"selected":"" }}>{{ $customer->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>  
                                   </div>
                                </div>

                                <div class="col-md-6">
                                    
                                    <div class="right-info">
                                        <div class="form-group form-inline">
                                        <label for="sub_total" class="small">Sub Total</label>&nbsp;
                                        <input class="input_left" id="sub_total" type="text" name="sub_total" value="{{$order->subtotal}}">
                                    </div>

                                    <div class="form-group form-inline">
                                        <label for="discount" class="small">Discount</label>&nbsp;
                                        <input class="input_left" id="discount"  type="text" name="discount" value="{{$order->discount}}">
                                    </div>

                                    <div class="form-group form-inline">
                                        <label for="vat" class="small">VAT (%)</label>&nbsp;
                                        <input class="input_left" id="vat"  type="text" name="vat" value="{{$order->vat}}">
                                    </div>

                                    <div class="form-group form-inline">
                                        <label for="delivery_charge" class="small">Delivery Charge</label>&nbsp;
                                        <input class=" input_left" id="delivery_charge" type="text" name="delivery_charge" value="{{$order->delivary_charge}}">
                                    </div>

                                    <div class="form-group form-inline">
                                        <label for="grand_total" class="small">Grand Total</label>&nbsp;
                                        <input class="input_left" id="grand_total" type="text" name="grand_total" value="{{ $order->total }}">
                                    </div>


                                   

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

        $(document).ready(function(){
            $('#add_row').click(function(){
                var item_row = $(".main_row").first();
                $(".main_row").last().after(item_row[0].outerHTML);
                $(".main_row").last().find('input').val("");

            });

            $(document).on('click', '.remove_row', function(){
                $(this).closest(".main_row").remove();
            });

            $(document).on("keyup", '.item', function(){
                var search_term = $(this).val();
                $(this).autocomplete({
                    source: function(request, response){
                        $.ajax({
                            url: "{{ route('madmin.get_sku_item') }}",
                            method: "POST",
                            dataType: "JSON",
                            data: { search_term:search_term, token: '{{csrf_token()}}' },
                            success: function(data){
                                //response(data);
                                 response($.map(data, function (item) {
                                    return {
                                        label: item.value,
                                        value: item.value
                                    };
                                }));
                            }, 
                        });
                    },
                });
            });
            // suppliers_id auto complete 
            $(document).on("keyup", '#suppliers_id', function(){
                var search_term = $(this).val();
                $(this).autocomplete({
                    source: function(request, response){
                        $.ajax({
                            url: "{{ route('madmin.get_supplier') }}",
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
                        total_price += parseInt($(class_total[i]).val());    
                    }
                }
                $('#sub_total').val(total_price);
            }

            function count_grand_total()
            {
                //var current_grand_total = $('#grand_total').val();
                var sub_total = parseInt($('#sub_total').val());
                var discount = parseInt($('#discount').val());
                var vat = parseInt($('#vat').val());
                var total_vat = (sub_total * vat)/100;
                var delivery_charge = parseInt($('#delivery_charge').val());

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
        #add_row {
            margin-right: 20px;
        }
    </style>
    
@endsection