@extends('backend.common.master')

@section('main-section')
  <div class="container-fluid">
    <div class="page-title">
      <div class="row">
        <div class="col-6">
          <h4>Area List</h4>
        </div>
        <div class="col-6">
          <ol class="breadcrumb justify-content-end">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
            <li class="breadcrumb-item active">Area List</li>
            <button type="button" class="btn btn-primary-custom ms-3" data-bs-toggle="modal"
              data-bs-target="#addAreaModal">
              <i class="fa fa-plus me-1"></i> Add Area
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
              <table class="display table-premium" id="area-table">
                <thead>
                  <tr>
                    <th>Sr.no</th>
                    <th>Area</th>
                    <th>City</th>
                    <th>State</th>
                    <th>Created By</th>
                    <th>Modified By</th>
                    <th width="120" class="text-center">Action</th>
                  </tr>
                </thead>
                <tbody>
                  @php $i = 0; @endphp
                  @foreach($areaList as $area)
                    @php $i++; @endphp
                    <tr>
                      <td>{{ $i }}</td>
                      <td class="fw-medium">{{ $area->area }}</td>
                      <td>{{ $area->city }}</td>
                      <td>{{ $area->state }}</td>
                      <td>{{ $area->created_by }}</td>
                      <td>{{ $area->modified_by }}</td>
                      <td class="text-center">
                        <div class="d-flex justify-content-center align-items-center gap-2">
                          <a href="javascript:void(0);" class="btn btn-sm-custom btn-outline-dark editAreaBtn"
                            data-area="{{ json_encode($area) }}" data-bs-toggle="tooltip" title="Edit">
                            <i class="icon-pencil-alt"></i>
                          </a>
                          <a href="{{ route('admin.area.delete', ['uuid' => $area->uuid]) }}"
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

  <!-- Add Area Modal -->
  <div class="modal fade" id="addAreaModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
      <div class="modal-content modal-content-premium">
        <div class="modal-header modal-header-premium">
          <h5 class="modal-title modal-title-premium text-white">Add Area</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <form action="{{ route('admin.area.store') }}" method="POST" class="needs-validation" novalidate>
          @csrf
          <div class="modal-body p-4">
            <div class="row g-3">
              <div class="col-12">
                <label class="form-label-premium">City <span class="text-danger">*</span></label>
                <select name="city_id" id="add_city_id" class="form-select select2-modal" required>
                  <option value="">Select City</option>
                  @foreach($cityList as $city)
                    <option value="{{ $city->id }}">{{ $city->city }}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-12">
                <label class="form-label-premium">State <span class="text-danger">*</span></label>
                <select name="state_id" id="add_state_id" class="form-select select2-modal" required readonly>
                  <option value="">Select State</option>
                  @foreach($stateList as $state)
                    <option value="{{ $state->id }}">{{ $state->state }}</option>
                  @endforeach
                </select>
                <div class="form-text mt-1 text-muted small">State is auto-selected based on city.</div>
              </div>
              <div class="col-12">
                <label class="form-label-premium">Area Name <span class="text-danger">*</span></label>
                <input type="text" name="area" class="form-control form-control-premium" required
                  placeholder="Enter area name">
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

  <!-- Edit Area Modal -->
  <div class="modal fade" id="editAreaModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
      <div class="modal-content modal-content-premium">
        <div class="modal-header modal-header-premium">
          <h5 class="modal-title modal-title-premium text-white">Edit Area</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <form id="editAreaForm" method="POST" class="needs-validation" novalidate>
          @csrf
          <div class="modal-body p-4">
            <div class="row g-3">
              <div class="col-12">
                <label class="form-label-premium">City <span class="text-danger">*</span></label>
                <select name="city_id" id="edit_city_id" class="form-select select2-modal" required>
                  <option value="">Select City</option>
                  @foreach($cityList as $city)
                    <option value="{{ $city->id }}">{{ $city->city }}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-12">
                <label class="form-label-premium">State <span class="text-danger">*</span></label>
                <select name="state_id" id="edit_state_id" class="form-select select2-modal" required readonly>
                  <option value="">Select State</option>
                  @foreach($stateList as $state)
                    <option value="{{ $state->id }}">{{ $state->state }}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-12">
                <label class="form-label-premium">Area Name <span class="text-danger">*</span></label>
                <input type="text" name="area" id="edit_area_name" class="form-control form-control-premium" required>
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
      if ($.fn.DataTable.isDataTable('#area-table')) {
        $('#area-table').DataTable().destroy();
      }
      $('#area-table').DataTable({
        dom: 'Bfrtip',
        buttons: [{
          extend: 'excelHtml5',
          text: '<i class="fa fa-file-excel-o"></i> Excel',
          className: 'btn btn-sm btn-outline-success mb-3'
        }]
      });

      // City-State Dependency Logic
      function handleCityStateDependency(citySelector, stateSelector) {
        $(citySelector).on('change', function () {
          const cityID = $(this).val();
          if (cityID) {
            $.ajax({
              url: "{{ route('admin.area.city.state') }}",
              type: "POST",
              data: {
                cityID: cityID,
                _token: "{{ csrf_token() }}"
              },
              success: function (data) {
                if (data && data.length > 0) {
                  $(stateSelector).val(data[0].id).trigger('change');
                }
              }
            });
          }
        });
      }

      handleCityStateDependency('#add_city_id', '#add_state_id');
      handleCityStateDependency('#edit_city_id', '#edit_state_id');

      // Handle Edit Click
      $('.editAreaBtn').on('click', function () {
        const area = $(this).data('area');
        $('#edit_city_id').val(area.city_id).trigger('change');
        $('#edit_state_id').val(area.state_id).trigger('change');
        $('#edit_area_name').val(area.area);

        let updateUrl = "{{ route('admin.area.update', ['uuid' => ':uuid']) }}";
        $('#editAreaForm').attr('action', updateUrl.replace(':uuid', area.uuid));
        $('#editAreaModal').modal('show');
      });
    });
  </script>
@endpush