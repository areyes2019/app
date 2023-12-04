<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sidebar</title>
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
</head>
<body class="body">
    <div class="menu">
        <ion-icon name="menu-outline"></ion-icon>
        <ion-icon name="close-outline"></ion-icon>
    </div>

    <div class="barra-lateral">
        <div>
            <div class="nombre-pagina">
                <img src="{{asset('img/logoweb.png')}}" alt="" width="220">
            </div>
            <button class="boton">
                <ion-icon name="add-outline"></ion-icon>
                <span>Create new</span>
            </button>
        </div>

        <nav class="navegacion">
            <ul class="m-0 p-0">
                <li>
                    <a href="{{url('/quotations')}}">
                        <ion-icon name="document-outline"></ion-icon>
                        <span>Cotizaciones</span>
                    </a>
                </li>
                <li>
                    <a href="{{url('/articles')}}">
                        <ion-icon name="cube-outline"></ion-icon>
                        <span>Artículos</span>
                    </a>
                </li>
                <li>
                    <a href="{{url('/contacts_page')}}">
                        <ion-icon name="people"></ion-icon>
                        <span>Contactos</span>
                    </a>
                </li>
                <li>
                    <a href="{{url('/stock')}}">
                        <ion-icon name="trending-up-outline"></ion-icon>
                        <span>Inventario</span>
                    </a>
                </li>
                <li>
                    <a href="{{url('/sale')}}">
                        <ion-icon name="card"></ion-icon>
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
                        <span class="nombre">Jhampier</span>
                        <span class="email">jhampier@gmail.com</span>
                    </div>
                    <ion-icon name="ellipsis-vertical-outline"></ion-icon>
                </div>
            </div>
        </div>

    </div>


    <main id="app">
        <div class="row">
            <div class="col-md-3">
                <div class="card rounded-0 border-0">
                    <div class="card-body">
                        <p class="m-0">Ventas de la semana</p>
                        <h4>$2500.00</h4>
                        <p>3% mas que la semana pasada</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card rounded-0 border-0">
                    <div class="card-body">
                        <p class="m-0">Total de inventario</p>
                        <h4>$8500.00</h4>
                        <p>3% mas que la semana pasada</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card rounded-0 border-0">
                    <div class="card-body">
                        <p class="m-0">Margen Neto</p>
                        <h4>$350.00</h4>
                        <p>3% mas que la semana pasada</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card rounded-0 border-0">
                    <div class="card-body">
                        <p class="m-0">Total de Gastos</p>
                        <h4>$350.00</h4>
                        <p>3% mas que la semana pasada</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mt-4 border-0 rounded-0">
            <div class="card-body">
                <h4>Panel de Control</h4>
            </div>
        </div>
        <div class="card mt-4 border-0 rounded-0">
            <div class="card-body">
                <table class="table table-responsive" id="example">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Artículo</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>2</td>
                            <td>Sello de 59 x 23 mm</td>
                            <td>Llano de Albama 555</td>
                            <td>Enviada</td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Sello de 59 x 23 mm</td>
                            <td>Llano de alborada 555</td>
                            <td>Enviada</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="{{asset('js/script.js')}}"></script>
</body>
</html>