@extends('layouts.app')
@section('title','Producers')
@section('content')
    <div class="producers">
        <div class="banner-section">
            <figure>
                <img src="{{asset('images/about-us-banner.png')}}" alt="Banner" title="Banner">
            </figure>
            <div class="banner-content text-sm-center">
                <h1>Producers</h1>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
            </div>
        </div>

        <section id="producers">
            <div class="container">
                <div class="row">
                @foreach($producers as $key=>$producer)
                <div class="col-lg-6 col-md-6 col-xs-12">
                        <div class="single-producer">
                            <div class="content-img">
                                <figure>
                                    <img src="{{asset('producer/pages_img')}}/{{$producer->image}}" alt="Producers" title="Producers">
                                </figure>
                            </div>
                            <div class="content-text">
                                <h2 class="title text-sm-left text-capitalize">{{$producer->producer_name}}</h2>
                                <?php echo htmlspecialchars_decode($producer->producer_content); ?>
                                <a href="{{URL::to('single-producer/')}}/{{$producer->id}}" class="btn btn-primary">Learn more</a>
                                @if(isset($producer->producer_file) && $producer->producer_file!=null)
                                <a href="{{asset('producer/pdffile')}}/{{$producer->producer_file}}" class="btn btn-inverse download-pdf" download> <img src="{{asset('images/icon-print.png')}}" alt="Print" title="Print">&nbsp;&nbsp;Download as PDF</a>
                                @endif
                                
                            </div>
                        </div>
                    </div>
                @endforeach
                    
                    <!-- <div class="col-lg-6 col-md-6 col-xs-12">
                        <div class="single-producer">
                            <div class="content-img">
                                <figure>
                                    <img src="{{asset('images/about-img-2.jpg')}}" alt="Producers" title="Producers">
                                </figure>
                            </div>
                            <div class="content-text">
                                <h2 class="title text-sm-left text-capitalize">Producer Name</h2>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec pellentesque massa
                                    vitae semper facilisis.Class aptent taciti sociosqu ad litora torquent per conubia
                                    nostra, per inceptos himenaeos.</p>
                                <a href="{{URL::to('single-producer')}}" class="btn btn-primary">Learn more</a>
                                <a href="#" class="btn btn-inverse download-pdf" download> <img src="images/icon-print.png" alt="Print" title="Print">&nbsp;&nbsp;Download as PDF</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-xs-12">
                        <div class="single-producer">
                            <div class="content-img">
                                <figure>
                                    <img src="{{asset('images/about-img-1.jpg')}}" alt="Producers" title="Producers">
                                </figure>
                            </div>
                            <div class="content-text">
                                <h2 class="title text-sm-left text-capitalize">Producer Name</h2>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec pellentesque massa
                                    vitae semper facilisis.Class aptent taciti sociosqu ad litora torquent per conubia
                                    nostra, per inceptos himenaeos.</p>
                                <a href="{{URL::to('single-producer')}}" class="btn btn-primary">Learn more</a>
                                <a href="#" class="btn btn-inverse download-pdf" download> <img src="images/icon-print.png" alt="Print" title="Print">&nbsp;&nbsp;Download as PDF</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-xs-12">
                        <div class="single-producer">
                            <div class="content-img">
                                <figure>
                                    <img src="{{asset('images/about-img-2.jpg')}}" alt="Producers" title="Producers">
                                </figure>
                            </div>
                            <div class="content-text">
                                <h2 class="title text-sm-left text-capitalize">Producer Name</h2>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec pellentesque massa
                                    vitae semper facilisis.Class aptent taciti sociosqu ad litora torquent per conubia
                                    nostra, per inceptos himenaeos.</p>
                                <a href="{{URL::to('single-producer')}}" class="btn btn-primary">Learn more</a>
                                <a href="#" class="btn btn-inverse download-pdf" download> <img src="images/icon-print.png" alt="Print" title="Print">&nbsp;&nbsp;Download as PDF</a>
                            </div>
                        </div>
                    </div> -->
                </div>
            </div>
        </section>

        <section id="producers-bottom" class="image-overlay-box">
            <div class="image-overlay">
                <figure>
                    <img src="{{asset('images/about_us_bg.jpg')}}" alt="Producers" title="Producers">
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