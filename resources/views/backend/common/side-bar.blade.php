<div class="sidebar-wrapper" data-layout="stroke-svg" style="background:#bf0103;">
  <div class="logo-wrapper"><a href="{{ route('admin.dashboard') }}">
      <img class="img-fluid" src="{{ asset('assets/images/logo/gcs-icon-light.png') }}" style="max-width:100px" alt="">
    </a>
    <div class="back-btn"><i class="fa fa-angle-left"> </i></div>
    <div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="grid"> </i></div>
  </div>
  <div class="logo-icon-wrapper"><a href="{{ route('admin.dashboard') }}">
      <img class="img-fluid" src="{{ asset('assets/images/logo/gcs-icon-light.png') }}" style="max-width:100px"
        alt=""></a>
  </div>
  <nav class="sidebar-main">
    <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
    <div id="sidebar-menu">
      <ul class="sidebar-links" id="simple-bar">
        <li class="back-btn"><a href="{{ route('admin.dashboard') }}">
            <img class="img-fluid" src="{{ asset('assets/images/logo/gcs-icon-light.png') }}" style="max-width:100px"
              alt="">
          </a>
          <div class="mobile-back text-end"> <span>Back </span><i class="fa fa-angle-right ps-2" aria-hidden="true"></i>
          </div>
        </li>

        <li class="sidebar-main-title">
          <div>
            <h6 class="lan-1">General</h6>
          </div>
        </li>

        <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title link-nav"
            href="{{ route('admin.dashboard') }}">
            <svg class="stroke-icon">
              <use href="{{ url('public/assets/svg/icon-sprite.svg#stroke-home') }}"></use>
            </svg>
            <svg class="fill-icon">
              <use href="{{ url('public/assets/svg/icon-sprite.svg#stroke-home') }}"></use>
            </svg><span>Dashboard</span></a></li>


        <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title" href="#">
            <svg class="stroke-icon">
              <use href="{{ url('public/assets/svg/icon-sprite.svg#stroke-widget') }}"></use>
            </svg>
            <svg class="fill-icon">
              <use href="{{ url('public/assets/svg/icon-sprite.svg#fill-widget') }}"></use>
            </svg><span>Master</span>
          </a>
          <ul class="sidebar-submenu">
            <li><a href="{{ route('admin.user.index') }}">User List</a></li>
            <li><a href="{{ route('admin.user-type.index') }}">User Type</a></li>
            <li><a href="{{ route('admin.engineer.index') }}">Engineer</a></li>
            <li><a href="{{ route('admin.year.index') }}">year</a></li>
            <li><a href="{{ route('admin.product.index') }}"> Product</a></li>
            <li><a href="{{ route('admin.supplier.index') }}"> Supplier </a></li>
            <li><a href="{{ route('admin.product-type.index') }}">Product Type</a></li>
            <li><a href="{{ route('admin.manufacture.index') }}">Manufacture</a></li>
            <li><a href="{{ route('admin.amc-product.index') }}">Amc Product</a></li>
            <li><a href="{{ route('admin.product-accessories.index') }}">product-accessories</a></li>
            <li><a href="{{ route('admin.state.index') }}">State</a></li>
            <li><a href="{{ route('admin.city.index') }}">City</a></li>
            <li><a href="{{ route('admin.area.index') }}">Area</a></li>
          </ul>
        </li>

        <li class="sidebar-list">
          <i class="fa fa-thumb-tack"></i>
          <a class="sidebar-link sidebar-title link-nav active" href="{{ route('admin.customer.index') }}">
            <svg class="stroke-icon">
              <use href="{{ url('public/assets/svg/icon-sprite.svg#stroke-user') }}"></use>
            </svg>
            <svg class="fill-icon">
              <use href="{{ url('public/assets/svg/icon-sprite.svg#fill-user') }}"></use>
            </svg>
            <span>Customer</span>
            <div class="according-menu"><i class="fa fa-angle-right"></i></div>
          </a>
        </li>


        <li class="sidebar-list">
          <i class="fa fa-thumb-tack"></i>
          <a class="sidebar-link sidebar-title link-nav" href="{{ route('admin.logout') }}">
            <svg class="stroke-icon">
              <use href="{{ url('public/assets/svg/icon-sprite.svg#stroke-file') }}"></use>
            </svg>
            <svg class="fill-icon">
              <use href="{{ url('public/assets/svg/icon-sprite.svg#fill-file') }}"></use>
            </svg>
            <span>Logout</span>
            <div class="according-menu"><i class="fa fa-angle-right"></i></div>
          </a>
        </li>


      </ul>
      <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
    </div>
  </nav>
</div>