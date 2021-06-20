<template>
<layout :page_title="'Edit invoice'">
 <div class="row layout-top-spacing" id="cancel-row">

     
                                         <div class="col-xl-7 col-lg-7 col-md-6 col-sm-12 col-12" style="margin-bottom:24px;">
                                        <div class="statbox widget box box-shadow">
                                            <div class="widget-header">                                
                                                <div class="row">
                                                    <div class="col-xl-12 col-md-12 col-sm-12 col-12 p-4" >
                                                        <h2>Editing #{{ invoice_number }}</h2>
                                                        <p>Please fill the following fields with appropriate information</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="widget-content widget-content-area">
                                                <form @submit.prevent="addToCart">
                                                        <div class="form-row mb-4">
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
                                                                    <select id="inputState" @change="changeShift" class="form-control" v-model="sale.shift">
                                                                        <option value='Morning'>Morning</option>
                                                                        <option value="Afternoon">Afternoon</option>
                                                                    </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group mb-4">
                                                            <label for="inputAddress">Select Product </label>
                                                            <cool-select
      v-model="sale.item"
      :items="products"
      :placeholder="sale.item ? '' : 'Select product'"
      item-text="name"
      @select="focusInput()"
    />
                                                            <!-- <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St"> -->
                                                        </div>
                                                        <div class="form-row mb-4">
                                                            <div class="form-group col-md-3">
                                                                <label for="instore">Instore</label>
                                                                <input type="text" :value="sale.item? sale.item.instore : '0'" class="form-control text-primary" disabled id="instore">
                                                            </div>
                                                            <div class="form-group col-md-3">
                                                                <label for="qty">Qty</label>
                                                                <input type="number" ref="qty" @change="calTotal" @keyup="calTotal" @blur="calTotal" v-model="sale.qty" class="form-control" id="qty">
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

                                                <strong class="card-category"> ({{ cart.items.length }} item added)</strong>
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
                                                                                            <div class="col-sm-6 col-7">
                                                                                                <p class=" discount-rate">Discount :</p>
                                                                                            </div>
                                                                                            <div class="col-sm-6 col-5">
                                                                                                <p class=""><input type="number" v-model="cart.discount" class="form-control"> </p>
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

                                                 <form @submit.prevent="updateSales" class="mt-2">

                                                        <div class="form-row mb-2">
                                                            <div class="form-group col-md-6">
                                                                <label for="paid">Paid</label>
                                                                <input type="number" class="form-control"  v-model="cart.paid" :min="subTotal(cart.items, 'total') -  cart.discount" id="paid" required placeholder="Enter Amount">
                                                            </div>

                                                            <div class="form-group col-md-6">
                                                                <label for="mode">Mode Payment</label>
                                                                <select id="mode" v-model="cart.mode" class="form-control">
                                                                    <option selected="">Cash</option>
                                                                    <option>Pos</option>
                                                                    <option>Transfer</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        
                                                        <button type="submit" class="btn btn-lg btn-outline-success">Update</button>

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

export default {
  // Using the shorthand
//   layout: Layout,

props : ['invoice_number', 'shift', 'products', 'formated'],

  data: function () {
    return {
        product : {
            name : '',
            category_id : '',
            branch_id : '',
            cost_price : 0,
            selling_price : 0,
        },
        cart: {
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
        
    };
  },


created : function(){
    $(document).ready(function(){
        App.init();
        $('.remove').remove();
    })
},

mounted : function(){
    this.sale.shift = this.shift;
    this.cart.invoice = this.invoice_number;
    this.cart.items = this.formated.items
    this.cart.discount = this.formated.discount
    this.cart.mode = this.formated.mode
    this.cart.paid = this.formated.paid
},

components: {
'layout' : Layout,
    CoolSelect
  },

  methods: {
updateSales(){
    if(this.cart.discount < this.subTotal(this.cart.items, "total")){
        
        axios.put(route('sales.update',{'sale': this.cart.invoice}), this.cart)
        .then((response) => {
            this.$inertia.visit('/invoices/'+this.cart.invoice);
            })
            .catch(error => {
                this.isLoading = false;
                let errors = error.response.data.errors;
                for (let field of Object.keys(errors)) {
                    this.$toast.error(errors[field][0], 'error');
                }
            })


    }else{
        this.$toast.error("Discount can't greater than or equal to Total cost", 'error');
    }
},

subTotal(cart,index){
   return cart.reduce((acc, item) => parseInt(acc) + parseInt(item[index]), 0);
},

    calTotal(){
        this.sale.total = this.sale.qty * this.sale.item.selling_price;
    },
delItem(item){

         var handle = this.cart.items;
        //  console.log(this.cart.items)
         var i = handle[item];
           if( i != null) {
               if(i.ref != undefined){
                   axios.delete(route('sales.destroy',{'sale': i.ref }))
                    .then((response) => {

                    })
                    .catch(error => {
                        let errors = error.response.data.errors;
                        for (let field of Object.keys(errors)) {
                            this.$toast.error(errors[field][0], 'error');
                        }
                    });
               }
               handle.splice(item, 1);
           } else {
             this.$toast.error('There are no item in the Cart ', 'error');
           }
    this.cart.items = handle;
},
addToCart(){
 this.cart.items.push(this.sale);
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
