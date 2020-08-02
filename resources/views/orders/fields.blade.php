<div class="form-group col-sm-12">
    {!! Form::label('name', 'Tên khách hàng:') !!}
    {!! Form::select('client_id', $clients, null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-12">
    {!! Form::label('client_type', 'Loại khách hàng:') !!}
    {!! Form::select('client_type', $client_type, null, ['class' => 'form-control']) !!}
</div>

<div id="app">
    <add-product-in-order :products='{!! json_encode($products) !!}' >
    </add-product-in-order>
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('orders.index') }}" class="btn btn-default">Cancel</a>
</div>
