<div class="form-group col-sm-12">
    {!! Form::label('name', 'Tên khách hàng:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-12">
    {!! Form::label('phone_number_1', 'Số điện thoại (*):') !!}
    {!! Form::number('phone_number_1', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-12">
    {!! Form::label('phone_number_2', 'Số điện thoại dự phòng:') !!}
    {!! Form::number('phone_number_2', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-12">
    {!! Form::label('address', 'Địa chỉ nhận hàng:') !!}
    {!! Form::text('address', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-12">
    {!! Form::label('car_group_type', 'Loại nhóm xe hàng:') !!}
    {!! Form::text('car_group_type', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-12">
    {!! Form::label('shipping_type', 'Loại hình ship hàng:') !!}
    {!! Form::text('shipping_type', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('clients.index') }}" class="btn btn-default">Cancel</a>
</div>
