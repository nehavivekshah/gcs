@extends('backend.common.master')
@section('main-section')

<div class="container-fluid">
  <div class="page-title">
    <div class="row">
      <div class="col-6">
        <h4>Edit Coordinator</h4>
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
          <form class="row g-3 needs-validation custom-input" novalidate="" method="post" action="{{ route('admin.coordinator.update', ['uuid' => $coordinators->uuid]) }}">
            @csrf
            @method('PATCH')
            <div class="col-4">
              <label class="form-label" for="user_name">User name</label>
              <input type="text" class="form-control" id="user_name" name="user_name" placeholder="User Name" required_ value="{{ $coordinators->user_name }}">
              <div class="invalid-feedback">
                @error('user_name')
                {{ $message }}
                @enderror
              </div>

            </div>

            <div class="col-4">
              <label class="form-label" for="user_password">Password</label>
              <input type="text" class="form-control" id="user_password" name="user_password" placeholder="User Password" required_ value="{{ $coordinators->password }}">
              <div class="invalid-feedback">
                @error('user_password')
                {{ $message }}
                @enderror
              </div>

            </div>

            <div class="col-4">
              <label class="form-label" for="outlook_email">Outlook Email</label>
              <input type="email" class="form-control" id="outlook_email" name="outlook_email" placeholder="Outlook Email" required_ value="{{ $coordinators->outlook_email }}">
              <div class="invalid-feedback">
                @error('outlook_email')
                {{ $message }}
                @enderror
              </div>

            </div>


            <div class="col-4">
              <label class="form-label" for="outlook_password">Outlook Password</label>
              <input type="text" class="form-control" id="outlook_password" name="outlook_password" placeholder="Outlook Password" required_ value="{{ $coordinators->outlook_password }}">
              <div class="invalid-feedback">
                @error('outlook_password')
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