<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" id="csrf">
    <link rel="stylesheet" href="{{asset('css/app.css?554')}}">
    <link rel="stylesheet" href="{{asset('css/toaster.css')}}">
    <link rel="stylesheet" href="{{asset('css/icons/themify-icons.css')}}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{asset('css/dashboard.css')}}">
    <link rel="stylesheet" href="https://unpkg.com/vue-select@latest/dist/vue-select.css">
    <title>Sello Pronto</title>
</head>
<body>
    <div class="side-nav">
        <!-- Logo de Iniccio-->
        
        <div class="side-logo">
            <a href="{{url('admin')}}">
                <img src="{{asset('img/logoweb.png')}}">
            </a>
        </div>
        <div class="side-nav-nav">
            <nav>
                <ul class="side-nav-list">
                    <li class="side-nav-item"><a href="{{url('/quotations')}}"><span class="bi bi-circle"></span>Cotizaciones</a></li>
                    <li class="side-nav-item"><a href="{{url('/articles')}}"><span class="bi bi-circle"></span>Artículos</a></li>
                    <li class="side-nav-item"><a href="{{url('/cataloges')}}"><span class="bi bi-circle"></span>Catálogos</a></li>
                    <li class="side-nav-item"><a href="{{url('/categories')}}"><span class="bi bi-circle"></span>Categorías</a></li>
                    <li class="side-nav-item"><a href="{{url('/contacts_page/1')}}"><span class="bi bi-circle"></span>Clientes</a></li>
                    <li class="side-nav-item"><a href="{{url('/contacts_page/2')}}"><span class="bi bi-circle"></span>Proveedores</a></li>
                    <li class="side-nav-item"><a href="{{url('/orders/')}}"><span class="bi bi-circle"></span>Pedidos a Proveedor</a></li>
                    <li class="side-nav-item"><a href="{{url('/config/')}}"><span class="bi bi-circle"></span>Configuración</a></li>
                    <li class="side-nav-item"><a href="{{url('/accounting/')}}"><span class="bi bi-circle"></span>Contabilidad</a></li>
                    <li class="side-nav-item"><a href="{{url('/stock/')}}"><span class="bi bi-circle"></span>Inventario</a></li>
                    <li class="side-nav-item"><a href="{{url('/orders/')}}"><span class="bi bi-circle"></span>Ordenes de Compra</a></li>
                    <li class="side-nav-item"><a href="{{url('/sale/')}}"><span class="bi bi-circle"></span>Ventas</a></li>
                </ul>
            </nav>
            
            


            <a href="{{url('/order_page/2')}}" class="btn step-button mt-2 rounded-0 ">Nueva Cotización</a>
            <a href="{{url('/pos/')}}" class="btn step-button mt-2 rounded-0 ">Nueva Venta</a>
            <a class="btn step-button mt-2 rounded-0" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><span class="bi bi-box-arrow-right"></span>Salir</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>
    </div>
	 <div class="main">
        <div class="main-top-bar">
            <div class="side-nav-user">
                <p>{{Auth::user()->name;}}</p>
            </div>
        </div>
        <div id="app">
            @yield('content')
        </div>
    </div>   
    <div id="toaster">
        <div class="toaster-icon">
            <span class="bi bi-bell"></span>
        </div>
        <div class="toaster-body">
            <p class="toaster-title m-0 p-0"></p>
            <p class="toaster-message m-0 p-0"></p>
        </div>
    </div>
    <style>
        .my-select-group > input{
            display: none;
        }
        .my-select-group > input:checked + label{
            border: 3px solid grey;
        }
    </style>
    <script src="{{asset('js/app.js')}}"></script>
    <script src="{{asset('js/toaster.js')}}"></script>
    <script src="https://unpkg.com/vue-select@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
</body>
</html>