<aside class="menu">
    @if(isset($category))
        @include('commons.attributes')
    @else
        <div class="list-group">
            {!! generateCategoriesMultiLevel($categories) !!}
        </div>
    @endif
</aside>
