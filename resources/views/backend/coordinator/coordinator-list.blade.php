@extends('backend.common.master')
@section('main-section')
<div class="container-fluid">
  <div class="page-title">
    <div class="row">
      <div class="col-6">
        <h4>Coordinator List</h4>
      </div>
      <div class="col-6">
        <div class="col-6">
          <ol class="breadcrumb justify-content-end">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
            <li class="breadcrumb-item active">Coordinator List</li>
            <a href="{{ route('admin.coordinator.create') }}" class="ms-3">
              <button type="button" class="btn btn-primary-custom" data-bs-toggle="tooltip" title="Add Coordinator">
                <i class="fa fa-plus me-1"></i> Add Coordinator
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
                    <th>Created By</th>
                    <th>Modified By</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>

                  @php $i = 0; @endphp
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
                      <td class="text-center">
                        <div class="d-flex justify-content-center align-items-center gap-2">
                          <a href="{{ route('admin.coordinator.edit', ['uuid' => $coordinators->uuid]) }}"
                            class="btn btn-sm-custom btn-outline-dark" data-bs-toggle="tooltip" title="Edit">
                            <i class="icon-pencil-alt"></i>
                          </a>
                          <a href="{{ route('admin.coordinator.delete', ['uuid' => $coordinators->uuid]) }}"
                            class="btn btn-sm-custom btn-outline-dark" data-bs-toggle="tooltip" title="Delete">
                            <i class="icon-trash"></i></a>
                        </div>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>

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