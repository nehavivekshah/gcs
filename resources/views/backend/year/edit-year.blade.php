@extends('backend.common.master')
@section('main-section')

  <div class="container-fluid">
    <div class="page-title">
      <div class="row">
        <div class="col-6">
          <h4>Edit Year</h4>
        </div>
        <div class="col-6">
          <ol class="breadcrumb justify-content-end">
            <li class="breadcrumb-item"><a href="{{ route('admin.year.index') }}">Year List</a></li>
            <li class="breadcrumb-item active">Edit Year</li>
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
              action="{{ route('admin.year.update', ['uuid' => $years->uuid]) }}">
              @csrf
              @method('PATCH')
              <div class="col-md-4">
                <label class="form-label-premium" for="financial_year">Financial Year <span
                    class="text-danger">*</span></label>
                <input type="text" class="form-control form-control-premium" id="financial_year" name="financial_year"
                  placeholder="Financial Year" required value="{{ $years->financial_year }}">
                <div class="invalid-feedback">
                  @error('financial_year')
                    {{ $message }}
                  @enderror
                </div>

              </div>

              <div class="col-md-4">
                <label class="form-label-premium" for="start_date">Start Date <span class="text-danger">*</span></label>
                <input type="date" class="form-control form-control-premium" id="start_date" name="start_date"
                  placeholder="Start Date" required value="{{ $years->start_date }}">
                <div class="invalid-feedback">
                  @error('start_date')
                    {{ $message }}
                  @enderror
                </div>

              </div>

              <div class="col-md-4">
                <label class="form-label-premium" for="end_date">End Date <span class="text-danger">*</span></label>
                <input type="date" class="form-control form-control-premium" id="end_date" name="end_date"
                  placeholder="End Date" required value="{{ $years->end_date }}">
                <div class="invalid-feedback">
                  @error('end_date')
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