@extends('backend.common.master')
@section('main-section')

  <div class="container-fluid">
    <div class="page-title">
      <div class="row">
        <div class="col-6">
          <h4>Add Coordinator</h4>
        </div>
        <div class="col-6">
          <ol class="breadcrumb justify-content-end">
            <li class="breadcrumb-item"><a href="{{ route('admin.coordinator.index') }}">Coordinator List</a></li>
            <li class="breadcrumb-item active">Add Coordinator</li>
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
              action="{{ route('admin.coordinator.store') }}">
              @csrf

              <input type="text" name="user_type" value="4" hidden>

              <div class="col-md-4">
                <label class="form-label-premium" for="user_name">User name <span class="text-danger">*</span></label>
                <input type="text" class="form-control form-control-premium" id="user_name" name="user_name"
                  placeholder="User Name" required value="{{ old('user_name') }}">
                <div class="invalid-feedback">
                  @error('user_name')
                    {{ $message }}
                  @enderror
                </div>
              </div>

              <div class="col-md-4">
                <label class="form-label-premium" for="user_password">Password <span class="text-danger">*</span></label>
                <input type="text" class="form-control form-control-premium" id="user_password" name="user_password"
                  placeholder="User Password" required value="{{ old('user_password') }}">
                <div class="invalid-feedback">
                  @error('user_password')
                    {{ $message }}
                  @enderror
                </div>
              </div>

              <div class="col-md-4">
                <label class="form-label-premium" for="outlook_email">Outlook Email <span
                    class="text-danger">*</span></label>
                <input type="email" class="form-control form-control-premium" id="outlook_email" name="outlook_email"
                  placeholder="Outlook Email" required value="{{ old('outlook_email') }}">
                <div class="invalid-feedback">
                  @error('outlook_email')
                    {{ $message }}
                  @enderror
                </div>
              </div>


              <div class="col-md-4">
                <label class="form-label-premium" for="outlook_password">Outlook Password <span
                    class="text-danger">*</span></label>
                <input type="text" class="form-control form-control-premium" id="outlook_password" name="outlook_password"
                  placeholder="Outlook Password" required value="{{ old('outlook_password') }}">
                <div class="invalid-feedback">
                  @error('outlook_password')
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