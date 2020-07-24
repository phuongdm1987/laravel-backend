@extends('vendor.voyager.edit-add')

@section('external-data')
    <div id="attribute-wapper">
        @include('vendor.voyager.products.attributes-edit')
    </div>
@endsection

@section('javascript')
    @parent
    <script>
        $('document').ready(function () {
            $('select[name="category_id"]').change(function() {
                var categoryId = $(this).val() || 0;
                var params = {
                    categoryId: categoryId,
                    productId: {{ $product->getId() }},
                    _token: '{{ csrf_token() }}'
                };

                $.post('{{ route('products.attributes.categories') }}', params, function (response) {
                    $('#attribute-wapper').html(response);
                }).then(function(newResponse) {
                    $('.select2[name="attribute_value[]"]').select2();
                });
            })
        });
    </script>
@endsection
