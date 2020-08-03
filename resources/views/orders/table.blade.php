<div class="table-responsive">
    <table class="table" id="orders-table">
        <thead>
            <tr>
                <th>Mã Order</th>
                <th>Tên khách hàng</th>
                <th>Loại khách hàng</th>
                <th>Tổng tiền</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($orders as $order)
            <tr>
                <td>{{ $order->unique_code }}</td>
            <td>{{ $order->client->name }}</td>
            <td>{{ trans('message.client_type.' . $order->client_type) }}</td>
            <td>{{ $order->total_price }}</td>
                <td>
                    {!! Form::open(['route' => ['orders.destroy', $order->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('showUpdateDetail', [$order->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-file"></i></a>
{{--                        <a href="{{ route('orders.show', [$order->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>--}}
                        <a href="{{ route('orders.edit', [$order->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
