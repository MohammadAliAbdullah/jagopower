@extends('Admin.layouts.master')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Review
                        <a href="#" class="btn btn-primary">Review Add</a>
                    </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Review</a></li>
                        <li class="breadcrumb-item active">Review add</li>
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
                    <div class="card">
                    {{--                        <div class="card-header">--}}
                    {{--                            <h3 class="card-title">Condensed Full Width Table</h3>--}}
                    {{--                        </div>--}}
                    <!-- /.card-header -->

                        @include('Admin.include.message')
                        <div class="card-body p-0">
                            <table class="table table-bordered">
                                <tbody>
                                <tr>
                                    <th>SI</th>
                                    <th>CustomerID</th>
                                    <th>Product</th>
                                    <th>Review</th>
                                    <th>Reply</th>
                                    <th>Rating</th>
                                    <th>Status</th>
                                    
                                    <th>Date</th>
                                    <th width="250">Action</th>
                                </tr>
                                @foreach($reviews as $value)
                                <?php 
                                $product = \App\Models\Product::findOrFail($value->product_id); 
                                $customer = \App\Models\Customer::findOrFail($value->customer_id); 
                                $review_reply = \App\Models\ReviewReply::where('review_id', $value->id)->first(); 

                                ?>
                                    <tr>
                                        <td>{{ $value->id }}</td>
                                        <td>{{ $customer->name }}</td>
                                        <td>{{ $product->title }}</td>
                                        <td>{{ $value->content }}</td>
                                        <td>{{ $review_reply ? $review_reply->content : "" }}</td>
                                        <td>{{ $value->rating }}</td>
                                        <td>{{ $value->status }}</td>
                                        
                                        <td>{{ $value->created_at->diffForHumans() }} </td>

                                        <td>
                                            <div class="row">
                                                    <a href="{{route('madmin.review_reply',$value->id)}}" class="btn btn-success m-1">{!! !empty($review_reply) ? '<i class="fa fa-pen"></i>': "Reply" !!} </a>
                                                    {!! Form::open(['method'=>'DELETE','route'=>['madmin.contacts.destroy',$value->id]]) !!}
                                                    <button type="submit" value="Delete" class="btn btn-danger m-1" onclick="return confirm('Do you want to Delete')">X</button>
                                                    {!! Form::close() !!}

                                            </div>
                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>

                        </div>
                        <!-- /.card-body -->
                    </div>
                    <div class="row">
                        <div class="col-md-6 offset-md-2 m-0 float-right">
                            {{ $reviews->render() }}
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
