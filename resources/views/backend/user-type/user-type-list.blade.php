@extends('backend.common.master')

@section('main-section')
  <div class="container-fluid">
    <div class="page-title">
      <div class="row">
        <div class="col-6">
          <h4>User Type</h4>
        </div>
        <div class="col-6">
          <ol class="breadcrumb justify-content-end">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
            <li class="breadcrumb-item active">User Type List</li>
            <button type="button" class="btn btn-primary-custom ms-3" data-bs-toggle="modal"
              data-bs-target="#addUserTypeModal">
              <i class="fa fa-plus me-1"></i> Add User Type
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
                    <th>User Type</th>
                    <th>Created By</th>
                    <th>Modified By</th>
                    <th width="120" class="text-center">Action</th>
                  </tr>
                </thead>
                <tbody>

                  @php $i = 0; @endphp
                  @foreach($userTypeList as $userType)
                    @php $i++; @endphp

                    <tr>
                      <td>{{ $i }}</td>
                      <td class="fw-medium">{{ $userType->user_type }}</td>
                      <td>{{ $userType->created_by }}</td>
                      <td>{{ $userType->modified_by }}</td>
                      <td class="text-center">
                        <div class="d-flex justify-content-center align-items-center gap-2">
                          <a href="javascript:void(0);" class="btn btn-sm-custom btn-outline-dark editUserTypeBtn"
                            data-uuid="{{ $userType->uuid }}" data-user_type="{{ $userType->user_type }}"
                            data-bs-toggle="tooltip" title="Edit">
                            <i class="icon-pencil-alt"></i>
                          </a>
                          <a href="{{ route('admin.user-type.delete', ['uuid' => $userType->uuid]) }}"
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

  <!-- Add User Type Modal -->
  <div class="modal fade" id="addUserTypeModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content modal-content-premium">
        <div class="modal-header modal-header-premium">
          <h5 class="modal-title modal-title-premium text-white">Add User Type</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <form action="{{ route('admin.user-type.store') }}" method="POST" class="needs-validation" novalidate>
          @csrf
          <div class="modal-body p-4">
            <div class="mb-3">
              <label class="form-label-premium">User Type <span class="text-danger">*</span></label>
              <input type="text" name="user_type" class="form-control form-control-premium" placeholder="Enter User Type"
                required>
              <div class="invalid-feedback">Please enter user type.</div>
            </div>
          </div>
          <div class="modal-footer border-0 p-4 pt-0">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary-custom">Save User Type</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Edit User Type Modal -->
  <div class="modal fade" id="editUserTypeModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content modal-content-premium">
        <div class="modal-header modal-header-premium">
          <h5 class="modal-title modal-title-premium text-white">Edit User Type</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <form id="editUserTypeForm" method="POST" class="needs-validation" novalidate>
          @csrf
          @method('PATCH')
          <div class="modal-body p-4">
            <div class="mb-3">
              <label class="form-label-premium">User Type <span class="text-danger">*</span></label>
              <input type="text" name="user_type" id="edit_user_type_name" class="form-control form-control-premium"
                placeholder="Enter User Type" required>
              <div class="invalid-feedback">Please enter user type.</div>
            </div>
          </div>
          <div class="modal-footer border-0 p-4 pt-0">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary-custom">Update User Type</button>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection

@push('scripts')
  <script>
    $(document).ready(function () {
      // Handle Edit Button Click
      $('.editUserTypeBtn').on('click', function () {
        const uuid = $(this).data('uuid');
        const userType = $(this).data('user_type');

        // Set values in modal
        $('#edit_user_type_name').val(userType);

        // Update form action URL
        let updateUrl = "{{ route('admin.user-type.update', ['uuid' => ':uuid']) }}";
        updateUrl = updateUrl.replace(':uuid', uuid);
        $('#editUserTypeForm').attr('action', updateUrl);

        // Show modal
        $('#editUserTypeModal').modal('show');
      });
    });
  </script>
@endpush