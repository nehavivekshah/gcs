@extends('backend.common.master')
@section('main-section')

<div class="container-fluid">
  <div class="page-title">
    <div class="row">
      <div class="col-6">
        <h4>Add City</h4>
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
          <form class="row g-3 needs-validation custom-input" novalidate="" method="post" action="{{ route('admin.city.store') }}">
            @csrf

            <div class="col-4">
              <label class="form-label" for="state_id">State</label>
              <select class="form-control" id="state_id" name="state_id" required>
                <option value=""> Select State</option>
                @foreach($stateList as $states)
                  <option value="{{ $states->id}}">{{ $states->state}}</option>
                @endforeach
              </select>
              <div class="invalid-feedback">
                @error('city')
                {{ $message }}
                @enderror
              </div>

            </div>

            <div class="col-4">
              <label class="form-label" for="city">City</label>
              <input type="text" class="form-control" id="city" name="city" placeholder="City" required_ value="{{ old('city') }}">
              <div class="invalid-feedback">
                @error('city')
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