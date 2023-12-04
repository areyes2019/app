/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

//import $ from 'jquery';
//window.$ = window.jQuery = $
//require('./bootstrap');
//window.Vue = require('vue').default;
import './bootstrap';
import { createApp } from 'vue';

const app = createApp({});

import ExampleComponent from './components/ExampleComponent.vue';


/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

//app.component('user-info', require('./components/UserInfo.vue').default);
app.component('crud-component', require('./components/CrudComponent.vue').default);
app.component('store-component', require('./components/StoreComponent.vue').default);
app.component('shop-component', require('./components/ShopComponent.vue').default);
app.component('item-component', require('./components/ItemComponent.vue').default);
app.component('example-component', require('./components/ExampleComponent.vue').default);
app.component('table-component', require('./components/TableComponent.vue').default);
app.component('menu-component', require('./components/MenuComponent.vue').default);
app.component('contact-component', require('./components/ContactComponent.vue').default);
app.component('contacts-component', require('./components/ContactsComponent.vue').default);
app.component('woocommerce-component', require('./components/WoocommerceComponent.vue').default);
app.component('woolist-component', require('./components/WooArticlesListComponent.vue').default);
app.component('wooarticle-component', require('./components/WooArticleComponent.vue').default);
app.component('articles-component', require('./components/ArticlesComponent.vue').default);
app.component('cataloges-component', require('./components/CatalogesComponent.vue').default);
app.component('categories-component', require('./components/CategoriesComponent.vue').default);
app.component('quotations-component', require('./components/QuotationsComponent.vue').default);
app.component('quotation-component', require('./components/QuotationComponent.vue').default);
app.component('orders-component', require('./components/OrdersComponent.vue').default);
app.component('order-component', require('./components/OrderComponent.vue').default);
app.component('stock-component', require('./components/StockComponent.vue').default);
app.component('expenses-component', require('./components/ExpensesComponent.vue').default);
app.component('pos-component', require('./components/PosComponent.vue').default);
app.component('sale-component', require('./components/SaleComponent.vue').default);
app.component('production-component', require('./components/ProductionComponent.vue').default);


app.mount('#app');
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

/*const app = new Vue({
    el: '#app',
});*/
