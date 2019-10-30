@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="container is-fluid">
            {{ Breadcrumbs::render('product', $product) }}
            <div class="columns">
                <div class="column is-half">
                    <div class="card card-equal-height">
                        <div class="card-image">
                            <figure class="image is-4by3">
                                <img src="https://maychuhanoi.vn/uploads/2018/11/29/270x230_maychuhanoi-image-1543461000.jpg" alt="Placeholder image">
                            </figure>
                        </div>
                    </div>
                </div>
                <div class="column">
                    <modal>
                        <template slot="title">Sale product: {{$product->getName()}}</template>
                        <form action="{{route('product-users.store')}}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{$product->getId()}}">
                            @foreach($product->category->attributes as $attribute)
                                <div class="field is-horizontal">
                                    <div class="field-label">
                                        <label class="label">{{$attribute->getName()}}</label>
                                    </div>
                                    <div class="field-body">
                                        <div class="field">
                                            <div class="control">
                                                <div class="select is-fullwidth">
                                                    <select name="attribute_value_id[]">
                                                        @foreach($attribute->attributeValues as $attributeValue)
                                                            <option value="{{$attributeValue->getId()}}" {{in_array($attributeValue->getId(), old('attribute_value_id', [])) ? 'selected' : ''}}>{{$attributeValue->getValue()}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <div class="field is-horizontal">
                                <div class="field-label">
                                    <label class="label">Amount</label>
                                </div>
                                <div class="field-body">
                                    <div class="field">
                                        <div class="control has-icons-right">
                                            <input
                                                    class="input{{ $errors->has('amount') ? ' is-danger' : '' }}"
                                                    value="{{ old('amount') }}"
                                                    id="amount" name="amount" type="text" required>
                                            <span class="icon is-small is-right">
                                              vnd
                                            </span>
                                        </div>
                                        @if ($errors->has('amount'))
                                            <p class="help is-danger">{{ $errors->first('amount') }}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <button class="button is-block is-info is-fullwidth"
                                    type="submit">Sale</button>
                        </form>
                        <template slot="footer">&nbsp</template>
                    </modal>
                    @foreach($product->category->attributes as $attribute)
                        <div class="field is-horizontal">
                            <div class="field-label">
                                <label class="label">{{$attribute->getName()}}</label>
                            </div>
                            <div class="field-body">
                                <div class="field">
                                    <div class="control">
                                        {{implode(', ', $product->attributeValues
                                        ->where('attribute_id', $attribute->getId())
                                        ->pluck('value')->toArray())}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection
