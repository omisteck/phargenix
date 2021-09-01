<template>
<layout :page_title="'Edit invoice'">
 <div class="row layout-top-spacing" id="cancel-row">

     
                                         <div class="col-xl-7 col-lg-7 col-md-6 col-sm-12 col-12" style="margin-bottom:24px;">
                                        <div class="statbox widget box box-shadow">
                                            <div class="widget-header">                                
                                                <div class="row">
                                                    <div class="col-xl-12 col-md-12 col-sm-12 col-12 p-4" >
                                                        <h2>Editing #{{ data[0].invoice }}</h2>
                                                        <p>Please fill the following fields with appropriate information</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="widget-content widget-content-area">
                                                <form @submit.prevent="addToCart">
                                                        <div class="form-row mb-4">
                                                            <div class="form-group col-md-6">
                                                                <label for="inovice">Invoice Number <a href="#" class="badge badge-primary p-2" v-if="changeInvoice" @click="enableChange" >Change</a></label>
                                                                <input type="text" required v-model="purchase.invoice"  :readonly="invoiceSet" @keyup="changeInvoiceNumber" @keydown="changeInvoiceNumber" class="form-control" id="inovice" placeholder="Invoice Number">
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label for="staff">Date</label>
                                                                <input type="date" required :readonly="invoiceSet" @change="changeInvoiceNumber" v-model="purchase.date" class="form-control" id="staff" placeholder="Date">
                                                            </div>
                                                        </div>
                                                        <div class="form-group mb-4">
                                                            <label for="inputAddress">Select Supplier <span v-if="$can('Manage Supplier')">  | <a href="#" class="text-success" data-toggle="modal" data-target="#supplierModel">Add New Supplier</a> </span></label>
                                                            <cool-select
      v-model="purchase.supplier"
      :items="suppliers"
      :placeholder="purchase.supplier ? '' : 'Select supplier'"
      item-text="name"
      item-value="id"
      :readonly="invoiceSet"
      @select="changeInvoiceNumber()"
    />
                                                        </div>

                                                        <div class="form-group mb-4">
                                                            <label for="inputAddress">Select Product <span v-if="$can('Manage Product')">  | <a href="#" class="text-success" data-toggle="modal" data-target="#createModel">Create New Product</a> </span></label>
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
                                                                <label for="total">Total Cost</label>
                                                                <input type="number" v-model="purchase.total" required class="form-control text-primary" id="total">
                                                            </div>
                                                            <div class="form-group col">
                                                                <label for="sell">Selling Price</label>
                                                                <input v-if="purchase.item" type="number" required v-model="purchase.item.selling_price"  class="form-control" id="sell">
                                                                <input v-else type="number" required value="0"  class="form-control" id="sell">
                                                            </div>

                                                            <div class="form-group col">
                                                                <label for="sell">Cost Price</label>
                                                                <input type="number" :value=" parseFloat((purchase.total / purchase.qty).toFixed(2))" disabled class="form-control" id="sell">
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
                                                                <td v-if="item.item">{{item.item.name}}</td>
                                                                <td v-if="item.item">{{item.qty}}</td>
                                                                <td v-if="item.item">&#8358;{{parseFloat((item.total / item.qty).toFixed(2))}}</td>
                                                                <td v-if="item.item">&#8358;{{item.total}}</td>
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
                                                                                            <div class="col-sm-6 col-5 grand-total-title">
                                                                                                <h4 style="font-size: 1.1rem;" >Grand Total : </h4>
                                                                                            </div>
                                                                                            <div class="col-sm-6 col-7 grand-total-amount mb-4">
                                                                                                <h4 style="font-size: 1.1rem;">&#8358;  {{ subTotal(cart.items, "total")  }}</h4>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                
                                                                        </div>
                                                </div>

                                                 <form @submit.prevent="updatePurchase" class="mt-2">
                                                        <button type="submit" class="btn btn-lg btn-outline-success">Update</button>
                                                    </form>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="modal fade" id="createModel" tabindex="-1" role="dialog" aria-labelledby="createModelLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <form @submit.prevent="storeProduct">
        <div class="modal-content">
            
            <div class="modal-header">
                <h5 class="modal-title" id="createModelLabel">Add Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>
            <div class="modal-body">
                
                
                                                    <div class="form-row mb-4">
                                                            <label for="name">Product Name</label>
                                                            <input type="text" class="form-control" id="name" v-model="product.name" required  placeholder="Pharmacy Plus ">
                                                    </div>

                                                    <div class="form-row mb-4">
                                                        <div class="form-group col-md-6">
                                                            <label for="sale">Selling Price</label>
                                                            <input type="text" class="form-control" id="sale" v-model="product.selling_price"  required placeholder="Mr James">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="sales_contact">Cost Price</label>
                                                            <input type="text" class="form-control" id="sales_contact" v-model="product.cost_price" required placeholder="09064629981">
                                                        </div>
                                                    </div>

                                                     <div class="form-row mb-4">
                                                      <div class="form-group col-md-6">
                                                        <label for="address">Category</label>
                                                        <select class="form-control d-inline-block" v-model="product.category_id" required>
                                                            <option value='' disabled>Select Category</option>
                                                            <option v-for="category in categories" :key="category.id" :value="category.id" >{{ category.name }}</option>
                                                        </select>
                                                      </div>

                                                      <div class="form-group col-md-6">
                                                        <label for="address">For Branch</label>
                                                        <select class="form-control d-inline-block" v-model="product.branch_id" required>
                                                            <option value='' disabled>Select Branch</option>
                                                            <option v-for="branch in branchies" :key="branch.branch.id" :value="branch.branch.id" >{{ branch.branch.shortname }}</option>
                                                        </select>
                                                      </div>

                                                    </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-danger" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
    </form>
    </div> 
</div>


<div class="modal fade" id="supplierModel" tabindex="-1" role="dialog" aria-labelledby="supplierModelModelLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <form @submit.prevent="storeSupplier">
        <div class="modal-content">
            
            <div class="modal-header">
                <h5 class="modal-title" id="createModelLabel">Add Supplier</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>
            <div class="modal-body">
                
                
                                                    <div class="form-row mb-4">
                                                        <div class="form-group col-md-6">
                                                            <label for="name">Company Name</label>
                                                            <input type="text" class="form-control" id="name" v-model="newSupplier.name" required  placeholder="Pharmacy Plus ">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="contact">Company Contact</label>
                                                            <input type="tel" class="form-control" id="contact" v-model="newSupplier.contact" required placeholder="08108568996">
                                                        </div>
                                                    </div>

                                                    <div class="form-row mb-4">
                                                        <div class="form-group col-md-6">
                                                            <label for="sale">Sales Rep</label>
                                                            <input type="text" class="form-control" id="sale" v-model="newSupplier.sales_rep" placeholder="Mr James">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="sales_contact">Sales Rep Contact</label>
                                                            <input type="tel" class="form-control" id="sales_contact" v-model="newSupplier.sales_rep_contact"  placeholder="09064629981">
                                                        </div>
                                                    </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-danger" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
    </form>
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

props : ['branchies', 'categories', 'suppliers', 'data'],

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
        changeInvoice : true,
        invoiceSet : false,

    };
  },


created : function(){
    this.isLoading = true;
    $(document).ready(function(){
        $('.remove').remove();
    })
},

mounted : function(){
    this.cart.items = this.data
    this.purchase.supplier = this.data[0].supplier;
    this.purchase.invoice = this.data[0].invoice;
    this.purchase.date = this.data[0].date;
    if(this.purchase.invoice != ''){
            this.invoiceSet = true;
    }
    this.isLoading = false;
},

components: {
'layout' : Layout,
    CoolSelect
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
      enableChange(){
          this.invoiceSet = false;
          this.changeInvoice = false;
      },
      changeInvoiceNumber(){

                for (let field of Object.keys(this.cart['items'])) {
                    this.cart['items'][field]['invoice'] = this.purchase.invoice;
                    this.cart['items'][field]['date'] = this.purchase.date;
                    this.cart['items'][field]['supplier'] = this.purchase.supplier;
                }
      },
validation(){
    if(!this.purchase.item.id){
        this.$toast.error('Please select both supplier and product.', 'error');
        return false;
    }
    return true;
},

submitValid(){
    if(!this.cart.invoice || !this.cart.items[0]){
        this.$toast.error('Please add items to your cart.', 'error');
        return false;
    }
    
    return true;
},
updatePurchase(){

        axios.put(route('purchases.update',{'purchase': this.cart.items[0].invoice}), this.cart)
        .then((response) => {
            this.$inertia.visit('/purchases');
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
   return cart.reduce((acc, item) => parseInt(acc) + parseInt(item[index]), 0);
},

    calTotal(){
        this.sale.total = this.sale.qty * this.sale.item.selling_price;
    },
delItem(item){

         var handle = this.cart.items;
         var i = handle[item];
           if( i != null) {
               if(i.id != undefined){
                   axios.delete(route('purchases.destroy',{'purchase': i.id }))
                    .then((response) => {
                        handle.splice(item, 1);
                    })
                    .catch(error => {
                        let errors = error.response.data.errors;
                        for (let field of Object.keys(errors)) {
                            this.$toast.error(errors[field][0], 'error');
                        }
                    });
               }
               
           } else {
             this.$toast.error('There are no item in the Cart ', 'error');
           }
    this.cart.items = handle;
},
addToCart(){
if(this.validation()){
 this.cart.items.push(this.purchase);
}
},
    focusInput(){
        this.purchase.qty = 0;
        this.$refs.qty.focus();
    },

storeProduct(){
          axios.post(route('products.store'), this.product)
        .then((response) => {
                this.$toast.success(response.data.success);
                this.product= {};
                $('#createModel').modal('hide');
                this.$inertia.reload();
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
