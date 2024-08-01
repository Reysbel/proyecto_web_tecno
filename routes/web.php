<?php

use App\Http\Controllers\admin\CarritoAController;
use App\Http\Controllers\Admin\CategoriaController;
use App\Http\Controllers\Admin\CompraController;
use App\Http\Controllers\Admin\DeliveryController;
use App\Http\Controllers\Admin\ErrorController;
use App\Http\Controllers\Admin\PedidoWebController;
use App\Http\Controllers\Admin\ProductoController;
use App\Http\Controllers\Admin\PromocionController;
use App\Http\Controllers\Admin\ProveedorController;
use App\Http\Controllers\Admin\RegistroCompraController;
use App\Http\Controllers\Admin\ReporteController;
use App\Http\Controllers\Admin\TipoEmpleadoController;
use App\Http\Controllers\Admin\UserAdminController;
use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\AdminProfileController;
use App\Http\Controllers\Backend\ClienteController;
use App\Http\Controllers\Backend\ClienteProfileController;
use App\Http\Controllers\Backend\VendedorController;
use App\Http\Controllers\Backend\VendedorProfileController;
use App\Http\Controllers\Cliente\CarritoController;
use App\Http\Controllers\Cliente\CliProducController;
use App\Http\Controllers\FacturaController;
use App\Http\Controllers\Frontend\CatalogoController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Vendedor\CarritoBController;
use App\Http\Controllers\Vendedor\LClienteController;
use App\Http\Controllers\Vendedor\PedidosWebVendedorController;
use App\Http\Controllers\Vendedor\VendedorFacturaController;
use App\Http\Controllers\Vendedor\VendedorProducController;
use App\Http\Controllers\Vendedor\VentaController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/search', [HomeController::class, 'search'])->name('search');
Route::get('/frontend/nosotros/index', [HomeController::class, 'nosotros'])->name('frontend.nosostros.index');

Route::get('/frontend/catalogo/index', [CatalogoController::class, 'index'])->name('frontend.catalogo.index');
Route::get('/catalogo/categoria/{id}', [CatalogoController::class, 'categoria'])->name('catalogo.categoria');
Route::get('catalogo/{categoriaId?}', [CatalogoController::class, 'index']);
Route::get('producto/{id}', [CatalogoController::class, 'show']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/profile', [AdminProfileController::class, 'index'])->name('admin.profile');
    Route::post('/admin/profile/update', [AdminProfileController::class, 'updateProfile'])->name('admin.profile.update');
    Route::post('/admin/profile/update/password', [AdminProfileController::class, 'updatePassword'])->name('admin.password.update');

    Route::get('/admin/tablas/error/index', [ErrorController::class, 'index'])->name('admin.tablas.error.index');
    Route::get('/admin/tablas/factura/index', [FacturaController::class, 'index'])->name('admin.tablas.factura.index');

    Route::get('/admin/tablas/categoria/index', [CategoriaController::class, 'index'])->name('admin.tablas.categoria.index');
    Route::get('/admin/tablas/categoria/create', [CategoriaController::class, 'create'])->name('admin.tablas.categoria.create');
    Route::post('/admin/tablas/categoria/store', [CategoriaController::class, 'store'])->name('admin.tablas.categoria.store');
    Route::get('/admin/tablas/categoria/{id_categoria}/edit', [CategoriaController::class, 'edit'])->name('admin.tablas.categoria.edit');
    Route::put('/admin/tablas/categoria/{id_categoria}/update', [CategoriaController::class, 'update'])->name('admin.tablas.categoria.update');
    Route::delete('/admin/tablas/categoria/{id_categoria}/destroy', [CategoriaController::class, 'destroy'])->name('admin.tablas.categoria.destroy');
    Route::get('/admin/tablas/categoria/search', [CategoriaController::class, 'search'])->name('admin.tablas.categoria.search');
    Route::get('/admin/tablas/categoria/{id_categoria}', [CategoriaController::class, 'show'])->name('admin.tablas.categoria.show'); // Ruta para 'show'

    Route::get('/admin/tablas/producto/index', [ProductoController::class, 'index'])->name('admin.tablas.producto.index');
    Route::get('/admin/tablas/producto/create', [ProductoController::class, 'create'])->name('admin.tablas.producto.create');
    Route::post('/admin/tablas/producto/store', [ProductoController::class, 'store'])->name('admin.tablas.producto.store');
    Route::get('/admin/tablas/producto/{id_producto}/edit', [ProductoController::class, 'edit'])->name('admin.tablas.producto.edit');
    Route::put('/admin/tablas/producto/{id_producto}/update', [ProductoController::class, 'update'])->name('admin.tablas.producto.update');
    Route::delete('/admin/tablas/producto/{id_producto}/destroy', [ProductoController::class, 'destroy'])->name('admin.tablas.producto.destroy');
    Route::get('admin/tablas/producto/{id_producto}', [ProductoController::class, 'show'])->name('admin.tablas.producto.show');
    Route::get('/admin/tablas/producto/search', [ProductoController::class, 'search'])->name('admin.tablas.producto.search');


    Route::get('/admin/tablas/tipo_empleado/index', [TipoEmpleadoController::class, 'index'])->name('admin.tablas.tipo_empleado.index');
    Route::get('/admin/tablas/tipo_empleado/create', [TipoEmpleadoController::class, 'create'])->name('admin.tablas.tipo_empleado.create');
    Route::post('/admin/tablas/tipo_empleado/store', [TipoEmpleadoController::class, 'store'])->name('admin.tablas.tipo_empleado.store');
    Route::get('/admin/tablas/tipo_empleado/{id_tipo_empleado}/edit', [TipoEmpleadoController::class, 'edit'])->name('admin.tablas.tipo_empleado.edit');
    Route::put('/admin/tablas/tipo_empleado/{id_tipo_empleado}/update', [TipoEmpleadoController::class, 'update'])->name('admin.tablas.tipo_empleado.update');
    Route::delete('/admin/tablas/tipo_empleado/{id_tipo_empleado}/destroy', [TipoEmpleadoController::class, 'destroy'])->name('admin.tablas.tipo_empleado.destroy');
    Route::get('/admin/tablas/tipo_empleado/{id_tipo_empleado}', [TipoEmpleadoController::class, 'show'])->name('admin.tablas.tipo_empleado.show');

    Route::get('/admin/tablas/user/index', [UserAdminController::class, 'index'])->name('admin.tablas.user.index');
    Route::get('/admin/tablas/user/create', [UserAdminController::class, 'create'])->name('admin.tablas.user.create');
    Route::post('/admin/tablas/user/store', [UserAdminController::class, 'store'])->name('admin.tablas.user.store');
    Route::get('/admin/tablas/user/{id}/edit', [UserAdminController::class, 'edit'])->name('admin.tablas.user.edit');
    Route::put('/admin/tablas/user/{id}/update', [UserAdminController::class, 'update'])->name('admin.tablas.user.update');
    Route::delete('/admin/tablas/user/{id}/destroy', [UserAdminController::class, 'destroy'])->name('admin.tablas.user.destroy');
    Route::get('/admin/tablas/user/{id}', [UserAdminController::class, 'show'])->name('admin.tablas.user.show');
    Route::get('/admin/tablas/user/search', [UserAdminController::class, 'search'])->name('admin.tablas.user.search');

    Route::prefix('admin/tablas')->name('admin.tablas.')->group(function () {
        Route::resource('proveedor', ProveedorController::class);
    });

    Route::get('/admin/tablas/factura/index', [FacturaController::class, 'index'])->name('admin.tablas.factura.index');
    Route::get('/admin/tablas/factura/create', [FacturaController::class, 'create'])->name('admin.tablas.factura.create');
    Route::post('/admin/tablas/factura/store', [FacturaController::class, 'store'])->name('admin.tablas.factura.store');


    Route::get('/admin/tablas/promocion/index', [PromocionController::class, 'index'])->name('admin.tablas.promocion.index');
    Route::get('/admin/tablas/promocion/create', [PromocionController::class, 'create'])->name('admin.tablas.promocion.create');
    Route::get('/admin/tablas/promocion/{id}', [PromocionController::class, 'show'])->name('admin.tablas.promocion.show');

    Route::post('/admin/tablas/promocion/store', [PromocionController::class, 'store'])->name('admin.tablas.promocion.store');
    Route::get('/admin/tablas/promocion/edit/{id}', [PromocionController::class, 'edit'])->name('admin.tablas.promocion.edit');
    Route::put('/admin/tablas/promocion/update/{id}', [PromocionController::class, 'update'])->name('admin.tablas.promocion.update');
    Route::delete('/admin/tablas/promocion/destroy/{id}', [PromocionController::class, 'destroy'])->name('admin.tablas.promocion.destroy');

    Route::prefix('admin/tablas')->name('admin.tablas.')->group(function () {
        Route::resource('compra', CompraController::class);
    });
    Route::prefix('admin/tablas/registro_compra')->group(function () {
        Route::get('/', [RegistroCompraController::class, 'index'])->name('admin.tablas.registro_compra.index');
        Route::get('/create/{id_producto}', [RegistroCompraController::class, 'create'])->name('admin.tablas.registro_compra.create');
        Route::get('/create_produc', [RegistroCompraController::class, 'createProduc'])->name('admin.tablas.registro_compra.create_produc');
        Route::post('/store_produc', [RegistroCompraController::class, 'store_produc'])->name('admin.tablas.registro_compra.store_produc');
        Route::post('/store_compra', [RegistroCompraController::class, 'store_compra'])->name('admin.tablas.registro_compra.store_compra');
        Route::get('/complete_product/{id_producto}', [RegistroCompraController::class, 'complete_product'])->name('admin.tablas.registro_compra.complete_product');
        Route::post('/update_product/{id_producto}', [RegistroCompraController::class, 'update_product'])->name('admin.tablas.registro_compra.update_product');
    });

    // Rutas para los pedidos web
    Route::get('/admin/tablas/pedido_web/index', [PedidoWebController::class, 'index'])->name('admin.tablas.pedido_web.index');
    Route::get('/admin/tablas/pedido_web/{id}', [PedidoWebController::class, 'show'])->name('admin.tablas.pedido_web.show');

    Route::get('/admin/tablas/reporte/index', [ReporteController::class, 'index'])->name('admin.tablas.reporte.index');
    Route::get('/admin/tablas/reporte/create', [ReporteController::class, 'create'])->name('admin.tablas.reporte.create');
    Route::post('/admin/tablas/reporte/store', [ReporteController::class, 'store'])->name('admin.tablas.reporte.store');
    Route::get('/admin/tablas/reporte/{reporte}', [ReporteController::class, 'show'])->name('admin.tablas.reporte.show');
    Route::get('/admin/tablas/reporte/{reporte}/edit', [ReporteController::class, 'edit'])->name('admin.tablas.reporte.edit');
    Route::put('/admin/tablas/reporte/{reporte}', [ReporteController::class, 'update'])->name('admin.tablas.reporte.update');
    Route::delete('/admin/tablas/reporte/{reporte}', [ReporteController::class, 'destroy'])->name('admin.tablas.reporte.destroy');
    Route::get('/admin/tablas/reporte/{reporte}/print', [ReporteController::class, 'print'])->name('admin.tablas.reporte.print');

    Route::get('/admin/reportes/obtener-detalles', [ReporteController::class, 'obtenerDetalles'])->name('admin.reportes.obtenerDetalles');

    Route::prefix('admin/tablas/delivery')->name('admin.tablas.delivery.')->group(function () {
        Route::get('index', [DeliveryController::class, 'index'])->name('index');
        Route::get('create', [DeliveryController::class, 'create'])->name('create');
        Route::post('store', [DeliveryController::class, 'store'])->name('store');
        Route::get('{id}/edit', [DeliveryController::class, 'edit'])->name('edit');
        Route::put('{id}/update', [DeliveryController::class, 'update'])->name('update');
        Route::delete('{id}/destroy', [DeliveryController::class, 'destroy'])->name('destroy');
        Route::get('{id}', [DeliveryController::class, 'show'])->name('show');
        Route::get('search', [DeliveryController::class, 'search'])->name('search');
    });


    // Mostrar la vista del carrito
    Route::get('admin/carrito', [CarritoAController::class, 'index'])->name('admin.carrito.index');
    // Agregar un producto al carrito
    Route::post('admin/carrito/agregar/{id_producto}', [CarritoAController::class, 'agregarAlCarrito'])->name('agregar_al_carrito');
    // Actualizar la cantidad de un producto en el carrito
    Route::post('admin/carrito/actualizar/{id_producto}', [CarritoAController::class, 'actualizarCantidad'])->name('actualizar_cantidad');
    // Eliminar un producto del carrito
    Route::post('admin/carrito/eliminar/{id_producto}', [CarritoAController::class, 'eliminarDelCarrito'])->name('eliminar_del_carrito');
    // Cancelar la compra y vaciar el carrito
    Route::post('admin/carrito/cancelar', [CarritoAController::class, 'cancelarCompra'])->name('cancelar_compra');
    // Realizar el pedido
    Route::post('admin/carrito/realizar', [CarritoAController::class, 'realizarPedido'])->name('admin.carrito.realizarPedido');
    // Mostrar el resumen del pedido
    Route::get('admin/carrito/resumen', [CarritoAController::class, 'resumenPedido'])->name('admin.carrito.show');
    // Iniciar un nuevo pedido
    Route::post('admin/carrito/nuevo', [CarritoAController::class, 'nuevoPedido'])->name('admin.carrito.nuevoPedido');

    Route::get('admin/carrito/nuevo-pedido', [CarritoAController::class, 'nuevoPedido'])->name('admin.carrito.nuevoPedido');
});

Route::middleware(['auth', 'role:cliente'])->group(function () {
    Route::get('/cliente/dashboard', [ClienteController::class, 'dashboard'])->name('cliente.dashboard');
    Route::get('/cliente/profile', [ClienteProfileController::class, 'index'])->name('cliente.profile');
    Route::post('/cliente/profile/update', [ClienteProfileController::class, 'updateProfile'])->name('cliente.profile.update');
    Route::post('/cliente/profile/update/password', [ClienteProfileController::class, 'updatePassword'])->name('cliente.password.update');

    Route::prefix('cliente')->middleware('auth')->group(function () {
        Route::get('/', [CarritoController::class, 'index'])->name('cliente.index');
        Route::post('/carrito/agregar/{id_producto}', [CarritoController::class, 'agregarAlCarrito'])->name('cliente.carrito.agregar');
        Route::get('/carrito/ver', [CarritoController::class, 'verCarrito'])->name('cliente.carrito.ver');
        Route::post('/carrito/eliminar/{id_detalle}', [CarritoController::class, 'eliminarDelCarrito'])->name('cliente.carrito.eliminar');
        Route::post('/carrito/actualizar/{id_detalle}', [CarritoController::class, 'actualizarCantidad'])->name('cliente.carrito.actualizar');
        Route::post('/carrito/realizar-pedido', [CarritoController::class, 'realizarPedido'])->name('cliente.carrito.realizarPedido');
        Route::get('/carrito/pedidos', [CarritoController::class, 'listarPedidos'])->name('cliente.carrito.pedidos');
        Route::get('/carrito/detalle/{id_factura}', [CarritoController::class, 'detalleFactura'])->name('cliente.layouts.detalle');

        Route::get('/layouts/index', [CarritoController::class, 'index'])->name('cliente.layouts.index');
        Route::get('/layouts/categoria/{id_categoria}', [CarritoController::class, 'mostrarCat'])->name('cliente.layouts.categoria');
        Route::get('/layouts/categoria/buscar', [CarritoController::class, 'mostrarCat'])->name('cliente.layouts.categoria.buscar');
        Route::get('/layouts/categoria', [CarritoController::class, 'indexc'])->name('cliente.layouts.categoria');

        Route::get('/pedido-web', function () {
            return view('cliente.layouts.pedido_web');
        })->name('cliente.pedido_web');
        Route::get('/cliente/carrito/detalle/{id_factura}', [CarritoController::class, 'verDetalle'])->name('cliente.carrito.detalle');
    });
    Route::get('/carrito/pedido-confirmado', [CarritoController::class, 'pedidoConfirmado'])->name('cliente.carrito.pedidoConfirmado');

    Route::post('/callback', [CarritoController::class, 'urlCallback'])->name('callback');

    Route::post('/cliente/carrito/realizarPedido', [CarritoController::class, 'realizarPedido'])->name('cliente.carrito.realizarPedido');
    Route::get('/cliente/carrito/ver', [CliProducController::class, 'verCarrito'])->name('cliente.carrito.ver');
});


Route::middleware(['auth', 'role:vendedor'])->group(function () {
    Route::get('/vendedor/dashboard', [VendedorController::class, 'dashboard'])->name('vendedor.dashboard');
    Route::get('/vendedor/profile', [VendedorProfileController::class, 'index'])->name('vendedor.profile');
    Route::post('/vendedor/profile/update', [VendedorProfileController::class, 'updateProfile'])->name('vendedor.profile.update');
    Route::post('/vendedor/profile/update/password', [VendedorProfileController::class, 'updatePassword'])->name('vendedor.password.update');

    Route::get('/vendedor/login', [VendedorController::class, 'login'])->name('vendedor.login');
Route::post('/vendedor/search', [VendedorController::class, 'search'])->name('vendedor.search');

    Route::get('/vendedor/layouts/index', [VendedorProducController::class, 'index'])->name('vendedor.layouts.index');
    Route::get('/vendedor/carrito/detalle', [VendedorProducController::class, 'detalleFactura'])->name('vendedor.carrito.detalle'); // Ruta para ver detalles de la factura
    Route::post('/vendedor/carrito/agregar/{id_producto}', [VendedorProducController::class, 'agregarAlCarrito'])->name('vendedor.carrito.agregar');
    Route::get('/vendedor/carrito/ver', [VendedorProducController::class, 'verCarrito'])->name('vendedor.carrito.ver');
    Route::post('/vendedor/realizar-pedido', [VendedorProducController::class, 'realizarPedido'])->name('vendedor.realizar_pedido');
    Route::post('/vendedor/cancelar-compra', [VendedorProducController::class, 'cancelarCompra'])->name('vendedor.cancelar_compra');
    Route::get('/vendedor/carrito/pedidos', [VendedorProducController::class, 'listarPedidos'])->name('vendedor.carrito.pedidos');
    Route::get('/vendedor/carrito/detalle/{id_factura}', [VendedorProducController::class, 'detalleFactura'])->name('vendedor.carrito.detalle');
    Route::delete('/vendedor/carrito/eliminar/{id_detalle}', [VendedorProducController::class, 'eliminarDelCarrito'])
        ->name('vendedor.carrito.eliminar');
    Route::put('/vendedor/carrito/actualizar/{id_detalle}', [VendedorProducController::class, 'actualizarCantidad'])
        ->name('vendedor.carrito.actualizar');
    Route::post('/vendedor/agregar-producto/{id_producto}', [VendedorProducController::class, 'agregarProducto'])
        ->name('vendedor.agregar_producto');
    Route::post('/vendedor/agregar-al-carrito/{id_producto}', [VendedorProducController::class, 'agregarAlCarrito'])->name('vendedor.agregar_al_carrito');

    Route::get('/vendedor/productos', [VendedorProducController::class, 'index'])->name('vendedor.productos.index');
    // Otras rutas del vendedor aquí...
    Route::get('/vendedor/pedidos', [VendedorFacturaController::class, 'index'])->name('vendedor.pedidos.index');
    // deliverys

    Route::prefix('vendedor')->name('vendedor.')->group(function () {
        Route::resource('delivery', DeliveryController::class);
    });
    // Ruta para mostrar detalles de una factura específica
    Route::get('/vendedor/pedidos/{id_factura}', [VendedorFacturaController::class, 'show'])->name('vendedor.pedidos.show');



    
    // Ruta para mostrar detalles de venta específica

    // Ruta para listar ventas
    Route::get('ventas', [VentaController::class, 'index'])->name('vendedor.ventas.index');

    // Ruta para mostrar el formulario de creación de una venta
    Route::get('ventas/create', [VentaController::class, 'create'])->name('vendedor.ventas.create');

    // Ruta para almacenar una nueva venta
    Route::post('ventas', [VentaController::class, 'store'])->name('vendedor.ventas.store');

    // Ruta para mostrar los detalles de una venta específica
    Route::get('ventas/{id}', [VentaController::class, 'show'])->name('vendedor.ventas.show');

    // Ruta para mostrar el formulario de edición de una venta específica
    Route::get('ventas/{id}/edit', [VentaController::class, 'edit'])->name('vendedor.ventas.edit');

    // Ruta para actualizar una venta específica
    Route::put('ventas/{id}', [VentaController::class, 'update'])->name('vendedor.ventas.update');

    // Ruta para eliminar una venta específica
    Route::delete('ventas/{id}', [VentaController::class, 'destroy'])->name('vendedor.ventas.destroy');


    Route::prefix('vendedor')->group(function () {
        Route::get('/lclientes', [LClienteController::class, 'index'])->name('vendedor.lclientes.index');
        Route::get('/lclientes/create', [LClienteController::class, 'create'])->name('vendedor.lclientes.create');
        Route::post('/lclientes', [LClienteController::class, 'store'])->name('vendedor.lclientes.store');
        Route::get('/lclientes/{id}', [LClienteController::class, 'show'])->name('vendedor.lclientes.show');
        Route::get('/lclientes/{id}/edit', [LClienteController::class, 'edit'])->name('vendedor.lclientes.edit');
        Route::put('/lclientes/{id}', [LClienteController::class, 'update'])->name('vendedor.lclientes.update');
        Route::delete('/lclientes/{id}', [LClienteController::class, 'destroy'])->name('vendedor.lclientes.destroy');
    });
    Route::get('/vendedor/pedidoweb/index', [PedidosWebVendedorController::class, 'index'])->name('vendedor.pedidoweb.index');
    Route::get('/vendedor/pedidoweb/search', [PedidosWebVendedorController::class, 'search'])->name('vendedor.pedidoweb.search');
    // Otras rutas para los métodos CRUD
    Route::get('/vendedor/pedidoweb/{id_pedido}', [PedidosWebVendedorController::class, 'show'])->name('vendedor.pedidoweb.show');
    Route::delete('/vendedor/pedidoweb/{id}', [PedidosWebVendedorController::class, 'destroy'])->name('vendedor.pedidoweb.destroy');
    Route::get('/vendedor/pedidoweb/{id}/edit', [PedidosWebVendedorController::class, 'edit'])->name('vendedor.pedidoweb.edit');
    Route::put('/vendedor/pedidoweb/{id}', [PedidosWebVendedorController::class, 'update'])->name('vendedor.pedidoweb.update');

    Route::resource('vendedor/pedidoweb', PedidosWebVendedorController::class)->except(['index']);

    // Mostrar la vista del carrito
    Route::get('vendedor/carrito', [CarritoBController::class, 'index'])->name('vendedor.carrito.index');
    // Agregar un producto al carrito
    Route::post('vendedor/carrito/agregar/{id_producto}', [CarritoBController::class, 'agregarAlCarrito'])->name('agregar_al_carrito');
    // Actualizar la cantidad de un producto en el carrito
    Route::post('vendedor/carrito/actualizar/{id_producto}', [CarritoBController::class, 'actualizarCantidad'])->name('actualizar_cantidad');
    // Eliminar un producto del carrito
    Route::post('vendedor/carrito/eliminar/{id_producto}', [CarritoBController::class, 'eliminarDelCarrito'])->name('eliminar_del_carrito');
    // Cancelar la compra y vaciar el carrito
    Route::post('vendedor/carrito/cancelar', [CarritoBController::class, 'cancelarCompra'])->name('cancelar_compra');
    // Realizar el pedido
    Route::post('vendedor/carrito/realizar', [CarritoBController::class, 'realizarPedido'])->name('vendedor.carrito.realizarPedido');
    // Mostrar el resumen del pedido
    Route::get('vendedor/carrito/resumen', [CarritoBController::class, 'resumenPedido'])->name('vendedor.carrito.show');
    // Iniciar un nuevo pedido
    Route::post('vendedor/carrito/nuevo', [CarritoBController::class, 'nuevoPedido'])->name('vendedor.carrito.nuevoPedido');

    Route::get('vendedor/carrito/nuevo-pedido', [CarritoBController::class, 'nuevoPedido'])->name('vendedor.carrito.nuevoPedido');
});
