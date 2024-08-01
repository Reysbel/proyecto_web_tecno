<div class="main-sidebar sidebar-style-2">
  <aside id="sidebar-wrapper">
    <div class="sidebar-brand">
      <a href="index.html">Menu Administrador</a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
      <!-- Puedes agregar contenido aquí o eliminar este div si no es necesario -->
    </div>
    <ul class="sidebar-menu">
      
      <!-- Dashboard -->
      <li class="menu-header">Dashboard</li>
      
      <!-- Gestionar Reportes -->
      <li class="dropdown">
        <a href="#" class="nav-link has-dropdown"><i class="fas fa-briefcase"></i> <span>Gestionar Reportes</span></a>
        <ul class="dropdown-menu">
          <li><a class="nav-link" href="{{ route('admin.tablas.reporte.index') }}">Reportes de Caja</a></li>
        </ul>
      </li>

      <!-- Gestión de Compras -->
      <li class="menu-header">Gestión de Compras</li>
      <li class="dropdown">
        <a href="#" class="nav-link has-dropdown"><i class="fas fa-shopping-cart"></i> <span>Compras</span></a>
        <ul class="dropdown-menu">
          <li><a class="nav-link" href="{{ route('admin.tablas.compra.index') }}">Ver Compras</a></li>
          <li><a class="nav-link" href="{{ route('admin.tablas.registro_compra.index') }}">Agregar Compra</a></li>
        </ul>
      </li>

      <!-- Gestión de Deliveries -->
      <li class="menu-header">Gestión de Delivery</li>
      <li class="dropdown">
        <a href="#" class="nav-link has-dropdown"><i class="fas fa-motorcycle"></i> <span>Deliveries</span></a>
        <ul class="dropdown-menu">
          <li><a class="nav-link" href="{{ route('admin.tablas.delivery.index') }}">Ver Deliveries</a></li>
          <li><a class="nav-link" href="{{ route('admin.tablas.delivery.create') }}">Agregar Delivery</a></li>
        </ul>
      </li>

      

      <!-- Gestión de Pedidos -->
      <li class="menu-header">Gestión de Pedidos</li>
      <li class="dropdown">
        <a href="#" class="nav-link has-dropdown"><i class="fas fa-shopping-cart"></i> <span>Pedidos</span></a>
        <ul class="dropdown-menu">
          <li><a class="nav-link" href="{{ route('admin.tablas.pedido_web.index') }}">Ver Pedidos</a></li>
        
        </ul>
      </li>

      <!-- Gestión de Productos -->
      <li class="menu-header">Gestión de Productos</li>
      <li class="dropdown">
        <a href="#" class="nav-link has-dropdown"><i class="fas fa-boxes"></i> <span>Productos</span></a>
        <ul class="dropdown-menu">
          <li><a class="nav-link" href="{{ route('admin.tablas.producto.index') }}">Ver Productos</a></li>
          <li><a class="nav-link" href="{{ route('admin.tablas.producto.create') }}">Agregar Producto</a></li>
          <li><a class="nav-link" href="{{ route('admin.tablas.categoria.index') }}">Gestionar Categorías</a></li>
        </ul>
      </li>

      <!-- Gestión de Proveedores -->
      <li class="menu-header">Gestión de Proveedores</li>
      <li class="dropdown">
        <a href="#" class="nav-link has-dropdown"><i class="fas fa-users"></i> <span>Proveedores</span></a>
        <ul class="dropdown-menu">
          <li><a class="nav-link" href="{{ route('admin.tablas.proveedor.index') }}">Ver Proveedores</a></li>
          <li><a class="nav-link" href="{{ route('admin.tablas.proveedor.create') }}">Agregar Proveedor</a></li>
        </ul>
      </li>
      
      <!-- Gestión de Usuarios -->
      <li class="menu-header">Gestión de Usuarios</li>
      <li class="dropdown">
        <a href="#" class="nav-link has-dropdown"><i class="fas fa-users"></i> <span>Usuarios</span></a>
        <ul class="dropdown-menu">
          <li><a class="nav-link" href="{{ route('admin.tablas.user.index') }}">Ver Usuarios</a></li>
          <li><a class="nav-link" href="{{ route('admin.tablas.user.create') }}">Agregar Usuario</a></li>
        </ul>
      </li>

      <!-- Gestionar Promociones -->
      <li class="menu-header">Gestionar Promociones</li>
      <li><a class="nav-link" href="{{ route('admin.tablas.promocion.index') }}"><i class="fas fa-tag"></i> <span>Gestionar Promociones</span></a></li>
      
      <!-- Realizar Ventas -->
      <li class="menu-header">Realizar Ventas</li>
      <li><a class="nav-link" href="{{ route('admin.carrito.index') }}"><i class="fas fa-cash-register"></i> <span>Registrar Ventas</span></a></li>

      <!-- Configuraciones -->
      <li class="menu-header">Configuraciones</li>
    </ul>
  </aside>
</div>
