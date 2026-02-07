@extends('backend.common.master')
@section('main-section')

  <div class="container-fluid">
    <div class="page-title">
      <div class="row">
        <div class="col-6">
          <h4>Add User Type</h4>
        </div>
        <div class="col-6">
          <ol class="breadcrumb justify-content-end">
            <li class="breadcrumb-item"><a href="{{ route('admin.user-type.index') }}">User Type List</a></li>
            <li class="breadcrumb-item active">Add User Type</li>
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
              action="{{ route('admin.user-type.store') }}">
              @csrf
              <div class="col-md-4">
                <label class="form-label-premium" for="user_type">User Type <span class="text-danger">*</span></label>
                <input type="text" class="form-control form-control-premium" id="user_type" name="user_type"
                  placeholder="User Type" required value="{{ old('user_type') }}">
                <div class="invalid-feedback">
                  @error('user_type')
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