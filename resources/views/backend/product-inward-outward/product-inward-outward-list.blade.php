@extends('backend.common.master')

@push('stylesheets')

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

@endpush

@section('main-section')
<div class="container-fluid">
  <div class="page-title">
    <div class="row">
      <div class="col-6">
        <h4>Product Inward Outward List</h4>
      </div>
      <div class="col-6">
        <ol class="breadcrumb justify-content-end">
          <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
          <li class="breadcrumb-item active">Product Inward Outward List</li>

          <button type="button" class="btn btn-primary-custom ms-3" data-bs-toggle="modal"
            data-bs-target="#addProductInwardOutwardModal">
            <i class="fa fa-plus me-1"></i> Add Customer Product
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
                  <th>ProductIO-No</th>
                  <th>Company</th>
                  <th>Status</th>
                  <th>Product</th>
                  <th>Product_Status</th>
                  <th>Created By</th>
                  <th>Modified By</th>
                  <th width="120" class="text-center">Action</th>
                </tr>
              </thead>
              <tbody>

                @php $i=0; @endphp
                @foreach($productInwardOutwardList as $productInwardOutward)
                @php $i++; @endphp
                <tr>
                  <td>{{ $i }}</td>
                  <td>{{ $productInwardOutward->product_io_no }}</td>
                  <td>{{ $productInwardOutward->company_name }}</td>
                  <td>{{ $productInwardOutward->call_status }}</td>
                  <td>{{ $productInwardOutward->amc_product }}</td>
                  <td>{{ $productInwardOutward->location }}</td>
                  <td>{{ $productInwardOutward->created_by  }}</td>
                  <td>{{ $productInwardOutward->modified_by }}</td>
                  <td class="text-center">
                    <ul class="action">

                      <li class="view">
                        <a href="javascript:void(0);"
                          class="viewProductInwardOutward btn btn-sm-custom btn-outline-dark me-2"
                          data-uuid="{{ $productInwardOutward->uuid }}"
                          data-id="{{ $productInwardOutward->id }}"
                          data-product_io_no="{{ $productInwardOutward->product_io_no }}"
                          data-company_name="{{ $productInwardOutward->company_name }}"
                          data-branch="{{ $productInwardOutward->branch }}"
                          data-department="{{ $productInwardOutward->department }}"
                          data-amc_product="{{ $productInwardOutward->amc_product }}"
                          data-manufacture="{{ $productInwardOutward->manufacture }}"
                          data-location="{{ $productInwardOutward->location }}"
                          data-call_status="{{ $productInwardOutward->call_status }}"
                          data-supplier_name="{{ $productInwardOutward->supplier_name }}"
                          data-inward_engineer_name="{{ $productInwardOutward->inward_engineer_name }}"
                          data-outward_engineer_name="{{ $productInwardOutward->outward_engineer_name }}"
                          data-inward_tp_date="{{ $productInwardOutward->inward_tp_date }}"
                          data-outward_tp_date="{{ $productInwardOutward->outward_tp_date }}"
                          data-tp_inward_engineer_name="{{ $productInwardOutward->tp_inward_engineer_name }}"
                          data-tp_outward_engineer_name="{{ $productInwardOutward->tp_outward_engineer_name }}"
                          data-serial_no="{{ $productInwardOutward->serial_no }}"
                          data-third_party_description="{{ $productInwardOutward->third_party_description }}"
                          data-product_condition="{{ $productInwardOutward->product_condition }}"
                          data-description="{{ $productInwardOutward->description }}"
                          data-bs-toggle="modal"
                          data-bs-target="#viewProductInwardOutwardModal">
                          <i class="icon-eye" style="color: inherit;"></i>
                        </a>
                      </li>

                      <li class="edit">
                        <a href="javascript:void(0);"
                          class="btn btn-sm-custom btn-outline-dark me-2"
                          data-uuid="{{ $productInwardOutward->uuid }}"
                          data-id="{{ $productInwardOutward->id }}"
                          data-company_id="{{ $productInwardOutward->company_id }}"
                          data-branch_id="{{ $productInwardOutward->branch_id }}"
                          data-department_id="{{ $productInwardOutward->department_id }}"
                          data-product_id="{{ $productInwardOutward->product_id }}"
                          data-manufacture_id="{{ $productInwardOutward->manufacture_id }}"
                          data-location="{{ $productInwardOutward->location }}"
                          data-call_status="{{ $productInwardOutward->call_status }}"
                          data-supplier_id="{{ $productInwardOutward->supplier_id }}"
                          data-inward_engineer="{{ $productInwardOutward->inward_engineer }}"
                          data-outward_engineer="{{ $productInwardOutward->outward_engineer }}"
                          data-inward_tp_date="{{ $productInwardOutward->inward_tp_date }}"
                          data-outward_tp_date="{{ $productInwardOutward->outward_tp_date }}"
                          data-tp_inward_engineer="{{ $productInwardOutward->tp_inward_engineer }}"
                          data-tp_outward_engineer="{{ $productInwardOutward->tp_outward_engineer }}"
                          data-serial_no="{{ $productInwardOutward->serial_no }}"
                          data-third_party_description="{{ $productInwardOutward->third_party_description }}"
                          data-product_condition="{{ $productInwardOutward->product_condition }}"
                          data-description="{{ $productInwardOutward->description }}"
                          data-bs-toggle="modal"
                          data-bs-target="#editProductInwardOutwardModal">
                          <i class="icon-pencil-alt" style="color: inherit;"></i>
                        </a>
                      </li>

                      <li class="delete">
                        <a href="{{ route('admin.product.inward.outward.delete', $productInwardOutward->uuid) }}" class="btn btn-sm-custom btn-outline-dark">
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

<div class="modal fade" id="viewProductInwardOutwardModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered">
    <div class="modal-content modal-content-premium border-0 overflow-hidden">

      <!-- Header -->
      <div class="modal-header modal-header-premium bg-white border-bottom p-4">
        <div>
          <h4 class="modal-title modal-title-premium fw-bold mb-1">
            Product Inward / Outward Details
          </h4>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Body -->
      <div class="modal-body p-4 bg-white">

        <!-- Profile Header -->
        <div class="view-profile-header bg-white shadow-sm mb-4">
          <div class="row align-items-center">
            <div class="col-md-6">
              <h4 class="mb-1 text-dark fw-bold" id="v_company_name">Company Name</h4>
              <p class="text-muted mb-0">
                <i class="icon-hash me-1"></i>
                product Io No: <span id="v_product_io_no"></span>
              </p>
            </div>
            <div class="col-md-6 text-md-end mt-3 mt-md-0">
              <span class="badge bg-light-primary text-dark px-3 py-2 rounded-pill fs-6"
                id="v_call_status">Status</span>
            </div>
          </div>
        </div>

        <!-- Tabs -->
        <ul class="nav nav-tabs nav-tabs-premium" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" data-bs-toggle="tab" href="#pio-basic">
              <i class="icon-info-alt me-2"></i> Basic Info
            </a>
          </li>
        </ul>

        <!-- Tab Content -->
        <div class="tab-content">

          <!-- BASIC INFO TAB -->
          <div class="tab-pane fade show active" id="pio-basic">
            <div class="row g-4">

              <!-- Product Information -->
              <div class="col-lg-6">
                <div class="info-card">
                  <h6 class="view-section-title">
                    <i class="icon-package"></i> Product Information
                  </h6>

                  <div class="view-item-wrapper">
                    <small class="view-label">Branch</small>
                    <div class="view-value" id="v_branch">-</div>
                  </div>

                  <div class="view-item-wrapper">
                    <small class="view-label">Department</small>
                    <div class="view-value" id="v_department">-</div>
                  </div>

                  <div class="view-item-wrapper">
                    <small class="view-label"> Product</small>
                    <div class="view-value" id="v_amc_product">-</div>
                  </div>

                  <div class="view-item-wrapper">
                    <small class="view-label">Manufacture</small>
                    <div class="view-value" id="v_manufacture">-</div>
                  </div>

                  <div class="view-item-wrapper">
                    <small class="view-label">Location</small>
                    <div class="view-value" id="v_location">-</div>
                  </div>

                  <div class="view-item-wrapper">
                    <small class="view-label">Serial Number</small>
                    <div class="view-value font-code" id="v_serial_no">-</div>
                  </div>
                </div>
              </div>

              <!-- Engineer Details -->
              <div class="col-lg-6">
                <div class="info-card">
                  <h6 class="view-section-title">
                    <i class="icon-user"></i> Engineer Details
                  </h6>

                  <div class="view-item-wrapper">
                    <small class="view-label">Inward Engineer</small>
                    <div class="view-value" id="v_inward_engineer_name">-</div>
                  </div>

                  <div class="view-item-wrapper">
                    <small class="view-label">Outward Engineer</small>
                    <div class="view-value" id="v_outward_engineer_name">-</div>
                  </div>

                  <div class="view-item-wrapper">
                    <small class="view-label">TP Inward Engineer</small>
                    <div class="view-value" id="v_tp_inward_engineer_name">-</div>
                  </div>

                  <div class="view-item-wrapper">
                    <small class="view-label">TP Outward Engineer</small>
                    <div class="view-value" id="v_tp_outward_engineer_name">-</div>
                  </div>
                </div>
              </div>

              <!-- Third Party / Supplier -->
              <div class="col-lg-6">
                <div class="info-card">
                  <h6 class="view-section-title">
                    <i class="icon-people"></i> Third Party / Supplier
                  </h6>

                  <div class="view-item-wrapper">
                    <small class="view-label">Supplier Name</small>
                    <div class="view-value" id="v_supplier_name">-</div>
                  </div>

                  <div class="view-item-wrapper">
                    <small class="view-label">Inward TP Date</small>
                    <div class="view-value" id="v_inward_tp_date">-</div>
                  </div>

                  <div class="view-item-wrapper">
                    <small class="view-label">Outward TP Date</small>
                    <div class="view-value" id="v_outward_tp_date">-</div>
                  </div>

                  <div class="view-item-wrapper">
                    <small class="view-label">Third Party Description</small>
                    <div class="view-value" id="v_third_party_description">-</div>
                  </div>
                </div>
              </div>

              <!-- Product Status -->
              <div class="col-lg-6">
                <div class="info-card">
                  <h6 class="view-section-title">
                    <i class="icon-clipboard"></i> Product Status
                  </h6>

                  <div class="view-item-wrapper">
                    <small class="view-label">Product Condition</small>
                    <div class="view-value" id="v_product_condition">-</div>
                  </div>

                  <div class="view-item-wrapper">
                    <small class="view-label">Description</small>
                    <div class="view-value" id="v_description">-</div>
                  </div>
                </div>
              </div>

            </div>
          </div>

        </div><!-- tab-content -->

      </div>
    </div>
  </div>
</div>



<div class="modal fade" id="addProductInwardOutwardModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered">
    <div class="modal-content modal-content-premium">

      <!-- Header -->
      <div class="modal-header modal-header-premium">
        <h5 class="modal-title modal-title-premium">Add Product Inward Outward</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>

      <form action="{{ route('admin.product.inward.outward.store') }}" method="POST">
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

            <div class="col-md-6">
              <label class="form-label">Manufacture</label>
              <select name="manufacture_id" id="manufacture_id"
                class="form-control form-control-premium select2">
                <option value="">Select Manufacture</option>
                @foreach($manufactureList as $manufacture)
                <option value="{{ $manufacture->id }}">{{ $manufacture->manufacture }}</option>
                @endforeach
              </select>
            </div>

            <div class="col-md-6">
              <label class="form-label-premium">Location </label>
              <select name="location" id="location" class="form-control form-control-premium">
                <option value="">Select </option>
                <option value="In-House">In-House</option>
                <option value="Outward">Outward</option>
                <option value="3rd Party">3rd Party</option>
                <option value="3rd Party to Inhouse">3rd Party to Inhouse</option>
              </select>
            </div>

            <div class="col-md-6">
              <label class="form-label-premium"> Call Status</label>
              <select name="call_status" id="call_status"
                class="form-control form-control-premium">
                <option value="">Select </option>
                <option value="Active">Active</option>
                <option value="Quote Sent">Quote Sent</option>
                <option value="Approval Pending">Approval Pending</option>
                <option value="Close">Close</option>
              </select>
            </div>

            <div class="col-md-6">
              <label class="form-label-premium"> Supplier</label>
              <select name="supplier_id" id="supplier_id"
                class="form-control form-control-premium">
                <option value="">Select Supplier</option>
                @foreach($supplierList as $supplier)
                <option value="{{ $supplier->id }}">{{ $supplier->supplier_name }}</option>
                @endforeach
              </select>
            </div>

            <div class="col-md-6">
              <label class="form-label-premium">Inward Engineer</label>
              <select name="inward_engineer" id="inward_engineer"
                class="form-control form-control-premium">
                <option value="">Select Engineer</option>
                @foreach($engineerList as $engineer)
                <option value="{{ $engineer->id }}">{{ $engineer->name }}</option>
                @endforeach
              </select>
            </div>

            <div class="col-md-6">
              <label class="form-label-premium">Outward Engineer</label>
              <select name="outward_engineer" id="outward_engineer"
                class="form-control form-control-premium">
                <option value="">Select Engineer</option>
                @foreach($engineerList as $engineer)
                <option value="{{ $engineer->id }}">{{ $engineer->name }}</option>
                @endforeach
              </select>
            </div>


            <div class="col-md-6">
              <label class="form-label-premium">Inward TP Date</label>
              <input type="date" name="inward_tp_date" id="inward_tp_date"
                class="form-control form-control-premium">
            </div>

            <div class="col-md-6">
              <label class="form-label-premium">Outward TP Date</label>
              <input type="date" name="outward_tp_date" id="outward_tp_date"
                class="form-control form-control-premium">
            </div>

            <div class="col-md-6">
              <label class="form-label-premium">TP Inward Engineer</label>
              <select name="tp_inward_engineer" id="tp_inward_engineer"
                class="form-control form-control-premium">
                <option value="">Select Engineer</option>
                @foreach($engineerList as $engineer)
                <option value="{{ $engineer->id }}">{{ $engineer->name }}</option>
                @endforeach
              </select>
            </div>

            <div class="col-md-6">
              <label class="form-label-premium">TP Outward Engineer</label>
              <select name="tp_outward_engineer" id="tp_outward_engineer"
                class="form-control form-control-premium">
                <option value="">Select Engineer</option>
                @foreach($engineerList as $engineer)
                <option value="{{ $engineer->id }}">{{ $engineer->name }}</option>
                @endforeach
              </select>
            </div>

            <div class="col-md-6">
              <label class="form-label-premium">Serial No</label>
              <input type="text" name="serial_no" id="serial_no"
                class="form-control form-control-premium">
            </div>

            <div class="col-md-12">
              <label class="form-label-premium">Third Party Description</label>
              <textarea name="third_party_description" id="third_party_description" rows="3"
                class="form-control form-control-premium"></textarea>
            </div>

            <div class="col-md-12">
              <label class="form-label-premium">Product Condition</label>
              <textarea name="product_condition" id="product_condition" rows="3"
                class="form-control form-control-premium"></textarea>
            </div>

            <div class="col-md-12">
              <label class="form-label-premium">Description</label>
              <textarea name="description" id="description" rows="3"
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
            Save Complaint
          </button>
        </div>

      </form>
    </div>
  </div>
</div>


<div class="modal fade" id="editProductInwardOutwardModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered">
    <div class="modal-content modal-content-premium">

      <div class="modal-header modal-header-premium">
        <h5 class="modal-title modal-title-premium">Edit Product Inward Outward</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>

      <form action="{{ route('admin.product.inward.outward.update') }}" method="POST">
        @csrf
        @method('PATCH')

        <input type="hidden" name="id" id="edit_id">
        <input type="hidden" name="uuid" id="edit_uuid">

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

            <div class="col-md-6">
              <label class="form-label">Manufacture</label>
              <select name="manufacture_id" id="edit_manufacture_id"
                class="form-control form-control-premium select2">
                <option value="">Select Manufacture</option>
                @foreach($manufactureList as $manufacture)
                <option value="{{ $manufacture->id }}">{{ $manufacture->manufacture }}</option>
                @endforeach
              </select>
            </div>

            <div class="col-md-6">
              <label class="form-label-premium">Location </label>
              <select name="location" id="edit_location" class="form-control form-control-premium">
                <option value="">Select </option>
                <option value="In-House">In-House</option>
                <option value="Outward">Outward</option>
                <option value="3rd Party">3rd Party</option>
                <option value="3rd Party to Inhouse">3rd Party to Inhouse</option>
              </select>
            </div>

            <div class="col-md-6">
              <label class="form-label-premium"> Call Status</label>
              <select name="call_status" id="edit_call_status"
                class="form-control form-control-premium">
                <option value="">Select </option>
                <option value="Active">Active</option>
                <option value="Quote Sent">Quote Sent</option>
                <option value="Approval Pending">Approval Pending</option>
                <option value="Close">Close</option>
              </select>
            </div>

            <div class="col-md-6">
              <label class="form-label-premium"> Supplier</label>
              <select name="supplier_id" id="edit_supplier_id"
                class="form-control form-control-premium">
                <option value="">Select Supplier</option>
                @foreach($supplierList as $supplier)
                <option value="{{ $supplier->id }}">{{ $supplier->supplier_name }}</option>
                @endforeach
              </select>
            </div>

            <div class="col-md-6">
              <label class="form-label-premium">Inward Engineer</label>
              <select name="inward_engineer" id="edit_inward_engineer"
                class="form-control form-control-premium">
                <option value="">Select Engineer</option>
                @foreach($engineerList as $engineer)
                <option value="{{ $engineer->id }}">{{ $engineer->name }}</option>
                @endforeach
              </select>
            </div>

            <div class="col-md-6">
              <label class="form-label-premium">Outward Engineer</label>
              <select name="outward_engineer" id="edit_outward_engineer"
                class="form-control form-control-premium">
                <option value="">Select Engineer</option>
                @foreach($engineerList as $engineer)
                <option value="{{ $engineer->id }}">{{ $engineer->name }}</option>
                @endforeach
              </select>
            </div>

            <div class="col-md-6">
              <label class="form-label-premium">Inward TP Date</label>
              <input type="date" name="inward_tp_date" id="edit_inward_tp_date"
                class="form-control form-control-premium">
            </div>

            <div class="col-md-6">
              <label class="form-label-premium">Outward TP Date</label>
              <input type="date" name="outward_tp_date" id="edit_outward_tp_date"
                class="form-control form-control-premium">
            </div>

            <div class="col-md-6">
              <label class="form-label-premium">TP Inward Engineer</label>
              <select name="tp_inward_engineer" id="edit_tp_inward_engineer"
                class="form-control form-control-premium">
                <option value="">Select Engineer</option>
                @foreach($engineerList as $engineer)
                <option value="{{ $engineer->id }}">{{ $engineer->name }}</option>
                @endforeach
              </select>
            </div>

            <div class="col-md-6">
              <label class="form-label-premium">TP Outward Engineer</label>
              <select name="tp_outward_engineer" id="edit_tp_outward_engineer"
                class="form-control form-control-premium">
                <option value="">Select Engineer</option>
                @foreach($engineerList as $engineer)
                <option value="{{ $engineer->id }}">{{ $engineer->name }}</option>
                @endforeach
              </select>
            </div>

            <div class="col-md-6">
              <label class="form-label-premium">Serial No</label>
              <input type="text" name="serial_no" id="edit_serial_no"
                class="form-control form-control-premium">
            </div>

            <div class="col-md-12">
              <label>Third Party Description</label>
              <textarea id="edit_third_party_description" name="third_party_description" class="form-control"></textarea>
            </div>

            <div class="col-md-12">
              <label>Product Condition</label>
              <textarea id="edit_product_condition" name="product_condition" class="form-control"></textarea>
            </div>

            <div class="col-md-12">
              <label>Description</label>
              <textarea id="edit_description" name="description" class="form-control"></textarea>
            </div>

          </div>
        </div>

        <div class="d-flex justify-content-end p-4 border-top">
          <button type="submit" class="btn btn-primary-custom">Update</button>
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
  $(document).ready(function() {

    $('#company_id').on('change', function() {
      var companyID = $(this).val();

      if (companyID) {
        $.ajax({
          url: "{{ route('admin.product.inward.outward.get.customer.branch') }}",
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
          url: "{{ route('admin.product.inward.outward.get.customer.department') }}",
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
          url: "{{ route('admin.product.inward.outward.get.customer.department.product') }}",
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
                '<option value="' + value.product_id + '">' + value.amc_product + '</option>'
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

            // Refresh select2 after ajax
            $('#edit_branch_id').trigger('change');
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
          url: "{{ route('admin.product.inward.outward.get.customer.department') }}",
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
          url: "{{ route('admin.product.inward.outward.get.customer.department.product') }}",
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
                '<option value="' + value.product_id + '">' + value.amc_product + '</option>'
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
  $(document).on('click', '.edit', function() {
    var $el = $(this).find('a'); // get the <a> inside <li class="edit">

    $('#edit_id').val($el.data('id'));
    $('#edit_uuid').val($el.data('uuid'));

    let companyID = $el.data('company_id');
    let branchID = $el.data('branch_id');
    let departmentID = $el.data('department_id');
    let productID = $el.data('product_id');

    $('#edit_company_id').val($el.data('company_id')).trigger('change');
    $('#edit_branch_id').val($el.data('branch_id')).trigger('change');
    $('#edit_department_id').val($el.data('department_id')).trigger('change');
    $('#edit_product_id').val($el.data('product_id')).trigger('change');
    $('#edit_manufacture_id').val($el.data('manufacture_id')).trigger('change');
    $('#edit_supplier_id').val($el.data('supplier_id')).trigger('change');
    $('#edit_inward_engineer').val($el.data('inward_engineer')).trigger('change');
    $('#edit_outward_engineer').val($el.data('outward_engineer')).trigger('change');
    $('#edit_tp_inward_engineer').val($el.data('tp_inward_engineer')).trigger('change');
    $('#edit_tp_outward_engineer').val($el.data('tp_outward_engineer')).trigger('change');

    $('#edit_location').val($el.data('location'));
    $('#edit_call_status').val($el.data('call_status'));

    $('#edit_inward_tp_date').val($el.data('inward_tp_date'));
    $('#edit_outward_tp_date').val($el.data('outward_tp_date'));
    $('#edit_serial_no').val($el.data('serial_no'));

    $('#edit_third_party_description').val($el.data('third_party_description'));
    $('#edit_product_condition').val($el.data('product_condition'));
    $('#edit_description').val($el.data('description'));

    if (companyID) {
      $.ajax({
        url: "{{ route('admin.product.inward.outward.get.customer.branch') }}",
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
              '<option value="' + value.id + '" ' + (value.id == branchID ? 'selected' : '') + '>' + value.branch_name + '</option>'
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

    if (branchID) {
      $.ajax({
        url: "{{ route('admin.product.inward.outward.get.customer.department') }}",
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
    } else {
      $('#edit_department_id').empty()
        .append('<option value="">Select Department</option>');
    }

    
    if (departmentID) {
      $.ajax({
        url: "{{ route('admin.product.inward.outward.get.customer.department.product') }}",
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
              '<option value="' + value.id + '" ' + (value.product_id == productID ? 'selected' : '') + '>' + value.amc_product + '</option>'
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

    // Show the modal explicitly if needed
    $('#editProductInwardOutwardModal').modal('show');
});

</script>

<script>
  $(document).on('click', '.viewProductInwardOutward', function() {

    $('#v_product_io_no').text($(this).data('product_io_no'));
    $('#v_company_name').text($(this).data('company_name'));
    $('#v_call_status').text($(this).data('call_status'));

    $('#v_branch').text($(this).data('branch'));
    $('#v_department').text($(this).data('department'));
    $('#v_amc_product').text($(this).data('amc_product'));
    $('#v_manufacture').text($(this).data('manufacture'));
    $('#v_location').text($(this).data('location'));
    $('#v_serial_no').text($(this).data('serial_no'));

    $('#v_supplier_name').text($(this).data('supplier_name'));

    $('#v_inward_engineer_name').text($(this).data('inward_engineer_name'));
    $('#v_outward_engineer_name').text($(this).data('outward_engineer_name'));
    $('#v_tp_inward_engineer_name').text($(this).data('tp_inward_engineer_name'));
    $('#v_tp_outward_engineer_name').text($(this).data('tp_outward_engineer_name'));

    $('#v_inward_tp_date').text($(this).data('inward_tp_date'));
    $('#v_outward_tp_date').text($(this).data('outward_tp_date'));

    $('#v_product_condition').text($(this).data('product_condition'));
    $('#v_third_party_description').text($(this).data('third_party_description'));
    $('#v_description').text($(this).data('description'));


  });
</script>

@endpush