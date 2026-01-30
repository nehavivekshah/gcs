@extends('backend.common.master')
@section('main-section')
  <div class="container-fluid">
    <div class="page-title">
      <div class="row">
        <div class="col-6">
          <h4>
            Dashboard </h4>
        </div>

      </div>
    </div>
  </div>
  <!-- Container-fluid starts-->
  <div class="container-fluid">
    <div class="row size-column">
      <div class="col-xxl-9 box-col-12">
        <div class="row">
          <div class="col-xl-3 col-sm-6">
            <div class="card o-hidden small-widget">
              <div class="card-body total-project border-b-primary border-2"><span
                  class="f-light f-w-500 f-14">User</span>
                <div class="project-details">
                  <div class="project-counter">
                    <h2 class="f-w-600">2</h2><span class="f-12 f-w-400">(This month)</span>
                  </div>
                  <div class="product-sub bg-primary-light">
                    <svg class="invoice-icon">
                      <use href="../public/assets/svg/icon-sprite.svg#color-swatch"></use>
                    </svg>
                  </div>
                </div>
                <ul class="bubbles">
                  <li class="bubble"></li>
                  <li class="bubble"></li>
                  <li class="bubble"></li>
                  <li class="bubble"></li>
                  <li class="bubble"></li>
                  <li class="bubble"></li>
                  <li class="bubble"></li>
                  <li class="bubble"></li>
                  <li class="bubble"></li>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-sm-6">
            <div class="card o-hidden small-widget">
              <div class="card-body total-Progress border-b-warning border-2"> <span
                  class="f-light f-w-500 f-14">Product</span>
                <div class="project-details">
                  <div class="project-counter">
                    <h2 class="f-w-600">836</h2><span class="f-12 f-w-400">(This month) </span>
                  </div>
                  <div class="product-sub bg-warning-light">
                    <svg class="invoice-icon">
                      <use href="../public/assets/svg/icon-sprite.svg#tick-circle"></use>
                    </svg>
                  </div>
                </div>
                <ul class="bubbles">
                  <li class="bubble"></li>
                  <li class="bubble"></li>
                  <li class="bubble"></li>
                  <li class="bubble"></li>
                  <li class="bubble"></li>
                  <li class="bubble"></li>
                  <li class="bubble"></li>
                  <li class="bubble"></li>
                  <li class="bubble"></li>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-sm-6">
            <div class="card o-hidden small-widget">
              <div class="card-body total-Complete border-b-secondary border-2"><span
                  class="f-light f-w-500 f-14">Manufacture</span>
                <div class="project-details">
                  <div class="project-counter">
                    <h2 class="f-w-600">475</h2><span class="f-12 f-w-400">(This month) </span>
                  </div>
                  <div class="product-sub bg-secondary-light">
                    <svg class="invoice-icon">
                      <use href="../public/assets/svg/icon-sprite.svg#add-square"></use>
                    </svg>
                  </div>
                </div>
                <ul class="bubbles">
                  <li class="bubble"> </li>
                  <li class="bubble"></li>
                  <li class="bubble"></li>
                  <li class="bubble"> </li>
                  <li class="bubble"></li>
                  <li class="bubble"> </li>
                  <li class="bubble"></li>
                  <li class="bubble"></li>
                  <li class="bubble"> </li>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-sm-6">
            <div class="card o-hidden small-widget">
              <div class="card-body total-upcoming"><span class="f-light f-w-500 f-14">Amc Product</span>
                <div class="project-details">
                  <div class="project-counter">
                    <h2 class="f-w-600">189</h2><span class="f-12 f-w-400">(This month) </span>
                  </div>
                  <div class="product-sub bg-light-light">
                    <svg class="invoice-icon">
                      <use href="../public/assets/svg/icon-sprite.svg#edit-2"></use>
                    </svg>
                  </div>
                </div>
                <ul class="bubbles">
                  <li class="bubble"> </li>
                  <li class="bubble"></li>
                  <li class="bubble"></li>
                  <li class="bubble"></li>
                  <li class="bubble"></li>
                  <li class="bubble"></li>
                  <li class="bubble"></li>
                  <li class="bubble"></li>
                  <li class="bubble"></li>
                </ul>
              </div>
            </div>
          </div>


        </div>
      </div>

    </div>
  </div>
@endsection