@extends('template.app')
@section('content')
<div class="main-board" id="app">
<div class="row">
    <div class="col-md-3">
        <div class="card rounded-0">
            <div class="card-body">
                <h5 class="card-title">Ventas Totales</h5>
                <h6 class="card-subtitle mb-2 text-muted">{{$month}} {{$year}}</h6>
                <h4>${{$sales}}</h4>
                <a href="#" class="card-link">Ir a resumen</a>
            </div>
        </div>
    </div>
    <div class="col-md-3 rounded-0">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Utilidades netas</h5>
                <h6 class="card-subtitle mb-2 text-muted">{{$month}} {{$year}}</h6>
                <h4>${{$profit}}</h4>
                <a href="#" class="card-link">Ir a resumen</a>
            </div>
        </div>
    </div>
    <div class="col-md-3 rounded-0">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Piezas vendidas</h5>
                <h6 class="card-subtitle mb-2 text-muted">{{$month}} {{$year}}</h6>
                <h4>{{$sold}}</h4>
                <a href="#" class="card-link">Another link</a>
            </div>
        </div>
    </div>
    <div class="col-md-3 rounded-0">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Total de Gastos</h5>
                <h6 class="card-subtitle mb-2 text-muted">{{$month}} {{$year}}</h6>
                <h4>${{$spent}}</h4>
                <a href="#" class="card-link">Another link</a>
            </div>
        </div>
    </div>
</div>
<div class="card mt-3 rounded-0">
    <div class="card-body">
        <h3>Pedidos</h3>
    </div>
</div>
<div class="row">
    <div class="col-3">
        <div class="card mt-2 rounded-0">
            <div class="card-header">
                Pedidos entrantes
            </div>
            <div class="card-body">
                <ul class="list-group">
                  <li class="list-group-item">
                    <div class="d-flex justify-content-between">
                        <p class="m-0">Pedido No <span class="text-primary"> <a href="">256</a> </span></p>
                        <div class="dropdown">
                          <a  href="#" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-three-dots-vertical"></i>
                          </a>

                          <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <li><a class="dropdown-item" href="#">A diseño</a></li>
                            <li><a class="dropdown-item" href="#">A Producción</a></li>
                            <li><a class="dropdown-item" href="#">A Envio</a></li>
                          </ul>
                        </div>
                    </div>
                    <p class="m-0"><strong>Maria Helan Rojo</strong></p>
                    <span class="badge bg-primary">En Diseño</span>
                  </li>
                 
                </ul>
            </div>
        </div>
    </div>
    <div class="col-3">
        <div class="card mt-2 rounded-0">
            <div class="card-header">
                En diseño
            </div>
            <div class="card-body">
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime cumque voluptates distinctio accusantium non voluptate minus incidunt culpa dolore nemo, dolores ea nobis temporibus ad consequatur sed itaque? Illo, quaerat.</p>
            </div>
        </div>
    </div>
    <div class="col-3">
        <div class="card mt-2 rounded-0">
            <div class="card-header">
                En Producción
            </div>
            <div class="card-body">
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime cumque voluptates distinctio accusantium non voluptate minus incidunt culpa dolore nemo, dolores ea nobis temporibus ad consequatur sed itaque? Illo, quaerat.</p>
            </div>
        </div>
    </div>
    <div class="col-3">
        <div class="card mt-2 rounded-0">
            <div class="card-header">
                Para Entrega
            </div>
            <div class="card-body">
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime cumque voluptates distinctio accusantium non voluptate minus incidunt culpa dolore nemo, dolores ea nobis temporibus ad consequatur sed itaque? Illo, quaerat.</p>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="designs" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Diseños</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        
      </div>
    </div>
  </div>
</div>
</div>
<script src="{{asset('js/modules/dashboard.js')}}"></script>
@endsection