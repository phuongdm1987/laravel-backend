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
                    <form action="" method="post">
                        <div class="field is-horizontal">
                            <div class="field-label is-normal has-text-left">
                                <label class="label">@lang('form.quantity')</label>
                            </div>
                            <div class="field-body">
                                <div class="columns">
                                    <div class="column is-one-third">
                                        <div class="field">
                                            <div class="control">
                                                <input class="input" type="number" value="0" placeholder="@lang('form.quantity')">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="column">
                                        <div class="field">
                                            <div class="field-label is-normal has-text-left">
                                                <label>
                                                    I agree to the <a href="#">terms and conditions</a>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="field">
                            <div class="control">
                                <button class="button is-link">@lang('form.add_to_Cart')</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
