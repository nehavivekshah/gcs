@extends('backend.common.master')
@section('main-section')

  <div class="container-fluid">
    <div class="page-title">
      <div class="row">
        <div class="col-6">
          <h4>Edit AMC Product</h4>
        </div>
        <div class="col-6">
          <ol class="breadcrumb justify-content-end">
            <li class="breadcrumb-item"><a href="{{ route('admin.amc-product.index') }}">AMC Product List</a></li>
            <li class="breadcrumb-item active">Edit AMC Product</li>
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
              action="{{ route('admin.amc-product.update', ['uuid' => $amcProduct->uuid]) }}">
              @csrf
              @method('PATCH')
              <div class="col-md-4">
                <label class="form-label-premium" for="amc_product">AMC Product <span class="text-danger">*</span></label>
                <input type="text" class="form-control form-control-premium" id="amc_product" name="amc_product"
                  placeholder="AMC Product Name" required value="{{ $amcProduct->amc_product }}">
                <div class="invalid-feedback">
                  @error('amc_product')
                    {{ $message }}
                  @enderror
                </div>
              </div>

              <div class="col-md-4">
                <label class="form-label-premium" for="non_comp_amc_rate">Non Comp AMC Rate <span
                    class="text-danger">*</span></label>
                <input type="text" class="form-control form-control-premium" id="non_comp_amc_rate"
                  name="non_comp_amc_rate" placeholder="Rate" required value="{{ $amcProduct->non_comp_amc_rate }}">
                <div class="invalid-feedback">
                  @error('non_comp_amc_rate')
                    {{ $message }}
                  @enderror
                </div>
              </div>

              <div class="col-md-4">
                <label class="form-label-premium" for="comp_amc_rate">Comp AMC Rate <span
                    class="text-danger">*</span></label>
                <input type="text" class="form-control form-control-premium" id="comp_amc_rate" name="comp_amc_rate"
                  placeholder="Rate" required value="{{ $amcProduct->comp_amc_rate }}">
                <div class="invalid-feedback">
                  @error('comp_amc_rate')
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