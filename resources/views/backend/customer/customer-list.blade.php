@extends('backend.common.master')
@section('main-section')
  <div class="container-fluid">
    <div class="page-title">
      <div class="row">
        <div class="col-6">
          <h4>Customer List</h4>
        </div>
        <div class="col-6">
          <ol class="breadcrumb justify-content-end">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
            <li class="breadcrumb-item active">Customer List</li>
            <a href="{{ route('admin.customer.create') }}" class="ms-3">
              <button type="button" class="btn btn-primary-custom" data-bs-toggle="tooltip" title="Add User">
                <i class="fa fa-plus me-1"></i> Add Customer
              </button>
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
                    <th width="140" class="text-center">Action</th>
                  </tr>
                </thead>
                <tbody>

                  @php $i = 0; @endphp
                  @foreach($customerList as $customers)
                    @php $i++; @endphp

                    <tr>
                      <td>{{ $i }}</td>
                      <td class="fw-medium">{{ $customers->customer_name }}</td>
                      <td>{{ $customers->mobile_no }}</td>
                      <td>{{ $customers->contact_person }}</td>
                      <td>{{ $customers->email }}</td>
                      <td class="text-center">

                        <div class="d-flex justify-content-center align-items-center gap-2">

                          <button type="button" class="btn btn-sm-custom btn-outline-custom viewBranchBtn"
                            data-customer-id="{{ $customers->id }}" data-customer-uuid="{{ $customers->uuid }}"
                            data-customer-name="{{ $customers->customer_name }}">
                            Branch
                          </button>

                          <button type="button" class="btn btn-sm-custom btn-outline-custom viewProductBtn"
                            data-customer-id="{{ $customers->id }}" data-customer-uuid="{{ $customers->uuid }}"
                            data-customer-name="{{ $customers->customer_name }}">
                            Product
                          </button>

                          <button type="button" class="btn btn-sm-custom btn-outline-custom viewContactBtn"
                            data-customer-id="{{ $customers->id }}" data-customer-uuid="{{ $customers->uuid }}"
                            data-customer-name="{{ $customers->customer_name }}">
                            Contact
                          </button>

                          <div class="dropdown">
                            <button class="btn btn-sm-custom btn-outline-custom" type="button" data-bs-toggle="dropdown"
                              aria-expanded="false" data-bs-boundary="viewport">
                              <i class="icon-more-alt" style="font-size: 18px; transform: rotate(90deg); color: #666;"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0">
                              <li>
                                <a class="dropdown-item viewCustomer py-2" href="javascript:void(0)"
                                  data-id="{{ $customers->id }}" data-uuid="{{ $customers->uuid }}"
                                  data-customer_name="{{ $customers->customer_name }}"
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
                                  <i class="icon-eye me-2 text-primary"></i> View
                                </a>
                              </li>
                              <li>
                                <a class="dropdown-item py-2"
                                  href="{{ route('admin.customer.edit', ['uuid' => $customers->uuid]) }}">
                                  <i class="icon-pencil-alt me-2 text-warning"></i> Edit
                                </a>
                              </li>
                              <li>
                                <a class="dropdown-item py-2 text-danger"
                                  href="{{ route('admin.customer.delete', ['uuid' => $customers->uuid]) }}"
                                  onclick="return confirm('Are you sure you want to delete this record?');">
                                  <i class="icon-trash me-2"></i> Delete
                                </a>
                              </li>
                            </ul>
                          </div>
                        </div>
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


  <!-- View Customer Modal -->
  <div class="modal fade" id="viewCustomerModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content modal-content-premium">
        <div class="modal-header modal-header-premium">
          <h5 class="modal-title modal-title-premium"><i class="icon-user me-2"></i>Customer Details</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body p-4">

          <!-- Basic Info -->
          <div class="mb-4">
            <h6 class="section-title">Basic Information</h6>
            <div class="row g-3">
              <div class="col-md-6">
                <small class="text-muted d-block">Customer Name</small>
                <span class="fw-semibold" id="v_customer_name"></span>
              </div>
              <div class="col-md-6">
                <small class="text-muted d-block">Mobile</small>
                <span id="v_mobile_no"></span>
              </div>
              <div class="col-md-6">
                <small class="text-muted d-block">Contact Person</small>
                <span id="v_contact_person"></span>
              </div>
              <div class="col-md-6">
                <small class="text-muted d-block">Email</small>
                <span id="v_email"></span>
              </div>
            </div>
          </div>

          <!-- Address -->
          <div class="mb-4">
            <h6 class="section-title">Address & Location</h6>
            <div class="row g-3">
              <div class="col-12">
                <small class="text-muted d-block">Address</small>
                <span id="v_address"></span>
              </div>
              <div class="col-md-4">
                <small class="text-muted d-block">City</small>
                <span id="v_city_id"></span>
              </div>
              <div class="col-md-4">
                <small class="text-muted d-block">State</small>
                <span id="v_state_id"></span>
              </div>
              <div class="col-md-4">
                <small class="text-muted d-block">Area</small>
                <span id="v_area_id"></span>
              </div>
            </div>
          </div>

          <!-- Tax Details -->
          <div class="mb-4">
            <h6 class="section-title">Tax & Financial</h6>
            <div class="row g-3">
              <div class="col-md-4">
                <small class="text-muted d-block">GST No</small>
                <span id="v_gst"></span>
              </div>
            </div>
          </div>

          <!-- Contact Details -->
          <div class="mb-0">
            <h6 class="section-title">Other Contact Info</h6>
            <div class="row g-3">
              <div class="col-md-4">
                <small class="text-muted d-block">Phone 1</small>
                <span id="v_phone_1"></span>
              </div>
              <div class="col-md-4">
                <small class="text-muted d-block">Phone 2</small>
                <span id="v_phone_2"></span>
              </div>
              <div class="col-md-4">
                <small class="text-muted d-block">Website</small>
                <span id="v_web_sites"></span>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>


  <!-- Branch Modal -->
  <div class="modal fade" id="branchModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
      <div class="modal-content modal-content-premium">
        <div class="modal-header modal-header-premium">
          <h5 class="modal-title modal-title-premium">Branches of <span id="branchCustomerName" class="fw-bold"></span>
          </h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body p-4">

          <div class="d-flex justify-content-between mb-4 align-items-center">
            <h6 class="mb-0 fw-bold text-dark">Branch List</h6>
            <a href="javascript:void(0)" class="btn btn-primary-custom" id="addBranchBtn"><i class="fa fa-plus me-1"></i>
              Add Branch</a>
          </div>

          <div class="table-responsive custom-scrollbar">
            <table class="table table-premium table-striped" id="branchTable">
              <thead>
                <tr>
                  <th>Sr.no</th>
                  <th>Branch Name</th>
                  <th>Contact Person</th>
                  <th>Mobile</th>
                  <th>Email</th>
                  <th>Phone</th>
                  <th>Address</th>
                  <th>State</th>
                  <th>City</th>
                  <th>Area</th>
                  <th>Pincode</th>
                  <th>Created By</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <!-- Populated via JS -->
              </tbody>
            </table>
          </div>

        </div>
      </div>
    </div>
  </div>


  <!-- Contact Modal -->
  <div class="modal fade" id="contactModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
      <div class="modal-content modal-content-premium">
        <div class="modal-header modal-header-premium">
          <h5 class="modal-title modal-title-premium">Contacts for&nbsp;<span id="contactCustomerName"
              class="fw-bold"></span></h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body p-4">

          <div class="d-flex justify-content-between align-items-center mb-4">
            <h6 class="mb-0 fw-bold text-dark">Contact List</h6>
            <div class="d-flex gap-2 align-items-center">
              <div style="min-width: 200px;">
                <select id="contactBranchFilter" class="form-control form-control-premium select2">
                  <option value="">All Branches</option>
                </select>
              </div>
              <button class="btn btn-primary-custom" id="addContactBtn">
                <i class="icon-plus me-1"></i> Add Contact
              </button>
            </div>
          </div>
          <div class="table-responsive custom-scrollbar">
            <table class="table table-premium table-striped table-hover" id="contactTable">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Name</th>
                  <th>Branch</th>
                  <th>Department</th>
                  <th>Designation</th>
                  <th>DOB</th>
                  <th>Mobile No</th>
                  <th>Email</th>
                  <th>Created By</th>
                  <th class="text-center">Action</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td colspan="10" class="text-center">Loading...</td>
                </tr>
              </tbody>
            </table>
          </div>

        </div>
      </div>
    </div>
  </div>


  <!-- Add Branch Modal -->
  <div class="modal fade" id="addBranchModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content modal-content-premium">
        <div class="modal-header modal-header-premium">
          <h5 class="modal-title modal-title-premium">Add Branch for <span id="addbranchCustomerName"
              class="fw-bold"></span></h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body p-4">
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

            <div class="mt-4 text-end">
              <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-primary-custom">Save Branch</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Edit Branch Modal -->
  <div class="modal fade" id="editBranchModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content modal-content-premium">
        <div class="modal-header modal-header-premium">
          <h5 class="modal-title modal-title-premium">Edit Branch <span id="editbranchCustomerName"
              class="fw-bold"></span></h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body p-4">
          <form id="editBranchForm" method="post" action="{{ route('admin.customer.edit.customer.branch') }}">
            @csrf
            <input type="hidden" name="branch_id" id="edit_branch_id">

            <div class="row g-3">
              <div class="col-md-6">
                <label class="form-label-premium">Branch Name <span class="text-danger">*</span></label>
                <input type="text" name="branch_name" id="edit_branch_name" class="form-control form-control-premium"
                  required>
              </div>

              <div class="col-md-6">
                <label class="form-label-premium">Contact Person</label>
                <input type="text" name="contact_person" id="edit_contact_person"
                  class="form-control form-control-premium">
              </div>

              <div class="col-md-6">
                <label class="form-label-premium">Mobile No</label>
                <input type="text" name="mobile_no" id="edit_mobile_no" class="form-control form-control-premium">
              </div>

              <div class="col-md-6">
                <label class="form-label-premium">Email</label>
                <input type="email" name="email" id="edit_email" class="form-control form-control-premium">
              </div>

              <div class="col-md-6">
                <label class="form-label-premium">Phone</label>
                <input type="text" name="phone" id="edit_phone" class="form-control form-control-premium">
              </div>

              <div class="col-md-6">
                <label class="form-label-premium">Area</label>
                <select name="area_id" id="edit_branch_area_id" class="form-control select2">
                  <option value="">Select Area</option>
                  @foreach($areaList as $areas)
                    <option value="{{ $areas->id }}">{{ $areas->area }}</option>
                  @endforeach
                </select>
              </div>

              <div class="col-md-6">
                <label class="form-label-premium">City <span class="text-danger">*</span></label>
                <select name="city_id" id="edit_branch_city_id" class="form-control select2" required>
                  <option value="">Select City</option>
                  @foreach($cityList as $cities)
                    <option value="{{ $cities->id }}">{{ $cities->city }}</option>
                  @endforeach
                </select>
              </div>

              <div class="col-md-6">
                <label class="form-label-premium">State <span class="text-danger">*</span></label>
                <select name="state_id" id="edit_branch_state_id" class="form-control select2" required>
                  <option value="">Select State</option>
                  @foreach($stateList as $states)
                    <option value="{{ $states->id }}">{{ $states->state }}</option>
                  @endforeach
                </select>
              </div>

              <div class="col-md-6">
                <label class="form-label-premium">Pincode</label>
                <input type="text" name="pincode" id="edit_pincode" class="form-control form-control-premium">
              </div>

              <div class="col-md-12">
                <label class="form-label-premium">Address Line 1</label>
                <textarea name="address_line_1" id="edit_address_line_1" class="form-control form-control-premium"
                  rows="2"></textarea>
              </div>

              <div class="col-md-12">
                <label class="form-label-premium">Address Line 2</label>
                <textarea name="address_line_2" id="edit_address_line_2" class="form-control form-control-premium"
                  rows="2"></textarea>
              </div>

            </div>

            <div class="mt-4 text-end">
              <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-primary-custom">Update Branch</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>


  <!-- Add Contact Modal -->
  <div class="modal fade" id="addContactModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content modal-content-premium">
        <div class="modal-header modal-header-premium">
          <h5 class="modal-title modal-title-premium">Add Contact for <span id="addcontactCustomerName"
              class="fw-bold"></span></h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body p-4">
          <form id="addBranchForm" method="post" action="{{ route('admin.customer.add.contact') }}">
            @csrf
            <input type="hidden" name="customer_uuid" id="contact_customer_uuid">
            <input type="hidden" name="customer_id" id="contact_customer_id">

            <div class="row g-3">
              <div class="col-md-6">
                <label class="form-label-premium">Branch</label>
                <select class="form-control form-control-premium select2" name="branch_id" id="add_contact_branch_id">
                  <option value="">Select Branch</option>
                </select>
              </div>
              <div class="col-md-6">
                <label class="form-label-premium">Name <span class="text-danger">*</span></label>
                <input type="text" name="contact_name" class="form-control form-control-premium" required>
              </div>

              <div class="col-md-6">
                <label class="form-label-premium">Department</label>
                <input type="text" name="department" class="form-control form-control-premium">
              </div>

              <div class="col-md-6">
                <label class="form-label-premium">Designation</label>
                <input type="text" name="designation" class="form-control form-control-premium">
              </div>

              <div class="col-md-6">
                <label class="form-label-premium">Mobile No</label>
                <input type="text" name="mobile_no" class="form-control form-control-premium">
              </div>

              <div class="col-md-6">
                <label class="form-label-premium">Email</label>
                <input type="email" name="email_id" class="form-control form-control-premium">
              </div>

              <div class="col-md-6">
                <label class="form-label-premium">Date Of Birth</label>
                <input type="date" name="date_of_birth" class="form-control form-control-premium">
              </div>
            </div>

            <div class="mt-4 text-end">
              <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-primary-custom">Save Contact</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>


  <!-- Edit Contact Modal -->
  <div class="modal fade" id="editContactModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content modal-content-premium">
        <div class="modal-header modal-header-premium">
          <h5 class="modal-title modal-title-premium">Edit Contact for <span id="editcontactCustomerName"
              class="fw-bold"></span></h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body p-4">
          <form id="addContactForm" method="post" action="{{ route('admin.customer.edit.contact') }}">
            @csrf
            <input type="hidden" id="edit_id" name="id">

            <div class="row g-3">
              <div class="col-md-6">
                <label class="form-label-premium">Branch</label>
                <select class="form-control form-control-premium select2" name="branch_id" id="edit_contact_branch_id">
                  <option value="">Select Branch</option>
                </select>
              </div>
              <div class="col-md-6">
                <label class="form-label-premium">Name</label>
                <input type="text" id="edit_contact_name" name="contact_name" class="form-control form-control-premium">
              </div>

              <div class="col-md-6">
                <label class="form-label-premium">Department</label>
                <input type="text" id="edit_department" name="department" class="form-control form-control-premium">
              </div>

              <div class="col-md-6">
                <label class="form-label-premium">Designation</label>
                <input type="text" id="edit_designation" name="designation" class="form-control form-control-premium">
              </div>

              <div class="col-md-6">
                <label class="form-label-premium">Mobile No</label>
                <input type="text" id="edit_mobile" name="mobile_no" class="form-control form-control-premium">
              </div>

              <div class="col-md-6">
                <label class="form-label-premium">Email</label>
                <input type="email" id="edit_email_id" name="email_id" class="form-control form-control-premium">
              </div>

              <div class="col-md-6">
                <label class="form-label-premium">Date Of Birth</label>
                <input type="date" id="edit_dob" name="date_of_birth" class="form-control form-control-premium">
              </div>
            </div>

            <div class="mt-4 text-end">
              <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-primary-custom">Update Contact</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>


  <!-- Product List Modal -->
  <div class="modal fade" id="productModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
      <div class="modal-content modal-content-premium">
        <div class="modal-header modal-header-premium">
          <h5 class="modal-title modal-title-premium">Products for&nbsp;<span id="productCustomerName"
              class="fw-bold"></span></h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body p-4">
          <div class="d-flex justify-content-between align-items-center mb-4">
            <h6 class="mb-0 fw-bold text-dark">Product List</h6>
            <button type="button" class="btn btn-sm-custom btn-primary-custom" id="addProductBtn">
              <i class="icon-plus me-1"></i> Add Product
            </button>
          </div>
          <div class="table-responsive custom-scrollbar">
            <table class="table table-premium table-striped" id="productTable">
              <thead>
                <tr>
                  <th>Sr.no</th>
                  <th>Product Name</th>
                  <th>Serial No</th>
                  <th>Branch</th>
                  <th>Date</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <!-- Populated via JS -->
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Add Product Modal -->
  <div class="modal fade" id="addProductModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
      <div class="modal-content modal-content-premium">
        <div class="modal-header modal-header-premium">
          <h5 class="modal-title modal-title-premium">Add Product</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body p-4">
          <form id="addProductForm">
            <input type="hidden" id="add_product_customer_id" name="customer_id">

            <!-- Row 1 -->
            <div class="row g-3 mb-3">
              <div class="col-md-4">
                <label class="form-label-premium">Branch</label>
                <select class="form-control form-control-premium select2" id="add_prod_branch_id" name="branch_id"
                  required style="width:100%">
                  <option value="">Select Branch</option>
                </select>
              </div>
              <div class="col-md-4">
                <label class="form-label-premium">AMC Product</label>
                <select class="form-control form-control-premium select2" id="add_prod_amc_product_id"
                  name="amc_product_id" required style="width:100%">
                  <option value="">Select Product</option>
                </select>
              </div>
              <div class="col-md-4">
                <label class="form-label-premium">Quantity</label>
                <input type="number" class="form-control form-control-premium" name="quantity" value="1">
              </div>
            </div>

            <!-- Row 2 -->
            <div class="row g-3 mb-3">
              <div class="col-md-4">
                <label class="form-label-premium">Product Type</label>
                <input type="text" class="form-control form-control-premium" name="product_type">
              </div>
              <div class="col-md-4">
                <label class="form-label-premium">Product Category</label>
                <input type="text" class="form-control form-control-premium" name="product_category">
              </div>
              <div class="col-md-4">
                <label class="form-label-premium">Department</label>
                <input type="text" class="form-control form-control-premium" name="department">
              </div>
            </div>

            <!-- Row 3 Description/User -->
            <div class="row g-3 mb-3">
              <div class="col-md-8">
                <label class="form-label-premium">Description / Serial No.</label>
                <input type="text" class="form-control form-control-premium" name="description">
              </div>
              <div class="col-md-4">
                <label class="form-label-premium">User Name</label>
                <input type="text" class="form-control form-control-premium" name="user_name">
              </div>
            </div>

            <hr>
            <h6 class="fw-bold mb-3">Service Dates & Engineers</h6>

            <!-- Dates & Engineers -->
            <div class="row g-3 mb-3">
              <div class="col-md-3">
                <label class="form-label-premium">AMC Start Date</label>
                <input type="date" class="form-control form-control-premium" name="amc_start_date">
              </div>
              <div class="col-md-3">
                <label class="form-label-premium">AMC End Date</label>
                <input type="date" class="form-control form-control-premium" name="amc_end_date">
              </div>
            </div>

            <div class="row g-3 mb-3">
              <div class="col-md-3">
                <label class="form-label-premium">Service Date 1</label>
                <input type="date" class="form-control form-control-premium" name="service_date_1">
              </div>
              <div class="col-md-3">
                <label class="form-label-premium">Engineer 1</label>
                <select class="form-control form-control-premium select2" id="add_prod_eng_1" name="service_engineer_1"
                  style="width:100%">
                  <option value="">Select Engineer</option>
                </select>
              </div>

              <div class="col-md-3">
                <label class="form-label-premium">Service Date 2</label>
                <input type="date" class="form-control form-control-premium" name="service_date_2">
              </div>
              <div class="col-md-3">
                <label class="form-label-premium">Engineer 2</label>
                <select class="form-control form-control-premium select2" id="add_prod_eng_2" name="service_engineer_2"
                  style="width:100%">
                  <option value="">Select Engineer</option>
                </select>
              </div>
            </div>

            <div class="d-flex justify-content-end mt-4">
              <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-primary-custom" id="saveProductBtn">Save Product</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Edit Product Modal -->
  <div class="modal fade" id="editProductModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
      <div class="modal-content modal-content-premium">
        <div class="modal-header modal-header-premium">
          <h5 class="modal-title modal-title-premium">Edit Product</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body p-4">
          <form id="editProductForm">
            <input type="hidden" id="edit_product_id" name="id">

            <!-- Row 1 -->
            <div class="row g-3 mb-3">
              <div class="col-md-4">
                <label class="form-label-premium">Branch</label>
                <select class="form-control form-control-premium select2" id="edit_prod_branch_id" name="branch_id"
                  required style="width:100%">
                  <option value="">Select Branch</option>
                </select>
              </div>
              <div class="col-md-4">
                <label class="form-label-premium">AMC Product</label>
                <select class="form-control form-control-premium select2" id="edit_prod_amc_product_id"
                  name="amc_product_id" required style="width:100%">
                  <option value="">Select Product</option>
                </select>
              </div>
              <div class="col-md-4">
                <label class="form-label-premium">Quantity</label>
                <input type="number" class="form-control form-control-premium" id="edit_prod_quantity" name="quantity">
              </div>
            </div>

            <!-- Row 2 -->
            <div class="row g-3 mb-3">
              <div class="col-md-4">
                <label class="form-label-premium">Product Type</label>
                <input type="text" class="form-control form-control-premium" id="edit_prod_type" name="product_type">
              </div>
              <div class="col-md-4">
                <label class="form-label-premium">Product Category</label>
                <input type="text" class="form-control form-control-premium" id="edit_prod_category"
                  name="product_category">
              </div>
              <div class="col-md-4">
                <label class="form-label-premium">Department</label>
                <input type="text" class="form-control form-control-premium" id="edit_prod_department" name="department">
              </div>
            </div>

            <!-- Row 3 Description/User -->
            <div class="row g-3 mb-3">
              <div class="col-md-8">
                <label class="form-label-premium">Description / Serial No.</label>
                <input type="text" class="form-control form-control-premium" id="edit_prod_description"
                  name="description">
              </div>
              <div class="col-md-4">
                <label class="form-label-premium">User Name</label>
                <input type="text" class="form-control form-control-premium" id="edit_prod_user_name" name="user_name">
              </div>
            </div>

            <hr>
            <h6 class="fw-bold mb-3">Service Dates & Engineers</h6>

            <!-- Dates & Engineers -->
            <div class="row g-3 mb-3">
              <div class="col-md-3">
                <label class="form-label-premium">AMC Start Date</label>
                <input type="date" class="form-control form-control-premium" id="edit_prod_amc_start"
                  name="amc_start_date">
              </div>
              <div class="col-md-3">
                <label class="form-label-premium">AMC End Date</label>
                <input type="date" class="form-control form-control-premium" id="edit_prod_amc_end" name="amc_end_date">
              </div>
            </div>

            <div class="row g-3 mb-3">
              <div class="col-md-3">
                <label class="form-label-premium">Service Date 1</label>
                <input type="date" class="form-control form-control-premium" id="edit_prod_sdate_1" name="service_date_1">
              </div>
              <div class="col-md-3">
                <label class="form-label-premium">Engineer 1</label>
                <select class="form-control form-control-premium select2" id="edit_prod_eng_1" name="service_engineer_1"
                  style="width:100%">
                  <option value="">Select Engineer</option>
                </select>
              </div>

              <div class="col-md-3">
                <label class="form-label-premium">Service Date 2</label>
                <input type="date" class="form-control form-control-premium" id="edit_prod_sdate_2" name="service_date_2">
              </div>
              <div class="col-md-3">
                <label class="form-label-premium">Engineer 2</label>
                <select class="form-control form-control-premium select2" id="edit_prod_eng_2" name="service_engineer_2"
                  style="width:100%">
                  <option value="">Select Engineer</option>
                </select>
              </div>
            </div>

            <div class="d-flex justify-content-end mt-4">
              <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-primary-custom" id="updateProductBtn">Update Product</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

@endsection


@push('scripts')

  <link rel="stylesheet" href="{{ asset('public/assets/css/vendors/select2.css') }}">

  <!-- Select2 JS -->
  <script src="{{ asset('public/assets/js/select2/select2.full.min.js') }}"></script>

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

      $('#addContactModal .select2').select2({
        placeholder: 'Select Branch',
        allowClear: true,
        width: '100%',
        dropdownParent: $('#addContactModal')
      });

      $('#editContactModal .select2').select2({
        placeholder: 'Select Branch',
        allowClear: true,
        width: '100%',
        dropdownParent: $('#editContactModal')
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

        $('#branchTable tbody').html('<tr><td colspan="13" class="text-center">Loading...</td></tr>');

        $.ajax({
          url: "{{ route('admin.customer.get.customer.branch') }}",
          type: "POST",
          data: {
            customer_id: customerId,
            _token: "{{ csrf_token() }}"
          },
          dataType: "json",
          success: function (res) {
            if (res.status == true) {
              var html = '';
              var data = res.data;
              if (data.length > 0) {
                $.each(data, function (key, val) {
                  html += '<tr>' +
                    '<td>' + (key + 1) + '</td>' +
                    '<td>' + val.branch_name + '</td>' +
                    '<td>' + (val.contact_person ?? '-') + '</td>' +
                    '<td>' + (val.mobile_no ?? '-') + '</td>' +
                    '<td>' + (val.email ?? '-') + '</td>' +
                    '<td>' + (val.phone ?? '-') + '</td>' +
                    '<td>' + (val.address_line_1 ?? '-') + '</td>' +
                    '<td>' + (val.state_name ?? '-') + '</td>' +
                    '<td>' + (val.city_name ?? '-') + '</td>' +
                    '<td>' + (val.area_name ?? '-') + '</td>' +
                    '<td>' + (val.pincode ?? '-') + '</td>' +
                    '<td>' + (val.created_by ?? '-') + '</td>' +
                    '<td class="text-center">' +
                    '<div class="d-flex align-items-center gap-2 justify-content-center">' +
                    '<button type="button" class="btn btn-sm-custom btn-outline-primary editBranchBtn" data-data=\'' + JSON.stringify(val) + '\'><i class="icon-pencil"></i></button>' +
                    '</div>' +
                    '</td>' +
                    '</tr>';
                });
              } else {
                html += '<tr><td colspan="13" class="text-center">No Branches Found</td></tr>';
              }
              $('#branchTable tbody').html(html);
            }
          }
        });

        $('#branchModal').modal('show');
      });


      $(document).on('click', '.editBranchBtn', function () {
        var data = $(this).data('data');
        $('#edit_branch_id').val(data.id);
        $('#edit_branch_name').val(data.branch_name);
        $('#edit_contact_person').val(data.contact_person);
        $('#edit_mobile_no').val(data.mobile_no);
        $('#edit_email').val(data.email);
        $('#edit_phone').val(data.phone);
        $('#edit_fax').val(data.fax);
        $('#edit_address_line_1').val(data.address_line_1);
        $('#edit_address_line_2').val(data.address_line_2);
        $('#edit_pincode').val(data.pincode);

        // Pre-select dropdowns
        $('#edit_branch_area_id').val(data.area_id).trigger('change');

        // We need to fetch cities for selected area? Or assuming cities are loaded.
        // For simplicity reusing global lists if available.
        // NOTE: Ideally we should trigger change on Area to load cities.
        // However, if we just want to show edit modal quickly, we might need logic here.
        // For now setting direct values if options exist.

        $('#edit_branch_city_id').val(data.city_id).trigger('change');
        $('#edit_branch_state_id').val(data.state_id).trigger('change');

        $('#branchModal').modal('hide');
        $('#editBranchModal').modal('show');
      });

      $('#addBranchBtn').click(function () {
        $('#branchModal').modal('hide');
        $('#addBranchModal').modal('show');
      });

      // Contact Modal
      var currentCustomerId = '';
      var currentCustomerUuid = '';

      $(document).on('click', '.viewContactBtn', function () {
        var customerId = $(this).data('customer-id');
        var customerUuid = $(this).data('customer-uuid'); // Assuming you have this data attribute, checking line 720 next
        var customerName = $(this).data('customer-name');

        // Store for Add Contact
        currentCustomerId = customerId;
        currentCustomerUuid = customerUuid;

        $('#contactCustomerName').text(customerName);
        $('#addcontactCustomerName').text(customerName);
        $('#editcontactCustomerName').text(customerName);

        $('#contact_customer_id').val(customerId);
        $('#contact_customer_uuid').val(customerUuid);

        $('#contactTable tbody').html('<tr><td colspan="10" class="text-center">Loading...</td></tr>');

        $.ajax({
          url: "{{ route('admin.customer.get.customer.contact') }}",
          type: "POST",
          data: {
            customer_id: customerId,
            _token: "{{ csrf_token() }}"
          },
          dataType: "json",
          success: function (res) {
            if (res.status == true) {
              var html = '';
              var data = res.data;
              if (data.length > 0) {
                $.each(data, function (key, val) {
                  html += '<tr>' +
                    '<td>' + (key + 1) + '</td>' +
                    '<td>' + val.contact_name + '</td>' +
                    '<td>' + (val.branch_name ?? 'Main Branch') + '</td>' +
                    '<td>' + (val.department ?? '-') + '</td>' +
                    '<td>' + (val.designation ?? '-') + '</td>' +
                    '<td>' + (val.date_of_birth ?? '-') + '</td>' +
                    '<td>' + (val.mobile_no ?? '-') + '</td>' +
                    '<td>' + (val.email_id ?? '-') + '</td>' +
                    '<td>' + (val.created_by ?? '-') + '</td>' +
                    '<td class="text-center">' +
                    '<div class="d-flex align-items-center gap-2 justify-content-center">' +
                    '<button type="button" class="btn btn-sm-custom btn-outline-primary editContactBtn" data-data=\'' + JSON.stringify(val) + '\'><i class="icon-pencil"></i></button>' +
                    '</div>' +
                    '</td>' +
                    '</tr>';
                });
              } else {
                html += '<tr><td colspan="10" class="text-center">No Contacts Found</td></tr>';
              }

              // Populate Branch Filter
              var branchOptions = '<option value="">All Branches</option>';
              // Use a Set to store unique branches
              var uniqueBranches = new Set();
              var branchesMap = {};

              $.each(data, function (key, val) {
                if (val.branch_name) {
                  if (!uniqueBranches.has(val.branch_name)) {
                    uniqueBranches.add(val.branch_name);
                    branchOptions += '<option value="' + val.branch_name + '">' + val.branch_name + '</option>';
                  }
                } else {
                  if (!uniqueBranches.has('Main Branch')) {
                    uniqueBranches.add('Main Branch');
                    branchOptions += '<option value="Main Branch">Main Branch</option>';
                  }
                }
              });
              $('#contactBranchFilter').html(branchOptions);

              $('#contactTable tbody').html(html);
            }
          }
        });

        $('#contactModal').modal('show');

        // Fetch Branches for the dropdowns in Add/Edit Contact
        $.ajax({
          url: "{{ route('admin.customer.get.customer.branch') }}",
          type: "POST",
          data: {
            customer_id: customerId,
            _token: "{{ csrf_token() }}"
          },
          dataType: "json",
          success: function (res) {
            if (res.status == true) {
              var options = '<option value="">Select Branch</option>';
              $.each(res.data, function (key, val) {
                options += '<option value="' + val.id + '">' + val.branch_name + '</option>';
              });
              $('#add_contact_branch_id').html(options);
              $('#edit_contact_branch_id').html(options);
            }
          }
        });
      });

      // Initialize Select2 for the Branch Filter in the modal
      $('#contactBranchFilter').select2({
        placeholder: "All Branches",
        allowClear: true,
        dropdownParent: $('#contactModal'),
        width: '100%'
      });

      // Branch Filter Logic
      $('#contactBranchFilter').off('change').on('change', function () {
        var selectedBranch = $(this).val().toLowerCase();
        $('#contactTable tbody tr').filter(function () {
          $(this).toggle($(this).find('td:nth-child(3)').text().toLowerCase().indexOf(selectedBranch) > -1)
        });
      });

      $('#addContactBtn').click(function () {
        // Set hidden fields
        $('#contact_customer_id').val(currentCustomerId);
        $('#contact_customer_uuid').val(currentCustomerUuid);

        // Reset form and select2
        $('#addBranchForm')[0].reset();
        $('#add_contact_branch_id').val('').trigger('change');

        $('#contactModal').modal('hide');
        $('#addContactModal').modal('show');
      });

      $(document).on('click', '.editContactBtn', function () {
        var data = $(this).data('data');
        $('#edit_id').val(data.id);
        $('#edit_contact_name').val(data.contact_name);
        $('#edit_department').val(data.department);
        $('#edit_designation').val(data.designation);
        $('#edit_mobile').val(data.mobile_no);
        $('#edit_email_id').val(data.email_id);
        $('#edit_dob').val(data.date_of_birth);
        $('#edit_contact_branch_id').val(data.branch_id).trigger('change');

        $('#contactModal').modal('hide');
        $('#editContactModal').modal('show');
      });

    });
  </script>


  <!-- Product Management JS -->
  <script>
    $(document).ready(function () {
      var prodCustomerId = '';
      var prodCustomerUuid = '';

      // Helper to load dropdowns
      function loadProductDropdowns(targetModal) {
        $.ajax({
          url: "{{ route('admin.customer.get.product.form.data') }}",
          type: 'GET',
          dataType: 'json',
          success: function (res) {
            if (res.status) {
              // Populate AMC Products
              var amcOpts = '<option value="">Select Product</option>';
              $.each(res.amc_products, function (k, v) {
                amcOpts += '<option value="' + v.id + '">' + v.amc_product + '</option>';
              });
              $(targetModal).find('select[name="amc_product_id"]').html(amcOpts);

              // Populate Engineers
              var engOpts = '<option value="">Select Engineer</option>';
              $.each(res.engineers, function (k, v) {
                engOpts += '<option value="' + v.id + '">' + v.name + '</option>';
              });
              $(targetModal).find('select[name="service_engineer_1"]').html(engOpts);
              $(targetModal).find('select[name="service_engineer_2"]').html(engOpts);
              // Engineer 3 if needed
            }
          }
        });
      }

      // Helper to fetch Branches for specific customer
      function loadCustomerBranches(customerId, targetModal) {
        $.ajax({
          url: "{{ route('admin.customer.get.customer.branch') }}",
          type: "POST",
          data: {
            customer_id: customerId,
            _token: "{{ csrf_token() }}"
          },
          dataType: "json",
          success: function (res) {
            if (res.status == true) {
              var options = '<option value="">Select Branch</option>';
              $.each(res.data, function (key, val) {
                options += '<option value="' + val.id + '">' + val.branch_name + '</option>';
              });
              $(targetModal).find('select[name="branch_id"]').html(options);
            }
          }
        });
      }

      // 1. View Product List
      $(document).on('click', '.viewProductBtn', function () {
        prodCustomerId = $(this).data('customer-id');
        prodCustomerUuid = $(this).data('customer-uuid');
        var customerName = $(this).data('customer-name');

        $('#productCustomerName').text(customerName);
        $('#productTable tbody').html('<tr><td colspan="7" class="text-center">Loading...</td></tr>');
        $('#productModal').modal('show');

        loadProducts(prodCustomerId);
      });

      function loadProducts(customerId) {
        $.ajax({
          url: "{{ route('admin.customer.get.products') }}",
          type: 'POST',
          data: { customer_id: customerId, _token: "{{ csrf_token() }}" },
          success: function (res) {
            if (res.status) {
              var html = '';
              if (res.data.length > 0) {
                $.each(res.data, function (k, v) {
                  html += '<tr>' +
                    '<td>' + (k + 1) + '</td>' +
                    '<td>' + (v.product_name ?? '-') + '</td>' + // Joined in service
                    '<td>' + (v.description ?? '-') + '</td>' +
                    '<td>' + (v.branch_id ?? '-') + '</td>' + // Ideal: Join branch name
                    '<td>' + (v.product_type ?? '-') + '</td>' + // Using Type column placeholder
                    '<td>' +
                    '<div class="d-flex gap-2">' +
                    '<button class="btn btn-sm-custom btn-outline-primary editProductBtn" data-data=\'' + JSON.stringify(v) + '\'><i class="icon-pencil"></i></button>' +
                    '<button class="btn btn-sm-custom btn-outline-danger deleteProductBtn" data-uuid="' + v.uuid + '"><i class="icon-trash"></i></button>' +
                    '</div>' +
                    '</td>' +
                    '</tr>';
                });
              } else {
                html = '<tr><td colspan="7" class="text-center">No Products Found</td></tr>';
              }
              $('#productTable tbody').html(html);
            }
          }
        });
      }

      // 2. Open Add Modal
      $('#addProductBtn').click(function () {
        $('#productModal').modal('hide');
        $('#addProductModal').modal('show');

        // Set Hidden ID
        $('#add_product_customer_id').val(prodCustomerId);

        // Reset Form
        $('#addProductForm')[0].reset();
        $('.select2').val('').trigger('change');

        // Load Data
        loadProductDropdowns('#addProductModal');
        loadCustomerBranches(prodCustomerId, '#addProductModal');
      });

      // 3. Save Product
      $('#saveProductBtn').click(function (e) {
        e.preventDefault();
        // Validate form? (HTML5 required works if button type submit)
        // But we are using ajax.
        // Using basic serialization
        var formData = $('#addProductForm').serialize();
        formData += '&_token={{ csrf_token() }}';

        $.ajax({
          url: "{{ route('admin.customer.add.product') }}",
          type: 'POST',
          data: formData,
          success: function (res) {
            if (res.status) {
              // Success
              $('#addProductModal').modal('hide');
              $('#productModal').modal('show');
              loadProducts(prodCustomerId);
              // Optional: Show toast
            } else {
              alert('Error: ' + res.message);
            }
          },
          error: function (err) {
            console.error(err);
            alert('An error occurred');
          }
        });
      });

      // 4. Edit Product
      $(document).on('click', '.editProductBtn', function () {
        var data = $(this).data('data');

        $('#productModal').modal('hide');
        $('#editProductModal').modal('show');

        // Load Dropdowns first then set value
        // We need async handling or just load and set.
        // For simplicity, calling load then setting values after delay or blindly.
        // ideally we wait.
        // Let's load dropdowns and assume they populate. 
        // Setting values in Select2 requires option to exist.

        // Trigger Load
        loadProductDropdowns('#editProductModal');
        loadCustomerBranches(prodCustomerId, '#editProductModal');

        // Set Values
        $('#edit_product_id').val(data.id);
        $('#edit_prod_quantity').val(data.quantity);
        $('#edit_prod_type').val(data.product_type);
        $('#edit_prod_category').val(data.product_category);
        $('#edit_prod_department').val(data.department);
        $('#edit_prod_description').val(data.description);
        $('#edit_prod_user_name').val(data.user_name);
        $('#edit_prod_amc_start').val(data.amc_start_date);
        $('#edit_prod_amc_end').val(data.amc_end_date);
        $('#edit_prod_sdate_1').val(data.service_date_1);
        $('#edit_prod_sdate_2').val(data.service_date_2);

        // Select2 Values - Need a timeout or callback if data loading is async
        // Helper function is async ajax.
        // Quick fix: Set timeout
        setTimeout(function () {
          $('#edit_prod_branch_id').val(data.branch_id).trigger('change');
          $('#edit_prod_amc_product_id').val(data.amc_product_id).trigger('change');
          $('#edit_prod_eng_1').val(data.service_engineer_1).trigger('change');
          $('#edit_prod_eng_2').val(data.service_engineer_2).trigger('change');
        }, 1000);
      });

      // 5. Update Product
      $('#updateProductBtn').click(function (e) {
        e.preventDefault();
        var formData = $('#editProductForm').serialize();
        formData += '&_token={{ csrf_token() }}';

        $.ajax({
          url: "{{ route('admin.customer.edit.product') }}",
          type: 'POST',
          data: formData,
          success: function (res) {
            if (res.status) {
              $('#editProductModal').modal('hide');
              $('#productModal').modal('show');
              loadProducts(prodCustomerId);
            } else {
              alert('Error: ' + res.message);
            }
          }
        });
      });

      // 6. Delete Product
      $(document).on('click', '.deleteProductBtn', function () {
        if (confirm('Are you sure you want to delete this product?')) {
          var uuid = $(this).data('uuid');
          $.ajax({
            url: "{{ route('admin.customer.delete.product') }}",
            type: 'POST',
            data: { uuid: uuid, _token: "{{ csrf_token() }}" },
            success: function (res) {
              if (res.status) {
                loadProducts(prodCustomerId);
              } else {
                alert('Error: ' + res.message);
              }
            }
          });
        }
      });

      // Initialize Select2 in new modals
      $('#addProductModal .select2').select2({
        dropdownParent: $('#addProductModal')
      });
      $('#editProductModal .select2').select2({
        dropdownParent: $('#editProductModal')
      });

    });
  </script>

@endpush