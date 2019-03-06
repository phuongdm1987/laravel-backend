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
                    <h1 class="is-size-4">{{$product->getName()}}</h1>
                    <p>{{$product->getAmount()->format()}}</p>
                </div>
            </div>
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
    </section>
@endsection
