@extends('backend.common.master')

@section('main-section')
  <div class="container-fluid">
    <div class="page-title">
      <div class="row">
        <div class="col-6">
          <h4>User List</h4>
        </div>
        <div class="col-6">
          <ol class="breadcrumb justify-content-end">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
            <li class="breadcrumb-item active">User List</li>
            <button type="button" class="btn btn-primary-custom ms-3" data-bs-toggle="modal"
              data-bs-target="#addUserModal">
              <i class="fa fa-plus me-1"></i> Add User
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
              <table class="display table-premium" id="user-table">
                <thead>
                  <tr>
                    <th>Sr.no</th>
                    <th>User Name</th>
                    <th>Password</th>
                    <th>Outlook Email</th>
                    <th>Outlook Password</th>
                    <th>Host</th>
                    <th>User Type</th>
                    <th class="text-center">Action</th>
                  </tr>
                </thead>
                <tbody>

                  @php $i = 0; @endphp
                  @foreach($usersList as $users)
                    @php $i++; @endphp
                    <tr>
                      <td>{{ $i }}</td>
                      <td class="fw-medium">{{ $users->user_name }}</td>
                      <td>{{ $users->password }}</td>
                      <td>{{ $users->outlook_email }}</td>
                      <td>{{ $users->outlook_password }}</td>
                      <td>{{ $users->host }}</td>
                      <td>{{ $users->type }}</td>
                      <td class="text-center">
                        <div class="d-flex justify-content-center align-items-center gap-2">
                          <a href="javascript:void(0);" class="btn btn-sm-custom btn-outline-dark editUserBtn"
                            data-uuid="{{ $users->uuid }}" data-user_name="{{ $users->user_name }}"
                            data-password="{{ $users->password }}" data-outlook_email="{{ $users->outlook_email }}"
                            data-outlook_password="{{ $users->outlook_password }}"
                            data-user_type_id="{{ $users->user_type }}" data-bs-toggle="tooltip" title="Edit">
                            <i class="icon-pencil-alt"></i>
                          </a>
                          <a href="{{ route('admin.user.delete', ['uuid' => $users->uuid]) }}"
                            class="btn btn-sm-custom btn-outline-dark"
                            onclick="return confirm('Are you sure you want to delete this record?');"
                            data-bs-toggle="tooltip" title="Delete">
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

  <!-- Add User Modal -->
  <div class="modal fade" id="addUserModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content modal-content-premium">
        <div class="modal-header modal-header-premium">
          <h5 class="modal-title modal-title-premium text-white">Add User</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <form action="{{ route('admin.user.store') }}" method="POST" class="needs-validation" novalidate>
          @csrf
          <div class="modal-body p-4">
            <div class="row g-3">
              <div class="col-md-6">
                <label class="form-label-premium">User Name <span class="text-danger">*</span></label>
                <input type="text" name="user_name" class="form-control form-control-premium"
                  placeholder="Enter User Name" required>
                <div class="invalid-feedback">Please enter user name.</div>
              </div>
              <div class="col-md-6">
                <label class="form-label-premium">Password <span class="text-danger">*</span></label>
                <input type="text" name="user_password" class="form-control form-control-premium"
                  placeholder="Enter Password" required>
                <div class="invalid-feedback">Please enter password.</div>
              </div>
              <div class="col-md-6">
                <label class="form-label-premium">Outlook Email <span class="text-danger">*</span></label>
                <input type="email" name="outlook_email" class="form-control form-control-premium"
                  placeholder="Enter Outlook Email" required>
                <div class="invalid-feedback">Please enter outlook email.</div>
              </div>
              <div class="col-md-6">
                <label class="form-label-premium">Outlook Password <span class="text-danger">*</span></label>
                <input type="text" name="outlook_password" class="form-control form-control-premium"
                  placeholder="Enter Outlook Password" required>
                <div class="invalid-feedback">Please enter outlook password.</div>
              </div>
              <div class="col-md-12">
                <label class="form-label-premium">User Type <span class="text-danger">*</span></label>
                <select class="form-control form-control-premium select2" name="user_type" required>
                  <option value="">Select User Type</option>
                  @foreach($userTypeList as $userType)
                    <option value="{{ $userType->id }}">{{ $userType->user_type }}</option>
                  @endforeach
                </select>
                <div class="invalid-feedback">Please select user type.</div>
              </div>
            </div>
          </div>
          <div class="modal-footer border-0 p-4 pt-0">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary-custom">Save User</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Edit User Modal -->
  <div class="modal fade" id="editUserModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content modal-content-premium">
        <div class="modal-header modal-header-premium">
          <h5 class="modal-title modal-title-premium text-white">Edit User</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <form id="editUserForm" method="POST" class="needs-validation" novalidate>
          @csrf
          @method('PATCH')
          <div class="modal-body p-4">
            <div class="row g-3">
              <div class="col-md-6">
                <label class="form-label-premium">User Name <span class="text-danger">*</span></label>
                <input type="text" name="user_name" id="edit_user_name" class="form-control form-control-premium"
                  placeholder="Enter User Name" required>
                <div class="invalid-feedback">Please enter user name.</div>
              </div>
              <div class="col-md-6">
                <label class="form-label-premium">Password <span class="text-danger">*</span></label>
                <input type="text" name="user_password" id="edit_password" class="form-control form-control-premium"
                  placeholder="Enter Password" required>
                <div class="invalid-feedback">Please enter password.</div>
              </div>
              <div class="col-md-6">
                <label class="form-label-premium">Outlook Email <span class="text-danger">*</span></label>
                <input type="email" name="outlook_email" id="edit_outlook_email" class="form-control form-control-premium"
                  placeholder="Enter Outlook Email" required>
                <div class="invalid-feedback">Please enter outlook email.</div>
              </div>
              <div class="col-md-6">
                <label class="form-label-premium">Outlook Password <span class="text-danger">*</span></label>
                <input type="text" name="outlook_password" id="edit_outlook_password"
                  class="form-control form-control-premium" placeholder="Enter Outlook Password" required>
                <div class="invalid-feedback">Please enter outlook password.</div>
              </div>
              <div class="col-md-12">
                <label class="form-label-premium">User Type <span class="text-danger">*</span></label>
                <select class="form-control form-control-premium select2" name="user_type" id="edit_user_type" required>
                  <option value="">Select User Type</option>
                  @foreach($userTypeList as $userType)
                    <option value="{{ $userType->id }}">{{ $userType->user_type }}</option>
                  @endforeach
                </select>
                <div class="invalid-feedback">Please select user type.</div>
              </div>
            </div>
          </div>
          <div class="modal-footer border-0 p-4 pt-0">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary-custom">Update User</button>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection

@push('scripts')
  <script>
    $(document).ready(function () {
      // Re-initialize DataTable with customized options
      if ($.fn.DataTable.isDataTable('#user-table')) {
        $('#user-table').DataTable().destroy();
      }

      $('#user-table').DataTable({
        dom: 'Bfrtip',
        buttons: [{
          extend: 'excelHtml5',
          text: '<i class="fa fa-file-excel-o"></i> Excel',
          className: 'btn btn-sm btn-outline-success mb-3'
        }]
      });

      // Handle Edit Button Click
      $('.editUserBtn').on('click', function () {
        const d = $(this).data();

        // Set values in modal
        $('#edit_user_name').val(d.user_name);
        $('#edit_password').val(d.password);
        $('#edit_outlook_email').val(d.outlook_email);
        $('#edit_outlook_password').val(d.outlook_password);
        $('#edit_user_type').val(d.user_type_id).trigger('change');

        // Update form action URL
        let updateUrl = "{{ route('admin.user.update', ['uuid' => ':uuid']) }}";
        updateUrl = updateUrl.replace(':uuid', d.uuid);
        $('#editUserForm').attr('action', updateUrl);

        // Show modal
        $('#editUserModal').modal('show');
      });
    });
  </script>
@endpush