@extends('backend.common.master')
@section('main-section')

  <div class="container-fluid">
    <div class="page-title">
      <div class="row">
        <div class="col-6">
          <h4>Edit City</h4>
        </div>
        <div class="col-6">
          <ol class="breadcrumb justify-content-end">
            <li class="breadcrumb-item"><a href="{{ route('admin.city.index') }}">City List</a></li>
            <li class="breadcrumb-item active">Edit City</li>
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
              action="{{ route('admin.city.update', ['uuid' => $cities->uuid]) }}">
              @csrf
              @method('PATCH')

              <div class="col-md-4">
                <label class="form-label-premium" for="state_id">State <span class="text-danger">*</span></label>
                <select class="form-control form-control-premium" id="state_id" name="state_id" required>
                  <option value=""> Select State</option>
                  @foreach($stateList as $states)
                    <option value="{{ $states->id }}" @selected($states->id == $cities->state_id)>{{ $states->state }}
                    </option>
                  @endforeach
                </select>
                <div class="invalid-feedback">
                  @error('city')
                    {{ $message }}
                  @enderror
                </div>
              </div>

              <div class="col-md-4">
                <label class="form-label-premium" for="city">City <span class="text-danger">*</span></label>
                <input type="text" class="form-control form-control-premium" id="city" name="city" placeholder="City"
                  required value="{{ $cities->city }}">
                <div class="invalid-feedback">
                  @error('amc_product')
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