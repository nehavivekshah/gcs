@extends('backend.common.master')

@section('main-section')
  <div class="container-fluid">
    <div class="page-title">
      <div class="row">
        <div class="col-6">
          <h4>Year List</h4>
        </div>
        <div class="col-6">
          <ol class="breadcrumb justify-content-end">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
            <li class="breadcrumb-item active">Year List</li>
            <button type="button" class="btn btn-primary-custom ms-3" data-bs-toggle="modal"
              data-bs-target="#addYearModal">
              <i class="fa fa-plus me-1"></i> Add Year
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
              <table class="display table-premium" id="year-table">
                <thead>
                  <tr>
                    <th>Sr.no</th>
                    <th>Financial Year</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th width="120" class="text-center">Action</th>
                  </tr>
                </thead>
                <tbody>

                  @php $i = 0; @endphp
                  @foreach($yearList as $year)
                    @php $i++; @endphp
                    <tr>
                      <td>{{ $i }}</td>
                      <td class="fw-medium">{{ $year->financial_year }}</td>
                      <td>{{ $year->start_date }}</td>
                      <td>{{ $year->end_date }}</td>
                      <td class="text-center">
                        <div class="d-flex justify-content-center align-items-center gap-2">
                          <a href="javascript:void(0);" class="btn btn-sm-custom btn-outline-dark editYearBtn"
                            data-uuid="{{ $year->uuid }}" data-financial_year="{{ $year->financial_year }}"
                            data-start_date="{{ $year->start_date }}" data-end_date="{{ $year->end_date }}"
                            data-bs-toggle="tooltip" title="Edit">
                            <i class="icon-pencil-alt"></i>
                          </a>
                          <a href="{{ route('admin.year.delete', ['uuid' => $year->uuid]) }}"
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

  <!-- Add Year Modal -->
  <div class="modal fade" id="addYearModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content modal-content-premium">
        <div class="modal-header modal-header-premium">
          <h5 class="modal-title modal-title-premium text-white">Add Year</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <form action="{{ route('admin.year.store') }}" method="POST" class="needs-validation" novalidate>
          @csrf
          <div class="modal-body p-4">
            <div class="row g-3">
              <div class="col-md-12">
                <label class="form-label-premium">Financial Year <span class="text-danger">*</span></label>
                <input type="text" name="financial_year" class="form-control form-control-premium"
                  placeholder="e.g. 2023-2024" required>
                <div class="invalid-feedback">Please enter financial year.</div>
              </div>
              <div class="col-md-6">
                <label class="form-label-premium">Start Date <span class="text-danger">*</span></label>
                <input type="date" name="start_date" class="form-control form-control-premium" required>
                <div class="invalid-feedback">Please select start date.</div>
              </div>
              <div class="col-md-6">
                <label class="form-label-premium">End Date <span class="text-danger">*</span></label>
                <input type="date" name="end_date" class="form-control form-control-premium" required>
                <div class="invalid-feedback">Please select end date.</div>
              </div>
            </div>
          </div>
          <div class="modal-footer border-0 p-4 pt-0">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary-custom">Save Year</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Edit Year Modal -->
  <div class="modal fade" id="editYearModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content modal-content-premium">
        <div class="modal-header modal-header-premium">
          <h5 class="modal-title modal-title-premium text-white">Edit Year</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <form id="editYearForm" method="POST" class="needs-validation" novalidate>
          @csrf
          @method('PATCH')
          <div class="modal-body p-4">
            <div class="row g-3">
              <div class="col-md-12">
                <label class="form-label-premium">Financial Year <span class="text-danger">*</span></label>
                <input type="text" name="financial_year" id="edit_financial_year"
                  class="form-control form-control-premium" placeholder="e.g. 2023-2024" required>
                <div class="invalid-feedback">Please enter financial year.</div>
              </div>
              <div class="col-md-6">
                <label class="form-label-premium">Start Date <span class="text-danger">*</span></label>
                <input type="date" name="start_date" id="edit_start_date" class="form-control form-control-premium"
                  required>
                <div class="invalid-feedback">Please select start date.</div>
              </div>
              <div class="col-md-6">
                <label class="form-label-premium">End Date <span class="text-danger">*</span></label>
                <input type="date" name="end_date" id="edit_end_date" class="form-control form-control-premium" required>
                <div class="invalid-feedback">Please select end date.</div>
              </div>
            </div>
          </div>
          <div class="modal-footer border-0 p-4 pt-0">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary-custom">Update Year</button>
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
      if ($.fn.DataTable.isDataTable('#year-table')) {
        $('#year-table').DataTable().destroy();
      }

      $('#year-table').DataTable({
        dom: 'Bfrtip',
        buttons: [{
          extend: 'excelHtml5',
          text: '<i class="fa fa-file-excel-o"></i> Excel',
          className: 'btn btn-sm btn-outline-success mb-3'
        }]
      });

      // Handle Edit Button Click
      $('.editYearBtn').on('click', function () {
        const d = $(this).data();

        // Set values in modal
        $('#edit_financial_year').val(d.financial_year);
        $('#edit_start_date').val(d.start_date);
        $('#edit_end_date').val(d.end_date);

        // Update form action URL
        let updateUrl = "{{ route('admin.year.update', ['uuid' => ':uuid']) }}";
        updateUrl = updateUrl.replace(':uuid', d.uuid);
        $('#editYearForm').attr('action', updateUrl);

        // Show modal
        $('#editYearModal').modal('show');
      });
    });
  </script>
@endpush