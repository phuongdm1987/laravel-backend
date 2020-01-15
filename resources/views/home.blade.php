@extends('layouts.app')

@section('hero-content')
    <section class="hero is-link is-fullheight-with-navbar is-bold">
        <div class="hero-body">
            <div class="container is-fluid">
                <p class="title">
                    Fullheight hero with navbar
                </p>
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
                        @foreach([1,2,3,4,5,6,7] as $seed)
                            <div class="column is-one-third">
                                <div class="card card-equal-height">
                                    <div class="card-image">
                                        <figure class="image is-4by3">
                                            <img src="https://maychuhanoi.vn/uploads/2018/11/29/270x230_maychuhanoi-image-1543461000.jpg" alt="Placeholder image">
                                        </figure>
                                    </div>
                                    <div class="card-content">
                                        <div class="content">
                                            <h3 class="title is-5">HDD Intel</h3>
                                            <p class="subtitle is-6">Intel® SSD 545s Series (256GB, 2.5in SATA 6Gb/s, 3D2, TLC)</p>
                                        </div>
                                    </div>
                                    <footer class="card-footer">
                                        <span href="#" class="card-footer-item has-text-info">1,740,000vnd</span>
                                        <a href="#" class="card-footer-item has-background-info has-text-white">Detail</a>
                                    </footer>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
