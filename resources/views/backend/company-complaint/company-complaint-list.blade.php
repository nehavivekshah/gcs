@extends('backend.common.master')
@section('main-section')
<div class="container-fluid">
  <div class="page-title">
    <div class="row">
      <div class="col-6">
        <h4>Company Complaint List</h4>
      </div>
      <div class="col-6">
        <ol class="breadcrumb justify-content-end">
          <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
          <li class="breadcrumb-item active">Company Complaint List</li>

          <button type="button" class="btn btn-primary-custom ms-3" data-bs-toggle="modal"
            data-bs-target="#addCustomerComplaintModal">
            <i class="fa fa-plus me-1"></i> Add Complaint
          </button>

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
                  <th>Complaint No</th>
                  <th>Company</th>
                  <th>Product</th>
                  <th>Category Type</th>
                  <th>Complaint Mode</th>
                  <th>Created By</th>
                  <th>Modified By</th>
                  <th width="120" class="text-center">Action</th>
                </tr>
              </thead>
              <tbody>

                @php $i=0; @endphp
                @foreach($customerComplaintList as $customerComplaint)
                @php $i++; @endphp

                <tr>
                  <td>{{ $i }}</td>
                  <td class="fw-medium">{{ $customerComplaint->complaint_no }}</td>
                  <td>{{ $customerComplaint->company }}</td>
                  <td>{{ $customerComplaint->product_name }}</td>
                  <td>{{ $customerComplaint->category_type }}</td>
                  <td>{{ $customerComplaint->complaint_mode }}</td>
                  <td>{{ $customerComplaint->created_by }}</td>
                  <td>{{ $customerComplaint->modified_by }}</td>

                  <td class="text-center">
                    <ul class="action">

                      <!-- VIEW -->
                      <li class="view">
                        <a href="javascript:void(0);"
                          class="viewComplaint btn btn-sm-custom btn-outline-dark me-2"
                          data-id="{{ $customerComplaint->id }}"
                          data-complaint-uuid="{{ $customerComplaint->uuid }}"
                          data-complaint-no="{{ $customerComplaint->complaint_no }}"
                          data-complaint-customer-id="{{ $customerComplaint->customer_id }}"
                          data-category-type="{{ $customerComplaint->category_type }}"
                          data-company-name="{{ $customerComplaint->company }}"
                          data-product-name="{{ $customerComplaint->product_name }}"
                          data-complaint-mode="{{ $customerComplaint->complaint_mode }}"
                          data-branch-name="{{ $customerComplaint->branch }}"
                          data-product-uin="{{ $customerComplaint->product_uin }}"
                          data-description="{{ $customerComplaint->description }}"
                          data-user-name="{{ $customerComplaint->user_name }}"
                          data-expected-time="{{ $customerComplaint->expected_time }}"
                          data-department="{{ $customerComplaint->department }}"
                          data-engineer-name="{{ $customerComplaint->engineer }}"
                          data-call-type="{{ $customerComplaint->call_type }}"
                          data-call-logged-by="{{ $customerComplaint->call_logged_by }}"
                          data-call-status="{{ $customerComplaint->call_status }}"
                          data-confirm-by="{{ $customerComplaint->confirm_by }}">
                          <i class="icon-eye" style="color: inherit;"></i>
                        </a>
                      </li>

                      <!-- EDIT -->
                      <li class="edit">
                        <a href="javascript:void(0);"
                          class="editComplaint btn btn-sm-custom btn-outline-dark me-2"
                          data-id="{{ $customerComplaint->id }}"
                          data-uuid="{{ $customerComplaint->uuid }}"
                          data-customer-id="{{ $customerComplaint->customer_id }}"
                          data-company-id="{{ $customerComplaint->company_id }}"
                          data-branch-id="{{ $customerComplaint->branch_id }}"
                          data-department-id="{{ $customerComplaint->department_id }}"
                          data-product-id="{{ $customerComplaint->product_id }}"
                          data-category-type="{{ $customerComplaint->category_type }}"
                          data-complaint-mode="{{ $customerComplaint->complaint_mode }}"
                          data-branch-name="{{ $customerComplaint->branch_name }}"
                          data-product-uin="{{ $customerComplaint->product_uin }}"
                          data-description="{{ $customerComplaint->description }}"
                          data-user-name="{{ $customerComplaint->user_name }}"
                          data-expected-time="{{ $customerComplaint->expected_time }}"
                          data-department="{{ $customerComplaint->department }}"
                          data-engineer-id="{{ $customerComplaint->engineer_id }}"
                          data-call-type="{{ $customerComplaint->call_type }}"
                          data-call-logged-by="{{ $customerComplaint->call_logged_by }}"
                          data-call-status="{{ $customerComplaint->call_status }}"
                          data-confirm-by="{{ $customerComplaint->confirm_by }}">
                          <i class="icon-pencil-alt" style="color: inherit;"></i>
                        </a>
                      </li>

                      <!-- DELETE -->
                      <li class="delete">
                        <a href="{{ route('admin.company.complaint.delete',['uuid'=>$customerComplaint->uuid]) }}"
                          class="btn btn-sm-custom btn-outline-dark"
                          onclick="return confirm('Are you sure you want to delete this record?');">
                          <i class="icon-trash" style="color: inherit;"></i>
                        </a>
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


<!-- View Customer Modal -->
<style>
  /* Custom Styles for View Modal */
  .view-profile-header {
    background: #fdfdfd;
    padding: 24px;
    border-radius: 8px;
    /* Slightly sharper corners for flat look */
    margin-bottom: 25px;
    border: 1px solid #e1e7ec;
    border-left: 5px solid var(--theme-default);
  }

  .view-item-wrapper {
    border-bottom: 1px solid #f1f4f8;
    padding-bottom: 8px;
    margin-bottom: 12px;
  }

  .view-item-wrapper:last-child {
    border-bottom: none;
    margin-bottom: 0;
  }

  .view-label {
    font-size: 0.7rem;
    text-transform: uppercase;
    letter-spacing: 1px;
    color: #889097;
    margin-bottom: 4px;
    display: block;
    font-weight: 700;
  }

  .view-value {
    font-size: 1rem;
    font-weight: 600;
    color: #1b2533;
    word-break: break-word;
    line-height: 1.5;
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
    /* Flat background */
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
  }

  /* Modern Line Tabs with clear highlight */
  .nav-tabs-premium {
    border-bottom: 2px solid #eef2f7;
    gap: 5px;
    /* Reduced gap to keep them close */
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
    /* Light gray for inactive */
    font-weight: 600;
    padding: 12px 20px;
    border-radius: 4px 4px 0 0;
    /* Slight top round */
    transition: all 0.2s;
    background: transparent;
    font-size: 0.95rem;
  }

  .nav-tabs-premium .nav-link.active {
    color: #d40306;
    /* Strong red for active text */
    background-color: rgba(212, 3, 6, 0.1);
    /* Very light red bg for active */
    border-bottom-color: #d40306;
    /* Match text */
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

<!-- VIEW CUSTOMER COMPLAINT MODAL -->
<div class="modal fade" id="viewCustomerComplaintModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered">
    <div class="modal-content modal-content-premium border-0 overflow-hidden">

      <!-- Header -->
      <div class="modal-header modal-header-premium bg-white border-bottom p-4">
        <div class="d-flex align-items-center">

          <div>
            <h4 class="modal-title modal-title-premium fw-bold mb-1">Complaint Details</h4>
            <!-- <p class="mb-0 text-muted fs-6">Complete complaint information</p> -->
          </div>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Body -->
      <div class="modal-body p-4 bg-white">

        <!-- Hidden Input to store complaint ID -->
        <input type="hidden" id="view_complaint_id">

        <!-- Profile Header -->
        <div class="view-profile-header bg-white shadow-sm mb-4">
          <div class="row align-items-center">
            <div class="col-md-6">
              <h4 class="mb-1 text-dark fw-bold" id="v_complaint_company"></h4>
              <p class="text-muted mb-0">
                <i class="icon-hash me-1"></i>
                Complaint No: <span id="v_complaint_no"></span>
              </p>
            </div>
            <div class="col-md-6 text-md-end mt-3 mt-md-0">
              <span class="badge bg-light-primary text-dark px-3 py-2 rounded-pill fs-6" id="v_call_status">
                Status
              </span>
            </div>
          </div>
        </div>

        <!-- Tabs -->
        <ul class="nav nav-tabs nav-tabs-premium" id="viewComplaintTab" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" data-bs-toggle="tab" href="#complaint-basic">
              <i class="icon-info-alt me-2"></i> Basic Info
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" href="#complaint-visiting">
              <i class="icon-calendar me-2"></i> Visiting
            </a>
          </li>

          <li class="nav-item"><a class="nav-link" id="product-tab" data-bs-toggle="tab" href="#product-info" role="tab"
              aria-selected="false"><i class="icon-package me-2"></i>Products</a></li>
        </ul>

        <!-- Tab Content -->
        <div class="tab-content">

          <!-- BASIC INFO TAB -->
          <div class="tab-pane fade show active" id="complaint-basic">
            <div class="row g-4">

              <!-- Basic Info -->
              <div class="col-lg-6">
                <div class="info-card">
                  <h6 class="view-section-title"><i class="icon-info-alt"></i> Basic Information</h6>

                  <div class="view-item-wrapper">
                    <small class="view-label">Product</small>
                    <div class="view-value" id="v_product_name">-</div>
                  </div>

                  <div class="view-item-wrapper">
                    <small class="view-label">Category Type</small>
                    <div class="view-value" id="v_category_type">-</div>
                  </div>

                  <div class="view-item-wrapper">
                    <small class="view-label">Company Name</small>
                    <div class="view-value" id="v_company_name">-</div>
                  </div>
                  <div class="view-item-wrapper">
                    <small class="view-label">Complaint Mode</small>
                    <div class="view-value" id="v_complaint_mode">-</div>
                  </div>
                </div>
              </div>

              <!-- Complaint Details -->
              <div class="col-lg-6">
                <div class="info-card">
                  <h6 class="view-section-title"><i class="icon-clipboard"></i> Complaint Details</h6>

                  <div class="view-item-wrapper">
                    <small class="view-label">Department</small>
                    <div class="view-value" id="v_department">-</div>
                  </div>
                  <div class="view-item-wrapper">
                    <small class="view-label">Branch Name</small>
                    <div class="view-value" id="v_branch_name">-</div>
                  </div>
                  <div class="view-item-wrapper">
                    <small class="view-label">Product UIN</small>
                    <div class="view-value font-code" id="v_product_uin">-</div>
                  </div>
                  <div class="view-item-wrapper">
                    <small class="view-label">Description</small>
                    <div class="view-value" id="v_description">-</div>
                  </div>
                </div>
              </div>

              <!-- Assignment Details -->
              <div class="col-lg-6">
                <div class="info-card">
                  <h6 class="view-section-title"><i class="icon-user"></i> Assignment Details</h6>
                  <div class="view-item-wrapper">
                    <small class="view-label">User Name</small>
                    <div class="view-value" id="v_user_name">-</div>
                  </div>
                  <div class="view-item-wrapper">
                    <small class="view-label">Expected Time</small>
                    <div class="view-value" id="v_expected_time">-</div>
                  </div>

                  <div class="view-item-wrapper">
                    <small class="view-label">Engineer</small>
                    <div class="view-value" id="v_engineer_name">-</div>
                  </div>
                </div>
              </div>

              <!-- Call Details -->
              <div class="col-lg-6">
                <div class="info-card">
                  <h6 class="view-section-title"><i class="icon-call-in"></i> Call Details</h6>
                  <div class="view-item-wrapper">
                    <small class="view-label">Call Type</small>
                    <div class="view-value" id="v_call_type">-</div>
                  </div>
                  <div class="view-item-wrapper">
                    <small class="view-label">Call Logged By</small>
                    <div class="view-value" id="v_call_logged_by">-</div>
                  </div>
                  <div class="view-item-wrapper">
                    <small class="view-label">Confirm By</small>
                    <div class="view-value" id="v_confirm_by">-</div>
                  </div>
                </div>
              </div>

            </div>
          </div>

          <!-- VISITING TAB -->
          <div class="tab-pane fade" id="complaint-visiting">

            <div class="d-flex justify-content-between align-items-center mb-3">
              <h6 class="view-section-title mb-0 border-0 pb-0">
                <i class="icon-list"></i> Visit History
              </h6>
              <button class="btn btn-sm btn-primary-custom" id="btnAddVisitFromView">
                <i class="fa fa-plus me-1"></i> Add Visit
              </button>
            </div>

            <div class="info-card p-0 overflow-hidden">
              <div class="table-responsive custom-scrollbar">
                <table class="table table-hover table-striped align-middle mb-0" id="viewvisitingTable">
                  <thead class="bg-light">
                    <tr>
                      <th class="ps-4">#</th>
                      <th>Complaint No</th>
                      <th>Call Status</th>
                      <th>Reason for Delay</th>
                      <th>Expected Time</th>
                      <th>Call Logged By</th>
                      <th>Engineer</th>
                      <th>Created By</th>
                      <th>Modified By</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody></tbody>
                </table>
              </div>
            </div>

          </div>

          <div class="tab-pane fade" id="product-info" role="tabpanel" aria-labelledby="product-tab">
            <div class="d-flex justify-content-between align-items-center mb-3">
              <h6 class="view-section-title mb-0 border-0 pb-0"><i class="icon-package"></i> Product List</h6>

            </div>
            <div class="info-card p-0 overflow-hidden">
              <div class="table-responsive custom-scrollbar">
                <table class="table table-hover table-striped align-middle mb-0" id="viewProductTable">
                  <thead class="bg-light">
                    <tr>
                      <th class="py-3 ps-4 text-secondary text-uppercase fs-7 fw-bold">#</th>
                      <th class="py-3 text-secondary text-uppercase fs-7 fw-bold">Product Name</th>
                      <th class="py-3 text-secondary text-uppercase fs-7 fw-bold">UNI</th>
                      <th class="py-3 text-secondary text-uppercase fs-7 fw-bold">Username</th>
                      <th class="py-3 text-secondary text-uppercase fs-7 fw-bold">Department</th>
                      <th class="py-3 text-secondary text-uppercase fs-7 fw-bold">Description</th>
                      <th class="py-3 text-secondary text-uppercase fs-7 fw-bold">AMC Start</th>
                      <th class="py-3 text-secondary text-uppercase fs-7 fw-bold">AMC End</th>

                    </tr>
                  </thead>
                  <tbody></tbody>
                </table>
              </div>
            </div>
          </div>

        </div> <!-- END TAB CONTENT -->

      </div>
    </div>
  </div>
</div>



<div class="modal fade" id="addCustomerComplaintModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered">
    <div class="modal-content modal-content-premium">

      <!-- Header -->
      <div class="modal-header modal-header-premium">
        <h5 class="modal-title modal-title-premium">Add Customer Complaint</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>

      <form action="{{ route('admin.company.complaint.store') }}" method="POST">
        @csrf

        <!-- Body -->
        <div class="modal-body p-4">
          <div class="row g-3">

            <div class="col-md-6">
              <label class="form-label">Company</label>
              <select name="company_id" id="company_id"
                class="form-control form-control-premium select2">
                <option value="">Select Company</option>
                @foreach($customerList as $customer)
                <option value="{{ $customer->id }}">{{ $customer->company_name }}</option>
                @endforeach
              </select>
            </div>

            <div class="col-md-6">
              <label class="form-label">Branch</label>
              <select name="branch_id" id="branch_id"
                class="form-control form-control-premium select2">
                <option value="">Select Branch</option>
              </select>
            </div>

            <div class="col-md-6">
              <label class="form-label">Department</label>
              <select name="department_id" id="department_id"
                class="form-control form-control-premium select2">
                <option value="">Select Department</option>
              </select>
            </div>

            <div class="col-md-6">
              <label class="form-label">Product</label>
              <select name="product_id" id="product_id"
                class="form-control form-control-premium select2">
                <option value="">Select Product</option>
              </select>
            </div>

            <input type="text" name="company_selected_name" id="company_selected_name" class="form-control">
            <input type="text" name="product_selected_name" id="product_selected_name" class="form-control">

            <div class="col-md-6">
              <label class="form-label-premium">Category Type</label>
              <select name="category_type" id="category_type"
                class="form-control form-control-premium">
                <option value="">Select Category Type</option>
                <option value="Comprehensive">Comprehensive</option>
                <option value="Non-Comprehensive">Non-Comprehensive</option>
              </select>
            </div>

            <div class="col-md-6">
              <label class="form-label-premium">Complaint Mode</label>
              <select name="complaint_mode" id="complaint_mode"
                class="form-control form-control-premium">
                <option value="">Select Complaint Mode</option>
                <option value="Software">Software</option>
                <option value="Hardware">Hardware</option>
              </select>
            </div>

            <!-- <div class="col-md-6">
              <label class="form-label-premium">Branch Name</label>
              <input type="text" name="branch_name" id="branch_name"
                class="form-control form-control-premium">
            </div> -->

            <div class="col-md-12">
              <label class="form-label-premium">Description</label>
              <textarea name="description" id="description" rows="3"
                class="form-control form-control-premium"></textarea>
            </div>

            <div class="col-md-6">
              <label class="form-label-premium">User Name</label>
              <input type="text" name="user_name" id="user_name"
                class="form-control form-control-premium">
            </div>

            <div class="col-md-6">
              <label class="form-label-premium">Expected Time</label>
              <select name="expected_time" id="expected_time"
                class="form-control form-control-premium">
                <option value="">Select Expected Time</option>
                <option value="24 Hours">24 Hours</option>
                <option value="48 Hours">48 Hours</option>
                <option value="7 Days">7 Days</option>
              </select>
            </div>

            <div class="col-md-6">
              <label class="form-label-premium">Engineer</label>
              <select name="engineer_id" id="engineer_id"
                class="form-control form-control-premium">
                <option value="">Select Engineer</option>
                @foreach($engineerList as $engineer)
                <option value="{{ $engineer->id }}">{{ $engineer->name }}</option>
                @endforeach
              </select>
            </div>

            <div class="col-md-6">
              <label class="form-label-premium">Call Type</label>
              <select name="call_type" id="call_type"
                class="form-control form-control-premium">
                <option value="">Select Call Type</option>
                <option value="AMC">AMC</option>
                <option value="Call Basis">Call Basis</option>
              </select>
            </div>

            <div class="col-md-6">
              <label class="form-label-premium">Call Logged By</label>
              <input type="text" name="call_logged_by" id="call_logged_by"
                class="form-control form-control-premium">
            </div>

            <div class="col-md-6">
              <label class="form-label-premium">Call Status</label>
              <select name="call_status" id="call_status"
                class="form-control form-control-premium">
                <option value="">Select Call Status</option>
                <option value="Active">Active</option>
                <option value="Hardware Required">Hardware Required</option>
                <option value="Software Required">Software Required</option>
                <option value="Approval Pending">Approval Pending</option>
                <option value="Close">Close</option>
              </select>
            </div>

            <div class="col-md-6">
              <label class="form-label-premium">Confirm By</label>
              <input type="text" name="confirm_by" id="confirm_by"
                class="form-control form-control-premium">
            </div>

          </div>
        </div>

        <!-- Footer -->
        <div class="d-flex justify-content-end p-4 border-top">
          <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">
            Cancel
          </button>
          <button type="submit" class="btn btn-primary-custom">
            Save Complaint
          </button>
        </div>

      </form>
    </div>
  </div>
</div>


<div class="modal fade" id="editCustomerComplaintModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered">
    <div class="modal-content modal-content-premium">

      <!-- Header -->
      <div class="modal-header modal-header-premium">
        <h5 class="modal-title modal-title-premium">Edit Customer Complaint</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>

      <form action="{{ route('admin.company.complaint.update') }}" method="POST">
        @csrf
        @method('PATCH')

        <input type="hidden" name="id" id="edit_id">
        <input type="hidden" name="uuid" id="edit_uuid">

        <!-- Body -->
        <div class="modal-body p-4">
          <div class="row g-3">

            <div class="col-md-6">
              <label class="form-label">Company</label>
              <select name="company_id" id="edit_company_id"
                class="form-control form-control-premium select2">
                <option value="">Select Company</option>
                @foreach($customerList as $customer)
                <option value="{{ $customer->id }}">{{ $customer->company_name }}</option>
                @endforeach
              </select>
            </div>

            <div class="col-md-6">
              <label class="form-label">Branch</label>
              <select name="branch_id" id="edit_branch_id"
                class="form-control form-control-premium select2">
                <option value="">Select Branch</option>
              </select>
            </div>

            <div class="col-md-6">
              <label class="form-label">Department</label>
              <select name="department_id" id="edit_department_id"
                class="form-control form-control-premium select2">
                <option value="">Select Department</option>
              </select>
            </div>

            <div class="col-md-6">
              <label class="form-label">Product</label>
              <select name="product_id" id="edit_product_id"
                class="form-control form-control-premium select2">
                <option value="">Select Product</option>
              </select>
            </div>

            <input type="hidden" name="company_selected_name" id="edit_company_selected_name" class="form-control">
            <input type="hidden" name="product_selected_name" id="edit_product_selected_name" class="form-control">

            <div class="col-md-6">
              <label class="form-label-premium">Category Type</label>
              <select name="category_type" id="edit_category_type"
                class="form-control form-control-premium">
                <option value="Comprehensive">Comprehensive</option>
                <option value="Non-Comprehensive">Non-Comprehensive</option>
              </select>
            </div>

            <div class="col-md-6">
              <label class="form-label-premium">Complaint Mode</label>
              <select name="complaint_mode" id="edit_complaint_mode"
                class="form-control form-control-premium">
                <option value="Software">Software</option>
                <option value="Hardware">Hardware</option>
              </select>
            </div>

            <div class="col-md-12">
              <label class="form-label-premium">Description</label>
              <textarea name="description" id="edit_description" rows="3"
                class="form-control form-control-premium"></textarea>
            </div>

            <div class="col-md-6">
              <label class="form-label-premium">User Name</label>
              <input type="text" name="user_name" id="edit_user_name"
                class="form-control form-control-premium">
            </div>

            <div class="col-md-6">
              <label class="form-label-premium">Expected Time</label>
              <select name="expected_time" id="edit_expected_time"
                class="form-control form-control-premium">
                <option value="">Select Expected Time</option>
                <option value="24 Hours">24 Hours</option>
                <option value="48 Hours">48 Hours</option>
                <option value="7 Days">7 Days</option>
              </select>
            </div>

            <div class="col-md-6">
              <label class="form-label-premium">Engineer</label>
              <select name="engineer_id" id="edit_engineer_id"
                class="form-control form-control-premium">
                <option value="">Select Engineer</option>
                @foreach($engineerList as $engineer)
                <option value="{{ $engineer->id }}">{{ $engineer->name }}</option>
                @endforeach
              </select>
            </div>

            <div class="col-md-6">
              <label class="form-label-premium">Call Type</label>
              <select name="call_type" id="edit_call_type"
                class="form-control form-control-premium">
                <option value="">Select Call Type</option>
                <option value="AMC">AMC</option>
                <option value="Call Basis">Call Basis</option>
              </select>
            </div>

            <div class="col-md-6">
              <label class="form-label-premium">Call Logged By</label>
              <input type="text" name="call_logged_by" id="edit_call_logged_by"
                class="form-control form-control-premium">
            </div>

            <div class="col-md-6">
              <label class="form-label-premium">Call Status</label>
              <select name="call_status" id="edit_call_status"
                class="form-control form-control-premium">
                <option value="">Select Call Status</option>
                <option value="Active">Active</option>
                <option value="Hardware Required">Hardware Required</option>
                <option value="Software Required">Software Required</option>
                <option value="Approval Pending">Approval Pending</option>
                <option value="Close">Close</option>
              </select>
            </div>

            <div class="col-md-6">
              <label class="form-label-premium">Confirm By</label>
              <input type="text" name="confirm_by" id="edit_confirm_by"
                class="form-control form-control-premium">
            </div>

          </div>
        </div>

        <!-- Footer -->
        <div class="d-flex justify-content-end p-4 border-top">
          <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">
            Cancel
          </button>
          <button type="submit" class="btn btn-primary-custom">
            Update Complaint
          </button>
        </div>

      </form>
    </div>
  </div>
</div>



<div class="modal fade" id="addVisitModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content modal-content-premium">

      <!-- Header -->
      <div class="modal-header modal-header-premium">
        <h5 class="modal-title modal-title-premium">
          Add Visit <span id="addComplaintCustomerName"></span>
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>

      <form id="addVisitForm" method="POST"
        action="{{ route('admin.company.complaint.add.visit') }}">
        @csrf

        <input type="hidden" name="customer_complaint_uuid" id="customer_complaint_uuid">
        <input type="hidden" name="customer_complaint_id" id="customer_complaint_id">
        <input type="hidden" name="customer_id" id="visit_customer_id">
        <input type="hidden" name="visit_id" id="visit_id">

        <!-- Body -->
        <div class="modal-body p-4">
          <div class="row g-3">

            <div class="col-md-6">
              <label class="form-label-premium">Call Status</label>
              <select name="call_status" id="visit_call_status"
                class="form-control form-control-premium">
                <option value="">Select Call Status</option>
                <option value="Active">Active</option>
                <option value="Hardware Required">Hardware Required</option>
                <option value="Software Required">Software Required</option>
                <option value="Close">Close</option>
              </select>
            </div>

            <div class="col-md-6">
              <label class="form-label-premium">Expected Time</label>
              <select name="expected_time" id="visit_expected_time"
                class="form-control form-control-premium">
                <option value="">Select Expected Time</option>
                <option value="24 Hours">24 Hours</option>
                <option value="48 Hours">48 Hours</option>
                <option value="7 Days">7 Days</option>
              </select>
            </div>

            <div class="col-md-6">
              <label class="form-label-premium">Call Logged By</label>
              <input type="text" name="call_logged_by" id="visit_call_logged_by"
                class="form-control form-control-premium">
            </div>

            <div class="col-md-6">
              <label class="form-label-premium">Engineer</label>
              <select name="engineer_id" id="visit_engineer_id"
                class="form-control form-control-premium">
                <option value="">Select Engineer</option>
                @foreach($engineerList as $engineer)
                <option value="{{ $engineer->id }}">{{ $engineer->name }}</option>
                @endforeach
              </select>
            </div>

            <div class="col-md-12">
              <label class="form-label-premium">Reason for Delay</label>
              <textarea name="reason_for_delay" id="visit_reason_for_delay" rows="3"
                class="form-control form-control-premium"></textarea>
            </div>



          </div>
        </div>

        <!-- Footer -->
        <div class="d-flex justify-content-end p-4 border-top">
          <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">
            Cancel
          </button>
          <button type="submit" class="btn btn-primary-custom">
            Save Visit
          </button>
        </div>

      </form>
    </div>
  </div>
</div>


<div class="modal fade" id="productModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered">
    <div class="modal-content modal-content-premium border-0 overflow-hidden">

      <!-- Header -->
      <div class="modal-header modal-header-premium">
        <div>
          <h5 class="modal-title modal-title-premium mb-0">
            Product List
          </h5>

        </div>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>

      <!-- Body -->
      <div class="modal-body p-4 bg-white">

        <!-- Toolbar -->
        <div class="d-flex justify-content-between align-items-center mb-3">
          <h6 class="view-section-title mb-0 border-0 pb-0">
            <i class="icon-list"></i> Product List
          </h6>

        </div>

        <!-- Table -->
        <div class="info-card p-0 overflow-hidden">
          <div class="table-responsive custom-scrollbar">
            <table class="table table-hover table-striped align-middle mb-0" id="productTable">
              <thead class="bg-light">
                <tr>
                  <th class="ps-4">#</th>
                  <th>product_name</th>
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

<div class="modal fade" id="editVisitModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content modal-content-premium">

      <!-- Header -->
      <div class="modal-header modal-header-premium">
        <h5 class="modal-title modal-title-premium">
          Edit Visit <span id="editComplaintNo"></span>
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>

      <form id="editVisitForm" method="POST"
        action="{{ route('admin.company.complaint.update.visit') }}">
        @csrf

        <input type="hidden" name="visit_id" id="edit_visit_id">

        <!-- Body -->
        <div class="modal-body p-4">
          <div class="row g-3">

            <div class="col-md-6">
              <label>Call Status</label>
              <select name="call_status" id="edit_visit_call_status" class="form-control">
                <option value="">Select</option>
                <option value="Active">Active</option>
                <option value="Hardware Required">Hardware Required</option>
                <option value="Software Required">Software Required</option>
                <option value="Close">Close</option>
              </select>
            </div>

            <div class="col-md-6">
              <label>Expected Time</label>
              <select name="expected_time" id="edit_visit_expected_time" class="form-control">
                <option value="">Select</option>
                <option value="24 Hours">24 Hours</option>
                <option value="48 Hours">48 Hours</option>
                <option value="7 Days">7 Days</option>
              </select>
            </div>

            <div class="col-md-6">
              <label>Call Logged By</label>
              <input type="text" name="call_logged_by" id="edit_visit_call_logged_by" class="form-control">
            </div>

            <div class="col-md-6">
              <label>Engineer</label>
              <select name="engineer_id" id="edit_visit_engineer_id" class="form-control">
                <option value="">Select Engineer</option>
                @foreach($engineerList as $engineer)
                <option value="{{ $engineer->id }}">{{ $engineer->name }}</option>
                @endforeach
              </select>
            </div>

            <div class="col-md-12">
              <label>Reason for Delay</label>
              <textarea name="reason_for_delay" id="edit_visit_reason_for_delay"
                rows="3" class="form-control"></textarea>
            </div>

          </div>
        </div>

        <!-- Footer -->
        <div class="d-flex justify-content-end p-4 border-top">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
            Cancel
          </button>
          <button type="submit" class="btn btn-primary-custom">
            Update Visit
          </button>
        </div>

      </form>
    </div>
  </div>
</div>


@endsection


@push('scripts')

<link rel="stylesheet" href="{{ asset('public/assets/css/vendors/select2.css') }}">

<!-- Select2 JS -->
<script src="{{ asset('public/assets/js/select2/select2.full.min.js') }}"></script>

<script>
  $(document).on('click', '.viewComplaint', function() {

    $('#v_complaint_no').text($(this).data('complaint-no'));
    $('#v_category_type').text($(this).data('category-type'));
    $('#v_company_name').text($(this).data('company-name'));
    $('#v_product_name').text($(this).data('product-name'));
    $('#v_complaint_company').text($(this).data('company-name'));
    $('#v_complaint_mode').text($(this).data('complaint-mode'));
    $('#v_branch_name').text($(this).data('branch-name'));
    $('#v_product_uin').text($(this).data('product-uin'));
    $('#v_description').text($(this).data('description'));
    $('#v_user_name').text($(this).data('user-name'));
    $('#v_expected_time').text($(this).data('expected-time'));
    $('#v_department').text($(this).data('department'));
    $('#v_engineer_name').text($(this).data('engineer-name'));
    $('#v_call_type').text($(this).data('call-type'));
    $('#v_call_logged_by').text($(this).data('call-logged-by'));
    $('#v_call_status').text($(this).data('call-status'));
    $('#v_confirm_by').text($(this).data('confirm-by'));

    $('#viewComplaintTab a:first').tab('show');

    var complaint_id = $(this).data('id');
    var complaint_uuid = $(this).data('complaint-uuid');
    var complaint_customer_id = $(this).data('complaint-customer-id');

    $('#viewCustomerComplaintModal').data('id', complaint_id);
    $('#viewCustomerComplaintModal').data('uuid', complaint_uuid);
    $('#viewCustomerComplaintModal').data('customer-id', complaint_customer_id);

    loadViewVisit(complaint_id);
    loadViewProducts(complaint_customer_id);
    $('#viewCustomerComplaintModal').modal('show');


  });


  function loadViewVisit(complaint_id) {
    $('#viewvisitingTable tbody').html('<tr><td colspan="10" class="text-center">Loading...</td></tr>');
    $.ajax({
      url: "{{ route('admin.company.complaint.visit.details') }}",
      type: "POST",
      data: {
        complaint_id: complaint_id,
        _token: "{{ csrf_token() }}"
      },
      success: function(res) {
        var html = '';
        // Handle both {status:true, data:[]} and raw []
        var list = (res.status !== undefined) ? res.data : res;

        if (Array.isArray(list) && list.length > 0) {
          $.each(list, function(k, v) {
            var deleteUrl = "{{ route('admin.company.complaint.delete.visit', ':id') }}";
            deleteUrl = deleteUrl.replace(':id', v.id);
            html += '<tr>' +
              '<td>' + (k + 1) + '</td>' +
              '<td>' + (v.complaint_no || '-') + '</td>' +
              '<td>' + (v.call_status ?? '-') + '</td>' +
              '<td>' + (v.reason_for_delay ?? '-') + '</td>' +
              '<td>' + (v.expected_time ?? '-') + '</td>' +
              '<td>' + (v.call_logged_by ?? '-') + '</td>' +
              '<td>' + (v.engineer_name ?? '-') + '</td>' +
              '<td>' + (v.created_by ?? '-') + '</td>' +
              '<td>' + (v.modified_by ?? '-') + '</td>' +
              '<td class="text-center">' +
              '<a href="javascript:void(0)" class=" btn btn-sm-custom btn-outline-dark me-2 editVisitBtn" ' +
              'data-id="' + v.id + '" ' +
              'data-complaint_no="' + v.complaint_no + '" ' +
              'data-call_status="' + v.call_status + '" ' +
              'data-reason_for_delay="' + v.reason_for_delay + '" ' +
              'data-expected_time="' + v.expected_time + '" ' +
              'data-call_logged_by="' + v.call_logged_by + '" ' +
              'data-engineer_id="' + v.engineer_id + '">' +
              '<i class="fa fa-edit" style="color: inherit;"></i>' +
              '</a>' +

              '<a href="' + deleteUrl + '" class="btn btn-sm-custom btn-outline-dark me-2 deleteVisitBtn">' +
              '<i class="fa fa-trash" style="color: inherit;"></i>' +
              '</a>' +
              '</td>' +

              '</tr>';
          });

        } else {
          html = '<tr><td colspan="10" class="text-center">No Branches Found</td></tr>';
        }
        $('#viewvisitingTable tbody').html(html);
      },
      error: function(err) {
        console.error('Branch Load Error', err);
        $('#viewvisitingTable tbody').html('<tr><td colspan="5" class="text-center text-danger">Error loading branches</td></tr>');
      }
    });
  }


  function loadViewProducts(customerId) {
    $('#viewProductTable tbody').html('<tr><td colspan="9" class="text-center">Loading...</td></tr>');
    $.ajax({
      url: "{{ route('admin.company.complaint.get.products') }}",
      type: 'POST',
      data: {
        customer_id: customerId,
        _token: "{{ csrf_token() }}"
      },
      success: function(res) {
        var html = '';
        var list = (res.status !== undefined && res.data) ? res.data : (Array.isArray(res) ? res : []);

        if (list.length > 0) {
          $.each(list, function(k, v) {
            html += '<tr>' +
              '<td>' + (k + 1) + '</td>' +
              '<td>' + (v.amc_product ?? '-') + '</td>' +
              '<td>' + (v.product_uin ?? '-') + '</td>' +
              '<td>' + (v.user_name ?? '-') + '</td>' +
              '<td>' + (v.department ?? '-') + '</td>' +
              '<td>' + (v.description ?? '-') + '</td>' +
              '<td>' + (v.amc_start_date ?? '-') + '</td>' +
              '<td>' + (v.amc_end_date ?? '-') + '</td>' +
              '</tr>';
          });
        } else {
          html = '<tr><td colspan="9" class="text-center">No Products Found</td></tr>';
        }
        $('#viewProductTable tbody').html(html);
      },
      error: function(err) {
        console.error('Product Load Error', err);
        $('#viewProductTable tbody').html('<tr><td colspan="8" class="text-center text-danger">Error loading products</td></tr>');
      }
    });
  }



  $('#btnAddVisitFromView').click(function() {
    var complaint_id = $('#viewCustomerComplaintModal').data('id');
    var complaint_uuid = $('#viewCustomerComplaintModal').data('uuid');
    var complaint_customer_id = $('#viewCustomerComplaintModal').data('customer-id');

    $('#customer_complaint_uuid').val(complaint_uuid);
    $('#customer_complaint_id').val(complaint_id);
    $('#visit_customer_id').val(complaint_customer_id);

    $('#addVisitModal').modal('show');
  });


  $(document).on('click', '.editComplaint', function() {

    let companyID = $(this).data('company-id');
    let branchID = $(this).data('branch-id');
    let departmentID = $(this).data('department-id');
    let productID = $(this).data('product-id');

    // Set simple fields
    $('#edit_id').val($(this).data('id'));
    $('#edit_uuid').val($(this).data('uuid'));
    $('#edit_company_id').val(companyID).trigger('change');
    $('#edit_category_type').val($(this).data('category-type'));
    $('#edit_complaint_mode').val($(this).data('complaint-mode'));
    $('#edit_product_uin').val($(this).data('product-uin'));
    $('#edit_description').val($(this).data('description'));
    $('#edit_user_name').val($(this).data('user-name'));
    $('#edit_expected_time').val($(this).data('expected-time'));
    $('#edit_department').val($(this).data('department'));
    $('#edit_engineer_id').val($(this).data('engineer-id'));
    $('#edit_call_type').val($(this).data('call-type'));
    $('#edit_call_logged_by').val($(this).data('call-logged-by'));
    $('#edit_call_status').val($(this).data('call-status'));
    $('#edit_confirm_by').val($(this).data('confirm-by'));

    
    // 🔥 Load products and auto-select
    if (companyID) {
      $.ajax({
        url: "{{ route('admin.company.complaint.get.customer.branch') }}",
        type: "POST",
        data: {
          companyID: companyID,
          _token: "{{ csrf_token() }}"
        },
        dataType: "json",
        success: function(res) {
          $('#edit_branch_id').empty()
            .append('<option value="">Select Branch</option>');

          $.each(res, function(key, value) {
            $('#edit_branch_id').append(
              '<option value="' + value.id + '" ' + (value.id == branchID ? 'selected' : '') + '>' +
              value.branch_name +
              '</option>'
            );
          });

          // ✅ AUTO SELECT PRODUCT
          $('#edit_product_id').val(productID).trigger('change');
        }
      });
    }

    if (branchID) {
      $.ajax({
        url: "{{ route('admin.company.complaint.get.customer.department') }}",
        type: "POST",
        data: {
          branchID: branchID,
          _token: "{{ csrf_token() }}"
        },
        dataType: "json",
        success: function(res) {
          $('#edit_department_id').empty()
            .append('<option value="">Select Department</option>');

          $.each(res, function(key, value) {
            $('#edit_department_id').append(
              '<option value="' + value.id + '" ' + (value.id == departmentID ? 'selected' : '') + '>' + value.department + '</option>'
            );
          });


        },
        error: function() {
          alert('Unable to fetch departments');
        }
      });
    }

    if (departmentID) {
      $.ajax({
        url: "{{ route('admin.company.complaint.get.customer.department.product') }}",
        type: "POST",
        data: {
          departmentID: departmentID,
          _token: "{{ csrf_token() }}"
        },
        dataType: "json",
        success: function(res) {
          $('#edit_product_id').empty()
            .append('<option value="">Select Product</option>');

          $.each(res, function(key, value) {
            $('#edit_product_id').append(
              '<option value="' + value.id + '" ' + (value.id == productID ? 'selected' : '') + '>' + value.amc_product + '</option>'
            );
          });

          let productText = $('#edit_product_id option:selected').text();
        $("#edit_product_selected_name").val(productText);

        },
        error: function() {
          alert('Unable to fetch products');
        }
      });
    }

    let customerFull = $('#edit_company_id option:selected').text(); // Rahul Panchal
    let productText  = $('#edit_product_id option:selected').text();

   
    let customerFirstName = customerFull.split(' ')[0];

    $("#edit_company_selected_name").val(customerFirstName);

    $('#editCustomerComplaintModal').modal('show');
  });
</script>

<script>
  $(document).on('click', '#addVisitBtn', function() {
    // Reset form
    $('#visit_id').val(''); // Clear hidden visit_id

    // Set title & action
    $('#addVisitModal .modal-title').text('Add Visit Details');
    $('#addVisitForm').attr('action', "{{ route('admin.company.complaint.add.visit') }}");

    $('#addVisitModal').modal('show');
    $('#visitingModal').modal('hide');
  });


  // Open modal for editing visit
  $(document).on('click', '.editVisitBtn', function() {

    $('#edit_visit_id').val($(this).data('id'));
    $('#editComplaintNo').text($(this).data('complaint_no'));

    $('#edit_visit_call_status').val($(this).data('call_status'));
    $('#edit_visit_expected_time').val($(this).data('expected_time'));
    $('#edit_visit_call_logged_by').val($(this).data('call_logged_by'));
    $('#edit_visit_engineer_id').val($(this).data('engineer_id'));
    $('#edit_visit_reason_for_delay').val($(this).data('reason_for_delay'));

    $('#editVisitModal').modal('show');
  });
</script>

<script>
  $(document).ready(function() {

    $('#company_id').on('change', function() {
      var companyID = $(this).val();

      if (companyID) {
        $.ajax({
          url: "{{ route('admin.company.complaint.get.customer.branch') }}",
          type: "POST",
          data: {
            companyID: companyID,
            _token: "{{ csrf_token() }}"
          },
          dataType: "json",
          success: function(res) {
            $('#branch_id').empty()
              .append('<option value="">Select Branch</option>');

            $.each(res, function(key, value) {
              $('#branch_id').append(
                '<option value="' + value.id + '">' + value.branch_name + '</option>'
              );
            });

            // Refresh select2 after ajax
            $('#branch_id').trigger('change');
          },
          error: function() {
            alert('Unable to fetch branches');
          }
        });
      } else {
        $('#branch_id').empty()
          .append('<option value="">Select Branch</option>');
      }
    });


    $('#branch_id').on('change', function() {
      var branchID = $(this).val();

      if (branchID) {
        $.ajax({
          url: "{{ route('admin.company.complaint.get.customer.department') }}",
          type: "POST",
          data: {
            branchID: branchID,
            _token: "{{ csrf_token() }}"
          },
          dataType: "json",
          success: function(res) {
            $('#department_id').empty()
              .append('<option value="">Select Department</option>');

            $.each(res, function(key, value) {
              $('#department_id').append(
                '<option value="' + value.id + '">' + value.department + '</option>'
              );
            });


          },
          error: function() {
            alert('Unable to fetch departments');
          }
        });
      } else {
        $('#department_id').empty()
          .append('<option value="">Select Department</option>');
      }
    });


    $('#department_id').on('change', function() {
      var departmentID = $(this).val();

      if (departmentID) {
        $.ajax({
          url: "{{ route('admin.company.complaint.get.customer.department.product') }}",
          type: "POST",
          data: {
            departmentID: departmentID,
            _token: "{{ csrf_token() }}"
          },
          dataType: "json",
          success: function(res) {
            $('#product_id').empty()
              .append('<option value="">Select Product</option>');

            $.each(res, function(key, value) {
              $('#product_id').append(
                '<option value="' + value.id + '">' + value.amc_product + '</option>'
              );
            });


          },
          error: function() {
            alert('Unable to fetch products');
          }
        });
      } else {
        $('#product_id').empty()
          .append('<option value="">Select Product</option>');
      }
    });

  });
</script>

<script>
  $(document).ready(function() {

    $('#edit_company_id').on('change', function() {
      var companyID = $(this).val();

      if (companyID) {
        $.ajax({
          url: "{{ route('admin.company.complaint.get.customer.branch') }}",
          type: "POST",
          data: {
            companyID: companyID,
            _token: "{{ csrf_token() }}"
          },
          dataType: "json",
          success: function(res) {
            $('#edit_branch_id').empty()
              .append('<option value="">Select Branch</option>');

            $.each(res, function(key, value) {
              $('#edit_branch_id').append(
                '<option value="' + value.id + '">' + value.branch_name + '</option>'
              );
            });


          },
          error: function() {
            alert('Unable to fetch branches');
          }
        });
      } else {
        $('#edit_branch_id').empty()
          .append('<option value="">Select Branch</option>');
      }
    });

    $('#edit_branch_id').on('change', function() {
      var branchID = $(this).val();

      if (branchID) {
        $.ajax({
          url: "{{ route('admin.company.complaint.get.customer.department') }}",
          type: "POST",
          data: {
            branchID: branchID,
            _token: "{{ csrf_token() }}"
          },
          dataType: "json",
          success: function(res) {
            $('#edit_department_id').empty()
              .append('<option value="">Select Department</option>');

            $.each(res, function(key, value) {
              $('#edit_department_id').append(
                '<option value="' + value.id + '">' + value.department + '</option>'
              );
            });


          },
          error: function() {
            alert('Unable to fetch departments');
          }
        });
      } else {
        $('#edit_department_id').empty()
          .append('<option value="">Select Department</option>');
      }
    });

    $('#edit_department_id').on('change', function() {
      var departmentID = $(this).val();

      if (departmentID) {
        $.ajax({
          url: "{{ route('admin.company.complaint.get.customer.department.product') }}",
          type: "POST",
          data: {
            departmentID: departmentID,
            _token: "{{ csrf_token() }}"
          },
          dataType: "json",
          success: function(res) {
            $('#edit_product_id').empty()
              .append('<option value="">Select Product</option>');

            $.each(res, function(key, value) {
              $('#edit_product_id').append(
                '<option value="' + value.id + '">' + value.amc_product + '</option>'
              );
            });


          },
          error: function() {
            alert('Unable to fetch products');
          }
        });
      } else {
        $('#edit_product_id').empty()
          .append('<option value="">Select Product</option>');
      }
    });

  });
</script>

<script>
$('#product_id').on('change', function () {

    let customerFull = $('#company_id option:selected').text(); // Rahul Panchal
    let productText  = $('#product_id option:selected').text();

   
    let customerFirstName = customerFull.split(' ')[0];

    $("#company_selected_name").val(customerFirstName);
    $("#product_selected_name").val(productText);

});


$('#edit_product_id').on('change', function () {

    let customerFull = $('#edit_company_id option:selected').text(); // Rahul Panchal
    let productText  = $('#edit_product_id option:selected').text();

   
    let customerFirstName = customerFull.split(' ')[0];

    $("#edit_company_selected_name").val(customerFirstName);
    $("#edit_product_selected_name").val(productText);

});

</script>



@endpush