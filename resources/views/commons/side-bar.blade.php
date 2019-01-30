<aside class="menu">
    <ul class="menu-list">
        {!! generateCategoriesMultiLevel($categories) !!}
    </ul>

        @if(isset($category))
            @include('commons.attributes')
        @endif
</aside>
