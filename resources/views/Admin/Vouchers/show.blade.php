@extends('Admin.layouts.master')

@section('content')
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Voucher</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Voucher details</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">



            <!-- Main content -->
            <div class="invoice p-3 mb-3">
              <!-- title row -->
              <div class="row">
                <div class="col-12">
                    <div class="float-left">
                      <h4><i class="fas fa-tags"></i>&nbsp; {{ $voucher->name }}</h4>
                      <div>
                        <small ><b>Voucher Type:</b> {{ $voucher->type }}</small><br>
                        <small ><b>Voucher Code:</b> {{ $voucher->code }}</small><br>
                        <small ><b>Reword Type:</b> {{ $voucher->rewordtype }}</small><br>
                        <small ><b>Amount Type:</b> {{ $voucher->amount_type }}</small><br>
                        <small ><b>Discount Amount:</b> {{ $voucher->discount_amount }}</small><br>
                        <small ><b>Minimum spend:</b> {{ $voucher->min_amount }}</small><br>
                        <small ><b>Voucher Limit:</b> {{ $voucher->voucher_limit }}</small><br>
                      </div>
                    </div>
                    
                    <div class="float-right">
                      <small >Start Date: {{ $voucher->startdate }}</small><br>
                      <small >End Date: {{ $voucher->enddate }}</small>
                    </div>
                  
                </div>
                <!-- /.col -->
              </div><hr>

              <!-- Table row -->
              <div class="row">
                <div class="col-12 table-responsive">
                  @if($voucher->type == "Product")

                    <table class="table table-striped">
                      <thead>
                      <tr>
                        <th>Product</th>
                        <th>Image</th>
                        <th>SKU</th>
                        <th>Regular Price</th>
                        <th>Sales price</th>
                      </tr>
                      </thead>
                      <tbody>
                        @foreach($product_id as $pid)
                          <?php 
                            $product = \App\Models\Product::where('id', $pid)->first();
                          ?>
                          
                          <tr>
                            <td>{{ $product->title }}</td>
                            <td><img width="120px" height="90px;" src="{{ asset('public/images/product/'.$product->images) }}"></td>
                            <td>{{ $product->sku }}</td>
                            <td>{{ $product->productstock->ragular_price }}</td>
                            <td>{{ $product->productstock->sales_price }}</td>
                          </tr>
                          
                        @endforeach
                      </tbody>
                    </table>

                  @endif
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              
            </div>
            <!-- /.invoice -->
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
   
@endsection

