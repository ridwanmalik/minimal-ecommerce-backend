<div id="sidebar" class="sidebar">
    <!-- begin sidebar scrollbar -->
    <div data-scrollbar="true" data-height="100%">
        <!-- begin sidebar user -->
        <ul class="nav">
            <li class="nav-profile">
                <a href="javascript:;" data-toggle="nav-profile">
                    <div class="cover with-shadow"></div>
                    <div class="image">
                        <img src="https://dummyimage.com/200x150/d9e0e7/aaa" class="img-thumnail" alt="" height="150"
                            width="200">
                    </div>
                    <div class="info">
                        {{ auth()->user()->name }}
                    </div>
                </a>
            </li>
        </ul>
        <!-- end sidebar user -->
        <!-- begin sidebar nav -->
        <ul class="nav">
            <li class="nav-header">Navigation</li>
            <li class="has-sub {{ request()->is('admin/dashboard') ? 'active' : '' }}">
                <a href="{{ route('admin.dashboard') }}"><i class="fa fa-th-large"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="has-sub">
                <a href="{{ route('product.index') }}">
                    <i class="fas fa-box-open"></i>
                    <span>Product</span>
                </a>
            </li>
            <li class="has-sub">
                <a href="{{ route('order.index') }}">
                    <i class="fas fa-cart-arrow-down"></i>
                    <span>Order</span>
                </a>
            </li>
            {{-- <li class="has-sub">
                <a href="javascript:;">
                    <b class="caret"></b>
                    <span>Dashboard</span>
                </a>
                <ul class="sub-menu">
                    <li><a href="index.html">Dashboard v1</a></li>
                    <li><a href="index_v2.html">Dashboard v2</a></li>
                </ul>
            </li> --}}
            <!-- begin sidebar minify button -->
            <li><a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify"><i
                        class="fa fa-angle-double-left"></i></a></li>
            <!-- end sidebar minify button -->
        </ul>
        <!-- end sidebar nav -->
    </div>
    <!-- end sidebar scrollbar -->
</div>
<div class="sidebar-bg"></div>
