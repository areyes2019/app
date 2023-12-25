@extends('template.app')
@section('content')
<div class="container-fluid" id="stock">
		<h3>Inventario</h3>
		<!-- <div class="row">
			<div class="col-md-4">
				<div class="card">
		            <div class="card-body">
		                <h5 class="card-title">Valor Total</h5>
		                <h6 class="card-subtitle mb-2 text-muted">Valor bruto del inventario</h6>
		                <h4>$@{{total_value}}</h4>
		                <a href="#" class="card-link">Ir a resumen</a>
		            </div>
		        </div>
			</div>
			<div class="col-md-4">
				<div class="card">
		            <div class="card-body">
		                <h5 class="card-title">Valor Beneficio</h5>
		                <h6 class="card-subtitle mb-2 text-muted">Valos de las utilidades del inventario</h6>
		                <h4>$@{{profit}}</h4>
		                <a href="#" class="card-link">Ir a resumen</a>
		            </div>
		        </div>
			</div>
			<div class="col-md-4">
				<div class="card">
		            <div class="card-body">
		                <h5 class="card-title">Valor invertido</h5>
		                <h6 class="card-subtitle mb-2 text-muted">Valor de productos en iventario</h6>
		                <h4>$@{{investment}}</h4>
		                <a href="#" class="card-link">Ir a resumen</a>
		            </div>
		        </div>
			</div>
		</div>-->
		
		<div class="card mt-4 mb-2 rounded-0">
			<div class="card-header">
				<div class="row">
					<div class="col-md-12">
						<select id="article" class="form-control rounded-0">
						  <option value=""></option>
						  <option value="SON">Sonora</option>
						  <option value="JAL">Jalisco</option>
						  <option value="NL">Nuevo Leon</option>
						  <option value="COL">Colima</option>
						  <option value="AGS">Aguascalientes</option>
						</select>
					</div>
					<div class="col-md-12">
						<label for="">Cantidad</label>
						<input type="number" class="form-control shadow-none rounded-0" min="1" v-model="quantity">
					</div>
					<div class="col-md-12">
						<button class="btn btn-danger mt-md-3" @click="update_stock">Guardar</button>
					</div>
				</div>
			</div>
			<div class="card-body">
				<h3 class="mt-4">Lista de existencias</h3>
				<table class="table table-bordered mt-1">
					<tr>
						<th>Cant</th>
						<th>Artículo</th>
						<th>Modelo</th>
						<th>P/U</th>
						<th>Total</th>
						<th></th>
						<th></th>
					</tr>
					<tr v-for = "list in data">
						<td>@{{list.quantity}}</td>
						<td>@{{list.name}}</td>
						<td>@{{list.model}}</td>
						<td>$@{{list.cost}}</td>
						<td class="d-none">@{{sum = list.cost * list.quantity}}</td>
						<td>$@{{res = sum.toFixed(2)}}</td>
						<td class="d-flex justify-content-end">
							<a href="" @click.prevent="delete_line(list.idStock)"><span class="bi bi-trash"></span></a>
							<div class="dropdown">
		                      <a href="#" class="nav-link my-link-nav" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false"><span class="bi bi-arrow-bar-down"></span></a>

		                      <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
	                            <div class="d-flex justify-content-between p-2">
	                                <input type="number" ref="money" v-model="take" width="10" min="1" style="width:55px">
	                                <a class="btn btn-danger btn-sm rounded-0 " @click.prevent="take_out(list.idStock)"><span class="bi bi-check2-square"></span></a>
	                            </div>
		                      </div>
                    		</div>
                    		<!-- Para aumener el inventario -->
                    		<div class="dropdown">
		                      <a href="#" class="nav-link my-link-nav" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false"><span class="bi bi-arrow-bar-up"></span></a>

		                      <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
	                            <div class="d-flex justify-content-between p-2">
	                                <input type="number" ref="money" v-model="up" width="10" min="1" style="width:55px">
	                                <a class="btn btn-danger btn-sm rounded-0 " @click.prevent="take_up(list.idStock)"><span class="bi bi-check2-square"></span></a>
	                            </div>
		                      </div>
                    		</div>
						</td>
					</tr>
				</table>
			</div>
		</div>
	</div>
<script src="{{asset('js/modules/stock.js')}}"></script>
@endsection