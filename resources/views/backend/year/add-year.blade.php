@extends('backend.common.master')
@section('main-section')

<div class="container-fluid">
  <div class="page-title">
    <div class="row">
      <div class="col-6">
        <h4>Add Year</h4>
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
          <form class="row g-3 needs-validation custom-input" novalidate="" method="post" action="{{ route('admin.year.store') }}">
            @csrf
            <div class="col-4">
              <label class="form-label" for="amc_product">Finantial Year</label>
              <input type="text" class="form-control" id="financial_year" name="financial_year" placeholder="Finantial Year" required_ value="{{ old('financial_year') }}">
              <div class="invalid-feedback">
                @error('financial_year')
                {{ $message }}
                @enderror
              </div>

            </div>

            <div class="col-4">
              <label class="form-label" for="non_comp_amc_rate">Start Date</label>
              <input type="date" class="form-control" id="start_date" name="start_date" placeholder="Start Date" required_ value="{{ old('start_date') }}">
              <div class="invalid-feedback">
                @error('non_comp_amc_rate')
                {{ $message }}
                @enderror
              </div>

            </div>

            <div class="col-4">
              <label class="form-label" for="comp_amc_rate">End Date</label>
              <input type="date" class="form-control" id="end_date" name="end_date" placeholder="End Date" required_ value="{{ old('end_date') }}">
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