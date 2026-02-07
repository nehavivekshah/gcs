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
          <h4>Add Supplier</h4>
        </div>
        <div class="col-6">
          <ol class="breadcrumb justify-content-end">
            <li class="breadcrumb-item"><a href="{{ route('admin.supplier.index') }}">Supplier List</a></li>
            <li class="breadcrumb-item active">Add Supplier</li>
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
              action="{{ route('admin.supplier.store') }}">
              @csrf



              <div class="row gy-3">

                <div class="col-4">
                  <label class="form-label-premium" for="supplier_name">Supplier Name</label>
                  <input type="text" class="form-control form-control-premium" id="supplier_name" name="supplier_name"
                    value="{{ old('supplier_name') }}">
                  <div class="invalid-feedback">@error('supplier_name') {{ $message }} @enderror</div>
                </div>

                <div class="col-4">
                  <label class="form-label-premium" for="mobile_no">Mobile No</label>
                  <input type="text" class="form-control form-control-premium" id="mobile_no" name="mobile_no"
                    value="{{ old('mobile_no') }}">
                  <div class="invalid-feedback">@error('mobile_no') {{ $message }} @enderror</div>
                </div>

                <div class="col-4">
                  <label class="form-label-premium" for="contact_person">Contact Person</label>
                  <input type="text" class="form-control form-control-premium" id="contact_person" name="contact_person"
                    value="{{ old('contact_person') }}">
                  <div class="invalid-feedback">@error('contact_person') {{ $message }} @enderror</div>
                </div>

                <div class="col-4">
                  <label class="form-label-premium" for="email">Email</label>
                  <input type="email" class="form-control form-control-premium" id="email" name="email"
                    value="{{ old('email') }}">
                  <div class="invalid-feedback">@error('email') {{ $message }} @enderror</div>
                </div>

                <div class="col-4">
                  <label class="form-label-premium" for="phone_1">Phone 1</label>
                  <input type="text" class="form-control form-control-premium" id="phone_1" name="phone_1"
                    value="{{ old('phone_1') }}">
                  <div class="invalid-feedback">@error('phone_1') {{ $message }} @enderror</div>
                </div>

                <div class="col-4">
                  <label class="form-label-premium" for="phone_2">Phone 2</label>
                  <input type="text" class="form-control form-control-premium" id="phone_2" name="phone_2"
                    value="{{ old('phone_2') }}">
                  <div class="invalid-feedback">@error('phone_2') {{ $message }} @enderror</div>
                </div>

                <div class="col-6">
                  <label class="form-label-premium" for="address_line_1">Address Line 1</label>
                  <input type="text" class="form-control form-control-premium" id="address_line_1" name="address_line_1"
                    value="{{ old('address_line_1') }}">
                  <div class="invalid-feedback">@error('address_line_1') {{ $message }} @enderror</div>
                </div>

                <div class="col-6">
                  <label class="form-label-premium" for="address_line_2">Address Line 2</label>
                  <input type="text" class="form-control form-control-premium" id="address_line_2" name="address_line_2"
                    value="{{ old('address_line_2') }}">
                  <div class="invalid-feedback">@error('address_line_2') {{ $message }} @enderror</div>
                </div>

                <div class="col-4">
                  <label class="form-label-premium" for="area_id">Area</label>
                  <select class="form-control form-control-premium select2" id="area_id" name="area_id" required>
                    <option value=""> Select Area</option>
                    @foreach($areaList as $areas)
                      <option value="{{ $areas->id }}">{{ $areas->area }}</option>
                    @endforeach
                  </select>
                  <div class="invalid-feedback">
                    @error('area_id')
                      {{ $message }}
                    @enderror
                  </div>

                </div>

                <div class="col-4">
                  <label class="form-label-premium" for="city_id">City</label>
                  <select class="form-control form-control-premium select2" id="city_id" name="city_id" required>
                    <option value=""> Select City</option>
                  </select>
                  <div class="invalid-feedback">
                    @error('city_id')
                      {{ $message }}
                    @enderror
                  </div>

                </div>

                <div class="col-4">
                  <label class="form-label-premium" for="state_id">State</label>
                  <select class="form-control form-control-premium select2" id="state_id" name="state_id">
                    <option value=""> Select State</option>
                  </select>
                  <div class="invalid-feedback">@error('state_id') {{ $message }} @enderror</div>
                </div>


                <div class="col-4">
                  <label class="form-label-premium" for="pincode">Pincode</label>
                  <input type="text" class="form-control form-control-premium" id="pincode" name="pincode"
                    value="{{ old('pincode') }}">
                  <div class="invalid-feedback">@error('pincode') {{ $message }} @enderror</div>
                </div>

                <div class="col-4">
                  <label class="form-label-premium" for="pan">PAN</label>
                  <input type="text" class="form-control form-control-premium" id="pan" name="pan"
                    value="{{ old('pan') }}">
                  <div class="invalid-feedback">@error('pan') {{ $message }} @enderror</div>
                </div>

                <div class="col-4">
                  <label class="form-label-premium" for="gst">GST</label>
                  <input type="text" class="form-control form-control-premium" id="gst" name="gst"
                    value="{{ old('gst') }}">
                  <div class="invalid-feedback">@error('gst') {{ $message }} @enderror</div>
                </div>

                <div class="col-4">
                  <label class="form-label-premium" for="web_sites">Website</label>
                  <input type="text" class="form-control form-control-premium" id="web_sites" name="web_sites"
                    value="{{ old('web_sites') }}">
                  <div class="invalid-feedback">@error('web_sites') {{ $message }} @enderror</div>
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

@push('scripts')

  <!-- Select2 CSS -->
  <link rel="stylesheet" href="{{ asset('public/assets/css/vendors/select2.css') }}">

  <!-- Select2 JS -->
  <script src="{{ asset('public/assets/js/select2/select2.full.min.js') }}"></script>

  <script>
    $(document).ready(function () {

      $('.select2').select2({
        placeholder: 'Select an option',
        allowClear: true,
        width: '100%'
      });

      $('#area_id').on('change', function () {

        var areaID = $(this).val();
        if (areaID) {
          $.ajax({
            url: "{{ route('admin.supplier.area.city') }}",
            type: "POST",
            data: {
              areaID: areaID,
              _token: "{{ csrf_token() }}"
            },
            dataType: "json",
            success: function (res) {

              if (res.status) {

                // CITY
                $('#city_id').empty()
                  .append('<option value="' + res.city.id + '">' + res.city.name + '</option>');

                // STATE
                $('#state_id').empty()
                  .append('<option value="' + res.state.id + '">' + res.state.name + '</option>');
              }
            },
            error: function () {
              alert('Unable to fetch city/state');
            }
          });
        } else {
          $('#city_id').empty().append('<option value="">Select City</option>');
          $('#state_id').empty().append('<option value="">Select State</option>');
        }
      });

    });
  </script>


@endpush