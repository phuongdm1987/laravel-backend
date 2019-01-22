@extends('layouts.app')

@section('hero-content')
    <section class="hero is-primary is-large">
        <div class="hero-body">
            <div class="container is-fluid">
                <div class="columns">
                    <div class="column is-three-fifths is-offset-one-fifth">
                        <form action="">
                            <div class="field">
                                <p class="control has-icons-left">
                                    <input class="input is-large" type="text" placeholder="Search every thing">
                                    <span class="icon is-medium is-left">
                                <i class="fas fa-search"></i>
                            </span>
                                </p>
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
        <div class="container is-fluid">
            <div class="columns">
                <div class="column is-one-quarter is-hidden-touch">
                    @include('commons.side-bar')
                </div>
                <div class="column">
                    <div class="columns is-multiline">
                        @foreach($products as $product)
                            <div class="column is-one-third">
                                <div class="card card-equal-height">
                                    <div class="card-image">
                                        <figure class="image is-4by3">
                                            <img src="https://maychuhanoi.vn/uploads/2018/11/29/270x230_maychuhanoi-image-1543461000.jpg" alt="Placeholder image">
                                        </figure>
                                    </div>
                                    <div class="card-content">
                                        <div class="content">
                                            <p class="subtitle is-6">{{$product->getName()}}</p>
                                        </div>
                                    </div>
                                    <footer class="card-footer">
                                        <span class="card-footer-item has-text-info">{{$product->getAmount()}}vnd</span>
                                        <a href="{{route('products.show', $product->getSlug())}}" class="card-footer-item has-background-info has-text-white">Detail</a>
                                    </footer>
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
