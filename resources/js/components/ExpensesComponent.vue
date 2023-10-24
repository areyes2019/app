<template>
	<div class="container-fluid">
		<!-- Gastos -->	
	  	<h3 class="mt-4">{{month}} {{year}}</h3>
		<h5 class="mt-3">$2563.00</h5>
		<!-- Button trigger modal -->
		<button type="button" class="btn btn-danger rounded-0 shadow-none btn-sm mt-3 mb-3" @click="open_modal">
		  Registrar Gasto
		</button>
		<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content rounded-0">
              <div class="modal-header rounded-0 bg-color">
                <h5 class="modal-title" id="staticBackdropLabel">Seleccionar Cliente</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form action="add_spent" method="post">
                	<div class="form-group">
						<label for="">Concepto</label>
						<input type="text" v-model="data.description" placeholder="Concepto del gasto" class="form-control rounded-0 shadow-none">
                	</div>
  					<div class="form-group">
						<label for="">Monto</label>
						<input type="text" v-model="data.amount" placeholder="Concepto del gasto" class="form-control rounded-0 shadow-none">
                	</div>
  					<div class="form-group">
						<label for="">Cuenta</label>
						<input type="text" v-model="data.account" placeholder="Concepto del gasto" class="form-control rounded-0 shadow-none">
                	</div>
                	<button class="btn btn-danger rounded-0 shadow-none mt-3">Guardar</button>
  				</form>
              </div>
              
            </div>
          </div>
        </div>
		<table class="table table-bordered">
			<tr>
				<th>Fecha</th>
				<th>Concepto</th>
				<th>Monto</th>
				<th>Facturado</th>
				<th>Cuenta</th>
			</tr>
			<tr v-for = "data in list">
				<td>{{date_format(data.created_at)}}</td>
				<td>{{data.description}}</td>
				<td>{{data.amount}}</td>
				<td v-if="data.reference == 1">Facturado</td>
				<td v-if="data.reference == 2">Sin Factura</td>
				<td>{{data.account}}</td>
			</tr>
		</table>
	</div>
</template>
<script>
	import moment from "moment";
	export default{
		data(){
			return{
				list:[],
				data:[],
				moment:moment,
				month:"",
				year:"",
			}
		},
		methods:{
			open_modal(){
				$('#exampleModal').modal('show');
			},
			get_data(){
				var me = this;
				var url = '/show_spent';
				axios.get(url).then(function(response){
					me.list = response.data.data;
					me.month = response.data.month;
					me.year = response.data.year;
				})
			},
			add_data(){
				var me = this;
				var url = '/add_spent';
				axios.get(url,{
					'type':data.type,
					'account':data.account,
					'description':data.description,
					'reference':data.invoice,
					'amount':data.amount,
				}).then(function(response){
					me.get_data();
				})
			},
			date_format(d){
				return moment(d).format('DD-MMMM-YYYY')
			}

		},
		mounted(){
			this.get_data();
		}
	}
</script>