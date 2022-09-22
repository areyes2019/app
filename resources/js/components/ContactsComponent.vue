<template>
	<div class="container">
		<div class="card-box">
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