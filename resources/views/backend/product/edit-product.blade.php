@extends('backend.common.master')
@section('main-section')

  <div class="container-fluid">
    <div class="page-title">
      <div class="row">
        <div class="col-6">
          <h4>Edit Product</h4>
        </div>
        <div class="col-6">
          <ol class="breadcrumb justify-content-end">
            <li class="breadcrumb-item"><a href="{{ route('admin.product.index') }}">Product List</a></li>
            <li class="breadcrumb-item active">Edit Product</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  <!-- Container-fluid starts-->
  <div class="container-fluid">
    <div class="row">

      <div class="col-xl-12">
        <div class="card card-premium">

          <div class="card-body">
            <form class="row g-3 needs-validation custom-input" novalidate="" method="post"
              action="{{ route('admin.product.update', ['uuid' => $products->uuid]) }}">
              @csrf
              @method('PATCH')

              <div class="col-md-4">
                <label class="form-label-premium" for="manufacture">Manufacture <span class="text-danger">*</span></label>
                <select class="form-control form-control-premium select2" id="manufacture" name="manufacture" required>
                  <option value=""> Select </option>
                  @foreach($manufactureList as $manufactures)
                    <option value="{{ $manufactures->id }}" @selected($manufactures->id == $products->manufacture)>
                      {{ $manufactures->manufacture }}
                    </option>
                  @endforeach
                </select>
                <div class="invalid-feedback">
                  @error('manufacture')
                    {{ $message }}
                  @enderror
                </div>

              </div>

              <div class="col-md-4">
                <label class="form-label-premium" for="product_type">Product Type <span
                    class="text-danger">*</span></label>
                <select class="form-control form-control-premium select2" id="product_type" name="product_type" required>
                  <option value=""> Select </option>
                  @foreach($productTypeList as $productType)
                    <option value="{{ $productType->id }}" @selected($productType->id == $products->product_type)>
                      {{ $productType->product_type }}
                    </option>
                  @endforeach
                </select>
                <div class="invalid-feedback">
                  @error('product_type')
                    {{ $message }}
                  @enderror
                </div>

              </div>

              <div class="col-md-4">
                <label class="form-label-premium" for="sub_product_type">Sub Product Type <span
                    class="text-danger">*</span></label>
                <div class="d-flex">
                  <select class="form-control form-control-premium me-2 select2" id="sub_product_type"
                    name="sub_product_type" required>
                    <option value=""> Select </option>
                    @if(isset($subProductTypeList[0]))
                      <option value="{{ $subProductTypeList[0]->id }}" selected>
                        {{ $subProductTypeList[0]->sub_product_type }}
                      </option>
                    @endif
                  </select>
                </div>
              </div>

              <div class="col-md-4">
                <label class="form-label-premium" for="specification">Specification <span
                    class="text-danger">*</span></label>
                <input type="text" class="form-control form-control-premium" id="specification" name="specification"
                  value="{{ $products->specification }}" required>
                <div class="invalid-feedback">
                  @error('specification')
                    {{ $message }}
                  @enderror
                </div>

              </div>

              <div class="col-md-4">
                <label class="form-label-premium" for="rate">Rate <span class="text-danger">*</span></label>
                <input type="text" class="form-control form-control-premium" id="rate" name="rate"
                  value="{{ $products->rate }}" required>
                <div class="invalid-feedback">
                  @error('rate')
                    {{ $message }}
                  @enderror
                </div>

              </div>


              <div class="col-12">
                <div class="d-flex justify-content-end">
                  <button class="btn btn-primary-custom" type="submit">
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

  <!-- Select2 CSS -->
  <link rel="stylesheet" href="{{ asset('public/assets/css/vendors/select2.css') }}">

  <!-- Select2 JS -->
  <script src="{{ asset('public/assets/js/select2/select2.full.min.js') }}"></script>

  <script>

    $(document).ready(function () {
      /* Initialize searchable dropdown */
      $('.select2').select2({
        placeholder: 'Select an option',
        allowClear: true,
        width: '100%'
      });

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