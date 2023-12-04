<template>
	<div class="container-fluid">
		<div class="card rounded-0">
			<div class="card-body">
				<button class="btn step-button rounded-0 shadow-none" @click="add_order()">Nueva Venta</button>
			</div>
		</div>

		<div class="row">
			<div class="col-5">
				<div class="list-pos">
					<div class="list-pos-child">
						<a href="" v-for="post in posts.data">
							<h4>Pedido: {{post.data.idOrder}} </h4>
							<p>Fecha:{{post.data.created_at}} </p>
							<p>Nombre: {{post.data.name}}</p>
							<p>Nombre: {{post.first_page}}</p>
						</a>
						<ul class="pagination">
	                		<li v-if="posts.prev_page_url">
			                    <a href="#" @click.prevent="getPosts(posts.prev_page_url)">Anterior</a>
			                </li>
			                <li v-if="posts.next_page_url">
			                    <a href="#" @click.prevent="getPosts(posts.next_page_url)">Siguiente</a>
			                </li>
	            		</ul>
					</div>
				</div>
				<nav>
	           
        </nav>
			</div>
			<div class="col-7">
				<div class="ticket-sheet">
				<div class="ticket-sheet-header">
					<div class="row">
						<div class="col-md-6">
							<img src="/img/logo2.png" alt="" height="50px">
						</div>
						<div class="col-md-6">
							<p>Pedido <span></span></p>
							<p>Fecha <span></span></p>
						</div>
					</div>
				</div>
				<div class="ticket-sheet-data">
					<p><span>Nombre:</span></p>
					<p><span>WhatsApp:</span></p>
				</div>
				<table class="table table-bordered" id="table">
					<tr>
						<th>Artículo</th>
						<th class="text-center">Cant.</th>
						<th>P/U</th>
						<th>Total</th>
						<th></th>
					</tr>
					<tr>
						<td></td>
						<td class="text-center"></td>
						<td>$</td>
						<td>$</td>
						<td>
							<a href="#" @click.prevent="delete_line(data.idDetail_order)"><span class="bi bi-x"></span></a>
						</td>
					</tr>
				</table>
				<div class="row">
					<div class="col-md-6">
						<p class="m-0"><strong>Direccion de entrega</strong></p>
						<p></p>
						<p class="mt-2 mb-0"><strong>Teléfono</strong></p>
						<p></p>
						<p><span><strong>Fecha de entrega</strong></span> {{data.delivery_day}} <span><strong>Hora de entrega</strong></span> </p>
					</div>
					<div class="col-md-6">
						<table class="table table-bordered">
							<tr>
								<th>Importe</th>
								<td>$</td>
							</tr>
							<tr>
								<th>Anticipo</th>
								<th>$</th>
							</tr>
							<tr>
								<th>Saldo</th>
								<td>$</td>
							</tr>
							<tr>
								<th>Envio</th>
								<td>$</td>
							</tr>
							
						</table>
					</div>
				</div>
				<div class="d-flex justify-content-end">
					<h4>Total a pagar: <span class="text-danger">$</span></h4>
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
		data(){
			return{
				posts:[],
				data:[],
				name:"sin definir",
				mobile:"sin definir",
				delivery:"",
				url:"/sale_list"
			}
		},
		methods:{
			getPosts(url) {
	            axios.get(url)
	                .then(response => {
	                    this.posts = response.data;
	                })
	                .catch(error => {
	                    console.error('Error al obtener los posts', error);
	                });
	        },
			open_modal(){
				$("#nueva_venta").modal('show');
			},
			add_order(){
				var me = this;
				var url = '/add_sale';
				let slug = Math.random().toString(36).substring(3);
				axios.post(url,{
					'slug':slug,
					'name':me.name,
					'mobile':me.mobile,
				}).then(function(response){
					window.location.href = "pos/"+slug;
				})
			},
			get_order_data(data){
				var me = this;
				var url = '/get_order_data/'+ data;
				axios.get(url).then(function(response){
					me.data=response.data;
					$('#nueva_venta02').modal('show');
				})
			},
			multi_step(){

				
			}
	
		},
		mounted(){
			this.get_data();
			this.multi_step();
		}
	}
</script>