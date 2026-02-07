@extends('backend.common.master')
@section('main-section')

  <div class="container-fluid">
    <div class="page-title">
      <div class="row">
        <div class="col-6">
          <h4>Edit Product Type</h4>
        </div>
        <div class="col-6">
          <ol class="breadcrumb justify-content-end">
            <li class="breadcrumb-item"><a href="{{ route('admin.product-type.index') }}">Product Type List</a></li>
            <li class="breadcrumb-item active">Edit Product Type</li>
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
              action="{{ route('admin.product-type.update', ['uuid' => $product_types->uuid]) }}">
              @csrf
              @method('PATCH')
              <div class="col-md-4">
                <label class="form-label-premium" for="product_type">Product Type <span
                    class="text-danger">*</span></label>
                <input type="text" class="form-control form-control-premium" id="product_type" name="product_type"
                  placeholder=" Product Type" required value="{{ $product_types->product_type }}">
                <div class="invalid-feedback">
                  @error('product_type')
                    {{ $message }}
                  @enderror
                </div>

              </div>

              <div class="col-md-4">
                <label class="form-label-premium" for="sub_product_type">Sub Product Type <span
                    class="text-danger">*</span></label>
                <input type="text" class="form-control form-control-premium" id="sub_product_type" name="sub_product_type"
                  placeholder=" Product Type" required value="{{ $product_types->sub_product_type }}">
                <div class="invalid-feedback">
                  @error('sub_product_type')
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