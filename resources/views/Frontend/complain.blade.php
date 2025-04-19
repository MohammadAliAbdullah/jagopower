@extends('Frontend.Layout.master')

@section('content')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    <style>
        .social-btn-sp #social-links {
            margin: 0 auto;
            max-width: 500px;
        }
        .social-btn-sp #social-links ul li {
            display: inline-block;
        }
        .social-btn-sp #social-links ul li a {
            padding: 15px;
            border: 1px solid #ccc;
            margin: 1px;
            font-size: 30px;
        }
        table #social-links{
            display: inline-table;
        }
        table #social-links ul li{
            display: inline;
        }
        table #social-links ul li a{
            padding: 5px 8px;
            /*border: 1px solid #ccc;*/
            margin: 1px;
            border-radius: 17px;
            font-size: 15px;
            background: #e3e3ea;
        }
        table #social-links ul li:first-child a{
            background: #024a84;
            color: #fff;
        }
        table #social-links ul li:nth-child(2) a{
            background: #2196f3;
            color: #fff;
        }
        table #social-links ul li:nth-child(3) a{
            background: #056fc3;
            color: #fff;
        }
        table #social-links ul li:nth-child(4) a{
            background: #4caf50;
            color: #fff;
        }

    </style>

    <!-- main-section-area-start -->

    <section>

        <div class="main-section-area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('ibrahim.index') }}">Home</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="#">Complain</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page"></li>
                            </ol>
                        </nav>
                    </div>
                </div>
                @if(session('status'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{session('status')}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                {{-- Error Alert --}}
                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{session('error')}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-header bg-dark">
                            <h2 class="text-center text-success">Complain Box</h2>
                        </div>
                        <div class="card-body bg-white">
                            {!! Form::open(['method'=>'POST','route'=>'complains.Store','class'=>'form-horizontal']) !!}
                            <div class="form-group row">
                                <div class="col-sm-6">
                                    {!! Form::label('name', 'Name', ['class' => 'col-form-label']) !!}
                                    {!! Form::text('name', null, ['class'=>'form-control','placeholder'=>'Please enter your name...','required']) !!}
                                </div>

                                <div class="col-sm-6">
                                    {!! Form::label('name', 'Phone Number', ['class' => 'col-form-label']) !!}
                                    {!! Form::text('phone', null, ['class'=>'form-control','placeholder'=>'i.e:01XXXXXXXX','required']) !!}
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6">
                                    {!! Form::label('name', 'Email', ['class' => 'col-form-label']) !!}
                                    {!! Form::text('email', null, ['class'=>'form-control','placeholder'=>'i.e:example@gmail.com','required']) !!}
                                </div>

                                <div class="col-sm-6">
                                    {!! Form::label('name', 'Subject', ['class' => 'col-form-label']) !!}
                                    {!! Form::text('subject', null, ['class'=>'form-control','placeholder'=>'i.e: I got some issue','required']) !!}
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-8">
                                    {!! Form::label('name', 'Complain', ['class' => 'col-form-label']) !!}
                                    {!! Form::textarea('complain', null, ['class'=>'form-control','placeholder'=>'Please enter your complain...','required','rows'=>3]) !!}
                                </div>
                                <div class="col-sm-4">
                                    {!! Form::label('name', 'Attachment File', ['class' => 'col-form-label']) !!}
                                    {!! Form::file('attachment', null, ['class'=>'form-control','placeholder'=>'i.e: I got some issue','required']) !!}
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-success text-right">Submit</button>
                                </div>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>


            </div>
        </div>

    </section>

    <!-- main-section-area-start -->

@endsection