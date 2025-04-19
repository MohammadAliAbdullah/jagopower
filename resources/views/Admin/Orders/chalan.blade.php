<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
@php
    $data=\App\Models\Order::where('invoice_no',$invoice_no)->first();
    $orders=\App\Models\OrderDetails::where('order_id',$data->id)->get();
@endphp
<head>
    <meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
    <title>Chalan {{ $data->callan_no }}</title>

    <meta name="msapplication-TileColor" content="#ffffff">

    <meta name="theme-color" content="#ffffff">
    <style>

        * { margin: 0; padding: 0; }
        body {
            font: 14px/1.4 Helvetica, Arial, sans-serif; background: url("{{ asset('public/images') }}/pad.png"); background-size:cover;
        }
        #page-wrap { width: 800px; margin: 0 auto; }

        textarea { border: 0; font: 14px Helvetica, Arial, sans-serif; overflow: hidden; resize: none; }
        table { border-collapse: collapse; }
        table td, table th { border: 1px solid black; padding: 5px; }

        #header { height: 15px; width: 100%; margin: 20px 0; background: #222; text-align: center; color: white; font: bold 15px Helvetica, Sans-Serif; text-decoration: uppercase; letter-spacing: 20px; padding: 8px 0px; }

        #address { width: 250px; height: 150px; float: left; }
        #customer { overflow: hidden; }

        #logo { text-align: right; float: right; position: relative; margin-top: 25px; border: 1px solid #fff; max-width: 540px; overflow: hidden; }
        #customer-title { font-size: 20px; font-weight: bold; float: left; }

        #meta { margin-top: 1px; width: 100%; float: right; }
        #meta td { text-align: right;  }
        #meta td.meta-head { text-align: left; background: #eee; }
        #meta td textarea { width: 100%; height: 20px; text-align: right; }

        #items { clear: both; width: 100%; margin: 30px 0 0 0; border: 1px solid black; }
        #items th { background: #eee; }
        #items textarea { width: 80px; height: 50px; }
        #items tr.item-row td {  vertical-align: top; }
        #items td.description { width: 300px; }
        #items td.item-name { width: 175px; }
        #items td.description textarea, #items td.item-name textarea { width: 100%; }
        #items td.total-line { border-right: 0; text-align: right; }
        #items td.total-value { border-left: 0; padding: 10px; }
        #items td.total-value textarea { height: 20px; background: none; }
        #items td.balance { background: #eee; }
        #items td.blank { border: 0; }

        #terms { text-align: center; margin: 20px 0 0 0; }
        #terms h5 { text-transform: uppercase; font: 13px Helvetica, Sans-Serif; letter-spacing: 10px; border-bottom: 1px solid black; padding: 0 0 8px 0; margin: 0 0 8px 0; }
        #terms textarea { width: 100%; text-align: center;}
        .printFooter{ width: 100%; text-align: center; color:#36F;}


        .delete-wpr { position: relative; }
        .delete { display: block; color: #000; text-decoration: none; position: absolute; background: #EEEEEE; font-weight: bold; padding: 0px 3px; border: 1px solid; top: -6px; left: -22px; font-family: Verdana; font-size: 12px; }
    </style>

</head>

<body>

<div>

    <table width="100%">
        <tr>
            <td style="border: 0;  text-align: left" width="62%">
                <span style="font-size: 40px; color: #2f4f4f"><!-- <strong>INVOICE</strong> --></span>
            </td>
            <td style="border: 0;  text-align: right" width="62%">
                <div id="logo" style="font-size:18px;">
                    <br>
                    <br>
                    <br>
                    <br> <br>

                    <!--<br /><b>Website:</b> www.my-softit.com </div></td>-->
        </tr>



    </table>

    <hr>
    <br>

    <div style="clear:both"></div>

    <div id="customer">

        <table id="meta">
            <tr>
                <td rowspan="5" style="border: 1px solid white; border-right: 1px solid black; text-align: left" width="62%">

                    <strong>Invoiced To</strong> <br>
                    <h3>{{ $data->customer->name }}</h3>
                    {{--                    ATTN: Md.Omar Faruqe <br>--}}
                    <br>
                    {{ $data->customer->address }}<br>
                    <b>Phone:</b> {{ $data->customer->phone }} <br>
                    <b>Email: {{ $data->customer->email }}</b>
                </td>
                <td class="meta-head">CHALLAN #</td>
                <td>{{ $data->callan_no }}</td>
            </tr>

            <tr>

                <td class="meta-head">Challan Date</td>
                <td>
                    {{ date("d-m-Y", strtotime($data->created_at)) }}
                </td>
            </tr>
        </table>

    </div>

    <table id="items">

        <tr>
            <th width="65%">Product</th>
            <th  align="right">Qty</th>
        </tr>
        @foreach($orders as $order)
            <tr class="item-row">
                <td class="description">
                    {{ $order->name }}
                </td>
                <td align="right">
                    {{ $order->qty }}
                </td>
            </tr>
        @endforeach
    </table>
</div>
<table border="0" style="width: 100%; margin-top:100px; border:none;">
    <tr>
        <td align="left" style="border:none;">
            <b>For – Customer :</b><br />
            <p>Received with thanks and all assigned task have been <br />completed successfully as per your requirements.</p>
        </td>
        <td align="right" style="border:none;">
            ....................................<br />
            <b>Manager Signature</b>
        </td>
    </tr>
</table>

<!-- <i style="font-size:14px; color:#666;"><strong>Address: </strong> 118/17, WEST SHEWRAPARA, MIRPUR, DHAKA-1216 <b>Email: </b> nasim@eskobd.com, tanbir_pshrd@yahoo.com</i> -->
</body>
</html>