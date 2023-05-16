<template>
<layout :page_title="'Reconcile'">
 <div class="row layout-top-spacing" id="cancel-row">

     
                                         <div class="col-xl-7 col-lg-7 col-md-6 col-sm-12 col-12" style="margin-bottom:24px;">
                                             
                                        <div class="statbox widget box box-shadow">
                                            <vue-element-loading :active="isLoading" spinner="bar-fade-scale"  color="#009688" />
                                            <div class="widget-header">                                
                                                <div class="row">
                                                    <div class="col-xl-12 col-md-12 col-sm-12 col-12 p-4" >
                                                        <h2>Reconcile</h2>
                                                        <p>Please fill the following fields with appropriate information</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="widget-content widget-content-area">
                                                <form @submit.prevent="addToCart">

                                                        <div class="form-group mb-4">
                                                            <label for="inputAddress">Select Product</label>
                                                            <cool-select
      v-model="purchase.item"
      :items="products"
      :placeholder="purchase.item ? '' : 'Select product'"
      item-text="name"
      @search="onSearch"
      @select="focusInput()"
    />
                                                        </div>
                                                        <div class="form-row mb-4">
                                                            <div class="form-group col">
                                                                <label for="instore">Instore</label>
                                                                <input type="number" :value="purchase.item? purchase.item.instore : '0'" class="form-control text-primary" disabled id="instore">
                                                            </div>
                                                            <div class="form-group col">
                                                                <label for="qty">Qty</label>
                                                                <input type="number" ref="qty" min="1" v-model="purchase.qty" required class="form-control" id="qty">
                                                            </div>

                                                            <div class="form-group col">
                                                                <label for="sell">Selling Price</label>
                                                                <input v-if="purchase.item" type="number" required v-model="purchase.item.selling_price"  class="form-control" id="sell">
                                                                <input v-else type="number" required value="0"  class="form-control" id="sell">
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

                                                <strong class="card-category"> ({{ cart.items.length }} item added)</strong>
                                                <div class="table-responsive"><!--style="min-height: 300px;" -->
                                                    <table class="table table-sm" >
                                                        <thead>
                                                            <tr>
                                                                <th>Item name</th>
                                                                <th>Qty</th>
                                                                <th>price</th>
                                                                <th class="text-center">Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr v-for="(item, index) in cart.items" :key="item.id">
                                                                <td v-if="item.item">{{item.item.name}}</td>
                                                                <td v-if="item.item">{{item.qty}}</td>
                                                                <td v-if="item.item">&#8358;{{item.item.selling_price}}</td>
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

                                                </div>

                                                 <form @submit.prevent="savePurchase" class="mt-2">
                                                        <button type="submit" class="btn btn-lg btn-outline-success">Reconcile</button>
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
            items : [],
        },
        purchase : {
            item : {
                selling_price : 0,
            },
        },
        isLoading: false,
        newSupplier : {},
    };
  },


created : function(){
    this.isLoading = true;
    $(document).ready(function(){
        $('.remove').remove();
    })
},

mounted : function(){
      
    if(localStorage.getItem("reconcile_cart") != undefined){
        this.cart.items = JSON.parse(localStorage.getItem("reconcile_cart"));
        this.purchase.invoice = this.cart.items[0]? this.cart.items[0].invoice : '';
    }else{
        localStorage.setItem("reconcile_cart",JSON.stringify([]));
    }
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

submitValid(){
    if(!this.cart.items[0]){
        this.$toast.error('Please add items to your cart.', 'error');
        return false;
    }
    
    return true;
},
savePurchase(){
        this.submitValid();
        axios.post('/reconciles', this.cart)
        .then((response) => {
                localStorage.removeItem('reconcile_cart');
                this.$inertia.visit('/reconciles');
                this.$toast.success(response.data.success);
            })
            .catch(error => {
                this.isLoading = false;
                let errors = error.response.data.errors;
                for (let field of Object.keys(errors)) {
                    if(errors[field][0] == "The invoice has already been taken."){
                
                    } 
                    this.$toast.error(errors[field][0], 'error');
                }
            })
},

 
delItem(item){
    var delItem = [];
       if(localStorage.getItem("reconcile_cart") != undefined){
         delItem = JSON.parse(localStorage.getItem("reconcile_cart"));
         var i = delItem[item];
           if( i != null) {
               delItem.splice(item, 1);
               localStorage.setItem("reconcile_cart",JSON.stringify(delItem));
           } else {
             this.$toast.error('There are no item in the Cart ', 'error');
           }
       }
    this.cart.items = JSON.parse(localStorage.getItem("reconcile_cart"));
},

addToCart(){

var items = [];
 if(localStorage.getItem("reconcile_cart") != undefined){
  items = JSON.parse(localStorage.getItem("reconcile_cart"));
 }
 items.push(this.purchase);
 localStorage.setItem("reconcile_cart",JSON.stringify(items));
 this.cart.items = JSON.parse(localStorage.getItem("reconcile_cart"));
 this.purchase.item = {};
 this.purchase.total = 0;
 this.$refs.qty = 0;

},
    focusInput(){
        console.log(this.purchase);
        this.purchase.qty = 0;
        this.$refs.qty.focus();
        // this.$nextTick(() => this.$refs.qty.focus())
    },

  }

};

</script>
