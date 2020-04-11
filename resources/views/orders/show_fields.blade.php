<!-- Unique Code Field -->
<div class="form-group">
    {!! Form::label('unique_code', 'Unique Code:') !!}
    <p>{{ $order->unique_code }}</p>
</div>

<!-- Quantity Field -->
<div class="form-group">
    {!! Form::label('quantity', 'Quantity:') !!}
    <p>{{ $order->quantity }}</p>
</div>

<!-- Wholesale Price Field -->
<div class="form-group">
    {!! Form::label('wholesale_price', 'Wholesale Price:') !!}
    <p>{{ $order->wholesale_price }}</p>
</div>

<!-- Retail Price Field -->
<div class="form-group">
    {!! Form::label('retail_price', 'Retail Price:') !!}
    <p>{{ $order->retail_price }}</p>
</div>

<!-- Real Cost Field -->
<div class="form-group">
    {!! Form::label('real_cost', 'Real Cost:') !!}
    <p>{{ $order->real_cost }}</p>
</div>

<!-- Debt In Scope Field -->
<div class="form-group">
    {!! Form::label('debt_in_scope', 'Debt In Scope:') !!}
    <p>{{ $order->debt_in_scope }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $order->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $order->updated_at }}</p>
</div>

