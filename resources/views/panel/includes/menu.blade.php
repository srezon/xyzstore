<nav class="col-md-2 d-none d-md-block bg-light sidebar">
    <div class="sidebar-sticky">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" href="{{ url('panel') }}">
                    <i class="fa fa-dashboard"></i>
                    Dashboard <span class="sr-only">(current)</span>
                </a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#">
                    <i class="fa fa-users"></i>
                    Customers
                    <i class="fa fa-caret-down pull-right"></i>
                </a>
                <ul class="nav subnav">
                    <li class="nav-item"><a class="nav-link" href="{{url('/customer/new/')}}">Add New</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{url('/customers/')}}">All Customers</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#">
                    <i class="fa fa-tags"></i>
                    Products
                    <i class="fa fa-caret-down pull-right"></i>
                </a>
                <ul class="nav subnav">
                    @if (\Auth::user()->role_id != 2)
                        <li class="nav-item"><a class="nav-link" href="{{url('/product/new/')}}">Add New
                                Product</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{url('/category/new/')}}">Add New
                                Category</a></li>

                    @endif
                    <li class="nav-item"><a class="nav-link" href="{{url('/products/')}}">All Products</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{url('/categories/')}}">All Product
                            Categories</a></li>

                </ul>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#">
                    <i class="fa fa-briefcase"></i>
                    Suppliers
                    <i class="fa fa-caret-down pull-right"></i>
                </a>
                <ul class="nav subnav">
                    @if (\Auth::user()->role_id != 2)
                        <li class="nav-item"><a class="nav-link" href="{{url('/supplier/new/')}}">Add New</a></li>
                    @endif
                    <li class="nav-item"><a class="nav-link" href="{{url('/suppliers/')}}">All Suppliers</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#">
                    <i class="fa fa-truck"></i>
                    Brands
                    <i class="fa fa-caret-down pull-right"></i>
                </a>
                <ul class="nav subnav">
                    @if (\Auth::user()->role_id != 2)
                        <li class="nav-item"><a class="nav-link" href="{{url('/brand/new/')}}">Add New</a></li>
                    @endif
                    <li class="nav-item"><a class="nav-link" href="{{url('/brands/')}}">All Brands</a></li>
                </ul>
            </li>
            @if (\Auth::user()->role_id != 2)
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#">
                       <i class="fa fa-user"></i>
                        Users
                        <i class="fa fa-caret-down pull-right"></i>
                    </a>
                    <ul class="nav subnav">
                        <li class="nav-item"><a class="nav-link" href="{{url('/user/new/')}}">Add New</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{url('/users/')}}">All Users</a></li>
                    </ul>
                </li>
            @endif
            {{--<li class="nav-item dropdown">--}}
            {{--<a class="nav-link dropdown-toggle" href="#">--}}
            {{--<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="none" d="M0 0h24v24H0V0z"/><path d="M15.55 13c.75 0 1.41-.41 1.75-1.03l3.58-6.49c.37-.66-.11-1.48-.87-1.48H5.21l-.94-2H1v2h2l3.6 7.59-1.35 2.44C4.52 15.37 5.48 17 7 17h12v-2H7l1.1-2h7.45zM6.16 6h12.15l-2.76 5H8.53L6.16 6zM7 18c-1.1 0-1.99.9-1.99 2S5.9 22 7 22s2-.9 2-2-.9-2-2-2zm10 0c-1.1 0-1.99.9-1.99 2s.89 2 1.99 2 2-.9 2-2-.9-2-2-2z"/></svg>--}}
            {{--Sales--}}
            {{--<i class="fa fa-caret-down pull-right"></i>--}}
            {{--</a>--}}
            {{--<ul class="nav subnav">--}}
            {{--<li class="nav-item"><a class="nav-link" href="{{url('/sale/new/')}}">Add New</a></li>--}}
            {{--<li class="nav-item"><a class="nav-link" href="{{url('/sales/')}}">All Sales</a></li>--}}
            {{--</ul>--}}
            {{--</li>--}}
            @if (\Auth::user()->role_id != 2)
                <li class="nav-item">
                    <a class="nav-link" href="{{url('/sales/')}}">
                        <i class="fa fa-shopping-cart"></i>
                        Sales
                    </a>
                </li>
            @endif
            <li class="nav-item">
                <a class="nav-link" href="{{url('/invoices/')}}">
                    <i class="fa fa-file-text"></i>
                    Invoices
                </a>
            </li>
        </ul>
    </div>
</nav>

<script>
    $(function () {
        $(".dropdown-toggle").on("click", function () {
            $(this).next(".subnav").slideToggle();
        });
    });

</script>
