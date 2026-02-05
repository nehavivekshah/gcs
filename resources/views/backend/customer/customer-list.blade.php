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
                      <td class="fw-medium">{{ $customers->company_name }}</td>
                      <td>{{ $customers->mobile_no }}</td>
                      <td>{{ $customers->contact_person }}</td>
                      <td>{{ $customers->email }}</td>
                      <td class="text-center">

                        <div class="d-flex justify-content-center align-items-center gap-2">

                          <a href="javascript:void(0)" class="viewCustomer btn btn-sm-custom btn-outline-dark"
                            data-id="{{ $customers->id }}" data-uuid="{{ $customers->uuid }}"
                            data-company_name="{{ $customers->company_name }}"
                            data-customer_code="{{ $customers->customer_code }}"
                            data-customer_type="{{ $customers->customer_type }}"
                            data-customer_category="{{ $customers->customer_category }}"
                            data-contact_person="{{ $customers->contact_person }}"
                            data-mobile_no="{{ $customers->mobile_no }}" data-email="{{ $customers->email }}"
                            data-website="{{ $customers->website }}" data-address_line_1="{{ $customers->address_line_1 }}"
                            data-address_line_2="{{ $customers->address_line_2 }}"
                            data-area_id="{{ $customers->area_name }}" data-city_id="{{ $customers->city_name }}"
                            data-state_id="{{ $customers->state_name }}" data-pincode="{{ $customers->pincode }}"
                            data-phone_1="{{ $customers->phone_1 }}" data-phone_2="{{ $customers->phone_2 }}"
                            data-gst="{{ $customers->gst }}" data-fax="{{ $customers->fax }}"
                            data-cst="{{ $customers->cst }}" data-vat="{{ $customers->vat }}"
                            data-pan="{{ $customers->pan }}" data-credit_days="{{ $customers->credit_days }}"
                            data-date_of_birth="{{ $customers->date_of_birth }}" data-ac_key="{{ $customers->ac_key }}"
                            data-created_by="{{ $customers->created_by }}" data-modified_by="{{ $customers->modified_by }}"
                            data-bs-toggle="tooltip" title="View">
                            <i class="icon-eye"></i>
                          </a>

                          <a href="{{ route('admin.customer.edit', ['uuid' => $customers->uuid]) }}"
                            class="btn btn-sm-custom btn-outline-dark" data-bs-toggle="tooltip" title="Edit">
                            <i class="icon-pencil-alt"></i>
                          </a>

                          <a href="{{ route('admin.customer.delete', ['uuid' => $customers->uuid]) }}"
                            class="btn btn-sm-custom btn-outline-dark"
                            onclick="return confirm('Are you sure you want to delete this record?');"
                            data-bs-toggle="tooltip" title="Delete">
                            <i class="icon-trash"></i>
                          </a>

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
  <style>
    /* Custom Styles for View Modal */
    .view-profile-header {
      background: #fdfdfd;
      padding: 24px;
      border-radius: 8px;
      margin-bottom: 25px;
      border: 1px solid #e1e7ec;
      border-left: 5px solid var(--theme-default);
    }

    .view-item-wrapper {
      margin-bottom: 16px;
    }

    .view-label {
      font-size: 0.8rem;
      /* Increased from 0.7rem */
      text-transform: uppercase;
      letter-spacing: 0.5px;
      color: #7f8c8d;
      /* Slightly darker for better contrast */
      margin-bottom: 6px;
      display: block;
      font-weight: 700;
    }

    .view-value {
      font-size: 1.05rem;
      /* Increased from 1rem */
      font-weight: 500;
      color: #2c3e50;
      word-break: break-word;
      line-height: 1.6;
      min-height: 24px;
      /* Ensure height even if empty */
    }

    /* Address Box Style */
    .address-box {
      background-color: #f8f9fa;
      border-radius: 6px;
      padding: 15px;
      border: 1px solid #e9ecef;
    }

    .view-section-title {
      display: flex;
      align-items: center;
      font-size: 1.1rem;
      font-weight: 800;
      color: #1b2533;
      margin-bottom: 24px;
      padding-bottom: 12px;
      border-bottom: 2px solid #eef2f7;
    }

    .view-section-title i {
      margin-right: 12px;
      color: var(--theme-default);
      background: #f0f3f6;
      padding: 10px;
      border-radius: 6px;
      width: 36px;
      height: 36px;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .info-card {
      background: #fff;
      border: 1px solid #e1e7ec;
      border-radius: 8px;
      padding: 24px;
      height: 100%;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.02);
      /* Subtle shadow for depth */
    }

    /* Modern Line Tabs with clear highlight */
    .nav-tabs-premium {
      border-bottom: 2px solid #eef2f7;
      gap: 5px;
      margin-bottom: 28px;
      padding-left: 0;
    }

    .nav-tabs-premium .nav-item {
      margin-bottom: -2px;
    }

    .nav-tabs-premium .nav-link {
      border: none;
      border-bottom: 3px solid transparent;
      color: #98a6ad;
      font-weight: 600;
      padding: 12px 20px;
      border-radius: 4px 4px 0 0;
      transition: all 0.2s;
      background: transparent;
      font-size: 0.95rem;
    }

    .nav-tabs-premium .nav-link.active {
      color: #d40306;
      background-color: rgba(212, 3, 6, 0.05);
      /* Lighter bg */
      border-bottom-color: #d40306;
      font-weight: 800;
    }

    .nav-tabs-premium .nav-link:hover:not(.active) {
      color: #6c757d;
      background-color: #f8f9fa;
      border-bottom-color: #dee2e6;
    }

    .nav-tabs-premium i {
      font-size: 1.1em;
      vertical-align: middle;
      margin-top: -2px;
    }

    .table-premium thead th {
      background-color: #f7f9fb !important;
      color: #5d6771 !important;
      font-weight: 700;
      text-transform: uppercase;
      font-size: 0.75rem;
      letter-spacing: 0.5px;
      border-bottom: 1px solid #e1e7ec;
      padding-top: 14px;
      padding-bottom: 14px;
    }

    .table-premium tbody td {
      border-bottom: 1px solid #f1f4f8;
      padding-top: 12px;
      padding-bottom: 12px;
      color: #2b3648;
    }
  </style>

  <div class="modal fade" id="viewCustomerModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
      <div class="modal-content modal-content-premium border-0 overflow-hidden">
        <div class="modal-header modal-header-premium bg-white border-bottom p-4">
          <div class="d-flex align-items-center">
            <div class="bg-light p-3 rounded-circle me-3 border">
              <i class="icon-user fs-4 text-secondary"></i>
            </div>
            <div>
              <h5 class="modal-title fw-bold mb-1 text-dark">Customer Details</h5>
              <p class="mb-0 text-muted fs-6">Complete profile information</p>
            </div>
          </div>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body p-4 bg-white">

          <!-- Profile Header Summary -->
          <div class="view-profile-header bg-white shadow-sm">
            <div class="row align-items-center">
              <div class="col-md-6">
                <h4 class="mb-1 text-dark fw-bold" id="v_header_name">Customer Name</h4>
                <p class="text-muted mb-0"><i class="icon-mobile me-1"></i> <span id="v_header_mobile"></span>
                  &nbsp;|&nbsp; <i class="icon-email me-1"></i> <span id="v_header_email"></span></p>
              </div>
              <div class="col-md-6 text-md-end mt-3 mt-md-0">
                <span
                  class="badge bg-light-primary text-primary px-3 py-2 rounded-pill fs-6 border border-primary border-opacity-25"
                  id="v_header_code">Code: -</span>
              </div>
            </div>
          </div>

          <ul class="nav nav-tabs nav-tabs-premium" id="viewCustomerTab" role="tablist">
            <li class="nav-item"><a class="nav-link active" id="basic-tab" data-bs-toggle="tab" href="#basic-info"
                role="tab" aria-selected="true"><i class="icon-info-alt me-2"></i>Basic Info</a></li>
            <li class="nav-item"><a class="nav-link" id="branch-tab" data-bs-toggle="tab" href="#branch-info" role="tab"
                aria-selected="false"><i class="icon-map-alt me-2"></i>Branches</a></li>
            <li class="nav-item"><a class="nav-link" id="contact-tab" data-bs-toggle="tab" href="#contact-info" role="tab"
                aria-selected="false"><i class="icon-id-badge me-2"></i>Contacts</a></li>
            <li class="nav-item"><a class="nav-link" id="product-tab" data-bs-toggle="tab" href="#product-info" role="tab"
                aria-selected="false"><i class="icon-package me-2"></i>Products</a></li>
          </ul>

          <div class="tab-content" id="viewCustomerTabContent">

            <!-- Tab 1: Basic Info -->
            <div class="tab-pane fade show active" id="basic-info" role="tabpanel" aria-labelledby="basic-tab">

              <div class="row g-4">
                <!-- Basic Information Card -->
                <div class="col-lg-7">
                  <div class="info-card">
                    <h6 class="view-section-title"><i class="icon-user"></i> Basic Information</h6>
                    <div class="row">
                      <div class="col-md-6 view-item-wrapper">
                        <small class="view-label">Customer Name</small>
                        <div class="view-value" id="v_customer_name">-</div>
                      </div>
                      <div class="col-md-6 view-item-wrapper">
                        <small class="view-label">Designation</small>
                        <div class="view-value" id="v_customer_degination">-</div>
                      </div>
                      <div class="col-md-6 view-item-wrapper">
                        <small class="view-label">Contact Person</small>
                        <div class="view-value" id="v_contact_person">-</div>
                      </div>
                      <div class="col-md-6 view-item-wrapper">
                        <small class="view-label">Date of Birth</small>
                        <div class="view-value" id="v_date_of_birth">-</div>
                      </div>
                      <div class="col-12 mt-2">
                        <div class="address-box">
                          <h6 class="text-uppercase text-secondary fw-bold fs-7 mb-2"><i
                              class="icon-location-pin me-1"></i> Address</h6>
                          <div class="view-value mb-2" id="v_address"></div>
                          <div class="text-muted small">
                            <span id="v_area_id"></span><span id="v_city_separator">, </span>
                            <span id="v_city_id" class="fw-bold text-dark"></span><span id="v_state_separator">, </span>
                            <span id="v_state_id"></span>
                            <span id="v_pincode_separator"> - </span>
                            <span id="v_pincode" class="fw-bold text-dark"></span>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- Contact Details & Financial Card -->
                <div class="col-lg-5">
                  <div class="row g-4 h-100">
                    <div class="col-12">
                      <div class="info-card">
                        <h6 class="view-section-title"><i class="icon-headphone-alt"></i> Contact Details</h6>
                        <div class="row">
                          <div class="col-12 view-item-wrapper">
                            <small class="view-label">Mobile Number</small>
                            <div class="view-value text-primary font-code fs-5" id="v_mobile_no">-</div>
                          </div>
                          <div class="col-12 view-item-wrapper">
                            <small class="view-label">Email Address</small>
                            <div class="view-value text-primary" id="v_email">-</div>
                          </div>
                          <div class="col-6 view-item-wrapper">
                            <small class="view-label">Phone 1</small>
                            <div class="view-value" id="v_phone_1">-</div>
                          </div>
                          <div class="col-6 view-item-wrapper">
                            <small class="view-label">Phone 2</small>
                            <div class="view-value" id="v_phone_2">-</div>
                          </div>
                          <div class="col-12 view-item-wrapper">
                            <small class="view-label">Website</small>
                            <div class="view-value text-info" id="v_web_sites">-</div>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="col-12">
                      <div class="info-card">
                        <h6 class="view-section-title"><i class="icon-receipt"></i> Financial Info</h6>
                        <div class="row">
                          <div class="col-6 view-item-wrapper">
                            <small class="view-label">GST No</small>
                            <div class="view-value font-code" id="v_gst">-</div>
                          </div>
                          <div class="col-6 view-item-wrapper">
                            <small class="view-label">PAN No</small>
                            <div class="view-value font-code" id="v_pan">-</div>
                          </div>
                          <div class="col-6 view-item-wrapper">
                            <small class="view-label">CST No</small>
                            <div class="view-value" id="v_cst">-</div>
                          </div>
                          <div class="col-6 view-item-wrapper">
                            <small class="view-label">VAT No</small>
                            <div class="view-value" id="v_vat">-</div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

              </div>

            </div>
            <!-- Tab 2: Branches -->
            <div class="tab-pane fade" id="branch-info" role="tabpanel" aria-labelledby="branch-tab">
              <div class="d-flex justify-content-between align-items-center mb-3">
                <h6 class="view-section-title mb-0 border-0 pb-0"><i class="icon-map-alt"></i> Branch List</h6>
                <button class="btn btn-sm btn-primary-custom" id="btnAddBranchFromView">
                  <i class="fa fa-plus me-1"></i> Add Branch
                </button>
              </div>
              <div class="info-card p-0 overflow-hidden">
                <div class="table-responsive custom-scrollbar">
                  <table class="table table-hover table-striped align-middle mb-0" id="viewBranchTable">
                    <thead class="bg-light">
                      <tr>
                        <th class="py-3 ps-4 text-secondary text-uppercase fs-7 fw-bold">#</th>
                        <th class="py-3 text-secondary text-uppercase fs-7 fw-bold">Branch Name</th>
                        <th class="py-3 text-secondary text-uppercase fs-7 fw-bold">Contact Person</th>
                        <th class="py-3 text-secondary text-uppercase fs-7 fw-bold">Mobile</th>
                        <th class="py-3 text-secondary text-uppercase fs-7 fw-bold">City</th>
                        <th class="py-3 text-secondary text-uppercase fs-7 fw-bold text-center">Action</th>
                      </tr>
                    </thead>
                    <tbody></tbody>
                  </table>
                </div>
              </div>
            </div>

            <!-- Tab 3: Contacts -->
            <div class="tab-pane fade" id="contact-info" role="tabpanel" aria-labelledby="contact-tab">
              <div class="d-flex justify-content-between align-items-center mb-3">
                <h6 class="view-section-title mb-0 border-0 pb-0"><i class="icon-id-badge"></i> Contact List</h6>
                <button class="btn btn-sm btn-primary-custom" id="btnAddContactFromView">
                  <i class="fa fa-plus me-1"></i> Add Contact
                </button>
              </div>
              <div class="info-card p-0 overflow-hidden">
                <div class="table-responsive custom-scrollbar">
                  <table class="table table-hover table-striped align-middle mb-0" id="viewContactTable">
                    <thead class="bg-light">
                      <tr>
                        <th class="py-3 ps-4 text-secondary text-uppercase fs-7 fw-bold">#</th>
                        <th class="py-3 text-secondary text-uppercase fs-7 fw-bold">Name</th>
                        <th class="py-3 text-secondary text-uppercase fs-7 fw-bold">Branch</th>
                        <th class="py-3 text-secondary text-uppercase fs-7 fw-bold">Designation</th>
                        <th class="py-3 text-secondary text-uppercase fs-7 fw-bold">Mobile</th>
                        <th class="py-3 text-secondary text-uppercase fs-7 fw-bold text-center">Action</th>
                      </tr>
                    </thead>
                    <tbody></tbody>
                  </table>
                </div>
              </div>
            </div>

            <!-- Tab 4: Products -->
            <div class="tab-pane fade" id="product-info" role="tabpanel" aria-labelledby="product-tab">
              <div class="d-flex justify-content-between align-items-center mb-3">
                <h6 class="view-section-title mb-0 border-0 pb-0"><i class="icon-package"></i> Product List</h6>
                <button class="btn btn-sm btn-primary-custom" id="btnAddProductFromView">
                  <i class="fa fa-plus me-1"></i> Add Product
                </button>
              </div>
              <div class="info-card p-0 overflow-hidden">
                <div class="table-responsive custom-scrollbar">
                  <table class="table table-hover table-striped align-middle mb-0" id="viewProductTable">
                    <thead class="bg-light">
                      <tr>
                        <th class="py-3 ps-4 text-secondary text-uppercase fs-7 fw-bold">#</th>
                        <th class="py-3 text-secondary text-uppercase fs-7 fw-bold">Product Name</th>
                        <th class="py-3 text-secondary text-uppercase fs-7 fw-bold">Serial No</th>
                        <th class="py-3 text-secondary text-uppercase fs-7 fw-bold">Branch</th>
                        <th class="py-3 text-secondary text-uppercase fs-7 fw-bold">Type</th>
                        <th class="py-3 text-secondary text-uppercase fs-7 fw-bold">AMC Start</th>
                        <th class="py-3 text-secondary text-uppercase fs-7 fw-bold">AMC End</th>
                        <th class="py-3 text-secondary text-uppercase fs-7 fw-bold text-center">Action</th>
                      </tr>
                    </thead>
                    <tbody></tbody>
                  </table>
                </div>
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
                <label class="form-label">Branch Name <span class="text-danger">*</span></label>
                <input type="text" name="branch_name" class="form-control" required>
              </div>

              <div class="col-md-6">
                <label class="form-label">Contact Person</label>
                <input type="text" name="contact_person" class="form-control">
              </div>

              <div class="col-md-6">
                <label class="form-label-premium">Department</label>
                <input type="text" name="department" class="form-control form-control-premium">
              </div>

              <div class="col-md-6">
                <label class="form-label">Designation</label>
                <input type="text" name="designation" class="form-control">
              </div>

              <div class="col-md-6">
                <label class="form-label">Mobile No</label>
                <input type="text" name="mobile_no" class="form-control">
              </div>

              <div class="col-md-6">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control">
              </div>

              <div class="col-md-6">
                <label class="form-label-premium">Date Of Birth</label>
                <input type="date" name="date_of_birth" class="form-control form-control-premium">
              </div>

              <div class="col-md-12">
                <label class="form-label">Address</label>
                <textarea name="address_line_1" class="form-control" rows="2"></textarea>
              </div>

              <div class="col-md-6">
                <label class="form-label">Area</label>
                <select name="area_id" id="branch_area_id" class="form-control select2">
                  <option value="">Select Area</option>
                  @foreach($areaList as $areas)
                    <option value="{{ $areas->id }}">{{ $areas->area }}</option>
                  @endforeach
                </select>
              </div>

              <div class="col-md-6">
                <label class="form-label">City <span class="text-danger">*</span></label>
                <select name="city_id" id="branch_city_id" class="form-control select2" required>
                  <option value="">Select City</option>
                </select>
              </div>

              <div class="col-md-6">
                <label class="form-label">State <span class="text-danger">*</span></label>
                <select name="state_id" id="branch_state_id" class="form-control select2" required>
                  <option value="">Select State</option>
                </select>
              </div>

              <div class="col-md-6">
                <label class="form-label-premium">Pincode</label>
                <input type="text" name="pincode" class="form-control form-control-premium">
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
                <label class="form-label">Branch <span class="text-danger">*</span></label>
                <select name="branch_id" id="add_contact_branch_id" class="form-control select2" required>
                  <option value="">Select Branch</option>
                </select>
              </div>
              <div class="col-md-6">
                <label class="form-label">Contact Name <span class="text-danger">*</span></label>
                <input type="text" name="contact_name" class="form-control" required>
              </div>
              <div class="col-md-6">
                <label class="form-label-premium">Department</label>
                <input type="text" name="department" class="form-control form-control-premium">
              </div>
              <div class="col-md-6">
                <label class="form-label">Designation</label>
                <input type="text" name="designation" class="form-control">
              </div>
              <div class="col-md-6">
                <label class="form-label">Mobile</label>
                <input type="text" name="mobile_no" class="form-control">
              </div>
              <div class="col-md-6">
                <label class="form-label">Email</label>
                <input type="email" name="email_id" class="form-control">
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

            <div class="row g-3">
              <div class="col-md-6">
                <label class="form-label">Branch <span class="text-danger">*</span></label>
                <select name="branch_id" id="add_prod_branch_id" class="form-control select2" required>
                  <option value="">Select Branch</option>
                </select>
              </div>

              <div class="col-md-6">
                <label class="form-label">Product (AMC) <span class="text-danger">*</span></label>
                <select name="amc_product_id" id="add_prod_amc_product_id" class="form-control select2" required>
                  <option value="">Select Product</option>
                  {{-- Populated via AJAX in List View --}}
                </select>
              </div>

              <div class="col-md-6">
                <label class="form-label-premium">Product Type</label>
                <select name="product_type" id="product_type" class="form-control">
                  <option value="AMC">AMC</option>
                  <option value="Non-AMC">Non AMC</option>
                </select>
              </div>

              <div class="col-md-6">
                <label class="form-label-premium">Product Category</label>
                <select name="product_category" id="product_category" class="form-control">
                  <option value="Comprehensive">Comprehensive</option>
                  <option value="Non-Comprehensive">Non-Comprehensive</option>
                </select>
              </div>

              <div class="col-md-6">
                <label class="form-label-premium">Department</label>
                <input type="text" class="form-control form-control-premium" name="department">
              </div>

              <div class="col-md-6">
                <label class="form-label">Qty</label>
                <input type="number" name="quantity" class="form-control form-control-premium" value="1">
              </div>

              <div class="col-md-6">
                <label class="form-label-premium">Product UIN</label>
                <input type="text" class="form-control form-control-premium" name="product_uin"
                  placeholder="Auto-generated if empty">
              </div>

              <div class="col-md-6">
                <label class="form-label-premium">User Name</label>
                <input type="text" class="form-control form-control-premium" name="user_name">
              </div>

              <div class="col-md-12">
                <label class="form-label-premium">Description</label>
                <textarea class="form-control form-control-premium" name="description"></textarea>
              </div>

              <div class="col-md-6">
                <label class="form-label-premium">AMC Start Date</label>
                <input type="date" class="form-control form-control-premium" name="amc_start_date">
              </div>

              <div class="col-md-6">
                <label class="form-label-premium">AMC End Date</label>
                <input type="date" class="form-control form-control-premium" name="amc_end_date">
              </div>

              <!-- SERVICE 1 -->
              <div class="col-md-6">
                <label class="form-label-premium">Service Date 1</label>
                <input type="date" class="form-control form-control-premium" name="service_date_1">
              </div>
              <div class="col-md-6">
                <label class="form-label-premium">Service Engineer 1</label>
                <select name="service_engineer_1" id="add_prod_eng_1" class="form-control form-control-premium select2">
                  <option value="">Select Engineer</option>
                  {{-- Populated via AJAX --}}
                </select>
              </div>

              <!-- SERVICE 2 -->
              <div class="col-md-6">
                <label class="form-label-premium">Service Date 2</label>
                <input type="date" class="form-control form-control-premium" name="service_date_2" disabled>
              </div>
              <div class="col-md-6">
                <label class="form-label-premium">Service Engineer 2</label>
                <select name="service_engineer_2" id="add_prod_eng_2" class="form-control form-control-premium select2"
                  disabled>
                  <option value="">Select Engineer</option>
                </select>
              </div>

              <!-- SERVICE 3 -->
              <div class="col-md-6">
                <label class="form-label-premium">Service Date 3</label>
                <input type="date" class="form-control form-control-premium" name="service_date_3" disabled>
              </div>
              <div class="col-md-6">
                <label class="form-label-premium">Service Engineer 3</label>
                <select name="service_engineer_3" id="add_prod_eng_3" class="form-control form-control-premium select2"
                  disabled>
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

        // Populate Header
        $('#v_header_name').text($(this).data('company_name') || 'N/A');
        $('#v_header_mobile').text($(this).data('mobile_no') || 'N/A');
        $('#v_header_email').text($(this).data('email') || 'N/A');
        $('#v_header_code').text('Code: ' + ($(this).data('customer_code') || 'N/A'));

        // Basic Info
        $('#v_customer_name').text($(this).data('company_name') || 'N/A');
        $('#v_customer_degination').text($(this).data('customer_type') || 'N/A'); // Using Type as designation placeholder
        $('#v_mobile_no').text($(this).data('mobile_no') || 'N/A');
        $('#v_contact_person').text($(this).data('contact_person') || 'N/A');
        $('#v_email').text($(this).data('email') || 'N/A');
        $('#v_date_of_birth').text($(this).data('date_of_birth') || 'N/A');

        let address =
          ($(this).data('address_line_1') ?? '') + ' ' +
          ($(this).data('address_line_2') ?? '');

        $('#v_address').text(address || 'N/A');
        $('#v_pincode').text($(this).data('pincode') || 'N/A');
        $('#v_area_id').text($(this).data('area_id') || 'N/A');
        $('#v_city_id').text($(this).data('city_id') || 'N/A');
        $('#v_state_id').text($(this).data('state_id') || 'N/A');

        $('#v_gst').text($(this).data('gst') || 'N/A');
        $('#v_cst').text($(this).data('cst') || 'N/A');
        $('#v_vat').text($(this).data('vat') || 'N/A');
        $('#v_pan').text($(this).data('pan') || 'N/A');

        $('#v_phone_1').text($(this).data('phone_1') || 'N/A');
        $('#v_phone_2').text($(this).data('phone_2') || 'N/A');
        $('#v_web_sites').text($(this).data('website') || 'N/A');

        // Reset to first tab
        $('#viewCustomerTab a:first').tab('show');

        var custId = $(this).data('id');
        var custUuid = $(this).data('uuid');

        // Store IDs on the modal for "Add" actions
        $('#viewCustomerModal').data('id', custId);
        $('#viewCustomerModal').data('uuid', custUuid);

        console.log('Viewing Customer ID:', custId);

        // Load Tabs Data
        loadViewBranches(custId);
        loadViewContacts(custId);
        loadViewProducts(custId);

        $('#viewCustomerModal').modal('show');
      });

      // --- Helper Functions for View Modal ---
      function loadViewBranches(customerId) {
        $('#viewBranchTable tbody').html('<tr><td colspan="6" class="text-center">Loading...</td></tr>');
        $.ajax({
          url: "{{ route('admin.customer.get.customer.branch') }}",
          type: "POST",
          data: { customer_id: customerId, _token: "{{ csrf_token() }}" },
          success: function (res) {
            var html = '';
            // Handle both {status:true, data:[]} and raw []
            var list = (res.status !== undefined) ? res.data : res;

            if (Array.isArray(list) && list.length > 0) {
              $.each(list, function (k, v) {
                html += '<tr>' +
                  '<td>' + (k + 1) + '</td>' +
                  '<td>' + (v.branch_name || '-') + '</td>' +
                  '<td>' + (v.contact_person ?? '-') + '</td>' +
                  '<td>' + (v.mobile_no ?? '-') + '</td>' +
                  '<td>' + (v.city_name ?? '-') + '</td>' +
                  '<td class="text-center">' +
                    '<div class="d-flex align-items-center gap-2 justify-content-center">' +
                      '<button type="button" class="btn btn-sm-custom btn-outline-primary editBranchBtn" data-data=\'' + JSON.stringify(v) + '\'><i class="icon-pencil"></i></button>' +
                      '<button type="button" class="btn btn-sm-custom btn-outline-danger deleteBranchBtn" data-id="' + v.id + '"><i class="icon-trash"></i></button>' +
                    '</div>' +
                  '</td>' +
                  '</tr>';
              });
            } else {
              html = '<tr><td colspan="6" class="text-center">No Branches Found</td></tr>';
            }
            $('#viewBranchTable tbody').html(html);
          },
          error: function (err) {
            console.error('Branch Load Error', err);
            $('#viewBranchTable tbody').html('<tr><td colspan="6" class="text-center text-danger">Error loading branches</td></tr>');
          }
        });
      }

      function loadViewContacts(customerId) {
        $('#viewContactTable tbody').html('<tr><td colspan="6" class="text-center">Loading...</td></tr>');
        $.ajax({
          url: "{{ route('admin.customer.get.customer.contact') }}",
          type: "POST",
          data: { customer_id: customerId, _token: "{{ csrf_token() }}" },
          success: function (res) {
            var html = '';
            var list = (res.status !== undefined) ? res.data : res;

            if (Array.isArray(list) && list.length > 0) {
              $.each(list, function (k, v) {
                html += '<tr>' +
                  '<td>' + (k + 1) + '</td>' +
                  '<td>' + (v.contact_name || '-') + '</td>' +
                  '<td>' + (v.branch_name ?? 'Main Branch') + '</td>' +
                  '<td>' + (v.designation ?? '-') + '</td>' +
                  '<td>' + (v.mobile_no ?? '-') + '</td>' +
                  '<td class="text-center">' +
                    '<div class="d-flex align-items-center gap-2 justify-content-center">' +
                      '<button type="button" class="btn btn-sm-custom btn-outline-primary editContactBtn" data-data=\'' + JSON.stringify(v) + '\'><i class="icon-pencil"></i></button>' +
                      '<button type="button" class="btn btn-sm-custom btn-outline-danger deleteContactBtn" data-id="' + v.id + '"><i class="icon-trash"></i></button>' +
                    '</div>' +
                  '</td>' +
                  '</tr>';
              });
            } else {
              html = '<tr><td colspan="6" class="text-center">No Contacts Found</td></tr>';
            }
            $('#viewContactTable tbody').html(html);
          },
          error: function (err) {
            console.error('Contact Load Error', err);
            $('#viewContactTable tbody').html('<tr><td colspan="6" class="text-center text-danger">Error loading contacts</td></tr>');
          }
        });
      }

      function loadViewProducts(customerId) {
        $('#viewProductTable tbody').html('<tr><td colspan="8" class="text-center">Loading...</td></tr>');
        $.ajax({
          url: "{{ route('admin.customer.get.products') }}",
          type: 'POST',
          data: { customer_id: customerId, _token: "{{ csrf_token() }}" },
          success: function (res) {
            var html = '';
            var list = (res.status !== undefined && res.data) ? res.data : (Array.isArray(res) ? res : []);

            if (list.length > 0) {
              $.each(list, function (k, v) {
                html += '<tr>' +
                  '<td>' + (k + 1) + '</td>' +
                  '<td>' + (v.product_name ?? '-') + '</td>' +
                  '<td>' + (v.description ?? '-') + '</td>' +
                  '<td>' + (v.branch_id ?? '-') + '</td>' +
                  '<td>' + (v.product_type ?? '-') + '</td>' +
                  '<td>' + (v.amc_start_date ?? '-') + '</td>' +
                  '<td>' + (v.amc_end_date ?? '-') + '</td>' +
                  '<td class="text-center">' +
                  '<div class="d-flex align-items-center gap-2 justify-content-center">' +
                  '<button type="button" class="btn btn-sm-custom btn-outline-primary editProductBtn" data-data=\'' + JSON.stringify(v) + '\'><i class="icon-pencil"></i></button>' +
                  '<button type="button" class="btn btn-sm-custom btn-outline-danger deleteProductBtn" data-uuid="' + v.uuid + '"><i class="icon-trash"></i></button>' +
                  '</div>' +
                  '</td>' +
                  '</tr>';
              });
            } else {
              html = '<tr><td colspan="8" class="text-center">No Products Found</td></tr>';
            }
            $('#viewProductTable tbody').html(html);
          },
          error: function (err) {
            console.error('Product Load Error', err);
            $('#viewProductTable tbody').html('<tr><td colspan="8" class="text-center text-danger">Error loading products</td></tr>');
          }
        });
      }

      // --- Handlers for "Add" Buttons inside View Modal ---

      // Add Branch from View
      $('#btnAddBranchFromView').click(function () {
        var custId = $('#viewCustomerModal').data('id');
        var custUuid = $('#viewCustomerModal').data('uuid');
        var custName = $('#v_header_name').text(); // visual only

        $('#branchCustomerName').text(custName); // reused ID from other modal logic? No, this is for branchModal title
        $('#addbranchCustomerName').text(custName);

        $('#branch_customer_id').val(custId);
        $('#branch_customer_uuid').val(custUuid);

        // Reset form
        $('#addBranchForm')[0].reset();
        $('#addBranchModal .select2').val('').trigger('change');

        // We don't hide the View Modal, but since modals stack poorly, we might need to hide it or handle z-index.
        // Bootstrap 5 supports multiple modals but backdrop might be tricky.
        // Let's hide View modal momentarily or keep it? 
        // User "display make hignlight", implied seamless. 
        // Let's try opening on top. If backdrop issues, we can hide view.
        // Safest UX: Hide View, Open Add. On Close Add, Re-open View (Manual logic needed).
        // For now, let's just open.
        $('#addBranchModal').modal('show');
      });

      // Add Contact from View
      $('#btnAddContactFromView').click(function () {
        var custId = $('#viewCustomerModal').data('id');
        var custUuid = $('#viewCustomerModal').data('uuid');
        var custName = $('#v_header_name').text();

        $('#addcontactCustomerName').text(custName);

        // Use the IDs expected by Add Contact Form
        $('#contact_customer_id').val(custId);
        $('#contact_customer_uuid').val(custUuid);

        $('#addBranchForm')[0].reset(); // Note: ID conflict in your code (addContactModal has form id="addBranchForm")
        // If you fixed the HTML ID, update this selector. For now, assuming provided code state:
        // We must be careful.
        // Let's assume the ID is unique or finding by context.
        $('#addContactModal form').trigger('reset'); // Safer
        $('#addContactModal .select2').val('').trigger('change');

        // Fetch Branches for this customer to populate dropdown
        $.ajax({
          url: "{{ route('admin.customer.get.customer.branch') }}",
          type: "POST",
          data: { customer_id: custId, _token: "{{ csrf_token() }}" },
          success: function (res) {
            var opts = '<option value="">Select Branch</option>';
            var list = (res.status !== undefined && res.data) ? res.data : (Array.isArray(res) ? res : []);

            if (list.length > 0) {
              $.each(list, function (k, v) {
                opts += '<option value="' + v.id + '">' + v.branch_name + '</option>';
              });
            }
            $('#add_contact_branch_id').html(opts);
            $('#add_contact_branch_id').trigger('change');
          }
        });

        $('#addContactModal').modal('show');
      });

      // Add Product from View
      $('#btnAddProductFromView').click(function () {
        var custId = $('#viewCustomerModal').data('id');

        // Use the global vars used by Product logic if needed, or directly set inputs
        // The existing product logic uses `prodCustomerId` var. Let's update it to be safe.
        // Accessing the closure var might be hard if not in scope.
        // But looking at code, `prodCustomerId` is defined inside `$(document).ready`.
        // We are in the same ready block. So we can update it!

        // Wait, are we? Yes, `$(document).ready` wraps everything.
        // BUT `prodCustomerId` was defined in a SEPARATE `<script>` block in line 1646?
        // No, line 1212 is one ready block. Line 1647 is ANOTHER ready block.
        // Scopes are different. We cannot access `prodCustomerId` directly.

        // We must manually populate the hidden fields for addProductForm.

        $('#add_product_customer_id').val(custId);

        // Also need to populate dropdowns
        $.ajax({
          url: "{{ route('admin.customer.get.product.form.data') }}",
          type: 'GET',
          dataType: 'json',
          success: function (res) {
            if (res.status) {
              var amcOpts = '<option value="">Select Product</option>';
              $.each(res.amc_products, function (k, v) {
                amcOpts += '<option value="' + v.id + '">' + v.amc_product + '</option>';
              });
              $('#add_prod_amc_product_id').html(amcOpts).trigger('change');

              var engOpts = '<option value="">Select Engineer</option>';
              $.each(res.engineers, function (k, v) {
                engOpts += '<option value="' + v.id + '">' + v.name + '</option>';
              });
              $('#add_prod_eng_1').html(engOpts).trigger('change');
              $('#add_prod_eng_2').html(engOpts).trigger('change');
            }
          }
        });

        // Fetch branches
        $.ajax({
          url: "{{ route('admin.customer.get.customer.branch') }}",
          type: "POST",
          data: { customer_id: custId, _token: "{{ csrf_token() }}" },
          success: function (res) {
            var options = '<option value="">Select Branch</option>';
            var list = (res.status !== undefined && res.data) ? res.data : (Array.isArray(res) ? res : []);

            if (list.length > 0) {
              $.each(list, function (key, val) {
                options += '<option value="' + val.id + '">' + val.branch_name + '</option>';
              });
            }
            $('#add_prod_branch_id').html(options).trigger('change');
          }
        });

        $('#addProductModal').modal('show');
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

      // viewBranchBtn handler removed



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

      // viewContactBtn handler removed


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

      // Delete Branch Handler
      $(document).on('click', '.deleteBranchBtn', function() {
        if(confirm('Are you sure you want to delete this branch?')) {
            var id = $(this).data('id');
            $.ajax({
                url: "{{ route('admin.customer.delete.branch') }}",
                type: "POST",
                data: { id: id, _token: "{{ csrf_token() }}" },
                success: function(res) {
                    if(res.status) {
                        var custId = $('#viewCustomerModal').data('id');
                        loadViewBranches(custId);
                    } else {
                        alert(res.message);
                    }
                },
                error: function(err) {
                    console.error('Delete Branch Error', err);
                    alert('An error occurred while deleting the branch.');
                }
            });
        }
      });

      // Delete Contact Handler
      $(document).on('click', '.deleteContactBtn', function() {
        if(confirm('Are you sure you want to delete this contact?')) {
            var id = $(this).data('id');
            $.ajax({
                url: "{{ route('admin.customer.delete.contact') }}",
                type: "POST",
                data: { id: id, _token: "{{ csrf_token() }}" },
                success: function(res) {
                    if(res.status) {
                        var custId = $('#viewCustomerModal').data('id');
                        loadViewContacts(custId);
                    } else {
                        alert(res.message);
                    }
                },
                error: function(err) {
                    console.error('Delete Contact Error', err);
                    alert('An error occurred while deleting the contact.');
                }
            });
        }
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
      // viewProductBtn handler removed


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

              // Refresh View Product Table if View Modal is open
              if ($('#viewCustomerModal').hasClass('show')) {
                var custId = $('#viewCustomerModal').data('id');
                loadViewProducts(custId);
              } else {
                $('#productModal').modal('show');
                loadProducts(prodCustomerId);
              }
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
                if ($('#viewCustomerModal').hasClass('show')) {
                  var custId = $('#viewCustomerModal').data('id');
                  loadViewProducts(custId);
                } else {
                  loadProducts(prodCustomerId);
                }
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

      // --- Location AJAX for Branch Modal ---
      $('#branch_area_id').on('change', function () {
        var areaID = $(this).val();
        if (areaID) {
          fetchCityState(areaID, '#branch_city_id', '#branch_state_id');
        }
      });

      function fetchCityState(areaID, citySelector, stateSelector) {
        $.ajax({
          url: "{{ route('admin.customer.area.city') }}",
          type: "POST",
          data: { areaID: areaID, _token: "{{ csrf_token() }}" },
          dataType: "json",
          success: function (res) {
            if (res.status) {
              $(citySelector).empty().append('<option value="' + res.city.id + '">' + res.city.name + '</option>');
              $(stateSelector).empty().append('<option value="' + res.state.id + '">' + res.state.name + '</option>');
            }
          }
        });
      }

      // --- Service Date Logic (From Add Customer) ---
      // Auto-calculate Service Dates
      $('input[name="amc_start_date"]').on('change', function () {
        var startDate = $(this).val();
        if (!startDate) return;

        var date = new Date(startDate);

        // Service Date 1: +4 months
        date.setMonth(date.getMonth() + 4);
        var sd1 = date.toISOString().split('T')[0];
        $('input[name="service_date_1"]').val(sd1).trigger('change');

        // Service Date 2: +4 months from SD1 (total +8)
        date.setMonth(date.getMonth() + 4);
        var sd2 = date.toISOString().split('T')[0];
        $('input[name="service_date_2"]').val(sd2).trigger('change');

        // Service Date 3: +4 months from SD2 (total +12)
        date.setMonth(date.getMonth() + 4);
        var sd3 = date.toISOString().split('T')[0];
        $('input[name="service_date_3"]').val(sd3).trigger('change');
      });

      // Sequential Enabling Logic
      $('input[name="service_date_1"]').on('change keyup', function () {
        let val = $(this).val();
        let inputs2 = $('input[name="service_date_2"], select[name="service_engineer_2"]');
        if (val) {
          inputs2.prop('disabled', false);
        } else {
          inputs2.prop('disabled', true).val('');
        }
        // Trigger change on dependent
        $('input[name="service_date_2"]').trigger('change');
      });

      $('input[name="service_date_2"]').on('change keyup', function () {
        let val = $(this).val();
        let inputs3 = $('input[name="service_date_3"], select[name="service_engineer_3"]');
        if (val) {
          inputs3.prop('disabled', false);
        } else {
          inputs3.prop('disabled', true).val('');
        }
      });

    });
  </script>

@endpush