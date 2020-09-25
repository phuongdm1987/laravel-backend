    <fieldset class="col-md-12">
    <legend>Attributes</legend>
    @foreach($attributes as $attribute)
        <div class="form-group col-md-12">
            <label class="control-label" for="attribute_value">{{ $attribute->getName() }} {{ $attribute->getSuffix() ? '(' . $attribute->getSuffix() . ')' : '' }}</label>
            <select class="form-control select2" name="attribute_value[]" multiple>
                @foreach($attribute->attributeValues as $attributeValue)
                    <option value="{{ $attributeValue->getId() }}" {!! in_array($attributeValue->getId(), old('attribute_value', $attributeValues)) ? 'selected' : '' !!}>
                        {{ $attributeValue->getValue() }}
                    </option>
                @endforeach
            </select>
        </div>
    @endforeach
</fieldset>
