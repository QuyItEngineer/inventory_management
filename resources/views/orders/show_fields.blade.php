<!-- Unique Code Field -->
<div class="form-group">
    {!! Form::label('unique_code', 'Unique Code:') !!}
    <p>{{ $order->unique_code }}</p>
</div>
<!-- Quantity Field -->
<div class="form-group">
    {!! Form::label('client_name', 'Tên khách hàng:') !!}
    <p>{{ $order->client->name }}</p>
</div>
<div class="form-group">
    {!! Form::label('quantity', 'Tổng tiền:') !!}
    <p>{{ $order->total_price }}</p>
</div>
<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Ngày tạo:') !!}
    <p>{{ $order->created_at }}</p>
</div>
<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Ngày chỉnh sửa:') !!}
    <p>{{ $order->updated_at }}</p>
</div>

<div class="table-responsive">
    <table class="table" id="orders-table">
        <thead>
        <tr>
            <th>Tên sản phẩm</th>
            <th>Số lượng</th>
            <th>Số tiền</th>
        </tr>
        </thead>
        <tbody>
        @foreach($products as $product)
            <tr>
                <td>{{ $product->name }}</td>
                <td>{{ $product->quantity }}</td>
                <td>{{ $product->sum_price }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

