<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
@php
    $data = \App\Models\Order::where('invoice_no', $invoice_no)->first();
    $orders = \App\Models\OrderDetails::where('order_id', $data->id)->get();
@endphp

<head>
    <meta charset="UTF-8">
    <title>Chalan {{ $data->callan_no }}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        body {
            font: 14px/1.4 Helvetica, Arial, sans-serif;
            background-size: cover;
            margin: 0;
            padding: 0 0 100px 0;
        }

        #page-wrap {
            width: 800px;
            margin: 0 auto;
            position: relative;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        table td,
        table th {
            border: 1px solid black;
            padding: 5px;
        }

        #header {
            background: #222;
            color: white;
            text-align: center;
            font-weight: bold;
            padding: 10px;
        }

        #company-info {
            /* margin-bottom: 05px; */
        }

        .company-left {
            float: left;
            width: 50%;
        }

        .company-right {
            float: right;
            width: 50%;
            text-align: right;
        }

        .clear {
            clear: both;
        }

        #customer {
            /* margin-top: 20px; */
        }

        #meta td.meta-head {
            background: #eee;
            font-weight: bold;
            text-align: right
        }

        #items {
            margin-top: 15px;
        }

        #items th {
            background: #eee;
        }

        #items td.total-line {
            text-align: right;
        }

        #items td.total-value {
            text-align: right;
        }

        #terms {
            margin-top: 30px;
        }

        #terms h4 {
            margin-bottom: 5px;
        }

        .product {
            width: 50%;
        }

        #signatures {
            margin-top: 50px;
            text-align: right;
        }

        #signatures .signature-block {
            display: inline-block;
            text-align: right;
        }

        #footer {
            position: fixed;
            bottom: 0;
            width: 800px;
            text-align: center;
            font-size: 13px;
            color: #444;
            padding: 10px 0;
            /* background: #f5f5f5; */
            /* border-top: 1px solid #ccc; */
        }
    </style>
</head>

<body>
    <div id="page-wrap">
        <div id="company-info">
            <div class="company-left">
                <img src="{{ asset('public/images/1695193114logo.png') }}" alt="Company Logo" height="44">
                <h2> Femina
                    Lighting</h2>
            </div>
            <div class="company-right">
                <p>
                    <i class="fas fa-map-marker-alt"></i>
                    <span>Plot#41, AB Super Marketing (2nd Floor)</span><br>
                    <span style="margin-left: 20px;">Shop#46-47, Sector#03, Uttara, Dhaka</span><br>

                    <i class="fas fa-phone"></i>
                    <span>09639117791</span><br>

                    <i class="fas fa-envelope"></i>
                    <span>info@jagopower.com</span><br>

                    <i class="fas fa-globe"></i>
                    <span>www.jago.uddokta71.com</span>
                </p>
            </div>
            <div class="clear"></div>
        </div>
        {{-- <hr> --}}
        <div id="customer">
            <table id="meta">
                <tr>
                    <td rowspan="4" style="text-align: left; border-right: 1px solid black;">
                        <strong>Invoiced To</strong><br>
                        <h3>{{ $data->customer->name }}</h3>
                        {{ $data->customer->address }}<br>
                        <b>Phone:</b> {{ $data->customer->phone }}<br>
                        <b>Email:</b> {{ $data->customer->email }}
                    </td>
                    <td class="meta-head">CHALLAN #</td>
                    <td>{{ $data->callan_no }}</td>
                </tr>
                <tr>
                    <td class="meta-head">Challan Date</td>
                    <td>{{ date('d-m-Y', strtotime($data->created_at)) }}</td>
                </tr>
            </table>
        </div>
        
        <table id="items">
            <tr>
                <th width="65%">Product</th>
                <th align="right">Qty</th>
            </tr>
            @foreach ($orders as $order)
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
        <div id="terms">
            <h4>Terms & Conditions</h4>
            <p>
                1. Dear Customer, Please ensure you have received all items mentioned in this invoice. If any item is
                missing or
                damaged, immediately return the package to your delivery agent.<br>
                2. Once the package is accepted, we cannot process claims for missing, wrong, or defective
                items.<br>
                3. For any assistance, you are entitled to 12 months of service warranty from the date of
                purchase.<br>
                4. You can reach us at <strong>+8801705210280</strong> or email us at
                <strong>info@feminalightings.com</strong>.<br>
                5. <strong>No Money Back Policy.</strong><br>
                6. Thank you for shopping with us. Have a great day!
            </p>
        </div>
        <div id="signatures">
            <div class="signature-block">
                ___________________________<br>
                <strong>Manager Signature</strong><br>
            </div>
        </div>
    </div>

    <div id="footer">
        <strong>Thank you for your business!</strong>
    </div>
</body>

</html>