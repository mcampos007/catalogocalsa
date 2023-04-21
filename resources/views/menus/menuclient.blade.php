<li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
        {{ Auth::user()->name }} <span class="caret"></span>
    </a>
    <ul class="dropdown-menu">
        <li>
            <a href="{{ url('/home')}}">Ver Mis Pedidos</a>
        </li>
        {{-- <li>
            <a href="{{ url('/admin/precios') }}">Lista de Precios Calsa</a>
        </li>
        <li>
            <a href="{{ url('/admin/preciosf') }}">Lista de Precios Fiambres</a>
        </li>
        <li>
            <a href="{{ url('/admin/products')}}">Gestionar Productos</a>
        </li>
        <li>
            <a href="{{ url('/admin/promotions')}}">Gestionar Promociones</a>
        </li>
        <li>
            <a href="{{ url('/admin/categories')}}">Gestionar Categorias</a>
        </li>
        <li>
            <a href="{{ url('/admin/clients')}}">Gestionar Clientes</a>
        </li>
        <li>
            <a href="{{ url('/admin/pagos')}}">Gestionar Pagos</a>
        </li>
        <li>
            <a href="{{ url('/admin/sectors')}}">Gestionar Sectores</a>
        </li> --}}
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