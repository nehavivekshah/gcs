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
                  <label class="form-label-premium">Customer Name <span class="text-danger">*</span></label>
                  <input type="text" class="form-control form-control-premium" name="customer_name" required>
                </div>

                <div class="col-md-3">
                  <label class="form-label-premium">Customer Type</label>
                  <select class="form-control form-control-premium" name="customer_type">
                    <option value="">Select Type</option>
                    <option value="GCS">GCS</option>
                    <option value="NON GCS">NON GCS</option>
                  </select>
                </div>

                <div class="col-md-3">
                  <label class="form-label-premium">Department</label>
                  <input type="text" name="department" class="form-control form-control-premium">
                </div>

                <div class="col-md-3">
                  <label class="form-label-premium">Designation <span class="text-danger">*</span></label>
                  <input type="text" class="form-control form-control-premium" name="customer_designation" required>
                </div>

                <div class="col-12 mt-4">
                  <h5 class="section-title"><i class="icon-mobile me-2"></i>Contact Details</h5>
                </div>

                <div class="col-md-3">
                  <label class="form-label-premium">Contact Person</label>
                  <input type="text" class="form-control form-control-premium" name="contact_person">
                </div>

                <div class="col-md-3">
                  <label class="form-label-premium">Mobile No <span class="text-danger">*</span></label>
                  <input type="text" class="form-control form-control-premium" name="mobile_no" required>
                </div>

                <div class="col-md-3">
                  <label class="form-label-premium">Phone 1</label>
                  <input type="text" class="form-control form-control-premium" name="phone_1">
                </div>

                <div class="col-md-3">
                  <label class="form-label-premium">Phone 2</label>
                  <input type="text" class="form-control form-control-premium" name="phone_2">
                </div>

                <div class="col-md-3">
                  <label class="form-label-premium">Email</label>
                  <input type="email" class="form-control form-control-premium" name="email">
                </div>

                <div class="col-md-3">
                  <label class="form-label-premium">Date of Birth</label>
                  <input type="date" class="form-control form-control-premium" name="date_of_birth">
                </div>

                <div class="col-md-3">
                  <label class="form-label-premium">Website</label>
                  <input type="text" class="form-control form-control-premium" name="website">
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
                  data-bs-target="#addBranchModal">+
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
                  data-bs-target="#addContactModal" onclick="prepareContactModal()">+ Add Contact</button>
              </div>
              <div class="table-responsive">
                <table class="table table-bordered" id="contactTable">
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>Branch</th>
                      <th>Designation</th>
                      <th>Mobile</th>
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
                  data-bs-target="#addProductModal" onclick="prepareProductModal()">+ Add Product</button>
              </div>
              <div class="table-responsive">
                <table class="table table-bordered" id="productTable">
                  <thead>
                    <tr>
                      <th>Product</th>
                      <th>Branch</th>
                      <th>Type</th>
                      <th>Quantity</th>
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
                <label class="form-label">Mobile No</label>
                <input type="text" name="mobile_no" class="form-control">
              </div>

              <div class="col-md-6">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control">
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
                <label class="form-label-premium">User Name</label>
                <input type="text" class="form-control form-control-premium" name="user_name">
              </div>

              <div class="col-md-12">
                <label class="form-label-premium">Description / Serial No.</label>
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
                <input type="date" class="form-control form-control-premium" name="service_date_2">
              </div>
              <div class="col-md-6">
                <label class="form-label-premium">Service Engineer 2</label>
                <select name="service_engineer_2" class="form-control form-control-premium select2-modal">
                  <option value="">Select Engineer</option>
                  @foreach($engineerList as $eng)
                    <option value="{{ $eng->id }}">{{ $eng->name }}</option>
                  @endforeach
                </select>
              </div>

              <!-- SERVICE 3 -->
              <div class="col-md-6">
                <label class="form-label-premium">Service Date 3</label>
                <input type="date" class="form-control form-control-premium" name="service_date_3">
              </div>
              <div class="col-md-6">
                <label class="form-label-premium">Service Engineer 3</label>
                <select name="service_engineer_3" class="form-control form-control-premium select2-modal">
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

    $(document).ready(function () {
      $('.select2').select2({ placeholder: 'Select an option', allowClear: true, width: '100%' });

      // Initialize modals select2
      // We iterate over each modal to ensure the dropdownParent is correctly set to THAT specific modal
      $('.modal').each(function () {
        var $modal = $(this);
        $modal.find('.select2-modal, .select-branch').select2({
          dropdownParent: $modal,
          width: '100%',
          placeholder: 'Select an option',
          allowClear: true
        });
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

              // Show success
              // alert('Customer saved!');

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

        $.ajax({
          url: "{{ route('admin.customer.add.branch') }}",
          method: "POST",
          data: form.serialize(),
          dataType: 'json',
          success: function (res) {
            if (res.status) {
              // Add to table
              var branchName = $('input[name="branch_name"]').val();
              var contact = $('input[name="contact_person"]').val();
              var mobile = $('input[name="mobile_no"]').val();
              var city = $('#modal_branch_city option:selected').text();
              var branchId = res.branch_id || Date.now(); // Fallback

              savedBranches.push({ id: branchId, name: branchName });

              $('#branchTable .empty-row').hide();
              $('#branchTable tbody').append('<tr><td>' + branchName + '</td><td>' + contact + '</td><td>' + mobile + '</td><td>' + city + '</td></tr>');

              $('#addBranchModal').modal('hide');
              form[0].reset();
              $('#modal_branch_city').empty();
              $('#modal_branch_state').empty();
            } else {
              alert('Failed to add branch');
            }
          },
          error: function () {
            alert('Error adding branch. Make sure backend supports JSON.');
          }
        });
      });

      // --- CONTACT MODAL SAVE ---
      $('#btn-save-contact').click(function () {
        var form = $('#contactForm');

        $.ajax({
          url: "{{ route('admin.customer.add.contact') }}",
          method: "POST",
          data: form.serialize(),
          dataType: 'json',
          success: function (res) {
            if (res.status) {
              var name = $('input[name="contact_name"]').val();
              var branchName = $('.select-branch option:selected').text();
              var desig = $('input[name="designation"]').val();
              var mob = $('input[name="mobile_no"]').val();

              $('#contactTable .empty-row').hide();
              $('#contactTable tbody').append('<tr><td>' + name + '</td><td>' + branchName + '</td><td>' + desig + '</td><td>' + mob + '</td></tr>');

              $('#addContactModal').modal('hide');
              form[0].reset();
            } else {
              alert('Failed to add contact');
            }
          },
          error: function () {
            alert('Error adding contact. Make sure backend supports JSON.');
          }
        });
      });

      // --- PRODUCT MODAL SAVE ---
      $('#btn-save-product').click(function () {
        var form = $('#productForm');

        $.ajax({
          url: "{{ route('admin.customer.add.amc.product') }}", // Using the correct route for product add
          method: "POST",
          data: form.serialize(),
          dataType: 'json',
          success: function (res) {
            if (res.status) {
              var prodName = $('select[name="amc_product_id"] option:selected').text();
              var branchName = $('#productForm .select-branch option:selected').text();
              var type = $('input[name="product_type"]').val();
              var qty = $('input[name="quantity"]').val();

              $('#productTable .empty-row').hide();
              $('#productTable tbody').append('<tr><td>' + prodName + '</td><td>' + branchName + '</td><td>' + type + '</td><td>' + qty + '</td></tr>');

              $('#addProductModal').modal('hide');
              form[0].reset();
            } else {
              alert('Failed to add product: ' + res.message);
            }
          },
          error: function () {
            alert('Error adding product.');
          }
        });
      });

    });

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

    function prepareProductModal() {
      prepareContactModal();
    }

  </script>
@endpush