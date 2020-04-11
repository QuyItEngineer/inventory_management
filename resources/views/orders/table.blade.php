<div class="table-responsive">
    <table class="table" id="orders-table">
        <thead>
            <tr>
                <th>Unique Code</th>
        <th>Quantity</th>
        <th>Wholesale Price</th>
        <th>Retail Price</th>
        <th>Real Cost</th>
        <th>Debt In Scope</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($orders as $order)
            <tr>
                <td>{{ $order->unique_code }}</td>
            <td>{{ $order->quantity }}</td>
            <td>{{ $order->wholesale_price }}</td>
            <td>{{ $order->retail_price }}</td>
            <td>{{ $order->real_cost }}</td>
            <td>{{ $order->debt_in_scope }}</td>
                <td>
                    {!! Form::open(['route' => ['orders.destroy', $order->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('orders.show', [$order->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
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
