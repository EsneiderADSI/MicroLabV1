@extends('layout')
@section('title', 'Módulos - MicroLab')
@section('content')
{{-- Doctor saludando para comenzar --}}
<div class="container">
    <div class="row justify-content-center" style="margin-top: -100px;">
        <div class="col-lg-6 col-md-10">
            <div class="slider-content">
                <h3 class="title" style="color: #000;">Módulos</h3>
            </div> <!-- row -->
        </div>
    </div> <!-- row -->
    <div class="row justify-content-center" style="margin-top: -100px;">
        <div class="col-lg-4 col-md-7 col-sm-9">
            <div class="single-features mt-40">
                <div class="features-title-icon d-flex justify-content-between">
                    <h4 class="features-title"><a href="{{ route('modulo1') }}">Práctica #1</a></h4>
                    <div class="features-icon">
                        <i class="lni lni-brush"></i>
                        <img class="shape" src="assets/images/f-shape-1.svg" alt="Shape">
                    </div>
                </div>
                <div class="features-content">
                    <p class="text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Veritatis, id ab, quod sed nemo, pariatur tempora dignissimos doloremque nulla voluptatibus iure culpa excepturi eveniet. Laboriosam in esse suscipit magni voluptas.</p>
                    <a class="features-btn" href="{{ route('modulo1') }}">Realizar</a>
                </div>
            </div> <!-- single features -->
        </div>
        <div class="col-lg-4 col-md-7 col-sm-9">
            <div class="single-features mt-40">
                <div class="features-title-icon d-flex justify-content-between">
                    <h4 class="features-title"><a href="#">Práctica # 2</a></h4>
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
                    <h4 class="features-title"><a href="#">Práctica # 3</a></h4>
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
</div>

@endsection