<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" id="csrf">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/toaster.css')}}">
    <link rel="stylesheet" href="{{asset('css/icons/themify-icons.css')}}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <title>Document</title>
</head>
<body>
    <div id="header">
        <div class="container">
            <div class="row">
                <div class="col-md-6 logo">
                    <p class="m-0 d-flex align-items-center"><span class="ti-mouse-alt mr-3"></span><a href="/home">Connexion</a></p>
                </div>
                <div class="col-md-6 notify d-flex align-items-center justify-content-end">
                    <a href="#log"><span class="ti-bell"></span></a>
                    <a href="#log" data-bs-toggle="collapse">{{Auth::user()->name;}}</a>
                </div>
            </div>
        </div>
    </div>
    <div class="login collapse" id="log">
        <ul class="m-0 p-0">
            <li>
                <a href=""><span class="ti-settings"></span>Configuración</a>
            </li>
            <li>
                <a href="{{ route('logout') }}"  onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="ti-key"></i> Log Out</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
            </li>
        </ul>
    </div>
	<div id="app">
		<menu-component user={{Auth::user()->name}}></menu-component>
    	<div id="body" class="mt-4">
    		@yield('content')
    	</div>
	</div>
    <div class="mt-5"></div>
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