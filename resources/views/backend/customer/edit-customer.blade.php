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

                <div class="col-md-3">
                  <label class="form-label form-label-premium">Company Name <span class="text-danger">*</span></label>
                  <input type="text" class="form-control form-control-premium" name="company_name"
                    value="{{ $customers->company_name }}" required>
                  <div class="invalid-feedback">@error('company_name') {{ $message }} @enderror</div>
                </div>

                <div class="col-md-3">
                  <label class="form-label form-label-premium">Customer Type</label>
                  <select class="form-control form-control-premium" name="customer_type">
                    <option value="">Select Type</option>
                    <option value="GCS" @selected($customers->customer_type == 'GCS')>GCS</option>
                    <option value="NON GCS" @selected($customers->customer_type == 'NON GCS')>NON GCS</option>
                  </select>
                  <div class="invalid-feedback">@error('customer_type') {{ $message }} @enderror</div>
                </div>

                <div class="col-md-3">
                  <label class="form-label form-label-premium">Phone 1</label>
                  <input type="text" class="form-control form-control-premium" name="phone_1"
                    value="{{ $customers->phone_1 }}">
                </div>

                <div class="col-md-3">
                  <label class="form-label form-label-premium">Phone 2</label>
                  <input type="text" class="form-control form-control-premium" name="phone_2"
                    value="{{ $customers->phone_2 }}">
                </div>

                <div class="col-md-3">
                  <label class="form-label form-label-premium">Website</label>
                  <input type="text" class="form-control form-control-premium" name="website"
                    value="{{ $customers->website }}">
                </div>

                <div class="col-12 mt-4">
                  <h5 class="section-title"><i class="icon-mobile me-2"></i>Contact Details</h5>
                </div>

                <div class="col-md-3">
                  <label class="form-label form-label-premium">Contact Person</label>
                  <input type="text" class="form-control form-control-premium" name="contact_person"
                    value="{{ $customers->contact_person }}">
                  <div class="invalid-feedback">@error('contact_person') {{ $message }} @enderror</div>
                </div>

                <div class="col-md-3">
                  <label class="form-label form-label-premium">Department</label>
                  <input type="text" class="form-control form-control-premium" name="department"
                    value="{{ $customers->department ?? '' }}">
                </div>

                <div class="col-md-3">
                  <label class="form-label form-label-premium">Designation <span class="text-danger">*</span></label>
                  <input type="text" class="form-control form-control-premium" name="customer_designation"
                    value="{{ $customers->customer_designation ?? $customers->designation ?? '' }}" required>
                </div>

                <div class="col-md-3">
                  <label class="form-label form-label-premium">Mobile No <span class="text-danger">*</span></label>
                  <input type="text" class="form-control form-control-premium" name="mobile_no"
                    value="{{ $customers->mobile_no }}" required>
                  <div class="invalid-feedback">@error('mobile_no') {{ $message }} @enderror</div>
                </div>

                <div class="col-md-3">
                  <label class="form-label form-label-premium">Email</label>
                  <input type="email" class="form-control form-control-premium" name="email"
                    value="{{ $customers->email }}">
                  <div class="invalid-feedback">@error('email') {{ $message }} @enderror</div>
                </div>

                <div class="col-md-3">
                  <label class="form-label form-label-premium">Date of Birth</label>
                  <input type="date" class="form-control form-control-premium" name="date_of_birth"
                    value="{{ $customers->date_of_birth }}">
                </div>

                <div class="col-12 mt-4">
                  <h5 class="section-title"><i class="icon-location-pin me-2"></i>Address</h5>
                </div>

                <div class="col-md-6">
                  <label class="form-label form-label-premium">Address Line 1</label>
                  <textarea class="form-control form-control-premium" name="address_line_1"
                    rows="2">{{ $customers->address_line_1 }}</textarea>
                  <div class="invalid-feedback">@error('address_line_1') {{ $message }} @enderror</div>
                </div>

                <div class="col-md-6">
                  <label class="form-label form-label-premium">Address Line 2</label>
                  <textarea class="form-control form-control-premium" name="address_line_2"
                    rows="2">{{ $customers->address_line_2 }}</textarea>
                  <div class="invalid-feedback">@error('address_line_2') {{ $message }} @enderror</div>
                </div>

                <div class="col-md-3">
                  <label class="form-label form-label-premium">Area</label>
                  <select class="form-control form-control-premium select2" id="area_id" name="area_id">
                    <option value="">Select Area</option>
                    @foreach($areaList as $areas)
                      <option value="{{ $areas->id }}" @selected($areas->id == $customers->area_id)>
                        {{ $areas->area }}
                      </option>
                    @endforeach
                  </select>
                  <div class="invalid-feedback">@error('area_id') {{ $message }} @enderror</div>
                </div>

                <div class="col-md-3">
                  <label class="form-label form-label-premium">City</label>
                  <select class="form-control form-control-premium select2" id="city_id" name="city_id">
                    @if(isset($cityList))
                      <option value="{{ $cityList->id }}"> {{ $cityList->city }}</option>
                    @else
                      <option value="">Select City</option>
                    @endif
                  </select>
                  <div class="invalid-feedback">@error('city_id') {{ $message }} @enderror</div>
                </div>

                <div class="col-md-3">
                  <label class="form-label form-label-premium">State</label>
                  <select class="form-control form-control-premium select2" id="state_id" name="state_id">
                    @if(isset($stateList))
                      <option value="{{ $stateList->id }}"> {{ $stateList->state }}</option>
                    @else
                      <option value="">Select State</option>
                    @endif
                  </select>
                  <div class="invalid-feedback">@error('state_id') {{ $message }} @enderror</div>
                </div>

                <div class="col-md-3">
                  <label class="form-label form-label-premium">Pincode</label>
                  <input type="text" class="form-control form-control-premium" name="pincode"
                    value="{{ $customers->pincode }}">
                  <div class="invalid-feedback">@error('pincode') {{ $message }} @enderror</div>
                </div>

                <div class="col-12 mt-4">
                  <h5 class="section-title"><i class="icon-briefcase me-2"></i>Financial & Account Info</h5>
                </div>

                <div class="col-md-3">
                  <label class="form-label form-label-premium">GST No</label>
                  <input type="text" class="form-control form-control-premium" name="gst" value="{{ $customers->gst }}">
                </div>

                <div class="col-md-3">
                  <label class="form-label form-label-premium">Pan No</label>
                  <input type="text" class="form-control form-control-premium" name="pan" value="{{ $customers->pan }}">
                </div>

                <div class="col-md-3">
                  <label class="form-label form-label-premium">Credit Days</label>
                  <input type="number" class="form-control form-control-premium" name="credit_days"
                    value="{{ $customers->credit_days }}">
                </div>

                <div class="col-md-3">
                  <label class="form-label form-label-premium">Co-ordinator</label>
                  <select class="form-control form-control-premium select2" name="ac_key">
                    <option value="">Select Coordinator</option>
                    @foreach($coordinateList as $user)
                      <option value="{{ $user->id }}" @selected($user->id == $customers->ac_key)>
                        {{ $user->name ?? $user->user_name }}
                      </option>
                    @endforeach
                  </select>
                </div>

                <div class="col-md-3">
                  <label class="form-label form-label-premium">MSME Registered?</label>
                  <div class="form-check form-switch mt-2">
                    <input class="form-check-input" type="checkbox" id="is_msme" name="is_msme" value="1"
                      @checked($customers->is_msme == 1)>
                    <label class="form-check-label" for="is_msme">Yes</label>
                  </div>
                </div>

                <div class="col-md-3 {{ $customers->is_msme == 1 ? '' : 'd-none' }}" id="msme_div">
                  <label class="form-label form-label-premium">MSME Number</label>
                  <input type="text" class="form-control form-control-premium" name="msme_no" id="msme_no"
                    value="{{ $customers->msme_no }}">
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

      $('#is_msme').change(function () {
        if ($(this).is(':checked')) {
          $('#msme_div').removeClass('d-none');
        } else {
          $('#msme_div').addClass('d-none');
          $('#msme_no').val('');
        }
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