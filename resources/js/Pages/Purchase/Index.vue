<template>
<layout :page_title="'Purchase'">
 <div class="row layout-top-spacing" id="cancel-row">
     <div class="col-lg-12">
        <inertia-link href="/purchases/create" class="btn btn-success mb-3 ml-3" >Enter Purchase</inertia-link>
     </div>
    

                                    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
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
                                                        <th>Cost Price</th>
                                                        <th>Qty</th>
                                                        <th>Total</th>
                                                        <th>Branch</th>
                                                        <th>Supplier</th>
                                                        <th>Added by</th>
                                                        <th>Settled</th>
                                                        <th class="no-content">Actions</th>
                                                    </tr>
                </thead>
                <tbody>

 <tr v-for="purchase in laravelData.data" :key="purchase.id">
 <td>{{ purchase.invoice_number }}</td>
                                                        <td>{{ JSON.parse(purchase.product).name }}</td>
                                                        <td>{{ JSON.parse(purchase.product).cost_price }}</td>
                                                        <td>{{ purchase.qty }}</td>
                                                        <td>{{ purchase.total }}</td>
                                                        <td v-if="purchase.branch != null">{{ purchase.branch.shortname }}</td>
                                                        <td v-else>No branch </td>
                                                        <td v-if="purchase.name != null">{{ purchase.name }}</td>
                                                        <td v-else>No Supplier </td>
                                                        <td v-if="purchase.user != null">{{ purchase.user.name }}</td>
                                                        <td v-else>No user </td>
                                                        <td> <span class="badge p-2" v-bind:class="{ 'badge-success' : purchase.settlement == 'true', 'badge-dark' : purchase.settlement == 'false' }"> {{ purchase.settlement }}</span></td>
                                                        <td class="text-center">
                                                            
                                                            <div class="btn-group " role="group">
                                                                <button id="btnGroupVerticalDrop2" type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                Action
                                                                </button>
                                                                <div class="dropdown-menu" aria-labelledby="btnGroupVerticalDrop2">
                                                                    <inertia-link class="dropdown-item" :href="'/invoices/'+ purchase.invoice_number">Print Recipt</inertia-link>
                                                                    <inertia-link class="dropdown-item" :href="'purchases/'+purchase.invoice_number+'/edit'">Edit</inertia-link>
                                                                    <a class="dropdown-item text-danger " @click="deleteSale(purchase)" href="#">Delete</a>
                                                                </div>
                                                            </div>
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
                                                        <th>Mode</th>
                                                        <th>Branch</th>
                                                        <th>Sold by</th>
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
                                
                                </div>

</layout>
</template>

<script>
import Layout from "../Layout/Layout.vue";
import { Inertia } from '@inertiajs/inertia'
import VueElementLoading from "vue-element-loading";

export default {
  // Using the shorthand
//   layout: Layout,

props : ['sales'],

  data: function () {
    return {
        laravelData: {},
       filter : {
           pagination : 5,
           search : '',
       },
       isLoading: false,
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
    $(document).ready(function() {
            App.init();
      });
   this.getResults();
   this.isLoading = false;
},

  methods: {

      getResults(page =1) {

                axios.get('api/purchases?page=' + page +"&pagination=" + this.filter.pagination  +"&search=" + this.filter.search)
                    .then( response => {
                        this.laravelData = response.data;
                    });
            },

         deleteSale(item){
    //   this.isLoading = true;

this.$swal.fire({
  title: 'Are you sure?',
  text: "You won't be able to revert this!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, delete it!',
  cancelButtonText: 'No, cancel!',
  reverseButtons: true
}).then((result) => {
  if (result.isConfirmed) {
      this.isLoading = true;
            axios.delete(route('delete_purchase',{'purchase': item.id}))
            .then((response) => {
                this.getResults();
                this.isLoading = false;
               this.$swal.fire(
                    'Deleted!',
                    'You deleted a Purchase.',
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
