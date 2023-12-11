@extends('template.app')
<?php use App\Models\AddArt;?>
@section('content')
<div class="main-board" id="app">
    <div class="card mb-3 rounded-0 border-0">
        <div class="card-body">
            <h3 class="mt-3">Solicitud de Diseños</h3>       
        </div>
    </div>
    <div class="card shadow mb-4 rounded-0">
    <!-- Card Header - Dropdown -->
        <div class="card-header rounded-0 d-flex justify-content-between align-items-center">                
            @foreach ($data['pedido'] as $number)
            <p class="m-0">Order No {{$number->idOrder}}</p>
            <button class="btn btn-outline-dark rounded btn-sm rounded-0">Enviar los diseños ya hechos</button>
            @endforeach
        </div>
        <!-- Card Body -->
        @foreach ($data['detalle'] as $row)
        <div class="card-body rounded-0">
            <table class="table table-bordered">
                <tr>
                    <th style="width: 20px;">Descripción</th>
                    <td>{{$row->name}}</td>
                </tr>
                 <tr>
                    <th>Modelo</th>
                    <td>{{$row->model}}</td>
                </tr>
                <tr>
                    <th>Cantidad</th>
                    <td>{{$row->quantity}}</td>
                </tr>
                 <tr>
                    <th>Observaciones</th>
                    <td>{{$row->notes}}</td>
                </tr>
                <tr>
                    <th>Diseño</th>
                    <?php $query = AddArt::where('idLine', $row->idDetail_order)->get()?>
                    <td>
                        @foreach ($query as $img)
                        <img src="{{asset('/designs/'.$img->url)}}" alt="" width="400">
                        @endforeach
                    </td>
                </tr>
            </table>     
        </div>
        @endforeach
    </div>
</div>
<script src="{{asset('js/modules/quotations.js')}}"></script>
@endsection