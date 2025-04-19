@extends('Admin.layouts.master')

@section('content')
    <script src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"> 

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Add Campaign </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('slide') }}">Campaign </a></li>
                        <li class="breadcrumb-item active">Add Campaign </li>
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
                        {!! Form::open(['method'=>'POST','route'=>'madmin.flashdealadmin.store','class'=>'col-sm-10 form-horizontal', 'files'=>true]) !!}
                        <div class="card-body">

                            <div class="form-group row">
                                {!! Form::label('name', 'Title:', ['class' => 'col-sm-3 col-form-label']) !!}
                                <div class="col-sm-9">
                                    {!! Form::text('title', null, ['class'=>'form-control','id'=>'receiver','required']) !!}
                                </div>
                            </div>

                            <div class="form-group row">
                                {!! Form::label('name', 'Date', ['class' => 'col-sm-3 col-form-label']) !!}
                                <div class="col-sm-9">
                                    {!! Form::text('date', null, ['class'=>'form-control','id'=>'reservationtime','required']) !!}
                                </div>
                            </div>

                            <div class="form-group row">
                                {!! Form::label('name', 'Background Color', ['class' => 'col-sm-3 col-form-label']) !!}
                                <div class="col-sm-9">
                                    {!! Form::text('bgcolor', null, ['class'=>'form-control my-colorpicker1 colorpicker-element','required']) !!}
                                </div>
                            </div>

                            <div class="form-group row">
                                {!! Form::label('name', 'Text Color', ['class' => 'col-sm-3 col-form-label']) !!}
                                <div class="col-sm-9">
                                    {!! Form::text('textcolor', null, ['class'=>'form-control my-colorpicker2 colorpicker-element','required']) !!}
                                </div>
                            </div>

                            <div class="form-group row">
                                {!! Form::label('name', 'Banar', ['class' => 'col-sm-3 col-form-label']) !!}
                                <div class="col-sm-9">
                                    {!! Form::file('banar', null, ['class'=>'form-control','required']) !!}
                                </div>
                            </div>
                            

                            <div class="form-group row">
                                {!! Form::label('name', "Product", ['class' => 'col-sm-4 col-form-label']) !!}
                                <div class="col-sm-8">
                                    <div class="row product_inc" style="margin-bottom:10px;">
                                        <div class="col-md-8">
                                        {!! Form::text('product_id[]', null, ['class'=>'form-control product_id','id'=>'receiver','required']) !!}
                                        </div>
                                        <div class="col-md-4 text-right">
                                            <a class="btn btn-danger remove_row">-</a>
                                        </div>

                                    </div>
                                
                                    <div class="text-right" ><br>
                                        <a class="btn btn-primary " id="add_row_discount">+Add</a>
                                    </div>
                                </div>    
                            </div>

                            <div class="form-group row">
                                {!! Form::label('name', 'Amount', ['class' => 'col-sm-3 col-form-label']) !!}
                                <div class="col-sm-9">
                                    {!! Form::number('amount', null, ['class'=>'form-control','id'=>'receiver','required']) !!}
                                </div>
                            </div>

                            <div class="form-group row">
                                {!! Form::label('name', 'Type', ['class' => 'col-sm-3 col-form-label']) !!}
                                <div class="col-sm-9">
                                    {!! Form::select('type', ['Taka' => 'Taka','Percent' => 'Percent'],null,['class'=>'form-control','id'=>'receiver','required']); !!}
                                </div>
                            </div>
                            

                            <div class="form-group row">
                                {!! Form::label('name', 'Status', ['class' => 'col-sm-3 col-form-label']) !!}
                                <div class="col-sm-9">
                                    {!! Form::select('status', ['Pending' => 'Pending','Active' => 'Active', 'Upcomming' => 'Upcomming'],null,['class'=>'form-control','id'=>'receiver','required']); !!}
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
                                value: item.title
                            };
                        }));
                    }, 
                });
            },
        });
    });
    //$('#reservationtime').daterangepicker({ timePicker: true, timePickerIncrement: 30, format: 'DD/MM/YYYY h:mm A' })
    //Date range as a button
    // $('#reservationtime').daterangepicker(
    //     {
    //         ranges   : {
    //             'Today'       : [moment(), moment()],
    //             'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
    //             'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
    //             'Last 30 Days': [moment().subtract(29, 'days'), moment()],
    //             'This Month'  : [moment().startOf('month'), moment().endOf('month')],
    //             'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
    //         },
    //         startDate: moment().subtract(29, 'days'),
    //         endDate  : moment()
    //     },
    //     function (start, end) {
    //         $('#daterange-btn span').html(start.format('D MMMM, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
    //     }
    // )
    $('#reservationtime').daterangepicker({
        "showDropdowns": true,
        "minYear": 2020,
        "maxYear": 2030,
        "timePicker": true,
        "autoApply": true,

        "locale": {
            "format": "MM/DD/YYYY HH:mm",
            "separator": " to ",
            "applyLabel": "Apply",
            "cancelLabel": "Cancel",
            "fromLabel": "From",
            "toLabel": "To",
            "customRangeLabel": "Custom",
            "weekLabel": "W",
            "daysOfWeek": [
                "Su",
                "Mo",
                "Tu",
                "We",
                "Th",
                "Fr",
                "Sa"
            ],
            "monthNames": [
                "January",
                "February",
                "March",
                "April",
                "May",
                "June",
                "July",
                "August",
                "September",
                "October",
                "November",
                "December"
            ],
            "firstDay": 1
        },
        "alwaysShowCalendars": true,
    }, function(start, end, label) {
        console.log('New date range selected: ' + start.format('YYYY-MM-DD HH:mm') + ' to ' + end.format('YYYY-MM-DD HH:mm') + ' (predefined range: ' + label + ')');
    });
    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

</script>

@endsection
