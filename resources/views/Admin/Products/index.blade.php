@extends('Admin.layouts.master')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Products</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Products</a></li>
                        <li class="breadcrumb-item active">Product add</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        @include('Admin.include.message')
                        <div class="card-body p-0">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-7 ms-auto">
                                        <a href="{{ route('madmin.products.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i>
                                            Add</a>
                                    </div>
                                    <div class="col-md-5 ms-auto">
                                        <form action="{{ route('madmin.products.index') }}" method="GET">
                                            <div class="input-group">
                                                <input type="text" name="search" class="form-control"
                                                    placeholder="Search by title or slug" value="{{ request('search') }}">
                                                <div class="input-group-append">
                                                    <button class="btn btn-outline-primary" type="submit">Search</button>
                                                    <a href="{{ route('madmin.products.index') }}" class="btn btn-outline-danger">clear</a>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>


                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th>SI</th>
                                        <th>Title</th>
                                        <th>Slug</th>
                                        <th>Thumb</th>
                                        <th>Category</th>
                                        <th>Brand</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                    @foreach ($products as $value)
                                        <tr>
                                            <td>{{ $value->id }}</td>
                                            <td>{{ $value->title }}</td>
                                            <td>
                                                {{ $value->slug }}
                                            </td>
                                            <td>
                                                <img src="{{ asset('public/images/product/' . $value->thumb) }}"
                                                    width="80" height="60">
                                            </td>
                                            <td>
                                                {{ $value->category->title ?? 'N/A' }} >
                                            </td>
                                            <td>{{ $value->brand->title ?? 'N/A' }}</td>
                                            <td>
                                                @if ($value->status == 'Active')
                                                    <span class="bg bg-primary p-2" style="border-radius:10px;">
                                                        {{ $value->status }}
                                                    </span>
                                                @else
                                                    <span class="bg bg-danger p-2" style="border-radius:10px;">
                                                        {{ $value->status }}
                                                    </span>
                                                @endif
                                            </td>
                                            <td>{{ $value->created_at->diffForHumans() }} </td>
                                            <td>
                                                <div class="row">
                                                    <a href="{{ route('madmin.products.edit', $value->id) }}"
                                                        class="btn btn-success m-1"><i class="fa fa-pen"></i> </a>
                                                    {!! Form::open(['method' => 'DELETE', 'route' => ['madmin.products.destroy', $value->id]]) !!}
                                                    <button type="submit" value="Delete" class="btn btn-danger m-1"
                                                        onclick="return confirm('Do you want to Delete')">X</button>
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
                            {{-- {{ $products->render() }} --}}
                            {{ $products->appends(request()->query())->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
