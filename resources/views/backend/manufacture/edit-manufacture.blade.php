@extends('backend.common.master')
@section('main-section')

<div class="container-fluid">
  <div class="page-title">
    <div class="row">
      <div class="col-6">
        <h4>Edit Manufacture</h4>
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
          <form class="row g-3 needs-validation custom-input" novalidate="" method="post" action="{{ route('admin.manufacture.update', ['uuid' => $manufactures->uuid]) }}">
            @csrf
            @method('PATCH')
            <div class="col-4">
              <label class="form-label" for="manufacture">Manufacture</label>
              <input type="text" class="form-control" id="manufacture" name="manufacture" placeholder="manufacture" required_ value="{{ $manufactures->manufacture }}">
              <div class="invalid-feedback">
                @error('manufacture')
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