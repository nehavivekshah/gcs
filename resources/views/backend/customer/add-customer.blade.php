@extends('backend.common.master')
@section('main-section')

  <div class="container-fluid">
    <div class="page-title">
      <div class="row">
        <div class="col-6">
          <h4>Add Customer</h4>
        </div>
        <div class="col-6">
          <ol class="breadcrumb justify-content-end">
            <li class="breadcrumb-item"><a href="{{ route('admin.customer.index') }}">Customer List</a></li>
            <li class="breadcrumb-item active">Add Customer</li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <div class="container-fluid">
    <div class="row">
      <div class="col-xl-12">
        <div class="card card-premium">
          <div class="card-body p-4">

            <form class="row g-4 needs-validation" novalidate method="post" action="{{ route('admin.customer.store') }}">
              @csrf

              <!-- Basic Info -->
              <div class="col-12">
                <h5 class="section-title"><i class="icon-user me-2"></i>Basic Customer Info</h5>
              </div>

              <div class="col-md-4">
                <label class="form-label-premium">Customer Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control form-control-premium" name="customer_name"
                  value="{{ old('customer_name') }}" placeholder="Enter customer name" required>
                <div class="invalid-feedback">@error('customer_name') {{ $message }} @enderror</div>
              </div>

              <div class="col-md-4">
                <label class="form-label-premium">Degination <span class="text-danger">*</span></label>
                <input type="text" class="form-control form-control-premium" name="customer_designation"
                  value="{{ old('customer_designation') }}" placeholder="Enter customer designation" required>
                <div class="invalid-feedback">@error('customer_designation') {{ $message }} @enderror</div>
              </div>

              <div class="col-md-4">
                <label class="form-label-premium">Customer Type</label>
                <select class="form-control form-control-premium" name="customer_type">
                  <option value="">Select Type</option>
                  <option value="GCS">GCS</option>
                  <option value="NON GCS">NON GCS</option>
                </select>
                <div class="invalid-feedback">@error('customer_type') {{ $message }} @enderror</div>
              </div>

              <!-- <div class="col-md-4">
                                                                          <label class="form-label-premium">Customer Category</label>
                                                                          <select class="form-control form-control-premium" name="customer_category">
                                                                            <option value="">Select Category</option>
                                                                            <option value="Corporate">Corporate</option>
                                                                            <option value="Semi-Corporate">Semi-Corporate</option>
                                                                            <option value="In-House">In-House</option>
                                                                          </select>
                                                                          <div class="invalid-feedback">@error('customer_category') {{ $message }} @enderror</div>
                                                                        </div> -->

              <!-- Contact Details -->
              <div class="col-12 mt-4">
                <h5 class="section-title"><i class="icon-mobile me-2"></i>Contact Details</h5>
              </div>

              <div class="col-md-3">
                <label class="form-label-premium">Contact Person</label>
                <input type="text" class="form-control form-control-premium" name="contact_person"
                  value="{{ old('contact_person') }}" placeholder="Person name">
                <div class="invalid-feedback">@error('contact_person') {{ $message }} @enderror</div>
              </div>

              <div class="col-md-3">
                <label class="form-label-premium">Mobile No</label>
                <input type="text" class="form-control form-control-premium" name="mobile_no"
                  value="{{ old('mobile_no') }}" placeholder="10-digit mobile number">
                <div class="invalid-feedback">@error('mobile_no') {{ $message }} @enderror</div>
              </div>

              <div class="col-md-3">
                <label class="form-label-premium">Email</label>
                <input type="email" class="form-control form-control-premium" name="email" value="{{ old('email') }}"
                  placeholder="example@domain.com">
                <div class="invalid-feedback">@error('email') {{ $message }} @enderror</div>
              </div>

              <div class="col-md-3">
                <label class="form-label-premium">Date of Birth</label>
                <input type="date" class="form-control form-control-premium" name="dob" value="{{ old('dob') }}">
                <div class="invalid-feedback">@error('dob') {{ $message }} @enderror</div>
              </div>

              <!-- Address -->
              <div class="col-12 mt-4">
                <h5 class="section-title"><i class="icon-location-pin me-2"></i>Address</h5>
              </div>

              <div class="col-md-6">
                <label class="form-label-premium">Address Line 1</label>
                <textarea class="form-control form-control-premium" name="address_line_1" rows="2"
                  placeholder="Street, building, etc.">{{ old('address_line_1') }}</textarea>
                <div class="invalid-feedback">@error('address_line_1') {{ $message }} @enderror</div>
              </div>

              <div class="col-md-6">
                <label class="form-label-premium">Address Line 2</label>
                <textarea class="form-control form-control-premium" name="address_line_2" rows="2"
                  placeholder="Landmark, area, etc.">{{ old('address_line_2') }}</textarea>
                <div class="invalid-feedback">@error('address_line_2') {{ $message }} @enderror</div>
              </div>

              <div class="col-md-3">
                <label class="form-label-premium">Area</label>
                <select class="form-control form-control-premium select2" id="area_id" name="area_id">
                  <option value="">Select Area</option>
                  @foreach($areaList as $areas)
                    <option value="{{ $areas->id }}">{{ $areas->area }}</option>
                  @endforeach
                </select>
                <div class="invalid-feedback">@error('area_id') {{ $message }} @enderror</div>
              </div>

              <div class="col-md-3">
                <label class="form-label-premium">City</label>
                <select class="form-control form-control-premium select2" id="city_id" name="city_id">
                  <option value="">Select City</option>
                </select>
                <div class="invalid-feedback">@error('city_id') {{ $message }} @enderror</div>
              </div>

              <div class="col-md-3">
                <label class="form-label-premium">State</label>
                <select class="form-control form-control-premium select2" id="state_id" name="state_id">
                  <option value="">Select State</option>
                </select>
                <div class="invalid-feedback">@error('state_id') {{ $message }} @enderror</div>
              </div>

              <div class="col-md-3">
                <label class="form-label-premium">Pincode</label>
                <input type="text" class="form-control form-control-premium" name="pincode" value="{{ old('pincode') }}"
                  placeholder="6-digit pincode">
                <div class="invalid-feedback">@error('pincode') {{ $message }} @enderror</div>
              </div>

              <!-- Communication -->
              <div class="col-12 mt-4">
                <h5 class="section-title"><i class="icon-headphone-alt me-2"></i>Communication</h5>
              </div>

              <div class="col-md-4">
                <label class="form-label-premium">Phone 1</label>
                <input type="text" class="form-control form-control-premium" name="phone_1" value="{{ old('phone_1') }}">
              </div>

              <div class="col-md-4">
                <label class="form-label-premium">Phone 2</label>
                <input type="text" class="form-control form-control-premium" name="phone_2" value="{{ old('phone_2') }}">
              </div>

              <div class="col-md-4">
                <label class="form-label-premium">Website</label>
                <input type="text" class="form-control form-control-premium" name="website" value="{{ old('website') }}"
                  placeholder="www.website.com">
              </div>

              <div class="col-md-4">
                <label class="form-label-premium">Facebook</label>
                <input type="text" class="form-control form-control-premium" name="facebook" value="{{ old('facebook') }}"
                  placeholder="www.facebook.com">
              </div>

              <div class="col-md-4">
                <label class="form-label-premium">Instagram</label>
                <input type="text" class="form-control form-control-premium" name="instagram"
                  value="{{ old('instagram') }}" placeholder="www.instagram.com">
              </div>

              <div class="col-md-4">
                <label class="form-label-premium">X Twitter</label>
                <input type="text" class="form-control form-control-premium" name="x" value="{{ old('x') }}"
                  placeholder="www.x.com">
              </div>

              <div class="col-md-4">
                <label class="form-label-premium">LinkedIn</label>
                <input type="text" class="form-control form-control-premium" name="linkedin" value="{{ old('linkedin') }}"
                  placeholder="www.linkedin.com">
              </div>

              <div class="col-md-4">
                <label class="form-label-premium">Youtube</label>
                <input type="text" class="form-control form-control-premium" name="youtube" value="{{ old('youtube') }}"
                  placeholder="www.youtube.com">
              </div>

              <!-- Other Details -->
              <div class="col-12 mt-4">
                <h5 class="section-title"><i class="icon-menu me-2"></i>Other Details</h5>
              </div>

              <div class="col-md-3">
                <label class="form-label-premium">GST No</label>
                <input type="text" class="form-control form-control-premium" name="gst" value="{{ old('gst') }}">
              </div>

              <div class="col-md-3">
                <label class="form-label-premium">Credit Days</label>
                <input type="number" class="form-control form-control-premium" name="credit_days"
                  value="{{ old('credit_days') }}">
              </div>

              <div class="col-md-3">
                <label class="form-label-premium">Date of Birth</label>
                <input type="date" class="form-control form-control-premium" name="date_of_birth"
                  value="{{ old('date_of_birth') }}">
              </div>

              <div class="col-md-3">
                <label class="form-label-premium">Co-ordinator</label>
                <select class="form-control form-control-premium" name="coordinator">
                  <option value="">Select Account</option>
                  @foreach($coordinateList as $coordinate)
                    <option value="{{ $coordinate->id }}">{{ $coordinate->outlook_email }}</option>
                  @endforeach
                </select>
              </div>

              <!-- Branch Details -->
              <div class="col-12 mt-4">
                <h5 class="section-title"><i class="icon-menu me-2"></i>Branch Details</h5>
              </div>

              <div class="col-12">
                <form id="addBranchForm" method="post" action="{{ route('admin.customer.add.branch') }}">
                  @csrf
                  <input type="hidden" name="customer_uuid" id="branch_customer_uuid">
                  <input type="hidden" name="customer_id" id="branch_customer_id">

                  <div class="row g-3">
                    <div class="col-md-6">
                      <label class="form-label-premium">Branch Name <span class="text-danger">*</span></label>
                      <input type="text" name="branch_name" class="form-control form-control-premium" required>
                    </div>

                    <div class="col-md-6">
                      <label class="form-label-premium">Contact Person</label>
                      <input type="text" name="contact_person" class="form-control form-control-premium">
                    </div>

                    <div class="col-md-6">
                      <label class="form-label-premium">Mobile No</label>
                      <input type="text" name="mobile_no" class="form-control form-control-premium">
                    </div>

                    <div class="col-md-6">
                      <label class="form-label-premium">Email</label>
                      <input type="email" name="email" class="form-control form-control-premium">
                    </div>

                    <div class="col-md-6">
                      <label class="form-label-premium">Phone</label>
                      <input type="text" name="phone" class="form-control form-control-premium">
                    </div>

                    <div class="col-md-6">
                      <label class="form-label-premium">Area</label>
                      <select name="area_id" id="branch_area_id" class="form-control select2">
                        <option value="">Select Area</option>
                        @foreach($areaList as $areas)
                          <option value="{{ $areas->id }}">{{ $areas->area }}</option>
                        @endforeach
                      </select>
                    </div>

                    <div class="col-md-6">
                      <label class="form-label-premium">City <span class="text-danger">*</span></label>
                      <select name="city_id" id="branch_city_id" class="form-control select2" required>
                        <option value="">Select City</option>
                      </select>
                    </div>

                    <div class="col-md-6">
                      <label class="form-label-premium">State <span class="text-danger">*</span></label>
                      <select name="state_id" id="branch_state_id" class="form-control select2" required>
                        <option value="">Select State</option>
                      </select>
                    </div>

                    <div class="col-md-6">
                      <label class="form-label-premium">Pincode</label>
                      <input type="text" name="pincode" class="form-control form-control-premium">
                    </div>

                    <div class="col-md-12">
                      <label class="form-label-premium">Address Line 1</label>
                      <textarea name="address_line_1" class="form-control form-control-premium" rows="2"></textarea>
                    </div>

                    <div class="col-md-12">
                      <label class="form-label-premium">Address Line 2</label>
                      <textarea name="address_line_2" class="form-control form-control-premium" rows="2"></textarea>
                    </div>
                  </div>

                  <!-- <div class="mt-4 text-end">
                                                          <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Cancel</button>
                                                          <button type="submit" class="btn btn-primary-custom">Save Branch</button>
                                                        </div> -->
                </form>
              </div>

              <div class="col-12 mt-5">
                <div class="d-flex justify-content-end gap-2">
                  <a href="{{ route('admin.customer.index') }}" class="btn btn-outline-custom px-4">Cancel</a>
                  <button class="btn btn-primary-custom px-4">Submit Customer</button>
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