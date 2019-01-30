<aside class="menu">
    <ul class="menu-list">
        {!! generateCategoriesMultiLevel($categories) !!}
    </ul>

        @if($category)
            @include('commons.attributes')
        @endif
</aside>
