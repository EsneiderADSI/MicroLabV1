@extends('layout')

@section('content')
{{-- Doctor saludando para comenzar --}}
    <section id="home" class="slider_area">
        <div id="carouselThree" class="carousel slide">
            <ol class="carousel-indicators">
                <li data-target="#carouselThree" data-slide-to="0" class="active"></li>
                <li data-target="#carouselThree" data-slide-to="1"></li>
                <li data-target="#carouselThree" data-slide-to="2"></li>
            </ol>

            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="slider-content">
                                    <h1 class="title">Bienvenido a MicroLab</h1>
                                    <p class="text">Laboratorio virtual microbiológico</p>
                                    <ul class="slider-btn rounded-buttons">
                                        <li><a class="main-btn rounded-one" href="{{ route('modulos') }}">COMENZAR</a></li>
                                        <!-- <li><a class="main-btn rounded-two" href="#">DOWNLOAD</a></li> -->
                                    </ul>
                                </div>
                            </div>
                        </div> <!-- row -->
                    </div> <!-- container -->
                    <div class="slider-image-box d-none d-lg-flex align-items-end">
                        <div class="slider-image" style="width: 310px;">
                            <img src="assets/images/svg/profesor.svg" alt="Hero">
                        </div> <!-- slider-imgae -->
                    </div> <!-- slider-imgae box -->
                </div> <!-- carousel-item -->

                <div class="carousel-item">

                    <div class="container">
                        <div class="row justify-content-center" style="margin-top: -100px;">
                            <div class="col-lg-6 col-md-10">
                                <div class="slider-content">
                                    <h3 class="title">Módulos</h3>
                                </div> <!-- row -->
                            </div>
                        </div> <!-- row -->
                        <div class="row justify-content-center" style="margin-top: -100px;">
                            <div class="col-lg-4 col-md-7 col-sm-9">
                                <div class="single-features mt-40">
                                    <div class="features-title-icon d-flex justify-content-between">
                                        <h4 class="features-title"><a href="#">Módulo #1</a></h4>
                                        <div class="features-icon">
                                            <i class="lni lni-brush"></i>
                                            <img class="shape" src="assets/images/f-shape-1.svg" alt="Shape">
                                        </div>
                                    </div>
                                    <div class="features-content">
                                        <p class="text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Veritatis, id ab, quod sed nemo, pariatur tempora dignissimos doloremque nulla voluptatibus iure culpa excepturi eveniet. Laboriosam in esse suscipit magni voluptas.</p>
                                        <a class="features-btn" href="#">Realizar</a>
                                    </div>
                                </div> <!-- single features -->
                            </div>
                            <div class="col-lg-4 col-md-7 col-sm-9">
                                <div class="single-features mt-40">
                                    <div class="features-title-icon d-flex justify-content-between">
                                        <h4 class="features-title"><a href="#">Módulo # 2</a></h4>
                                        <div class="features-icon">
                                            <i class="lni lni-layout"></i>
                                            <img class="shape" src="assets/images/f-shape-1.svg" alt="Shape">
                                        </div>
                                    </div>
                                    <div class="features-content">
                                        <p class="text">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Iure, ducimus. Aspernatur atque perspiciatis a sequi perferendis. Velit, autem similique ipsa neque delectus vero est inventore nihil nesciunt aut sed? Laboriosam?</p>
                                        <a class="features-btn" href="#">Realizar</a>
                                    </div>
                                </div> <!-- single features -->
                            </div>
                            <div class="col-lg-4 col-md-7 col-sm-9">
                                <div class="single-features mt-40">
                                    <div class="features-title-icon d-flex justify-content-between">
                                        <h4 class="features-title"><a href="#">Módulo # 3</a></h4>
                                        <div class="features-icon">
                                            <i class="lni lni-bolt"></i>
                                            <img class="shape" src="assets/images/f-shape-1.svg" alt="Shape">
                                        </div>
                                    </div>
                                    <div class="features-content">
                                        <p class="text">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Magni fuga nemo illum aliquid iusto. Odio maiores facere amet laboriosam, possimus totam, facilis nam hic modi corporis sint, voluptatum fuga voluptate.</p>
                                        <a class="features-btn" href="#">Realizar</a>
                                    </div>
                                </div> <!-- single features -->
                            </div>
                        </div> <!-- row -->
                    </div> <!-- container -->
                </div> <!-- carousel-item -->

                <div class="carousel-item">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="slider-content">
                                    <h1 class="title">Based on Bootstrap 4</h1>
                                    <p class="text">We blend insights and strategy to create digital products for forward-thinking organisations.</p>
                                    <ul class="slider-btn rounded-buttons">
                                        <li><a class="main-btn rounded-one" href="#">GET STARTED</a></li>
                                        <li><a class="main-btn rounded-two" href="#">DOWNLOAD</a></li>
                                    </ul>
                                </div> <!-- slider-content -->
                            </div>
                        </div> <!-- row -->
                    </div> <!-- container -->
                    <div class="slider-image-box d-none d-lg-flex align-items-end" style="margin-top: 700px; ">
                        <div class="slider-image">
                            <img src="assets/images/svg/profesor.svg" alt="Hero">
                        </div> <!-- slider-imgae -->
                    </div> <!-- slider-imgae box -->
                </div> <!-- carousel-item -->
            </div>

            <!-- <a class="carousel-control-prev" href="#carouselThree" role="button" data-slide="prev">
                <i class="lni lni-arrow-left"></i>
            </a>
            <a class="carousel-control-next" href="#carouselThree" role="button" data-slide="next">
                <i class="lni lni-arrow-right"></i>
            </a> -->
        </div>
    </section>

@endsection