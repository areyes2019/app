@extends('template.app')
<?php use App\Models\AddArt;?>
@section('content')
<div class="main-board" id="production">
    <div class="card mb-3 rounded-0 border-0">
        <div class="card-body">
            <h3 class="mt-3">Solicitud de Diseños</h3>       
        </div>
    </div>
    <div class="card shadow mb-4 rounded-0">
    <!-- Card Header - Dropdown -->
        <div class="card-header rounded-0 d-flex justify-content-between align-items-center">                
            @foreach ($data['pedido'] as $number)
            <p class="m-0">Order No <span ref="id">{{$number->idOrder}}</span></p>
            <p class="d-none" ref="slug">{{$number->slug}}</p>
            <button class="btn btn-outline-dark rounded btn-sm rounded-0" data-bs-toggle="modal" data-bs-target="#to_production">Enviar los diseños ya hechos</button>
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
    <div class="card shadow rounded-0 mt-1">
        <div class="card-body" v-for="art in img">
            <a :href="'/orders/'+art.art_img" target="blank"><span class="bi bi-file-pdf"></span> @{{art.art_img}}</a>
        </div>
    </div>
    <!-- modal producción-->
    <div class="modal fade" id="to_production" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content rounded-0">
                <div class="modal-header bg-dark rounded-0 text-white">
                    Subir los diseños terminados
                </div>
                <div class="modal-body">
                    <form @submit.prevent="saveImg()" enctype="mulipart/form-data">
                        <input type="file" name="" ref="inputFile"  @change="getImage" id="file">
                        <p class="mt-2">Asegurate de que el archivo sea PDF totalmente a curvas</p>
                        <div class="d-flex justify-content-end">
                            <button class="btn btn-outline-dark btn-sm rounded-0 shadow-none mt-2" type="submit" id="button-addon2"><span class="bi bi-send"></span> Enviar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- modal producción -->
</div>
<script src="{{asset('js/modules/production.js')}}"></script>
@endsection