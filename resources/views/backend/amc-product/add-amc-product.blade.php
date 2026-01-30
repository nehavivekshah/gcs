@extends('backend.common.master')
@section('main-section')

<div class="container-fluid">
  <div class="page-title">
    <div class="row">
      <div class="col-6">
        <h4>Add Amc Product</h4>
      </div>
      <div class="col-6">
        
      </div>
    </div>
  </div>
</div>
<!-- Container-fluid starts-->
<div class="container-fluid">
  <div class="row">

    <div class="col-xl-12">
      <div class="card height-equal">

        <div class="card-body">
          <form class="row g-3 needs-validation custom-input" novalidate="" method="post" action="{{ route('admin.amc-product.store') }}">
            @csrf
            <div class="col-4">
              <label class="form-label" for="amc_product">Amc Product</label>
              <input type="text" class="form-control" id="amc_product" name="amc_product" placeholder="Amc Product" required_ value="{{ old('amc_product') }}">
              <div class="invalid-feedback">
                @error('amc_product')
                {{ $message }}
                @enderror
              </div>

            </div>

            <div class="col-4">
              <label class="form-label" for="non_comp_amc_rate">Non Comp Amc Rate</label>
              <input type="text" class="form-control" id="non_comp_amc_rate" name="non_comp_amc_rate" placeholder="Non Camp Amc Rate" required_ value="{{ old('non_comp_amc_rate') }}">
              <div class="invalid-feedback">
                @error('non_comp_amc_rate')
                {{ $message }}
                @enderror
              </div>

            </div>

            <div class="col-4">
              <label class="form-label" for="comp_amc_rate">Comp Amc Rate</label>
              <input type="text" class="form-control" id="comp_amc_rate" name="comp_amc_rate" placeholder="Comp Amc Rate" required_ value="{{ old('comp_amc_rate') }}">
              <div class="invalid-feedback">
                @error('outlook_email')
                {{ $message }}
                @enderror
              </div>

            </div>


            <div class="col-12">
              <div class="d-flex justify-content-end">
                <button class="btn btn-lg" type="submit" style="background:#bf0103;color:white;">
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