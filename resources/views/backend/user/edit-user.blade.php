@extends('backend.common.master')
@section('main-section')

  <div class="container-fluid">
    <div class="page-title">
      <div class="row">
        <div class="col-6">
          <h4>Edit User</h4>
        </div>
        <div class="col-6">
          <ol class="breadcrumb justify-content-end">
            <li class="breadcrumb-item"><a href="{{ route('admin.user.index') }}">User List</a></li>
            <li class="breadcrumb-item active">Edit User</li>
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
              action="{{ route('admin.user.update', ['uuid' => $users->uuid]) }}">
              @csrf
              @method('PATCH')

              <div class="col-md-4">
                <label class="form-label-premium" for="user_name">User name <span class="text-danger">*</span></label>
                <input type="text" class="form-control form-control-premium" id="user_name" name="user_name"
                  placeholder="User Name" required value="{{ $users->user_name }}">
                <div class="invalid-feedback">
                  @error('user_name')
                    {{ $message }}
                  @enderror
                </div>
              </div>

              <div class="col-md-4">
                <label class="form-label-premium" for="user_password">Password <span class="text-danger">*</span></label>
                <input type="text" class="form-control form-control-premium" id="user_password" name="user_password"
                  placeholder="User Password" required value="{{ $users->password }}">
                <div class="invalid-feedback">
                  @error('user_password')
                    {{ $message }}
                  @enderror
                </div>
              </div>

              <div class="col-md-4">
                <label class="form-label-premium" for="outlook_email">Outlook Email <span class="text-danger">*</span></label>
                <input type="email" class="form-control form-control-premium" id="outlook_email" name="outlook_email"
                  placeholder="Outlook Email" required value="{{ $users->outlook_email }}">
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
                  placeholder="Outlook Password" required value="{{ $users->outlook_password }}">
                <div class="invalid-feedback">
                  @error('outlook_password')
                    {{ $message }}
                  @enderror
                </div>
              </div>


              <div class="col-md-4">
                <label class="form-label-premium" for="user_type">User Type <span class="text-danger">*</span></label>
                <select class="form-control form-control-premium" id="user_type" name="user_type">
                  <option value=""> Select Type </option>
                  @foreach($userTypeList as $userType)
                    <option value="{{ $userType->id }}" @selected($userType->id == $users->user_type)>
                      {{ $userType->user_type }} </option>
                  @endforeach
                </select>
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