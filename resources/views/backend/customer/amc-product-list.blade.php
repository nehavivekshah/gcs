@extends('backend.common.master')
@section('main-section')
<div class="container-fluid">
  <div class="page-title">
    <div class="row">
      <div class="col-6">
        <h4>{{ $customer->customer_name}} ({{ $customerBranch->branch_name }}) List</h4>
      </div>
      <div class="col-6">
        <ol class="breadcrumb">
          <a href="{{ route('admin.customer.index') }}">
            <button type="button" class="btn btn-lg" data-bs-toggle="tooltip" title="Add User" style="background:#bf0103;color:white;">Back</button>
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
                  <th>Product</th>
                  <!-- <th>Count</th> -->
                  <th width="120" class="text-center">Action</th>
                </tr>
              </thead>
              <tbody>

                @php $i=0; @endphp
                @foreach($amcProductList as $amcProduct)
                @php $i++; @endphp

                <tr>
                  <td>{{ $i }}</td>
                  <td>{{ $amcProduct->amc_product }}</td>
                  <!-- <td>1</td> -->
                  <td class="text-center">

                    <ul style="display:flex;align-items:center;gap:8px;padding:0;margin:0;list-style:none;justify-content:center;">
                      <a href="{{ route('admin.customer.amc.product.list',['customer_id' => $customer->id, 'branch_id' => $customerBranch->id, 'amc_product_id' => $amcProduct->id]) }}">
                        <button
                          type="button"
                          class="btn btn-sm"
                          style="background:#bf0103;color:#fff;border:none;">
                          View
                        </button>
                      </a>
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

@endsection
