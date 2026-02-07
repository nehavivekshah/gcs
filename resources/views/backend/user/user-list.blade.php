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
            <a href="{{ route('admin.user.create') }}" class="ms-3">
              <button type="button" class="btn btn-primary-custom" data-bs-toggle="tooltip" title="Add User">
                <i class="fa fa-plus me-1"></i> Add User
              </button>
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
                      <td>{{ $users->user_name }}</td>
                      <td>{{ $users->password }}</td>
                      <td>{{ $users->outlook_email }}</td>
                      <td>{{ $users->outlook_password }}</td>
                      <td>{{ $users->host }}</td>
                      <td>{{ $users->type }}</td>
                      <td class="text-center">
                        <div class="d-flex justify-content-center align-items-center gap-2">
                          <a href="{{ route('admin.user.edit', ['uuid' => $users->uuid]) }}"
                            class="btn btn-sm-custom btn-outline-dark" data-bs-toggle="tooltip" title="Edit">
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
      <!-- Zero Configuration  Ends-->
      <!-- Complex headers (rowspan and colspan) Starts-->

      <!-- Complex headers (rowspan and colspan) Ends-->
      <!-- State saving Starts-->

      <!-- State saving Ends-->
      <!-- Scroll - vertical dynamic Starts-->

      <!-- Scroll - vertical dynamic Ends-->
    </div>
  </div>
  <!-- Container-fluid Ends-->
@endsection

@push('scripts')
  <script>
    $(document).ready(function () {
      $('#user-table').DataTable({
        dom: 'Bfrtip',
        buttons: [{
          extend: 'excelHtml5',
          text: '<i class="fa fa-file-excel-o"></i> Excel',

        }]
      });
    });
  </script>
@endpush