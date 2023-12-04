@extends('template.app')
@section('content')
<div class="main-board" id="app">
	<div class="card mb-3 rounded-0 border-0">
		<div class="card-body">
			<h3 class="mt-3">Cotizaciones</h3>       
		</div>
	</div>
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow mb-4 rounded-0">
                <!-- Card Header - Dropdown -->
                    <div class="card-header rounded-0 ">
                      <!-- cotizar a cliente -->
                      <a class="btn rounded-0 btn-danger btn-sm" href="#" @click.prevent="makeQt">
                        <span class="icon-file-plus icon-my text-white"></span> Nueva Cotización
                      </a>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body rounded-0">
                        <table class="table table-bordered" id="mytable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>fecha</th>
                                    <th>empresa</th>
                                    <th>Contacto</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="data in general_data">
                                    <td>@{{data.idQt}}</td>
                                    <td>@{{data.created_at}}</td>
                                    <td>@{{data.company}}</td>
                                    <td>@{{data.name}}</td>
                                    <td>
                                       <button class="btn btn-danger rounded-0 btn-sm" @click="toQuotation(data.slug)">Ver</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Cotizar a cliente-->
        <div class="modal fade " id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content rounded-0">
              <div class="modal-header rounded-0 bg-color">
                <h5 class="modal-title" id="staticBackdropLabel">Seleccionar Cliente</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <table class="table table-bordered" id="cliente">
                    <thead>
                        <tr>
                            <th>Empresa</th>
                            <th>Contacto</th>
                            <th>Con Fact.</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="data in customers_data">
                            <td v-text="data.company"></td> 
                            <td v-text="data.name"></td>
                            <td>
                              <label class="switch">
                                <input type="checkbox"  @click="tax = !tax" :id="data.idContact">
                                <span class="slider"></span>
                              </label>
                            </td> 
                            <td class="d-flex justify-content-end">
                              <button class="btn btn-danger btn-sm rounded-0" @click="makeQt(data.idContact)"><span class="bi bi-check-square"></span></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
              </div>
              
            </div>
          </div>
        </div>
</div>
<script src="{{asset('js/modules/quotations.js')}}"></script>
<quotations-component></quotations-component>
@endsection