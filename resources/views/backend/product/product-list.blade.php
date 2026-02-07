@extends('backend.common.master')

@section('main-section')
  <div class="container-fluid">
    <div class="page-title">
      <div class="row">
        <div class="col-6">
          <h4>Product List</h4>
        </div>
        <div class="col-6">
          <ol class="breadcrumb justify-content-end">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
            <li class="breadcrumb-item active">Product List</li>
            <button type="button" class="btn btn-primary-custom ms-3" data-bs-toggle="modal"
              data-bs-target="#addProductModal">
              <i class="fa fa-plus me-1"></i> Add Product
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
              <table class="display table-premium" id="product-table">
                <thead>
                  <tr>
                    <th>Sr.no</th>
                    <th>Manufacture</th>
                    <th>Product Type</th>
                    <th>Sub Product</th>
                    <th>Specification</th>
                    <th>Rate</th>
                    <th width="120" class="text-center">Action</th>
                  </tr>
                </thead>
                <tbody>

                  @php $i = 0; @endphp
                  @foreach($productList as $products)
                    @php $i++; @endphp
                    <tr>
                      <td>{{ $i }}</td>
                      <td class="fw-medium">{{ $products->manufacture_name }}</td>
                      <td>{{ $products->product_type_name }}</td>
                      <td>{{ $products->sub_product_type }}</td>
                      <td>{{ $products->specification }}</td>
                      <td><span class="badge badge-light-success text-dark">₹{{ number_format($products->rate, 2) }}</span>
                      </td>
                      <td class="text-center">
                        <div class="d-flex justify-content-center align-items-center gap-2">
                          <a href="javascript:void(0);" class="btn btn-sm-custom btn-outline-dark editProductBtn"
                            data-uuid="{{ $products->uuid }}" data-manufacture="{{ $products->manufacture }}"
                            data-product_type="{{ $products->product_type }}"
                            data-sub_product_type_id="{{ $products->sub_product_type_id ?? '' }}"
                            data-sub_product_type_name="{{ $products->sub_product_type }}"
                            data-specification="{{ $products->specification }}" data-rate="{{ $products->rate }}"
                            data-bs-toggle="tooltip" title="Edit">
                            <i class="icon-pencil-alt"></i>
                          </a>
                          <a href="{{ route('admin.product.delete', ['uuid' => $products->uuid]) }}"
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

  <!-- Add Product Modal -->
  <div class="modal fade" id="addProductModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content modal-content-premium">
        <div class="modal-header modal-header-premium">
          <h5 class="modal-title modal-title-premium text-white">Add Product</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <form action="{{ route('admin.product.store') }}" method="POST" class="needs-validation" novalidate>
          @csrf
          <div class="modal-body p-4">
            <div class="row g-3">
              <div class="col-md-6">
                <label class="form-label-premium">Manufacture <span class="text-danger">*</span></label>
                <div class="d-flex gap-2">
                  <div class="flex-grow-1">
                    <select name="manufacture" class="form-control form-control-premium select2-modal" required>
                      <option value="">Select Manufacture</option>
                      @foreach($manufactureList as $manufacture)
                        <option value="{{ $manufacture->id }}">{{ $manufacture->manufacture }}</option>
                      @endforeach
                    </select>
                  </div>
                  <button type="button" class="btn btn-outline-primary-custom px-3" data-bs-toggle="modal"
                    data-bs-target="#addManufactureModal">
                    <i class="fa fa-plus"></i>
                  </button>
                </div>
              </div>
              <div class="col-md-6">
                <label class="form-label-premium">Product Type <span class="text-danger">*</span></label>
                <div class="d-flex gap-2">
                  <div class="flex-grow-1">
                    <select name="product_type" id="add_product_type"
                      class="form-control form-control-premium select2-modal" required>
                      <option value="">Select Product Type</option>
                      @foreach($productTypeList as $type)
                        <option value="{{ $type->id }}">{{ $type->product_type }}</option>
                      @endforeach
                    </select>
                  </div>
                  <button type="button" class="btn btn-outline-primary-custom px-3" data-bs-toggle="modal"
                    data-bs-target="#addProductTypeModal">
                    <i class="fa fa-plus"></i>
                  </button>
                </div>
              </div>
              <div class="col-md-6">
                <label class="form-label-premium">Sub Product Type <span class="text-danger">*</span></label>
                <select name="sub_product_type" id="add_sub_product_type"
                  class="form-control form-control-premium select2-modal" required>
                  <option value="">Select Sub Product</option>
                </select>
              </div>
              <div class="col-md-6">
                <label class="form-label-premium">Rate <span class="text-danger">*</span></label>
                <input type="number" step="0.01" name="rate" class="form-control form-control-premium"
                  placeholder="Enter Rate" required>
              </div>
              <div class="col-md-12">
                <label class="form-label-premium">Specification <span class="text-danger">*</span></label>
                <textarea name="specification" class="form-control form-control-premium" placeholder="Enter Specification"
                  rows="2" required></textarea>
              </div>
            </div>
          </div>
          <div class="modal-footer border-0 p-4 pt-0">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary-custom">Save Product</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Edit Product Modal -->
  <div class="modal fade" id="editProductModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content modal-content-premium">
        <div class="modal-header modal-header-premium">
          <h5 class="modal-title modal-title-premium text-white">Edit Product</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <form id="editProductForm" method="POST" class="needs-validation" novalidate>
          @csrf
          @method('PATCH')
          <div class="modal-body p-4">
            <div class="row g-3">
              <div class="col-md-6">
                <label class="form-label-premium">Manufacture <span class="text-danger">*</span></label>
                <select name="manufacture" id="edit_manufacture" class="form-control form-control-premium select2-modal"
                  required>
                  <option value="">Select Manufacture</option>
                  @foreach($manufactureList as $manufacture)
                    <option value="{{ $manufacture->id }}">{{ $manufacture->manufacture }}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-md-6">
                <label class="form-label-premium">Product Type <span class="text-danger">*</span></label>
                <select name="product_type" id="edit_product_type" class="form-control form-control-premium select2-modal"
                  required>
                  <option value="">Select Product Type</option>
                  @foreach($productTypeList as $type)
                    <option value="{{ $type->id }}">{{ $type->product_type }}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-md-6">
                <label class="form-label-premium">Sub Product Type <span class="text-danger">*</span></label>
                <select name="sub_product_type" id="edit_sub_product_type"
                  class="form-control form-control-premium select2-modal" required>
                  <option value="">Select Sub Product</option>
                </select>
              </div>
              <div class="col-md-6">
                <label class="form-label-premium">Rate <span class="text-danger">*</span></label>
                <input type="number" step="0.01" name="rate" id="edit_rate" class="form-control form-control-premium"
                  placeholder="Enter Rate" required>
              </div>
              <div class="col-md-12">
                <label class="form-label-premium">Specification <span class="text-danger">*</span></label>
                <textarea name="specification" id="edit_specification" class="form-control form-control-premium"
                  placeholder="Enter Specification" rows="2" required></textarea>
              </div>
            </div>
          </div>
          <div class="modal-footer border-0 p-4 pt-0">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary-custom">Update Product</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Quick Add Manufacture Modal -->
  <div class="modal fade" id="addManufactureModal" tabindex="-1" aria-hidden="true" style="z-index: 1060;">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content modal-content-premium shadow-lg">
        <div class="modal-header modal-header-premium">
          <h5 class="modal-title modal-title-premium text-white">Quick Add Manufacture</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <form action="{{ route('admin.product.add.manufacture') }}" method="POST">
          @csrf
          <div class="modal-body p-4">
            <div class="mb-3">
              <label class="form-label-premium">Manufacture Name <span class="text-danger">*</span></label>
              <input type="text" name="manufacture" class="form-control form-control-premium"
                placeholder="Enter Manufacture Name" required>
            </div>
          </div>
          <div class="modal-footer border-0 p-4 pt-0">
            <button type="button" class="btn btn-secondary" data-bs-target="#addProductModal"
              data-bs-toggle="modal">Back</button>
            <button type="submit" class="btn btn-primary-custom">Save Manufacture</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Quick Add Product Type Modal -->
  <div class="modal fade" id="addProductTypeModal" tabindex="-1" aria-hidden="true" style="z-index: 1060;">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content modal-content-premium shadow-lg">
        <div class="modal-header modal-header-premium">
          <h5 class="modal-title modal-title-premium text-white">Quick Add Product Type</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <form action="{{ route('admin.product.add.product.type') }}" method="POST">
          @csrf
          <div class="modal-body p-4">
            <div class="mb-3">
              <label class="form-label-premium">Product Type Name <span class="text-danger">*</span></label>
              <input type="text" name="product_type" class="form-control form-control-premium"
                placeholder="Enter Product Type" required>
            </div>
            <div class="mb-3">
              <label class="form-label-premium">Sub Product Type Name <span class="text-danger">*</span></label>
              <input type="text" name="sub_product_type" class="form-control form-control-premium"
                placeholder="Enter Sub Product Type" required>
            </div>
          </div>
          <div class="modal-footer border-0 p-4 pt-0">
            <button type="button" class="btn btn-secondary" data-bs-target="#addProductModal"
              data-bs-toggle="modal">Back</button>
            <button type="submit" class="btn btn-primary-custom">Save Product Type</button>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection

@push('css')
  <link rel="stylesheet" href="{{ asset('public/assets/css/vendors/select2.css') }}">
  <style>
    /* Ensure select2 works inside modals */
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
      if ($.fn.DataTable.isDataTable('#product-table')) {
        $('#product-table').DataTable().destroy();
      }
      $('#product-table').DataTable({
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

      // Dependency logic for Sub Product Type
      function fetchSubProducts(productTypeId, targetSelector, selectedId = null) {
        if (!productTypeId) {
          $(targetSelector).empty().append('<option value="">Select Sub Product</option>').trigger('change');
          return;
        }

        $.ajax({
          url: "{{ route('admin.product.type.subproduct') }}",
          type: "POST",
          data: {
            productTypeID: productTypeId,
            _token: "{{ csrf_token() }}"
          },
          dataType: "json",
          success: function (res) {
            let options = '<option value="">Select Sub Product</option>';
            $.each(res, function (key, value) {
              options += `<option value="${value.id}" ${selectedId == value.id ? 'selected' : ''}>${value.sub_product_type}</option>`;
            });
            $(targetSelector).html(options).trigger('change');
          },
          error: function () {
            alert('Unable to fetch subproducts');
          }
        });
      }

      $('#add_product_type').on('change', function () {
        fetchSubProducts($(this).val(), '#add_sub_product_type');
      });

      $('#edit_product_type').on('change', function () {
        fetchSubProducts($(this).val(), '#edit_sub_product_type');
      });

      // Handle Edit Button Click
      $('.editProductBtn').on('click', function () {
        const d = $(this).data();

        $('#edit_manufacture').val(d.manufacture).trigger('change');
        $('#edit_product_type').val(d.product_type).trigger('change');
        $('#edit_specification').val(d.specification);
        $('#edit_rate').val(d.rate);

        // Fetch sub-products and pre-select the correct one
        fetchSubProducts(d.product_type, '#edit_sub_product_type', d.sub_product_type_id);

        let updateUrl = "{{ route('admin.product.update', ['uuid' => ':uuid']) }}";
        updateUrl = updateUrl.replace(':uuid', d.uuid);
        $('#editProductForm').attr('action', updateUrl);

        $('#editProductModal').modal('show');
      });
    });
  </script>
@endpush