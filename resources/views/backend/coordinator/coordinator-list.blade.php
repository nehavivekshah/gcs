@extends('backend.common.master')
@section('main-section')
<div class="container-fluid">
  <div class="page-title">
    <div class="row">
      <div class="col-6">
        <h4>Coordinator List</h4>
      </div>
      <div class="col-6">
        <ol class="breadcrumb">
          <a href="{{ route('admin.coordinator.create') }}">
            <button type="button" class="btn btn-lg" data-bs-toggle="tooltip" title="Add Coordinator" style="background:#bf0103;color:white;">  Add Coordinator </button>
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
                  <th>Created By</th>
                  <th>Modified By</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>

              @php $i=0; @endphp
                @foreach($coordinatorList as $coordinators)
                  @php $i++; @endphp
                <tr>
                  <td>{{ $i }}</td>
                  <td>{{ $coordinators->user_name }}</td>
                  <td>{{ $coordinators->password }}</td>
                  <td>{{ $coordinators->outlook_email }}</td>
                  <td>{{ $coordinators->outlook_password }}</td>
                  <td>{{ $coordinators->created_by }}</td>
                  <td>{{ $coordinators->modified_by }}</td>
                  <td>
                    <ul class="action">
                      <li class="edit">
                        <a href="{{ route('admin.coordinator.edit',['uuid' => $coordinators->uuid]) }}">
                          <i class="icon-pencil-alt"></i>
                        </a>
                      </li>
                      <li class="delete">
                        
                        <a href="{{ route('admin.coordinator.delete',['uuid' => $coordinators->uuid]) }}"><i class="icon-trash"></i></a>
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