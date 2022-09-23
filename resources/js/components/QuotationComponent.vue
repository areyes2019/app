<template>
    <div class="container">
        <div class="row">
            <div class="col-md-2">
                <div class="card-box-std p-2">
                    <ul class="my-list">
                        <li><a class="mr-2" href="" @click.prevent="sendMail">Enviar</a></li>
                        <li><a class="mr-2" :href="'/get_quotation_pdf/'+customer+'/'+id+'/down'">Descargar PDF</a></li>
                        <li><a :class="['mr-2', payment]" href="#" @click.prevent="approved">Enviar a Factura</a></li>
                        <li><a href="#" @click="deleteQuotation" >Eliminar</a></li>
                    </ul>
                </div>
                <div class="card-box-std p-3 mt-3">
                    <div class="d-grid gap-2 col-12 mx-auto mb-3">
                        <button :class="['btn', 'btn-danger', 'rounded-0', 'm-0', 'mr-2', display]" @click="openModal()">Agregar Artículos</button>
                    </div>
                    <div class="my-form-group d-flex justify-content-between align-items-center">
                        <p class="m-0 p-0">Desglosar Iva</p>
                        <label class="switch">
                          <input type="checkbox" :value="1">
                          <span class="slider"></span>
                        </label>
                    </div>
                    <hr>
                    <div class="my-form-group">
                        <p class="m-0 mr-2 p-0 align-self-center">Descuentos</p>
                        <div class="d-grid gap-2 col-12 mx-auto mb-3 mt-1">
                            <a href="#money" class="btn btn-danger rounded-0" data-bs-toggle="collapse">Descuento $</a>
                            <div class="collapse" id="money">
                                <div class="d-flex justify-content-between">
                                    <input type="text" class="form-control form-control-sm rounded-0 shadow-none" ref="money">
                                    <button class="btn btn-dark btn-sm " @click="addDiscount(1)"><span class="bi bi-check-square"></span></button>
                                </div>
                            </div>
                        </div>
                        <div class="d-grid gap-2 col-12 mx-auto mb-3 mt-1">
                            <a href="#percent" class="btn btn-danger rounded-0" data-bs-toggle="collapse">Descuento %</a>
                            <div class="collapse" id="percent">
                                <div class="d-flex justify-content-between">
                                    <div class="d-flex justify-content-between">
                                        <input type="text" class="form-control form-control-sm rounded-0 shadow-none" ref="percent">
                                        <button class="btn btn-dark btn-sm" @click="addDiscount(2)"><span class="bi bi-check-square"></span></button>
                                    </div>
                                </div>
                            </div>
                        </div>                       
                    </div>  
                </div>
            </div>
            <div class="col-md-10">
                <div class="card-box-std p-3">
                    <div class="row">
                        <div class="col-md-5" v-for="customer in customers">
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
                    </div>
                </div>
                <div class="card-box-std p-3 mt-3">
                    <table class="my-table-quotation">
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
                                    <input type="number" :value="line.quantity" class="form-control w-50" :id="line.idDetail" @change="addQuantity(line.idDetail)" :disabled = "disabled == 1">
                                </td>
                                <td>{{line.name}}</td>
                                <td>{{line.model}}</td>
                                <td>{{line.unit_price}}</td>
                                
                                <td>
                                    <div class="d-flex justify-content-between">
                                        <p class="m-0">{{line.total}}</p>
                                        <a href="" @click.prevent="deleteLine(line.idDetail)" :class="[display]">X</a>
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
                                <th>Dcto %{{total.percent}}</th>
                                <td>${{total.percent_amount}}</td>
                            </tr>
                            <tr>
                                <th colspan="3"></th>
                                <th>Dcto $</th>
                                <td>${{total.discount}}</td>
                            </tr>
                            <tr>
                                <th colspan="3"></th>
                                <th>IVA</th>
                                <td>
                                    <div>
                                        <p class="m-0">${{total.tax}}</p>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th colspan="3"></th>
                                <th>Anticipo</th>
                                <td>${{advance_payment}}</td>
                            </tr>                    
                            <tr>
                                <th colspan="3"></th>
                                <th>Total</th>
                                <td>$250.00</td>
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
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-danger rounded-0" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- agregar articulo del catalogo -->
    </div>
</template>

<script>
    import datatable from 'datatables.net-bs5'
    export default {
        props:['id','slug','customer','type'],
        data(){
            return{
                //styles
                tax_set:"",
                tax_style:"",
                color_badge:"",
                btn_state:"",
                quit_tax:"",
                status:"",
                discount:"",
                add_discount:"",
                articles:[],
                quotation:[],
                customers:[],
                lines:[],
                percent:"",
                money:"",
                quantity:"",
                //variables de descuentos
                money_discount:"",
                percent_discount:"",
                //suma de la cotización
                amount:"",
                discount:"",
                tax:"",
                advance_payment:"",
                total_amount:"",
                line:{
                    quantity:"",
                    model:"",
                    article:"",
                    price:"",
                },
                payment:"",
                display:"",
                disabled:0,
                total:{
                    amount:"", //esto es el sub-total
                    percent:"", // esto es el porcentaje de dcto
                    percent_amount:"", //esto es el descuetno en dinero con porcentaje
                    discount:"", //esto es el descuento en dinero
                    tax:"", 
                    total:"", //esto es el gran total
                }


               
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
                var refernce =this.$refs[item][0].value;
                var me = this;
                var url = "/quotations_add_line"
                axios.get('/quotation_double/'+me.id+'/'+item).then(function(response) {
                    
                    if (response.data==0) {
                        axios.post(url,{
                            'article':item,
                            'id':me.id,
                            'customer':me.customer,
                            'quantity':refernce
                        }).then(function(response){
                            me.showTotals();
                            me.showDetails();
                        })
                    }else{
                        alert('Este articulo ya esta agragado');
                    }
               })

            },

            getQuotation(){
                var me = this;
                var url = "/quotation/"+me.slug;
                axios.get(url).then(function(response){
                    me.quotation = response.data;
                    var status = response.data[0].status;
                    var payment = response.data[0].invoice;
                    
                })
            },
            //muestra las lineas en la cotizacion
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
            approved(){
                var me = this;
                var url = "/add_pay";

                Swal.fire({
                  title: '¿Quieres enviar a facturación?',
                  text: "Esta acción ya no se puede deshacer",
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Sí, enviar a facturación'
                }).then((result) => {
                  if (result.isConfirmed) {

                    axios.post(url,{
                        'slug':me.slug
                    }).then(function(response){
                        Swal.fire(
                          'Enviado',
                          'Tu cotización se fue a facturación',
                          'success'
                        )
                        location.reload();
                    })

                  }
                })
            },
            quitTax(){
                var me = this;
                var quotation = this.id;
                var slug = this.slug;
                var url = "/quit_tax";
                axios.post(url,{
                    'slug':slug,
                    'id':quotation
                }).then(function(response){
                    me.total.tax = 0;
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
                    
                    //suma total
                    var amount =  response.data.total;

                    //porcentaje de descuento
                    var percent = response.data.data[0].discount_type;

                    //descuento de porcentaje en dinero
                    var money_percent = amount/100 * percent;

                    //descuento en dinero
                    var money = response.data.data[0].discount;


                    //ahora vaciamos los datos al panel 
                    me.total.amount         = amount;
                    me.total.percent        = percent;
                    me.total.percent_amount = money_percent.toFixed(2);
                    me.total.discount       = money;
                    var num1 = money_percent;
                    var num2 = money;

                    var sum = parseFloat(num1) + parseFloat(num2)

                    
                    var sum_before_tax = amount - sum;

                    //aqui sacamos el IVA
                    var tax = sum_before_tax/100*16;

                    //acomodamos los deciamles
                    me.total.tax = tax.toFixed(2);
                    //prerapramos para sumar
                    var tax1 = parseFloat(tax);
                    var tax2 = parseFloat(sum_before_tax);
                    var grand_total = tax1 + tax2; 
                    me.total.total = grand_total.toFixed(2);
                    me.advance_payment = grand_total.toFixed(2) / 2 ;

                    
                })
            },
            addQuantity(data){
                var number = $("#"+data).val();
                var me = this;
                var url = '/add_quantity/'+data;
                axios.post(url,{
                    'quantity':number
                }).then(function(response){
                    me.showDetails();
                    me.showTotals();
                })
            },
            deleteLine(data){
                var me = this;
                var url = '/delete_line/'+data+'/'+this.id;
                axios.get(url).then(function(response){
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
                    me.showTotals();
                })
            },
            sendMail(){
                var me = this;
                var url = "/get_quotation_pdf/"+me.customer+'/'+me.id+"/send";
                axios.get(url).then(function(response){
                    alert('Correo enviado');
                })
            },
            table(){
                this.$nextTick(() => {
                    $('#articles_table').DataTable();
                });
            },

        },

        mounted() {
            this.showCutomerData();
            this.getQuotation();
            this.showDetails();
            this.showTotals();
        }
    }
</script>