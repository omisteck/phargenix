<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <title>{{ $Sales[0]->branch->name}}</title>
    <style>
        @media print {
            @page {
                margin: 0 auto;
                /* imprtant to logo margin */
                /* sheet-size: 300px 250mm; imprtant to set paper size */
            }

            html,
            body,
            p,
            h1 {
                margin: 0;
                padding: 0;
                font-family: sans-serif;
                font-size: .8em;
            }

            p {
                padding: 1px;
            }

            h1 {
                font-size: 1.8em;
                padding: 7px 0px 3px 0px;
            }

            #printContainer {
                width: 250px;
                margin: auto;
                /*padding: 10px;*/
                /*border: 2px dotted #000;*/
                text-align: justify;
            }

            .table {
                width: 100%;
                border-collapse: collapse;
                table-layout: fixed;
            }

            .table td {
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
            }

            .row-name {
                width: 50%;
            }

            .row-qty {
                width: 15%;
            }

            .row-price {
                width: 15%;
            }

            .row-total {
                width: 18%;
            }

            .text-center {
                text-align: center;
            }
        }
    </style>
</head>

<body onload="window.print();">
    <div id="printContainer">
        <h1 id="slogan" class="text-center">{{ $Sales[0]->branch->name}}</h1>
        <P class="text-center">Your Caring Pharmacy</P>
        <P class="text-center">{{ $Sales[0]->branch->address}}</P>
        <P class="text-center">{{ $Sales[0]->branch->phone}}</P>
        <br>
        <table>
            <tr>
                <td>Receipt No:</td>
                <td><b>{{ $Sales[0]->invoice_number}}</b></td>
            </tr>
            <tr>
                <td>Created On</td>
                <td><b>{{ $Sales[0]->created_at }}<br></b></td>
            </tr>

            <tr>
                <td>Cashier</td>
                <td><b>{{ $Sales[0]->user->name}}</b></td>
            </tr>
        </table>
        <hr>

        <table class="table">
            <tr>
                <td class="row-name"><b>Item Name</b></td>
                <td class="row-qty"><b>Qty</b></td>
                <td class="row-price"><b>Price</b></td>
                <td class="row-total"><b>Total</b></td>
            </tr>
            <tr>
                <td colspan="9">
                    <hr>
                </td>
            </tr>
            @foreach ($Sales as $sale )
            
            <tr>
                <td>{{ json_decode($sale->data)->name }}</td>
                <td><b>{{ $sale->qty}}</b></td>
                @if ($sale->qty > 0)
                <td><b>{{ $sale->total / $sale->qty}}</b></td>
                @else
                <td><b>0</b></td>
                @endif
                <td><b>{{ $sale->total}}</b></td>
            </tr>

            @endforeach
            <tr>
                <td colspan="9">
                    <hr>
                </td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td><b>Subtotal</b></td>
                <td><b>{{ $sum }}</b></td>

            </tr>
            <tr>
                <td></td>
                <td></td>
                <td><b>Discount</b></td>
                <td><b>{{$Sales[0]->invoice_discount }}</b></td>

            </tr>
            <tr>
                <td></td>
                <td></td>
                <td><b>Total</b></td>
                <td><b>{{ $sum - $Sales[0]->invoice_discount }}</b></td>

            </tr>

            <tr>
                <td></td>
                <td></td>
                <td><b>Paid</b>: <b>{{ $Sales[0]->invoice_paid }}</b></td>
                <td><b>Change</b>: <b>{{ $Sales[0]->invoice_paid - ($sum - $Sales[0]->invoice_discount) }}</b></td>
            </tr>
        </table>

    </div>
</body>

</html>