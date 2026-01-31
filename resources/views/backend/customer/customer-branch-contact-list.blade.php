@extends('backend.common.master')
@section('main-section')
  <div class="container-fluid">
    <div class="page-title">
      <div class="row">
        <div class="col-6">
          <h4>{{ $customer->company_name}} ({{ $customerBranch->branch_name }}) List</h4>

        </div>


        <div class="col-6">
          <ol class="breadcrumb">

            <a href="{{ route('admin.customer.index') }}">
              <button type="button" class="btn btn-lg" data-bs-toggle="tooltip" title="Add User"
                style="background:#bf0103;color:white;">Back</button>
            </a>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

            <button type="button" class="btn btn-lg addContactBtn" style="background:#bf0103;color:white;"
              data-bs-toggle="modal" data-bs-target="#addContactModal" data-customer_id="{{ $customer->id }}"
              data-branch_id="{{ $customerBranch->id }}" data-uuid="{{ $customerBranch->uuid }}">
              Add Contact
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
        <div class="card">

          <div class="card-body">
            <div class="table-responsive custom-scrollbar">
              <table class="display" id="basic-1">
                <thead>
                  <tr>
                    <th>Sr.no</th>
                    <th>Name</th>
                    <th>Mobile no</th>
                    <th>Email id</th>
                    <th>Designation</th>
                    <th>Created By</th>
                    <th>Modified By</th>
                    <th width="120" class="text-center">Action</th>
                  </tr>
                </thead>
                <tbody>

                  @php $i = 0; @endphp
                  @foreach($customerBranchContact as $branchContact)
                    @php $i++; @endphp

                    <tr>
                      <td>{{ $i }}</td>
                      <td>{{ $branchContact->contact_name }}</td>
                      <td>{{ $branchContact->mobile_no }}</td>
                      <td>{{ $branchContact->email_id }}</td>
                      <td>{{ $branchContact->designation }}</td>

                      <td>{{ $branchContact->created_by }}</td>
                      <td>{{ $branchContact->modified_by }}</td>
                      <td class="text-center">
                        <ul class="action">
                          <li class="edit">
                            <a href="#">
                              <i class="icon-pencil-alt"></i>
                            </a>
                          </li>
                          <li class="delete">
                            <a href="#">
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

    </div>
  </div>

  <div class="modal fade" id="addContactModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header text-white" style="background:#bf0103;color:white;">
          <h5 class="modal-title" style="color:white;">Add Contact</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <form method="POST" action="{{ route('admin.customer.add.branch.contact') }}">
            @csrf
            <!-- Hidden Fields -->
            <input type="hidden" name="customer_id" id="customer_id" value="{{ $customer->id }}">
            <input type="hidden" name="branch_id" id="branch_id" value="{{ $customerBranch->id }}">
            <input type="hidden" name="uuid" id="uuid" value="{{ $customerBranch->uuid }}">

            <div class="row g-3">

              <div class="col-md-6">
                <label class="fw-bold"> Name</label>
                <input type="text" name="contact_name" id="contact_name" class="form-control">
              </div>

              <div class="col-md-6">
                <label class="fw-bold">Mobile no</label>
                <input type="text" name="mobile_no" id="mobile_no" class="form-control">
              </div>

              <div class="col-md-6">
                <label class="fw-bold">Email id</label>
                <input type="email" name="email_id" id="email_id" class="form-control">
              </div>

              <div class="col-md-6">
                <label class="fw-bold">Designation</label>
                <input type="text" name="designation" id="designation" class="form-control">
              </div>


            </div>

            <div class="mt-4 text-end">
              <button type="submit" class="btn" style="background:#bf0103;color:white;">Save Contact</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

@endsection

@push('script')

  <script>
    $(document).on('click', '.addContactBtn', function () {
      alert($(this).data('uuid'));
      $('#uuid').val($(this).data('uuid'));
      $('#customer_id').val($(this).data('customer_id'));
      $('#branch_id').val($(this).data('branch_id'));
    });
  </script>

@endpush