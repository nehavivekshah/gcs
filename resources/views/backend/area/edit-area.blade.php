@extends('backend.common.master')

@push('styles')
  <style>
    /* ===============================
     ALL FORM INPUT TEXT COLOR BLACK
     =============================== */

    /* Text inputs, textarea */
    input,
    textarea {
      color: #000 !important;
    }

    /* Normal select dropdown */
    select {
      color: #000 !important;
    }

    /* Placeholder color */
    ::placeholder {
      color: #000 !important;
      opacity: 1;
    }

    /* Select2 selected value */
    .select2-container--default .select2-selection--single {
      color: #000 !important;
    }

    /* Select2 dropdown options */
    .select2-container--default .select2-results__option {
      color: #000 !important;
    }

    /* Select2 highlighted option */
    .select2-container--default .select2-results__option--highlighted {
      color: #000 !important;
      background-color: #e9ecef !important;
    }

    /* Select2 dropdown background */
    .select2-dropdown {
      background-color: #fff !important;
    }

    /* Disabled inputs */
    input:disabled,
    select:disabled,
    textarea:disabled {
      color: #000 !important;
    }

    /* Validation text color fix */
    .was-validated .form-control:invalid,
    .form-control.is-invalid {
      color: #000 !important;
    }
  </style>
@endpush

@section('main-section')

  <div class="container-fluid">
    <div class="page-title">
      <div class="row">
        <div class="col-6">
          <h4>Edit Area</h4>
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
            <form class="row g-3 needs-validation custom-input" novalidate="" method="post"
              action="{{ route('admin.area.update', ['uuid' => $area->uuid]) }}">
              @csrf
              @method('PATCH')

              <div class="col-4">
                <label class="form-label" for="area">Area</label>
                <input type="text" class="form-control" id="area" name="area" placeholder="Area" required_
                  value="{{ $area->area }}">
                <div class="invalid-feedback">
                  @error('amc_product')
                    {{ $message }}
                  @enderror
                </div>

              </div>

              <div class="col-4">
                <label class="form-label" for="city_id">City</label>
                <select class="form-control select2" id="city_id" name="city_id" required>
                  <option value="">Select City</option>
                  @foreach($cityList as $cities)
                    <option value="{{ $cities->id }}" @selected($cities->id == $area->city_id)>
                      {{ $cities->city }}
                    </option>
                  @endforeach
                </select>
                <div class="invalid-feedback">
                  @error('city_id') {{ $message }} @enderror
                </div>
              </div>

              <div class="col-4">
                <label class="form-label" for="state_id">State</label>
                <select class="form-control select2" id="state_id" name="state_id" required>
                  <option value="">Select State</option>
                  @foreach($stateList as $states)
                    <option value="{{ $states->id }}" @selected($states->id == $area->state_id)>
                      {{ $states->state }}
                    </option>
                  @endforeach
                </select>
                <div class="invalid-feedback">
                  @error('state_id') {{ $message }} @enderror
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

@push('scripts')

  <!-- Select2 CSS -->
  <link rel="stylesheet" href="{{ asset('public/assets/css/vendors/select2.css') }}">

  <!-- Select2 JS -->
  <script src="{{ asset('public/assets/js/select2/select2.full.min.js') }}"></script>

  <script>
    $(document).ready(function () {

      /* Initialize searchable dropdown */
      $('.select2').select2({
        placeholder: 'Select an option',
        allowClear: true,
        width: '100%'
      });

      /* City -> State AJAX */
      $('#city_id').on('change', function () {
        var cityID = $(this).val();

        if (cityID) {
          $.ajax({
            url: "{{ route('admin.area.city.state') }}",
            type: "POST",
            data: {
              cityID: cityID,
              _token: "{{ csrf_token() }}"
            },
            dataType: "json",
            success: function (res) {
              $('#state_id').empty()
                .append('<option value="">Select State</option>');

              $.each(res, function (key, value) {
                $('#state_id').append(
                  '<option value="' + value.id + '" selected>' + value.state + '</option>'
                );
              });

              // Refresh select2 after ajax
              $('#state_id').trigger('change');
            },
            error: function () {
              alert('Unable to fetch states');
            }
          });
        } else {
          $('#state_id').empty()
            .append('<option value="">Select State</option>');
        }
      });

    });
  </script>

@endpush