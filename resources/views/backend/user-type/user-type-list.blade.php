@extends('backend.common.master')
@section('main-section')
<div class="container-fluid">
  <div class="page-title">
    <div class="row">
      <div class="col-6">
        <h4>User Type</h4>
      </div>
      <div class="col-6">
        <ol class="breadcrumb">
          <a href="{{ route('admin.user-type.create') }}">
            <button type="button" class="btn btn-lg" data-bs-toggle="tooltip" title="Add User" style="background:#bf0103;color:white;">Add User Type</button>
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
            <table class="display" id="basic-1">
              <thead>
                <tr>
                  <th>Sr.no</th>
                  <th>User Type</th>
                  <th>Created By</th>
                  <th>Modified By</th>
                  <th width="120" class="text-center">Action</th>
                </tr>
              </thead>
              <tbody>

                @php $i=0; @endphp
                @foreach($userTypeList as $userType)
                  @php $i++; @endphp

                <tr>
                  <td>{{ $i }}</td>
                  <td>{{ $userType->user_type }}</td>
                  <td>{{ $userType->created_by }}</td>
                  <td>{{ $userType->modified_by }}</td>
                  <td class="text-center">
                    <ul class="action">
                      <li class="edit">
                        <a href="{{ route('admin.user-type.edit',['uuid' => $userType->uuid]) }}">
                          <i class="icon-pencil-alt"></i>
                        </a>
                      </li>
                      <li class="delete">
                        <a href="{{ route('admin.user-type.delete',['uuid' => $userType->uuid]) }}">
                          <i class="icon-trash"></i>
                        </a>
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