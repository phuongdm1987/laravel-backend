<aside class="menu">
    <ul class="list-group">
        {!! generateCategoriesMultiLevel($categories) !!}
    </ul>

        @if(isset($category))
            @include('commons.attributes')
        @endif
</aside>
