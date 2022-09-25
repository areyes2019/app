<template>
    <div class="container">
        <div class="row">
            <div class="col-md-2">
                <div class="card-box-std p-2">
                    <ul class="my-list">
                        <li><a class="mr-2" href="" @click.prevent="sendMail">Enviar</a></li>
                        <li><a class="mr-2" :href="'/get_quotation_pdf/'+customer+'/'+id+'/down'">Descargar PDF</a></li>
                        <li><a :class="['mr-2']" href="#" @click.prevent="approved">Enviar a Factura</a></li>
                        <li><a href="#" @click="deleteQuotation" >Eliminar</a></li>
                    </ul>
                </div>
                <div class="card-box-std p-3 mt-3">
                    <div class="d-grid gap-2 col-12 mx-auto mb-3">
                        <button :class="['btn', 'btn-danger', 'rounded-0', 'm-0', 'mr-2']" @click="openModal()">Agregar Artículos</button>
                    </div>
                    <!-- con iva -->
                    <div class="my-form-group d-flex justify-content-between align-items-center">
                        <p class="m-0 p-0" v-if="tax==1">Con Factura</p>
                        <p class="m-0 p-0" v-if="tax==0">Sin Factura</p>
                        <label class="switch">
                          <input type="checkbox"  v-model ="tax" @change="tax_free">
                          <span class="slider"></span>
                        </label>
                    </div>
                    <!-- con iva -->
                    <hr>
                    <div class="my-form-group">
                        <h5 class="m-0 mr-2 p-0 align-self-center">Descuentos</h5>
                        <div class="d-grid gap-2 col-12 mx-auto mb-3 mt-1">
                            <a href="#money" class="btn btn-danger rounded-0" data-bs-toggle="collapse">Descuento $</a>
                            <div class="collapse" id="money">
                                <div class="d-flex justify-content-between">
                                    <input type="text" class="form-control form-control-sm rounded-0 shadow-none" ref="money" v-model="money">
                                    <button class="btn btn-dark btn-sm " @click="addDiscount(1)"><span class="bi bi-check-square"></span></button>
                                </div>
                            </div>
                        </div>
                        <div class="d-grid gap-2 col-12 mx-auto mb-3 mt-1">
                            <a href="#percent" class="btn btn-danger rounded-0" data-bs-toggle="collapse">Descuento %</a>
                            <div class="collapse" id="percent">
                                <div class="d-flex justify-content-between">
                                    <div class="d-flex justify-content-between">
                                        <select name="" id="" ref="percent" v-model="percent" class="form-control">
                                            <option value="0">0%</option>
                                            <option value="5">5%</option>
                                            <option value="10">10%</option>
                                            <option value="15">15%</option>
                                            <option value="20">20%</option>
                                            <option value="25">25%</option>
                                            <option value="30">30%</option>
                                        </select>
                                        <button class="btn btn-dark btn-sm" @click="addDiscount(2)"><span class="bi bi-check-square"></span></button>
                                    </div>
                                </div>
                            </div>
                        </div>                       
                    </div>
                    <hr>
                    <div class="my-form-group">
                        <h5 class="m-0 mr-2 p-0 align-self-center">Cambiar Estatus</h5>
                        <div class="d-grid gap-2 col-12 mx-auto mb-3 mt-1">
                            <p v-if="status==0">Cotización en borrador</p>
                            <button class="btn btn-danger rounded-0" v-if="status==1" @click="change_status(2)">Aprobada</button>
                            <button class="btn btn-danger rounded-0" v-if="status==2" @click="change_status(3)">Pagada</button>
                            <button class="btn btn-danger rounded-0" v-if="status==3" @click="change_status(4)">Facturar</button>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-10">
                <div class="card-box-std p-3">
                    <div class="row">
                        <div class="col-md-5">
                            <div v-for="customer in customers">
                                <div class="mb-3" v-for="item in quotation">
                                    <p class="m-0">No: <span>{{item.idQt}}</span></p>
                                    <p class="m-0">Fecha: <span>{{item.created_at}}</span></p>
                                </div>
                                
                                <p class="m-0">Para: <span>{{customer.company}}</span></p>
                                <p class="m-0">Con Att.: <span>{{customer.name}}</span></p>
                                <p class="m-0"><strong>{{customer.email}}</strong></p>
                                <p class="m-0">Tipo:
                                    <strong v-if="customer.type == 0">Cliente Regular</strong>
                                    <strong v-else="customer.type == 1">Distribuidor</strong>
                                </p>
                            </div>
                            <h5 class="mt-1" v-if="status==0"><span class="badge bg-secondary">Borrador</span></h5>
                            <h5 class="mt-1" v-if="status==1"><span class="badge bg-primary">Enviada</span></h5>
                            <h5 class="mt-1" v-if="status==2"><span class="badge bg-success">Aprobada</span></h5>
                            <h5 class="mt-1" v-if="status==3"><span class="badge bg-danger">Pagada</span></h5>
                            <h5 class="mt-1" v-if="status==4"><span class="badge bg-dark">Facturada</span></h5>
                        </div>
                    </div>
                </div>
                <div class="card-box-std p-3 mt-3">
                    <div class="card-box-std p-3" v-if="lines == 0">
                        <p>No hay articulos en tu cotización</p>
                    </div>
                    <table class="my-table-quotation" v-if="lines != 0">
                        <thead>
                            <tr>
                                <th>CANT.</th>
                                <th>ARTÍCULO</th>
                                <th>MODELO</th>
                                <th>P/UNITARIO</th>
                                <th>TOTAL</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="line in lines">
                                <td>
                                    <input type="number" :value="line.quantity"  :id="line.id" @change="addQuantity(line.id)" :disabled = "disabled == 1">
                                </td>
                                <td>{{line.name}}</td>
                                <td>{{line.model}}</td>
                                <td>{{line.unit_price}}</td>
                                
                                <td>
                                    <div class="d-flex justify-content-between">
                                        <p class="m-0">{{line.total}}</p>
                                        <a href="" @click.prevent="deleteLine(line.id)" :class="[display]">X</a>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="3"></th>
                                <th >Sub-Total</th>
                                <td>${{total.amount}}</td>
                            </tr>
                            <tr>
                                <th colspan="3"></th>
                                <th>Dcto %</th>
                                <td>${{total.percent}}</td>
                            </tr>
                            <tr>
                                <th colspan="3"></th>
                                <th>Dcto $</th>
                                <td>${{total.money}}</td>
                            </tr>
                            <tr v-if="tax==1">
                                <th colspan="3"></th>
                                <th>IVA</th>
                                <td>
                                    <div>
                                        <p class="m-0">${{total.tax}}</p>
                                    </div>
                                </td>
                            </tr>
                            <tr v-if="total.advance > 0">
                                <th colspan="3"></th>
                                <th>Anticipo</th>
                                <td>{{total.advance}}</td>
                            </tr>                    
                            <tr>
                                <th colspan="3"></th>
                                <th>Total</th>
                                <td>${{total.total}}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>

        <!-- modal agregar articulo del catalogo -->
        <div class="modal fade" id="addArticle" tabindex="-1" role="dialog" aria-labelledby="exampleModal3Label" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content rounded-0 ">
                    <div class="modal-header bg-color text-white rounded-0">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <table class="my-sm-table" id="articles_table">
                            <thead>
                                <tr>
                                    <th class="p-2">Sello</th>
                                    <th class="p-2">Modelo</th>
                                    <th class="p-2">Cant.</th>
                                    <th class="p-2"><span class="bi bi-check-square"></span></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="list in articles">
                                    <td>{{list.name}}</td>
                                    <td>{{list.model}}</td>
                                    <td >
                                        <input type="number" min="1" value="1" :ref="list.idArticle" size="5">
                                    </td>
                                    <td>
                                        <a href="" @click.prevent="addArticle(list.idArticle)"><span class="bi bi-plus-circle-dotted"></span></a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    
                </div>
            </div>
        </div>
        <!-- agregar articulo del catalogo -->
        <!-- Advertencia doble articulo -->
        <div class="modal fade" id="modal_warning" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content rounded-0">
                <div class="modal-body">
                    <div class="body-warning">
                        <center><span class="bi bi-exclamation-diamond warning-icon"></span>
                        <p class="m-0 warning-title">¡Opss!</p>
                        <p class="m-0 warning-text">Este Artículo ya esta agregad.</p>
                        <p class="m-0 warning-ref text-danger">¿Desas continuar?</p>
                        </center>
                    </div>
                </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Ok</button>
              </div>
            </div>
          </div>
        </div>
    </div>
</template>

<script>
   export default{
        props:['id','slug','customer','type'],
        data(){
            return{
                percent:"",
                money:"",
                quotation:[],
                articles:[],
                lines:[],
                customers:[],
                display:"",
                disabled:0,
                tax:"",
                status:"",
                total:{
                    amount:"", //esto es el sub-total
                    percent:"", // esto es el porcentaje de dcto
                    money:"", //esto es el descuetno en dinero con porcentaje
                    tax:"", 
                    total:"", //esto es el gran total
                    advance:""
                },
            }
        },
        methods:{
            openModal(){
                var me = this;
                axios.get('/articles_show').then(function(response) {
                    me.articles = response.data;
                    me.table();
                    $('#addArticle').modal('show');
                })
            },
            addArticle(item){
                //console.log(this.id);
                var quantity =this.$refs[item][0].value;
                var me = this;
                var url = "/quotations_add_line";
                axios.post(url,{
                    'id':me.id,//id de cotizacion
                    'quantity':quantity,//cantidad
                    'article':item,//id de articulo
                }).then(function(response){
                    if (response.data==1) {
                        $('#modal_warning').modal('show');
                    }
                    me.showDetails();
                    me.showTotals();
                }).catch(function(errors){

                });
                

            },
            getQuotation(){
                var me = this;
                var url = "/quotation/"+me.slug;
                axios.get(url).then(function(response){
                    me.quotation = response.data;
                    me.status = response.data[0].status;
                    var payment = response.data[0].invoice;
                    me.tax = response.data[0].with_tax
                    
                })
            },
            showDetails(){
                var me = this;
                var url = "/quotations_show_lines/"+me.id;
                axios.get(url).then(function(response){
                    me.lines = response.data;
                })
            },
            showCutomerData(){
                var me = this;
                var url = "/quotation_customer/"+ me.customer
                axios.get(url).then(function(response){
                    me.customers=response.data;
                })
            },
            change_status(data){
                var status="";
                if (data==2) {
                    if (window.confirm("¿Realmente quieres cambiar el etatus?. Esta acción ya no se puede revertir")) {
                        var status = 2;
                        this.status_fun(2);
                    }
                    
                }else if (data==3) {
                    if (window.confirm("¿Realmente quieres cambiar el etatus?. Esta acción ya no se puede revertir")) {
                        var status = 3;
                        this.status_fun(3);
                    }
                }else if (data==4) {
                    if (window.confirm("¿Realmente quieres cambiar enviar a facturación?. Una vez enviada la cotización, se cierra")) {
                        var status = 4;
                        this.status_fun(4);
                    }
                }
            },
            status_fun(data){
                var me = this;
                var url = "/change_status/"+this.slug;
                axios.post(url,{
                    'status':data
                }).then(function(response){
                    if (response.data == 1) {
                        me.getQuotation(); 
                    }
                }).catch(function(errors){

                });
            },
            tax_free(){
                var me = this;
                if (this.tax==false) {
                    this.tax = 0;
                }else{
                    this.tax = 1;
                }
                var url = "/tax_add";
                axios.post(url,{
                    'id':me.id,
                    'tax':me.tax
                }).then(function(response){
                    me.showTotals();
                    me.getQuotation();
                })
            },
            deleteQuotation(){
                var me = this;
                var url = "/quotation_delete/";
                if (window.confirm("¿Realmente quieres eliminar esta cotización?")) {
                    axios.get(url+me.id).then(function(response){
                        if (response.data = 1) {
                            alert('Registro elminado');   
                            window.location.href = "/quotations/";
                        }else{
                            alert('No se elmino el registro');
                        }
                    })
                }
            },
            showTotals(){
                var me = this;
                var url = "/show_totals/"+ this.id;
                axios.get(url).then(function(response){
                    var tax = response.data.summary[0].with_tax;
                    if (tax == 1) {
                        //sacamos el subtotal
                        var sub_total = response.data.sub_total;                      
                        var tax = sub_total/1.16;
                        var fix = tax.toFixed(2);
                        me.total.amount = fix;
                        //traemo el descuento en $
                        me.total.money = response.data.summary[0].money_discount;
                        var money = response.data.summary[0].money_discount;
                        //traemo el descuento en %
                        me.total.percent = response.data.summary[0].percent_discount;
                        var percent = response.data.summary[0].percent_discount;
                        //hacemos la cuenta 
                        var firt_discount = fix/100 * percent;
                        var second_discount = fix - firt_discount;
                        var money_discount = second_discount - money;
                        
                        //sacamos el iva
                        var total_tax = money_discount/100 * 16;
                        me.total.tax = total_tax.toFixed(2); 
                        
                        //sacamos el gran total
                        var gran_total = money_discount + total_tax;
                        me.total.total = gran_total.toFixed(2);
                    } else{
                        //sacamos el subtotal
                        me.total.amount = response.data.sub_total;
                        
                        //traemos el descuento en $
                        me.total.money = response.data.summary[0].money_discount;
                        var money = response.data.summary[0].money_discount;
                        
                        //traemo el descuento en %
                        me.total.percent = response.data.summary[0].percent_discount;
                        var percent = response.data.summary[0].percent_discount;
                        
                        //hacemos la cuenta 
                        var firt_discount = response.data.sub_total / 100 * percent;
                        var second_discount = response.data.sub_total - firt_discount;
                        var money_discount = second_discount - money;
                        me.total.tax = ""
                        me.total.total = money_discount;
                    }
                    
                    
                })
            },
            addQuantity(line){
                //console.log(number);
                var number = $("#"+line).val();
                var me = this;
                var url = '/add_quantity/'+line;
                axios.post(url,{
                    'quantity':number,
                    'id':me.id
                }).then(function(response){
                    me.showDetails();
                    me.showTotals();
                })
            },
            deleteLine(line){
                var me = this;
                var url = '/delete_line/'+line;
                axios.post(url,{
                    'id_qt':me.id
                }).then(function(response){
                    me.showDetails();
                    me.showTotals();
                })
            },
            addDiscount(data){
                
                if (data==1) {
                    //el descuento es en dinero
                    var discount = this.$refs.money.value;
                }else if(data==2){
                    //el descuento es en porcentaje
                    var discount = this.$refs.percent.value;
                }

                var me = this;
                var url = '/add_discount';
                var id = this.id;
                var slug = this.slug;
                axios.post(url,{
                    'id':id,
                    'slug':slug,
                    'discount':discount,
                    'type':data,
                }).then(function(response){
                    me.percent = response.data;
                    me.showDetails();
                    me.showTotals();
                    me.percent = "";
                    me.money = "";
                })
            },
            table(){
                this.$nextTick(() => {
                    $('#articles_table').DataTable();
                });
            },


        },
        mounted(){
            this.showCutomerData();
            this.getQuotation();
            this.showTotals();
            this.showDetails();
        }
   }
</script>