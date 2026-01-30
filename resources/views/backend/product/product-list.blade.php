@extends('backend.common.master')
@section('main-section')
<div class="container-fluid">
  <div class="page-title">
    <div class="row">
      <div class="col-6">
        <h4> Product List</h4>
      </div>
      <div class="col-6">
        <ol class="breadcrumb">
          <a href="{{ route('admin.product.create') }}">
            <button type="button" class="btn btn-lg" data-bs-toggle="tooltip" title="Add User" style="background:#bf0103;color:white;">Add Product</button>
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
                  <th>Manufacture</th>
                  <th>Product </th>
                  <th>Sub Product </th>
                  <th>Specification</th>
                  <th>Rate</th>
                  <th>Product</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>

               @php $i=0; @endphp
                    @foreach($productList as $products)
                  @php $i++; @endphp

                <tr>
                  <td>{{ $i }}</td>
                  <td>{{ $products->manufacture_name}}</td>
                  <td>{{ $products->product_type_name}}</td>
                  <td>{{ $products->sub_product_type}}</td>
                  <td>{{ $products->specification}}</td>
                  <td>{{ $products->rate}}</td>
                  <td>{{ $products->manufacture_name}} - {{ $products->product_type_name}} - {{ $products->sub_product_type}} - {{ $products->specification}}</td>
                  <td class="text-center">
                    <ul class="action">
                      <li class="edit">
                        <a href="{{ route('admin.product.edit',['uuid' => $products->uuid]) }}">
                          <i class="icon-pencil-alt"></i>
                        </a>
                      </li>
                      <li class="delete">
                        <a href="{{ route('admin.product.delete',['uuid' => $products->uuid]) }}">
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