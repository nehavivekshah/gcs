@extends('backend.common.master')
@section('main-section')

<div class="container-fluid">
  <div class="page-title">
    <div class="row">
      <div class="col-6">
        <h4>Edit Product</h4>
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
          <form class="row g-3 needs-validation custom-input" novalidate="" method="post" action="{{ route('admin.product.update', ['uuid' => $products->uuid]) }}">
            @csrf
            @method('PATCH')

            <div class="col-4">
              <label class="form-label" for="manufacture">Manufacture</label>
              <select class="form-control" id="manufacture" name="manufacture">
                <option value=""> Select </option>
                @foreach($manufactureList as $manufactures)
                <option value="{{ $manufactures->id }}"  @selected($manufactures->id == $products->manufacture)> 
                  {{ $manufactures->manufacture}} 
                </option>
                @endforeach
              </select>
              <div class="invalid-feedback">
                @error('manufacture')
                {{ $message }}
                @enderror
              </div>

            </div>

            <div class="col-4">
              <label class="form-label" for="product_type">Product Type</label>
              <select class="form-control" id="product_type" name="product_type">
                <option value=""> Select </option>
                @foreach($productTypeList as $productType)
                <option value="{{ $productType->id }}" @selected($productType->id == $products->product_type)>
                   {{ $productType->product_type}}
                   </option>
                @endforeach
              </select>
              <div class="invalid-feedback">
                @error('product_type')
                {{ $message }}
                @enderror
              </div>

            </div>

            <div class="col-4">
              <label class="form-label" for="sub_product_type">Sub Product Type</label>
              <div class="d-flex">
                <select class="form-control me-2" id="sub_product_type" name="sub_product_type">
                  <option value=""> Select </option>                  
                  <option value="{{ $subProductTypeList[0]->id}}" selected> {{ $subProductTypeList[0]->sub_product_type}} </option>                  
                </select>                
              </div>
            </div>

            <div class="col-4">
              <label class="form-label" for="comp_amc_rate">Specification</label>
              <input type="text" class="form-control" id="specification" name="specification" value="{{ $products->specification }}">
              <div class="invalid-feedback">
                @error('outlook_email')
                {{ $message }}
                @enderror
              </div>

            </div>

            <div class="col-4">
              <label class="form-label" for="comp_amc_rate">Rate</label>
              <input type="text" class="form-control" id="rate" name="rate" value="{{ $products->rate }}">
              <div class="invalid-feedback">
                @error('outlook_email')
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
