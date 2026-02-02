@extends('backend.common.master')
@section('main-section')

  <style>
    /* Wizard Stepper CSS */
    .wizard-steps {
      display: flex;
      justify-content: space-between;
      margin-bottom: 30px;
      position: relative;
    }

    .wizard-steps::before {
      content: "";
      position: absolute;
      top: 15px;
      left: 0;
      width: 100%;
      height: 2px;
      background: #e0e0e0;
      z-index: 1;
    }

    .step-item {
      position: relative;
      z-index: 2;
      background: #fff;
      text-align: center;
      width: 100px;
    }

    .step-circle {
      width: 30px;
      height: 30px;
      border-radius: 50%;
      background: #fff;
      border: 2px solid #e0e0e0;
      color: #999;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 auto 10px;
      font-weight: bold;
      transition: all 0.3s;
    }

    .step-item.active .step-circle {
      border-color: #bf0103;
      background: #bf0103;
      color: #fff;
    }

    .step-item.completed .step-circle {
      border-color: #bf0103;
      background: #bf0103;
      color: #fff;
    }

    .step-label {
      font-size: 14px;
      color: #999;
      font-weight: 500;
    }

    .step-item.active .step-label,
    .step-item.completed .step-label {
      color: #bf0103;
      font-weight: bold;
    }

    /* Content Transition */
    .step-content {
      display: none;
      animation: fadeIn 0.5s;
    }

    .step-content.active {
      display: block;
    }

    @keyframes fadeIn {
      from {
        opacity: 0;
        transform: translateY(10px);
      }

      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    /* Premium Styles */
    .btn-primary-custom {
      background-color: #bf0103;
      border-color: #bf0103;
      color: #fff;
    }

    .btn-primary-custom:hover {
      background-color: #a00103;
      border-color: #a00103;
    }

    .btn-outline-primary-custom {
      color: #bf0103;
      border-color: #bf0103;
      border-radius: 8px;
      padding: 10px 20px;
      font-weight: 600;
      font-size: 0.95rem;
      letter-spacing: 0.3px;
    }

    .btn-outline-primary-custom:hover {
      background-color: #bf0103;
      color: #fff;
    }

    .modal-header-premium {
      background-color: #bf0103;
      color: #fff;
      border-bottom: none;
    }

    .modal-header-premium .btn-close {
      filter: invert(1) grayscale(100%) brightness(200%);
    }
  </style>

  <div class="container-fluid">
    <div class="page-title">
      <div class="row">
        <div class="col-6">
          <h4>Add Customer Wizard</h4>
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

            <!-- Stepper -->
            <div class="wizard-steps px-5">
              <div class="step-item active" id="step-nav-1">
                <div class="step-circle">1</div>
                <div class="step-label">Basic Info</div>
              </div>
              <div class="step-item" id="step-nav-2">
                <div class="step-circle">2</div>
                <div class="step-label">Branches</div>
              </div>
              <div class="step-item" id="step-nav-3">
                <div class="step-circle">3</div>
                <div class="step-label">Contacts</div>
              </div>
              <div class="step-item" id="step-nav-4">
                <div class="step-circle">4</div>
                <div class="step-label">Products</div>
              </div>
            </div>

            <!-- Global Hidden Customer ID (Gets populated after Step 1) -->
            <input type="hidden" id="global_customer_id" value="">
            <input type="hidden" id="global_customer_uuid" value="">

            <!-- STEP 1: BASIC INFO -->
            <div id="step-content-1" class="step-content active">
              <form id="step1Form" class="row g-4 needs-validation" novalidate>
                @csrf
                <div class="col-12">
                  <h5 class="section-title"><i class="icon-user me-2"></i>Basic Customer Info</h5>
                </div>

                <!-- BASIC INFO -->
                <div class="col-md-3">
                  <label class="form-label-premium">Company Name <span class="text-danger">*</span></label>
                  <input type="text" class="form-control form-control-premium" name="company_name" required>
                </div>

                <div class="col-md-3">
                  <label class="form-label-premium">Customer Type</label>
                  <select class="form-control form-control-premium" name="customer_type">
                    <option value="">Select Type</option>
                    <option value="GCS">GCS</option>
                    <option value="NON GCS">NON GCS</option>
                  </select>
                </div>

                <!-- <div class="col-md-3">
                                  <label class="form-label-premium">Customer Category</label>
                                  <select class="form-control form-control-premium" name="customer_category">
                                    <option value="">Select Category</option>
                                    <option value="Corporate">Corporate</option>
                                    <option value="Semi-Corporate">Semi-Corporate</option>
                                    <option value="In-House">In-House</option>
                                  </select>
                                </div> -->

                <div class="col-md-3">
                  <label class="form-label-premium">Phone 1</label>
                  <input type="text" class="form-control form-control-premium" name="phone_1">
                </div>

                <div class="col-md-3">
                  <label class="form-label-premium">Phone 2</label>
                  <input type="text" class="form-control form-control-premium" name="phone_2">
                </div>

                <div class="col-md-3">
                  <label class="form-label-premium">Website</label>
                  <input type="text" class="form-control form-control-premium" name="website">
                </div>

                <div class="col-12 mt-4">
                  <h5 class="section-title"><i class="icon-mobile me-2"></i>Contact Details</h5>
                </div>

                <div class="col-md-3">
                  <label class="form-label-premium">Contact Person</label>
                  <input type="text" class="form-control form-control-premium" name="contact_person">
                </div>

                <div class="col-md-3">
                  <label class="form-label-premium">Department</label>
                  <input type="text" name="department" class="form-control form-control-premium">
                </div>

                <div class="col-md-3">
                  <label class="form-label-premium">Designation <span class="text-danger">*</span></label>
                  <input type="text" class="form-control form-control-premium" name="customer_designation" required>
                </div>

                <div class="col-md-3">
                  <label class="form-label-premium">Mobile No <span class="text-danger">*</span></label>
                  <input type="text" class="form-control form-control-premium" name="mobile_no" required>
                </div>

                <div class="col-md-3">
                  <label class="form-label-premium">Email</label>
                  <input type="email" class="form-control form-control-premium" name="email">
                </div>

                <div class="col-md-3">
                  <label class="form-label-premium">Date of Birth</label>
                  <input type="date" class="form-control form-control-premium" name="date_of_birth">
                </div>

                <div class="col-12 mt-4">
                  <h5 class="section-title"><i class="icon-location-pin me-2"></i>Address</h5>
                </div>

                <div class="col-md-6">
                  <label class="form-label-premium">Address Line 1</label>
                  <textarea class="form-control form-control-premium" name="address_line_1" rows="2"></textarea>
                </div>

                <div class="col-md-6">
                  <label class="form-label-premium">Address Line 2</label>
                  <textarea class="form-control form-control-premium" name="address_line_2" rows="2"></textarea>
                </div>

                <div class="col-md-3">
                  <label class="form-label-premium">Area</label>
                  <select class="form-control form-control-premium select2" id="area_id" name="area_id">
                    <option value="">Select Area</option>
                    @foreach($areaList as $areas)
                      <option value="{{ $areas->id }}">{{ $areas->area }}</option>
                    @endforeach
                  </select>
                </div>

                <div class="col-md-3">
                  <label class="form-label-premium">City</label>
                  <select class="form-control form-control-premium select2" id="city_id" name="city_id">
                    <option value="">Select City</option>
                    {{-- Populated via AJAX --}}
                  </select>
                </div>

                <div class="col-md-3">
                  <label class="form-label-premium">State</label>
                  <select class="form-control form-control-premium select2" id="state_id" name="state_id">
                    <option value="">Select State</option>
                    {{-- Populated via AJAX --}}
                  </select>
                </div>

                <div class="col-md-3">
                  <label class="form-label-premium">Pincode</label>
                  <input type="text" class="form-control form-control-premium" name="pincode">
                </div>

                <div class="col-12 mt-4">
                  <h5 class="section-title"><i class="icon-briefcase me-2"></i>Financial & Account Info</h5>
                </div>

                <div class="col-md-3">
                  <label class="form-label-premium">GST No</label>
                  <input type="text" class="form-control form-control-premium" name="gst">
                </div>

                <div class="col-md-3">
                  <label class="form-label-premium">Pan No</label>
                  <input type="text" class="form-control form-control-premium" name="pan">
                </div>

                <div class="col-md-3">
                  <label class="form-label-premium">Credit Days</label>
                  <input type="number" class="form-control form-control-premium" name="credit_days">
                </div>

                <div class="col-md-3">
                  <label class="form-label-premium">Co-ordinator</label>
                  <select class="form-control form-control-premium select2" name="ac_key">
                    <option value="">Select Coordinator</option>
                    @foreach($coordinateList as $user)
                      <option value="{{ $user->id }}">{{ $user->name ?? $user->user_name }}</option>
                    @endforeach
                  </select>
                </div>

                <div class="col-md-3">
                  <label class="form-label-premium">MSME Registered?</label>
                  <div class="form-check form-switch mt-2">
                    <input class="form-check-input" type="checkbox" id="is_msme" name="is_msme" value="1">
                    <label class="form-check-label" for="is_msme">Yes</label>
                  </div>
                </div>

                <div class="col-md-3 d-none" id="msme_div">
                  <label class="form-label-premium">MSME Number</label>
                  <input type="text" class="form-control form-control-premium" name="msme_no" id="msme_no">
                </div>

                <div class="col-12 mt-4 text-end">
                  <button type="button" class="btn btn-primary-custom px-4" id="btn-save-step-1">Save & Next</button>
                </div>
              </form>
            </div>

            <!-- STEP 2: BRANCHES -->
            <div id="step-content-2" class="step-content">
              <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="section-title">Branch List</h5>
                <button class="btn btn-sm btn-outline-primary-custom" data-bs-toggle="modal"
                  data-bs-target="#addBranchModal" onclick="prepareAddBranch()">+
                  Add Branch</button>
              </div>
              <div class="table-responsive">
                <table class="table table-bordered" id="branchTable">
                  <thead>
                    <tr>
                      <th>Branch Name</th>
                      <th>Contact Person</th>
                      <th>Mobile</th>
                      <th>City</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr class="empty-row">
                      <td colspan="4" class="text-center">No branches added yet.</td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="mt-4 text-end">
                {{-- <button type="button" class="btn btn-secondary me-2" onclick="goToStep(1)">Previous</button> --}}
                <button type="button" class="btn btn-primary-custom" onclick="goToStep(3)">Next</button>
              </div>
            </div>

            <!-- STEP 3: CONTACTS -->
            <div id="step-content-3" class="step-content">
              <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="section-title">Contact List</h5>
                <button class="btn btn-sm btn-outline-primary-custom" data-bs-toggle="modal"
                  data-bs-target="#addContactModal" onclick="prepareAddContact()">+ Add Contact</button>
              </div>
              <div class="table-responsive">
                <table class="table table-bordered" id="contactTable">
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>Branch</th>
                      <th>Designation</th>
                      <th>Mobile</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr class="empty-row">
                      <td colspan="4" class="text-center">No contacts added yet.</td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="mt-4 text-end">
                <button type="button" class="btn btn-secondary me-2" onclick="goToStep(2)">Previous</button>
                <button type="button" class="btn btn-primary-custom" onclick="goToStep(4)">Next</button>
              </div>
            </div>

            <!-- STEP 4: PRODUCTS -->
            <div id="step-content-4" class="step-content">
              <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="section-title">Product List</h5>
                <button class="btn btn-sm btn-outline-primary-custom" data-bs-toggle="modal"
                  data-bs-target="#addProductModal" onclick="prepareAddProduct()">+ Add Product</button>
              </div>
              <div class="table-responsive">
                <table class="table table-bordered" id="productTable">
                  <thead>
                    <tr>
                      <th>Product</th>
                      <th>Branch</th>
                      <th>Type</th>
                      <th>Quantity</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr class="empty-row">
                      <td colspan="4" class="text-center">No products added yet.</td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="mt-4 text-end">
                <button type="button" class="btn btn-secondary me-2" onclick="goToStep(3)">Previous</button>
                <a href="{{ route('admin.customer.index') }}" class="btn btn-success px-4 me-2">Finish</a>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- MODALS -->

  <!-- Add Branch Modal -->
  <div class="modal fade" id="addBranchModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content modal-content-premium">
        <div class="modal-header modal-header-premium">
          <h5 class="modal-title modal-title-premium">Add Branch</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <form id="branchForm">
            @csrf
            <input type="hidden" name="customer_id" class="modal_customer_id">
            <input type="hidden" name="branch_id" id="modal_branch_id">

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
                <select name="area_id" id="modal_branch_area" class="form-control select2-modal">
                  <option value="">Select Area</option>
                  @foreach($areaList as $areas)
                    <option value="{{ $areas->id }}">{{ $areas->area }}</option>
                  @endforeach
                </select>
              </div>

              <div class="col-md-6">
                <label class="form-label">City <span class="text-danger">*</span></label>
                <select name="city_id" id="modal_branch_city" class="form-control select2-modal" required>
                  <option value="">Select City</option>
                </select>
              </div>

              <div class="col-md-6">
                <label class="form-label">State <span class="text-danger">*</span></label>
                <select name="state_id" id="modal_branch_state" class="form-control select2-modal" required>
                  <option value="">Select State</option>
                </select>
              </div>

              <div class="col-md-6">
                <label class="form-label-premium">Pincode</label>
                <input type="text" name="pincode" id="edit_pincode" class="form-control form-control-premium">
              </div>

            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary-custom" id="btn-save-branch">Save</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Add Contact Modal -->
  <div class="modal fade" id="addContactModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content modal-content-premium">
        <div class="modal-header modal-header-premium">
          <h5 class="modal-title modal-title-premium">Add Contact</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <form id="contactForm">
            @csrf
            <input type="hidden" name="customer_id" class="modal_customer_id">
            <input type="hidden" name="id" id="modal_contact_id">
            <div class="row g-3">
              <div class="col-md-6">
                <label class="form-label">Branch <span class="text-danger">*</span></label>
                <select name="branch_id" class="form-control select-branch" required>
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
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary-custom" id="btn-save-contact">Save</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Add Product Modal -->
  <div class="modal fade" id="addProductModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content modal-content-premium">
        <div class="modal-header modal-header-premium">
          <h5 class="modal-title modal-title-premium">Add Product</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <form id="productForm">
            @csrf
            <input type="hidden" name="customer_id" class="modal_customer_id">
            <input type="hidden" name="id" id="modal_product_id">
            <div class="row g-3">
              <div class="col-md-6">
                <label class="form-label">Branch <span class="text-danger">*</span></label>
                <select name="branch_id" class="form-control select-branch" required>
                  <option value="">Select Branch</option>
                </select>
              </div>

              <div class="col-md-6">
                <label class="form-label">Product (AMC) <span class="text-danger">*</span></label>
                <select name="amc_product_id" class="form-control select2-modal" required>
                  <option value="">Select Product</option>
                  @foreach($amcProductList as $prod)
                    <option value="{{ $prod->id }}">{{ $prod->amc_product }}</option>
                  @endforeach
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
                <select name="service_engineer_1" class="form-control form-control-premium select2-modal">
                  <option value="">Select Engineer</option>
                  @foreach($engineerList as $eng)
                    <option value="{{ $eng->id }}">{{ $eng->name }}</option>
                  @endforeach
                </select>
              </div>

              <!-- SERVICE 2 -->
              <div class="col-md-6">
                <label class="form-label-premium">Service Date 2</label>
                <input type="date" class="form-control form-control-premium" name="service_date_2" disabled>
              </div>
              <div class="col-md-6">
                <label class="form-label-premium">Service Engineer 2</label>
                <select name="service_engineer_2" class="form-control form-control-premium select2-modal" disabled>
                  <option value="">Select Engineer</option>
                  @foreach($engineerList as $eng)
                    <option value="{{ $eng->id }}">{{ $eng->name }}</option>
                  @endforeach
                </select>
              </div>

              <!-- SERVICE 3 -->
              <div class="col-md-6">
                <label class="form-label-premium">Service Date 3</label>
                <input type="date" class="form-control form-control-premium" name="service_date_3" disabled>
              </div>
              <div class="col-md-6">
                <label class="form-label-premium">Service Engineer 3</label>
                <select name="service_engineer_3" class="form-control form-control-premium select2-modal" disabled>
                  <option value="">Select Engineer</option>
                  @foreach($engineerList as $eng)
                    <option value="{{ $eng->id }}">{{ $eng->name }}</option>
                  @endforeach
                </select>
              </div>

            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary-custom" id="btn-save-product">Save</button>
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
    var savedBranches = [];
    var savedContacts = [];
    var savedProducts = [];

    $(document).ready(function () {
      $('.select2').select2({ placeholder: 'Select an option', allowClear: true, width: '100%' });

      // Initialize modals select2
      $('.modal').each(function () {
        var $modal = $(this);
        $modal.find('.select2-modal, .select-branch').select2({
          dropdownParent: $modal,
          width: '100%',
          placeholder: 'Select an option',
          allowClear: true
        });
      });

      // --- MSME Toggle Logic ---
      $('#is_msme').change(function () {
        if ($(this).is(':checked')) {
          $('#msme_div').removeClass('d-none');
        } else {
          $('#msme_div').addClass('d-none');
          $('#msme_no').val('');
        }
      });

      // --- STEP 1 LOGIC ---
      $('#btn-save-step-1').click(function () {
        var form = $('#step1Form');
        var btn = $(this);

        if (!form[0].checkValidity()) {
          form.addClass('was-validated');
          return;
        }

        btn.prop('disabled', true).text('Saving...');

        $.ajax({
          url: "{{ route('admin.customer.store') }}",
          method: "POST",
          data: form.serialize(),
          dataType: 'json',
          success: function (res) {
            if (res.status) {
              $('#global_customer_id').val(res.customer_id);
              $('#global_customer_uuid').val(res.uuid);
              $('.modal_customer_id').val(res.customer_id);
              goToStep(2);
            } else {
              alert('Error saving customer: ' + res.message);
              btn.prop('disabled', false).text('Save & Next');
            }
          },
          error: function (err) {
            console.error(err);
            alert('Save failed. Check console.');
            btn.prop('disabled', false).text('Save & Next');
          }
        });
      });

      // --- LOCATION AJAX (Step 1) ---
      $('#area_id').on('change', function () {
        var areaID = $(this).val();
        if (areaID) {
          fetchCityState(areaID, '#city_id', '#state_id');
        }
      });

      // --- LOCATION AJAX (Modal) ---
      $('#modal_branch_area').on('change', function () {
        var areaID = $(this).val();
        if (areaID) {
          fetchCityState(areaID, '#modal_branch_city', '#modal_branch_state');
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
              // Only populate if empty or force update (ignoring if user is editing and values are set)
              // But for simplicity we append. logic for edit needs care to not overwrite pre-filled values immediately unless user changes area.
              // For now standard behavior.
              $(citySelector).empty().append('<option value="' + res.city.id + '">' + res.city.name + '</option>');
              $(stateSelector).empty().append('<option value="' + res.state.id + '">' + res.state.name + '</option>');
            }
          }
        });
      }

      // --- BRANCH MODAL SAVE ---
      $('#btn-save-branch').click(function () {
        var form = $('#branchForm');
        if (!$('#global_customer_id').val()) { alert('Please save customer first.'); return; }

        var id = $('#modal_branch_id').val();
        var url = id ? "{{ route('admin.customer.edit.customer.branch') }}" : "{{ route('admin.customer.add.branch') }}";

        $.ajax({
          url: url,
          method: "POST",
          data: form.serialize(),
          dataType: 'json',
          success: function (res) {
            if (res.status) {
              var branchName = $('#branchForm input[name="branch_name"]').val();
              var contact = $('#branchForm input[name="contact_person"]').val();
              var mobile = $('#branchForm input[name="mobile_no"]').val();
              var city = $('#modal_branch_city option:selected').text();
              var branchId = id ? id : (res.branch_id || Date.now());

              if (id) {
                // Update existing
                var idx = savedBranches.findIndex(x => x.id == id);
                if (idx !== -1) savedBranches[idx] = {
                  id: branchId,
                  name: branchName,
                  contact: contact,
                  mobile: mobile,
                  city: city,
                  fullData: form.serializeArray() // Store full data for easy restore
                };
              } else {
                // Add new
                savedBranches.push({
                  id: branchId,
                  name: branchName,
                  contact: contact,
                  mobile: mobile,
                  city: city,
                  fullData: form.serializeArray()
                });
              }

              renderBranchTable();
              $('#addBranchModal').modal('hide');
              form[0].reset();
              $('#modal_branch_city').empty();
              $('#modal_branch_state').empty();
              $('#modal_branch_id').val('');
              $('#btn-save-branch').text('Save');
            } else {
              alert('Failed to save branch');
            }
          },
          error: function () {
            alert('Error saving branch.');
          }
        });
      });

      // --- CONTACT MODAL SAVE ---
      $('#btn-save-contact').click(function () {
        var form = $('#contactForm');
        var id = $('#modal_contact_id').val();
        var url = id ? "{{ route('admin.customer.edit.contact') }}" : "{{ route('admin.customer.add.contact') }}";

        $.ajax({
          url: url,
          method: "POST",
          data: form.serialize(),
          dataType: 'json',
          success: function (res) {
            if (res.status) {
              var name = $('#contactForm input[name="contact_name"]').val();
              // Fix: Use scoped selector for branch select
              var branchName = $('#contactForm .select-branch option:selected').text();
              // Fix: Use scoped selector for designation
              var desig = $('#contactForm input[name="designation"]').val();
              var mob = $('#contactForm input[name="mobile_no"]').val();
              var contactId = id ? id : (res.contact_id || Date.now());

              var dataObj = {
                id: contactId,
                name: name,
                branchName: branchName,
                desig: desig,
                mob: mob,
                fullData: form.serializeArray()
              };

              if (id) {
                var idx = savedContacts.findIndex(x => x.id == id);
                if (idx !== -1) savedContacts[idx] = dataObj;
              } else {
                savedContacts.push(dataObj);
              }

              renderContactTable();
              $('#addContactModal').modal('hide');
              form[0].reset();
              $('#modal_contact_id').val('');
              $('#btn-save-contact').text('Save');
            } else {
              alert('Failed to save contact');
            }
          },
          error: function () {
            alert('Error saving contact.');
          }
        });
      });

      // --- PRODUCT MODAL SAVE ---
      $('#btn-save-product').click(function () {
        var form = $('#productForm');
        var id = $('#modal_product_id').val();
        var url = id ? "{{ route('admin.customer.edit.amc.product') }}" : "{{ route('admin.customer.add.amc.product') }}";

        $.ajax({
          url: url,
          method: "POST",
          data: form.serialize(),
          dataType: 'json',
          success: function (res) {
            if (res.status) {
              var prodName = $('select[name="amc_product_id"] option:selected').text();
              var branchName = $('#productForm .select-branch option:selected').text();
              var type = $('#productForm select[name="product_type"]').val(); // Use select (it's a select in HTML)
              var qty = $('#productForm input[name="quantity"]').val();
              var prodId = id ? id : (res.product_id || Date.now());
              var uin = res.product_uin || $('#productForm input[name="product_uin"]').val();

              // Update fullData with generated UIN
              var formData = form.serializeArray();
              var uinField = formData.find(x => x.name === 'product_uin');
              if (uinField) {
                uinField.value = uin;
              } else {
                formData.push({ name: 'product_uin', value: uin });
              }

              var dataObj = {
                id: prodId,
                prodName: prodName,
                branchName: branchName,
                type: type,
                qty: qty,
                fullData: formData
              };

              if (id) {
                var idx = savedProducts.findIndex(x => x.id == id);
                if (idx !== -1) savedProducts[idx] = dataObj;
              } else {
                savedProducts.push(dataObj);
              }

              renderProductTable();
              $('#addProductModal').modal('hide');
              form[0].reset();
              $('#modal_product_id').val('');
              $('#btn-save-product').text('Save');
            } else {
              alert('Failed to save product: ' + res.message);
            }
          },
          error: function () {
            alert('Error saving product.');
          }
        });
      });

    });

    function renderBranchTable() {
      var tbody = $('#branchTable tbody');
      tbody.empty();
      if (savedBranches.length === 0) {
        tbody.append('<tr class="empty-row"><td colspan="5" class="text-center">No branches added yet.</td></tr>');
      } else {
        savedBranches.forEach(b => {
          tbody.append('<tr><td>' + b.name + '</td><td>' + b.contact + '</td><td>' + b.mobile + '</td><td>' + b.city + '</td><td><button class="btn btn-sm btn-primary-custom" onclick="editBranch(' + b.id + ')">Edit</button></td></tr>');
        });
      }
      prepareContactModal(); // Update branch list for contacts
    }

    function renderContactTable() {
      var tbody = $('#contactTable tbody');
      tbody.empty();
      if (savedContacts.length === 0) {
        tbody.append('<tr class="empty-row"><td colspan="5" class="text-center">No contacts added yet.</td></tr>');
      } else {
        savedContacts.forEach(c => {
          tbody.append('<tr><td>' + c.name + '</td><td>' + c.branchName + '</td><td>' + c.desig + '</td><td>' + c.mob + '</td><td><button class="btn btn-sm btn-primary-custom" onclick="editContact(' + c.id + ')">Edit</button></td></tr>');
        });
      }
    }

    function renderProductTable() {
      var tbody = $('#productTable tbody');
      tbody.empty();
      if (savedProducts.length === 0) {
        tbody.append('<tr class="empty-row"><td colspan="5" class="text-center">No products added yet.</td></tr>');
      } else {
        savedProducts.forEach(p => {
          tbody.append('<tr><td>' + p.prodName + '</td><td>' + p.branchName + '</td><td>' + p.type + '</td><td>' + p.qty + '</td><td><button class="btn btn-sm btn-primary-custom" onclick="editProduct(' + p.id + ')">Edit</button></td></tr>');
        });
      }
    }

    function goToStep(step) {
      $('.step-content').removeClass('active');
      $('#step-content-' + step).addClass('active');

      $('.step-item').removeClass('active completed');
      for (let i = 1; i < step; i++) {
        $('#step-nav-' + i).addClass('completed');
      }
      $('#step-nav-' + step).addClass('active');
    }

    function prepareContactModal() {
      var opts = '<option value="">Select Branch</option>';
      savedBranches.forEach(b => {
        opts += '<option value="' + b.id + '">' + b.name + '</option>';
      });
      $('.select-branch').html(opts);
    }

    function prepareAddBranch() {
      $('#branchForm')[0].reset();
      $('#modal_branch_id').val('');
      $('#btn-save-branch').text('Save');
      $('#modal_branch_city').empty().append('<option value="">Select City</option>');
      $('#modal_branch_state').empty().append('<option value="">Select State</option>');
      $('#modal_branch_area').val('').trigger('change');
    }

    function prepareAddContact() {
      prepareContactModal(); // Populates branches
      $('#contactForm')[0].reset();
      $('#modal_contact_id').val('');
      $('#btn-save-contact').text('Save');
    }

    function prepareAddProduct() {
      prepareProductModal(); // Populates branches
      $('#productForm')[0].reset();
      $('#modal_product_id').val('');
      $('#btn-save-product').text('Save');
      $('select[name="amc_product_id"]').val('').trigger('change');
      $('#productForm .select-branch').val('').trigger('change');
      $('#productForm .select-branch').val('').trigger('change');
      $('#productForm input[name="quantity"]').val(1);
      $('#productForm input[name="product_uin"]').val('');
    }

    // Edit Functions
    window.editBranch = function (id) {
      var item = savedBranches.find(x => x.id == id);
      if (!item) return;

      var form = $('#branchForm');
      item.fullData.forEach(field => {
        var input = form.find('[name="' + field.name + '"]');
        if (input.length) {
          if (input.is(':checkbox') || input.is(':radio')) {
            // input.prop('checked', input.val() == field.value); 
          } else {
            input.val(field.value).trigger('change');
          }
        }
      });

      $('#modal_branch_id').val(item.id);

      $('#addBranchModal').modal('show');
      $('#btn-save-branch').text('Update');
    }

    window.editContact = function (id) {
      var item = savedContacts.find(x => x.id == id);
      if (!item) return;

      var form = $('#contactForm');
      item.fullData.forEach(field => {
        var input = form.find('[name="' + field.name + '"]');
        if (input.length) input.val(field.value).trigger('change');
      });

      $('#modal_contact_id').val(item.id);

      $('#addContactModal').modal('show');
      $('#btn-save-contact').text('Update');
    }

    window.editProduct = function (id) {
      var item = savedProducts.find(x => x.id == id);
      if (!item) return;

      var form = $('#productForm');
      item.fullData.forEach(field => {
        var input = form.find('[name="' + field.name + '"]');
        if (input.length) input.val(field.value).trigger('change');
      });

      $('#modal_product_id').val(item.id);
      $('#addProductModal').modal('show');
      $('#btn-save-product').text('Update');
    }

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

    // Run on modal open for Edit to check if inputs should be enabled
    function checkServiceDateEnabling() {
      $('input[name="service_date_1"]').trigger('change');
      $('input[name="service_date_2"]').trigger('change');
    }

    // Hook checkServiceDateEnabling into edit and prepare buttons
    var originalEditProduct = window.editProduct;
    window.editProduct = function (id) {
      if (originalEditProduct) originalEditProduct(id);
      setTimeout(checkServiceDateEnabling, 300); // Small delay to allow restore
    }
  </script>
@endpush