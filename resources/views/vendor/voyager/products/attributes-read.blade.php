<hr style="margin:0;">

@foreach($attributes as $attribute)
    <div class="panel-heading" style="border-bottom:0;">
        <h3 class="panel-title">{{ $attribute->getName() }} {{ $attribute->getSuffix() ? '(' . $attribute->getSuffix() . ')' : '' }}</h3>
    </div>
    <div class="panel-body" style="padding-top:0;">
        <ul>
            @foreach($attribute->attributeValues as $attributeValue)
                @if (in_array($attributeValue->getId(), $attributeValues, true))
                    <li>{{ $attributeValue->getValue() }}</li>
                @endif
            @endforeach
        </ul>
    </div><!-- panel-body -->
    @if(!$loop->last)
        <hr style="margin:0;">
    @endif
@endforeach
