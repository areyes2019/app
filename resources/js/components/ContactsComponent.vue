<template>
	<div class="container">
		<div class="card-box-std p-3">
			<button class="btn btn-danger btn-sm" @click="open_modal()">Nuevo Proveedor</button>
		</div>
		<div class="card-box-std p-3 mt-3">
			<h3>Lista de proveedores</h3>
			<table class="table" id="contacts">
				<thead>
					<tr>
						<th>#</th>
						<th>Nombre</th>
						<th>Correo</th>
						<th>Telefono</th>
						<th>Mobil</th>
					</tr>
				</thead>
				<tbody>
					<tr v-for="item in data">
						<td>{{item.idContact}}</td>
						<td>{{item.name}}</td>
						<td>{{item.email}}</td>
						<td>{{item.phone}}</td>
						<td>{{item.mobile}}</td>
					</tr>
				</tbody>
			</table>
		</div>
		<!-- modal agregar proveedor -->
		<div class="modal fade" id="new" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
		  <div class="modal-dialog modal-dialog-scrollable">
		    <div class="modal-content rounded-0">
		      	<div class="modal-header rounded-0 bg-color">
		        	<h5 class="modal-title text-white" id="staticBackdropLabel">Modal title</h5>
		        	<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		      	</div>
		      	<div class="modal-body">
		      		<div class="my-form-group">
		      			<div class="input-layer">
							<span class="bi bi-pencil input-icon"></span>
							<input type="text" v-model="data.name" class="input-control" placeholder="Nombre del Sello">
		      			</div>
						<small class="text-danger m-0 p-0">{{errors.name}}</small>
					</div>
					<div class="my-form-group">
						<div class="input-layer">
							<span class="bi bi-pencil input-icon"></span>
							<input type="text" v-model="data.model" class="input-control" placeholder="Modelo">
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="my-form-group">
								<div class="input-layer">
									<span class="bi bi-pencil input-icon"></span>
									<input type="number" min="1" v-model="data.lines" class="input-control" placeholder="Líneas sugeridas">
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="my-form-group">
								<div class="input-layer">
									<span class="bi bi-pencil input-icon"></span>
									<input type="text" v-model="data.size" class="input-control" placeholder="Tamaño">
								</div>
							</div>
						</div>
					</div>
					<div class="my-form-group d-flex justify-content-between">
						<p class="m-0 p-0">¿Se agrega al stock?</p>
						<label class="switch">
						  <input type="checkbox" v-model="data.stock" :value="1">
						  <span class="slider"></span>
						</label>
					</div>
					<div class="my-form-group d-flex justify-content-between">
						<p class="m-0 p-0">Visible</p>
						<label class="switch">
						  <input type="checkbox" v-model="data.visible" :value="1">
						  <span class="slider"></span>
						</label>
					</div>					
					<div class="my-form-group">
						<div class="input-layer">
							<span class="bi bi-currency-exchange input-icon"></span>
							<input type="text" v-model="data.cost" class="input-control" placeholder="Precio Proveedor">
						</div>
						<small class="text-danger">{{errors.cost}}</small>
					</div>
					<div class="my-form-group">
						<div class="input-layer">
							<span class="bi bi-currency-exchange input-icon"></span>
							<input type="text" v-model="data.price" class="input-control" placeholder="Precio Público">
						</div>
						<small class="text-danger m-0">{{errors.price}}</small><br>
						<small class="text-danger m-0">{{errors.price_decimal}}</small>
					</div>
					<label for="">Asignar Proveedor</label>
					<div class="my-form-group">
						<div class="input-layer">
							<div class="input-layer">
								<span class="bi bi-people input-icon"></span>
								<select name="" id="" v-model="data.provider" class="input-control" @change="get_cataloge(data.provider)">
									<option :value="supplier.idContact" v-for="supplier in suppliers">{{supplier.name}}</option>
								</select>
							</div>
						</div>
						<small class="text-danger">{{errors.provider}}</small>
					</div>
					<label for="">Agregar Família</label>
					<div class="my-form-group">
						<div class="input-layer">
							<span class="bi bi-people input-icon"></span>
							<select name="" id="" v-model="data.family" class="input-control">
								<option :value="member.idFamily" v-for="member in family">{{member.family_name}}</option>
							</select>
						</div>
						<small class="m-0 p-0 text-danger">{{errors.family}}</small>
					</div>
					<label for="">Agregar Categoría</label>
					<div class="my-form-group">
						<div class="input-layer">
							<span class="bi bi-people input-icon"></span>
							<select name="" id="" v-model="data.categorie" class="input-control">
								<optgroup :label="parent.name" v-for="parent in parent_list">
									<option :value="child.idCategorie"  v-if="child.main == parent.idCategorie" v-for="child in child_list">{{child.name}}</option>
								</optgroup>
								<option :value="single.idCategorie" v-for="single in single_list" class="text-primary">{{single.name}}</option>
							</select>
						</div>
					</div>
					<label for="">Agregar a catálogo</label>
					<div class="my-form-group">
						<div class="input-layer">
							<span class="bi bi-people input-icon"></span>
							<select  v-model="data.cataloge" class="input-control">
									<option :value="ctl.idCataloge"  v-for="ctl in cataloge">{{ctl.cataloge_name}}</option>
							</select>
						</div>
						<small class="m-0 p-0 text-danger">{{errors.cataloge}}</small>
					</div>
					
		      		<div class="row">
		      			<div class="col-md-6">
							<div class="my-form-group">
								<div class="input-layer">
									<span class="bi bi-box input-icon"></span>
									<input type="number" min="1" v-model="data.re_order" class="input-control" placeholder="Cant. Re-orden">
								</div>
							</div>
		      			</div>
		      			<div class="col-md-6">
							<div class="my-form-group">
								<div class="input-layer">
									<span class="bi bi-cash-coin input-icon"></span>
									<input type="text" v-model="data.discount" class="input-control" placeholder="Descuento %">
								</div>
							</div>
		      			</div>
		      		</div>
		      		<div class="row">
		      			<div class="col-md-12">
		      				<label for="">Descripción Corta</label>
		      				<textarea name="" id="" cols="30" rows="5" class="input-control" v-model="data.short"></textarea>
		      			</div>
		      			<div class="col-md-12">
		      				<label for="">Descripción Larga</label>
		      				<textarea name="" id="" cols="30" rows="5" class="input-control" v-model="data.long"></textarea>
		      			</div>
		      			
		      		</div>		      		
		      	</div>
		      <div class="modal-footer">
		        <button type="button" class="btn my-btn-secondary" data-bs-dismiss="modal">Cerrar</button>
		        <button type="button" class="btn my-btn" @click="save_data()">Guardar</button>
		      </div>
		    </div>
		  </div>
		</div>
	</div>
</template>
<script>
	import DataTable from 'datatables.net-bs5'
	export default{
		data(){
			return{
				data:[]
			}
		},
		methods:{
			get_list(){
				var me = this;
				var url = location.pathname.split('/').pop();
				axios.get('/contacts_list/'+url).then(function(response){
					me.data = response.data;
					me.table();
				})
			},
			open_modal(){
				$('#new').modal('show');
			},
			table(){
				$(document).ready(function () {
				    $('#contacts').DataTable();
				});
			}
		},
		mounted(){
			this.get_list();
		}
	}
</script>