<template>
<layout :page_title="'Transfers'">
    
 <div class="row layout-top-spacing" id="cancel-row">
     <div class="col-lg-12">
        <a href="#" class="btn btn-success mb-3 ml-3"  data-toggle="modal" data-target="#createModel" >Product Transfer</a>
     </div>


<div class="col-xl-10 col-lg-10 col-md-10 col-12 layout-spacing">
                                        <div class="widget-content-area br-4">
                                            <div class="widget-one p-3">
                                                <div class="row">
                                                    <div class="col-3"><h4>Search filter:</h4></div>
                                                    <div class="col-3"><input type="date" class="form-control" placeholder="Date" v-model="filter.date" r required @change="getResults" /></div>
                                                    <div class="col-4">
                                                        <select class="form-control d-inline-block" v-model="filter.to_branch" required @change="getResults">
                                                            <option value="" disabled selected>Receivie Branch</option>
                                                            <option v-for="single_branch in all_branchies" :key="single_branch.id" :value="single_branch.id" >{{ single_branch.shortname }}</option>
                                                        </select></div>
                                                    <div class="col-2"><input type="submit" class="btn btn-primary" value="Export as PDF"/></div>
                                                </div>                
                                            </div>
                                        </div>
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
                                                        <th>Product</th>
                                                        <th>Branch</th>
                                                        <th>To Product</th>
                                                        <th>To Branch</th>
                                                        <th>Qty</th>
                                                        <th>By</th>
                                                        <th>Date</th>
                                                        <th class="no-content">Actions</th>
                                                    </tr>
                </thead>
                <tbody>
                    <tr v-for="transfer in laravelData.data" :key="transfer.id">
                        <td v-if="transfer.from_product">{{ JSON.parse(transfer.from_product).name }}</td>
                        <td v-else>No Product</td>
                        <td v-if="transfer.from_branches">{{ transfer.from_branches.shortname }}</td>
                        <td v-else>No branch</td>
                        <td v-if="transfer.to_product">{{ JSON.parse(transfer.to_product).name }}</td>
                        <td v-else>No Product</td>
                        <td v-if="transfer.to_branches">{{ transfer.to_branches.shortname }}</td>
                        <td v-else>No branch</td>
                        <td>{{ transfer.qty }}</td>
                        <td v-if="transfer.user">{{ transfer.user.name }}</td>
                        <td v-else>No user</td>
                        <td>{{ transfer.created_at | moment("ddd, MMM Do YYYY") }}</td>

                                                        <td class="text-center">
                                                          <a href="#" @click="delItem(transfer)">
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg> 
                                                                        </a>
                                                        </td>
                    </tr>


                </tbody>
                <tfoot>
                    <tr>
                       <th>Product</th>
                                                        <th>Branch</th>
                                                        <th>To Product</th>
                                                        <th>To Branch</th>
                                                        <th>Qty</th>
                                                        <th>By</th>
                                                        <th>Date</th>
                                                        <th class="no-content">Actions</th>
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
                        <pagination :data="laravelData" @pagination-change-page="getResults">
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
<form  method="POST" @submit.prevent="Save"> 
        <div class="modal-content">
            
            <div class="modal-header">
                <h5 class="modal-title" id="createModelLabel">Transfer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>
            <div class="modal-body">

                    <div class="form-group mb-4">
                        <label for="inputAddress">Transfer Date</label><br>
                        <input type="datetime-local" v-model="transfer.date" class="form-control" placeholder="Select Date.." required>                    
                   </div>

                   <div class="form-group mb-4">
                        <label for="inputAddress">Select Product</label><br>

                        <cool-select
                        v-model="transfer.from"
                        :items="products"
                        :placeholder="transfer.from ? '' : 'Select product'"
                        item-text="name" 
                        :required= "true"
                        />
                    
                   </div>

                   <div class="form-row mb-2 text-center">
                    <div class="col-4">
                        <h4>Instore</h4>
                        <p v-if="transfer.from">{{ transfer.from.instore }}</p>
                    </div>
                    <div class="col-4">
                        <h4>Selling Price</h4>
                        <p v-if="transfer.from">{{ transfer.from.selling_price }}</p>
                    </div>
                    <div class="col-4">
                        <h4>Cost Price</h4>
                        <p v-if="transfer.from">{{ transfer.from.cost_price }}</p>
                    </div>
                   </div>
                   <div class="form-group col-md-12 p-0">
                                                        <label for="address">To Branch</label>
                                                        <select class="form-control d-inline-block" v-model="transfer.branch" required @change="loadProduct2()">
                                                            <option disabled>Select Branch</option>
                                                            <option v-for="branch in branchies" :key="branch.id" :value="branch.id" >{{ branch.name }}</option>
                                                        </select>
                                                      </div>
                    <div :class="display" >
                    <vue-element-loading :active="isLoading" spinner="bar-fade-scale"  color="#009688" />
                   
                    <div class="form-group mb-4">
                        <label for="inputAddress">Select Product</label><br>

                        <cool-select
                        v-model="transfer.to"
                        :items="products2"
                        :placeholder="transfer.to ? '' : 'Select product'"
                        item-text="name"
                        />
                    
                   </div>

                   <div class="form-row mb-2">
                       <div class="form-group col-md-12">
                            <label for="qty">Qty</label>
                            <input type="number" min="1" required v-model="transfer.qty" class="form-control text-primary" id="instore">
                        </div>
                   </div>
                    </div>

                   

            </div>
            <div class="modal-footer">
                <button class="btn btn-danger" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>
                <button type="submit" class="btn btn-primary">Transfer</button>
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
import { CoolSelect } from "vue-cool-select";
import axios from 'axios';

export default {
  // Using the shorthand
//   layout: Layout,
props: ['products', 'branchies','all_branchies'],
  data: function () {
    return {
        laravelData: {},
       filter : {
           pagination : 5,
           search : '',
           to_branch : '',
           date : '',
           to_date : '',
       },
       isLoading: false,
        transfer : {
            to : {},
            from : {},
        },

        products2 : [],
        
        display : 'd-none',

    };
  },



components: {
'layout' : Layout,
VueElementLoading,
CoolSelect,
    
  },
  created : function () {
      $(document).ready(function() {
            App.init();
      });
      this.isLoading = true;
      
     $('head').append( $('<link rel="stylesheet" id="table" class="remove" type="text/css" />').attr('href', '/dashboard/plugins/table/datatable/dt-global_style.css') );
},

mounted : function(){
    $(document).ready(function() {
            App.init();
      });
   this.getResults();
   this.isLoading = false;
},

  methods: {

loadProduct2(){
    this.isLoading = true;
    this.display = 'd-block';
    axios.get(route('branchProduct', this.transfer.branch))
    .then((response) => {
            this.products2 = response.data.products;
            this.isLoading = false;
            })
},
    Save(){
        axios.post(route('transfer.store'), this.transfer)
        .then((response) => {
                this.transfer = {};
                this.getResults();
                this.isLoading = false;
                $('#createModel').modal('hide');
                this.display = 'd-none';
                this.$toast.success(response.data.success);
            })
            .catch(error => {
                this.isLoading = false;
                let errors = error.response.data.errors;
                for (let field of Object.keys(errors)) {
                    this.$toast.error(errors[field][0], 'error');
                }
            })

},

editTransfer(transfer){
    this.edit = transfer;
    $('#edit').modal('show');
},

        Update(){
        axios.put(route('reconcile.update', this.edit.id), { details: this.edit, data: this.data })
        .then((response) => {
                this.edit = {};
                this.getResults();
                this.isLoading = false;
                $('#edit').modal('hide');
                this.$toast.success(response.data.success);
            })
            .catch(error => {
                this.isLoading = false;
                let errors = error.response.data.errors;
                for (let field of Object.keys(errors)) {
                    this.$toast.error(errors[field][0], 'error');
                }
            })

},
      getResults(page =1) {

                axios.get('/api/transfer?page=' + page +"&pagination=" + this.filter.pagination  +"&search=" + this.filter.search + "&to_branch=" + this.filter.to_branch + "&date=" + this.filter.date)
                    .then( response => {
                        this.laravelData = response.data;
                    });
            },


    delItem(transfer){
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
            axios.delete(route('transfer.destroy',{'transfer' : transfer.id}))
            .then((response) => {
                this.getResults();
                this.isLoading = false;
               this.$swal.fire(
                    'Deleted!',
                    'Transfer deleted succesfully.',
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
