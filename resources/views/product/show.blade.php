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
                    @foreach($product->getEntityAttributes() as $attribute)
                        <div class="field is-horizontal">
                            <div class="field-label">
                                <label class="label">{{$attribute->getName()}}</label>
                            </div>
                            <div class="field-body">
                                <div class="field">
                                    <div class="control">{{$product->getEntityAttribute($attribute->slug)}}</div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            {{-- List User Product --}}
            @if($product->users->count() > 0)
                <div class="table-container">
                    <table class="table is-hoverable is-striped is-fullwidth">
                        <thead>
                            <tr>
                                <th>STT</th>
                                @foreach($product->category->attributes as $attribute)
                                    @if($attribute->isCanChange())
                                        <th>{{$attribute->name}}</th>
                                    @endif
                                @endforeach
                                <th>Provider</th>
                                <th>Updated At</th>
                                <th>Amount</th>
                                <th>Detail</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>STT</th>
                                @foreach($product->category->attributes as $attribute)
                                    @if($attribute->isCanChange())
                                        <th>{{$attribute->name}}</th>
                                    @endif
                                @endforeach
                                <th>Provider</th>
                                <th>Updated At</th>
                                <th>Amount</th>
                                <th>Detail</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach($productUsers as $user)
                            <tr>
                                <th>{{$loop->iteration}}</th>
                                @foreach($product->category->attributes as $attribute)
                                    @if($attribute->isCanChange())
                                    <td>
                                        {{$product->attributeValues
                                            ->firstWhere('attribute_id', $attribute->getId())->value}}
                                    </td>
                                    @endif
                                @endforeach
                                <td>{{$user->pivot->updated_at->format('d-m-Y')}}</td>
                                <th>{{$user->name}}</th>
                                <td class="has-text-right">@money($user->pivot->amount)</td>
                                <td><button class="button is-info is-outlined is-fullwidth">Detail</button></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </section>
@endsection
