@extends('backend.common.master')
@section('main-section')
  <div class="container-fluid">
    <div class="page-title">
      <div class="row">
        <div class="col-6">
          <h4> Product List</h4>
        </div>
        <div class="col-6">
          <div class="col-6">
            <ol class="breadcrumb justify-content-end">
              <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
              <li class="breadcrumb-item active">Product List</li>
              <a href="{{ route('admin.product.create') }}" class="ms-3">
                <button type="button" class="btn btn-primary-custom" data-bs-toggle="tooltip" title="Add Product">
                  <i class="fa fa-plus me-1"></i> Add Product
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
                      <th>Manufacture</th>
                      <th>Product </th>
                      <th>Sub Product </th>
                      <th>Specification</th>
                      <th>Rate</th>
                      <th>Product</th>
                      <th width="120" class="text-center">Action</th>
                    </tr>
                  </thead>
                  <tbody>

                    @php $i = 0; @endphp
                    @foreach($productList as $products)
                      @php $i++; @endphp

                      <tr>
                        <td>{{ $i }}</td>
                        <td>{{ $products->manufacture_name }}</td>
                        <td>{{ $products->product_type_name }}</td>
                        <td>{{ $products->sub_product_type }}</td>
                        <td>{{ $products->specification }}</td>
                        <td>{{ $products->rate }}</td>
                        <td>{{ $products->manufacture_name }} - {{ $products->product_type_name }} -
                          {{ $products->sub_product_type }} - {{ $products->specification }}
                        </td>
                        <td class="text-center">
                          <div class="d-flex justify-content-center align-items-center gap-2">
                            <a href="{{ route('admin.product.edit', ['uuid' => $products->uuid]) }}"
                              class="btn btn-sm-custom btn-outline-dark" data-bs-toggle="tooltip" title="Edit">
                              <i class="icon-pencil-alt"></i>
                            </a>
                            <a href="{{ route('admin.product.delete', ['uuid' => $products->uuid]) }}"
                              class="btn btn-sm-custom btn-outline-dark" data-bs-toggle="tooltip" title="Delete">
                              <i class="icon-trash"></i>
                            </a>
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