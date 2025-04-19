<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
@php
$data=\App\Models\Order::where('invoice_no',$invoice_no)->first();
$orders=\App\Models\OrderDetails::where('order_id',$data->id)->get();
@endphp
<head>
    <meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
    <title>INVOICE {{ $data->invoice_no }}</title>

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
                <td class="meta-head">INVOICE #</td>
                <td>{{ $data->invoice_no }}</td>
            </tr>

            <tr>

                <td class="meta-head">Invoice Date</td>
                <td>
                    {{ date("d-m-Y", strtotime($data->created_at)) }}
                </td>
            </tr>
{{--            <tr>--}}

{{--                <td class="meta-head">Courier</td>--}}
{{--                <td>--}}
{{--                    DHL--}}
{{--                </td>--}}
{{--            </tr>--}}
{{--            <tr>--}}

{{--                <td class="meta-head">Delivery Type</td>--}}
{{--                <td>--}}
{{--                    Home Delivary--}}
{{--                </td>--}}
{{--            </tr>--}}
            <tr>

                <td class="meta-head">Total Bill</td>
                <td>
                    <div class="due">
                        {{ $data->total }} Tk
                    </div>
                </td>
            </tr>

        </table>

    </div>

    <table id="items">

        <tr>
            <th width="65%">Product</th>
            <th  align="right">Qty</th>
            <th align="right"> Unit price</th>
            <th align="right">Total Price</th>
        </tr>
        @foreach($orders as $order)
        <tr class="item-row">
            <td class="description">
                {{ $order->name }}
            </td>
            <td align="right">
                {{ $order->qty }}
            </td>
            <td align="right">
                {{ $order->price }} Tk
            </td>
            <td align="right">
                <span class="price">
                     {{ $order->total }} Tk
                </span>
            </td>
        </tr>
        @endforeach


        <tr>
            <td class="blank"> </td>
            <td colspan="2" class="total-line">Sub Total:</td>
            <td class="total-value">
                <div id="subtotal">
                    {{ $data->subtotal }} Tk
                </div>
            </td>
        </tr>
        <tr>
            <td class="blank"> </td>
            <td colspan="2" class="total-line">Discount (<?php //$value->discount;?> Tk):</td>
            <td class="total-value">
                <div id="subtotal">
                    @if($data->discount !=NULL)
                    {{ $data->discount }} Tk
                    @else
                    0 Tk
                    @endif
                </div>
            </td>
        </tr>
        <tr>
            <td class="blank"> </td>
            <td colspan="2" class="total-line">VAT (0 %):</td>
            <td class="total-value">
                <div id="subtotal">
                    @if($data->vat !=NULL)
                        {{ $data->vat }} Tk
                    @else
                        0 Tk
                    @endif
                </div>
            </td>
        </tr>
        <tr>
            <td class="blank"> </td>
            <td colspan="2" class="total-line">Delivary Charge:</td>
            <td class="total-value">
                @if($data->delivary_charge !=NULL)
                    {{ $data->delivary_charge }} Tk
                @else
                    0 Tk
                @endif
            </td>
        </tr>
{{--        <tr>--}}
{{--            <td class="blank"> </td>--}}
{{--            <td colspan="2" class="total-line">COD Charge:</td>--}}
{{--            <td class="total-value">--}}
{{--                20 tk--}}
{{--            </td>--}}
{{--        </tr>--}}
        <tr>
            <td class="blank"> </td>
            <!-- <td colspan="2" class="total-line balance">Amount Due</td> -->
            <td colspan="2" class="total-line balance">Total Invoice:</td>
            <td class="total-value balance"><div class="due">
                    {{ $data->total }} Tk
                </div></td>
        </tr>

{{--        <tr>--}}
{{--            <td class="blank"> </td>--}}
{{--            <td colspan="2" class="total-line">Total Paid:</td>--}}
{{--            <td class="total-value">--}}
{{--                <div class="due"> 1000 tk<?php--}}
{{--                    ///$row = $this->db->query('SELECT SUM(`payment`) FROM payment WHERE `invoice_no`='.$invoice_no.' AND `status`=1')->row_array();--}}
{{--                    //echo number_format($row["SUM(`payment`)"]);--}}
{{--                    ?>--}}
{{--                </div>--}}
{{--            </td>--}}
{{--        </tr>--}}
{{--        <tr>--}}
{{--            <td class="blank"> </td>--}}
{{--            <td colspan="2" class="total-line"><b>Amount Due:</b> </td>--}}
{{--            <td class="total-value"><div class="due">--}}
{{--                    600 tk--}}
{{--                </div></td>--}}
{{--        </tr>--}}
        <!--            <tr>-->
        <!--                <td class="blank"> </td>-->
        <!--                <td colspan="2" class="total-line">Old Due: </td>-->
        <!--                <td class="total-value"><div class="due">--><?php
    ////                    $clid=$value->clid;
    ////                    $total=$this->db->query("SELECT SUM(`total`) FROM `invoice` WHERE clid=$clid")->row_array();
    ////                    $totals=$total['SUM(`total`)'];
    ////                    $paid=$this->db->query("SELECT SUM(`payment`) FROM `payment` WHERE clid=$clid")->row_array();
    ////                    $paids=$paid["SUM(`payment`)"];
    ////                    $dues=($totals-$paids)-$value->total;
    ////                    //echo number_format($dues).'tk';
    ////                  if($totals==0){
    ////                    echo "Not Due";
    ////                  }else if($paids>$totals){
    ////                    echo "Not Due";
    ////                  }else{
    ////                    //echo $totals;
    ////                    $dues=($totals-$value->total);
    ////                    echo number_format($dues).'Tk';
    ////                  }
    //                    ?><!--</div></td>-->
        <!--            </tr>-->
        <!--            <tr>-->
        <!--                <td class="blank"> </td>-->
        <!--                <td colspan="2" class="total-line">Grand Total: </td>-->
        <!--                <td class="total-value"><div class="due">--><?php
    //                //echo $paids;
    //                if($paids<$totals){
    //                    $totaldue=$dis-$payss;
    //                    echo number_format($totals-$paids).'tk';
    //                  }else{
    //                    echo "Not Due";
    //                  }
    //                  //echo number_format($totals-$paids).'tk';
    //                    ?><!--</div></td>-->
        <!--            </tr>-->
    </table>

    <!--    related transactions -->

<!--<br>
        <h4>Related Transactions: </h4>
         <table id="related_transactions" style="width: 100%">

            <tr>
                <th align="left" width="20%">Date</th>
                <th align="left">Account</th>
                <th width="50%" align="left">Description</th>
                <th align="right">Amount</th>

            </tr>
         <?php
///$clid=$value->invc_id;
//$payments=$this->db->where('invc_id',$invc_id)->order_by('trans_id','desc')->get('payment')->result();

//foreach($payments as $payment){
?>
        <tr class="item-row">

           <td align="left"><?php //$payment->date;?></td>
            <td align="left"><?php //$payment->account;?></td>
            <td align="left"><?php //$payment->description;?></td>
            <td align="right"><?php //number_format($payment->payment);?> tk</span></td>
        </tr>
            <?php // }?>


        </table> -->

    <!--    end related transactions -->




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