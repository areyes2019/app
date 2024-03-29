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
<div class="card mt-2 rounded-0">
    <div class="card-body">
        <!-- Botones de las pestañas-->      
        <ul class="nav nav-tabs mt-3" id="myTab" role="tablist">
            <!-- Boton pestaña entratnes -->
            <li class="nav-item" role="presentation">
                <button class="nav-link active rounded-0" id="home-tab" data-bs-toggle="tab" data-bs-target="#entrance" type="button" role="tab" aria-controls="home" aria-selected="true">Entrantes</button>
            </li>
            <!-- Boton pestaña entratnes -->

            <!-- Boton pestaña en diseño -->
            <li class="nav-item" role="presentation">
                <button class="nav-link rounded-0" id="profile-tab" data-bs-toggle="tab" data-bs-target="#design" type="button" role="tab" aria-controls="profile" aria-selected="false">En Diseño</button>
            </li>
            <!-- Boton pestaña en diseño -->

            <!-- Boton pestaña en produccion -->
            <li class="nav-item" role="presentation">
                <button class="nav-link rounded-0" id="contact-tab" data-bs-toggle="tab" data-bs-target="#proces" type="button" role="tab" aria-controls="contact" aria-selected="false">En Producción</button>
            </li>
            <!-- Boton pestaña en produccion -->

            <!-- Boton pestaña para entregar -->
            <li class="nav-item" role="presentation">
                <button class="nav-link rounded-0" id="contact-tab" data-bs-toggle="tab" data-bs-target="#delivery" type="button" role="tab" aria-controls="contact" aria-selected="false">Para entregar</button>
            </li>
            <!-- Boton pestaña para entregar -->
        </ul>
        <!-- Botones de las pestañas-->

        <div class="tab-content p-2" id="myTabContent">
            <!-- pestaña de trabajos entrantes -->      
            <div class="tab-pane fade show active" id="entrance" role="tabpanel" aria-labelledby="home-tab">
                <table class="table table-bordered" id="entrada">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>WhatsApp</th>
                            <th>Nombre</th>
                            <th>Arte</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="sales in entrance">
                            <td>@{{sales.idOrder}}</td>
                            <td>@{{sales.mobile}}</td>
                            <td>@{{sales.name}}</td>
                            <td>
                                <img src="{{asset('img/big.png')}}" alt="" width="40">
                            </td>
                            <td align="right" width="25%">
                                <button class="btn btn-outline-dark rounded-0 shadow-none"  @click="goToOrder(sales.slug)">Ver</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
            <!-- pestaña de trabajos en diseño  -->      
            <div class="tab-pane fade" id="design" role="tabpanel" aria-labelledby="profile-tab">
                <table class="table table-bordered" id="art">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>WhatsApp</th>
                            <th>Nombre</th>
                            <th>Arte</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="sales in design">
                            <td>@{{sales.idOrder}}</td>
                            <td>@{{sales.mobile}}</td>
                            <td>@{{sales.name}}</td>
                            <td>
                                <a :href="'/design/'+sales.slug" click="view_art(sales.idOrder)">Ver OT</a>
                            </td>
                            <td align="right" width="25%">
                                <button class="btn btn-outline-dark rounded-0 shadow-none" @click="goToOrder(sales.slug)">Ver</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="tab-pane fade" id="proces" role="tabpanel" aria-labelledby="contact-tab">
                <table class="table table-bordered" id="proceso">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>WhatsApp</th>
                            <th>Nombre</th>
                            <th>Arte</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="sales in proces">
                            <td>@{{sales.idOrder}}</td>
                            <td>@{{sales.mobile}}</td>
                            <td>@{{sales.name}}</td>
                            <td>
                                <img src="{{asset('img/big.png')}}" alt="" width="40">
                            </td>
                            <td align="right" width="25%">
                                <button class="btn btn-outline-dark rounded-0 shadow-none" @click="goToOrder(sales.slug)"> Ver</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="tab-pane fade" id="delivery" role="tabpanel" aria-labelledby="contact-tab">
                <p>Delivery</p>
                <table class="table table-bordered" id="entrega">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>WhatsApp</th>
                            <th>Nombre</th>
                            <th>Datos de entrega</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="sales in delivery">
                            <td>@{{sales.idOrder}}</td>
                            <td>@{{sales.mobile}}</td>
                            <td>@{{sales.name}}</td>
                            <td>
                                <span class="badge bg-danger" v-if="sales.delivery_type == 1">Domicilio</span>
                                <span class="badge bg-success" v-else>Ocurre</span>
                            </td>
                            <td align="right" width="25%">         
                                <button class="btn btn-outline-dark rounded-0 shadow-none" @click="goToOrder(sales.slug)"> Ver</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
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