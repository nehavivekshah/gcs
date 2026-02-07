@extends('backend.common.master')
@section('main-section')
  <div class="container-fluid">
    <div class="page-title">
      <div class="row">
        <div class="col-6">
          <h4>State List</h4>
        </div>
        <div class="col-6">
          <div class="col-6">
            <ol class="breadcrumb justify-content-end">
              <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
              <li class="breadcrumb-item active">State List</li>
              <a href="{{ route('admin.state.create') }}" class="ms-3">
                <button type="button" class="btn btn-primary-custom" data-bs-toggle="tooltip" title="Add State">
                  <i class="fa fa-plus me-1"></i> Add State
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
                <table class="display table-premium" id="basic-1">
                  <thead>
                    <tr>
                      <th>Sr.no</th>
                      <th>state</th>
                      <th>Created By</th>
                      <th>Modified By</th>
                      <th width="120" class="text-center">Action</th>
                    </tr>
                  </thead>
                  <tbody>

                    @php $i = 0; @endphp
                    @foreach($stateList as $states)
                      @php $i++; @endphp

                      <tr>
                        <td>{{ $i }}</td>
                        <td>{{ $states->state }}</td>
                        <td>{{ $states->created_by }}</td>
                        <td>{{ $states->modified_by }}</td>
                        <td class="text-center">
                          <div class="d-flex justify-content-center align-items-center gap-2">
                            <a href="{{ route('admin.state.edit', ['uuid' => $states->uuid]) }}"
                              class="btn btn-sm-custom btn-outline-dark" data-bs-toggle="tooltip" title="Edit">
                              <i class="icon-pencil-alt"></i>
                            </a>
                            <a href="{{ route('admin.state.delete', ['uuid' => $states->uuid]) }}"
                              class="btn btn-sm-custom btn-outline-dark" data-bs-toggle="tooltip" title="Delete">
                              <i class="icon-trash"></i></a>
                          </div>
                        </td>
                      </tr>
                    @endforeach

                  </tbody>
                </table>


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