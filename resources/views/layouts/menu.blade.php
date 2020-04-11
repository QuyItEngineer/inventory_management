<li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Sản phẩm</a>
    <ul class="dropdown-menu" role="menu">
        <li><a href="{!! route('products.index') !!}">Danh sách</a></li>
        <li><a href="{!! route('products.create') !!}">Thêm mới</a></li>
    </ul>
</li>

<li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Khách hàng</a>
    <ul class="dropdown-menu" role="menu">
        <li><a href="{!! route('clients.index') !!}">Danh sách</a></li>
        <li><a href="{!! route('clients.create') !!}">Thêm mới</a></li>
    </ul>
</li>

<li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Đặt hàng</a>
    <ul class="dropdown-menu" role="menu">
        <li><a href="{!! route('orders.index') !!}">Danh sách</a></li>
        <li><a href="{!! route('orders.create') !!}">Thêm mới</a></li>
    </ul>
</li>
