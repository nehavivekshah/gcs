@extends('backend.common.master')
@section('main-section')

<div class="container-fluid">
  <div class="page-title">
    <div class="row">
      <div class="col-6">
        <h4>Edit User</h4>
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
          <form class="row g-3 needs-validation custom-input" novalidate="" method="post" action="{{ route('admin.user.update', ['uuid' => $users->uuid]) }}">
            @csrf
            @method('PATCH')
            <div class="col-4">
              <label class="form-label" for="user_name">User name</label>
              <input type="text" class="form-control" id="user_name" name="user_name" placeholder="User Name" required_ value="{{ $users->user_name }}">
              <div class="invalid-feedback">
                @error('user_name')
                {{ $message }}
                @enderror
              </div>

            </div>

            <div class="col-4">
              <label class="form-label" for="user_password">Password</label>
              <input type="text" class="form-control" id="user_password" name="user_password" placeholder="User Password" required_ value="{{ $users->password }}">
              <div class="invalid-feedback">
                @error('user_password')
                {{ $message }}
                @enderror
              </div>

            </div>

            <div class="col-4">
              <label class="form-label" for="outlook_email">Outlook Email</label>
              <input type="email" class="form-control" id="outlook_email" name="outlook_email" placeholder="Outlook Email" required_ value="{{ $users->outlook_email }}">
              <div class="invalid-feedback">
                @error('outlook_email')
                {{ $message }}
                @enderror
              </div>

            </div>


            <div class="col-4">
              <label class="form-label" for="outlook_password">Outlook Password</label>
              <input type="text" class="form-control" id="outlook_password" name="outlook_password" placeholder="Outlook Password" required_ value="{{ $users->outlook_password }}">
              <div class="invalid-feedback">
                @error('outlook_password')
                {{ $message }}
                @enderror
              </div>

            </div>



            <div class="col-4">
              <label class="form-label" for="user_type">User Type</label>
              <select class="form-control" id="user_type" name="user_type">
                <option value=""> Select Type </option>
                  @foreach($userTypeList as $userType)
                    <option value="{{ $userType->id }}" @selected($userType->id == $users->user_type)> {{ $userType->user_type}} </option>
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