<section id="wsus__banner" class="wsus__banner">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div id="promotionCarousel" class="carousel slide" data-bs-ride="false">
                    <div class="carousel-inner">
                        @foreach ($promociones as $index => $promocion)
                            <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="wsus__single_slider_text">
                                            <h3>{{ $promocion->nombre }}</h3>
                                            <h1>{{ $promocion->producto->nombre }}</h1>
                                            <h6>Precio: ${{ $promocion->producto->precio }} - Descuento: ${{ $promocion->descuento }}</h6>
                                            <a class="btn btn-primary" href="#">Comprar Ahora</a>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <img src="{{ asset($promocion->producto->imagen) }}" class="img-fluid" alt="{{ $promocion->producto->nombre }}">
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#promotionCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#promotionCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                    <div class="carousel-indicators">
                        @foreach ($promociones as $index => $promocion)
                            <button type="button" data-bs-target="#promotionCarousel" data-bs-slide-to="{{ $index }}" class="{{ $index == 0 ? 'active' : '' }}" aria-current="{{ $index == 0 ? 'true' : 'false' }}" aria-label="Slide {{ $index + 1 }}"></button>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
