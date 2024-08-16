@extends('dash') {{-- Asumiendo que tienes un layout base llamado 'dash' --}}

@section('title', 'Videojuegos')

@section('content')
    <h1>Ofertas</h1><br>

  

    <div class="row">
        @foreach ($productos as $producto)
            @php
                $oferta = $producto->ofertas->descuento; // Porcentaje de oferta
                $precioAnterior = $producto->precio;
                $precioOferta = $oferta ? $precioAnterior - ($precioAnterior * ($oferta / 100)) : $precioAnterior;
            @endphp
            <div class="col-md-3 mb-4">
                <div class="card h-100 Productos position-relative" data-id="{{ $producto->id }}">
                    @if ($oferta >= 0)
                        <div class="discount-badge">
                            {{ $oferta }}% OFF
                        </div>
                    @endif
                    <img class="card-img-top image" src="{{ asset('storage/' . $producto->imagen) }}" alt="...">
                    <div class="card-body p-3">
                        <div class="text-center">
                            <h5 class="fw-bolder">{{ $producto->nombre }}</h5>
                            @if ($oferta > 0)
                                <div class="old-price">${{ $precioAnterior }}</div>
                                <div class="precio">${{ number_format($precioOferta, 2) }}</div>
                            @else
                                <div class="precio">${{ number_format($precioAnterior, 2) }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="card-footer p-3 pt-0 border-top-0 bg-transparent">
                        
                        <div class="text-center">
                        <p class="ver-detalles">Ver detalles</p> <!-- Texto clickeable para mostrar detalles -->
                        <div class="detalles">
                        @if ($oferta > 0)
                                <p>Descuento válido desde</p>
                                <p>{{ $producto->ofertas->fecha_inicio }} al {{ $producto->ofertas->fecha_fin }}</p>
                            @endif
                                </div>
                            <a  class="btn btn-outline-dark mt-auto">Añadir al carrito</a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <h1>Estrenos</h1><br>
    <div class="row">
    {{-- Mostrar productos que son estrenos --}}
        @foreach ($estrenos as $estreno)
            <div class="col-md-3 mb-4">
                <div class="card h-100 Productos position-relative" data-id="{{ $producto->id }}">
                    <div class="new-badge">New</div>
                    <img class="card-img-top image" src="{{ asset('storage/' . $estreno->imagen) }}" alt="...">
                    <div class="card-body p-4">
                        <div class="text-center">
                            <h5 class="fw-bolder">{{ $estreno->nombre }}</h5>
                            <div class="precio">${{ number_format($estreno->precio, 2) }}</div>
                        </div>
                    </div>
                    <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                        <div class="text-center">
                            <a class="btn btn-outline-dark mt-auto">Añadir al carrito</a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <script>
        // Script para mostrar/ocultar detalles al hacer clic en el texto
        document.addEventListener('DOMContentLoaded', function () {
            const verDetalles = document.querySelectorAll('.ver-detalles');
            verDetalles.forEach(detalle => {
                detalle.addEventListener('click', function () {
                    const detalles = this.parentNode.querySelector('.detalles');
                    detalles.style.display = detalles.style.display === 'block' ? 'none' : 'block';
                });
            });
        });
    </script>
    
@endsection