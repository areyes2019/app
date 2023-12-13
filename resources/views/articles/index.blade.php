@extends('template.app')
@section('content')
<div id="app">
	<div class="container" id="app">
		<div class="card-box-std p-3">
			<div class="row">
				<div class="col-md-7">
					<div class="card-box-left">
						<div class="dropdown">
						  <button class="btn btn-danger btn-sm dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
						    Dropdown button
						  </button>
						  <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
						    <li><a class="dropdown-item" href="#">Descargar Excel</a></li>
						    <li><a class="dropdown-item" href="#">Descargar PDF</a></li>
						  </ul>
						</div>
					</div>
				</div>
				<div class="col-md-5">
					<div class="card-box-right">
						<label for="">Importar Excel</label>
						<input type="file" accept=".xlsx, .xls, .csv" @change="getExl" required ref="inputFile">
						<button class="btn btn-danger btn-sm" @click="importExl()"><span class="bi bi-upload"></span></button>
					</div>
				</div>
			</div>
		</div>
		<div class="card rounded-0">
			<div class="card-header rounded-0">
				<button class="btn btn-outline-dark rounded-0" @click.prevent="add_article"><span class="bi bi-box"></span> Agregar artículo</button>
			</div>
			<div class="card-body">
				<table class="table table-bordered" id="articles_table">
					<thead>
						<tr>
							<th>#</th>
							<th>Img</th> <!-- aki va la imagen -->
							<th>Nombre</th>
							<th>Mod.</th>
							<th>Precio</th>
							<th>Sck Mín</th>
							<th>Dest.</th>
							<th>Acciones</th>
						</tr>
					</thead>
					<tbody>
						<tr v-for="article in table">
							<td>@{{article.idArticle}}</td>
							<td>
								<a href=""><img :src="'storage/cataloge/'+article.img_url" alt="" width="40"></a>
							</td>
							<td>@{{article.name}}</td>
							<td>@{{article.model}}</td>
							<td class="bg-secondary text-white font-weight-bold">$@{{article.price}}</td>
							<td align="center">
								<input type="number" value="0" min="0" style="width: 45px">
							</td>
							<td>
								<input type="checkbox" v-model="article.popular" @click="change_popular(article.idArticle)">
							</td>
							<td>
								<!-- Editar articulos -->
								<a href="#" @click.prevent="showUpdateModal(article.idArticle)"><span class="bi bi-pencil-square"></span></a>
								<!-- Editar articulos -->

								<!-- eliminar -->
								<a href="#" @click.prevent="deleteData(article.idArticle)"><span class="bi bi-trash"></span></a>
								<!-- eliminar -->

								<!-- Agregar imagen-->
								<a href="#" @click.prevent="addImage(article.idArticle)"><span class="bi bi-camera"></span></a>
								<!-- Agregar imagen-->
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		<!-- modal agregar artículo-->
		<div class="modal fade" id="add_article" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
			<div class="modal-dialog modal-dialog-scrollable">
		    	<div class="modal-content rounded-0">
		      		<div class="modal-header rounded-0 bg-color">
		        		<h5 class="modal-title" id="staticBackdropLabel">Nuevo Artículo</h5>
		        		<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		      		</div>
			      	<div class="modal-body">
			      		<div class="form-group">
							<input type="text" v-model="data.name" class="form-control rounded-0 shadow-none" placeholder="Nombre del Sello">
							<small class="text-danger m-0 p-0">@{{errors.name}}</small>
						</div>
						<div class="form-group mt-3">
							<input type="text" v-model="data.model" class="form-control rounded-0 shadow-none" placeholder="Modelo">
						</div>
						<div class="form-group mt-3">
							<input type="text" v-model="data.cost" class="form-control rounded-0 shadow-none" placeholder="Precio Proveedor">
							<small class="text-danger">@{{errors.cost}}</small>
						</div>
						<div class="form-group mt-3">
							<input type="text" v-model="data.price" class="form-control rounded-0 shadow-none" placeholder="Precio Público">
							<small class="text-danger m-0">@{{errors.price}}</small><br>
							<small class="text-danger m-0">@{{errors.price_decimal}}</small>
						</div>					 		
			      	</div>
				    <div class="modal-footer">
				        <button type="button" class="btn my-btn-secondary" data-bs-dismiss="modal">Cerrar</button>
				        <button type="button" class="btn my-btn" @click="save_data()">Guardar</button>
				    </div>
		    	</div>
		  	</div>
		</div>

		<!-- modal modificar artículo -->
		<div class="modal fade" id="edit_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
			<div class="modal-dialog modal-dialog-scrollable">
		    	<div class="modal-content rounded-0" v-for="item in update">
		      		<div class="modal-header rounded-0 bg-color">
		        		<h5 class="modal-title" id="staticBackdropLabel">Edita Articulo</h5>
		        		<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		      		</div>
			      	<div class="modal-body">
			      		<div class="form-group">
			      			<!-- Nombre del sello-->
			      			<label for="">Nombre del Sello</label>
							<input type="text" v-model="item.name" class="form-control rounded-0 shadow-none" placeholder="Nombre del Sello">
							<small class="text-danger m-0 p-0">@{{errors.name}}</small>
						</div>
						<div class="form-group mt-3">
			      			<!-- Modelo -->
			      			<label for="">Modelo</label>
							<input type="text" v-model="item.model" class="form-control rounded-0 shadow-none" placeholder="Modelo">
						</div>
						<div class="form-group mt-3">
			      			<!-- Precio proveedor -->
			      			<label for="">Precio proveedor</label>
							<input type="text" v-model="item.cost" class="form-control rounded-0 shadow-none" placeholder="Precio Proveedor">
							<small class="text-danger">@{{errors.cost}}</small>
						</div>
						<div class="form-group mt-3">
			      			<!-- Precio de la goma -->
			      			<label for="">Precio de la goma</label>
							<input type="text" v-model="item.rubber" class="form-control rounded-0 shadow-none" placeholder="Precio Goma">
							<small class="text-danger">@{{errors.cost}}</small>
						</div>
						<div class="form-group mt-3">
			      			<!-- Precio diseño -->
			      			<label for="">Precio del Diseño</label>
							<input type="text" v-model="item.design" class="form-control rounded-0 shadow-none" placeholder="Precio Diseño">
							<small class="text-danger">@{{errors.cost}}</small>
						</div>
						<div class="form-group mt-3">
			      			<!-- Precio de goma -->
			      			<label for="">Precio Público</label>
							<input type="text" v-model="item.price" class="form-control rounded-0 shadow-none" placeholder="Precio Público">
							<small class="text-danger m-0">@{{errors.price}}</small><br>
							<small class="text-danger m-0">@{{errors.price_decimal}}</small>
						</div>					 		
			      	</div>
				    <div class="modal-footer">
				        <button type="button" class="btn btn-outline-dark rounded-0" @click="updateData(item.idArticle)">Guardar</button>
				        <button type="button" class="btn my-btn-secondary" data-bs-dismiss="modal">Cerrar</button>
				    </div>
		    	</div>
		  	</div>
		</div>
		<!-- modal modificar artículo -->

		<!-- errores de validacion -->
		<div class="modal fade" id="modal_warning" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
		  <div class="modal-dialog modal-dialog-scrollable">
		    <div class="modal-content rounded-0">
		      	<div class="modal-body">
		      		<div class="alert alert-warning" role="alert">
					  Tu importación tiene errores, por favor revisa tu archivo
					</div>
					<ul v-for="error in errors">
						<li><p>@{{error}}</p></li>
					</ul>
		      	</div>
		      <div class="modal-footer">
		        <button type="button" class="btn my-btn-secondary-sm" data-bs-dismiss="modal"><span class="bi bi-x-octagon"></span> Cerrar</button>
		      </div>
		    </div>
		  </div>
		</div>
		<!-- modal imagen -->
		<div class="modal fade" id="modal_image" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
		  <div class="modal-dialog modal-dialog-scrollable">
		    <div class="modal-content rounded-0">
		      	<div class="modal-body">
		      		<h3>Agregar imagen del producto</h3>
		      		<form @submit.prevent="saveImg" enctype="mulipart/form-data" class="d-flex justify-content-between align-items-center">
		      			<input type="file" name="" @change="getImage" id="file">
		      			<button type="submit" class="btn btn-outline-dark rounded-0 mt-2">Guardar</button>
		      		</form>
		      	</div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-outline-dark rounded-0" data-bs-dismiss="modal"><span class="bi bi-x-octagon"></span> Cerrar</button>
		      </div>
		    </div>
		  </div>
		</div>
	</div>
</div>
<script type="text/javascript" src="{{asset('js/modules/articles.js')}}"></script>
@endsection