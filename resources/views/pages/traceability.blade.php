@extends('layouts.app')
@section('title','Traceability Program')
@section('content')

    <div class="traceability-programs">
        <div class="banner-section">
            <figure>
                <img src="images/traceability-programs-banner.png" alt="Banner" title="Banner">
            </figure>
            <div class="banner-content text-sm-center">
                <h1>Traceability Programs</h1>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
            </div>
        </div>

        <section id="traceability-programs">
        <?php echo isset($content) ? htmlspecialchars_decode($content[0]->block_content):''; ?>
            <!-- <div class="container">
                <section>
                    <div class="row">

                        <div class="col-lg-6 col-md-6 col-xs-12">
                            <div class="content-text">
                                <h2 class="title text-sm-left text-capitalize">Lorem ipsum</h2>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec pellentesque massa vitae
                                    semper facilisis. Class aptent taciti sociosqu ad litora torquent per conubia nostra,
                                    per inceptos himenaeos. Fusce venenatis porta sagittis, quisque nec rhoncus enim,</p>
                                <ul>
                                    <li>Lorem ipsum dolor sit amet</li>
                                    <li>Consectetur adipiscing elit</li>
                                    <li>Pellentesque vel elementum enim</li>
                                    <li>Nam et est condimentum sollicitudin</li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-xs-12 text-sm-center">
                            <div class="content-img">
                                <figure>
                                    <img src="{{asset('images/img-traceability-1.png')}}" alt="Traceability Programs" title="Traceability Programs">
                                </figure>
                            </div>
                        </div>
                    </div>
                </section>

                <section>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-xs-12 text-sm-center">
                            <div class="content-img">
                                <figure>
                                    <img src="{{asset('images/img-traceability-2.png')}}" alt="Traceability Programs" title="Traceability Programs">
                                </figure>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-xs-12">
                            <div class="content-text">
                                <h2 class="title text-sm-left text-capitalize">Lorem ipsum</h2>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec pellentesque massa vitae
                                    semper facilisis. Class aptent taciti sociosqu ad litora torquent per conubia nostra,
                                    per inceptos himenaeos. Fusce venenatis porta sagittis, quisque nec rhoncus enim,</p>
                                <ul>
                                    <li>Lorem ipsum dolor sit amet</li>
                                    <li>Consectetur adipiscing elit</li>
                                    <li>Pellentesque vel elementum enim</li>
                                    <li>Nam et est condimentum sollicitudin</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </section>

                <section>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-xs-12">
                            <div class="content-text">
                                <h2 class="title text-sm-left text-capitalize">Lorem ipsum</h2>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec pellentesque massa vitae
                                    semper facilisis. Class aptent taciti sociosqu ad litora torquent per conubia nostra,
                                    per inceptos himenaeos. Fusce venenatis porta sagittis, quisque nec rhoncus enim,</p>
                                <ul>
                                    <li>Lorem ipsum dolor sit amet</li>
                                    <li>Consectetur adipiscing elit</li>
                                    <li>Pellentesque vel elementum enim</li>
                                    <li>Nam et est condimentum sollicitudin</li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-xs-12 text-sm-center">
                            <div class="content-img">
                                <figure>
                                    <img src="{{asset('images/img-traceability-3.png')}}" alt="Traceability Programs" title="Traceability Programs">
                                </figure>
                            </div>
                        </div>
                    </div>
                </section>
            </div> -->
        </section>

        <section id="traceability_program" class="image-overlay-box">
            <div class="image-overlay">
                <figure>
                    <img src="images/about_us_bg.jpg" alt="Traceability Programs" title="Traceability Programs">
                </figure>
            </div>
            <div class="animated-circle-block">
                <div class="rotating-circle_container">
                    <svg width="278px" height="69px" viewBox="0 0 427.03 425" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="rotating-circle_border"><path d="M7.77,155.51a212.12,212.12,0,0,0,69,220.2,1.41,1.41,0,0,0,2-.18,1.36,1.36,0,0,0-.18-1.93A209.4,209.4,0,0,1,10.45,156.24a1.35,1.35,0,0,0-.13-1,1.38,1.38,0,0,0-.84-.65,1.4,1.4,0,0,0-1.72,1Z" class="rotating-circle_path rotating-circle_path--1"></path> <path d="M213.51,425C331.25,425,427,329.67,427,212.5a210.62,210.62,0,0,0-37.28-120,1.4,1.4,0,0,0-1.95-.36,1.37,1.37,0,0,0-.58.88,1.35,1.35,0,0,0,.22,1,207.92,207.92,0,0,1,36.8,118.46c0,115.66-94.53,209.75-210.73,209.75A210.35,210.35,0,0,1,95.7,386.43a1.41,1.41,0,0,0-1.94.37,1.35,1.35,0,0,0-.21,1,1.37,1.37,0,0,0,.58.88A213.16,213.16,0,0,0,213.51,425Z" class="rotating-circle_path rotating-circle_path--2"></path> <path d="M93.1,40.34A211.49,211.49,0,0,1,372.75,75.11a1.41,1.41,0,0,0,2,.14,1.36,1.36,0,0,0,.14-1.93A213.92,213.92,0,0,0,14.35,135.75a1.35,1.35,0,0,0,0,1,1.37,1.37,0,0,0,.77.73,1.43,1.43,0,0,0,1.81-.79A209.63,209.63,0,0,1,93.1,40.34Z" class="rotating-circle_path rotating-circle_path--3"></path></svg>
                </div>
                <div class="animated-circle text-sm-center">
                    <h2 class="title text-capitalize text-sm-center">For More Information,
                        Please Contact Us</h2>
                    <br>
                    <a href="{{URL::to('contact-us')}}" class="btn btn-primary">Contact Us</a>

                </div>
            </div>
        </section>

    </div>

@endsection
