@extends('backend.common.master')
@section('main-section')
<div class="container-fluid">
  <div class="page-title">
    <div class="row">
      <div class="col-6">
        <h4>Engineers List</h4>
      </div>
      <div class="col-6">
        <ol class="breadcrumb">
          <a href="{{ route('admin.engineer.create') }}">
            <button type="button" class="btn btn-lg" data-bs-toggle="tooltip" title="Add User" style="background:#bf0103;color:white;">Add Engineer</button>
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
                  <th>Name</th>
                  <th>Email</th>
                  <th>Phone</th>
                  <th>Password</th>
                  <th>Designation</th>
                  <th width="120" class="text-center">Action</th>
                </tr>
              </thead>
              <tbody>

                @php $i=0; @endphp
                  @foreach($engineerList as $engineers)
                @php $i++; @endphp

                <tr>
                  <td> {{ $i }}</td>
                  <td>{{ $engineers->name }}</td>
                  <td>
                    {{ $engineers->email1 }} <br>
                    {{ $engineers->email2 }}
                  </td>
                  <td>{{ $engineers->phone1 }} <br>
                    {{ $engineers->phone2 }}</td>
                  <td>{{ $engineers->password }}</td>
                  <td>{{ $engineers->designation }}</td>
                  <td class="text-center">
                    <ul class="action">
                      <li class="edit">
                        <a href="{{ route('admin.engineer.edit',['uuid' => $engineers->uuid]) }}">
                          <i class="icon-pencil-alt"></i>
                        </a>
                      </li>
                      <li class="delete">
                        <a href="{{ route('admin.engineer.delete',['uuid' => $engineers->uuid]) }}">
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