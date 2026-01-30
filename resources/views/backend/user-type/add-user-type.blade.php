@extends('backend.common.master')
@section('main-section')

<div class="container-fluid">
  <div class="page-title">
    <div class="row">
      <div class="col-6">
        <h4>Add User Type</h4>
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
          <form class="row g-3 needs-validation custom-input" novalidate="" method="post" action="{{ route('admin.user-type.store') }}">
            @csrf
            <div class="col-4">
              <label class="form-label" for="user_type">User Type</label>
              <input type="text" class="form-control" id="user_type" name="user_type" placeholder="User Type" required_ value="{{ old('user_type') }}">
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