@extends('backend.common.master')

@section('main-section')
  <div class="container-fluid">
    <div class="page-title">
      <div class="row">
        <div class="col-6">
          <h4>City List</h4>
        </div>
        <div class="col-6">
          <ol class="breadcrumb justify-content-end">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
            <li class="breadcrumb-item active">City List</li>
            <button type="button" class="btn btn-primary-custom ms-3" data-bs-toggle="modal"
              data-bs-target="#addCityModal">
              <i class="fa fa-plus me-1"></i> Add City
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
              <table class="display table-premium" id="city-table">
                <thead>
                  <tr>
                    <th>Sr.no</th>
                    <th>State</th>
                    <th>City</th>
                    <th>Created By</th>
                    <th>Modified By</th>
                    <th width="120" class="text-center">Action</th>
                  </tr>
                </thead>
                <tbody>
                  @php $i = 0; @endphp
                  @foreach($cityList as $city)
                    @php $i++; @endphp
                    <tr>
                      <td>{{ $i }}</td>
                      <td>{{ $city->state }}</td>
                      <td class="fw-medium">{{ $city->city }}</td>
                      <td>{{ $city->created_by }}</td>
                      <td>{{ $city->modified_by }}</td>
                      <td class="text-center">
                        <div class="d-flex justify-content-center align-items-center gap-2">
                          <a href="javascript:void(0);" class="btn btn-sm-custom btn-outline-dark editCityBtn"
                            data-city="{{ json_encode($city) }}" data-bs-toggle="tooltip" title="Edit">
                            <i class="icon-pencil-alt"></i>
                          </a>
                          <a href="{{ route('admin.city.delete', ['uuid' => $city->uuid]) }}"
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

  <!-- Add City Modal -->
  <div class="modal fade" id="addCityModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
      <div class="modal-content modal-content-premium">
        <div class="modal-header modal-header-premium">
          <h5 class="modal-title modal-title-premium text-white">Add City</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <form action="{{ route('admin.city.store') }}" method="POST" class="needs-validation" novalidate>
          @csrf
          <div class="modal-body p-4">
            <div class="row g-3">
              <div class="col-12">
                <label class="form-label-premium">State <span class="text-danger">*</span></label>
                <select name="state_id" class="form-select select2-modal" required>
                  <option value="">Select State</option>
                  @foreach($stateList as $state)
                    <option value="{{ $state->id }}">{{ $state->state }}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-12">
                <label class="form-label-premium">City Name <span class="text-danger">*</span></label>
                <input type="text" name="city" class="form-control form-control-premium" required
                  placeholder="Enter city name">
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

  <!-- Edit City Modal -->
  <div class="modal fade" id="editCityModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
      <div class="modal-content modal-content-premium">
        <div class="modal-header modal-header-premium">
          <h5 class="modal-title modal-title-premium text-white">Edit City</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <form id="editCityForm" method="POST" class="needs-validation" novalidate>
          @csrf
          <div class="modal-body p-4">
            <div class="row g-3">
              <div class="col-12">
                <label class="form-label-premium">State <span class="text-danger">*</span></label>
                <select name="state_id" id="edit_state_id" class="form-select select2-modal" required>
                  <option value="">Select State</option>
                  @foreach($stateList as $state)
                    <option value="{{ $state->id }}">{{ $state->state }}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-12">
                <label class="form-label-premium">City Name <span class="text-danger">*</span></label>
                <input type="text" name="city" id="edit_city_name" class="form-control form-control-premium" required>
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
      // Initialize Select2 for modals
      function initSelect2() {
        $('.select2-modal').each(function () {
          $(this).select2({
            dropdownParent: $(this).closest('.modal'),
            placeholder: 'Select an option',
            width: '100%'
          });
        });
      }

      initSelect2();

      // Initialize DataTable
      if ($.fn.DataTable.isDataTable('#city-table')) {
        $('#city-table').DataTable().destroy();
      }
      $('#city-table').DataTable({
        dom: 'Bfrtip',
        buttons: [{
          extend: 'excelHtml5',
          text: '<i class="fa fa-file-excel-o"></i> Excel',
          className: 'btn btn-sm btn-outline-success mb-3'
        }]
      });

      // Handle Edit Click
      $('.editCityBtn').on('click', function () {
        const city = $(this).data('city');
        $('#edit_state_id').val(city.state_id).trigger('change');
        $('#edit_city_name').val(city.city);

        let updateUrl = "{{ route('admin.city.update', ['uuid' => ':uuid']) }}";
        $('#editCityForm').attr('action', updateUrl.replace(':uuid', city.uuid));
        $('#editCityModal').modal('show');
      });
    });
  </script>
@endpush