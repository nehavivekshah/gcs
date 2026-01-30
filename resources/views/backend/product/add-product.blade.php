@extends('backend.common.master')
@section('main-section')

<div class="container-fluid">
  <div class="page-title">
    <div class="row">
      <div class="col-6">
        <h4>Add Product</h4>
      </div>
      <div class="col-6">

      </div>
    </div>
  </div>
</div>
<!-- Container-fluid starts-->
<div class="container-fluid">
  <div class="row">

    <div class="col-xl-12">
      <div class="card height-equal">

        <div class="card-body">
          <form class="row g-3 needs-validation custom-input" novalidate="" method="post" action="{{ route('admin.product.store') }}">
            @csrf
            <div class="col-4">
              <label class="form-label" for="manufacture">Manufacture</label>
              <div class="d-flex">
                <select class="form-control me-2" id="manufacture" name="manufacture">
                  <option value=""> Select </option>
                  @foreach($manufactureList as $manufactures)
                  <option value="{{ $manufactures->id }}"> {{ $manufactures->manufacture }} </option>
                  @endforeach
                </select>
                <button type="button" class="btn btn-sm" data-bs-toggle="modal" data-bs-target="#addManufactureModal" style="background:#bf0103;color:white;">
                  Add
                </button>
              </div>
            </div>

            <div class="col-4">
              <label class="form-label" for="product_type">Product Type</label>
              <div class="d-flex">
                <select class="form-control me-2" id="product_type" name="product_type">
                  <option value=""> Select </option>
                  @foreach($productTypeList as $productType)
                  <option value="{{ $productType->id }}"> {{ $productType->product_type }} </option>
                  @endforeach
                </select>
                <button type="button" class="btn btn-sm" data-bs-toggle="modal" data-bs-target="#addProductTypeModal" style="background:#bf0103;color:white;">
                  Add
                </button>
              </div>
            </div>

            <div class="col-4">
              <label class="form-label" for="sub_product_type">Sub Product Type</label>
              <div class="d-flex">
                <select class="form-control me-2" id="sub_product_type" name="sub_product_type">
                  <option value=""> Select </option>                  
                </select>                
              </div>
            </div>


            <div class="col-4">
              <label class="form-label" for="specification">Specification</label>
              <input type="text" class="form-control" id="specification" name="specification" value="{{ old('specification') }}">
              <div class="invalid-feedback">
                @error('specification')
                {{ $message }}
                @enderror
              </div>

            </div>

            <div class="col-4">
              <label class="form-label" for="rate">Rate</label>
              <input type="text" class="form-control" id="rate" name="rate" value="{{ old('rate') }}">
              <div class="invalid-feedback">
                @error('rate')
                {{ $message }}
                @enderror
              </div>

            </div>


            <div class="col-12">
              <div class="d-flex justify-content-end">
                <button class="btn btn-lg" type="submit" style="background:#bf0103;color:white;">
                  Submit
                </button>
              </div>

            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="addManufactureModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header " style="background-color:#bf0103;">
        <h5 class="modal-title text-white">Add Manufacture</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form id="manufactureForm" method="post" action="{{ route('admin.product.add.manufacture') }}">
          @csrf
          <div class="mb-3">
            <label for="manufacture" class="form-label">Manufacture</label>
            <input type="text" class="form-control" id="manufacture" name="manufacture">
          </div>
          <button type="submit" class="btn" style="background:#bf0103;color:white;">Save</button>
        </form>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="addProductTypeModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header" style="background-color:#bf0103;">
        <h5 class="modal-title text-white">Add Product Type</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form id="productTypeForm" method="post" action="{{ route('admin.product.add.product.type') }}">
          @csrf
          <div class="mb-3">
            <label for="product_type" class="form-label">Product Type</label>
            <input type="text" class="form-control" id="product_type" name="product_type">
          </div>

          <div class="mb-3">
            <label for="sub_product_type" class="form-label">Sub Product Type</label>
            <input type="text" class="form-control" id="sub_product_type" name="sub_product_type">
          </div>

          <button type="submit" class="btn" style="background:#bf0103;color:white;">Save</button>
        </form>
      </div>
    </div>
  </div>
</div>


@endsection

@push('scripts')

<script>

  $(document).ready(function(){
    
      $('#product_type').on('change', function () {
        var productTypeID = $(this).val();

        if (productTypeID) {
            $.ajax({
                url: "{{ route('admin.product.type.subproduct') }}",
                type: "POST",
                data: {
                    productTypeID: productTypeID,
                    _token: "{{ csrf_token() }}"
                },
                dataType: "json",
                success: function (res) {
                    $('#sub_product_type').empty()
                                  .append('<option value="">Select Sub Product</option>');

                    $.each(res, function (key, value) {
                        $('#sub_product_type').append(
                            '<option value="' + value.id + '" selected>' + value.sub_product_type + '</option>'
                        );
                    });

                    // Refresh select2 after ajax
                    $('#sub_product_type').trigger('change');
                },
                error: function () {
                    alert('Unable to fetch subproduct');
                }
            });
        } else {
            $('#sub_product_type').empty()
                          .append('<option value="">Select Sub product</option>');
        }
    });

  })


</script>

@endpush