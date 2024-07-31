<div class="site-navbar-top">
    <div class="container">
        <div class="row align-items-center">

            <div class="col-6 col-md-4 order-2 order-md-1 site-search-icon text-left">
                <form action="" class="site-block-top-search">
                    <span class="icon icon-search2"></span>
                    <input type="text" class="form-control border-0" name="search" placeholder="Tìm kiếm....">
                </form>
            </div>

            <div class="col-12 mb-3 mb-md-0 col-md-4 order-1 order-md-2 text-center">
                <div class="site-logo">
                    <a href="{{ route('/.index') }}" class="js-logo-clone">BK-Pets</a>
                </div>
            </div>

            <div class="col-6 col-md-4 order-3 order-md-3 text-right">
                <div class="site-top-icons">
                    <ul>
                        <li>
                            <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <span class="icon icon-person"></span>
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                @if (Auth::user())
                                    @if (Auth::user()->chuc_vu_id == 1)
                                        <a class="dropdown-item" href="{{ route('admin.index') }}">
                                            <i class="fas fa-home fa-sm fa-fw mr-2 text-gray-400"></i>
                                            Admin
                                        </a>
                                    @endif
                                @endif
                                <a class="dropdown-item" href="{{ route('/.index') }}">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Thông tin tài khoản
                                </a>
                                @if (Auth::user())
                                    <a class="dropdown-item" href="{{ route('logout') }}">
                                        <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Đăng xuất
                                    </a>
                                @elseif(!Auth::user())
                                    <a class="dropdown-item" href="{{ route('login') }}">
                                        <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Đăng nhập
                                    </a>
                                @endif
                            </div>
                        </li>
                        </li>
                        <li>
                            <a href="cart.html" class="site-cart">
                                <span class="icon icon-shopping_cart"></span>
                                <span class="count">{{ session('cart') ? count(session('cart')) : '0' }}</span>
                            </a>
                        </li>
                        <li class="d-inline-block d-md-none ml-md-0"><a href="#"
                                class="site-menu-toggle js-menu-toggle"><span class="icon-menu"></span></a>
                        </li>
                    </ul>
                </div>
            </div>

        </div>
    </div>
</div>
