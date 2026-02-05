@extends('backend.common.master')
@section('main-section')
<div class="container-fluid">
  <div class="page-title">
    <div class="row">
      <div class="col-6">
        <h4>User List</h4>
      </div>
      <div class="col-6">
        <ol class="breadcrumb">
          <a href="{{ route('admin.user.create') }}">
            <button type="button" class="btn btn-lg" data-bs-toggle="tooltip" title="Add User" style="background:#bf0103;color:white;">  Add User </button>
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
            <table class="display" id="user-table">
              <thead>
                <tr>
                  <th>Sr.no</th>
                  <th>User Name</th>
                  <th>Password</th>
                  <th>Outlook Email</th>
                  <th>Outlook Password</th>
                  <th>Host</th>
                  <th>User Type</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>

              @php $i=0; @endphp
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
                  <td>
                    <ul class="action">
                      <li class="edit">
                        <a href="{{ route('admin.user.edit',['uuid' => $users->uuid]) }}">
                          <i class="icon-pencil-alt"></i>
                        </a>
                      </li>
                      <li class="delete">
                        
                        <a href="{{ route('admin.user.delete',['uuid' => $users->uuid]) }}"><i class="icon-trash"></i></a>
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
  $(document).ready(function() {
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