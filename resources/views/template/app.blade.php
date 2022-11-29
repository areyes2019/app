<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" id="csrf">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="{{asset('css/toaster.css')}}">
    <link rel="stylesheet" href="{{asset('css/icons/themify-icons.css')}}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{asset('css/dashboard.css')}}">
    <title>Sello Pronto</title>
</head>
<body>
    <div class="top-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-10 d-flex align-items-center">
                    <h4 class="m-0"><a href="/admin">Sello Pronto</a></h4>
                </div>
                <div class="col-md-2 d-flex justify-content-end align-items-center">
                    <div class="dropdown">
                      <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        {{Auth::user()->name;}}
                      </button>
                      <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li>
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><span class="bi bi-box-arrow-right"></span>Salir</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>           
                      </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="side-nav">
        <nav class="side-nav-nav">
            <ul class="side-nav-list">
                <li class="side-nav-item"><a href="{{url('/quotations')}}"><span class="bi bi-circle"></span>Cotizaciones</a></li>
                <li class="side-nav-item"><a href="{{url('/articles')}}"><span class="bi bi-circle"></span>Artículos</a></li>
                <li class="side-nav-item"><a href="{{url('/cataloges')}}"><span class="bi bi-circle"></span>Catálogos</a></li>
                <li class="side-nav-item"><a href="{{url('/categories')}}"><span class="bi bi-circle"></span>Categorías</a></li>
                <li class="side-nav-item"><a href="{{url('/contacts_page/1')}}"><span class="bi bi-circle"></span>Clientes</a></li>
                <li class="side-nav-item"><a href="{{url('/contacts_page/2')}}"><span class="bi bi-circle"></span>Proveedores</a></li>
                <li class="side-nav-item"><a href="{{url('/orders/')}}"><span class="bi bi-circle"></span>Pedidos a Proveedor</a></li>
                <li class="side-nav-item"><a href="{{url('/config/')}}"><span class="bi bi-circle"></span>Configuración</a></li>
                <button class="btn btn-danger mt-4">Nueva Cotización</button>
                <button class="btn btn-danger mt-1">Nuevo Cliente</button>
            </ul>
        </nav>
    </div>
	 <div class="main">
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
    <script src="{{asset('js/app.js')}}"></script>
    <script src="{{asset('js/toaster.js')}}"></script>
</body>
</html>