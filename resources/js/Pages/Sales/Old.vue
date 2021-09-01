<template>
<layout :page_title="'Old Sales'">
 <div class="row layout-top-spacing" id="cancel-row">

     
                                         <div class="col-xl-7 col-lg-7 col-md-6 col-sm-12 col-12" style="margin-bottom:24px;">
                                        <div class="statbox widget box box-shadow">
                                            <vue-element-loading :active="isLoading" spinner="bar-fade-scale"  color="#009688" />
                                            <div class="widget-header">                                
                                                <div class="row">
                                                    <div class="col-xl-12 col-md-12 col-sm-12 col-12 p-4" >
                                                        <h2>Old Sales</h2>
                                                        <p>Please fill the following fields with appropriate information</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="widget-content widget-content-area">
                                                <form @submit.prevent="addToCart">
                                                    <div class="form-row">
                                                            <div class="form-group col-md-4">
                                                                <label for="staff">Date</label>
                                                                <input type="date" v-model="cart.date" class="form-control btn btn-info" placeholder="Select Date.." required>
                                                            </div>
                                                            
                                                        </div>

                                                        <div class="form-row mb-2">
                                                            <div class="form-group col-md-4">
                                                                <label for="staff">Staff</label>
                                                                <input type="text" class="form-control" id="staff" placeholder="Staff Name" disabled :value="$page.props.auth.user.name">
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <label for="inovice">Invoice Number</label>
                                                                <input type="text" class="form-control" id="inovice" disabled :value="invoice_number" placeholder="Invoice Number">
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                    <label for="inputState">Shift</label>
                                                                    <select id="inputState" @change="changeShift" class="form-control" v-model="shift">
                                                                        <option value='Morning'>Morning</option>
                                                                        <option value="Afternoon">Afternoon</option>
                                                                    </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group mb-2">
                                                            <label for="inputAddress">Select Product</label>
                                                            <cool-select
      v-model="sale.item"
      :items="products"
      :placeholder="sale.item ? '' : 'Select product'"
      item-text="name"
      disable-filtering-by-search
      @search="onSearch"
      @select="focusInput()"
    />
                                                            <!-- <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St"> -->
                                                        </div>
                                                        <div class="form-row mb-2">
                                                            <div class="form-group col-md-3">
                                                                <label for="instore">Instore</label>
                                                                <input type="text" :value="sale.item? sale.item.instore : '0'" class="form-control text-primary" disabled id="instore">
                                                            </div>
                                                            <div class="form-group col-md-3">
                                                                <label for="qty">Qty</label>
                                                                <input type="number" ref="qty" required  min="1" @change="calTotal" @keyup="calTotal" @blur="calTotal" v-model="sale.qty" class="form-control" id="qty">
                                                            </div>
                                                            <div class="form-group col-md-3">
                                                                <label for="sell">Selling Price</label>
                                                                <input type="number" :value="sale.item? sale.item.selling_price : '0'" disabled class="form-control" id="sell">
                                                            </div>
                                                            <div class="form-group col-md-3">
                                                                <label for="total">Total Cost</label>
                                                                <input type="number" v-model="sale.total" disabled class="form-control text-primary" id="total">
                                                            </div>
                                                            
                                                        </div>
                                                        <button type="submit" class="btn btn-success">Add to cart </button>
                                                    </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-5 col-lg-5 col-md-6  mb-4">
                                        <div class="card b-l-card-1 h-100 border-0" style="box-shadow: 0 0.1px 0px rgba(0, 0, 0, 0.002), 0 0.2px 0px rgba(0, 0, 0, 0.003), 0 0.4px 0px rgba(0, 0, 0, 0.004), 0 0.6px 0px rgba(0, 0, 0, 0.004), 0 0.9px 0px rgba(0, 0, 0, 0.005), 0 1.2px 0px rgba(0, 0, 0, 0.006), 0 1.8px 0px rgba(0, 0, 0, 0.006), 0 2.6px 0px rgba(0, 0, 0, 0.007), 0 3.9px 0px rgba(0, 0, 0, 0.008), 0 7px 0px rgba(0, 0, 0, 0.01);">
                                            <div class="card-body">
                                                <h5 class="card-title mt-2 d-inline-block">Cart | </h5>

                                                <strong class="card-category"> ({{ (cart.items)? cart.items.length : 0 }} item added)</strong>
                                                <div class="table-responsive"><!--style="min-height: 300px;" -->
                                                    <table class="table table-sm" >
                                                        <thead>
                                                            <tr>
                                                                <th>Item name</th>
                                                                <th>Qty</th>
                                                                <th>price</th>
                                                                <th>Total</th>
                                                                <th class="text-center">Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr v-for="(item, index) in cart.items" :key="item.id">
                                                                <td>{{item.item.name}}</td>
                                                                <td>{{item.qty}}</td>
                                                                <td>&#8358;{{item.item.selling_price}}</td>
                                                                <td>&#8358;{{item.qty * item.item.selling_price}}</td>
                                                                <td class="text-center">
                                                                    
                                                                    <div class="dropdown custom-dropdown">
                                                                        <a href="#" @click="delItem(index)">
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                                                        </a>

                                                                    </div>
                
                                                                </td>
                                                            </tr>       
                                                        </tbody>
                                                    </table>

                                                    <div class="inv--total-amounts">
                                                                        
                                                                            <div class="row mt-4">
                                                                                <div class="col-sm-5 col-12 col-lg-3 order-sm-0 order-1">
                                                                                </div>
                                                                                <div class="col-sm-7 col-12 col-lg-9 order-sm-1 order-0">
                                                                                    <div class="text-sm-right">
                                                                                        <div class="row">
                                                                                            <div class="col-sm-6 col-7">
                                                                                                <p class="">Sub Total: </p>
                                                                                            </div>
                                                                                            <div class="col-sm-6 col-5">
                                                                                                <p class="">&#8358; {{ subTotal(cart.items, "total")  }}</p>
                                                                                            </div>
                                                                                            <div class="col-sm-6 col-5 grand-total-title">
                                                                                                <h4 style="font-size: 1.1rem;" >Grand Total : </h4>
                                                                                            </div>
                                                                                            <div class="col-sm-6 col-7 grand-total-amount mb-4">
                                                                                                <h4 style="font-size: 1.1rem;">&#8358;  {{ subTotal(cart.items, "total") -  cart.discount }}</h4>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                
                                                                        </div>
                                                </div>

                                                 <form @submit.prevent="saveSales" class="mt-2">
                                                        <button type="submit" class="btn btn-lg btn-outline-success">Checkout</button>

                                                    </form>
                                            </div>
                                        </div>
                                    </div>

                                </div>
</layout>
</template>

<script>
import Layout from "../Layout/Layout.vue";
import { Inertia } from '@inertiajs/inertia';
import { CoolSelect } from "vue-cool-select";
import VueElementLoading from "vue-element-loading";

export default {
  // Using the shorthand
//   layout: Layout,

props : ['shift'],

  data: function () {
    return {
        products: [],
        product : {
            name : '',
            category_id : '',
            branch_id : '',
            cost_price : 0,
            selling_price : 0,
        },
        cart: {
            date : '',
            invoice: 0,
            items : [],
            discount: 0,
            mode: 'Cash',
        },
        sale : {
            shift: '',
            item: '',
            qty: 0,
            total: 0,
        },
        invoice_number : 0,
        isLoading: false,
    };
  },


created : function(){
    this.isLoading = true;
    $(document).ready(function(){
        $('.remove').remove();
    })
},

mounted : function(){
    if(localStorage.getItem("cart") != undefined){
        this.cart.items = JSON.parse(localStorage.getItem("old_cart"));
    }else{
        localStorage.setItem("old_cart",JSON.stringify([]));
    }
    this.getInvoiceNumber();
    this.isLoading = false;
},

components: {
'layout' : Layout,
    CoolSelect,
    VueElementLoading,
  },

  methods: {
      onSearch(search){
        const lettersLimit = 2;
        if (search.length > lettersLimit) {
            axios.get('/search/products?product='+search+'&branch=true' )
            .then( response => {
                this.products = response.data;
            });
        }
    },
      getInvoiceNumber(){
          axios.get('/api/invoice')
         .then( response => {
                this.cart.invoice = this.invoice_number = response.data.invoice;                        
            });
          
      },
saveSales(){
        this.cart.paid = this.subTotal(this.cart.items, "total")
        axios.post(route('sales.store'), this.cart)
        .then((response) => {
                localStorage.removeItem('old_cart')
                this.$inertia.visit('/sales');
            })
            .catch(error => {
                this.isLoading = false;
                let errors = error.response.data.errors;
                for (let field of Object.keys(errors)) {
                    this.$toast.error(errors[field][0], 'error');
                }
            })
},

subTotal(cart,index){
    if(cart != null){
        return cart.reduce((acc, item) => acc + item[index], 0);
    }
},

    calTotal(){
        this.sale.total = this.sale.qty * this.sale.item.selling_price;
    },
delItem(item){
    var delItem = [];
       if(localStorage.getItem("old_cart") != undefined){
         delItem = JSON.parse(localStorage.getItem("old_cart"));
         var i = delItem[item];
           if( i != null) {
               delItem.splice(item, 1);
               localStorage.setItem("old_cart",JSON.stringify(delItem));
           } else {
             this.$toast.error('There are no item in the Cart ', 'error');
           }
       }
    this.cart.items = JSON.parse(localStorage.getItem("old_cart"));
},
addToCart(){
if(this.sale.item.name != undefined){
    this.sale.shift = this.shift;
    var items = [];
 if(localStorage.getItem("old_cart") != undefined){
  items = JSON.parse(localStorage.getItem("old_cart"));
 }
 items.push(this.sale);
 localStorage.setItem("old_cart",JSON.stringify(items));
 this.cart.items = JSON.parse(localStorage.getItem("old_cart"));
this.sale = {};
}
},
    focusInput(){
        this.sale.qty = 0;
        this.$refs.qty.focus();
    },
changeShift(){
       axios.post(route('changeShift'), this.sale)
        .then((response) => {

            })
            .catch(error => {
                this.isLoading = false;
                let errors = error.response.data.errors;
                for (let field of Object.keys(errors)) {
                    this.$toast.error(errors[field][0], 'error');
                }
            })
},
storeProduct(){
          axios.post(route('products.store'), this.product)
        .then((response) => {
                this.$toast.success(response.data.success);
                this.product= {};
                $('#createModel').modal('hide');
                this.$inertia.visit('/sales/create');
            })
            .catch(error => {
                this.isLoading = false;
                let errors = error.response.data.errors;
                for (let field of Object.keys(errors)) {
                    this.$toast.error(errors[field][0], 'error');
                }
            });
      },
  }

};

</script>
