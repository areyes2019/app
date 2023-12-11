@extends('template.app')
@section('content')
<div class="main-board" id="app">
    <div class="card mb-3 rounded-0 border-0">
        <div class="card-body">
            <h3 class="mt-3">Solicitud de Trabajo</h3>       
        </div>
    </div>
    <div class="card shadow mb-4 rounded-0">
    <!-- Card Header - Dropdown -->
        <div class="card-header rounded-0 d-flex justify-content-between align-items-center">
          <p class="m-0">Diseño 56</p>
          <button class="btn btn-outline-dark rounded btn-sm rounded-0">Enviar los diseños ya hechos</button>
        </div>
        <!-- Card Body -->
        <div class="card-body rounded-0">
            <table class="table table-bordered">
                <tr>
                    <th style="width: 20px;">Descripción</th>
                    <td>Sello de 59 x 23 mm</td>
                </tr>
                 <tr>
                    <th>Modelo</th>
                    <td>Printer C40</td>
                </tr>
                <tr>
                    <th>Cantidad</th>
                    <td>3</td>
                </tr>
                 <tr>
                    <th>Observaciones</th>
                    <td>Entrega para el martes</td>
                </tr>
                <tr>
                    <th>Diseño</th>
                    <td>
                        <img src="/designs/Artboard 12.png" alt="" width="300">
                        <img src="/designs/Artboard 12.png" alt="" width="300">
                        <img src="/designs/Artboard 12.png" alt="" width="300">
                    </td>
                </tr>
            </table>
             <table class="table table-bordered">
                <tr>
                    <th style="width: 20px;">Descripción</th>
                    <td>Sello de 59 x 23 mm</td>
                </tr>
                 <tr>
                    <th>Modelo</th>
                    <td>Printer C30</td>
                </tr>
                <tr>
                    <th>Cantidad</th>
                    <td>1</td>
                </tr>
                 <tr>
                    <th>Observaciones</th>
                    <td>Entrega para el martes</td>
                </tr>
                <tr>
                    <th>Diseño</th>
                    <td>
                        <img src="/designs/Artboard 12.png" alt="" width="300">
                    </td>
                </tr>
            </table>        
        </div>
    </div>
</div>
<script src="{{asset('js/modules/quotations.js')}}"></script>
@endsection