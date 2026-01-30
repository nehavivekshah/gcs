@extends('backend.common.master')
@section('main-section')
<div class="container-fluid">
  <div class="page-title">
    <div class="row">
      <div class="col-6">
        <h4>State List</h4>
      </div>
      <div class="col-6">
        <ol class="breadcrumb">
          <a href="{{ route('admin.city.create') }}">
            <button type="button" class="btn btn-lg" data-bs-toggle="tooltip" title="Add City" style="background:#bf0103;color:white;">Add City</button>
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
                  <th>State</th>
                  <th>City</th>
                  <th>Created By</th>
                  <th>Modified By</th>
                  <th width="120" class="text-center">Action</th>
                </tr>
              </thead>
              <tbody>

               @php $i=0; @endphp
                    @foreach($cityList as $cities)
                  @php $i++; @endphp

                <tr>
                  <td>{{ $i }}</td>
                  <td>{{ $cities->state }}</td>
                  <td>{{ $cities->city }}</td>
                  <td>{{ $cities->created_by }}</td>
                  <td>{{ $cities->modified_by }}</td>
                  <td class="text-center">
                    <ul class="action">
                      <li class="edit">
                        <a href="{{ route('admin.city.edit',['uuid' => $cities->uuid]) }}">
                          <i class="icon-pencil-alt"></i>
                        </a>
                      </li>
                      <li class="delete">
                        <a href="{{ route('admin.city.delete',['uuid' => $cities->uuid]) }}">
                          <i class="icon-trash"></i></a>
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