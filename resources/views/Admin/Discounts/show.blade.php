@extends('Admin.layouts.master')

@section('content')
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Discount</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Discount details</li>
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
                  <h4>
                    <i class="fas fa-tags"></i>&nbsp; {{ $discount->discount_name }}
                    <small class="float-right text-bold">Start Date: {{ $discount->start_date }}</small><br>
                    <small class="float-right text-bold">End Date: {{ $discount->end_date }}</small>
                  </h4>
                </div>
                <!-- /.col -->
              </div>
              <!-- <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                  From
                  <address>
                    adress
                  </address>
                </div>
                <div class="col-sm-4 invoice-col">
                  
                </div>
                <div class="col-sm-4 invoice-col">
                  <b>Purchase </b><br>
                  <br>
                  <b>Order date:</b>&nbsp;<br>
                  <b>Received date:</b>&nbsp;<br>
                  
                </div>
              </div> -->
              <!-- /.row -->

              <!-- Table row -->
              <div class="row">
                <div class="col-12 table-responsive">
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

