@extends('backend.common.master')

@section('main-section')
  <div class="container-fluid">
    <div class="page-title">
      <div class="row">
        <div class="col-6">
          <h4>Product Type List</h4>
        </div>
        <div class="col-6">
          <ol class="breadcrumb justify-content-end">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
            <li class="breadcrumb-item active">Product Type List</li>
            <button type="button" class="btn btn-primary-custom ms-3" data-bs-toggle="modal"
              data-bs-target="#addProductTypeModal">
              <i class="fa fa-plus me-1"></i> Add Product Type
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
              <table class="display table-premium" id="product-type-table">
                <thead>
                  <tr>
                    <th>Sr.no</th>
                    <th>Product Type</th>
                    <th>Sub Product Type</th>
                    <th>Created By</th>
                    <th>Modified By</th>
                    <th width="120" class="text-center">Action</th>
                  </tr>
                </thead>
                <tbody>
                  @php $i = 0; @endphp
                  @foreach($productTypeList as $type)
                    @php $i++; @endphp
                    <tr>
                      <td>{{ $i }}</td>
                      <td class="fw-medium">{{ $type->product_type }}</td>
                      <td>{{ $type->sub_product_type }}</td>
                      <td>{{ $type->created_by }}</td>
                      <td>{{ $type->modified_by }}</td>
                      <td class="text-center">
                        <div class="d-flex justify-content-center align-items-center gap-2">
                          <a href="javascript:void(0);" class="btn btn-sm-custom btn-outline-dark editProductTypeBtn"
                            data-type="{{ json_encode($type) }}" data-bs-toggle="tooltip" title="Edit">
                            <i class="icon-pencil-alt"></i>
                          </a>
                          <a href="{{ route('admin.product-type.delete', ['uuid' => $type->uuid]) }}"
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

  <!-- Add Product Type Modal -->
  <div class="modal fade" id="addProductTypeModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
      <div class="modal-content modal-content-premium">
        <div class="modal-header modal-header-premium">
          <h5 class="modal-title modal-title-premium text-white">Add Product Type</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <form action="{{ route('admin.product-type.store') }}" method="POST" class="needs-validation" novalidate>
          @csrf
          <div class="modal-body p-4">
            <div class="row g-3">
              <div class="col-12">
                <label class="form-label-premium">Product Type <span class="text-danger">*</span></label>
                <input type="text" name="product_type" class="form-control form-control-premium" required
                  placeholder="Enter product type">
              </div>
              <div class="col-12">
                <label class="form-label-premium">Sub Product Type <span class="text-danger">*</span></label>
                <input type="text" name="sub_product_type" class="form-control form-control-premium" required
                  placeholder="Enter sub product type">
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

  <!-- Edit Product Type Modal -->
  <div class="modal fade" id="editProductTypeModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
      <div class="modal-content modal-content-premium">
        <div class="modal-header modal-header-premium">
          <h5 class="modal-title modal-title-premium text-white">Edit Product Type</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <form id="editProductTypeForm" method="POST" class="needs-validation" novalidate>
          @csrf
          <div class="modal-body p-4">
            <div class="row g-3">
              <div class="col-12">
                <label class="form-label-premium">Product Type <span class="text-danger">*</span></label>
                <input type="text" name="product_type" id="edit_product_type" class="form-control form-control-premium"
                  required>
              </div>
              <div class="col-12">
                <label class="form-label-premium">Sub Product Type <span class="text-danger">*</span></label>
                <input type="text" name="sub_product_type" id="edit_sub_product_type"
                  class="form-control form-control-premium" required>
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

@endsection

@push('scripts')
  <script>
    $(document).ready(function () {
      // Initialize DataTable
      if ($.fn.DataTable.isDataTable('#product-type-table')) {
        $('#product-type-table').DataTable().destroy();
      }
      $('#product-type-table').DataTable({
        dom: 'Bfrtip',
        buttons: [{
          extend: 'excelHtml5',
          text: '<i class="fa fa-file-excel-o"></i> Excel',
          className: 'btn btn-sm btn-outline-success mb-3'
        }]
      });

      // Handle Edit Click
      $('.editProductTypeBtn').on('click', function () {
        const type = $(this).data('type');
        $('#edit_product_type').val(type.product_type);
        $('#edit_sub_product_type').val(type.sub_product_type);

        let updateUrl = "{{ route('admin.product-type.update', ['uuid' => ':uuid']) }}";
        $('#editProductTypeForm').attr('action', updateUrl.replace(':uuid', type.uuid));
        $('#editProductTypeModal').modal('show');
      });
    });
  </script>
@endpush