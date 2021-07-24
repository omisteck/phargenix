<template>
<layout :page_title="'Sales'">
 <div class="row layout-top-spacing" id="cancel-row">
     <div class="col-lg-12">
        <a href="#" class="btn btn-success mb-3 ml-3"  data-toggle="modal" data-target="#createModel" >Return Sales</a>
     </div>
    

                                    <div class="col-xl-10 col-lg-10 col-sm-12  layout-spacing">
                                        <vue-element-loading :active="isLoading" spinner="bar-fade-scale"  color="#009688" />
                                                                 <div class="widget-content widget-content-area br-6">
    <div id="zero-config_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
        <div class="dt--top-section">
            <div class="row">
                <div class="col-12 col-sm-6 d-flex justify-content-sm-start justify-content-center">
                    <div class="dataTables_length"><label>Results : <select v-model="filter.pagination" @change="getResults"
                                class="form-control">
                                <option value="5">5</option>
                                <option value="10">10</option>
                                <option value="20">20</option>
                                <option value="50">50</option>
                            </select></label></div>
                </div>
                <div class="col-12 col-sm-6 d-flex justify-content-sm-end justify-content-center mt-sm-0 mt-3">
                    <div class="dataTables_filter"><label><svg
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-search">
                                <circle cx="11" cy="11" r="8"></circle>
                                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                            </svg><input type="search" @keyup="getResults" v-model="filter.search" class="form-control" placeholder="Search..."></label></div>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table id="zero-config" class="table dt-table-hover dataTable" style="width: 100%;" role="grid">
                <thead>
                    <tr role="row">
                                                        <th>Invoice Number</th>
                                                        <th>Product</th>
                                                        <th>Selling Price</th>
                                                        <th>Qty</th>
                                                        <th>Total</th>
                                                        <th>Branch</th>
                                                        <th>Staff</th>
                                                        <th  v-if="$can('Manage Sales Return')" class="no-content">Actions</th>
                                                    </tr>
                </thead>
                <tbody>

 <tr v-for="sale in laravelData.data" :key="sale.id">
 <td>{{ sale.invoice_number }}</td>
                                                        <td>{{ JSON.parse(sale.data).name }}</td>
                                                        <td>{{ JSON.parse(sale.data).selling_price }}</td>
                                                        <td>{{ sale.qty }}</td>
                                                        <td>{{ sale.qty * JSON.parse(sale.data).selling_price }}</td>
                                                        <td v-if="sale.branch != null">{{ sale.branch.shortname }}</td>
                                                        <td v-else>No branch </td>
                                                        <td v-if="sale.user != null">{{ sale.user.name }}</td>
                                                        <td v-else>No user </td>
                                                        <td v-if="$can('Manage Sales Return')" class="text-center">
                                                          <a href="#" @click="delItem(sale)">
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                                                        </a>
                                                        </td>
                                                    </tr> 

                </tbody>
                <tfoot>
                    <tr>
                       <th>Invoice Number</th>
                                                        <th>Product</th>
                                                        <th>Selling Price</th>
                                                        <th>Qty</th>
                                                        <th>Total</th>
                                                        <th>Branch</th>
                                                        <th>Sold by</th>
                        <th v-if="$can('Manage Sales Return')" class="no-content">Actions</th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <div class="dt--bottom-section d-sm-flex justify-content-sm-between text-center">
            <div class="dt--pages-count  mb-sm-0 mb-3">
                <div class="dataTables_info" id="zero-config_info" role="status" aria-live="polite">Showing page {{laravelData.current_page}} of {{laravelData.last_page}}
                </div>
            </div>
            <div class="dt--pagination">
                <div class="dataTables_paginate paging_simple_numbers" id="zero-config_paginate">
                    <ul class="pagination">
                        <pagination :limit=1 :data="laravelData" @pagination-change-page="getResults">
                            <span slot="prev-nav"><svg
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-arrow-left">
                                    <line x1="19" y1="12" x2="5" y2="12"></line>
                                    <polyline points="12 19 5 12 12 5"></polyline>
                                </svg>
                                </span>
                            

                                <span slot="next-nav"><svg
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-arrow-right">
                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                    <polyline points="12 5 19 12 12 19"></polyline>
                                </svg></span>
                        </pagination>
                        
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<div class="modal fade" id="createModel" tabindex="-1" role="dialog" aria-labelledby="createModelLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
<form > 
        <div class="modal-content">
            
            <div class="modal-header">
                <h5 class="modal-title" id="createModelLabel">Add Staff</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>
            <div class="modal-body">
                
                    <div class="input-group mb-4">
                                <input type="text" class="form-control" v-model="details.invoice" required placeholder="Invoice Number" aria-label="Invoice Number">
                                <div class="input-group-append">
                                <button class="btn btn-success" @click="load" type="button">Load</button>
                                </div>
                    </div>

                <div :class="'table-responsive ' + table ">
                                                    <table class="table table-sm" >
                                                        <thead>
                                                            <tr>
                                                                <th>Item name</th>
                                                                <th>Qty</th>
                                                                <th>price</th>
                                                                <th>Total</th>
                                                                <th>Return</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr v-for="sale in sales" :key="sale.id">
                                                                <td>{{ JSON.parse(sale.data).name }}</td>
                                                                <td>{{ sale.qty }}</td>
                                                                <td>{{ JSON.parse(sale.data).selling_price }}</td>
                                                                <td>{{ sale.total }}</td>
                                                                <td> <button type="button" @click="return_sales(sale)" class="btn btn-sm btn-danger">Return</button></td>
                                                            </tr>

                                                        </tbody>
                                                    </table>
                                                </div>
                
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
import { Inertia } from '@inertiajs/inertia'
import VueElementLoading from "vue-element-loading";
import axios from 'axios';

export default {
  // Using the shorthand
//   layout: Layout,

  data: function () {
    return {
        laravelData: {},
       filter : {
           pagination : 5,
           search : '',
       },
       isLoading: false,
       details: {
           invoice : '',
       },
       sales : {

       },
       table : 'd-none',
    };
  },



components: {
'layout' : Layout,
VueElementLoading,
    
  },
  created : function () {
      this.isLoading = true;
      
     $('head').append( $('<link rel="stylesheet" id="table" class="remove" type="text/css" />').attr('href', '/dashboard/plugins/table/datatable/dt-global_style.css') );
},

mounted : function(){
   this.getResults();
   this.isLoading = false;
},

  methods: {

load(){
    axios.get('/return/sold/'+this.details.invoice)
    .then(response => {
        this.sales = response.data;
        this.table = 'd-block';
    }).catch(error => {
                this.isLoading = false;
                let errors = error.response.data.errors;
                for (let field of Object.keys(errors)) {
                    this.$toast.error(errors[field][0], 'error');
                }
            });;
},
      getResults(page =1) {

                axios.get('/api/return/sold?page=' + page +"&pagination=" + this.filter.pagination  +"&search=" + this.filter.search)
                    .then( response => {
                        this.laravelData = response.data;
                    });
            },

         return_sales(sale){
this.$swal.fire({
  title: 'Are you sure?',
  text: "You won't be able to revert this!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, Return it!',
  cancelButtonText: 'No, cancel!',
  reverseButtons: true
}).then((result) => {
  if (result.isConfirmed) {
      this.isLoading = true;
            axios.post(route('sold.store',sale))
            .then((response) => {
                this.details.invoice ='';
                this.table="d-none";
                $('#createModel').modal('hide');
                this.getResults();
                this.isLoading = false;
               this.$swal.fire(
                    'Returned!',
                    'Sales succesfully returned.',
                    'success'
                    );
            })
             .catch(error => {
                this.isLoading = false;
                let errors = error.response.data.errors;
                for (let field of Object.keys(errors)) {
                    this.$toast.error(errors[field][0], 'error');
                }
            });
  } 
})

    },

    delItem(sale){
this.$swal.fire({
  title: 'Are you sure?',
  text: "You won't be able to revert this!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, Delete it!',
  cancelButtonText: 'No, cancel!',
  reverseButtons: true
}).then((result) => {
  if (result.isConfirmed) {
      this.isLoading = true;
            axios.delete(route('sold.destroy',{'sold' : sale.id}))
            .then((response) => {
                this.getResults();
                this.isLoading = false;
               this.$swal.fire(
                    'Returned!',
                    'Return sales deleted succesfully.',
                    'success'
                    );
            })
             .catch(error => {
                this.isLoading = false;
                let errors = error.response.data.errors;
                for (let field of Object.keys(errors)) {
                    this.$toast.error(errors[field][0], 'error');
                }
            });
  } 
})

    }
  }

};

</script>
