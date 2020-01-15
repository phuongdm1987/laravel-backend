

<form action="" method="get">
    @foreach($category->attributes as $attribute)
        @if($attribute->isFilter() && $attribute->attributeValues->count())
            <nav class="panel">
                <p class="panel-heading">{{$attribute->getName()}}</p>
                @foreach($attribute->attributeValues as $attributeValue)
                    <label class="panel-block">
                        <input type="checkbox"
                               {{ in_array($attributeValue->getId(), request('attribute_value_id', [])) ? 'checked' : '' }}
                               name="attribute_value_id[]"
                               value="{{$attributeValue->getId()}}">
                        {{$attributeValue->getValue()}}
                    </label>
                @endforeach
                <div class="panel-block">
                    <button class="button is-link is-outlined is-fullwidth" type="submit">
                        apply filters
                    </button>
                </div>
            </nav>
        @endif
    @endforeach
</form>

