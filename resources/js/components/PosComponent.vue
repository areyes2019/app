<template>
	<div class="container-fluid">
		<div class="row">
		<div class="col-md-6">
			<div class="step-header">
        		<h3>crear pedido</h3>
        		<small>Durante el proceso, no recarges la página</small>
        	</div>
        	<div class="accordion mb-5" id="accordionExample">
        		<!-- Datos del cliente-->
  				<div class="card rounded-0">
				    <div class="card-header rounded-0" id="headingOne">
				      	<h2 class="mb-0">
					        <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
					          Datos del Clietne #1
					        </button>
				      	</h2>
				    </div>
				    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
				    	<div class="card-body rounded-0">
				        	<div class="form-group">
					    		<label for="exampleInputEmail1">Nombre del Cliente</label>
					    		<input type="email" v-model="name" class="form-control rounded-0 shadow-none" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Escribe el nombre">
							</div>
			        		<div class="form-group">
							    <label for="exampleInputEmail1">Numero WhatsApp</label>
							    <input type="email" v-model="mobile" class="form-control rounded-0 shadow-none" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Pídele su WhatsApp">
							    <small id="emailHelp" class="form-text text-muted">Este es muy importantes, ya que sera el numero de recibo</small>
							</div>
			        		<div class="d-flex justify-content-end" id="group1">
			        			<button class="btn btn-dark rounded-0" @click="steps(1)">Guardar</button>
			        		</div>
				      	</div>
				    </div>
  				</div>
        		<!-- Datos del cliente-->

        		<!-- Artículos -->
			  	<div class="card rounded-0">
				    <div class="card-header" id="headingTwo">
				      	<h2 class="mb-0">
					        <a href="#" class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
					          Agregar Artículos #2
					        </a>
				      	</h2>
				    </div>
				    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
				      <div class="card-body">
				        <!-- Agregar Artículos-->
				        <div class="step-form">
	        				<label for="">Cant.</label>
	    						<input type="number" class="form-control rounded-0 shadow-none" v-model="quantity">
	        				<label for="">Artículo</label>
	        				<vue-select :options="articles" :reduce="model => model.idArticle" class="vue-select" v-model="article" label="model" placeholder="Selecciona un Artículo"></vue-select>
	    					<button class="btn rounded-0 my-btn" @click="step_two()"><span class="bi bi-check"></span></button>
	        			</div>
				        <!-- Agregar Artículos-->
				      </div>
				    </div>
			  	</div>
        		<!-- Artículos -->


        		<!-- Pago y envio -->
			  	<div class="card rounded-0">
				    <div class="card-header rounded-0" id="headingThree">
				      	<h2 class="mb-0">
					        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseThree">
					          Pago y envío #3
					        </button>
				      	</h2>
				    </div>
				    <div id="collapseFour" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
				      	<div class="card-body">
				        <!-- Pago y envio -->
				        <div class="row">
				        	<div class="col-md-6">
					        	<label for="">Pago:</label>
				        		<div class="d-flex justify-content-between align-items-end">
			        				<input type="text" class="form-control rounded-0 shadow-none" v-model="advance">
			        				<button class="btn my-btn rounded-0 shadow-none" @click="add_advance"><span class="bi bi-check"></span></button>
				        		</div>
				        	</div>
				        	<div class="col-md-6">
			        			<label for="">Envío</label>
			        			<select v-model="shipping_cost" id="" @change="add_delivery" class="form-control rounded-0 shadow-none">
			        				<option value="1">Ocurre</option>
			        				<option value="2">Domicilio Normal</option>
			        				<option value="3">Domicilio Express</option>
			        				<option value="4">Foraneo</option>
			        			</select>
				        	</div>
		        			<div class="modal fade rounded-0" id="delivery_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
								<div class="modal-dialog modal-sm  modal-dialog-centered rounded-0" role="document">
								    <div class="modal-content rounded-0">
								      	<div class="modal-body step-delivery-modal-tarif">
											<label for="" class="mt-2">¿Cual es el costo del envio?</label>
											<input type="text" class="form-control rounded-0 mt-2" v-model="delivery_pay">
											<button class="btn btn-dark btn-sm rounded-0 mt-3 float-right" @click="add_delivery()">Agregar</button>
								      	</div>
								    </div>
								</div>
							</div>
	        			</div>
	        			<div :class="[delivery_style]">
		        			<h6 class="mt-4">Dirección de entrega</h6>
		        			<div class="row">
		        				<div class="col-md-6">
		        					<div class="form-group">
		        						<label for="">Calle y Numero</label>
		        						<input type="text" class="form-control rounded-0 shadow-none" v-model="street">
		        					</div>
		        				</div>
		        				<div class="col-md-6">
		        					<div class="form-group">
		        						<label for="">Colonia</label>
		        						<input type="text" class="form-control rounded-0 shadow-none" v-model="zone">
		        					</div>
		        				</div>
		        			</div>
		        			<div class="row">
		        				<div class="col-md-6">
		        					<div class="form-group">
		        						<label for="">Ciudad</label>
		        						<input type="text" class="form-control rounded-0 shadow-none" v-model="direction">
		        					</div>
		        				</div>
		        				<div class="col-md-6">
		        					<div class="form-group">
		        						<label for="">Nombre de quien recibe</label>
		        						<input type="text" class="form-control rounded-0 shadow-none" v-model="receiber">
		        						<small>Solo si es diferente a quien hace el pedido</small>
		        					</div>
		        				</div>
		        			</div>
		        			<div class="row">
		        				<div class="col-md-6">
		        					<label for="">Fecha de entrega</label>
		        					<div class="d-flex justify-content-between">
		        						<input type="date" class="form-control rounded-0 shadow-none" v-model="date">
		        					</div>
		        				</div>
		        				<div class="col-md-6">
		        					<label for="">Hora de entrega</label>
		        					<div class="d-flex justify-content-between">
		        						<select name="" id="" v-model="time" class="form-control rounded-0 shadow-none">
		        							<option value="09:00:00">09:00 a.m.</option>
		        							<option value="10:00:00">10:00 a.m.</option>
		        							<option value="11:00:00">11:00 a.m.</option>
		        							<option value="12:00:00">12:00 p.m.</option>
		        							<option value="13:00:00">01:00 p.m.</option>
		        							<option value="14:00:00">02:00 p.m.</option>
		        							<option value="15:00:00">03:00 p.m.</option>
		        							<option value="16:00:00">04:00 p.m.</option>
		        							<option value="17:00:00">05:00 p.m.</option>
		        							<option value="18:00:00">06:00 p.m.</option>
		        							<option value="19:00:00">07:00 p.m.</option>
		        						</select>
		        					</div>
		        				</div>
		        			</div>
		        			<div class="d-flex justify-content-end">
		        				<button class="btn my-btn mt-2 rounded-0" @click="add_address">Guardar</button>
		        			</div>
					        <!-- Pago y envio -->
				      	</div>
				      	</div>
				    </div>
			  	</div>	
			</div>
			<a href="" class="mr-2 mt-4">Enviar por WhatsApp/</a>
			<a href="" class="mr-2 mt-4">Enviar por Correo/</a>
			<a href="" class="mr-2 mt-4">Descargar/</a>
			<a href="#" data-toggle="modal" data-target="#production">Enviar a producción</a>

			<!-- modal para producción -->
			<div class="modal fade rounded-0" id="production" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered rounded-0" role="document">
				    <div class="modal-content rounded-0">
				    	<div class="modal-body">
				    		<div class="design-block" v-for = "design in details_line">
				      			<p class="mb-0 mt-2"><strong>{{design.name}}</strong></p>
						      	<small>Agregar imagen</small>
						      	<form @submit.prevent="saveImg(design.idDetail_order)" enctype="mulipart/form-data">
				      				<input type="file" name="" @change="getImage" id="file">
				      				<input type="text" :ref="design.idDetail_order" class="form-control rounded-0 shadow-none mt-2">
					      			<div class="d-flex justify-content-between">
					      				<div class="form-group">
					      					<div class="form-check">
										    	<input type="checkbox" v-model="draw" value="d" class="form-check-input" id="exampleCheck1">
										    	<label class="form-check-label" for="exampleCheck1">Elaboracion de Diseño</label>
											</div>
					      				</div>
					      				<div class="form-group">
					      					<div class="form-check">
										    	<input type="checkbox" v-model="rubber" value="r" class="form-check-input" id="exampleCheck1">
										    	<label class="form-check-label" for="exampleCheck1">Elaboración de Goma</label>
											</div>
					      				</div>
					      				
					      			</div>
				      				<div class="d-flex justify-content-end">
				      					<button type="submit" class="btn my-btn rounded-0 mt-2"><span class="bi bi-upload"></span> Subir</button>
				      				</div>
				      			</form>
				    		</div>
			      			<div class="row mt-5">
			      				<div class="col-md-12 d-flex justify-content-end">
			      					<button type="button" class="btn my-btn rounded-0 btn-lg btn-block" @click="send_to_prod"><span class="bi bi-send"></span> Enviar</button>
			      				</div>
			      			</div>
				    	</div>
				    </div>
				</div>
			</div>
		</div>
		<!-- Aqui empieza el ticket-->
		<div class="col-md-6 ticket">
			<div class="ticket-sheet">
				<div class="ticket-sheet-header">
					<div class="row">
						<div class="col-md-6">
							<img src="/img/logo2.png" alt="" height="50px">
						</div>
						<div class="col-md-6">
							<p>Pedido <span>{{data.idOrder}}</span></p>
							<p>Fecha <span>{{new Date(data.created_at).toDateString()}}</span></p>
						</div>
					</div>
				</div>
				<div class="ticket-sheet-data">
					<p><span>Nombre:</span> {{data.name}}</p>
					<p><span>WhatsApp:</span> {{data.mobile}}</p>
				</div>
				<table class="table table-bordered" id="table">
					<tr>
						<th>Artículo</th>
						<th class="text-center">Cant.</th>
						<th>P/U</th>
						<th>Total</th>
						<th></th>
					</tr>
					<tr v-for="data in details_line">
						<td>{{data.name}}</td>
						<td class="text-center">{{data.quantity}}</td>
						<td>${{data.unit}}</td>
						<td>${{data.total}}</td>
						<td>
							<a href="#" @click.prevent="delete_line(data.idDetail_order)"><span class="bi bi-x"></span></a>
						</td>
					</tr>
				</table>
				<div class="row">
					<div class="col-md-6">
						<p class="m-0"><strong>Direccion de entrega</strong></p>
						<p>{{data.street}}, Col. {{data.zone}}. {{data.details}}</p>
						<p class="mt-2 mb-0"><strong>Teléfono</strong></p>
						<p>{{data.mobile}}</p>
						<p><span><strong>Fecha de entrega</strong></span> {{data.delivery_day}} <span><strong>Hora de entrega</strong></span> {{data.delivery_time}}</p>
					</div>
					<div class="col-md-6">
						<table class="table table-bordered">
							<tr>
								<th>Importe</th>
								<td>${{data.amount}}</td>
							</tr>
							<tr>
								<th>Anticipo</th>
								<th>${{data.advance_payment}}</th>
							</tr>
							<tr>
								<th>Saldo</th>
								<td>${{data.total}}</td>
							</tr>
							<tr>
								<th>Envio</th>
								<td>${{data.delivery_cost}}</td>
							</tr>
							
						</table>
					</div>
				</div>
				<div class="d-flex justify-content-end">
					<h4>Total a pagar: <span class="text-danger">${{total}}</span></h4>
				</div>
			</div>
		</div>
		</div>
	</div>
</template>
<script>
	import VueSelect from 'vue-select'
	import 'vue-select/dist/vue-select.css';
	export default{
		props:['slug','id'],
		components:{
    		VueSelect
  		},
		data(){
			return{
				art_detail:app.$refs,
				data:[],
				articles:[],
				details_line:[],
				options:[],
				totals:[],
				street:"",
				zone:"",
				receiber:"",
				direction:"",
				time:"",
				date:"",
				img:"",
				name:"",
				mobile:"",
				quantity:"",
				article:"",
				advance:"",
				payment:"",
				street:"",
				number:"",
				zone:"",
				receiber:"",
				details:"",
				delivery_type:"",
				delivery_day:"",
				delivery_time:"",
				delivery_pay:"",
				delivery_type_status:"",
				delivery_address:"",
				delivery_style:"",
				shipping_cost:"",
				id_line:"",
				art_notes:"",
				total:"",
				//diseño
				draw:"",
				rubber:"",
			}
		},
		methods:{
			articles_get(){
				var me = this;
				var url = '/articles_list';
				axios.get(url).then(function(response){
					me.articles = response.data;
				})
			},
			status(){
				if (this.delivery_type_status == 1) {
					this.delivery_style = 'd-none';
				}else{
					this.delivery_style = 'd-block';
				}
			},
			get_data(){
				var me = this;
				var url = '/get_order_data/'+me.slug;
				axios.get(url).then(function(response){
					me.data = response.data[0];
					me.show_details();
					//este es el total del ticket
					var total = parseFloat(response.data[0].total);
					var shipping = parseFloat(response.data[0].delivery_cost);
					me.total = total + shipping;
					me.delivery_type_status = response.data[0].delivery_type;
					me.status();
				})
				
			},
			getImage(e){
            	var file = e.target.files[0];
            	this.img = file;
            },
            saveImg(line){
            	var me = this;
            	var coment = this.$refs[line][0].value;
            	//console.log(this.img); 
            	var data = new FormData();
            	data.append('image',this.img);
            	//data.append('_token', document.querySelector('#csrf').getAttribute('content'));
            	data.append('id_line', line);
            	data.append('art_notes', coment);
            	data.append('draw', me.draw);
            	data.append('rubber', me.rubber);
            	var url = '/detail_img';
            	axios.post(url,data).then(function(response){
            		me.get_data();
            		me.show_details();
            	});
            },
			delete_line(data){
				var me = this;
				var url = "/delete_line_order/"+data+"/"+me.id;
				axios.get(url).then(function(response){
					me.show_details();
					me.get_data();
				})			
			},
			add_delivery(){
				
				var me = this;
				var data = this.shipping_cost;
				var url = "/shipping_pos"
				if (data==4) {
					$('#delivery_modal').modal('show');
					me.deliver_foreign();
				}else{
					//ocurre
					if (data == 1) {
						axios.post('/shipping_type',{
							'id':me.id,
							'type':1
						}).then(function(response){
							me.get_data();
							me.show_details();
						})
					}else if(data == 2){
					//normal
						axios.post(url,{
							'id':me.id,
							'cost':50,
							'type':2
						}).then(function(response){
							me.get_data();
							me.show_details();
						})
					}else if(data==3){
					//express
						axios.post(url,{
							'id':me.id,
							'cost':58,
							'type':3
						}).then(function(response){
							me.get_data();
							me.show_details();
						})
					}

				}
			},
			add_address(){
				var me = this;
				var url = "/add_address";
				axios.post(url,{
					'id':me.id,
					'street':me.street,
					'zone':me.zone,
					'receiber':me.receiber,
					'dir':me.direction,
					'time':me.time,
					'date':me.date,
				}).then(function(response){
					me.get_data();
					me.show_details();
				})
			},
			deliver_foreign(){
				var me = this;
				var url = "/shipping_pos";
				axios.post(url,{
					'id':me.id,
					'cost':me.delivery_pay,
					'type':4
				}).then(function(response){
					me.get_data();
					me.show_details();
					$('#delivery_modal').modal('hide');
					me.delivery_pay = "";
				})
			},
			step_two(){
				var me = this;
				var url = '/update_sale/'+ 2 +'/'+ me.id;
				axios.post(url,{
					'qty':me.quantity,
					'article':me.article,
					'id':me.id
				}).then(function(response){
					me.get_data();
				});
			},
			steps(data){
				var me = this;
				
				//aki metemos los datos del paso 1
				axios.post('/update_sale/'+ 1 +'/'+ me.slug,{
					'name':me.name,
					'mobile':me.mobile,
				}).then(function(response){
					me.get_data();
				})
					
			},
			show_details(){
				var me = this;
				var url = "/show_details/"+me.id;
				axios.get(url).then(function(response){
					me.details_line = response.data;
				})
			},
			add_advance(){
				
				var me = this;
				var url = "/add_payment_order";
				axios.post(url,{
					'id':me.id,
					'payment':me.advance
				}).then(function(response){
					me.get_data();
					me.show_details();
				})
			},
			send_to_prod(){
				//alert('hola');
				var me = this;
				var url = "/send_to_production";
				axios.post(url,{
					'id':me.id
				}).then(function(response){
					
				})

			}

			
		},
		mounted(){
			this.articles_get();
			this.get_data();
			this.show_details();

		}
	}
</script>