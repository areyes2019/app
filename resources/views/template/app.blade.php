<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sello Pronto</title>
    <!-- css del menu lateral -->
    <link rel="stylesheet" href="{{asset('css/verticalmenu.css')}}">
    <!-- vue -->
    <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
    <!-- Jquery-->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <!-- Bootstrap js-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!-- Boostrap css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Datatables css-->
    <link href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <!-- Datatables js-->
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <!-- Datatables Bootstrap js-->
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <!-- Bootstrap icons-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <!-- Axios ajax -->
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <link rel="stylesheet" href="{{asset('css/dashboard.css')}}">
    <!-- select -->
    <script src="https://unpkg.com/vue-select@latest"></script>
    <link rel="stylesheet" href="https://unpkg.com/vue-select@latest/dist/vue-select.css">
</head>
<body class="body">
    <div class="menu">
        <ion-icon name="menu-outline"></ion-icon>
        <ion-icon name="close-outline"></ion-icon>
    </div>

    <div class="barra-lateral">
        <div id="main">
            <div class="nombre-pagina">
                <a href="{{url('/admin')}}">
                    <img src="{{asset('img/logoweb.png')}}" alt="" width="220">
                </a>
            </div>
            <a href="{{route('quotations_new',1)}}" class="boton">
                <i class="bi bi-plus-circle"></i>
                <span>Venta</span>
            </a>
        </div>

        <nav class="navegacion">
            <ul class="m-0 p-0">
                <li>
                    <a href="{{url('/quotations')}}">
                        <i class="bi bi-file-earmark-bar-graph"></i>
                        <span>Cotizaciones</span>
                    </a>
                </li>
                <li>
                    <a href="{{url('/articles')}}">
                        <i class="bi bi-box"></i>
                        <span>Artículos</span>
                    </a>
                </li>
                <li>
                    <a href="{{url('/contacts_page')}}">
                        <i class="bi bi-people"></i>
                        <span>Contactos</span>
                    </a>
                </li>
                <li>
                    <a href="{{url('/stock')}}">
                        <i class="bi bi-graph-up-arrow"></i>
                        <span>Inventario</span>
                    </a>
                </li>
                <li>
                    <a href="{{url('/sale')}}">
                        <i class="bi bi-credit-card"></i>
                        <span>Ventas</span>
                    </a>
                </li>
            </ul>
        </nav>

        <div>
            <div class="linea"></div>

            <div class="modo-oscuro">
                <div class="info">
                    <ion-icon name="moon-outline"></ion-icon>
                    <span>Drak Mode</span>
                </div>
                <div class="switch">
                    <div class="base">
                        <div class="circulo">
                            
                        </div>
                    </div>
                </div>
            </div>
    
            <div class="usuario">
                <div class="info-usuario">
                    <div class="nombre-email">
                        <span class="nombre">{{Auth::user()->name;}}</span>
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="link-dark">Salir</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>


    <main>
       @yield('content')
    </main>
    <script src="{{asset('js/html2canvas.js')}}"></script>
    <script src="{{asset('js/canvas2image.js')}}"></script>
    <script src="{{asset('js/script.js')}}"></script>
    <script src="{{asset('js/toaster.js')}}"></script>
</body>
</html>