@extends('backend.common.master')

@section('main-section')
  <div class="container-fluid">
    <div class="page-title">
      <div class="row">
        <div class="col-6">
          <h4>AMC Product List</h4>
        </div>
        <div class="col-6">
          <ol class="breadcrumb justify-content-end">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
            <li class="breadcrumb-item active">AMC Product List</li>
            <button type="button" class="btn btn-primary-custom ms-3" data-bs-toggle="modal"
              data-bs-target="#addAmcProductModal">
              <i class="fa fa-plus me-1"></i> Add AMC Product
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
              <table class="display table-premium" id="amc-product-table">
                <thead>
                  <tr>
                    <th>Sr.no</th>
                    <th>Product</th>
                    <th>Non-Comp AMC Rate</th>
                    <th>Comp AMC Rate</th>
                    <th>Created By</th>
                    <th>Modified By</th>
                    <th width="120" class="text-center">Action</th>
                  </tr>
                </thead>
                <tbody>
                  @php $i = 0; @endphp
                  @foreach($amcProductList as $amcProduct)
                    @php $i++; @endphp
                    <tr>
                      <td>{{ $i }}</td>
                      <td class="fw-medium">{{ $amcProduct->amc_product }}</td>
                      <td>{{ $amcProduct->non_comp_amc_rate }}</td>
                      <td>{{ $amcProduct->comp_amc_rate }}</td>
                      <td>{{ $amcProduct->created_by }}</td>
                      <td>{{ $amcProduct->modified_by }}</td>
                      <td class="text-center">
                        <div class="d-flex justify-content-center align-items-center gap-2">
                          <a href="javascript:void(0);" class="btn btn-sm-custom btn-outline-dark editAmcProductBtn"
                            data-amc-product="{{ json_encode($amcProduct) }}" data-bs-toggle="tooltip" title="Edit">
                            <i class="icon-pencil-alt"></i>
                          </a>
                          <a href="{{ route('admin.amc-product.delete', ['uuid' => $amcProduct->uuid]) }}"
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

  <!-- Add AMC Product Modal -->
  <div class="modal fade" id="addAmcProductModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
      <div class="modal-content modal-content-premium">
        <div class="modal-header modal-header-premium">
          <h5 class="modal-title modal-title-premium text-white">Add AMC Product</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <form action="{{ route('admin.amc-product.store') }}" method="POST" class="needs-validation" novalidate>
          @csrf
          <div class="modal-body p-4">
            <div class="row g-3">
              <div class="col-12">
                <label class="form-label-premium">Product <span class="text-danger">*</span></label>
                <input type="text" name="amc_product" class="form-control form-control-premium" required
                  placeholder="Enter product name">
              </div>
              <div class="col-md-6">
                <label class="form-label-premium">Non-Comp AMC Rate <span class="text-danger">*</span></label>
                <input type="number" step="0.01" name="non_comp_amc_rate" class="form-control form-control-premium"
                  required placeholder="0.00">
              </div>
              <div class="col-md-6">
                <label class="form-label-premium">Comp AMC Rate <span class="text-danger">*</span></label>
                <input type="number" step="0.01" name="comp_amc_rate" class="form-control form-control-premium" required
                  placeholder="0.00">
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

  <!-- Edit AMC Product Modal -->
  <div class="modal fade" id="editAmcProductModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
      <div class="modal-content modal-content-premium">
        <div class="modal-header modal-header-premium">
          <h5 class="modal-title modal-title-premium text-white">Edit AMC Product</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <form id="editAmcProductForm" method="POST" class="needs-validation" novalidate>
          @csrf
          <div class="modal-body p-4">
            <div class="row g-3">
              <div class="col-12">
                <label class="form-label-premium">Product <span class="text-danger">*</span></label>
                <input type="text" name="amc_product" id="edit_amc_product" class="form-control form-control-premium"
                  required>
              </div>
              <div class="col-md-6">
                <label class="form-label-premium">Non-Comp AMC Rate <span class="text-danger">*</span></label>
                <input type="number" step="0.01" name="non_comp_amc_rate" id="edit_non_comp_amc_rate"
                  class="form-control form-control-premium" required>
              </div>
              <div class="col-md-6">
                <label class="form-label-premium">Comp AMC Rate <span class="text-danger">*</span></label>
                <input type="number" step="0.01" name="comp_amc_rate" id="edit_comp_amc_rate"
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
      if ($.fn.DataTable.isDataTable('#amc-product-table')) {
        $('#amc-product-table').DataTable().destroy();
      }
      $('#amc-product-table').DataTable({
        dom: 'Bfrtip',
        buttons: [{
          extend: 'excelHtml5',
          text: '<i class="fa fa-file-excel-o"></i> Excel',
          className: 'btn btn-sm btn-outline-success mb-3'
        }]
      });

      // Handle Edit Click
      $('.editAmcProductBtn').on('click', function () {
        const amcProduct = $(this).data('amc-product');
        $('#edit_amc_product').val(amcProduct.amc_product);
        $('#edit_non_comp_amc_rate').val(amcProduct.non_comp_amc_rate);
        $('#edit_comp_amc_rate').val(amcProduct.comp_amc_rate);

        let updateUrl = "{{ route('admin.amc-product.update', ['uuid' => ':uuid']) }}";
        $('#editAmcProductForm').attr('action', updateUrl.replace(':uuid', amcProduct.uuid));
        $('#editAmcProductModal').modal('show');
      });
    });
  </script>
@endpush