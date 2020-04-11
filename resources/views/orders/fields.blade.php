<div class="form-group col-sm-12">
    {!! Form::label('unique_code', 'Mã sản phẩm:') !!}
    {!! Form::text('unique_code', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-12">
    {!! Form::label('name', 'Tên sản phẩm:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-12">
    {!! Form::label('quantity', 'Số lượng sản phẩm:') !!}
    {!! Form::number('quantity', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-12">
    {!! Form::label('price', 'Giá trung bình:') !!}
    {!! Form::number('price', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-12">
    {!! Form::label('input_price', 'Giá nhập vào:') !!}
    {!! Form::number('input_price', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-12">
    {!! Form::label('ctv_price', 'Giá cho cộng tác viên:') !!}
    {!! Form::number('ctv_price', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-12">
    {!! Form::label('wholesale_price', 'Giá bán lẻ:') !!}
    {!! Form::number('wholesale_price', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-12">
    {!! Form::label('retail_price', 'Giá bán sỉ:') !!}
    {!! Form::number('retail_price', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('orders.index') }}" class="btn btn-default">Cancel</a>
</div>
