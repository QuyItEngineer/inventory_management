<div class="table-responsive">
    <table class="table" id="clients-table">
        <thead>
            <tr>
                <th>Name</th>
        <th>Phone Number 1</th>
        <th>Phone Number 2</th>
        <th>Address</th>
        <th>Car Group Type</th>
        <th>Shipping Type</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($clients as $client)
            <tr>
                <td>{{ $client->name }}</td>
            <td>{{ $client->phone_number_1 }}</td>
            <td>{{ $client->phone_number_2 }}</td>
            <td>{{ $client->address }}</td>
            <td>{{ $client->car_group_type }}</td>
            <td>{{ $client->shipping_type }}</td>
                <td>
                    {!! Form::open(['route' => ['clients.destroy', $client->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('clients.show', [$client->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{{ route('clients.edit', [$client->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
