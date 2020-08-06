@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Order
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @include('orders.show_fields')
                    <a href="{{ route('orders.index') }}" class="btn btn-default">Back</a>
                    <a href="{{ route('showUpdateDetail', [$order->id]) }}" class='btn btn-success'>Xuất Hóa đơn</a>
                </div>
            </div>
        </div>
    </div>
@endsection
