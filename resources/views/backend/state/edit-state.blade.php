@extends('backend.common.master')
@section('main-section')

  <div class="container-fluid">
    <div class="page-title">
      <div class="row">
        <div class="col-6">
          <h4>Edit State</h4>
        </div>
        <div class="col-6">
          <ol class="breadcrumb justify-content-end">
            <li class="breadcrumb-item"><a href="{{ route('admin.state.index') }}">State List</a></li>
            <li class="breadcrumb-item active">Edit State</li>
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
              action="{{ route('admin.state.update', ['uuid' => $states->uuid]) }}">
              @csrf
              @method('PATCH')
              <div class="col-md-4">
                <label class="form-label-premium" for="state">State <span class="text-danger">*</span></label>
                <input type="text" class="form-control form-control-premium" id="state" name="state" placeholder="State"
                  required value="{{ $states->state }}">
                <div class="invalid-feedback">
                  @error('state')
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