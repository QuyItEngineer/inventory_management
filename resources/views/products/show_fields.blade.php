<!-- Unique Code Field -->
<div class="form-group">
    {!! Form::label('unique_code', 'Unique Code:') !!}
    <p>{{ $product->unique_code }}</p>
</div>

<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', 'Name:') !!}
    <p>{{ $product->name }}</p>
</div>

<!-- Quantity Field -->
<div class="form-group">
    {!! Form::label('quantity', 'Quantity:') !!}
    <p>{{ $product->quantity }}</p>
</div>

<!-- Price Field -->
<div class="form-group">
    {!! Form::label('price', 'Price:') !!}
    <p>{{ $product->price }}</p>
</div>

<!-- Wholesale Price Field -->
<div class="form-group">
    {!! Form::label('wholesale_price', 'Wholesale Price:') !!}
    <p>{{ $product->wholesale_price }}</p>
</div>

<!-- Float Field -->
<div class="form-group">
    {!! Form::label('retail_price', 'Retail Price:') !!}
    <p>{{ $product->retail_price }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $product->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $product->updated_at }}</p>
</div>

