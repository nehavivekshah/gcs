@extends('backend.common.master')

@push('styles')
  <style>
    /* ===============================
     ALL FORM INPUT TEXT COLOR BLACK
     =============================== */

    /* Text inputs, textarea */
    input,
    textarea {
      color: #000 !important;
    }

    /* Normal select dropdown */
    select {
      color: #000 !important;
    }

    /* Placeholder color */
    ::placeholder {
      color: #000 !important;
      opacity: 1;
    }

    /* Select2 selected value */
    .select2-container--default .select2-selection--single {
      color: #000 !important;
    }

    /* Select2 dropdown options */
    .select2-container--default .select2-results__option {
      color: #000 !important;
    }

    /* Select2 highlighted option */
    .select2-container--default .select2-results__option--highlighted {
      color: #000 !important;
      background-color: #e9ecef !important;
    }

    /* Select2 dropdown background */
    .select2-dropdown {
      background-color: #fff !important;
    }

    /* Disabled inputs */
    input:disabled,
    select:disabled,
    textarea:disabled {
      color: #000 !important;
    }

    /* Validation text color fix */
    .was-validated .form-control:invalid,
    .form-control.is-invalid {
      color: #000 !important;
    }
  </style>
@endpush

@section('main-section')
  <div class="container-fluid">
    <div class="page-title">
      <div class="row">
        <div class="col-6">
          <h4> Supplier List</h4>
        </div>
        <div class="col-6">
          <ol class="breadcrumb">
            <a href="{{ route('admin.supplier.create') }}">
              <button type="button" class="btn btn-lg" data-bs-toggle="tooltip" title="Add Supplier"
                style="background:#bf0103;color:white;">Add Supplier</button>
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
        <div class="card">

          <div class="card-body">
            <div class="table-responsive custom-scrollbar">
              <table class="display" id="basic-1">
                <thead>
                  <tr>
                    <th>Sr.no</th>
                    <th>Name</th>
                    <th>Mobile</th>
                    <th>Contact Person</th>
                    <th>Email</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @php $i = 0; @endphp
                  @foreach($supplierList as $suppliers)
                    @php $i++; @endphp
                    <tr>
                      <td> {{ $i }} </td>
                      <td> {{ $suppliers->supplier_name}} </td>
                      <td> {{ $suppliers->mobile_no}} </td>
                      <td> {{ $suppliers->contact_person}} </td>
                      <td> {{ $suppliers->email}} </td>
                      <td class="text-center">
                        <ul
                          style="display:flex;align-items:center;gap:8px;padding:0;margin:0;list-style:none;justify-content:center;">

                          <!-- BRANCH BUTTON -->
                          <li>
                            <button type="button" class="btn btn-sm viewBranchBtn"
                              style="background:#bf0103;color:#fff;border:none;" data-supplier-id="{{ $suppliers->id }}"
                              data-supplier-uuid="{{ $suppliers->uuid }}"
                              data-supplier-name="{{ $suppliers->supplier_name }}">
                              Branch
                            </button>
                          </li>

                          <!-- CONTACT BUTTON -->
                          <li>
                            <button type="button" class="btn btn-sm viewContactBtn"
                              style="background:#bf0103;color:#fff;border:none;" data-supplier-id="{{ $suppliers->id }}"
                              data-supplier-uuid="{{ $suppliers->uuid }}"
                              data-supplier-name="{{ $suppliers->supplier_name }}">
                              Contact
                            </button>
                          </li>

                          <!-- 3 DOT VERTICAL DROPDOWN -->
                          <li class="dropdown" style="position:relative;">
                            <a href="javascript:void(0)" data-bs-toggle="dropdown" style="text-decoration:none;color:#000;">

                              <!-- Vertical dots -->
                              <i class="icon-more" style="font-size:18px;display:inline-block;transform:rotate(90deg);">
                              </i>
                            </a>

                            <ul class="dropdown-menu dropdown-menu-end" style="min-width:100px;">

                              <!-- VIEW -->
                              <li>
                                <a class="dropdown-item viewSupplier" href="javascript:void(0)"
                                  style="color:#000;font-weight:600;" data-id="{{ $suppliers->id }}"
                                  data-uuid="{{ $suppliers->uuid }}" data-supplier_name="{{ $suppliers->supplier_name }}"
                                  data-mobile_no="{{ $suppliers->mobile_no }}"
                                  data-contact_person="{{ $suppliers->contact_person }}"
                                  data-email="{{ $suppliers->email }}"
                                  data-address_line_1="{{ $suppliers->address_line_1 }}"
                                  data-address_line_2="{{ $suppliers->address_line_2 }}"
                                  data-state_name="{{ $suppliers->state_name }}"
                                  data-city_name="{{ $suppliers->city_name }}" data-area_name="{{ $suppliers->area_name }}"
                                  data-web_sites="{{ $suppliers->web_sites }}" data-gst="{{ $suppliers->gst }}"
                                  data-cst="{{ $suppliers->cst }}" data-vat="{{ $suppliers->vat }}"
                                  data-pan="{{ $suppliers->pan }}" data-tin="{{ $suppliers->tin }}"
                                  data-pincode="{{ $suppliers->pincode }}" data-phone_1="{{ $suppliers->phone_1 }}"
                                  data-phone_2="{{ $suppliers->phone_2 }}" data-fax="{{ $suppliers->fax }}">
                                  <i class="icon-eye me-1"></i> View
                                </a>
                              </li>

                              <!-- EDIT -->
                              <li>
                                <a class="dropdown-item"
                                  href="{{ route('admin.supplier.edit', ['uuid' => $suppliers->uuid]) }}"
                                  style="color:#000;font-weight:600;">
                                  <i class="icon-pencil-alt me-1"></i> Edit
                                </a>
                              </li>

                              <!-- DELETE -->
                              <li>
                                <a class="dropdown-item"
                                  href="{{ route('admin.supplier.delete', ['uuid' => $suppliers->uuid]) }}"
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

  <!-- Contact Details -->

  <!-- Contact List Modal -->
  <div class="modal fade" id="contactModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">

        <div class="modal-header" style="background:#bf0103;">
          <h5 class="modal-title text-white">
            Contacts of <span id="contactSupplierName"></span>
          </h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body">

          <div class="d-flex justify-content-between mb-3">
            <h6 class="mb-0">Contact List</h6>
            <button class="btn btn-sm" id="addContactBtn" style="background:#bf0103;color:white;">
              Add Contact
            </button>
          </div>

          <div class="table-responsive">
            <table class="table table-bordered table-striped" id="contactTable">
              <thead>
                <tr>
                  <th>Sr.no</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Department</th>
                  <th>Phone</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody></tbody>
            </table>
          </div>

        </div>
      </div>
    </div>
  </div>


  <!-- Add Contact -->

  <!-- Add Contact Modal -->
  <div class="modal fade" id="addContactModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
      <div class="modal-content">

        <div class="modal-header" style="background:#bf0103;">
          <h5 class="modal-title text-white">Add Contact <span id="addcontactSupplierName"></span></h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body">
          <form method="post" action="{{ route('admin.supplier.add.contact') }}">
            @csrf

            <input type="hidden" name="supplier_id" id="contact_supplier_id">
            <input type="hidden" name="supplier_uuid" id="contact_supplier_uuid">

            <div class="mb-2">
              <label class="fw-bold">Name</label>
              <input type="text" name="contact_name" class="form-control" required>
            </div>

            <div class="mb-2">
              <label class="fw-bold">Email</label>
              <input type="email" name="email" class="form-control">
            </div>

            <div class="mb-2">
              <label class="fw-bold">Department</label>
              <input type="text" name="department" class="form-control">
            </div>

            <div class="mb-2">
              <label class="fw-bold">Phone</label>
              <input type="text" name="phone_no" class="form-control">
            </div>

            <div class="text-end mt-3">
              <button class="btn" style="background:#bf0103;color:white;">
                Save Contact
              </button>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>


  <!-- Edit Contact Modal -->
  <div class="modal fade" id="editContactModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header" style="background:#bf0103;">
          <h5 class="modal-title text-white">Edit Contact <span id="editcontactSupplierName"></span></h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body">
          <form id="editContactForm" method="POST" action="{{ route('admin.supplier.edit.supplier.contact') }}">
            @csrf

            <input type="hidden" name="contact_id" id="edit_contact_id">

            <div class="mb-2">
              <label class="fw-bold">Name</label>
              <input type="text" name="contact_name" id="edit_contact_name" class="form-control" required>
            </div>

            <div class="mb-2">
              <label class="fw-bold">Email</label>
              <input type="email" name="email" id="edit_contact_email" class="form-control">
            </div>

            <div class="mb-2">
              <label class="fw-bold">Department</label>
              <input type="text" name="department" id="edit_contact_department" class="form-control">
            </div>

            <div class="mb-2">
              <label class="fw-bold">Phone</label>
              <input type="text" name="phone_no" id="edit_contact_phone" class="form-control">
            </div>

            <div class="text-end mt-3">
              <button type="submit" class="btn" style="background:#bf0103;color:white;">
                Update Contact
              </button>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>




  <!-- View Supplier Modal -->
  <div class="modal fade" id="viewSupplierModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content shadow-lg">
        <div class="modal-header text-white" style="background-color:#bf0103;">
          <h5 class="modal-title text-white">Supplier Details</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body">

          <!-- Basic Info -->
          <div class="mb-3">
            <h6 class="border-bottom pb-2 text-primary mb-3">Basic Information</h6>

            <div class="row mb-2">
              <div class="col-md-4 text-muted">Supplier Name</div>
              <div class="col-md-8 fw-semibold" id="v_supplier_name"></div>
            </div>

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
              <div class="col-md-4 text-muted">Area </div>
              <div class="col-md-8" id="v_area_name"></div>
            </div>

            <div class="row mb-2">
              <div class="col-md-4 text-muted">City </div>
              <div class="col-md-8" id="v_city_name"></div>
            </div>

            <div class="row mb-2">
              <div class="col-md-4 text-muted">State </div>
              <div class="col-md-8" id="v_state_name"></div>
            </div>

          </div>

          <!-- Tax Details -->
          <div class="mb-3">
            <h6 class="border-bottom pb-2 text-primary mb-3">Tax Details</h6>

            <div class="row mb-2">
              <div class="col-md-4 text-muted">GST </div>
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


  <!-- Branch Modal -->
  <div class="modal fade" id="branchModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header text-white" style="background-color:#bf0103;">
          <h5 class="modal-title text-white">Branches of <span id="branchSupplierName"></span></h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">

          <div class="d-flex justify-content-between mb-3">
            <h6 class="mb-0">Branch List</h6>
            <a href="javascript:void(0)" class="btn btn-sm" id="addBranchBtn" style="background:#bf0103;color:white;">Add
              Branch</a>
          </div>

          <div class="table-responsive">
            <table class="table table-bordered table-striped" id="branchTable">
              <thead class="table-light">
                <tr>
                  <th>Sr.no</th>
                  <th>Branch Name</th>
                  <th>Area</th>
                  <th>City</th>
                  <th>State</th>
                  <th>Phone no</th>
                  <th>Address</th>
                  <th>Pincode</th>
                  <th>Created By </th>
                  <th>Modified By </th>
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


  <!-- Add Branch Modal -->
  <div class="modal fade" id="addBranchModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header text-white" style="background-color:#bf0103;">
          <h5 class="modal-title text-white">Add Branch of <span id="addbranchSupplierName"></span></h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <form id="addBranchForm" method="post" action="{{ route('admin.supplier.add.branch') }}">
            @csrf
            <input type="hidden" name="supplier_uuid" id="branch_supplier_uuid">
            <input type="hidden" name="supplier_id" id="branch_supplier_id">

            <div class="row g-3">
              <div class="col-md-6">
                <label class="fw-bold text-muted">Branch Name</label>
                <input type="text" name="branch_name" class="form-control" required>
              </div>

              <div class="col-md-6">
                <label class="fw-bold text-muted">Area</label>
                <select name="area_id" id="branch_area_id" class="form-control select2" required>
                  <option value="">Select Area</option>
                  @foreach($areaList as $areas)
                    <option value="{{ $areas->id }}">{{ $areas->area }}</option>
                  @endforeach
                </select>
              </div>

              <div class="col-md-6">
                <label class="fw-bold text-muted">State</label>
                <select name="state_id" id="branch_state_id" class="form-control select2" required>
                  <option value="">Select State</option>

                </select>
              </div>

              <div class="col-md-6">
                <label class="fw-bold text-muted">City</label>
                <select name="city_id" id="branch_city_id" class="form-control select2" required>
                  <option value="">Select City</option>

                </select>
              </div>



              <div class="col-md-6">
                <label class="fw-bold text-muted">Phone</label>
                <input type="text" name="phone_no" class="form-control">
              </div>

              <!-- <div class="col-md-6">
                <label class="fw-bold text-muted">Fax</label>
                <input type="text" name="fax" class="form-control">
              </div> -->

              <div class="col-md-6">
                <label class="fw-bold text-muted">Pincode</label>
                <input type="text" name="pincode" class="form-control">
              </div>

              <div class="col-md-12">
                <label class="fw-bold text-muted">Address Line 1</label>
                <textarea name="address_line_1" class="form-control" rows="2"></textarea>
              </div>

              <div class="col-md-12">
                <label class="fw-bold text-muted">Address Line 2</label>
                <textarea name="address_line_2" class="form-control" rows="2"></textarea>
              </div>
            </div>

            <div class="mt-3 text-end">
              <button type="submit" class="btn" style="background:#bf0103;color:white;">Save Branch</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Edit Branch Modal -->
  <div class="modal fade" id="editBranchModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header" style="background:#bf0103;">
          <h5 class="modal-title" style="background:#bf0103;color:white;">Edit Branch <span
              id="editbranchSupplierName"></span></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body">
          <form id="editBranchForm" method="post" action="{{ route('admin.supplier.edit.supplier.branch') }}">
            @csrf
            <input type="hidden" name="branch_id" id="edit_branch_id">

            <div class="row g-3">

              <div class="col-md-6">
                <label class="fw-bold">Branch Name</label>
                <input type="text" name="branch_name" id="edit_branch_name" class="form-control">
              </div>

              <div class="col-md-6">
                <label class="fw-bold text-muted">Area</label>
                <select name="area_id" id="edit_branch_area_id" class="form-control select2" required>
                  <option value="">Select City</option>
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
                <label class="fw-bold">Phone</label>
                <input type="text" name="phone_no" id="edit_phone_no" class="form-control">
              </div>

              <!-- <div class="col-md-6">
                <label class="fw-bold">Fax</label>
                <input type="text" name="fax" id="edit_fax" class="form-control">
              </div> -->

              <div class="col-md-6">
                <label class="fw-bold">Pincode</label>
                <input type="text" name="pincode" id="edit_pincode" class="form-control">
              </div>

              <div class="col-md-12">
                <label class="fw-bold">Address Line 1</label>
                <textarea name="address_line_1" id="edit_address_1" class="form-control"></textarea>
              </div>

              <div class="col-md-12">
                <label class="fw-bold">Address Line 2</label>
                <textarea name="address_line_2" id="edit_address_2" class="form-control"></textarea>
              </div>

            </div>

            <div class="mt-3 text-end">
              <button type="submit" class="btn" style="background:#bf0103;color:white;">Update Branch</button>
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
    $(document).on('click', '.viewSupplier', function () {

      $('#v_supplier_name').text($(this).data('supplier_name'));
      $('#v_mobile_no').text($(this).data('mobile_no'));
      $('#v_contact_person').text($(this).data('contact_person'));
      $('#v_email').text($(this).data('email'));

      let address =
        ($(this).data('address_line_1') ?? '') + ' ' +
        ($(this).data('address_line_2') ?? '') + ' - ' +
        ($(this).data('pincode') ?? '');

      $('#v_address').text(address);

      $('#v_area_name').text($(this).data('area_name'));
      $('#v_state_name').text($(this).data('state_name'));
      $('#v_city_name').text($(this).data('city_name'));
      $('#v_gst').text($(this).data('gst'));
      $('#v_cst').text($(this).data('cst'));
      $('#v_vat').text($(this).data('vat'));
      $('#v_pan').text($(this).data('pan'));
      $('#v_tin').text($(this).data('tin'));

      $('#v_phone_1').text($(this).data('phone_1'));
      $('#v_phone_2').text($(this).data('phone_2'));
      $('#v_fax').text($(this).data('fax'));
      $('#v_web_sites').text($(this).data('web_sites'));

      $('#viewSupplierModal').modal('show');
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
        var supplierId = $(this).data('supplier-id');
        var supplierName = $(this).data('supplier-name');
        var supplierUuid = $(this).data('supplier-uuid');

        $('#branchSupplierName').text(supplierName);
        $('#addbranchSupplierName').text(supplierName);
        $('#editbranchSupplierName').text(supplierName);
        // $('#branchTable tbody').html('');
        $('#branch_supplier_id').val(supplierId);
        $('#branch_supplier_uuid').val(supplierUuid);

        $('#branchTable tbody').html(
          '<tr><td colspan="10" class="text-center">Loading...</td></tr>'
        );

        $.ajax({
          url: "{{ route('admin.supplier.get.supplier.branch') }}",
          type: "POST",
          data: {
            supplier_id: supplierId,
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
                              <td>${val.branch_name ?? '-'}</td>
                              <td>${val.area_name ?? '-'}</td>
                              <td>${val.city_name ?? '-'}</td>
                              <td>${val.state_name ?? '-'}</td>
                              <td>${val.phone_no ?? '-'}</td>
                              <td>
                                  ${(val.address_line_1 ?? '')}
                                  ${(val.address_line_2 ?? '')}
                              </td>
                              <td>${val.pincode ?? '-'}</td>
                              <td>${val.created_by ?? '-'}</td>
                              <td>${val.modified_by ?? '-'}</td>
                              <td class="text-center">
                                  <i class="icon-pencil-alt text-primary editBranchBtn"
                                    data-id="${val.id}"
                                    data-branch_name="${val.branch_name}"
                                    data-state_id="${val.state_id}"
                                    data-city_id="${val.city_id}"
                                    data-area_id="${val.area_id}"
                                    data-phone_no="${val.phone_no}"
                                    data-fax="${val.fax}"
                                    data-pincode="${val.pincode}"
                                    data-address_1="${val.address_line_1}"
                                    data-address_2="${val.address_line_2}">
                                  </i>

                                   <i class="icon-trash text-danger deleteBranchBtn" data-uuid="${val.uuid}"></i>
                              </td>
                          </tr>
                      `;
              });
            } else {
              html = `
                      <tr>
                          <td colspan="10" class="text-center text-muted">
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
      let areaId = $(this).data('area_id');

      // Basic fields
      $('#edit_branch_id').val(branchId);
      $('#edit_branch_name').val($(this).data('branch_name'));
      $('#edit_phone_no').val($(this).data('phone_no'));
      $('#edit_fax').val($(this).data('fax'));
      $('#edit_pincode').val($(this).data('pincode'));
      $('#edit_address_1').val($(this).data('address_1'));
      $('#edit_address_2').val($(this).data('address_2'));

      // Reset dropdowns
      $('#edit_branch_state_id').empty().append('<option value="">Loading...</option>');
      $('#edit_branch_city_id').empty().append('<option value="">Loading...</option>');

      // ✅ Set AREA first
      $('#edit_branch_area_id').val(areaId).trigger('change');

      // ✅ Fetch city & state from area
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

      $('#editBranchModal').modal('show');
      $('#branchModal').modal('hide');
    });
  </script>


  <script>
    $(document).on('change', '#edit_branch_area_id', function () {

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


    $(document).on('click', '.deleteBranchBtn', function () {

      let uuid = $(this).data('uuid');

      if (confirm('Are you sure you want to delete this branch?')) {
        window.location.href = "{{ url('admin/supplier/delete-supplier-branch') }}/" + uuid;
      }
    });
  </script>


  <!-- for Contact -->

  <script>
    $(document).on('click', '.viewContactBtn', function () {

      let supplierId = $(this).data('supplier-id');
      let supplierName = $(this).data('supplier-name');
      let supplierUuid = $(this).data('supplier-uuid');

      $('#contactSupplierName').text(supplierName);
      $('#addcontactSupplierName').text(supplierName);
      $('#editcontactSupplierName').text(supplierName);
      $('#contact_supplier_id').val(supplierId);
      $('#contact_supplier_uuid').val(supplierUuid);

      $('#contactTable tbody').html(
        '<tr><td colspan="6" class="text-center">Loading...</td></tr>'
      );

      $.ajax({
        url: "{{ route('admin.supplier.get.supplier.contact') }}",
        type: "POST",
        data: {
          supplier_id: supplierId,
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
                            <td>${val.email ?? '-'}</td>
                            <td>${val.department ?? '-'}</td>
                            <td>${val.phone_no ?? '-'}</td>
                            <td class="text-center">
                            <i class="icon-pencil-alt text-primary editContactBtn"
                              data-id="${val.id}"
                              data-contact_name="${val.contact_name}"
                              data-email="${val.email}"
                              data-department="${val.department}"
                              data-phone_no="${val.phone_no}">
                                  </i>
                              <i class="icon-trash text-danger deleteContactBtn" data-uuid="${val.uuid}"></i>

                            </td>
                          </tr>
                      `;
            });
          } else {
            html = `
                    <tr>
                      <td colspan="6" class="text-center text-muted">
                        No Contact Found
                      </td>
                    </tr>`;
          }

          $('#contactTable tbody').html(html);
        }
      });

      $('#contactModal').modal('show');
    });
  </script>

  <script>
    $(document).on('click', '#addContactBtn', function () {
      $('#contactModal').modal('hide');
      $('#addContactModal').modal('show');
    });

    $(document).on('click', '.editContactBtn', function () {

      $('#edit_contact_id').val($(this).data('id'));
      $('#edit_contact_name').val($(this).data('contact_name'));
      $('#edit_contact_email').val($(this).data('email'));
      $('#edit_contact_department').val($(this).data('department'));
      $('#edit_contact_phone').val($(this).data('phone_no'));

      $('#editContactModal').modal('show');
      $('#contactModal').modal('hide');
    });

    $(document).on('click', '.deleteContactBtn', function () {

      let uuid = $(this).data('uuid');

      if (confirm('Are you sure you want to delete this contact?')) {
        window.location.href = "{{ url('admin/supplier/delete-supplier-contact') }}/" + uuid;
      }
    });
  </script>

@endpush