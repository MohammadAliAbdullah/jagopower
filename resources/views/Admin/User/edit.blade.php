@extends('Admin.layouts.master')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Edit Admin</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('slide') }}">Admin</a></li>
                        <li class="breadcrumb-item active">Edit Admin</li>
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
                        {!! Form::model($value, [
                            'method' => 'PATCH',
                            'route' => ['madmin.adminuser.update', $value->id],
                            'class' => 'form-horizontal',
                        ]) !!}
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        {!! Form::label('name', 'Name', ['class' => 'col-sm-2 col-form-label']) !!}
                                        <div class="col-sm-10">
                                            {!! Form::text('name', null, [
                                                'class' => 'form-control col-sm-6',
                                                'id' => 'receiver',
                                                'required'
                                            ]) !!}
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        {!! Form::label('name', 'Email', ['class' => 'col-sm-2 col-form-label']) !!}
                                        <div class="col-sm-10">
                                            {!! Form::email('email', null, ['class' => 'form-control col-sm-6', 'id' => 'receiver', 'required']) !!}
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        {!! Form::label('name', 'Password', ['class' => 'col-sm-2 col-form-label']) !!}
                                        <div class="col-sm-10">
                                            {{-- {!! Form::password('passwords', null, ['class' => 'form-control col-sm-6', 'id' => 'receiver', 'required']) !!} --}}
                                            <input type="password" class="form-control col-sm-6" id="receiver" name="passwords" required>
                                        </div>
                                    </div>

                                    {{--                                        <div class="form-group row"> --}}
                                    {{--                                            {!! Form::label('name', 'Role', ['class' => 'col-sm-2']) !!} --}}
                                    {{--                                            <div class="col-sm-8"> --}}
                                    {{--                                                {!! Form::select('role_id', ['Admin' => 'Admin','Article' => 'Article Publisher'],null,['class'=>'form-control','id'=>'receiver','required']); !!} --}}
                                    {{--                                            </div> --}}
                                    {{--                                        </div> --}}

                                    <div class="form-group row" <?php echo ($value->id == 1 ? 'hidden' : ''); ?>>
                                        {!! Form::label('name', 'Status', ['class' => 'col-sm-2']) !!}
                                        <div class="col-sm-10">
                                            {!! Form::select('status', ['Active' => 'Active', 'Deactive' => 'Deactive'], null, [
                                                'class' => 'form-control col-sm-6',
                                                'id' => 'receiver',
                                                'required',
                                            ]) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-info">Update</button>
                            <button onclick="window.history.back()" class="btn btn-default float-right">Cancel</button>
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
