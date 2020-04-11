<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', 'Name:') !!}
    <p>{{ $client->name }}</p>
</div>

<!-- Phone Number 1 Field -->
<div class="form-group">
    {!! Form::label('phone_number_1', 'Phone Number 1:') !!}
    <p>{{ $client->phone_number_1 }}</p>
</div>

<!-- Phone Number 2 Field -->
<div class="form-group">
    {!! Form::label('phone_number_2', 'Phone Number 2:') !!}
    <p>{{ $client->phone_number_2 }}</p>
</div>

<!-- Address Field -->
<div class="form-group">
    {!! Form::label('address', 'Address:') !!}
    <p>{{ $client->address }}</p>
</div>

<!-- Car Group Type Field -->
<div class="form-group">
    {!! Form::label('car_group_type', 'Car Group Type:') !!}
    <p>{{ $client->car_group_type }}</p>
</div>

<!-- Shipping Type Field -->
<div class="form-group">
    {!! Form::label('shipping_type', 'Shipping Type:') !!}
    <p>{{ $client->shipping_type }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $client->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $client->updated_at }}</p>
</div>

