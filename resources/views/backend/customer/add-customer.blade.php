@extends('backend.common.master')
@section('main-section')

  <div class="container-fluid">
    <div class="page-title">
      <div class="row">
        <div class="col-6">
          <h4>Add Customer</h4>
        </div>
      </div>
    </div>
  </div>

  <div class="container-fluid">
    <div class="row">
      <div class="col-xl-12">
        <div class="card card-premium height-equal">
          <div class="card-body">

            <form class="row g-3 needs-validation custom-input" novalidate method="post"
              action="{{ route('admin.customer.store') }}">
              @csrf

              <div class="row gy-3">

                <div class="col-12">
                  <h5 class="section-title"><i class="icon-user me-2"></i>Basic Customer Info</h5>
                </div>
                <div class="col-4">
                  <label class="form-label form-label-premium">Customer Name</label>
                  <input type="text" class="form-control form-control-premium" name="customer_name"
                    value="{{ old('customer_name') }}">
                  <div class="invalid-feedback">@error('customer_name') {{ $message }} @enderror</div>
                </div>

                <div class="col-4">
                  <label class="form-label form-label-premium">Customer Type</label>
                  <select class="form-control form-control-premium" name="customer_type">
                    <option value="">Select Type</option>
                    <option value="GCS">GCS</option>
                    <option value="NON GCS">NON GCS</option>
                  </select>
                  <div class="invalid-feedback">@error('customer_type') {{ $message }} @enderror</div>
                </div>

                <div class="col-4">
                  <label class="form-label form-label-premium">Customer Category</label>
                  <select class="form-control form-control-premium" name="customer_category">
                    <option value="">Select Category</option>
                    <option value="Corporate">Corporate</option>
                    <option value="Semi-Corporate">Semi-Corporate</option>
                    <option value="In-House">In-House</option>
                  </select>
                  <div class="invalid-feedback">@error('customer_category') {{ $message }} @enderror</div>
                </div>

                <div class="col-12">
                  <h5 class="section-title"><i class="icon-mobile me-2"></i>Contact Details</h5>
                </div>
                <div class="col-4">
                  <label class="form-label form-label-premium">Contact Person</label>
                  <input type="text" class="form-control form-control-premium" name="contact_person"
                    value="{{ old('contact_person') }}">
                  <div class="invalid-feedback">@error('contact_person') {{ $message }} @enderror</div>
                </div>

                <div class="col-4">
                  <label class="form-label form-label-premium">Mobile No</label>
                  <input type="text" class="form-control form-control-premium" name="mobile_no"
                    value="{{ old('mobile_no') }}">
                  <div class="invalid-feedback">@error('mobile_no') {{ $message }} @enderror</div>
                </div>

                <div class="col-4">
                  <label class="form-label form-label-premium">Email</label>
                  <input type="email" class="form-control form-control-premium" name="email" value="{{ old('email') }}">
                  <div class="invalid-feedback">@error('email') {{ $message }} @enderror</div>
                </div>

                <div class="col-12">
                  <h5 class="section-title"><i class="icon-location-pin me-2"></i>Address</h5>
                </div>
                <div class="col-6">
                  <label class="form-label form-label-premium">Address Line 1</label>
                  <input type="text" class="form-control form-control-premium" name="address_line_1"
                    value="{{ old('address_line_1') }}">
                  <div class="invalid-feedback">@error('address_line_1') {{ $message }} @enderror</div>
                </div>

                <div class="col-6">
                  <label class="form-label form-label-premium">Address Line 2</label>
                  <input type="text" class="form-control form-control-premium" name="address_line_2"
                    value="{{ old('address_line_2') }}">
                  <div class="invalid-feedback">@error('address_line_2') {{ $message }} @enderror</div>
                </div>

                <div class="col-12">
                  <h5 class="section-title"><i class="icon-map me-2"></i>Location</h5>
                </div>

                <div class="col-4">
                  <label class="form-label form-label-premium">Area</label>
                  <select class="form-control form-control-premium select2" id="area_id" name="area_id">
                    <option value="">Select Area</option>
                    @foreach($areaList as $areas)
                      <option value="{{ $areas->id }}">{{ $areas->area }}</option>
                    @endforeach
                  </select>
                  <div class="invalid-feedback">@error('area_id') {{ $message }} @enderror</div>
                </div>


                <div class="col-4">
                  <label class="form-label form-label-premium">City</label>
                  <select class="form-control form-control-premium select2" id="city_id" name="city_id">
                    <option value="">Select City</option>
                  </select>
                  <div class="invalid-feedback">@error('city_id') {{ $message }} @enderror</div>
                </div>

                <div class="col-4">
                  <label class="form-label form-label-premium">State</label>
                  <select class="form-control form-control-premium select2" id="state_id" name="state_id">
                    <option value="">Select State</option>

                  </select>
                  <div class="invalid-feedback">@error('state_id') {{ $message }} @enderror</div>
                </div>

                <div class="col-4">
                  <label class="form-label form-label-premium">Pincode</label>
                  <input type="text" class="form-control form-control-premium" name="pincode"
                    value="{{ old('pincode') }}">
                  <div class="invalid-feedback">@error('pincode') {{ $message }} @enderror</div>
                </div>

                <div class="col-12">
                  <h5 class="section-title"><i class="icon-headphone-alt me-2"></i>Communication</h5>
                </div>
                <div class="col-4">
                  <label class="form-label form-label-premium">Phone 1</label>
                  <input type="text" class="form-control form-control-premium" name="phone_1"
                    value="{{ old('phone_1') }}">
                </div>

                <div class="col-4">
                  <label class="form-label form-label-premium">Phone 2</label>
                  <input type="text" class="form-control form-control-premium" name="phone_2"
                    value="{{ old('phone_2') }}">
                </div>

                <div class="col-4">
                  <label class="form-label form-label-premium">Website</label>
                  <input type="text" class="form-control form-control-premium" name="website"
                    value="{{ old('website') }}">
                </div>

                <div class="col-12">
                  <h5 class="section-title"><i class="icon-file-text me-2"></i>Tax Details</h5>
                </div>

                <div class="col-4">
                  <label class="form-label form-label-premium">GST</label>
                  <input type="text" class="form-control form-control-premium" name="gst" value="{{ old('gst') }}">
                </div>
                <!-- <div class="col-4">
                  <label class="form-label form-label-premium">PAN</label>
                  <input type="text" class="form-control form-control-premium" name="pan" value="{{ old('pan') }}">
                </div>

                <div class="col-4">
                  <label class="form-label form-label-premium">VAT</label>
                  <input type="text" class="form-control form-control-premium" name="vat" value="{{ old('vat') }}">
                </div>

                <div class="col-4">
                  <label class="form-label form-label-premium">CST</label>
                  <input type="text" class="form-control form-control-premium" name="cst" value="{{ old('cst') }}">
                </div> -->

                <div class="col-12">
                  <h5 class="section-title"><i class="icon-menu me-2"></i>Other Details</h5>
                </div>
                <!-- <div class="col-4">
                  <label class="form-label form-label-premium">Fax</label>
                  <input type="text" class="form-control form-control-premium" name="fax" value="{{ old('fax') }}">
                </div> -->

                <div class="col-4">
                  <label class="form-label form-label-premium">Credit Days</label>
                  <input type="text" class="form-control form-control-premium" name="credit_days"
                    value="{{ old('credit_days') }}">
                </div>

                <div class="col-4">
                  <label class="form-label form-label-premium">Date of Birth</label>
                  <input type="date" class="form-control form-control-premium" name="date_of_birth"
                    value="{{ old('date_of_birth') }}">
                </div>

                <div class="col-4">
                  <label class="form-label form-label-premium">Account Key</label>
                  <select class="form-control form-control-premium" name="ac_key">
                    <option value="">Select</option>
                    @foreach($coordinateList as $coordinate)
                      <option value="{{ $coordinate->id }}">{{ $coordinate->outlook_email }}</option>
                    @endforeach
                  </select>
                </div>

              </div>

              <div class="col-12 mt-4">
                <div class="d-flex justify-content-end">
                  <button class="btn btn-primary-custom btn-lg">
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
  <link rel="stylesheet" href="{{ asset('assets/css/vendors/select2.css') }}">

  <!-- Select2 JS -->
  <script src="{{ asset('assets/js/select2/select2.full.min.js') }}"></script>

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
            url: "{{ route('admin.customer.area.city') }}",
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