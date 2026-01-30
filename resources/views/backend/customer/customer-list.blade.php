@extends('backend.common.master')
@section('main-section')
  <div class="container-fluid">
    <div class="page-title">
      <div class="row">
        <div class="col-6">
          <h4>Customer List</h4>
        </div>
        <div class="col-6">
          <ol class="breadcrumb">
            <a href="{{ route('admin.customer.create') }}">
              <button type="button" class="btn btn-primary-custom" data-bs-toggle="tooltip" title="Add User">Add
                Customer</button>
            </a>

          </ol>
        </div>
      </div>
    </div>
  </div>

  <!-- Container-fluid starts-->
  <div class="container-fluid">
    <div class="row">
      <!-- Zero Configuration  Starts-->
      <div class="col-sm-12">
        <div class="card card-premium">

          <div class="card-body">
            <div class="table-responsive custom-scrollbar">
              <table class="display table-premium" id="basic-1">
                <thead>
                  <tr>
                    <th>Sr.no</th>
                    <th>Name</th>
                    <th>Mobile</th>
                    <th>Contact Person</th>
                    <th>Email</th>
                    <th width="120" class="text-center">Action</th>
                  </tr>
                </thead>
                <tbody>

                  @php $i = 0; @endphp
                  @foreach($customerList as $customers)
                    @php $i++; @endphp

                    <tr>
                      <td>{{ $i }}</td>
                      <td>{{ $customers->customer_name }}</td>
                      <td>{{ $customers->mobile_no }}</td>
                      <td>{{ $customers->contact_person }}</td>
                      <td>{{ $customers->email }}</td>
                      <td class="text-center">

                        <ul
                          style="display:flex;align-items:center;gap:8px;padding:0;margin:0;list-style:none;justify-content:center;">

                          <button type="button" class="btn btn-sm-custom btn-primary-custom viewBranchBtn"
                            data-customer-id="{{ $customers->id }}" data-customer-uuid="{{ $customers->uuid }}"
                            data-customer-name="{{ $customers->customer_name }}">
                            Branch
                          </button>

                          <button type="button" class="btn btn-sm-custom btn-primary-custom viewContactBtn"
                            data-customer-id="{{ $customers->id }}" data-customer-uuid="{{ $customers->uuid }}"
                            data-customer-name="{{ $customers->customer_name }}">
                            Contact
                          </button>


                          <li class="dropdown" style="position:relative;">
                            <a href="javascript:void(0)" data-bs-toggle="dropdown" style="text-decoration:none;color:#000;">

                              <!-- Vertical dots -->
                              <i class="icon-more" style="font-size:18px;display:inline-block;transform:rotate(90deg);">
                              </i>
                            </a>

                            <ul class="dropdown-menu dropdown-menu-end" style="min-width:100px;">

                              <!-- VIEW -->
                              <li>
                                <a class="dropdown-item viewCustomer" href="javascript:void(0)"
                                  style="color:#000;font-weight:600;" data-id="{{ $customers->id }}"
                                  data-uuid="{{ $customers->uuid }}" data-customer_name="{{ $customers->customer_name }}"
                                  data-customer_code="{{ $customers->customer_code }}"
                                  data-customer_type="{{ $customers->customer_type }}"
                                  data-customer_category="{{ $customers->customer_category }}"
                                  data-contact_person="{{ $customers->contact_person }}"
                                  data-mobile_no="{{ $customers->mobile_no }}" data-email="{{ $customers->email }}"
                                  data-website="{{ $customers->website }}"
                                  data-address_line_1="{{ $customers->address_line_1 }}"
                                  data-address_line_2="{{ $customers->address_line_2 }}"
                                  data-area_id="{{ $customers->area_name }}" data-city_id="{{ $customers->city_name }}"
                                  data-state_id="{{ $customers->state_name }}" data-pincode="{{ $customers->pincode }}"
                                  data-phone_1="{{ $customers->phone_1 }}" data-phone_2="{{ $customers->phone_2 }}"
                                  data-gst="{{ $customers->gst }}" data-fax="{{ $customers->fax }}"
                                  data-cst="{{ $customers->cst }}" data-vat="{{ $customers->vat }}"
                                  data-pan="{{ $customers->pan }}" data-credit_days="{{ $customers->credit_days }}"
                                  data-date_of_birth="{{ $customers->date_of_birth }}"
                                  data-ac_key="{{ $customers->ac_key }}" data-created_by="{{ $customers->created_by }}"
                                  data-modified_by="{{ $customers->modified_by }}">
                                  <i class="icon-eye me-1"></i> View
                                </a>
                              </li>

                              <!-- EDIT -->
                              <li>
                                <a class="dropdown-item"
                                  href="{{ route('admin.customer.edit', ['uuid' => $customers->uuid]) }}"
                                  style="color:#000;font-weight:600;">
                                  <i class="icon-pencil-alt me-1"></i> Edit
                                </a>
                              </li>

                              <!-- DELETE -->
                              <li>
                                <a class="dropdown-item"
                                  href="{{ route('admin.customer.delete', ['uuid' => $customers->uuid]) }}"
                                  onclick="return confirm('Are you sure you want to delete this record?');"
                                  style="color:#bf0103;font-weight:600;">
                                  <i class="icon-trash me-1"></i> Delete
                                </a>
                              </li>

                            </ul>
                          </li>


                        </ul>
                      </td>
                    </tr>

                  @endforeach

                </tbody>


              </table>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>


  <div class="modal fade" id="viewCustomerModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content modal-content-premium shadow-lg">
        <div class="modal-header modal-header-premium">
          <h5 class="modal-title modal-title-premium text-white">Customer Details</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body">

          <!-- Basic Info -->
          <div class="mb-3">
            <h6 class="border-bottom pb-2 text-primary mb-3">Basic Information</h6>

            <div class="row mb-2">
              <div class="col-md-4 text-muted">Customer Name</div>
              <div class="col-md-8 fw-semibold" id="v_customer_name"></div>
            </div>

            <!-- <div class="row mb-2">
              <div class="col-md-4 text-muted">Customer Code</div>
              <div class="col-md-8" id="v_customer_code"></div>
            </div> -->

            <div class="row mb-2">
              <div class="col-md-4 text-muted">Mobile</div>
              <div class="col-md-8" id="v_mobile_no"></div>
            </div>

            <div class="row mb-2">
              <div class="col-md-4 text-muted">Contact Person</div>
              <div class="col-md-8" id="v_contact_person"></div>
            </div>

            <div class="row mb-2">
              <div class="col-md-4 text-muted">Email</div>
              <div class="col-md-8" id="v_email"></div>
            </div>
          </div>

          <!-- Address -->
          <div class="mb-3">
            <h6 class="border-bottom pb-2 text-primary  mb-3">Address</h6>

            <div class="row mb-2">
              <div class="col-md-4 text-muted">Address</div>
              <div class="col-md-8" id="v_address"></div>
            </div>

            <div class="row mb-2">
              <div class="col-md-4 text-muted">State</div>
              <div class="col-md-8" id="v_state_id"></div>
            </div>

            <div class="row mb-2">
              <div class="col-md-4 text-muted">City</div>
              <div class="col-md-8" id="v_city_id"></div>
            </div>

            <div class="row mb-2">
              <div class="col-md-4 text-muted">Area</div>
              <div class="col-md-8" id="v_area_id"></div>
            </div>

          </div>

          <!-- Tax Details -->
          <div class="mb-3">
            <h6 class="border-bottom pb-2 text-primary mb-3">Tax Details</h6>

            <div class="row mb-2">
              <div class="col-md-4 text-muted">GST</div>
              <div class="col-md-8" id="v_gst"></div>
            </div>

            <!-- <div class="row mb-2">
              <div class="col-md-4 text-muted">GST / CST</div>
              <div class="col-md-8" id="v_cst"></div>
            </div>

            <div class="row mb-2">
              <div class="col-md-4 text-muted">VAT</div>
              <div class="col-md-8" id="v_vat"></div>
            </div>

            <div class="row mb-2">
              <div class="col-md-4 text-muted">PAN</div>
              <div class="col-md-8" id="v_pan"></div>
            </div>

            <div class="row mb-2">
              <div class="col-md-4 text-muted">TIN</div>
              <div class="col-md-8" id="v_tin"></div>
            </div> -->

          </div>

          <!-- Contact Details -->
          <div class="mb-3">
            <h6 class="border-bottom pb-2 text-primary mb-3">Contact Details</h6>

            <div class="row mb-2">
              <div class="col-md-4 text-muted">Phone 1</div>
              <div class="col-md-8" id="v_phone_1"></div>
            </div>

            <div class="row mb-2">
              <div class="col-md-4 text-muted">Phone 2</div>
              <div class="col-md-8" id="v_phone_2"></div>
            </div>

            <!-- <div class="row mb-2">
              <div class="col-md-4 text-muted">Fax</div>
              <div class="col-md-8" id="v_fax"></div>
            </div> -->

            <div class="row mb-2">
              <div class="col-md-4 text-muted">Website</div>
              <div class="col-md-8" id="v_web_sites"></div>
            </div>
          </div>

        </div>

        <!-- <div class="modal-footer">
          <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div> -->

      </div>
    </div>
  </div>


  <div class="modal fade" id="branchModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header modal-header-premium">
          <h5 class="modal-title modal-title-premium text-white">Branches of <span id="branchCustomerName"></span></h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">

          <div class="d-flex justify-content-between mb-3 align-items-center">
            <h6 class="mb-0 fw-bold">Branch List</h6>
            <a href="javascript:void(0)" class="btn btn-sm-custom btn-primary-custom" id="addBranchBtn">Add Branch</a>
          </div>

          <div class="table-responsive">
            <table class="table table-bordered table-striped" id="branchTable">
              <thead class="table-light">
                <tr>
                  <th>Sr.no</th>
                  <th>Branch Name</th>
                  <th>contact_person</th>
                  <th>mobile_no</th>
                  <th>customer_code</th>
                  <th>email</th>
                  <th>phone</th>
                  <th>address </th>
                  <th>State</th>
                  <th>City</th>
                  <th>Area</th>
                  <th>pincode</th>
                  <th>created_by</th>
                  <th>modified_by</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>

              </tbody>
            </table>
          </div>

        </div>
        <!-- <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div> -->

      </div>
    </div>
  </div>


  <div class="modal fade" id="contactModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header modal-header-premium">
          <h5 class="modal-title modal-title-premium text-white">Contact of <span id="contactCustomerName"></span></h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">

          <div class="d-flex justify-content-between mb-3">
            <h6 class="mb-0">Contact List</h6>
            <a href="javascript:void(0)" class="btn btn-sm-custom btn-primary-custom" id="addContactBtn">Add Contact</a>
          </div>

          <div class="table-responsive">
            <table class="table table-bordered table-striped" id="contactTable">
              <thead class="table-light">
                <tr>
                  <th>Sr.no</th>
                  <th>Name</th>
                  <th>Department</th>
                  <th>Designation</th>
                  <th>D.O.B</th>
                  <th>mobile_no</th>
                  <th>email</th>
                  <th>created_by</th>
                  <th>modified_by</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>

              </tbody>
            </table>
          </div>

        </div>
        <!-- <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div> -->

      </div>
    </div>
  </div>


  <div class="modal fade" id="addBranchModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header modal-header-premium">
          <h5 class="modal-title modal-title-premium text-white">Add Branch of <span id="addbranchCustomerName"></span></h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <form id="addBranchForm" method="post" action="{{ route('admin.customer.add.branch') }}">
            @csrf
            <input type="hidden" name="customer_uuid" id="branch_customer_uuid">
            <input type="hidden" name="customer_id" id="branch_customer_id">

            <div class="row g-3">

              <!-- Branch Name -->
              <div class="col-md-6">
                <label class="fw-bold text-muted">Branch Name</label>
                <input type="text" name="branch_name" class="form-control" required>
              </div>

              <!-- Customer Code -->
              <!-- <div class="col-md-6">
                <label class="fw-bold text-muted">Customer Code</label>
                <input type="text" name="customer_code" class="form-control">
              </div> -->

              <!-- Contact Person -->
              <div class="col-md-6">
                <label class="fw-bold text-muted">Contact Person</label>
                <input type="text" name="contact_person" class="form-control">
              </div>

              <!-- Mobile No -->
              <div class="col-md-6">
                <label class="fw-bold text-muted">Mobile No</label>
                <input type="text" name="mobile_no" class="form-control">
              </div>

              <!-- Email -->
              <div class="col-md-6">
                <label class="fw-bold text-muted">Email</label>
                <input type="email" name="email" class="form-control">
              </div>

              <!-- Phone -->
              <div class="col-md-6">
                <label class="fw-bold text-muted">Phone</label>
                <input type="text" name="phone" class="form-control">
              </div>

              <div class="col-md-6">
                <label class="fw-bold text-muted">Area</label>
                <select name="area_id" id="branch_area_id" class="form-control select2">
                  <option value="">Select Area</option>
                  @foreach($areaList as $areas)
                    <option value="{{ $areas->id }}">{{ $areas->area }}</option>
                  @endforeach
                </select>
              </div>

              <div class="col-md-6">
                <label class="fw-bold text-muted">City</label>
                <select name="city_id" id="branch_city_id" class="form-control select2" required>
                  <option value="">Select City</option>
                </select>
              </div>

              <div class="col-md-6">
                <label class="fw-bold text-muted">State</label>
                <select name="state_id" id="branch_state_id" class="form-control select2" required>
                  <option value="">Select State</option>

                </select>
              </div>

              <!-- Area -->


              <!-- Pincode -->
              <div class="col-md-6">
                <label class="fw-bold text-muted">Pincode</label>
                <input type="text" name="pincode" class="form-control">
              </div>

              <!-- Fax -->
              <!-- <div class="col-md-6">
                <label class="fw-bold text-muted">Fax</label>
                <input type="text" name="fax" class="form-control">
              </div> -->

              <!-- Address Line 1 -->
              <div class="col-md-12">
                <label class="fw-bold text-muted">Address Line 1</label>
                <textarea name="address_line_1" class="form-control" rows="2"></textarea>
              </div>

              <!-- Address Line 2 -->
              <div class="col-md-12">
                <label class="fw-bold text-muted">Address Line 2</label>
                <textarea name="address_line_2" class="form-control" rows="2"></textarea>
              </div>

            </div>


            <div class="mt-3 text-end">
              <button type="submit" class="btn btn-primary-custom">Save Branch</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="editBranchModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header modal-header-premium">
          <h5 class="modal-title modal-title-premium text-white">Edit Branch <span id="editbranchCustomerName"></span></h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <form id="editBranchForm" method="post" action="{{ route('admin.customer.edit.customer.branch') }}">
            @csrf
            <input type="hidden" name="branch_id" id="edit_branch_id">

            <div class="row g-3">
              <div class="col-md-6">
                <label class="fw-bold text-muted">Branch Name</label>
                <input type="text" name="branch_name" id="edit_branch_name" class="form-control" required>
              </div>

              <!-- <div class="col-md-6">
                <label class="fw-bold text-muted">Customer Code</label>
                <input type="text" name="customer_code" id="edit_customer_code" class="form-control">
              </div> -->

              <div class="col-md-6">
                <label class="fw-bold text-muted">Contact Person</label>
                <input type="text" name="contact_person" id="edit_contact_person" class="form-control">
              </div>

              <div class="col-md-6">
                <label class="fw-bold text-muted">Mobile No</label>
                <input type="text" name="mobile_no" id="edit_mobile_no" class="form-control">
              </div>

              <div class="col-md-6">
                <label class="fw-bold text-muted">Email</label>
                <input type="email" name="email" id="edit_email" class="form-control">
              </div>

              <div class="col-md-6">
                <label class="fw-bold text-muted">Phone</label>
                <input type="text" name="phone" id="edit_phone" class="form-control">
              </div>

              <div class="col-md-6">
                <label class="fw-bold text-muted">Area</label>
                <select name="area_id" id="edit_branch_area_id" class="form-control select2">
                  <option value="">Select Area</option>
                  @foreach($areaList as $areas)
                    <option value="{{ $areas->id }}">{{ $areas->area }}</option>
                  @endforeach
                </select>
              </div>

              <div class="col-md-6">
                <label class="fw-bold text-muted">City</label>
                <select name="city_id" id="edit_branch_city_id" class="form-control select2" required>
                  <option value="">Select City</option>
                  @foreach($cityList as $cities)
                    <option value="{{ $cities->id }}">{{ $cities->city }}</option>
                  @endforeach
                </select>
              </div>

              <div class="col-md-6">
                <label class="fw-bold text-muted">State</label>
                <select name="state_id" id="edit_branch_state_id" class="form-control select2" required>
                  <option value="">Select State</option>
                  @foreach($stateList as $states)
                    <option value="{{ $states->id }}">{{ $states->state }}</option>
                  @endforeach
                </select>
              </div>

              <div class="col-md-6">
                <label class="fw-bold text-muted">Pincode</label>
                <input type="text" name="pincode" id="edit_pincode" class="form-control">
              </div>

              <!-- <div class="col-md-6">
                <label class="fw-bold text-muted">Fax</label>
                <input type="text" name="fax" id="edit_fax" class="form-control">
              </div> -->

              <div class="col-md-12">
                <label class="fw-bold text-muted">Address Line 1</label>
                <textarea name="address_line_1" id="edit_address_line_1" class="form-control" rows="2"></textarea>
              </div>

              <div class="col-md-12">
                <label class="fw-bold text-muted">Address Line 2</label>
                <textarea name="address_line_2" id="edit_address_line_2" class="form-control" rows="2"></textarea>
              </div>

            </div>

            <div class="mt-3 text-end">
              <button type="submit" class="btn btn-primary-custom">Update Branch</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>


  <div class="modal fade" id="addContactModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header modal-header-premium">
          <h5 class="modal-title modal-title-premium text-white">Add Contact for <span id="addcontactCustomerName"></span></h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <form id="addBranchForm" method="post" action="{{ route('admin.customer.add.contact') }}">
            @csrf
            <input type="hidden" name="customer_uuid" id="contact_customer_uuid">
            <input type="hidden" name="customer_id" id="contact_customer_id">

            <div class="row g-3">

              <!-- Branch Name -->
              <div class="col-md-6">
                <label class="fw-bold text-muted"> Name</label>
                <input type="text" name="contact_name" class="form-control" required>
              </div>

              <div class="col-md-6">
                <label class="fw-bold text-muted">Department</label>
                <input type="text" name="department" class="form-control">
              </div>

              <div class="col-md-6">
                <label class="fw-bold text-muted">Designation</label>
                <input type="text" name="designation" class="form-control">
              </div>

              <!-- Mobile No -->
              <div class="col-md-6">
                <label class="fw-bold text-muted">Mobile No</label>
                <input type="text" name="mobile_no" class="form-control">
              </div>

              <!-- Email -->
              <div class="col-md-6">
                <label class="fw-bold text-muted">Email</label>
                <input type="email" name="email_id" class="form-control">
              </div>

              <!-- Phone -->
              <div class="col-md-6">
                <label class="fw-bold text-muted">Date Of Birth</label>
                <input type="date" name="date_of_birth" class="form-control">
              </div>

            </div>


            <div class="mt-3 text-end">
              <button type="submit" class="btn btn-primary-custom">Save Contact</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>


  <div class="modal fade" id="editContactModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header modal-header-premium">
          <h5 class="modal-title modal-title-premium text-white">Edit Contact for <span id="editcontactCustomerName"></span></h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <form id="addContactForm" method="post" action="{{ route('admin.customer.edit.contact') }}">
            @csrf
            <input type="hidden" id="edit_id" name="id">

            <div class="row g-3">

              <!-- Branch Name -->
              <div class="col-md-6">
                <label class="fw-bold text-muted"> Name</label>
                <input type="text" id="edit_contact_name" name="contact_name" class="form-control">
              </div>

              <div class="col-md-6">
                <label class="fw-bold text-muted">Department</label>
                <input type="text" id="edit_department" name="department" class="form-control">
              </div>

              <div class="col-md-6">
                <label class="fw-bold text-muted">Designation</label>
                <input type="text" id="edit_designation" name="designation" class="form-control">
              </div>

              <!-- Mobile No -->
              <div class="col-md-6">
                <label class="fw-bold text-muted">Mobile No</label>
                <input type="text" id="edit_mobile" name="mobile_no" class="form-control">
              </div>

              <!-- Email -->
              <div class="col-md-6">
                <label class="fw-bold text-muted">Email</label>
                <input type="email" id="edit_email_id" name="email_id" class="form-control">
              </div>

              <!-- Phone -->
              <div class="col-md-6">
                <label class="fw-bold text-muted">Date Of Birth</label>
                <input type="date" id="edit_dob" name="date_of_birth" class="form-control">
              </div>

            </div>


            <div class="mt-3 text-end">
              <button type="submit" class="btn btn-primary-custom">Update Contact</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>



@endsection


@push('scripts')

  <link rel="stylesheet" href="{{ asset('assets/css/vendors/select2.css') }}">

  <!-- Select2 JS -->
  <script src="{{ asset('assets/js/select2/select2.full.min.js') }}"></script>

  <script>
    $(document).ready(function () {
      $(document).on('click', '.viewCustomer', function () {

        $('#v_customer_name').text($(this).data('customer_name'));
        $('#v_customer_code').text($(this).data('customer_code'));
        $('#v_mobile_no').text($(this).data('mobile_no'));
        $('#v_contact_person').text($(this).data('contact_person'));
        $('#v_email').text($(this).data('email'));

        let address =
          ($(this).data('address_line_1') ?? '') + ' ' +
          ($(this).data('address_line_2') ?? '') + ' - ' +
          ($(this).data('pincode') ?? '');

        $('#v_address').text(address);
        $('#v_area_id').text($(this).data('area_id'));
        $('#v_city_id').text($(this).data('city_id'));
        $('#v_state_id').text($(this).data('state_id'));

        $('#v_gst').text($(this).data('gst'));
        $('#v_cst').text($(this).data('cst'));
        $('#v_vat').text($(this).data('vat'));
        $('#v_pan').text($(this).data('pan'));
        $('#v_tin').text($(this).data('tin'));

        $('#v_phone_1').text($(this).data('phone_1'));
        $('#v_phone_2').text($(this).data('phone_2'));
        $('#v_fax').text($(this).data('fax'));
        $('#v_web_sites').text($(this).data('website'));

        $('#viewCustomerModal').modal('show');
      });
    });
  </script>

  <script>
    $(document).ready(function () {

      $('.select2').select2({
        placeholder: 'Select an option',
        allowClear: true,
        width: '100%',
        dropdownParent: $('#addBranchModal')
      });

      $('#editBranchModal .select2').select2({
        placeholder: 'Select an option',
        allowClear: true,
        width: '100%',
        dropdownParent: $('#editBranchModal')
      });

      $(document).on('click', '.viewBranchBtn', function () {
        var customerId = $(this).data('customer-id');
        var customerName = $(this).data('customer-name');
        var customerUuid = $(this).data('customer-uuid');

        $('#branchCustomerName').text(customerName);
        $('#addbranchCustomerName').text(customerName);
        $('#editbranchCustomerName').text(customerName);

        // $('#branchTable tbody').html('');
        $('#branch_customer_id').val(customerId);
        $('#branch_customer_uuid').val(customerUuid);

        $('#branchTable tbody').html(
          '<tr><td colspan="17" class="text-center">Loading...</td></tr>'
        );

        $.ajax({
          url: "{{ route('admin.customer.get.customer.branch') }}",
          type: "POST",
          data: {
            customer_id: customerId,
            _token: "{{ csrf_token() }}"
          },
          success: function (res) {

            let html = '';
            let i = 1;

            if (res.length > 0) {
              $.each(res, function (key, val) {
                let productUrl = "{{ route('admin.customer.amc.product', ':uuid') }}";
                let branchUrl = "{{ route('admin.customer.branch.contact', ':uuid') }}";
                productUrl = productUrl.replace(':uuid', val.uuid);
                branchUrl = branchUrl.replace(':uuid', val.uuid);
                html += `
                          <tr>
                              <td>${i++}</td>
                              <td>${val.branch_name ?? '-'}</td>
                              <td>${val.contact_person ?? '-'}</td>
                              <td>${val.mobile_no ?? '-'}</td>
                              <td>${val.customer_code ?? '-'}</td>
                              <td>${val.email ?? '-'}</td>
                              <td>${val.phone ?? '-'}</td>
                              <td>
                                  ${(val.address_line_1 ?? '')}
                                  ${(val.address_line_2 ?? '')}
                              </td>
                              <td>${val.state_name ?? ''}</td>
                              <td>${val.city_name ?? '-'}</td>
                              <td>${val.area_name ?? '-'}</td>
                              <td>${val.pincode ?? '-'}</td>
                              <td>${val.created_by ?? '-'}</td>
                              <td>${val.modified_by ?? '-'}</td>
                              <td class="text-center">
                                  <i class="icon-pencil-alt text-primary editBranchBtn"
                                    data-id="${val.id}"
                                    data-branch_name="${val.branch_name}"
                                    data-contact_person="${val.contact_person}"
                                    data-mobile_no="${val.mobile_no}"
                                    data-customer_code="${val.customer_code}"
                                    data-email="${val.email}"
                                    data-phone="${val.phone}"
                                    data-address_line_1="${val.address_line_1}"
                                    data-address_line_2="${val.address_line_2}"
                                    data-state_id="${val.state_id}"
                                    data-city_id="${val.city_id}"
                                    data-area_id="${val.area_id}"
                                    data-pincode="${val.pincode}"
                                    data-fax="${val.fax}">
                                  </i>

                                   <i class="icon-trash text-danger deleteBranchBtn" data-uuid="${val.uuid}"></i>

                                   <div style="display:flex; flex-direction:column; align-items:center; margin-top:6px;">
          <a href="${branchUrl}">
              <button type="button"
                  class="btn btn-sm"
                  style="background:#bf0103;color:#fff;border:none;">
                  Contact
              </button>
          </a>

          <a href="${productUrl}" style="margin-top:8px;">
              <button type="button"
                  class="btn btn-sm"
                  style="background:#bf0103;color:#fff;border:none;">
                  Product
              </button>
          </a>
      </div>
                              </td>
                          </tr>
                      `;
              });
            } else {
              html = `
                      <tr>
                          <td colspan="16" class="text-center text-muted">
                              No Branch Found
                          </td>
                      </tr>
                  `;
            }

            $('#branchTable tbody').html(html);
          },
          error: function () {
            alert('Failed to load branch data');
          }
        });

        $('#branchModal').modal('show');
      });

      $(document).on('click', '#addBranchBtn', function () {
        $('#addBranchModal').modal('show');
        $('#branchModal').modal('hide');
      });

      $(document).on('change', '#branch_area_id', function () {

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
                $('#branch_city_id').empty()
                  .append('<option value="' + res.city.id + '">' + res.city.name + '</option>');

                // STATE
                $('#branch_state_id').empty()
                  .append('<option value="' + res.state.id + '">' + res.state.name + '</option>');
              }
            },
            error: function () {
              alert('Unable to fetch city/state');
            }
          });
        } else {
          $('#branch_city_id').empty().append('<option value="">Select City</option>');
          $('#branch_state_id').empty().append('<option value="">Select State</option>');
        }

      });

    });
  </script>

  <script>
    $(document).on('click', '.editBranchBtn', function () {
      let branchId = $(this).data('id');
      let branchName = $(this).data('branch_name');
      let contactPerson = $(this).data('contact_person');
      let mobileNo = $(this).data('mobile_no');
      let customerCode = $(this).data('customer_code');
      let email = $(this).data('email');
      let phone = $(this).data('phone');
      let address1 = $(this).data('address_line_1');
      let address2 = $(this).data('address_line_2');
      let stateId = $(this).data('state_id');
      let cityId = $(this).data('city_id');
      let areaId = $(this).data('area_id');
      let pincode = $(this).data('pincode');
      let fax = $(this).data('fax');


      // Fill form fields
      $('#edit_branch_id').val(branchId);
      $('#edit_branch_name').val(branchName);
      $('#edit_contact_person').val(contactPerson);
      $('#edit_mobile_no').val(mobileNo);
      $('#edit_customer_code').val(customerCode);
      $('#edit_email').val(email);
      $('#edit_phone').val(phone);
      $('#edit_address_line_1').val(address1);
      $('#edit_address_line_2').val(address2);
      $('#edit_pincode').val(pincode);
      $('#edit_fax').val(fax);

      $('#edit_branch_state_id').empty().append('<option value="">Loading...</option>');
      $('#edit_branch_city_id').empty().append('<option value="">Loading...</option>');

      // Set State
      $('#edit_branch_area_id').val(areaId).trigger('change');

      $.ajax({
        url: "{{ route('admin.customer.area.city') }}",
        type: "POST",
        data: {
          areaID: areaId,
          _token: "{{ csrf_token() }}"
        },
        dataType: "json",
        success: function (res) {

          if (res.status) {

            // STATE
            $('#edit_branch_state_id')
              .empty()
              .append(`<option value="${res.state.id}">${res.state.name}</option>`)
              .val(res.state.id)
              .trigger('change');

            // CITY
            $('#edit_branch_city_id')
              .empty()
              .append(`<option value="${res.city.id}">${res.city.name}</option>`)
              .val(res.city.id)
              .trigger('change');
          }
        },
        error: function () {
          alert('Unable to load city/state');
        }
      });

      // Show modal
      $('#editBranchModal').modal('show');
      $('#branchModal').modal('hide');

      $(document).on('change', '#edit_branch_area_id', function () {

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
                $('#edit_branch_city_id').empty()
                  .append('<option value="' + res.city.id + '">' + res.city.name + '</option>');

                // STATE
                $('#edit_branch_state_id').empty()
                  .append('<option value="' + res.state.id + '">' + res.state.name + '</option>');
              }
            },
            error: function () {
              alert('Unable to fetch city/state');
            }
          });
        } else {
          $('#edit_branch_city_id').empty().append('<option value="">Select City</option>');
          $('#edit_branch_state_id').empty().append('<option value="">Select State</option>');
        }
      });

    });
  </script>


  <script>
    $(document).on('click', '.viewContactBtn', function () {
      var customerId = $(this).data('customer-id');
      var customerName = $(this).data('customer-name');
      var customerUuid = $(this).data('customer-uuid');

      $('#contactCustomerName').text(customerName);
      $('#addcontactCustomerName').text(customerName);
      $('#editcontactCustomerName').text(customerName);
      // $('#branchTable tbody').html('');
      $('#contact_customer_id').val(customerId);
      $('#contact_customer_uuid').val(customerUuid);

      $('#contactTable tbody').html(
        '<tr><td colspan="10" class="text-center">Loading...</td></tr>'
      );

      $.ajax({
        url: "{{ route('admin.customer.get.customer.contact') }}",
        type: "POST",
        data: {
          customer_id: customerId,
          _token: "{{ csrf_token() }}"
        },
        success: function (res) {

          let html = '';
          let i = 1;

          if (res.length > 0) {
            $.each(res, function (key, val) {
              html += `
  <tr>
      <td>${i++}</td>
      <td>${val.contact_name ?? '-'}</td>
      <td>${val.department ?? '-'}</td>
      <td>${val.designation ?? '-'}</td>
      <td>${val.date_of_birth ?? '-'}</td>
      <td>${val.mobile_no ?? '-'}</td>
      <td>${val.email_id ?? '-'}</td>
      <td>${val.created_by ?? '-'}</td>
      <td>${val.modified_by ?? '-'}</td>

      <td class="text-center">
          <i class="icon-pencil-alt text-primary editContactBtn"
            data-id="${val.id}"
              data-contact_name="${val.contact_name ?? ''}"
              data-department="${val.department ?? ''}"
              data-designation="${val.designation ?? ''}"
              data-dob="${val.date_of_birth ?? ''}"
              data-mobile="${val.mobile_no ?? ''}"
              data-email="${val.email_id ?? ''}"
              data-bs-toggle="modal"
              data-bs-target="#editContactModal">
          </i>
          <i class="icon-trash text-danger deleteContactBtn" data-uuid="${val.uuid}"></i>
      </td>
  </tr>
  `;


            });
          } else {
            html = `
                      <tr>
                          <td colspan="10" class="text-center text-muted">
                              No Contact Found
                          </td>
                      </tr>
                  `;
          }

          $('#contactTable tbody').html(html);
        },
        error: function () {
          alert('Failed to load contact data');
        }
      });

      $('#contactModal').modal('show');
    });

    $(document).on('click', '#addContactBtn', function () {
      $('#addContactModal').modal('show');
      $('#contactModal').modal('hide');
    });

    $(document).on('click', '.editContactBtn', function () {

      $('#edit_id').val($(this).data('id'));
      $('#edit_contact_name').val($(this).data('contact_name'));
      $('#edit_department').val($(this).data('department'));
      $('#edit_designation').val($(this).data('designation'));
      $('#edit_dob').val($(this).data('dob'));
      $('#edit_mobile').val($(this).data('mobile'));
      $('#edit_email_id').val($(this).data('email'));

    });
  </script>


@endpush