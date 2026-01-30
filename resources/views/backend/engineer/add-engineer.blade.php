@extends('backend.common.master')
@section('main-section')

<div class="container-fluid">
  <div class="page-title">
    <div class="row">
      <div class="col-6">
        <h4>Add Engineer</h4>
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
          <form class="row g-3 needs-validation custom-input" novalidate="" method="post" action="{{ route('admin.engineer.store') }}">
            @csrf
            <div class="col-4">
              <label class="form-label" for="user_name">Name</label>
              <input type="text" class="form-control" id="user_name" name="user_name" placeholder="User Name" required_ value="{{ old('user_name') }}">
              <div class="invalid-feedback">
                @error('user_name')
                {{ $message }}
                @enderror
              </div>

            </div>

            <div class="col-4">
              <label class="form-label" for="email1">Email 1</label>
               <input type="email" class="form-control" id="email1" name="email1" placeholder="Email" required_ value="{{ old('email') }}">
              <div class="invalid-feedback">
                @error('email1')
                {{ $message }}
                @enderror
              </div>

            </div>

            <div class="col-4">
              <label class="form-label" for="email2">Email 2</label>
              <input type="email" class="form-control" id="email2" name="email2" placeholder="Email" required_ value="{{ old('email') }}">
              <div class="invalid-feedback">
                @error('email2')
                {{ $message }}
                @enderror
              </div>

            </div>

            <div class="col-4">
              <label class="form-label" for="phone1">Phone 1</label>
               <input type="text" class="form-control" id="phone1" name="phone1" placeholder="User Name" required_ value="{{ old('phone1') }}">
              <div class="invalid-feedback">
                @error('phone1')
                {{ $message }}
                @enderror
              </div>

            </div>

            <div class="col-4">
              <label class="form-label" for="phone2">Phone 2</label>
               <input type="text" class="form-control" id="phone2" name="phone2" placeholder="Phone" required_ value="{{ old('phone2') }}">
              <div class="invalid-feedback">
                @error('phone2')
                {{ $message }}
                @enderror
              </div>

            </div>

            
            <div class="col-4">
              <label class="form-label" for="designation"> Designation</label>
               <input type="text" class="form-control" id="designation" name="designation" placeholder="Designation" required_ value="{{ old('designation') }}">
              <div class="invalid-feedback">
                @error('designation')
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