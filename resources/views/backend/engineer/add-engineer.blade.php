@extends('backend.common.master')
@section('main-section')

  <div class="container-fluid">
    <div class="page-title">
      <div class="row">
        <div class="col-6">
          <h4>Add Engineer</h4>
        </div>
        <div class="col-6">
          <ol class="breadcrumb justify-content-end">
            <li class="breadcrumb-item"><a href="{{ route('admin.engineer.index') }}">Engineer List</a></li>
            <li class="breadcrumb-item active">Add Engineer</li>
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
              action="{{ route('admin.engineer.store') }}">
              @csrf
              <div class="col-md-4">
                <label class="form-label-premium" for="user_name">Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control form-control-premium" id="user_name" name="user_name"
                  placeholder="User Name" required value="{{ old('user_name') }}">
                <div class="invalid-feedback">
                  @error('user_name')
                    {{ $message }}
                  @enderror
                </div>
              </div>

              <div class="col-md-4">
                <label class="form-label-premium" for="email1">Email 1 <span class="text-danger">*</span></label>
                <input type="email" class="form-control form-control-premium" id="email1" name="email1"
                  placeholder="Email" required value="{{ old('email1') }}">
                <div class="invalid-feedback">
                  @error('email1')
                    {{ $message }}
                  @enderror
                </div>
              </div>

              <div class="col-md-4">
                <label class="form-label-premium" for="email2">Email 2 <span class="text-danger">*</span></label>
                <input type="email" class="form-control form-control-premium" id="email2" name="email2"
                  placeholder="Email" required value="{{ old('email2') }}">
                <div class="invalid-feedback">
                  @error('email2')
                    {{ $message }}
                  @enderror
                </div>
              </div>

              <div class="col-md-4">
                <label class="form-label-premium" for="phone1">Phone 1 <span class="text-danger">*</span></label>
                <input type="text" class="form-control form-control-premium" id="phone1" name="phone1"
                  placeholder="Phone 1" required value="{{ old('phone1') }}">
                <div class="invalid-feedback">
                  @error('phone1')
                    {{ $message }}
                  @enderror
                </div>
              </div>

              <div class="col-md-4">
                <label class="form-label-premium" for="phone2">Phone 2 <span class="text-danger">*</span></label>
                <input type="text" class="form-control form-control-premium" id="phone2" name="phone2" placeholder="Phone"
                  required value="{{ old('phone2') }}">
                <div class="invalid-feedback">
                  @error('phone2')
                    {{ $message }}
                  @enderror
                </div>
              </div>


              <div class="col-md-4">
                <label class="form-label-premium" for="designation"> Designation <span
                    class="text-danger">*</span></label>
                <input type="text" class="form-control form-control-premium" id="designation" name="designation"
                  placeholder="Designation" required value="{{ old('designation') }}">
                <div class="invalid-feedback">
                  @error('designation')
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