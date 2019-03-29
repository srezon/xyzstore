<nav class="col-md-2 d-none d-md-block bg-light sidebar">
    <div class="sidebar-sticky">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" href="{{ url('panel') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                         class="feather feather-home">
                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                        <polyline points="9 22 9 12 15 12 15 22"></polyline>
                    </svg>
                    Dashboard <span class="sr-only">(current)</span>
                </a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                         class="feather feather-users">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                        <circle cx="9" cy="7" r="4"></circle>
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                    </svg>
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
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="none" d="M0 0h24v24H0V0z"/><path d="M16 6V4c0-1.11-.89-2-2-2h-4c-1.11 0-2 .89-2 2v2H2v13c0 1.11.89 2 2 2h16c1.11 0 2-.89 2-2V6h-6zm-6-2h4v2h-4V4zm10 15H4V8h16v11zM9 18l7.5-5L9 9z"/></svg>
                    Products
                    <i class="fa fa-caret-down pull-right"></i>
                </a>
                <ul class="nav subnav">
                    <li class="nav-item"><a class="nav-link" href="{{url('/product/new/')}}">Add New</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{url('/products/')}}">All Products</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="none" d="M0 0h24v24H0V0z"/><path d="M3 9H1v11c0 1.11.89 2 2 2h14c1.11 0 2-.89 2-2H3V9zm15-4V3c0-1.11-.89-2-2-2h-4c-1.11 0-2 .89-2 2v2H5v11c0 1.11.89 2 2 2h14c1.11 0 2-.89 2-2V5h-5zm-6-2h4v2h-4V3zm9 13H7V7h14v9zm-9-1l5.5-4L12 8z"/></svg>
                    Product Categories
                    <i class="fa fa-caret-down pull-right"></i>
                </a>
                <ul class="nav subnav">
                    <li class="nav-item"><a class="nav-link" href="{{url('/category/new/')}}">Add New</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{url('/categories/')}}">All Products</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="none" d="M0 0h24v24H0V0z"/><path d="M11 9h2V6h3V4h-3V1h-2v3H8v2h3v3zm-4 9c-1.1 0-1.99.9-1.99 2S5.9 22 7 22s2-.9 2-2-.9-2-2-2zm10 0c-1.1 0-1.99.9-1.99 2s.89 2 1.99 2 2-.9 2-2-.9-2-2-2zm-8.9-5h7.45c.75 0 1.41-.41 1.75-1.03l3.86-7.01L19.42 4l-3.87 7H8.53L4.27 2H1v2h2l3.6 7.59-1.35 2.44C4.52 15.37 5.48 17 7 17h12v-2H7l1.1-2z"/></svg>
                    Suppliers
                    <i class="fa fa-caret-down pull-right"></i>
                </a>
                <ul class="nav subnav">
                    <li class="nav-item"><a class="nav-link" href="{{url('/supplier/new/')}}">Add New</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{url('/suppliers/')}}">All Suppliers</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                         class="feather feather-layers">
                        <polygon points="12 2 2 7 12 12 22 7 12 2"></polygon>
                        <polyline points="2 17 12 22 22 17"></polyline>
                        <polyline points="2 12 12 17 22 12"></polyline>
                    </svg>
                    Brands
                    <i class="fa fa-caret-down pull-right"></i>
                </a>
                <ul class="nav subnav">
                    <li class="nav-item"><a class="nav-link" href="{{url('/brand/new/')}}">Add New</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{url('/brands/')}}">All Brands</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                         class="feather feather-users">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                        <circle cx="9" cy="7" r="4"></circle>
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                    </svg>
                    Users & Roles
                    <i class="fa fa-caret-down pull-right"></i>
                </a>
                <ul class="nav subnav">
                    <li class="nav-item"><a class="nav-link" href="{{url('/user/new/')}}">Add New</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{url('/users/')}}">All Users</a></li>
                </ul>
            </li>
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
            <li class="nav-item">
                <a class="nav-link" href="{{url('/sales/')}}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="none" d="M0 0h24v24H0V0z"/><path d="M15.55 13c.75 0 1.41-.41 1.75-1.03l3.58-6.49c.37-.66-.11-1.48-.87-1.48H5.21l-.94-2H1v2h2l3.6 7.59-1.35 2.44C4.52 15.37 5.48 17 7 17h12v-2H7l1.1-2h7.45zM6.16 6h12.15l-2.76 5H8.53L6.16 6zM7 18c-1.1 0-1.99.9-1.99 2S5.9 22 7 22s2-.9 2-2-.9-2-2-2zm10 0c-1.1 0-1.99.9-1.99 2s.89 2 1.99 2 2-.9 2-2-.9-2-2-2z"/></svg>
                    Sales
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{url('/invoices/')}}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="none" d="M0 0h24v24H0V0z"/><path d="M8 16h8v2H8zm0-4h8v2H8zm6-10H6c-1.1 0-2 .9-2 2v16c0 1.1.89 2 1.99 2H18c1.1 0 2-.9 2-2V8l-6-6zm4 18H6V4h7v5h5v11z"/></svg>
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
