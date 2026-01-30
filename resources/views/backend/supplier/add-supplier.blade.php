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
        <div class="col-6 text-end">
          <a href="{{ route('admin.supplier.index') }}">
            <button type="button" class="btn" style="background:#bf0103;color:white;"> Back</button>
          </a>
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
              action="{{ route('admin.supplier.store') }}">
              @csrf



              <div class="row gy-3">

                <div class="col-4">
                  <label class="form-label" for="supplier_name">Supplier Name</label>
                  <input type="text" class="form-control" id="supplier_name" name="supplier_name"
                    value="{{ old('supplier_name') }}">
                  <div class="invalid-feedback">@error('supplier_name') {{ $message }} @enderror</div>
                </div>

                <div class="col-4">
                  <label class="form-label" for="mobile_no">Mobile No</label>
                  <input type="text" class="form-control" id="mobile_no" name="mobile_no" value="{{ old('mobile_no') }}">
                  <div class="invalid-feedback">@error('mobile_no') {{ $message }} @enderror</div>
                </div>

                <div class="col-4">
                  <label class="form-label" for="contact_person">Contact Person</label>
                  <input type="text" class="form-control" id="contact_person" name="contact_person"
                    value="{{ old('contact_person') }}">
                  <div class="invalid-feedback">@error('contact_person') {{ $message }} @enderror</div>
                </div>

                <div class="col-4">
                  <label class="form-label" for="email">Email</label>
                  <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}">
                  <div class="invalid-feedback">@error('email') {{ $message }} @enderror</div>
                </div>

                <div class="col-4">
                  <label class="form-label" for="phone_1">Phone 1</label>
                  <input type="text" class="form-control" id="phone_1" name="phone_1" value="{{ old('phone_1') }}">
                  <div class="invalid-feedback">@error('phone_1') {{ $message }} @enderror</div>
                </div>

                <div class="col-4">
                  <label class="form-label" for="phone_2">Phone 2</label>
                  <input type="text" class="form-control" id="phone_2" name="phone_2" value="{{ old('phone_2') }}">
                  <div class="invalid-feedback">@error('phone_2') {{ $message }} @enderror</div>
                </div>

                <div class="col-6">
                  <label class="form-label" for="address_line_1">Address Line 1</label>
                  <input type="text" class="form-control" id="address_line_1" name="address_line_1"
                    value="{{ old('address_line_1') }}">
                  <div class="invalid-feedback">@error('address_line_1') {{ $message }} @enderror</div>
                </div>

                <div class="col-6">
                  <label class="form-label" for="address_line_2">Address Line 2</label>
                  <input type="text" class="form-control" id="address_line_2" name="address_line_2"
                    value="{{ old('address_line_2') }}">
                  <div class="invalid-feedback">@error('address_line_2') {{ $message }} @enderror</div>
                </div>

                <div class="col-4">
                  <label class="form-label" for="area_id">Area</label>
                  <select class="form-control select2" id="area_id" name="area_id" required>
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
                  <label class="form-label" for="city_id">City</label>
                  <select class="form-control select2" id="city_id" name="city_id" required>
                    <option value=""> Select City</option>
                  </select>
                  <div class="invalid-feedback">
                    @error('city_id')
                      {{ $message }}
                    @enderror
                  </div>

                </div>

                <div class="col-4">
                  <label class="form-label" for="state_id">State</label>
                  <select class="form-control select2" id="state_id" name="state_id">
                    <option value=""> Select State</option>
                  </select>
                  <div class="invalid-feedback">@error('state_id') {{ $message }} @enderror</div>
                </div>


                <div class="col-4">
                  <label class="form-label" for="pincode">Pincode</label>
                  <input type="text" class="form-control" id="pincode" name="pincode" value="{{ old('pincode') }}">
                  <div class="invalid-feedback">@error('pincode') {{ $message }} @enderror</div>
                </div>

                <div class="col-4">
                  <label class="form-label" for="pan">PAN</label>
                  <input type="text" class="form-control" id="pan" name="pan" value="{{ old('pan') }}">
                  <div class="invalid-feedback">@error('pan') {{ $message }} @enderror</div>
                </div>

                <div class="col-4">
                  <label class="form-label" for="gst">GST</label>
                  <input type="text" class="form-control" id="gst" name="gst" value="{{ old('gst') }}">
                  <div class="invalid-feedback">@error('gst') {{ $message }} @enderror</div>
                </div>

                <!-- <div class="col-4">
                  <label class="form-label" for="vat">VAT</label>
                  <input type="text" class="form-control" id="vat" name="vat" value="{{ old('vat') }}">
                  <div class="invalid-feedback">@error('vat') {{ $message }} @enderror</div>
                </div> -->

                <!-- <div class="col-4">
                  <label class="form-label" for="tin">TIN</label>
                  <input type="text" class="form-control" id="tin" name="tin" value="{{ old('tin') }}">
                  <div class="invalid-feedback">@error('tin') {{ $message }} @enderror</div>
                </div> -->

                <!-- <div class="col-4">
                  <label class="form-label" for="cst">CST</label>
                  <input type="text" class="form-control" id="cst" name="cst" value="{{ old('cst') }}">
                  <div class="invalid-feedback">@error('cst') {{ $message }} @enderror</div>
                </div>

                <div class="col-4">
                  <label class="form-label" for="fax">Fax</label>
                  <input type="text" class="form-control" id="fax" name="fax" value="{{ old('fax') }}">
                  <div class="invalid-feedback">@error('fax') {{ $message }} @enderror</div>
                </div> -->

                <div class="col-4">
                  <label class="form-label" for="web_sites">Website</label>
                  <input type="text" class="form-control" id="web_sites" name="web_sites" value="{{ old('web_sites') }}">
                  <div class="invalid-feedback">@error('web_sites') {{ $message }} @enderror</div>
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