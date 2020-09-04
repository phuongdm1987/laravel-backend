@extends('layouts.app')

@section('hero-content')
    <section class="hero is-primary is-large">
        <div class="hero-body">
            <div class="container is-fluid">
                <div class="columns">
                    <div class="column is-three-fifths is-offset-one-fifth">
                        <form>
                            <div class="field">
                                <product-suggestion></product-suggestion>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('content')
    <section class="section">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-3">
                    @include('commons.side-bar')
                </div>
                <div class="col-sm-9">
                    <div class="row row-cols-3">
                        @foreach($products as $product)
                            <div class="col mb-4">
                                <div class="card-desk h-100">
                                    <div class="card-header">
                                        <h5><a href="{{route('products.show', $product->getSlug())}}">{{$product->getName()}}</a></h5>
                                    </div>
                                    <img class="card-img-top" src="https://maychuhanoi.vn/uploads/2018/11/29/270x230_maychuhanoi-image-1543461000.jpg" alt="Placeholder image">
                                    <div class="card-body">
                                        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                                    </div>
                                    <div class="card-footer clearfix">
                                        <span class="card-link float-left">{{$product->getAmount()->format()}}</span>
                                        <a href="{{route('products.show', $product->getSlug())}}" class="card-link float-right">Detail</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    {{$products->appends(request()->all())->links()}}
                </div>
            </div>
        </div>
    </section>
@endsection
