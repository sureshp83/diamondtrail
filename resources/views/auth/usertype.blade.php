@extends('layouts.app')
@section('title','Register')
@section('content')
    <div class="page-content">
    <div class="register-as-block" >
        <h1 class="main-title">register</h1>
        <div class="container">
            <div class="register-as-block">
                <h2 class="text-sm-center">I would like to register as a...</h2>
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-xs-12">
                        <div class="register-box text-sm-center">
                            <figure>
                                <img src="images/buyer.png" alt="Buyer" title="Buyer">
                            </figure>
                            <h3>Buyer</h3>
                            <p>Description lorem ipsum dolor sit
                                amet, consectetur adipiscing elit.</p>
                            <a href="register/buyer" class="btn btn-primary">start</a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-xs-12">
                        <div class="register-box text-sm-center">
                            <figure>
                                <img src="images/seller.png" alt="Seller" title="Seller">
                            </figure>
                            <h3>Seller</h3>
                            <p>Description lorem ipsum dolor sit
                                amet, consectetur adipiscing elit.</p>
                            <a href="register/seller" class="btn btn-primary">start</a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-8 col-xs-12">
                        <div class="register-box text-sm-center">
                            <figure>
                                <img src="images/buyer-seller.png" alt="Buyer-Seller" title="Buyer-Seller">
                            </figure>
                            <h3>Buyer and Seller</h3>
                            <p>Description lorem ipsum dolor sit
                                amet, consectetur adipiscing elit.</p>
                            <a href="register/buyer-seller" class="btn btn-primary">start</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection