@extends('backend.common.master')
@section('main-section')

  <div class="container-fluid">
    <div class="page-title">
      <div class="row">
        <div class="col-6">
          <h4>Edit Accessories</h4>
        </div>
        <div class="col-6">
          <ol class="breadcrumb justify-content-end">
            <li class="breadcrumb-item"><a href="{{ route('admin.product-accessories.index') }}">Product Accessories
                List</a>
            </li>
            <li class="breadcrumb-item active">Edit Accessories</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  <!-- Container-fluid starts-->
  <div class="container-fluid">
    <div class="row">

      <div class="col-xl-12">
        <div class="card card-premium">

          <div class="card-body">
            <form class="row g-3 needs-validation custom-input" novalidate="" method="post"
              action="{{ route('admin.product-accessories.update', ['uuid' => $accessories->uuid]) }}">
              @csrf
              @method('PATCH')
              <div class="col-md-4">
                <label class="form-label-premium" for="accessories">Accessories <span class="text-danger">*</span></label>
                <input type="text" class="form-control form-control-premium" id="accessories" name="accessories"
                  placeholder="Accessories" required value="{{ $accessories->accessories }}">
                <div class="invalid-feedback">
                  @error('accessories')
                    {{ $message }}
                  @enderror
                </div>
              </div>

              <div class="col-12">
                <div class="d-flex justify-content-end">
                  <button class="btn btn-primary-custom" type="submit">
                    Submit
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection