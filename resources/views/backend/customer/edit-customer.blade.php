@extends('backend.common.master')
@section('main-section')

  <div class="container-fluid">
    <div class="page-title">
      <div class="row">
        <div class="col-6">
          <h4>Edit Supplier</h4>
        </div>

      </div>
    </div>
  </div>
  <!-- Container-fluid starts-->
  <div class="container-fluid">
    <div class="row">

      <div class="col-xl-12">
        <div class="card card-premium height-equal">

          <div class="card-body">
            <form class="row g-3 needs-validation custom-input" novalidate="" method="post"
              action="{{ route('admin.customer.update', ['uuid' => $customers->uuid]) }}">
              @csrf
              @method('PATCH')

              <div class="row gy-3">

                <div class="col-12">
                  <h5 class="section-title"><i class="icon-user me-2"></i>Basic Customer Info</h5>
                </div>
                <div class="col-4">
                  <label class="form-label form-label-premium">Customer Name</label>
                  <input type="text" class="form-control form-control-premium" name="customer_name"
                    value="{{ $customers->customer_name }}">
                  <div class="invalid-feedback">@error('customer_name') {{ $message }} @enderror</div>
                </div>

                <div class="col-4">
                  <label class="form-label form-label-premium">Customer Type</label>
                  <select class="form-control form-control-premium" name="customer_type">
                    <option value="">Select Type</option>
                    <option value="GCS" @selected($customers->customer_type == 'GCS')>GCS</option>
                    <option value="NON GCS" @selected($customers->customer_type == 'NON GCS')>NON GCS</option>
                  </select>
                  <div class="invalid-feedback">@error('customer_type') {{ $message }} @enderror</div>
                </div>

                <div class="col-4">
                  <label class="form-label form-label-premium">Customer Category</label>
                  <select class="form-control form-control-premium" name="customer_category">
                    <option value="">Select Category</option>
                    <option value="Corporate" @selected($customers->customer_category == 'Corporate')>Corporate</option>
                    <option value="Semi-Corporate" @selected($customers->customer_category == 'Semi-Corporate')>
                      Semi-Corporate</option>
                    <option value="In-House" @selected($customers->customer_category == 'In-House')>In-House</option>
                  </select>
                  <div class="invalid-feedback">@error('customer_category') {{ $message }} @enderror</div>
                </div>

                <div class="col-4">
                  <label class="form-label form-label-premium">Department</label>
                  <input type="text" class="form-control form-control-premium" name="department"
                    value="{{ $customers->department }}">
                </div>

                <div class="col-4">
                  <label class="form-label form-label-premium">Designation</label>
                  <input type="text" class="form-control form-control-premium" name="customer_designation"
                    value="{{ $customers->designation }}">
                </div>

                <div class="col-12">
                  <h5 class="section-title"><i class="icon-mobile me-2"></i>Contact Details</h5>
                </div>
                <div class="col-4">
                  <label class="form-label form-label-premium">Contact Person</label>
                  <input type="text" class="form-control form-control-premium" name="contact_person"
                    value="{{ $customers->contact_person }}">
                  <div class="invalid-feedback">@error('contact_person') {{ $message }} @enderror</div>
                </div>

                <div class="col-4">
                  <label class="form-label form-label-premium">Mobile No</label>
                  <input type="text" class="form-control form-control-premium" name="mobile_no"
                    value="{{ $customers->mobile_no }}">
                  <div class="invalid-feedback">@error('mobile_no') {{ $message }} @enderror</div>
                </div>

                <div class="col-4">
                  <label class="form-label form-label-premium">Email</label>
                  <input type="email" class="form-control form-control-premium" name="email"
                    value="{{ $customers->email }}">
                  <div class="invalid-feedback">@error('email') {{ $message }} @enderror</div>
                </div>

                <div class="col-12">
                  <h5 class="section-title"><i class="icon-location-pin me-2"></i>Address</h5>
                </div>
                <div class="col-6">
                  <label class="form-label form-label-premium">Address Line 1</label>
                  <input type="text" class="form-control form-control-premium" name="address_line_1"
                    value="{{ $customers->address_line_1 }}">
                  <div class="invalid-feedback">@error('address_line_1') {{ $message }} @enderror</div>
                </div>

                <div class="col-6">
                  <label class="form-label form-label-premium">Address Line 2</label>
                  <input type="text" class="form-control form-control-premium" name="address_line_2"
                    value="{{ $customers->address_line_2 }}">
                  <div class="invalid-feedback">@error('address_line_2') {{ $message }} @enderror</div>
                </div>

                <div class="col-12">
                  <h5 class="section-title"><i class="icon-map me-2"></i>Location</h5>
                </div>

                <div class="col-4">
                  <label class="form-label form-label-premium" for="area_id">Area</label>
                  <select class="form-control form-control-premium select2" id="area_id" name="area_id" required>
                    <option value=""> Select Area</option>
                    @foreach($areaList as $areas)
                      <option value="{{ $areas->id }}" @selected($areas->id == $customers->area_id)>
                        {{ $areas->area }}
                      </option>
                    @endforeach
                  </select>
                  <div class="invalid-feedback">
                    @error('area_id')
                      {{ $message }}
                    @enderror
                  </div>

                </div>

                <div class="col-4">
                  <label class="form-label form-label-premium" for="city_id">City</label>
                  <select class="form-control form-control-premium select2" id="city_id" name="city_id" required>
                    <option value="{{ $cityList->id }}"> {{ $cityList->city }}</option>
                  </select>
                  <div class="invalid-feedback">
                    @error('city_id')
                      {{ $message }}
                    @enderror
                  </div>

                </div>


                <div class="col-4">
                  <label class="form-label form-label-premium" for="state_id">State</label>
                  <select class="form-control form-control-premium select2" id="state_id" name="state_id">
                    <option value="{{ $stateList->id }}"> {{ $stateList->state }}</option>
                  </select>
                  <div class="invalid-feedback">@error('state_id') {{ $message }} @enderror</div>
                </div>


                <div class="col-4">
                  <label class="form-label form-label-premium">Pincode</label>
                  <input type="text" class="form-control form-control-premium" name="pincode"
                    value="{{ $customers->pincode }}">
                  <div class="invalid-feedback">@error('pincode') {{ $message }} @enderror</div>
                </div>

                <div class="col-12">
                  <h5 class="section-title"><i class="icon-headphone-alt me-2"></i>Communication</h5>
                </div>
                <div class="col-4">
                  <label class="form-label form-label-premium">Phone 1</label>
                  <input type="text" class="form-control form-control-premium" name="phone_1"
                    value="{{ $customers->phone_1 }}">
                </div>

                <div class="col-4">
                  <label class="form-label form-label-premium">Phone 2</label>
                  <input type="text" class="form-control form-control-premium" name="phone_2"
                    value="{{ $customers->phone_2 }}">
                </div>

                <div class="col-4">
                  <label class="form-label form-label-premium">Website</label>
                  <input type="text" class="form-control form-control-premium" name="website"
                    value="{{ $customers->website }}">
                </div>

                <div class="col-4">
                  <label class="form-label form-label-premium">GST</label>
                  <input type="text" class="form-control form-control-premium" name="gst" value="{{ $customers->gst }}">
                </div>

                <div class="col-12">
                  <h5 class="section-title"><i class="icon-file-text me-2"></i>Tax Details</h5>
                </div>
                <!-- <div class="col-4">
                      <label class="form-label form-label-premium">PAN</label>
                      <input type="text" class="form-control form-control-premium" name="pan" value="{{ $customers->pan }}">
                    </div>

                    <div class="col-4">
                      <label class="form-label form-label-premium">VAT</label>
                      <input type="text" class="form-control form-control-premium" name="vat" value="{{ $customers->vat }}">
                    </div>

                    <div class="col-4">
                      <label class="form-label form-label-premium">CST</label>
                      <input type="text" class="form-control form-control-premium" name="cst" value="{{ $customers->cst }}">
                    </div> -->

                <div class="col-12">
                  <h5 class="section-title"><i class="icon-menu me-2"></i>Other Details</h5>
                </div>
                <!-- <div class="col-4">
                      <label class="form-label form-label-premium">Fax</label>
                      <input type="text" class="form-control form-control-premium" name="fax" value="{{ $customers->fax }}">
                    </div> -->

                <div class="col-4">
                  <label class="form-label form-label-premium">Credit Days</label>
                  <input type="text" class="form-control form-control-premium" name="credit_days"
                    value="{{ $customers->credit_days }}">
                </div>

                <div class="col-4">
                  <label class="form-label form-label-premium">Date of Birth</label>
                  <input type="date" class="form-control form-control-premium" name="date_of_birth"
                    value="{{ $customers->date_of_birth }}">
                </div>

                <div class="col-4">
                  <label class="form-label form-label-premium">Account Key</label>
                  <select class="form-control form-control-premium" name="ac_key">
                    <option value="">Select</option>
                    @foreach($coordinateList as $coordinate)
                      <option value="{{ $coordinate->id }}" @selected($coordinate->id == $customers->ac_key)>
                        {{ $coordinate->outlook_email }}
                      </option>
                    @endforeach
                  </select>
                </div>

              </div>

              <div class="col-12">
                <div class="d-flex justify-content-end">
                  <button class="btn btn-primary-custom btn-lg" type="submit">
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