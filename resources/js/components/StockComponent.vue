<template>
	<div class="container-fluid">
		<h3>Inventario</h3>
		<div class="row">
			<div class="col-md-4">
				<div class="card">
		            <div class="card-body">
		                <h5 class="card-title">Valor Total</h5>
		                <h6 class="card-subtitle mb-2 text-muted">Valor bruto del inventario</h6>
		                <h4>${{total_value}}</h4>
		                <a href="#" class="card-link">Ir a resumen</a>
		            </div>
		        </div>
			</div>
			<div class="col-md-4">
				<div class="card">
		            <div class="card-body">
		                <h5 class="card-title">Valor Beneficio</h5>
		                <h6 class="card-subtitle mb-2 text-muted">Valos de las utilidades del inventario</h6>
		                <h4>${{profit}}</h4>
		                <a href="#" class="card-link">Ir a resumen</a>
		            </div>
		        </div>
			</div>
			<div class="col-md-4">
				<div class="card">
		            <div class="card-body">
		                <h5 class="card-title">Valor invertido</h5>
		                <h6 class="card-subtitle mb-2 text-muted">Valor de productos en iventario</h6>
		                <h4>${{investment}}</h4>
		                <a href="#" class="card-link">Ir a resumen</a>
		            </div>
		        </div>
			</div>
		</div>
		<div class="card mt-4">
			<div class="card-body">
				<div class="row">
					<div class="col">
						<label for="">Cantidad</label>
						<input type="number" class="form-control shadow-none rounded-0" min="1" v-model="quantity">
					</div>
					<div class="col">
						<label for="">Artículo</label>
						<input type="text" class="form-control shadow-none rounded-0" @keyup="search_list" v-model="search">
						<div class="hlist">
							<a  href="" @click.prevent="list_value(data.idArticle)" v-for="data in result" :id="data.idArticle">{{data.name}}</a>
						</div>
					</div>
					<div class="col d-flex align-items-end">
						<button class="btn btn-danger" @click="update_stock">Guardar</button>
					</div>
				</div>
			</div>
		</div>
		<h3 class="mt-4">Lista de existencias</h3>
		<table class="table table-bordered mt-1">
			<tr>
				<th>#</th>
				<th>Cant</th>
				<th>Artículo</th>
				<th>Modelo</th>
				<th>P/U</th>
				<th>Total</th>
			</tr>
			<tr v-for = "list in data">
				<td>{{list.idStock}}</td>
				<td>{{list.quantity}}</td>
				<td>{{list.name}}</td>
				<td>{{list.model}}</td>
				<td>${{list.cost}}</td>
				<td class="d-none">{{sum = list.cost * list.quantity}}</td>
				<td>${{res = sum.toFixed(2)}}</td>
			</tr>
		</table>
	</div>
</template>
<script>
	import datatable from 'datatables.net-bs5'
	export default{
		data(){
			return{
				data:[],
				search:"",
				result:[],
				quantity:"",
				article:"",
				total_value:"",
				profit:"",
				investment:"",
			}
		},
		methods:{
			get_data(){
				var me=this;
				var url = '/show_stock';
				axios.get(url).then(function(response){
					me.data = response.data.table;
					me.total_value = response.data.total_value;
					me.profit = response.data.profit;
					me.investment = response.data.investment;
				})
			},
			search_list(){
				var me = this;
				var url = 'search_stock';
				axios.post(url,{
					'data': me.search
				}).then(function(response){
					
					if (response.data == 0) {
						me.result = ""
					}else{
						me.result = response.data;
					}
				})
			},
			list_value(data){
				var text = $("#"+data).text();
				this.search = text;
				this.result ="";
				this.article = data;
			},
			update_stock(){
				var me = this;
				var url = '/update_stock';
				axios.post(url,{
					'qty':me.quantity,
					'article':me.article
				}).then(function(response){
					me.get_data();
					me.article = "";
					me.quantity = "";
					me.search = "";
				})
			}
		},
		mounted(){
			this.get_data();
		}
	}
</script>