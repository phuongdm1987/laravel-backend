<ul class="list-group">
    <li class="list-group-item">
        <form action="" method="get">
            @foreach($category->attributes as $attribute)
                @if($attribute->attributeValues->count())
                    <div class="form-group">
                        <label class="font-weight-bold">{{$attribute->getName()}}</label>
                        @foreach($attribute->attributeValues as $attributeValue)
                            <div class="form-check">
                                <input class="form-check-input" name="attribute_value_id[]" type="checkbox" value="" id="attribute_value_{{$attributeValue->getId()}}" value="{{$attributeValue->getId()}}" {{ in_array($attributeValue->getId(), request('attribute_value_id', [])) ? 'checked' : '' }}>
                                <label class="form-check-label" for="attribute_value_{{$attributeValue->getId()}}">
                                    {{$attributeValue->getValue()}}
                                </label>
                            </div>
                        @endforeach
                        <button class="btn btn-primary btn-sm" type="submit">
                            apply filters
                        </button>
                    </div>
                @endif
            @endforeach
        </form>
    </li>
</ul>
