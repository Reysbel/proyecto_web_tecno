@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Venta de Productos</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item">Venta de Productos</div>
            </div>
        </div>
    </section>

    <div class="container">
        <div class="row">
            <div class="col-8">
                <h2>Categorías</h2>
                <div class="grid-container">
                    @foreach ($categorias as $categoria)
                        <button class="categoria {{ $loop->first ? 'active' : '' }}" data-categoria="{{ $categoria->slug }}">{{ $categoria->nombre }}</button>
                    @endforeach
                </div>

                <h2>Productos</h2>
                <div class="grid-container" id="productos-container">
                    <!-- Aquí se cargarán dinámicamente los productos -->
                </div>
            </div>

            <div class="col-4">
                <div class="ticket">
                    <h2>Factura</h2>
                    <div class="ticket-content">
                        <p>Nombre Cliente: <span>{{ $nombreCliente }}</span></p>
                        <p>Fecha: <span>{{ now()->format('Y-m-d') }}</span></p>
                        <p>Sub Total: <span>{{ $sub_total }}</span></p>
                        <p>Descuento: <span>{{ $descuento }}</span></p>
                        <p>Total Factura: <span>{{ $total_factura }}</span></p>
                        <p>Efectivo: <span>{{ $efectivo }}</span></p>
                        <p>Cambio: <span>{{ $cambio }}</span></p>
                        <p>Nota: <span>{{ $nota }}</span></p>
                        <p>Estado Factura: <span>{{ $estado_factura }}</span></p>
                        <p>Pedido Estado: <span>{{ $pedido_estado }}</span></p>
                    </div>
                    <button class="save">Guardar</button>
                    <button class="checkout">Cobrar</button>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Estilos CSS aquí */
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Datos de productos y categorías desde el backend
            const productosPorCategoria = @json($productosPorCategoria);

            // Función para cargar productos según la categoría seleccionada
            function cargarProductos(categoria) {
                const productos = productosPorCategoria[categoria] || [];

                const productosContainer = document.getElementById('productos-container');
                productosContainer.innerHTML = '';

                productos.forEach(producto => {
                    const gridItem = document.createElement('div');
                    gridItem.classList.add('grid-item');

                    const img = document.createElement('img');
                    img.src = producto.imagen;
                    img.alt = producto.nombre;

                    const p = document.createElement('p');
                    p.textContent = producto.nombre;

                    // Event listener para agregar producto a la factura
                    gridItem.addEventListener('click', function () {
                        // Lógica para agregar producto a detalle factura
                        // Aquí debes implementar la lógica adecuada para tu aplicación
                        // Por ejemplo, enviar una petición AJAX para agregar el producto a la factura
                        alert(`Agregado a la factura: ${producto.nombre}`);
                    });

                    gridItem.appendChild(img);
                    gridItem.appendChild(p);

                    productosContainer.appendChild(gridItem);
                });
            }

            // Manejar clics en botones de categorías
            const botonesCategoria = document.querySelectorAll('.categoria');
            botonesCategoria.forEach(boton => {
                boton.addEventListener('click', function () {
                    // Cambiar clase activa
                    botonesCategoria.forEach(btn => btn.classList.remove('active'));
                    boton.classList.add('active');

                    // Obtener categoría seleccionada
                    const categoriaSeleccionada = boton.getAttribute('data-categoria');

                    // Cargar productos de la categoría seleccionada
                    cargarProductos(categoriaSeleccionada);
                });
            });
        });
    </script>
@endsection
