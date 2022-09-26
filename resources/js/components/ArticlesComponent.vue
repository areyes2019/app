<template>
	<div class="container">
		<div class="card-box-std p-3">
			<div class="row">
				<div class="col-md-7">
					<div class="card-box-left">
						<button class="btn btn-danger btn-sm" @click.prevent="add_article"><span class="bi bi-box"></span> Agregar artículo</button>
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
		<div class="card-box-std p-3 mt-3">
			<table class="table table-bordered" id="articles_table">
				<thead>
					<tr>
						<th>#</th>
						<th>Nombre</th>
						<th>Modelo</th>
						<th>Familia</th>
						<th>Precio Prov</th>
						<th>Precio Público</th>
						<th>
						</th>
					</tr>
				</thead>
				<tbody>
					<tr v-for="article in table">
						<td>{{article.idArticle}}</td>
						<td>{{article.name}}</td>
						<td>{{article.model}}</td>
						<td>{{article.family_name}}</td>
						<td>{{article.cost}}</td>
						<td>{{article.price}}</td>
						<td>
							<a href="#" @click.prevent="showModal(article.idArticle)"><span class="bi bi-pencil-square"></span></a>
							<a href="#" @click.prevent="deleteData(article.idArticle)"><span class="bi bi-trash"></span></a>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
		<!-- modal agregar artículo-->
		<div class="modal fade" id="add_article" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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

		<!-- modal modificar artículo -->
		<div class="modal fade" id="edit_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
		  <div class="modal-dialog modal-dialog-scrollable">
		    <div class="modal-content rounded-0" v-for="product in update">
		      	<div class="modal-header rounded-0 bg-color">
		        	<h5 class="modal-title text-white" id="staticBackdropLabel">Editar Artículo</h5>
		        	<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		      	</div>
		      	<div class="modal-body" >
		      		<div class="my-form-group">
		      			<div class="input-layer">
							<span class="bi bi-pencil input-icon"></span>
							<input type="text" v-model="product.name" class="input-control" placeholder="Nombre del Sello">
		      			</div>
						<small class="text-danger m-0 p-0">{{errors.name}}</small>
					</div>
					<div class="my-form-group">
						<div class="input-layer">
							<span class="bi bi-pencil input-icon"></span>
							<input type="text" v-model="product.model" class="input-control" placeholder="Modelo">
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="my-form-group">
								<div class="input-layer">
									<span class="bi bi-pencil input-icon"></span>
									<input type="number" min="1" v-model="product.lines" class="input-control" placeholder="Líneas sugeridas">
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="my-form-group">
								<div class="input-layer">
									<span class="bi bi-pencil input-icon"></span>
									<input type="text" v-model="product.size" class="input-control" placeholder="Tamaño">
								</div>
							</div>
						</div>
					</div>
					<div class="my-form-group d-flex justify-content-between">
						<p class="m-0 p-0">¿Se agrega al stock?</p>
						<label class="switch">
						  <input type="checkbox" v-model="product.stock" :value="1">
						  <span class="slider"></span>
						</label>
					</div>
					<div class="my-form-group d-flex justify-content-between">
						<p class="m-0 p-0">Visible</p>
						<label class="switch">
						  <input type="checkbox" v-model="product.visible" :value="1">
						  <span class="slider"></span>
						</label>
					</div>					
					<div class="my-form-group">
						<div class="input-layer">
							<span class="bi bi-currency-exchange input-icon"></span>
							<input type="text" v-model="product.cost" class="input-control" placeholder="Precio Proveedor">
						</div>
						<small class="text-danger">{{errors.cost}}</small>
					</div>
					<div class="my-form-group">
						<div class="input-layer">
							<span class="bi bi-currency-exchange input-icon"></span>
							<input type="text" v-model="product.price" class="input-control" placeholder="Precio Público">
						</div>
						<small class="text-danger m-0">{{errors.price}}</small><br>
						<small class="text-danger m-0">{{errors.price_decimal}}</small>
					</div>
					<label for="">Asignar Proveedor</label>
					<div class="my-form-group">
						<div class="input-layer">
							<div class="input-layer">
								<span class="bi bi-people input-icon"></span>
								<select name="" id="" v-model="product.provider" class="input-control" @change="get_cataloge(product.provider)">
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
							<select name="" id="" v-model="product.family" class="input-control">
								<option :value="member.idFamily" v-for="member in family">{{member.family_name}}</option>
							</select>
						</div>
						<small class="m-0 p-0 text-danger">{{errors.family}}</small>
					</div>
					<label for="">Agregar Categoría</label>
					<div class="my-form-group">
						<div class="input-layer">
							<span class="bi bi-people input-icon"></span>
							<select name="" id="" v-model="product.categorie" class="input-control">
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
							<select  v-model="product.cataloge" class="input-control">
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
									<input type="number" min="1" v-model="product.re_order" class="input-control" placeholder="Cant. Re-orden">
								</div>
							</div>
		      			</div>
		      			<div class="col-md-6">
							<div class="my-form-group">
								<div class="input-layer">
									<span class="bi bi-cash-coin input-icon"></span>
									<input type="text" v-model="product.discount" class="input-control" placeholder="Descuento %">
								</div>
							</div>
		      			</div>
		      		</div>
		      		<div class="row">
		      			<div class="col-md-12">
		      				<label for="">Descripción Corta</label>
		      				<textarea name="" id="" cols="30" rows="5" class="input-control" v-model="product.short"></textarea>
		      			</div>
		      			<div class="col-md-12">
		      				<label for="">Descripción Larga</label>
		      				<textarea name="" id="" cols="30" rows="5" class="input-control" v-model="product.long"></textarea>
		      			</div>
		      			
		      		</div>		      		
		      	</div>
		      <div class="modal-footer">
		        <button type="button" class="btn my-btn-secondary" data-bs-dismiss="modal">Cerrar</button>
		        <button type="button" class="btn my-btn" @click="updateData(product.idArticle)">Guardar</button>
		      </div>
		    </div>
		  </div>
		</div>
		
		<!-- errores de validacion -->
		<div class="modal fade" id="modal_warning" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
		  <div class="modal-dialog modal-dialog-scrollable">
		    <div class="modal-content rounded-0">
		      	<div class="modal-body">
		      		<div class="alert alert-warning" role="alert">
					  Tu importación tiene errores, por favor revisa tu archivo
					</div>
					<ul v-for="error in errors">
						<li><p>{{error}}</p></li>
					</ul>
		      	</div>
		      <div class="modal-footer">
		        <button type="button" class="btn my-btn-secondary-sm" data-bs-dismiss="modal"><span class="bi bi-x-octagon"></span> Cerrar</button>
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
				//aqui van los datos del artículo
				data:{
					_token:document.querySelector('#csrf').getAttribute('content'),
				},
				table:[],
				//aqui recibimos los errores
				errors:{},
				//mostrar cataogos
				cataloge:[],
				//update
				csrf:document.querySelector('#csrf').getAttribute('content'),
				update:{},
				//estilos
                display:"d-none",
                display_digit:"d-none",
                //datos del articulo
                article:[],
                article_array:"",
                categories:"",
                categorie:"",
                suppliers:[],
                exl:"",
                exl_name:"",
                family:[],
                search_family:"",

                //campos de busqueda
                search_name:"",

                //nombre del archivo
                exl:"",
                output: null,
                parent_list:[],
                child_list:[],
                single_list:[],
                errors:{
                	cost:"",
                	dealer:"",
                	name:"",
                	price:"",
                	provider:"",
                	family:"",
                	cataloge:""
                }
			}
		},
		methods:{
			getData(){
                let me =this;
                let url = '/list' //Ruta que hemos creado para que nos devuelva todas las tareas
                axios.get(url).then(function(response) {
                    //creamos un array y guardamos el contenido que nos devuelve el response
                    me.table = response.data;
                    me.my_table();
                })
            },
            
            get_categorie(){
            	var me = this;
            	var url = 'categories_list';
            	axios.get(url).then(function(response){

            	})
            },
            get_cataloge(data){
            	var me 	= this;
            	var url = '/get_cataloge/'+data;
            	axios.get(url).then(function(response){
            		//console.log(response.data);
            		me.cataloge = response.data;
            	}) 
            },
            getProviders(){
                var me = this;
                var url = 'contacts_list/'+2;
                axios.get(url).then(function(response){ 
                	me.suppliers = response.data
                });   
            },
            save_data(){

                var me = this;
                var url = "/articles";
                axios.post(url,me.data).then(function(response){
					me.getData();
                	me.errors="";
                	me.data=""
                	$('#add_article').modal('hide');
                	var title = "Felicidades";
					var message = "Has creado un artículo";
					toaster(title,message);
                }).catch(function(errors){
                	
                	if (errors.response.data.errors) {
                		me.errors = errors.response.data.errors;
                	}

                	if (errors.response.data.errors.name) {
		         	 	me.errors.name = errors.response.data.errors.name[0];
		         	}else{
		         	 	me.errors.name ="";
		         	}

		         	if (errors.response.data.errors.cost) {
		         	 	me.errors.cost = errors.response.data.errors.cost[0];
		         	}else{
		         	 	me.errors.cost ="";
		         	}
		         	

		         	if (errors.response.data.errors.dealer) {
		         	 	me.errors.dealer = errors.response.data.errors.dealer[0];
		         	}else{
		         	 	me.errors.dealer ="";
		         	}

		         	if (errors.response.data.errors.price) {
		         	 	me.errors.price = errors.response.data.errors.price[0];
		         	 	me.errors.price_decimal = errors.response.data.errors.price[1];
		         	}else{
		         	 	me.errors.price ="";
		         	 	me.errors.price_decimal ="";
		         	}

		         	if (errors.response.data.errors.provider) {
		         	 	me.errors.provider = errors.response.data.errors.provider[0];
		         	}else{
		         	 	me.errors.provider ="";
		         	}
		         	
		         	if (errors.response.data.errors.family) {
		         	 	me.errors.family = errors.response.data.errors.family[0];
		         	}else{
		         	 	me.errors.family ="";
		         	}
		         	
		         	if (errors.response.data.errors.cataloge) {
		         	 	me.errors.cataloge = errors.response.data.errors.cataloge[0];
		         	}else{
		         	 	me.errors.cataloge ="";
		         	}
		         	

		         	
                });
            },
            openLinked(data){
                
                $('#edit').modal('show');
                var me = this;
                var url = "article/"
                axios.get(url+data).then(function(response) {
                    //creamos un array y guardamos el contenido que nos devuelve el response
                    me.article = response.data[0];
                })
            },
            cleanData(){
                this.name ="";
                this.model ="";
                this.size ="";
                this.cost ="";
                this.price ="";
                this.provider ="";
            },
            showModalAdd(){
                this.cleanData();
                $('#AddClient').modal('show');
            },
            showModal(data){
            	//console.log(data);

            	var me = this;
            	var url = '/articles/'+data
                axios.get(url).then(function(response){
                	me.update = response.data;
                })
                $('#edit_modal').modal('show');

            },
            updateData(data){    
                //console.log(data);
                let me =this;
                var url = "/articles/"+data
                axios.put(url,{
                	'name':me.update[0].name,
                	'model':me.update[0].model,
                	'lines':me.update[0].lines,
                	'size':me.update[0].size,
                	'stock':me.update[0].stock,
                	'cost':me.update[0].cost,
                	'price':me.update[0].price,
                	'discount':me.update[0].discount,
                	'provider':me.update[0].provider,
                	're_order':me.update[0].re_order,
                	'visible':me.update[0].visible,
                	'family':me.update[0].family,
                	'short_desc':me.update[0].short_desc,
                	'long_desc':me.update[0].long_desc,
                	'categorie':me.update[0].categorie,
                	'cataloge':me.update[0].cataloge,
                	'_token':me.csrf,
                }).then(function (response) {
                    if (response.data == true) {
	                    me.getData();
	                    $('#edit_modal').modal('hide');
	                 	var title = "Hecho";
						var message = "Actualizaste el artículo";
						toaster(title,message);
						me.getData();   
                    }
                }).catch(function(errors){
                	console.log(errors.response.data.errors);
                })
            },
            deleteData(data){
                let me =this;
                let url = "/articles/"+data
                if (confirm('¿Seguro que deseas borrar este artículo?')) {
                    axios.delete(url).then(function (response) {
                        var title = "Hecho";
						var message = "Has borrado un artículo";
						toaster(title,message);
						me.getData();
                    })
                }
            },
        
            getExl(e){
                this.exl = e.target.files[0];
                this.exl_name = e.target.files[0].name;
                console.log(e.target.files[0]);
            },
            importExl(){
                //console.log('funciona');
                var me = this;
                //tomamos el archivo del formulario y la guardamos
                let formData = new FormData();
                    formData.set('file', this.exl);
                    axios.post('/excel', formData).then(function (response){
                    	if (response.data==1) {
                    		me.getData();
                    		var title = "Felicidades";
							var message = "La importacion fue exitosa";
							toaster(title,message);
                    		me.$refs.inputFile.value="";
                    	}
                    }).catch(function(errors){
                    	if (errors.response.data.errors) {
                    		me.errors = errors.response.data.errors;
                    		$('#modal_warning').modal('show');
                    	}
                    });
            },
            getFamily(){
                var me = this;
                var url = "/get_family";
                axios.get(url).then(function(response){
                    me.family = response.data;
                })

            },
            searchFamily(){
                
                var me = this;
                var url = "/search_family_line/"+this.search_family;
                if (this.search_family == "a") {
                    this.getData();
                }else{
                    axios.get(url).then(function(response){
                        me.dataArray = response.data;
                    })

                }
            },
            is_parent(){
            	var me = this;
            	var url = '/is_parent';
            	axios.get(url).then(function(response){
            		me.parent_list = response.data.parent;
            		me.child_list = response.data.child;
            		me.single_list = response.data.single;
            	})
            },
			add_article(){
				this.getProviders();
				this.getFamily();
				this.is_parent();
				$('#add_article').modal('show');
			},
			my_table(){
				$(document).ready(function () {
                    $('#articles_table').DataTable();
                });
			}
		},
		mounted(){
			this.getData();
			this.getProviders();
			this.getFamily();
			this.get_categorie();
		}
	}
</script>