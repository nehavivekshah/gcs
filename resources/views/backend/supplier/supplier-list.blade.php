@extends('backend.common.master')

@section('main-section')
  <div class="container-fluid">
    <div class="page-title">
      <div class="row">
        <div class="col-6">
          <h4>Supplier List</h4>
        </div>
        <div class="col-6">
          <ol class="breadcrumb justify-content-end">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
            <li class="breadcrumb-item active">Supplier List</li>
            <button type="button" class="btn btn-primary-custom ms-3" data-bs-toggle="modal"
              data-bs-target="#addSupplierModal">
              <i class="fa fa-plus me-1"></i> Add Supplier
            </button>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <!-- Container-fluid starts-->
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <div class="card card-premium">
          <div class="card-body">
            <div class="table-responsive custom-scrollbar">
              <table class="display table-premium" id="supplier-table">
                <thead>
                  <tr>
                    <th>Sr.no</th>
                    <th>Name</th>
                    <th>Mobile</th>
                    <th>Contact Person</th>
                    <th>Email</th>
                    <th width="250" class="text-center">Action</th>
                  </tr>
                </thead>
                <tbody>
                  @php $i = 0; @endphp
                  @foreach($supplierList as $suppliers)
                    @php $i++; @endphp
                    <tr>
                      <td>{{ $i }}</td>
                      <td class="fw-medium">{{ $suppliers->supplier_name }}</td>
                      <td>{{ $suppliers->mobile_no }}</td>
                      <td>{{ $suppliers->contact_person }}</td>
                      <td>{{ $suppliers->email }}</td>
                      <td class="text-center">
                        <div class="d-flex justify-content-center align-items-center gap-2">
                          <button type="button" class="btn btn-sm-custom btn-outline-primary viewBranchBtn"
                            data-supplier-id="{{ $suppliers->id }}" data-supplier-uuid="{{ $suppliers->uuid }}"
                            data-supplier-name="{{ $suppliers->supplier_name }}">
                            Branch
                          </button>
                          <button type="button" class="btn btn-sm-custom btn-outline-primary viewContactBtn"
                            data-supplier-id="{{ $suppliers->id }}" data-supplier-uuid="{{ $suppliers->uuid }}"
                            data-supplier-name="{{ $suppliers->supplier_name }}">
                            Contact
                          </button>
                          <a href="javascript:void(0);" class="btn btn-sm-custom btn-outline-dark viewSupplierBtn"
                            data-supplier="{{ json_encode($suppliers) }}" data-bs-toggle="tooltip" title="View">
                            <i class="icon-eye"></i>
                          </a>
                          <a href="javascript:void(0);" class="btn btn-sm-custom btn-outline-dark editSupplierBtn"
                            data-supplier="{{ json_encode($suppliers) }}" data-bs-toggle="tooltip" title="Edit">
                            <i class="icon-pencil-alt"></i>
                          </a>
                          <a href="{{ route('admin.supplier.delete', ['uuid' => $suppliers->uuid]) }}"
                            class="btn btn-sm-custom btn-outline-dark" data-bs-toggle="tooltip" title="Delete"
                            onclick="return confirm('Are you sure you want to delete this record?');">
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

  <!-- Add Supplier Modal -->
  <div class="modal fade" id="addSupplierModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
      <div class="modal-content modal-content-premium">
        <div class="modal-header modal-header-premium">
          <h5 class="modal-title modal-title-premium text-white">Add Supplier</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <form action="{{ route('admin.supplier.store') }}" method="POST" class="needs-validation" novalidate>
          @csrf
          <div class="modal-body p-4">
            <div class="row g-3">
              <div class="col-md-4">
                <label class="form-label-premium">Supplier Name <span class="text-danger">*</span></label>
                <input type="text" name="supplier_name" class="form-control form-control-premium" required>
              </div>
              <div class="col-md-4">
                <label class="form-label-premium">Mobile No <span class="text-danger">*</span></label>
                <input type="text" name="mobile_no" class="form-control form-control-premium" required>
              </div>
              <div class="col-md-4">
                <label class="form-label-premium">Contact Person <span class="text-danger">*</span></label>
                <input type="text" name="contact_person" class="form-control form-control-premium" required>
              </div>
              <div class="col-md-4">
                <label class="form-label-premium">Email</label>
                <input type="email" name="email" class="form-control form-control-premium">
              </div>
              <div class="col-md-4">
                <label class="form-label-premium">Phone 1</label>
                <input type="text" name="phone_1" class="form-control form-control-premium">
              </div>
              <div class="col-md-4">
                <label class="form-label-premium">Phone 2</label>
                <input type="text" name="phone_2" class="form-control form-control-premium">
              </div>
              <div class="col-md-6">
                <label class="form-label-premium">Address Line 1</label>
                <input type="text" name="address_line_1" class="form-control form-control-premium">
              </div>
              <div class="col-md-6">
                <label class="form-label-premium">Address Line 2</label>
                <input type="text" name="address_line_2" class="form-control form-control-premium">
              </div>
              <div class="col-md-4">
                <label class="form-label-premium">Area <span class="text-danger">*</span></label>
                <select name="area_id" id="add_area_id" class="select2-modal" required>
                  <option value="">Select Area</option>
                  @foreach($areaList as $area)
                    <option value="{{ $area->id }}">{{ $area->area }}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-md-4">
                <label class="form-label-premium">City</label>
                <select name="city_id" id="add_city_id" class="select2-modal" required>
                  <option value="">Select City</option>
                </select>
              </div>
              <div class="col-md-4">
                <label class="form-label-premium">State</label>
                <select name="state_id" id="add_state_id" class="select2-modal" required>
                  <option value="">Select State</option>
                </select>
              </div>
              <div class="col-md-3">
                <label class="form-label-premium">Pincode</label>
                <input type="text" name="pincode" class="form-control form-control-premium">
              </div>
              <div class="col-md-3">
                <label class="form-label-premium">PAN</label>
                <input type="text" name="pan" class="form-control form-control-premium">
              </div>
              <div class="col-md-3">
                <label class="form-label-premium">GST</label>
                <input type="text" name="gst" class="form-control form-control-premium">
              </div>
              <div class="col-md-3">
                <label class="form-label-premium">Website</label>
                <input type="text" name="web_sites" class="form-control form-control-premium">
              </div>
            </div>
          </div>
          <div class="modal-footer border-0 p-4 pt-0">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary-custom">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Edit Supplier Modal -->
  <div class="modal fade" id="editSupplierModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
      <div class="modal-content modal-content-premium">
        <div class="modal-header modal-header-premium">
          <h5 class="modal-title modal-title-premium text-white">Edit Supplier</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <form id="editSupplierForm" method="POST" class="needs-validation" novalidate>
          @csrf
          @method('PATCH')
          <div class="modal-body p-4">
            <div class="row g-3">
              <div class="col-md-4">
                <label class="form-label-premium">Supplier Name <span class="text-danger">*</span></label>
                <input type="text" name="supplier_name" id="edit_supplier_name" class="form-control form-control-premium"
                  required>
              </div>
              <div class="col-md-4">
                <label class="form-label-premium">Mobile No <span class="text-danger">*</span></label>
                <input type="text" name="mobile_no" id="edit_mobile_no" class="form-control form-control-premium"
                  required>
              </div>
              <div class="col-md-4">
                <label class="form-label-premium">Contact Person <span class="text-danger">*</span></label>
                <input type="text" name="contact_person" id="edit_contact_person"
                  class="form-control form-control-premium" required>
              </div>
              <div class="col-md-4">
                <label class="form-label-premium">Email</label>
                <input type="email" name="email" id="edit_email" class="form-control form-control-premium">
              </div>
              <div class="col-md-4">
                <label class="form-label-premium">Phone 1</label>
                <input type="text" name="phone_1" id="edit_phone_1" class="form-control form-control-premium">
              </div>
              <div class="col-md-4">
                <label class="form-label-premium">Phone 2</label>
                <input type="text" name="phone_2" id="edit_phone_2" class="form-control form-control-premium">
              </div>
              <div class="col-md-6">
                <label class="form-label-premium">Address Line 1</label>
                <input type="text" name="address_line_1" id="edit_address_line_1"
                  class="form-control form-control-premium">
              </div>
              <div class="col-md-6">
                <label class="form-label-premium">Address Line 2</label>
                <input type="text" name="address_line_2" id="edit_address_line_2"
                  class="form-control form-control-premium">
              </div>
              <div class="col-md-4">
                <label class="form-label-premium">Area <span class="text-danger">*</span></label>
                <select name="area_id" id="edit_area_id" class="select2-modal" required>
                  <option value="">Select Area</option>
                  @foreach($areaList as $area)
                    <option value="{{ $area->id }}">{{ $area->area }}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-md-4">
                <label class="form-label-premium">City</label>
                <select name="city_id" id="edit_city_id" class="select2-modal" required>
                  <option value="">Select City</option>
                </select>
              </div>
              <div class="col-md-4">
                <label class="form-label-premium">State</label>
                <select name="state_id" id="edit_state_id" class="select2-modal" required>
                  <option value="">Select State</option>
                </select>
              </div>
              <div class="col-md-3">
                <label class="form-label-premium">Pincode</label>
                <input type="text" name="pincode" id="edit_pincode" class="form-control form-control-premium">
              </div>
              <div class="col-md-3">
                <label class="form-label-premium">PAN</label>
                <input type="text" name="pan" id="edit_pan" class="form-control form-control-premium">
              </div>
              <div class="col-md-3">
                <label class="form-label-premium">GST</label>
                <input type="text" name="gst" id="edit_gst" class="form-control form-control-premium">
              </div>
              <div class="col-md-3">
                <label class="form-label-premium">Website</label>
                <input type="text" name="web_sites" id="edit_web_sites" class="form-control form-control-premium">
              </div>
            </div>
          </div>
          <div class="modal-footer border-0 p-4 pt-0">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary-custom">Update</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- View Supplier Modal -->
  <div class="modal fade" id="viewSupplierModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content modal-content-premium">
        <div class="modal-header modal-header-premium">
          <h5 class="modal-title modal-title-premium text-white">Supplier Details</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body p-4">
          <div class="row g-4">
            <div class="col-md-6 border-end">
              <h6 class="section-title mb-3">Basic Information</h6>
              <div class="mb-2"><strong>Name:</strong> <span id="v_supplier_name"></span></div>
              <div class="mb-2"><strong>Mobile:</strong> <span id="v_mobile_no"></span></div>
              <div class="mb-2"><strong>Contact Person:</strong> <span id="v_contact_person"></span></div>
              <div class="mb-2"><strong>Email:</strong> <span id="v_email"></span></div>
              <div class="mb-2"><strong>Phone 1:</strong> <span id="v_phone_1"></span></div>
              <div class="mb-2"><strong>Phone 2:</strong> <span id="v_phone_2"></span></div>
            </div>
            <div class="col-md-6">
              <h6 class="section-title mb-3">Address & Tax Details</h6>
              <div class="mb-2"><strong>Address:</strong> <span id="v_address"></span></div>
              <div class="mb-2"><strong>Area:</strong> <span id="v_area_name"></span></div>
              <div class="mb-2"><strong>City:</strong> <span id="v_city_name"></span></div>
              <div class="mb-2"><strong>State:</strong> <span id="v_state_name"></span></div>
              <div class="mb-2"><strong>GST:</strong> <span id="v_gst"></span></div>
              <div class="mb-2"><strong>PAN:</strong> <span id="v_pan"></span></div>
              <div class="mb-2"><strong>Website:</strong> <span id="v_web_sites"></span></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Branch List Modal -->
  <div class="modal fade" id="branchModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
      <div class="modal-content modal-content-premium">
        <div class="modal-header modal-header-premium">
          <h5 class="modal-title modal-title-premium text-white">Branches: <span id="branchSupplierName"></span></h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body p-4">
          <div class="d-flex justify-content-between align-items-center mb-3">
            <h6 class="mb-0 fw-bold">Branch List</h6>
            <button class="btn btn-sm btn-primary-custom" id="addBranchBtn">
              <i class="fa fa-plus me-1"></i> Add Branch
            </button>
          </div>
          <div class="table-responsive custom-scrollbar">
            <table class="table table-premium" id="branchTable">
              <thead>
                <tr>
                  <th>Sr.no</th>
                  <th>Branch Name</th>
                  <th>Area</th>
                  <th>City</th>
                  <th>Phone</th>
                  <th>Address</th>
                  <th width="100" class="text-center">Action</th>
                </tr>
              </thead>
              <tbody></tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Add Branch Modal -->
  <div class="modal fade" id="addBranchModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content modal-content-premium shadow-lg">
        <div class="modal-header modal-header-premium">
          <h5 class="modal-title modal-title-premium text-white">Add Branch: <span id="addbranchSupplierName"></span></h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" data-bs-target="#branchModal"
            data-bs-toggle="modal"></button>
        </div>
        <div class="modal-body p-4">
          <form id="addBranchForm" method="POST" action="{{ route('admin.supplier.add.branch') }}">
            @csrf
            <input type="hidden" name="supplier_id" id="branch_supplier_id">
            <input type="hidden" name="supplier_uuid" id="branch_supplier_uuid">
            <div class="row g-3">
              <div class="col-md-6">
                <label class="form-label-premium">Branch Name <span class="text-danger">*</span></label>
                <input type="text" name="branch_name" class="form-control form-control-premium" required>
              </div>
              <div class="col-md-6">
                <label class="form-label-premium">Area <span class="text-danger">*</span></label>
                <select name="area_id" id="branch_add_area_id" class="select2-modal" required>
                  <option value="">Select Area</option>
                  @foreach($areaList as $area)
                    <option value="{{ $area->id }}">{{ $area->area }}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-md-6">
                <label class="form-label-premium">City</label>
                <select name="city_id" id="branch_add_city_id" class="select2-modal" required>
                  <option value="">Select City</option>
                </select>
              </div>
              <div class="col-md-6">
                <label class="form-label-premium">State</label>
                <select name="state_id" id="branch_add_state_id" class="select2-modal" required>
                  <option value="">Select State</option>
                </select>
              </div>
              <div class="col-md-6">
                <label class="form-label-premium">Phone</label>
                <input type="text" name="phone_no" class="form-control form-control-premium">
              </div>
              <div class="col-md-6">
                <label class="form-label-premium">Pincode</label>
                <input type="text" name="pincode" class="form-control form-control-premium">
              </div>
              <div class="col-md-12">
                <label class="form-label-premium">Address</label>
                <textarea name="address_line_1" class="form-control form-control-premium" rows="2"></textarea>
              </div>
            </div>
            <div class="mt-4 text-end">
              <button type="button" class="btn btn-secondary me-2" data-bs-target="#branchModal"
                data-bs-toggle="modal">Back</button>
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
      <div class="modal-content modal-content-premium shadow-lg">
        <div class="modal-header modal-header-premium">
          <h5 class="modal-title modal-title-premium text-white">Edit Branch</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" data-bs-target="#branchModal"
            data-bs-toggle="modal"></button>
        </div>
        <div class="modal-body p-4">
          <form id="editBranchForm" method="POST" action="{{ route('admin.supplier.edit.supplier.branch') }}">
            @csrf
            <input type="hidden" name="branch_id" id="edit_branch_id">
            <div class="row g-3">
              <div class="col-md-6">
                <label class="form-label-premium">Branch Name <span class="text-danger">*</span></label>
                <input type="text" name="branch_name" id="eb_branch_name" class="form-control form-control-premium"
                  required>
              </div>
              <div class="col-md-6">
                <label class="form-label-premium">Area <span class="text-danger">*</span></label>
                <select name="area_id" id="branch_edit_area_id" class="select2-modal" required>
                  <option value="">Select Area</option>
                  @foreach($areaList as $area)
                    <option value="{{ $area->id }}">{{ $area->area }}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-md-6">
                <label class="form-label-premium">City</label>
                <select name="city_id" id="branch_edit_city_id" class="select2-modal" required>
                  <option value="">Select City</option>
                </select>
              </div>
              <div class="col-md-6">
                <label class="form-label-premium">State</label>
                <select name="state_id" id="branch_edit_state_id" class="select2-modal" required>
                  <option value="">Select State</option>
                </select>
              </div>
              <div class="col-md-6">
                <label class="form-label-premium">Phone</label>
                <input type="text" name="phone_no" id="eb_phone_no" class="form-control form-control-premium">
              </div>
              <div class="col-md-6">
                <label class="form-label-premium">Pincode</label>
                <input type="text" name="pincode" id="eb_pincode" class="form-control form-control-premium">
              </div>
              <div class="col-md-12">
                <label class="form-label-premium">Address</label>
                <textarea name="address_line_1" id="eb_address_line_1" class="form-control form-control-premium"
                  rows="2"></textarea>
              </div>
            </div>
            <div class="mt-4 text-end">
              <button type="button" class="btn btn-secondary me-2" data-bs-target="#branchModal"
                data-bs-toggle="modal">Back</button>
              <button type="submit" class="btn btn-primary-custom">Update Branch</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Contact List Modal -->
  <div class="modal fade" id="contactModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content modal-content-premium">
        <div class="modal-header modal-header-premium">
          <h5 class="modal-title modal-title-premium text-white">Contacts: <span id="contactSupplierName"></span></h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body p-4">
          <div class="d-flex justify-content-between align-items-center mb-3">
            <h6 class="mb-0 fw-bold">Contact List</h6>
            <button class="btn btn-sm btn-primary-custom" id="addContactBtn">
              <i class="fa fa-plus me-1"></i> Add Contact
            </button>
          </div>
          <div class="table-responsive custom-scrollbar">
            <table class="table table-premium" id="contactTable">
              <thead>
                <tr>
                  <th>Sr.no</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Department</th>
                  <th>Phone</th>
                  <th width="100" class="text-center">Action</th>
                </tr>
              </thead>
              <tbody></tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Add Contact Modal -->
  <div class="modal fade" id="addContactModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
      <div class="modal-content modal-content-premium shadow-lg">
        <div class="modal-header modal-header-premium">
          <h5 class="modal-title modal-title-premium text-white">Add Contact: <span id="addcontactSupplierName"></span>
          </h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" data-bs-target="#contactModal"
            data-bs-toggle="modal"></button>
        </div>
        <div class="modal-body p-4">
          <form method="POST" action="{{ route('admin.supplier.add.contact') }}">
            @csrf
            <input type="hidden" name="supplier_id" id="contact_supplier_id">
            <div class="mb-3">
              <label class="form-label-premium">Name <span class="text-danger">*</span></label>
              <input type="text" name="contact_name" class="form-control form-control-premium" required>
            </div>
            <div class="mb-3">
              <label class="form-label-premium">Email</label>
              <input type="email" name="email" class="form-control form-control-premium">
            </div>
            <div class="mb-3">
              <label class="form-label-premium">Department</label>
              <input type="text" name="department" class="form-control form-control-premium">
            </div>
            <div class="mb-3">
              <label class="form-label-premium">Phone</label>
              <input type="text" name="phone_no" class="form-control form-control-premium">
            </div>
            <div class="mt-4 text-end">
              <button type="button" class="btn btn-secondary me-2" data-bs-target="#contactModal"
                data-bs-toggle="modal">Back</button>
              <button type="submit" class="btn btn-primary-custom">Save Contact</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Edit Contact Modal -->
  <div class="modal fade" id="editContactModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
      <div class="modal-content modal-content-premium shadow-lg">
        <div class="modal-header modal-header-premium">
          <h5 class="modal-title modal-title-premium text-white">Edit Contact</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" data-bs-target="#contactModal"
            data-bs-toggle="modal"></button>
        </div>
        <div class="modal-body p-4">
          <form id="editContactForm" method="POST" action="{{ route('admin.supplier.edit.supplier.contact') }}">
            @csrf
            <input type="hidden" name="contact_id" id="edit_contact_id">
            <div class="mb-3">
              <label class="form-label-premium">Name <span class="text-danger">*</span></label>
              <input type="text" name="contact_name" id="ec_contact_name" class="form-control form-control-premium"
                required>
            </div>
            <div class="mb-3">
              <label class="form-label-premium">Email</label>
              <input type="email" name="email" id="ec_contact_email" class="form-control form-control-premium">
            </div>
            <div class="mb-3">
              <label class="form-label-premium">Department</label>
              <input type="text" name="department" id="ec_contact_department" class="form-control form-control-premium">
            </div>
            <div class="mb-3">
              <label class="form-label-premium">Phone</label>
              <input type="text" name="phone_no" id="ec_contact_phone" class="form-control form-control-premium">
            </div>
            <div class="mt-4 text-end">
              <button type="button" class="btn btn-secondary me-2" data-bs-target="#contactModal"
                data-bs-toggle="modal">Back</button>
              <button type="submit" class="btn btn-primary-custom">Update Contact</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

@endsection

@push('css')
  <link rel="stylesheet" href="{{ asset('public/assets/css/vendors/select2.css') }}">
  <style>
    .select2-container--open {
      z-index: 9999999 !important;
    }
  </style>
@endpush

@push('scripts')
  <script src="{{ asset('public/assets/js/select2/select2.full.min.js') }}"></script>
  <script>
    $(document).ready(function () {
      // Initialize DataTable
      if ($.fn.DataTable.isDataTable('#supplier-table')) {
        $('#supplier-table').DataTable().destroy();
      }
      $('#supplier-table').DataTable({
        dom: 'Bfrtip',
        buttons: [{
          extend: 'excelHtml5',
          text: '<i class="fa fa-file-excel-o"></i> Excel',
          className: 'btn btn-sm btn-outline-success mb-3'
        }]
      });

      // Initialize Select2 for modals
      function initSelect2() {
        $('.select2-modal').each(function () {
          $(this).select2({
            dropdownParent: $(this).closest('.modal'),
            placeholder: 'Select an option',
            width: '100%'
          });
        });
      }
      initSelect2();

      // AREA -> CITY/STATE Dependency
      function fetchLocation(areaId, citySelector, stateSelector) {
        if (!areaId) {
          $(citySelector).empty().append('<option value="">Select City</option>').trigger('change');
          $(stateSelector).empty().append('<option value="">Select State</option>').trigger('change');
          return;
        }
        $.ajax({
          url: "{{ route('admin.supplier.area.city') }}",
          type: "POST",
          data: {
            areaID: areaId,
            _token: "{{ csrf_token() }}"
          },
          dataType: "json",
          success: function (res) {
            if (res.status) {
              $(citySelector).html(`<option value="${res.city.id}">${res.city.name}</option>`).trigger('change');
              $(stateSelector).html(`<option value="${res.state.id}">${res.state.name}</option>`).trigger('change');
            }
          }
        });
      }

      $('#add_area_id').on('change', function () { fetchLocation($(this).val(), '#add_city_id', '#add_state_id'); });
      $('#edit_area_id').on('change', function () { fetchLocation($(this).val(), '#edit_city_id', '#edit_state_id'); });
      $('#branch_add_area_id').on('change', function () { fetchLocation($(this).val(), '#branch_add_city_id', '#branch_add_state_id'); });
      $('#branch_edit_area_id').on('change', function () { fetchLocation($(this).val(), '#branch_edit_city_id', '#branch_edit_state_id'); });

      // Handle View
      $('.viewSupplierBtn').on('click', function () {
        const s = $(this).data('supplier');
        $('#v_supplier_name').text(s.supplier_name);
        $('#v_mobile_no').text(s.mobile_no);
        $('#v_contact_person').text(s.contact_person);
        $('#v_email').text(s.email || '-');
        $('#v_phone_1').text(s.phone_1 || '-');
        $('#v_phone_2').text(s.phone_2 || '-');
        $('#v_address').text(`${s.address_line_1 || ''} ${s.address_line_2 || ''} ${s.pincode ? '(Pin: ' + s.pincode + ')' : ''}`);
        $('#v_area_name').text(s.area_name || '-');
        $('#v_city_name').text(s.city_name || '-');
        $('#v_state_name').text(s.state_name || '-');
        $('#v_gst').text(s.gst || '-');
        $('#v_pan').text(s.pan || '-');
        $('#v_web_sites').text(s.web_sites || '-');
        $('#viewSupplierModal').modal('show');
      });

      // Handle Edit
      $('.editSupplierBtn').on('click', function () {
        const s = $(this).data('supplier');
        $('#edit_supplier_name').val(s.supplier_name);
        $('#edit_mobile_no').val(s.mobile_no);
        $('#edit_contact_person').val(s.contact_person);
        $('#edit_email').val(s.email);
        $('#edit_phone_1').val(s.phone_1);
        $('#edit_phone_2').val(s.phone_2);
        $('#edit_address_line_1').val(s.address_line_1);
        $('#edit_address_line_2').val(s.address_line_2);
        $('#edit_area_id').val(s.area_id).trigger('change');
        $('#edit_pincode').val(s.pincode);
        $('#edit_pan').val(s.pan);
        $('#edit_gst').val(s.gst);
        $('#edit_web_sites').val(s.web_sites);

        let updateUrl = "{{ route('admin.supplier.update', ['uuid' => ':uuid']) }}";
        $('#editSupplierForm').attr('action', updateUrl.replace(':uuid', s.uuid));
        $('#editSupplierModal').modal('show');
      });

      // BRANCH LOGIC
      $(document).on('click', '.viewBranchBtn', function () {
        const d = $(this).data();
        $('#branchSupplierName, #addbranchSupplierName, #editbranchSupplierName').text(d.supplierName);
        $('#branch_supplier_id').val(d.supplierId);
        $('#branch_supplier_uuid').val(d.supplierUuid);
        loadBranches(d.supplierId);
        $('#branchModal').modal('show');
      });

      function loadBranches(supplierId) {
        $('#branchTable tbody').html('<tr><td colspan="7" class="text-center">Loading...</td></tr>');
        $.post("{{ route('admin.supplier.get.supplier.branch') }}", { supplier_id: supplierId, _token: "{{ csrf_token() }}" }, function (res) {
          let html = '';
          if (res.length > 0) {
            res.forEach((b, i) => {
              html += `<tr>
                  <td>${i + 1}</td>
                  <td>${b.branch_name || '-'}</td>
                  <td>${b.area_name || '-'}</td>
                  <td>${b.city_name || '-'}</td>
                  <td>${b.phone_no || '-'}</td>
                  <td>${b.address_line_1 || ''}</td>
                  <td class="text-center">
                    <div class="d-flex justify-content-center gap-2">
                      <a href="javascript:void(0)" class="text-primary editBranchBtn" data-branch='${JSON.stringify(b)}'><i class="icon-pencil-alt"></i></a>
                      <a href="javascript:void(0)" class="text-danger deleteBranchBtn" data-uuid="${b.uuid}"><i class="icon-trash"></i></a>
                    </div>
                  </td>
                </tr>`;
            });
          } else {
            html = '<tr><td colspan="7" class="text-center text-muted">No Branch Found</td></tr>';
          }
          $('#branchTable tbody').html(html);
        });
      }

      $(document).on('click', '#addBranchBtn', function () { $('#branchModal').modal('hide'); $('#addBranchModal').modal('show'); });
      $(document).on('click', '.editBranchBtn', function () {
        const b = $(this).data('branch');
        $('#edit_branch_id').val(b.id);
        $('#eb_branch_name').val(b.branch_name);
        $('#branch_edit_area_id').val(b.area_id).trigger('change');
        $('#eb_phone_no').val(b.phone_no);
        $('#eb_pincode').val(b.pincode);
        $('#eb_address_line_1').val(b.address_line_1);
        $('#editBranchModal').modal('show');
        $('#branchModal').modal('hide');
      });
      $(document).on('click', '.deleteBranchBtn', function () {
        if (confirm('Delete this branch?')) window.location.href = "{{ url('admin/supplier/delete-supplier-branch') }}/" + $(this).data('uuid');
      });

      // CONTACT LOGIC
      $(document).on('click', '.viewContactBtn', function () {
        const d = $(this).data();
        $('#contactSupplierName, #addcontactSupplierName, #editcontactSupplierName').text(d.supplierName);
        $('#contact_supplier_id').val(d.supplierId);
        loadContacts(d.supplierId);
        $('#contactModal').modal('show');
      });

      function loadContacts(supplierId) {
        $('#contactTable tbody').html('<tr><td colspan="6" class="text-center">Loading...</td></tr>');
        $.post("{{ route('admin.supplier.get.supplier.contact') }}", { supplier_id: supplierId, _token: "{{ csrf_token() }}" }, function (res) {
          let html = '';
          if (res.length > 0) {
            res.forEach((c, i) => {
              html += `<tr>
                  <td>${i + 1}</td>
                  <td>${c.contact_name || '-'}</td>
                  <td>${c.email || '-'}</td>
                  <td>${c.department || '-'}</td>
                  <td>${c.phone_no || '-'}</td>
                  <td class="text-center">
                    <div class="d-flex justify-content-center gap-2">
                      <a href="javascript:void(0)" class="text-primary editContactBtn" data-contact='${JSON.stringify(c)}'><i class="icon-pencil-alt"></i></a>
                      <a href="javascript:void(0)" class="text-danger deleteContactBtn" data-uuid="${c.uuid}"><i class="icon-trash"></i></a>
                    </div>
                  </td>
                </tr>`;
            });
          } else {
            html = '<tr><td colspan="6" class="text-center text-muted">No Contact Found</td></tr>';
          }
          $('#contactTable tbody').html(html);
        });
      }

      $(document).on('click', '#addContactBtn', function () { $('#contactModal').modal('hide'); $('#addContactModal').modal('show'); });
      $(document).on('click', '.editContactBtn', function () {
        const c = $(this).data('contact');
        $('#edit_contact_id').val(c.id);
        $('#ec_contact_name').val(c.contact_name);
        $('#ec_contact_email').val(c.email);
        $('#ec_contact_department').val(c.department);
        $('#ec_contact_phone').val(c.phone_no);
        $('#editContactModal').modal('show');
        $('#contactModal').modal('hide');
      });
      $(document).on('click', '.deleteContactBtn', function () {
        if (confirm('Delete this contact?')) window.location.href = "{{ url('admin/supplier/delete-supplier-contact') }}/" + $(this).data('uuid');
      });
    });
  </script>
@endpush