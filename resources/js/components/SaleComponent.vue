<template>
	<div class="container-fluid">
		<div class="card rounded-0">
			<div class="card-body">
				<a href="" class="btn btn-danger rounded-0" @click.prevent="add_order()">Agregar pedido</a>
			</div>
		</div>
		<table class="table table-bordered mt-3">
			<thead>
				<tr>
					<th>#</th>
					<th>Cliente</th>
					<th>Numero WhatsApp</th>
					<th>Proceso</th>
					<th>Entrega</th>
					<th>Img</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td><input type="text"></td>
					<td></td>
					<td><input type="text"></td>
					<td>
						<select name="" id="">
							<option value="">Escoge...</option>
							<option value="">Anticipo</option>
							<option value="">Diseño</option>
							<option value="">Elaborado</option>
							<option value="">Pagado</option>
							<option value="">Entregado</option>
						</select>
					</td>
					<td>
						<select name="" id="">
							<option value="">Escoge...</option>
							<option value="">Ocurre</option>
							<option value="">Domicilio</option>
						</select>
					</td>
				<tr>
					<td>52</td>
					<td>Martina Marcela</td>
					<td>461 350 9565</td>
					<td>Pagado</td>
					<td>A Domicilio</td>
					<td>
						<img src="img/model.png" alt="" width="90">
					</td>
				</tr>
				<tr>
					<td>52</td>
					<td>Martina Marcela</td>
					<td>461 350 9565</td>
					<td>Pagado</td>
					<td>Ocurre</td>
					<td>
						<img src="img/model.png" alt="" width="90">
					</td>
				</tr>
				<tr>
					<td>52</td>
					<td>Martina Marcela</td>
					<td>461 350 9565</td>
					<td>Pagado</td>
					<td>Ocurre</td>
					<td>
						<img src="img/model.png" alt="" width="90">
					</td>
				</tr>
			</tbody>
		</table>
	</div>
</template>
<script>
	import VueSelect from 'vue-select'
	import 'vue-select/dist/vue-select.css';
	export default{
		data(){
			return{

			}
		},
		methods:{
			add_order(){
				var me = this;
				var url = '/add_sale_slug';
				let slug = Math.random().toString(36).substring(3);
				axios.post(url,{
					'slug':slug,
				}).then(function(response){
					window.location.href = 'add_sale'+'/'+slug;
				})
			}
		},
		mounted(){

		}
	}
</script>