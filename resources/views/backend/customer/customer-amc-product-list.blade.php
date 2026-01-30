@extends('backend.common.master')
@section('main-section')
<div class="container-fluid">
  <div class="page-title">
    <div class="row">
      <div class="col-6">
        <h4>{{ $customer->customer_name }} - {{ $customerBranch->branch_name }} ({{ $amcProduct->amc_product }})</h4>
      </div>
      <div class="col-6">

        <ol class="breadcrumb">

        <a href="{{ route('admin.customer.amc.product',['uuid' => $customerBranch->uuid]) }}">
            <button type="button" class="btn btn-lg" data-bs-toggle="tooltip" title="Add User" style="background:#bf0103;color:white;">Back</button>
          </a>
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <button type="button"
            class="btn btn-lg addProductBtn"
            style="background:#bf0103;color:white;"
            data-bs-toggle="modal"
            data-bs-target="#addProductModal"
            data-customer_id="{{ $customer->id }}"
            data-branch_id="{{ $customerBranch->id }}"
            data-amc_product_id="{{ $amcProduct->id }}">
            Add {{ $amcProduct->amc_product }}
          </button>
        </ol>
      </div>
    </div>
  </div>
</div>

<!-- Table -->
<div class="container-fluid">
  <div class="row">
    <div class="col-sm-12">
      <div class="card">
        <div class="card-body">
          <div class="table-responsive custom-scrollbar">
            <table class="display" id="basic-1">
              <thead>
                <tr>
                  <th>Sr.no</th>
                  <th>User Name</th>
                  <th>Department</th>
                  <th>Start Date</th>
                  <th>End Date</th>
                  <th width="120" class="text-center">Action</th>
                </tr>
              </thead>
              <tbody>
                @php $i=0; @endphp
                @foreach($amcProductList as $amc)
                @php $i++; @endphp
                <tr>
                  <td>{{ $i }}</td>
                  <td>{{ $amc->user_name }}</td>
                  <td>{{ $amc->department }}</td>
                  <td>{{ $amc->amc_start_date }}</td>
                  <td>{{ $amc->amc_end_date }}</td>
                  <td class="text-center">
                    <ul class="action">

                    <li class="edit">
                        <i class="icon-eye viewCustomerBtn"
                          style="cursor:pointer;"
                          data-customer_name="{{ $customer->customer_name }}"
                          data-branch_name="{{ $customerBranch->branch_name }}"
                          data-amc_product="{{ $amcProduct->amc_product }}"
                          data-user_name="{{ $amc->user_name }}"
                          data-department="{{ $amc->department }}"
                          data-description="{{ $amc->description }}"
                          data-quantity="{{ $amc->quantity }}"
                          data-invoice_type="{{ $amc->invoice_type }}"
                          data-amc_start_date="{{ $amc->amc_start_date }}"
                          data-amc_end_date="{{ $amc->amc_end_date }}"
                          data-service_date_1="{{ $amc->service_date_1 }}"
                          data-service_engineer_1="{{ $amc->engnieer_1 }}"
                          data-service_date_2="{{ $amc->service_date_2 }}"
                          data-service_engineer_2="{{ $amc->engnieer_2 }}"
                          data-service_date_3="{{ $amc->service_date_3 }}"
                          data-service_engineer_3="{{ $amc->engnieer_3 }}"></i>
                      </li>

                      <li class="edit">
                        <i class="icon-pencil-alt editProductBtn"
                          data-id="{{ $amc->id }}"
                          data-uuid="{{ $amc->uuid }}"
                          data-customer_id="{{ $amc->customer_id }}"
                          data-branch_id="{{ $amc->branch_id }}"
                          data-amc_product_id="{{ $amc->amc_product_id }}"
                          data-product_type="{{ $amc->product_type }}"
                          data-product_category="{{ $amc->product_category }}"
                          data-department="{{ $amc->department }}"
                          data-user_name="{{ $amc->user_name }}"
                          data-description="{{ $amc->description }}"
                          data-amc_start_date="{{ $amc->amc_start_date }}"
                          data-amc_end_date="{{ $amc->amc_end_date }}"
                          data-service_date_1="{{ $amc->service_date_1 }}"
                          data-service_engineer_1="{{ $amc->service_engineer_1 }}"
                          data-service_date_2="{{ $amc->service_date_2 }}"
                          data-service_engineer_2="{{ $amc->service_engineer_2 }}"
                          data-service_date_3="{{ $amc->service_date_3 }}"
                          data-service_engineer_3="{{ $amc->service_engineer_3 }}"
                          data-quantity="{{ $amc->quantity }}"></i>
                      </li>

                      <li class="delete">
                        <a href="{{ route('admin.customer.delete.amc.product',['uuid' => $amc->uuid]) }}">
                          <i class="icon-trash"></i>
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

<!-- ADD MODAL -->
<div class="modal fade" id="addProductModal" tabindex="-1">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header text-white" style="background:#bf0103;color:white;">
        <h5 class="modal-title" style="color:white;">Add {{ $amcProduct->amc_product }}</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{ route('admin.customer.add.amc.product') }}">
          @csrf
          <!-- Hidden Fields -->
          <input type="hidden" name="customer_id" id="customer_id">
          <input type="hidden" name="branch_id" id="branch_id">
          <input type="hidden" name="amc_product_id" id="amc_product_id">

          <div class="row g-3">
            <div class="col-md-6">
              <label class="fw-bold">Product Type</label>
              <select name="product_type" id="product_type" class="form-control">
                <option value="AMC">AMC</option>
                <option value="Non-AMC">Non AMC</option>
              </select>
            </div>

            <div class="col-md-6">
              <label class="fw-bold">Product Category</label>
              <select name="product_category" id="product_category" class="form-control">
                <option value="Comprehensive">Comprehensive</option>
                <option value="Non-Comprehensive">Non-Comprehensive</option>
              </select>
            </div>

            <div class="col-md-6">
              <label class="fw-bold">Department</label>
              <input type="text" name="department" id="department" class="form-control">
            </div>

            <div class="col-md-6">
              <label class="fw-bold">User Name</label>
              <input type="text" name="user_name" id="user_name" class="form-control">
            </div>

            <div class="col-md-12">
              <label class="fw-bold">Description</label>
              <input type="text" name="description" id="description" class="form-control">
            </div>

            <div class="col-md-6">
              <label class="fw-bold">AMC Start Date</label>
              <input type="text" name="amc_start_date" id="amc_start_date" class="form-control datepicker">
            </div>

            <div class="col-md-6">
              <label class="fw-bold">AMC End Date</label>
              <input type="text" name="amc_end_date" id="amc_end_date" class="form-control datepicker" readonly>
            </div>

            <div class="col-md-6">
              <label class="fw-bold">Service Date 1</label>
              <input type="text" name="service_date_1" id="service_date_1" class="form-control datepicker" readonly>
            </div>

            <div class="col-md-6">
              <label class="fw-bold">Service Engineer 1</label>
              <select name="service_engineer_1" id="service_engineer_1" class="form-control">
                <option value="">Select</option>
                @foreach($getEngineer as $engineer)
                <option value="{{ $engineer->id }}">{{ $engineer->name }}</option>
                @endforeach
              </select>
            </div>

            <div class="col-md-6">
              <label class="fw-bold">Service Date 2</label>
              <input type="text" name="service_date_2" id="service_date_2" class="form-control datepicker" readonly>
            </div>

            <div class="col-md-6">
              <label class="fw-bold">Service Engineer 2</label>
              <select name="service_engineer_2" id="service_engineer_2" class="form-control">
                <option value="">Select</option>
                @foreach($getEngineer as $engineer)
                <option value="{{ $engineer->id }}">{{ $engineer->name }}</option>
                @endforeach
              </select>
            </div>

            <div class="col-md-6">
              <label class="fw-bold">Service Date 3</label>
              <input type="text" name="service_date_3" id="service_date_3" class="form-control datepicker" readonly>
            </div>

            <div class="col-md-6">
              <label class="fw-bold">Service Engineer 3</label>
              <select name="service_engineer_3" id="service_engineer_3" class="form-control">
                <option value="">Select</option>
                @foreach($getEngineer as $engineer)
                <option value="{{ $engineer->id }}">{{ $engineer->name }}</option>
                @endforeach
              </select>
            </div>

            <div class="col-md-6">
              <label class="fw-bold">Quantity</label>
              <input type="text" name="quantity" id="quantity" class="form-control">
            </div>
          </div>

          <div class="mt-4 text-end">
            <button type="submit" class="btn" style="background:#bf0103;color:white;">Save Product</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- EDIT MODAL -->
<div class="modal fade" id="editProductModal" tabindex="-1">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header text-white" style="background:#bf0103;color:white;">
        <h5 class="modal-title" style="color:white;">Edit AMC Product</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{ route('admin.customer.edit.amc.product') }}">
          @csrf

          <input type="hidden" name="id" id="edit_id">
          <input type="hidden" name="uuid" id="edit_uuid">
          <input type="hidden" name="customer_id" id="edit_customer_id">
          <input type="hidden" name="branch_id" id="edit_branch_id">
          <input type="hidden" name="amc_product_id" id="edit_amc_product_id">

          <div class="row g-3">
            <div class="col-md-6">
              <label class="fw-bold">Product Type</label>
              <select name="product_type" id="edit_product_type" class="form-control">
                <option value="AMC">AMC</option>
                <option value="Non-AMC">Non AMC</option>
              </select>
            </div>
            <div class="col-md-6">
              <label class="fw-bold">Product Category</label>
              <select name="product_category" id="edit_product_category" class="form-control">
                <option value="Comprehensive">Comprehensive</option>
                <option value="Non-Comprehensive">Non-Comprehensive</option>
              </select>
            </div>
            <div class="col-md-6">
              <label class="fw-bold">Department</label>
              <input type="text" name="department" id="edit_department" class="form-control">
            </div>
            <div class="col-md-6">
              <label class="fw-bold">User Name</label>
              <input type="text" name="user_name" id="edit_user_name" class="form-control">
            </div>
            <div class="col-md-12">
              <label class="fw-bold">Description</label>
              <input type="text" name="description" id="edit_description" class="form-control">
            </div>

            <div class="col-md-6">
              <label class="fw-bold">AMC Start Date</label>
              <input type="text" name="amc_start_date" id="edit_amc_start_date" class="form-control datepicker">
            </div>

            <div class="col-md-6">
              <label class="fw-bold">AMC End Date</label>
              <input type="text" name="amc_end_date" id="edit_amc_end_date" class="form-control datepicker" readonly>
            </div>

            <div class="col-md-6">
              <label class="fw-bold">Service Date 1</label>
              <input type="text" name="service_date_1" id="edit_service_date_1" class="form-control datepicker" readonly>
            </div>
            <div class="col-md-6">
              <label class="fw-bold">Service Engineer 1</label>
              <select name="service_engineer_1" id="edit_service_engineer_1" class="form-control">
                <option value="">Select</option>
                @foreach($getEngineer as $engineer)
                <option value="{{ $engineer->id }}">{{ $engineer->name }}</option>
                @endforeach
              </select>
            </div>

            <div class="col-md-6">
              <label class="fw-bold">Service Date 2</label>
              <input type="text" name="service_date_2" id="edit_service_date_2" class="form-control datepicker" readonly>
            </div>
            <div class="col-md-6">
              <label class="fw-bold">Service Engineer 2</label>
              <select name="service_engineer_2" id="edit_service_engineer_2" class="form-control">
                <option value="">Select</option>
                @foreach($getEngineer as $engineer)
                <option value="{{ $engineer->id }}">{{ $engineer->name }}</option>
                @endforeach
              </select>
            </div>

            <div class="col-md-6">
              <label class="fw-bold">Service Date 3</label>
              <input type="text" name="service_date_3" id="edit_service_date_3" class="form-control datepicker" readonly>
            </div>
            <div class="col-md-6">
              <label class="fw-bold">Service Engineer 3</label>
              <select name="service_engineer_3" id="edit_service_engineer_3" class="form-control">
                <option value="">Select</option>
                @foreach($getEngineer as $engineer)
                <option value="{{ $engineer->id }}">{{ $engineer->name }}</option>
                @endforeach
              </select>
            </div>

            <div class="col-md-6">
              <label class="fw-bold">Quantity</label>
              <input type="text" name="quantity" id="edit_quantity" class="form-control">
            </div>
          </div>

          <div class="mt-4 text-end">
            <button type="submit" class="btn" style="background:#bf0103;color:white;">Update Product</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>


<!-- VIEW CUSTOMER AMC DETAILS MODAL -->
<div class="modal fade" id="viewCustomerModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content shadow-lg">

      <div class="modal-header text-white" style="background-color:#bf0103;">
        <h5 class="modal-title text-white">Customer AMC Details</h5>
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

          <div class="row mb-2">
            <div class="col-md-4 text-muted">Branch</div>
            <div class="col-md-8" id="v_branch_name"></div>
          </div>

          <div class="row mb-2">
            <div class="col-md-4 text-muted">AMC Product</div>
            <div class="col-md-8" id="v_amc_product"></div>
          </div>

          <div class="row mb-2">
            <div class="col-md-4 text-muted">User Name</div>
            <div class="col-md-8" id="v_user_name"></div>
          </div>

          <div class="row mb-2">
            <div class="col-md-4 text-muted">Department</div>
            <div class="col-md-8" id="v_department"></div>
          </div>

          <div class="row mb-2">
            <div class="col-md-4 text-muted">Description</div>
            <div class="col-md-8" id="v_description"></div>
          </div>

          <div class="row mb-2">
            <div class="col-md-4 text-muted">Quantity</div>
            <div class="col-md-8" id="v_quantity"></div>
          </div>

          <!-- <div class="row mb-2">
            <div class="col-md-4 text-muted">Invoice Type</div>
            <div class="col-md-8" id="v_invoice_type"></div>
          </div> -->

        </div>

        <!-- AMC Dates -->
        <div class="mb-3">
          <h6 class="border-bottom pb-2 text-primary mb-3">AMC Dates</h6>

          <div class="row mb-2">
            <div class="col-md-4 text-muted">AMC Start Date</div>
            <div class="col-md-8" id="v_amc_start_date"></div>
          </div>

          <div class="row mb-2">
            <div class="col-md-4 text-muted">AMC End Date</div>
            <div class="col-md-8" id="v_amc_end_date"></div>
          </div>
        </div>

        <!-- Service Schedule -->
        <div class="mb-3">
          <h6 class="border-bottom pb-2 text-primary mb-3">Service Schedule</h6>

          <div class="row mb-2">
            <div class="col-md-4 text-muted">Service Date 1</div>
            <div class="col-md-8" id="v_service_date_1"></div>
          </div>
          <div class="row mb-2">
            <div class="col-md-4 text-muted">Service Engineer 1</div>
            <div class="col-md-8" id="v_service_engineer_1"></div>
          </div>

          <div class="row mb-2">
            <div class="col-md-4 text-muted">Service Date 2</div>
            <div class="col-md-8" id="v_service_date_2"></div>
          </div>
          <div class="row mb-2">
            <div class="col-md-4 text-muted">Service Engineer 2</div>
            <div class="col-md-8" id="v_service_engineer_2"></div>
          </div>

          <div class="row mb-2">
            <div class="col-md-4 text-muted">Service Date 3</div>
            <div class="col-md-8" id="v_service_date_3"></div>
          </div>
          <div class="row mb-2">
            <div class="col-md-4 text-muted">Service Engineer 3</div>
            <div class="col-md-8" id="v_service_engineer_3"></div>
          </div>
        </div>

      </div>

    </div>
  </div>
</div>


@endsection

@push('scripts')
<!-- FLATPICKR -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<script>
  $(document).ready(function() {

    // -----------------------------
    // FLATPICKR CONFIG
    // -----------------------------
    const dateConfig = {
      dateFormat: "Y-m-d",
      allowInput: true
    };

    // ADD MODAL FLATPICKR
    const amcEnd = flatpickr("#amc_end_date", dateConfig);
    const serviceDate1 = flatpickr("#service_date_1", dateConfig);
    const serviceDate2 = flatpickr("#service_date_2", dateConfig);
    const serviceDate3 = flatpickr("#service_date_3", dateConfig);
    const amcStart = flatpickr("#amc_start_date", {
      ...dateConfig,
      onChange: function(selectedDates) {
        if (!selectedDates.length) return;
        let start = selectedDates[0];
        let end = new Date(start);
        end.setFullYear(end.getFullYear() + 1);
        end.setDate(end.getDate() - 1);
        let s1 = new Date(start);
        s1.setMonth(s1.getMonth() + 4);
        let s2 = new Date(start);
        s2.setMonth(s2.getMonth() + 8);
        let s3 = new Date(end);
        s3.setDate(s3.getDate() - 2);

        amcEnd.setDate(end, true);
        serviceDate1.setDate(s1, true);
        serviceDate2.setDate(s2, true);
        serviceDate3.setDate(s3, true);
      }
    });

    // EDIT MODAL FLATPICKR
    const editAmcEnd = flatpickr("#edit_amc_end_date", dateConfig);
    const editServiceDate1 = flatpickr("#edit_service_date_1", dateConfig);
    const editServiceDate2 = flatpickr("#edit_service_date_2", dateConfig);
    const editServiceDate3 = flatpickr("#edit_service_date_3", dateConfig);
    const editAmcStart = flatpickr("#edit_amc_start_date", {
      ...dateConfig,
      onChange: function(selectedDates) {
        if (!selectedDates.length) return;
        let start = selectedDates[0];
        let end = new Date(start);
        end.setFullYear(end.getFullYear() + 1);
        end.setDate(end.getDate() - 1);
        let s1 = new Date(start);
        s1.setMonth(s1.getMonth() + 4);
        let s2 = new Date(start);
        s2.setMonth(s2.getMonth() + 8);
        let s3 = new Date(end);
        s3.setDate(s3.getDate() - 2);

        editAmcEnd.setDate(end, true);
        editServiceDate1.setDate(s1, true);
        editServiceDate2.setDate(s2, true);
        editServiceDate3.setDate(s3, true);
      }
    });

    // -----------------------------
    // ADD BUTTON DATA
    // -----------------------------
    $(document).on('click', '.addProductBtn', function() {
      $('#customer_id').val($(this).data('customer_id'));
      $('#branch_id').val($(this).data('branch_id'));
      $('#amc_product_id').val($(this).data('amc_product_id'));
    });

    // -----------------------------
    // EDIT BUTTON DATA
    // -----------------------------
    $(document).on('click', '.editProductBtn', function() {
      const d = $(this).data();
      $("#edit_id").val(d.id);
      $("#edit_uuid").val(d.uuid);
      $("#edit_customer_id").val(d.customer_id);
      $("#edit_branch_id").val(d.branch_id);
      $("#edit_amc_product_id").val(d.amc_product_id);

      $("#edit_product_type").val(d.product_type);
      $("#edit_product_category").val(d.product_category);
      $("#edit_department").val(d.department);
      $("#edit_user_name").val(d.user_name);
      $("#edit_description").val(d.description);
      $("#edit_quantity").val(d.quantity);

      $("#edit_service_engineer_1").val(d.service_engineer_1);
      $("#edit_service_engineer_2").val(d.service_engineer_2);
      $("#edit_service_engineer_3").val(d.service_engineer_3);

      // Set dates
      editAmcStart.setDate(d.amc_start_date, true);
      editAmcEnd.setDate(d.amc_end_date, true);
      editServiceDate1.setDate(d.service_date_1, true);
      editServiceDate2.setDate(d.service_date_2, true);
      editServiceDate3.setDate(d.service_date_3, true);

      var modal = new bootstrap.Modal(document.getElementById('editProductModal'));
      modal.show();
    });

  });
</script>

<script>
  $(document).on('click', '.viewCustomerBtn', function() {
    const d = $(this).data();

    $('#v_customer_name').text(d.customer_name);
    $('#v_branch_name').text(d.branch_name);
    $('#v_amc_product').text(d.amc_product);
    $('#v_user_name').text(d.user_name);
    $('#v_department').text(d.department);
    $('#v_description').text(d.description);
    $('#v_quantity').text(d.quantity);
    $('#v_invoice_type').text(d.invoice_type);

    $('#v_amc_start_date').text(d.amc_start_date);
    $('#v_amc_end_date').text(d.amc_end_date);

    $('#v_service_date_1').text(d.service_date_1);
    $('#v_service_engineer_1').text(d.service_engineer_1);

    $('#v_service_date_2').text(d.service_date_2);
    $('#v_service_engineer_2').text(d.service_engineer_2);

    $('#v_service_date_3').text(d.service_date_3);
    $('#v_service_engineer_3').text(d.service_engineer_3);

    var modal = new bootstrap.Modal(document.getElementById('viewCustomerModal'));
    modal.show();
  });
</script>
@endpush