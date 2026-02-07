@extends('backend.common.master')

@section('main-section')
  <div class="container-fluid">
    <div class="page-title">
      <div class="row">
        <div class="col-6">
          <h4>Engineers List</h4>
        </div>
        <div class="col-6">
          <ol class="breadcrumb justify-content-end">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
            <li class="breadcrumb-item active">Engineers List</li>
            <button type="button" class="btn btn-primary-custom ms-3" data-bs-toggle="modal"
              data-bs-target="#addEngineerModal">
              <i class="fa fa-plus me-1"></i> Add Engineer
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
              <table class="display table-premium" id="engineer-table">
                <thead>
                  <tr>
                    <th>Sr.no</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Password</th>
                    <th>Designation</th>
                    <th width="120" class="text-center">Action</th>
                  </tr>
                </thead>
                <tbody>

                  @php $i = 0; @endphp
                  @foreach($engineerList as $engineers)
                    @php $i++; @endphp

                    <tr>
                      <td> {{ $i }}</td>
                      <td class="fw-medium">{{ $engineers->name }}</td>
                      <td>
                        {{ $engineers->email1 }} <br>
                        <small class="text-muted">{{ $engineers->email2 }}</small>
                      </td>
                      <td>
                        {{ $engineers->phone1 }} <br>
                        <small class="text-muted">{{ $engineers->phone2 }}</small>
                      </td>
                      <td>{{ $engineers->password }}</td>
                      <td>{{ $engineers->designation }}</td>
                      <td class="text-center">
                        <div class="d-flex justify-content-center align-items-center gap-2">
                          <a href="javascript:void(0);" class="btn btn-sm-custom btn-outline-dark editEngineerBtn"
                            data-uuid="{{ $engineers->uuid }}" data-name="{{ $engineers->name }}"
                            data-email1="{{ $engineers->email1 }}" data-email2="{{ $engineers->email2 }}"
                            data-phone1="{{ $engineers->phone1 }}" data-phone2="{{ $engineers->phone2 }}"
                            data-designation="{{ $engineers->designation }}" data-bs-toggle="tooltip" title="Edit">
                            <i class="icon-pencil-alt"></i>
                          </a>
                          <a href="{{ route('admin.engineer.delete', ['uuid' => $engineers->uuid]) }}"
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

  <!-- Add Engineer Modal -->
  <div class="modal fade" id="addEngineerModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content modal-content-premium">
        <div class="modal-header modal-header-premium">
          <h5 class="modal-title modal-title-premium text-white">Add Engineer</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <form action="{{ route('admin.engineer.store') }}" method="POST" class="needs-validation" novalidate>
          @csrf
          <div class="modal-body p-4">
            <div class="row g-3">
              <div class="col-md-6">
                <label class="form-label-premium">Name <span class="text-danger">*</span></label>
                <input type="text" name="user_name" class="form-control form-control-premium" placeholder="Enter Name"
                  required>
                <div class="invalid-feedback">Please enter name.</div>
              </div>
              <div class="col-md-6">
                <label class="form-label-premium">Designation <span class="text-danger">*</span></label>
                <input type="text" name="designation" class="form-control form-control-premium"
                  placeholder="Enter Designation" required>
                <div class="invalid-feedback">Please enter designation.</div>
              </div>
              <div class="col-md-6">
                <label class="form-label-premium">Email 1 <span class="text-danger">*</span></label>
                <input type="email" name="email1" class="form-control form-control-premium" placeholder="Enter Email 1"
                  required>
                <div class="invalid-feedback">Please enter email 1.</div>
              </div>
              <div class="col-md-6">
                <label class="form-label-premium">Email 2</label>
                <input type="email" name="email2" class="form-control form-control-premium" placeholder="Enter Email 2">
              </div>
              <div class="col-md-6">
                <label class="form-label-premium">Phone 1 <span class="text-danger">*</span></label>
                <input type="text" name="phone1" class="form-control form-control-premium" placeholder="Enter Phone 1"
                  required>
                <div class="invalid-feedback">Please enter phone 1.</div>
              </div>
              <div class="col-md-6">
                <label class="form-label-premium">Phone 2</label>
                <input type="text" name="phone2" class="form-control form-control-premium" placeholder="Enter Phone 2">
              </div>
            </div>
          </div>
          <div class="modal-footer border-0 p-4 pt-0">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary-custom">Save Engineer</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Edit Engineer Modal -->
  <div class="modal fade" id="editEngineerModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content modal-content-premium">
        <div class="modal-header modal-header-premium">
          <h5 class="modal-title modal-title-premium text-white">Edit Engineer</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <form id="editEngineerForm" method="POST" class="needs-validation" novalidate>
          @csrf
          @method('PATCH')
          <div class="modal-body p-4">
            <div class="row g-3">
              <div class="col-md-6">
                <label class="form-label-premium">Name <span class="text-danger">*</span></label>
                <input type="text" name="user_name" id="edit_name" class="form-control form-control-premium"
                  placeholder="Enter Name" required>
                <div class="invalid-feedback">Please enter name.</div>
              </div>
              <div class="col-md-6">
                <label class="form-label-premium">Designation <span class="text-danger">*</span></label>
                <input type="text" name="designation" id="edit_designation" class="form-control form-control-premium"
                  placeholder="Enter Designation" required>
                <div class="invalid-feedback">Please enter designation.</div>
              </div>
              <div class="col-md-6">
                <label class="form-label-premium">Email 1 <span class="text-danger">*</span></label>
                <input type="email" name="email1" id="edit_email1" class="form-control form-control-premium"
                  placeholder="Enter Email 1" required>
                <div class="invalid-feedback">Please enter email 1.</div>
              </div>
              <div class="col-md-6">
                <label class="form-label-premium">Email 2</label>
                <input type="email" name="email2" id="edit_email2" class="form-control form-control-premium"
                  placeholder="Enter Email 2">
              </div>
              <div class="col-md-6">
                <label class="form-label-premium">Phone 1 <span class="text-danger">*</span></label>
                <input type="text" name="phone1" id="edit_phone1" class="form-control form-control-premium"
                  placeholder="Enter Phone 1" required>
                <div class="invalid-feedback">Please enter phone 1.</div>
              </div>
              <div class="col-md-6">
                <label class="form-label-premium">Phone 2</label>
                <input type="text" name="phone2" id="edit_phone2" class="form-control form-control-premium"
                  placeholder="Enter Phone 2">
              </div>
            </div>
          </div>
          <div class="modal-footer border-0 p-4 pt-0">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary-custom">Update Engineer</button>
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
      if ($.fn.DataTable.isDataTable('#engineer-table')) {
        $('#engineer-table').DataTable().destroy();
      }

      $('#engineer-table').DataTable({
        dom: 'Bfrtip',
        buttons: [{
          extend: 'excelHtml5',
          text: '<i class="fa fa-file-excel-o"></i> Excel',
          className: 'btn btn-sm btn-outline-success mb-3'
        }]
      });

      // Handle Edit Button Click
      $('.editEngineerBtn').on('click', function () {
        const d = $(this).data();

        // Set values in modal
        $('#edit_name').val(d.name);
        $('#edit_email1').val(d.email1);
        $('#edit_email2').val(d.email2);
        $('#edit_phone1').val(d.phone1);
        $('#edit_phone2').val(d.phone2);
        $('#edit_designation').val(d.designation);

        // Update form action URL
        let updateUrl = "{{ route('admin.engineer.update', ['uuid' => ':uuid']) }}";
        updateUrl = updateUrl.replace(':uuid', d.uuid);
        $('#editEngineerForm').attr('action', updateUrl);

        // Show modal
        $('#editEngineerModal').modal('show');
      });
    });
  </script>
@endpush