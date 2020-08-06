<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Bill</title>
    <meta charset="UTF-8">
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

    <style type="">
        body {
            font-family: DejaVu Sans;
        }
        .header-content {
            text-align: center;
        }
        .col-6 {
            float: left;
            width: 50%;
        }
        .col-4 {
            float: left;
            width: 33.33333333%;
        }
        .col-8 {
            float: left;
            width: 66.66666667%;
        }

        /* Clear floats after the columns */
        .row:after {
            content: "";
            display: table;
            clear: both;
        }


        .table-responsive {
            min-height: .01%;
            overflow-x: auto;
        }
        table {
            width: 100%;
            max-width: 100%;
            margin-bottom: 20px;
            border-spacing: 0;
            border-collapse: collapse;
        }
        thead {
            display: table-header-group;
            vertical-align: middle;
            border-color: inherit;
        }
        tr {
            display: table-row;
            vertical-align: inherit;
            border-color: inherit;
        }
        .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
            border: solid 1px;
            padding: 8px;
            line-height: 1.42857143;
        }
        th {
            text-align: left;
            font-weight: bold;
            display: table-cell;
        }
        tbody {
            display: table-row-group;
            vertical-align: middle;
            border-color: inherit;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="header-content">
        <h4 style="margin-bottom: 0px">HÓA ĐƠN BÁN HÀNG</h4>
        <h4 style="margin: 0px">Mã đơn hàng: <span style="font-size: 11px">{{ $order->unique_code }}</span></h4>
        <h6 style="margin: 0px">{{ $dateNow }}</h6>
    </div>
    <div class="client-content">
        <div class="box-body">
            <div class="row">
                <div class="col-6">
                    <h5>Khách hàng: {{ $order->client->name }}</h5>
                    <h5>Địa chỉ: {{ $order->client->address }}</h5>
                    <h5>Người bán: {{$user}}</h5>
                </div>
                <div class="col-6">
                    <h5>Số điện thoại: {{ $order->client->phone_number_1 }}</h5>
                </div>
            </div>
        </div>
    </div>
    <div class="box box-primary">
        <div class="box-body">
            <div class="table-responsive">
                <table class="table" id="orders-table">
                    <thead>
                    <tr>
                        <th>STT</th>
                        <th>Mã sản phẩm</th>
                        <th>Tên sản phẩm</th>
                        <th>Số lượng</th>
                        <th>Đơn giá</th>
                        <th>Thành tiền</th>
                        <th>Ghi chú</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($orderDetails as $key => $product)
                            <tr>
                                <td>{{ $key }}</td>
                                <td>{{ $product->product->unique_code }}</td>
                                <td>{{ $product->product->name }}</td>
                                <td>{{ $product->quantity }}</td>
                                @if($order->client_type == 0)
                                    <td>{{ $product->product->price }}</td>
                                @elseif($order->client_type == 1)
                                    <td>{{ $product->product->wholesale_price }}</td>
                                @elseif($order->client_type == 2)
                                    <td>{{ $product->product->retail_price }}</td>
                                @endif
                                <td>{{ $product->sum_price }}</td>
                                <td></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="total-price-content">
        <div class="box-body">
            <div class="row">
                <div class="col-8" style="text-align: left">
                </div>
                <div class="col-4" style="text-align: left">
                    <h5>Tổng số lượng: {{ $totalQuantity }}</h5>
                    <h5>Tổng tiền hàng: {{ $order->total_price }}</h5>
                </div>
            </div>
        </div>
    </div>
    <div class="client-content">
        <div class="box-body">
            <div class="row">
                <div class="col-6" style="text-align: center">
                    <h5>Người đặt hàng:</h5>
                </div>
                <div class="col-6" style="text-align: center">
                    <h5>Người bán hàng:</h5>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</body>
</html>
