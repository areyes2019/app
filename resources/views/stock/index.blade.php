@extends('template.app')
@section('content')
<div class="container-fluid" id="stock">
		<h3>Inventario</h3>
		<div class="row">
			<div class="col-md-4">
				<div class="card">
		            <div class="card-body">
		                <h5 class="card-title text-dark">Valor Total</h5>
		                <h6 class="card-subtitle mb-2 text-muted">Valor bruto del inventario</h6>
		                <h4>$@{{total_value}}</h4>
		                <a href="#" class="card-link">Ir a resumen</a>
		            </div>
		        </div>
			</div>
			<div class="col-md-4">
				<div class="card">
		            <div class="card-body">
		                <h5 class="card-title text-dark">Valor Beneficio</h5>
		                <h6 class="card-subtitle mb-2 text-muted">Valos de las utilidades del inventario</h6>
		                <h4>$@{{profit}}</h4>
		                <a href="#" class="card-link">Ir a resumen</a>
		            </div>
		        </div>
			</div>
			<div class="col-md-4">
				<div class="card">
		            <div class="card-body">
		                <h5 class="card-title text-dark">Valor invertido</h5>
		                <h6 class="card-subtitle mb-2 text-muted">Valor de productos en iventario</h6>
		                <h4>$@{{investment}}</h4>
		                <a href="#" class="card-link">Ir a resumen</a>
		            </div>
		        </div>
			</div>
		</div>
		
		<div class="card mt-4 mb-2 rounded-0">
			<div class="card-header p-4">
				<!-- <select id="article" class="form-control rounded-0" v-model="article">
				  <option value=""></option>
				  <option value="JAL">Jalisco</option>
				  <option value="COL">Colima</option>
				  <option value="GTO">Guanajuato</option>		  
				</select>
				<div class="for-group">
					<label for="">Cantidad</label>
					<input type="number" class="form-control shadow-none rounded-0" min="1" v-model="quantity">
				</div>-->
				
				<button class="btn mt-md-3 rounded-0 btn-outline-dark" data-bs-toggle="modal" data-bs-target="#addArticle">Agregar Artículos</button>
				<button class="btn mt-md-3 rounded-0 btn-outline-dark" data-bs-toggle="modal" data-bs-target="#addOrder">Agregar Orden de Compra</button>
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
						<td>$@{{list.cost * list.quantity}}</td>
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
		<!-- modal Artículos-->
		<div class="modal fade" id="addArticle" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
			<div class="modal-dialog modal-dialog-scrollable modal-lg">
				<div class="modal-content rounded-0">
					<div class="modal-header bg-dark rounded-0 text-white">
						<h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
	        			<button type="button" class="btn-close btn-light bg-light" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<table class="table table-responsive" id="articles">
							<thead>
								<tr>
									<th>Nombre</th>
									<th>Modelo</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								<tr v-for="article in result">
									<td>@{{article.name}}</td>
									<td>@{{article.model}}</td>
									<td class="d-flex justify-content-end"><button class="btn btn-outline-dark" @click="update_stock(article.idArticle)"><span class="bi bi-plus-circle"></span></button></td>
								</tr>
							</tbody>
						</table>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-outline-dark rounded-0 d-flex float-right" data-bs-dismiss="modal">Listo</button>
					</div>
				</div>
			</div>
		</div>
		<!-- modal articulos -->

		<!-- modal agregar orden de compra -->
		<div class="modal fade" id="addOrder" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
			<div class="modal-dialog modal-dialog-scrollable modal-lg">
				<div class="modal-content rounded-0">
					<div class="modal-header bg-dark rounded-0 text-white">
						<h5 class="modal-title" id="exampleModalLabel">Agregar Orden de Compra</h5>
	        			<button type="button" class="btn-close btn-light bg-light" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<table class="table table-responsive" id="articles">
							<thead>
								<tr>
									<th>Nombre</th>
									<th>Modelo</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								<tr v-for="article in result">
									<td>@{{article.name}}</td>
									<td>@{{article.model}}</td>
									<td class="d-flex justify-content-end"><button class="btn btn-outline-dark" @click="update_stock(article.idArticle)"><span class="bi bi-plus-circle"></span></button></td>
								</tr>
							</tbody>
						</table>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-outline-dark rounded-0 d-flex float-right" data-bs-dismiss="modal">Listo</button>
					</div>
				</div>
			</div>
		</div>
		<!-- modal orden de compra -->
	</div>
<script src="{{asset('js/modules/stock.js')}}"></script>
@endsection