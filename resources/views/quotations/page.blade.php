@extends('template.app')
@section('content')
<div class="main-board" id="app">
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		<div class="container-fluid">
		    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		    <span class="navbar-toggler-icon"></span>
		    </button>
		    <div class="collapse navbar-collapse" id="navbarSupportedContent">
		      	<ul class="navbar-nav me-auto mb-2 mb-lg-0">
			        <li class="nav-item dropdown">
			          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
			            Clientes
			          </a>
			          <ul class="dropdown-menu rounded-0" aria-labelledby="navbarDropdown">
			            <li class="dropdown-item">
			            	<a href="#" @click.prevent="add_customer_modal">Nuevo Cliente</a>
			            </li>
			            <li><hr class="dropdown-divider"></li>
			            <li class="dropdown-item">
			            	<a  href="#" @click="open_customers_modal">Lista</a>
			            </li>
			          </ul>
			        </li>
			        <li class="nav-item dropdown">
			          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
			            Enviar
			          </a>
			          <ul class="dropdown-menu rounded-0" aria-labelledby="navbarDropdown">
			            <li><a class="dropdown-item" href="#">Enviar a Correo</a></li>
			            <li><hr class="dropdown-divider"></li>
			            
			            <li><a class="dropdown-item" href="#">Enviar a WhatsApp</a></li>
			            <li><hr class="dropdown-divider"></li>
			            <div v-for="buttons in order">
				            <li v-if="buttons.status == 2"><a class="dropdown-item" href="#addProduction" data-bs-toggle="modal"><span class="bi bi-gear"></span> Enviar a Produción</a></li>
				            <li><hr class="dropdown-divider"></li>
			            </div>
			            
			            <li><a class="dropdown-item" href="#">Descargar</a></li>
			          </ul>
			        </li>
			        <li class="nav-item dropdown">
			          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
			            Pagos
			          </a>
			          <ul class="dropdown-menu rounded-0" aria-labelledby="navbarDropdown">
			            <li class="p-3">
			            	<label for="">Agregar Pago</label>
			            	<div class="d-flex justify-content-between">
			            		<input type="text" class="form-control rounded-0 shadow-none" v-model="payment">
			            		<button class="btn btn-outline-dark btn-sm rounded-0" @click="add_payment()"><span class="bi bi-check-square"></span></button>
			            	</div>
			            </li>
			            <li><hr class="dropdown-divider"></li>
			            <li><a class="dropdown-item" href="#">Descuento</a></li>
			          </ul>
			        </li>
			        <li class="nav-item">
			        	
			        </li>
			        <li class="nav-item">
			        	
			        </li>
		      	</ul>
		      	<div v-for = "buttons in order">
			      	<div class="btn-group" role="group" aria-label="Basic radio toggle button group">
					  	<input type="radio" class="btn-check" id="btnradio1" name="tax" :checked="with_tax" @click="changeTax(1)">
					  	<label class="btn btn-outline-light rounded-0" for="btnradio1">Con Iva</label>

					  	<input type="radio" class="btn-check"  id="btnradio3" name="tax" :checked="no_tax" @click="changeTax(0)">
					  	<label class="btn btn-outline-light rounded-0" for="btnradio3">Sin Iva</label>
					</div>
			        <button class="btn btn-outline-light rounded-0" v-if="buttons.status==1" @click="delete_order"><span class="bi bi-trash" ></span>Eliminar</button>
		      	</div>
		    </div>
		</div>
	</nav>
		<P ref="slug" class="d-none">{{$slug}}</P>
		<!-- Agregar articulo independiente -->
	<div class="row mt-3">
		<div class="col-md-8">
			<nav class="my-nav p-2 d-flex justify-content-between align-items-center">
				<div v-for = "buttons in order">
					<!-- Agregar articulo independiente  -->	
				  	<a v-if="buttons.status == 1" href="#collapseExample" class="btn btn-outline-light  btn-sm rounded-0" data-bs-toggle="collapse">
				  		<span class="bi bi-box-seam" data-bs-toggle="tooltip" data-bs-placement="top" title="Articulo Independiente"></span>
				  	</a>
					<!-- Agregar articulo de lista -->
					<button v-if="buttons.status == 1" class="btn btn-outline-light btn-sm rounded-0" @click="openModal()"><span class="bi bi-bag-check" data-bs-toggle="tooltip" data-bs-placement="top" title="Articulos de lista"></span></button>
					<!-- Agregar articulo de lista -->

					<!-- Agregar envio -->
					<a href="#shipping_modal" class="btn btn-outline-light rounded-0 btn-sm" data-bs-toggle="modal">
						<span class="bi bi-truck" data-bs-toggle="tooltip" data-bs-placement="top" title="Agregar envío"></span>
					</a>
					<!-- Agregar envio -->

					<!-- descargar pdf  -->
					<a class="btn btn-outline-light rounded-0 btn-sm" @click="getPDF" data-bs-toggle="tooltip" data-bs-placement="top" title="Descargar PDF"><span class="bi bi-filetype-pdf"></span></a>
					<!-- descargar pdf  -->

					<!-- descargar nota de venta  -->
					<a class="btn btn-outline-light rounded-0 btn-sm" @click="getTk" data-bs-toggle="tooltip" data-bs-placement="top" title="Descargar Nota"><span class="bi bi-receipt-cutoff"></span></a>
					<!-- descargar nota de venta  -->

					<!-- Enviar a diseños  -->
					<a v-if="buttons.art_img == 1" class="btn btn-outline-light rounded-0 btn-sm" @click="sendToDesign" data-bs-toggle="tooltip" data-bs-placement="top" title="Enviar a Diseño "><span class="bi bi-pc-display-horizontal"></span></a>
					<!-- Enviar a diseño -->

					<!-- enviar por correo  -->

					<!-- enviar por correo  -->

				</div>
				<div v-for = "status in order">
					<span class="badge bg-warning text-dark m-0 float-right" v-if="status.status == 1">Pedido Generado</span>
					<span class="badge bg-primary m-0 float-right" v-if="status.status == 2">En Diseño</span>
					<span class="badge bg-info m-0 float-right" v-if="status.status == 3">En Producción</span>
					<span class="badge bg-success m-0 float-right" v-if="status.status == 4">Para Entrega</span>
					<span class="badge bg-danger m-0 float-right" v-if="status.status == 5">Entregado</span>
				</div>
			</nav>
			<div class="card rounded-0 collapse mt-1" id="collapseExample">
				<div class="card-body d-flex justify-content-between align-items-end">
					<div class="col-md-2">
						<label for="">Cantidad</label>
						<input type="number" class="form-control form-control-sm rounded-0 shadow-none" v-model="cant">
					</div>
					<div class="col-md-5">
						<label for="">Descripcion</label>
						<input type="text" class="form-control form-control-sm rounded-0 shadow-none" v-model="desc">
					</div>
					<div class="col-md-3">
						<label for="">Precio Unit.</label>
						<input type="text" class="form-control form-control-sm rounded-0 shadow-none" v-model="unit_price">
					</div>
					<div class="col-md-2 d-flex align-items-end">
						<button class="btn btn-dark rounded-0 btn-sm" @click="addSingle()">Agregar</button>
					</div>
				</div>
			</div>
			<div class="card rounded-0 mt-2" v-if="lines == ''">
				<div class="card-body">
					<h5><i class="bi bi-exclamation-triangle"></i> No hay nada en la cotización</h5>
				</div>
			</div>
			<!-- Tabla de articulos agregados -->
			<div class="card rounded-0 mt-2" v-else>
				<div class="card-body">
					<table class="table my-table">
						<thead>
							<tr>
								<th>Cant.</th>
								<th>Artículo</th>
								<th>Modelo</th>
								<th>P/U</th>
								<th>Importe</th>
								<th>Acciones</th>
							</tr>
						</thead>
						<tbody v-for = "line in lines">
							<tr>
								<td v-for="buttons in order" align="center">
									<input  v-if="buttons.status == 1" type="number" v-model="line.quantity" style="width: 38px;" min="1" @change="addQuantity(line.idDetail_order)" ref="qty">
									<p class="m-0" v-else>@{{line.quantity}}</p>
								</td>
								<td>@{{line.name}}</td>
								<td>@{{line.model}}</td>
								<td>@{{line.unit}}</td>
								<td>@{{line.total}}</td>
								<td v-for="buttons in order">
									
									<!-- agregar imagen -->
									<a v-if="buttons.status == 1 & buttons.advance_payment !== null" class="btn btn-outline-dark btn-sm rounded-0 shadow-none" data-bs-toggle="collapse" :href="'#T'+line.idDetail_order" ><i class="bi bi-card-image"></i></a>
									<!-- agregar imagen -->

									<button v-if="buttons.status == 1" class="btn btn-outline-dark btn-sm rounded-0" @click="deleteLine(line.idDetail_order)"><i class="bi bi-x-lg"></i></button>
								</td>
							</tr>
							<tr class="collapse" :id="'T'+line.idDetail_order">
								<td colspan="6">
									<form @submit.prevent="saveImg(line.idDetail_order)" enctype="mulipart/form-data">
										<input type="file" name="" @change="getImage" id="file">
										<div class="input-group mt-3">
										  	<input type="text" class="form-control rounded-0 shadow-none" placeholder="Detalles del sello" :ref="line.idDetail_order" v-model="art">
										  	<button class="btn btn-outline-secondary btn-sm rounded-0 shadow-none" type="submit" id="button-addon2">Agregar</button>
										</div>
								  	</form>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<!-- Tabla de articulos agregados -->

			<!-- Tabla de totales-->
			<div class="card rounded-0 mt-2">
				<div class="card-body">
					<table class="table" v-for = "total in totals">
						<tr>
							<th>Sub-Total</th>
							<td>$@{{total.amount}}</td>
						</tr>
						<tr>
							<th>IVA</th>
							<td>$@{{total.tax}}</td>
						</tr>
						<tr>
							<th>Total</th>
							<td class="text-success"><strong>$@{{total.total_sum}}</strong></td>
						</tr>
						<tr>
							<th>@{{label}}</th>
							<td>$@{{total.advance_payment}}</td>
						</tr>
						<tr>
							<th>Saldo</th>
							<td>$@{{total.total}}</td>
						</tr>
						<tr>
							<th>Envio</th>
							<td>$@{{total.shipping}}</td>
						</tr>
						<tr>
							<th>Saldo Total</th>
							<td>$@{{total.grand_total}} <button v-if="label !== 'Pagado'" class="btn btn-sm btn-outline-dark rounded-0 shadow-none" @click="pay_total_pos(total.grand_total)">Pagar</button></td>
						</tr>
					</table>
				</div>
			</div>
			<!-- Tabla de totales-->
			<div v-for="address in order" class="mt-4">
				<p><strong>Anticipo sugerido: $@{{pay_label = address.total_sum / 2}}</strong></p>
				<p class="m-0 fs-6">Datos de Envío</p>
				<hr>
				<p class="m-0"><strong>Recibe:</strong> @{{address.receiber}}</p>
				<p class="m-0">@{{address.street}}, Col. @{{address.zone}}</p>
				<p class="m-0">Población, @{{address.details}}</p>
				<p class="m-0"><strong>Día</strong> @{{address.delivery_day}}</p>
				<p class="m-0"><strong>Hora</strong> @{{address.delivery_time}}</p>
			</div>
		</div>
		<div class="col-md-4 my-note">
			<div class="card" id="capture">
				<div class="card-body">
					<center>
						<img class="mb-3" src="{{asset('img/logo2.png')}}" alt="" width="80">
						<p class="m-0">Real del Seminario #122, Col Valle del Real. Celaya, Gto</p>
					</center>
					<center>
						<p class="m-0">ventas@sellopronto.com.mx</p>
					</center>
					<hr>
					<div v-for="personal in order">
					<p class="m-0"><strong>Para:</strong> @{{personal.name}}</p>
					<p class="m-0"><strong>No Ticket:</strong> @{{personal.idOrder}}</p>
					<p class="m-0"><strong>WhatsApp:</strong> @{{personal.mobile}}</p>
					</div>
					<hr>
					<table class="table">
						<tr v-for = "ticket in lines">
							<td>@{{ticket.quantity}}</td>
							<td>@{{ticket.name}}<strong><small> @{{ticket.model}}</small></strong></td>
							<td>@{{ticket.total}}</td>
						</tr>
						<tr v-for = "ticket_total in totals">
							<td colspan="1"></td>
							<td colspan="1" align="right"><h6>Total</h6></td>
							<td colspan="1"><h6>@{{ticket_total.total_sum}}</h6></td>
						</tr>
						<tr v-for = "ticket_total in totals">
							<td colspan="1"></td>
							<td colspan="1" align="right"><h6>Anticipo</h6></td>
							<td colspan="1"><h6>@{{ticket_total.advance_payment}}</h6></td>
						</tr>
						<tr v-for = "ticket_total in totals">
							<td colspan="1"></td>
							<td colspan="1" align="right"><h6>Saldo</h6></td>
							<td colspan="1">
								<h6>
									<strong>@{{pago = ticket_total.total}}</strong>
									<strong v-if="pago == 0">Pagado</strong>
								</h6>
							</td>
						</tr>
					</table>
					<small><center>Ten a la mano tu ticket para que puedas recoger tu pedido. Si le pides a un amigo que lo recoga, asegúrate de reenviarle este ticket para que podamos entregarle</center></small>
					<small><center><strong>www.sellopronto.com.mx</strong></center></small>
				</div>
			</div>
		</div>
	</div>
	<!-- modal clientes -->
	<div class="modal fade" id="customers_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-scrollable">
			<div class="modal-content rounded-0">
				<div class="modal-header bg-dark rounded-0 text-white">
					<h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        			<button type="button" class="btn-close btn-light bg-light" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<table class="table" id="table_customers">
						<thead>
							<tr>
								<th>Nombre</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<tr v-for="customer in customers">
								<td>@{{customer.name}}</td>
								<td class="d-flex justify-content-end"><button class="btn btn-outline-dark" @click="addCustomer(customer.idContact)"><span class="bi bi-plus-circle"></span></button></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<!-- modal clientes -->

	<!-- modal agregar cliente -->
	<div class="modal fade" id="new_customers_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-scrollable">
			<div class="modal-content rounded-0">
				<div class="modal-header bg-dark rounded-0 text-white">
					<h5 class="modal-title" id="exampleModalLabel">Agregar Cliente</h5>
        			<button type="button" class="btn-close btn-light bg-light" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label for="">Nombre</label>
						<input type="text" class="form-control rounded-0 shadow-none" v-model="customer_name">
					</div>
					<div class="form-group">
						<label for="">WhatsApp</label>
						<input type="text" class="form-control rounded-0 shadow-none" v-model="customer_mobile">
					</div>
				</div>
				<div class="modal-footer">
					<button class="bt btn-outline-dark rounded-0" @click="save_customer()">Guardar</button>
				</div>
			</div>
		</div>
	</div>
	<!-- modal agregar cliente -->

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
							<tr v-for="article in articles">
								<td>@{{article.name}}</td>
								<td>@{{article.model}}</td>
								<td class="d-flex justify-content-end"><button class="btn btn-outline-dark" @click="addArticle(article.idArticle)"><span class="bi bi-plus-circle"></span></button></td>
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

	<!-- modal Disños-->
	<div class="modal fade" id="addArt" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-scrollable modal-sm">
			<div class="modal-content rounded-0">
				<div class="modal-header bg-dark rounded-0 text-white">
					<h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        			<button type="button" class="btn-close btn-light bg-light" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<label for="">Seleccionar Usuario</label>
					<select name="" id="" class="form-control rounded-0 shadow-none" v-model="user">
						<option value="">Seleccione</option>
						<option :value="user.id" v-for="user in users">@{{user.name}}</option>
					</select>
					<label for="">Instrucciones Adicionales</label>
					<input type="text" class="form-control rounded-0 shadow-none" v-model="instructions">
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-outline-dark rounded-0 d-flex float-right" data-bs-dismiss="modal" @click="add_to_design"><span class="bi bi-send"></span></button>
				</div>
			</div>
		</div>
	</div>
	<!-- modal diseños -->

	<!-- modal producción-->
	<div class="modal fade" id="addProduction" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-scrollable">
			<div class="modal-content rounded-0">
				<div class="modal-header bg-dark rounded-0 text-white">
					<h5 class="modal-title" id="exampleModalLabel"><span class="bi bi-gear"></span> Enviár a Producción</h5>
        			<button type="button" class="btn-close btn-light bg-light" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body" v-for = "line in order">
					<form @submit.prevent="saveImg_shop()" enctype="mulipart/form-data">
						<input type="file" name="" @change="getImage" id="file">
						<select name="" id="" class="form-control rounded-0 shadow-none mt-2" v-model="user">
							<option value="">Selecciona</option>
							<option :value="user.id" v-for="user in users">@{{user.name}}</option>
						</select>
					  	<input type="text" class="form-control rounded-0 shadow-none mt-2" placeholder="Detalles del sello"  v-model="art">
					  	<div class="d-flex justify-content-end">
					  		<button class="btn btn-outline-dark btn-sm rounded-0 shadow-none mt-2" type="submit" id="button-addon2">Agregar</button>
					  	</div>
				  	</form>
				</div>
			</div>
		</div>
	</div>
	<!-- modal producción -->

	<!-- modal envios-->
	<div class="modal fade" id="shipping_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-scrollable modal-sm">
			<div class="modal-content rounded-0">
				<div class="modal-header bg-dark rounded-0 text-white">
					<h5 class="modal-title" id="exampleModalLabel">Agregar Envío</h5>
        			<button type="button" class="btn-close btn-light bg-light" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label for="">Nombre de quien recibe</label>
						<input type="text" class="form-control rounded-0 shadow-none" v-model="recipients">
					</div>
					<div class="form-group">
						<label for="">Calle y numero</label>
						<input type="text" class="form-control rounded-0 shadow-none" v-model="street">
					</div>
					<div class="form-group">
						<label for="">Colonia</label>
						<input type="text" class="form-control rounded-0 shadow-none" v-model="zone">
					</div>
					<div class="form-group">
						<label for="">Población</label>
						<input type="text" class="form-control rounded-0 shadow-none" v-model="city">
					</div>
					<div class="form-group">
						<label for="">Día</label>
						<input type="date" class="form-control rounded-0 shadow-none" v-model="date">
					</div>
					<div class="form-group">
						<label for="">Hora</label>
						<input type="time" class="form-control rounded-0 shadow-none" v-model="hour">
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-outline-dark rounded-0" @click="add_address">Agendar</button>
					<button type="button" class="btn btn-outline-dark rounded-0 d-flex float-right" data-bs-dismiss="modal">Cerrar</button>
				</div>
			</div>
		</div>
	</div>
	<!-- modal envios -->

	<!-- Advertencia doble articulo -->
	<div class="modal fade" id="modal_warning" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-scrollable">
			<div class="modal-content rounded-0">
				<div class="modal-body">
					<div class="body-warning">
						<center><span class="bi bi-exclamation-diamond warning-icon"></span>
							<p class="m-0 warning-title">¡Opss!</p>
							<p class="m-0 warning-text">Este Articulo ya esta agregado</p>
							<p class="m-0 warning-ref text-danger">Has click en Ok para continuar</p>
						</center>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-outline-dark rounded-0" data-bs-dismiss="modal">Ok</button>
				</div>
			</div>
		</div>
	</div>
	<!-- Advertencia doble articulo -->
	<div>
		
	</div>
	
</div>
<script src="{{asset('js/modules/quotation.js')}}"></script>
@endsection