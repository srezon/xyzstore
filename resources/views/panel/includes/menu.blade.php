<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">


            <li>
                <a href="#"><i class="glyphicon glyphicon-plus"></i> New<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        {{--<a href="{{url('/sale/new/')}}">Sale</a>--}}
                        <a href="{{url('/customers/')}}">Sale</a>
                    </li>
                    <li>
                        <a href="{{url('/product/new/')}}">Product</a>
                    </li>
                    <li>
                        <a href="{{url('/category/new/')}}">Category</a>
                    </li>
                    <li>
                        <a href="{{url('/brand/new/')}}">Brand</a>
                    </li>
                    <li>
                        <a href="{{url('/customer/new/')}}">Customer</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>

            <li>
                <a href="#"><i class="glyphicon glyphicon-search"></i> View<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{url('/sales/')}}">Sale Report</a>
                    </li>
                    <li>
                        <a href="{{url('/invoices/')}}">View Invoices</a>
                    </li>
                    <li>
                        <a href="{{url('/products/')}}">Products</a>
                    </li>
                    <li>
                        <a href="{{url('/categories/')}}">Categories</a>
                    </li>
                    <li>
                        <a href="{{url('/brands/')}}">Brands</a>
                    </li>
                    <li>
                        <a href="{{url('/customers/')}}">Customers</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>


        </ul>
    </div>
</div>