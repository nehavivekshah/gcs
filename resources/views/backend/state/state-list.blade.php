@extends('backend.common.master')

@section('main-section')
  <div class="container-fluid">
    <div class="page-title">
      <div class="row">
        <div class="col-6">
          <h4>State List</h4>
        </div>
        <div class="col-6">
          <ol class="breadcrumb justify-content-end">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
            <li class="breadcrumb-item active">State List</li>
            <button type="button" class="btn btn-primary-custom ms-3" data-bs-toggle="modal"
              data-bs-target="#addStateModal">
              <i class="fa fa-plus me-1"></i> Add State
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
              <table class="display table-premium" id="state-table">
                <thead>
                  <tr>
                    <th>Sr.no</th>
                    <th>State Name</th>
                    <th>Created By</th>
                    <th>Modified By</th>
                    <th width="120" class="text-center">Action</th>
                  </tr>
                </thead>
                <tbody>
                  @php $i = 0; @endphp
                  @foreach($stateList as $state)
                    @php $i++; @endphp
                    <tr>
                      <td>{{ $i }}</td>
                      <td class="fw-medium">{{ $state->state }}</td>
                      <td>{{ $state->created_by }}</td>
                      <td>{{ $state->modified_by }}</td>
                      <td class="text-center">
                        <div class="d-flex justify-content-center align-items-center gap-2">
                          <a href="javascript:void(0);" class="btn btn-sm-custom btn-outline-dark editStateBtn"
                            data-state="{{ json_encode($state) }}" data-bs-toggle="tooltip" title="Edit">
                            <i class="icon-pencil-alt"></i>
                          </a>
                          <a href="{{ route('admin.state.delete', ['uuid' => $state->uuid]) }}"
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

  <!-- Add State Modal -->
  <div class="modal fade" id="addStateModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
      <div class="modal-content modal-content-premium">
        <div class="modal-header modal-header-premium">
          <h5 class="modal-title modal-title-premium text-white">Add State</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <form action="{{ route('admin.state.store') }}" method="POST" class="needs-validation" novalidate>
          @csrf
          <div class="modal-body p-4">
            <div class="row g-3">
              <div class="col-12">
                <label class="form-label-premium">State Name <span class="text-danger">*</span></label>
                <input type="text" name="state" class="form-control form-control-premium" required
                  placeholder="Enter state name">
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

  <!-- Edit State Modal -->
  <div class="modal fade" id="editStateModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
      <div class="modal-content modal-content-premium">
        <div class="modal-header modal-header-premium">
          <h5 class="modal-title modal-title-premium text-white">Edit State</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <form id="editStateForm" method="POST" class="needs-validation" novalidate>
          @csrf
          <div class="modal-body p-4">
            <div class="row g-3">
              <div class="col-12">
                <label class="form-label-premium">State Name <span class="text-danger">*</span></label>
                <input type="text" name="state" id="edit_state_name" class="form-control form-control-premium" required>
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
      if ($.fn.DataTable.isDataTable('#state-table')) {
        $('#state-table').DataTable().destroy();
      }
      $('#state-table').DataTable({
        dom: 'Bfrtip',
        buttons: [{
          extend: 'excelHtml5',
          text: '<i class="fa fa-file-excel-o"></i> Excel',
          className: 'btn btn-sm btn-outline-success mb-3'
        }]
      });

      // Handle Edit Click
      $('.editStateBtn').on('click', function () {
        const state = $(this).data('state');
        $('#edit_state_name').val(state.state);

        let updateUrl = "{{ route('admin.state.update', ['uuid' => ':uuid']) }}";
        $('#editStateForm').attr('action', updateUrl.replace(':uuid', state.uuid));
        $('#editStateModal').modal('show');
      });
    });
  </script>
@endpush