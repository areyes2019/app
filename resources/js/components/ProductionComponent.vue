<template>
    <div class="container">
       <div class="order-sheet">
         <div class="production_head" v-for="general in order_data">

            <p>Orden de Trabajo No: <span>{{id_job}}</span></p>
            <p>Pedido No: <span>{{general.idOrder}}</span></p>
            <p>Cliente: <span>{{general.name}}</span></p>
            <p>WhatsApp: <span>{{general.mobile}}</span></p>
         </div>
       </div>
    </div>
</template>

<script>
    import datatable from 'datatables.net-bs5'
    export default {
        props:['order'],
        data(){
            return{
                order_data:[],
                id_job:"",               
            }
        },
        methods:{
          get_data(){
            var me = this; 
            var url = '/order_list/'+ this.order;
            axios.get(url).then(function(response){
              me.order_data = response.data.general;
              me.details_data = response.data.details;
              me.id_job = response.data.id;
            }) 
          },
           
        },
        mounted() {
          this.get_data();            
        }
    }
</script>