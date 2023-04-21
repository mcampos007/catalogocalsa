{{-- Menú del Perfil --}}
<li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
        {{ Auth::user()->name }} <span class="caret"></span>
    </a>
    <ul class="dropdown-menu">
        <li>
            <a href="#">Mis Datos</a>
        </li>
        <li>
            <a href="{{ route('logout') }}"
                onclick="event.preventDefault();
                         document.getElementById('logout-form').submit();">
                Desconectarse
            </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
        </li>
    </ul>
</li>
{{-- Menu de Ventas --}}
<li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
        Ventas <span class="caret"></span>
    </a>
    <ul class="dropdown-menu">
        <li>
            <a href="{{ url('/home')}}">Ver Mis Pedidos</a>
        </li>
        <li>
            <a href="{{ url('/admin/precios') }}">Lista de Precios Calsa</a>
        </li>
        <li>
            <a href="{{ url('/admin/preciosf') }}">Lista de Precios Fiambres</a>
        </li>
        <li>
            <a href="{{ url('/admin/products')}}">Reportes</a>
        </li>        
    </ul>
</li>
{{-- Menu de Compras--}}
<li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
        Compras <span class="caret"></span>
    </a>
    <ul class="dropdown-menu">
        <li>
            <a href="{{ url('/home')}}">Mis Compras</a>
        </li>
        <li>
            <a href="{{ url('/admin/precios') }}">Pago a Proveedores</a>
        </li>
        <li>
            <a href="{{ url('/admin/preciosf') }}">Reportes</a>
        </li>
    </ul>
</li>
{{-- Menu de Cajas --}}
<li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
        Cajas <span class="caret"></span>
    </a>
    <ul class="dropdown-menu">
        <li>
            <a href="{{ url('/admin/cajas')}}">Cajas</a>
        </li>
        <li>
            <a href="{{ url('/admin/cajascerradas') }}">Cerradas</a>
        </li>
        <li>
            <a href="{{ url('/admin/controladmcaja') }}">Control Administrativo</a>
        </li>
        <li>
            <a href="{{ url('/admin/autitarcajas')}}">Auditoria</a>
        </li>
        <li>
            <a href="{{ url('/admin/reportescajas')}}">Reportes</a>
        </li>        
    </ul>
</li>
{{-- Menú de Tablas --}}
<li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
        Tablas del Sistema <span class="caret"></span>
    </a>
    <ul class="dropdown-menu">
        <li>
            <a href="{{ url('/admin/sectors')}}"> Sectores</a>
        </li>
        <li>
            <a href="{{ url('/admin/puntodeventa')}}"> Puntos de Ventas</a>
        </li>
        <li>
            <a href="{{ url('/admin/categories')}}"> Categorias</a>
        </li>
        <li>
            <a href="{{ url('/admin/products')}}"> Productos</a>
        </li>
        <li>
            <a href="{{ url('/admin/promotions')}}"> Promociones</a>
        </li>
        <li>
            <a href="{{ url('/admin/clients')}}"> Clientes</a>
        </li>
        <li>
            <a href="{{ url('/admin/clients')}}"> Proveedores</a>
        </li>
        <li>
            <a href="{{ url('/admin/clients')}}"> Usuarios</a>
        </li>   
    </ul>
</li>