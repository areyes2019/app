<template>
	<div class="container-fluid">
		<div class="card rounded-0">
			<div class="card-body">
				<button class="btn step-button rounded-0 shadow-none" @click="add_order()">Nueva Venta</button>
			</div>
		</div>

		<div class="row">
			<div class="col-3">
				<div class="list-pos">
					<div class="list-pos-child">
						<div class="list-pos-link">
							<p><span>Pedido:</span>456</p>
							<p><span>Fecha:</span>12/03/23</p>
						</div>
						<p>Abdias Reyes Reyna</p>
						<div class="d-flex justify-content-between align-items-center">
							<div class="d-block">
								<p>Envio a domicilio</p>
								<p>Saldo: <span class="text-danger">$250.00</span></p>
							</div>
							<a href="" class="btn btn-danger rounded-0 btn-sm"><span class="bi bi-arrow-right-short"></span></a>
						</div>
					</div>
					<div class="list-pos-child">
						<div class="list-pos-link">
							<p><span>Pedido:</span>456</p>
							<p><span>Fecha:</span>12/03/23</p>
						</div>
						<p>Patricia Ortega Durán</p>
						<div class="d-flex justify-content-between align-items-center">
							<div class="d-block">
								<p>Envio a domicilio</p>
								{{slug}}
								<p>Saldo: <span class="text-danger">$250.00</span></p>
							</div>
							<a href="" class="btn btn-danger rounded-0 btn-sm"><span class="bi bi-arrow-right-short"></span></a>
						</div>
					</div>
					<div class="list-pos-child">
						<div class="list-pos-link">
							<p><span>Pedido:</span>456</p>
							<p><span>Fecha:</span>12/03/23</p>
						</div>
						<p>Esteban Labrego Martínez</p>
						<div class="d-flex justify-content-between align-items-center">
							<div class="d-block">
								<p>Envio a domicilio</p>
								<p>Saldo: <span class="text-danger">$250.00</span></p>
							</div>
							<a href="" class="btn btn-danger rounded-0 btn-sm"><span class="bi bi-arrow-right-short"></span></a>
						</div>
					</div>
					
				</div>
			</div>
			<div class="col-9">

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
				data:[],
				name:"sin definir",
				mobile:"sin definir",
				delivery:"",
			}
		},
		methods:{
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
			this.multi_step();

		}
	}
</script>