<template>
<layout :page_title="'Ledger Card'">
    
 <div class="row layout-top-spacing" id="cancel-row">

<div class="col-xl-10 col-lg-10 col-md-10 col-12 layout-spacing">
                                        <div class="widget-content-area br-4">
                                            <div class="widget-one p-3">
                                                <div class="row">
                                                    <div class="col-3"><input type="date" class="form-control" placeholder="Date" v-model="filter.from_date" required @change="populateLedger" /></div>
                                                    <div class="col-3"><input type="date" class="form-control" placeholder="Date" v-model="filter.to_date" required @change="populateLedger" /></div>
                                                    <div class="col">
                                                      <cool-select
      v-model="filter.search"
      :items="products"
      :placeholder="filter.search ? '' : 'Select product'"
      item-text="name"
      item-value="id"
      @select="populateLedger()"
    />
                                                      </div>
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
                    <div class="dataTables_length"><label>Results : <select v-model="filter.pagination" @change="populateLedger"
                                class="form-control">
                                <option value="5">5</option>
                                <option value="10">10</option>
                                <option value="20">20</option>
                                <option value="50">50</option>
                            </select></label></div>
                </div>
                
            </div>
        </div>
        <div class="table-responsive">
            <table ref="testHtml" id="zero-config" class="table dt-table-hover dataTable" style="width: 100%;" role="grid">
                <thead>
                    <tr role="row">
                                                        <th>S/N</th>
                                                        <th>Description</th>
                                                        <th>Date</th>
                                                        <th>In</th>
                                                        <th>Out</th>
                                                        <th>Instore</th>
                                                        <th>C Price</th>
                                                        <th>S Price</th>
                                                        <th>Inv. Num</th>
                                                        <th>By</th>
                                                        <th>Supplier</th>
                                                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(result, index) in laravelData.data" :key="result.id" >
                        <td>{{ parseInt(index)+1 }}</td>
                        <td>{{ result.desc }}</td>
                        <td>{{ result.created_at | moment("ddd, MM Do YYYY") }}</td>
                        <td v-if="result.type == 'purchases' || result.type == 'sales returned' || result.types == 'reconcile' ">{{ result.qty }}</td>
                        <td v-else></td>
                        <td v-if="result.type == 'transfer' || result.type == 'sales' ">{{ result.qty }}</td>
                        <td v-else></td>
                        <td v-if="result.type == 'purchases' || result.type == 'sales returned' || result.types == 'reconcile' ">{{  total ?  total = total - result.qty : total = laravelData.instore - result.qty   }}</td>
                        <td v-else>{{   total ?  total = total + result.qty : total = laravelData.instore + result.qty }}</td>
                        <td v-if="result.type == 'purchases'" >{{ result.unit }}</td>
                        <td v-else></td>
                        <td v-if="result.type == 'sales' || result.type == 'sales returned'" >{{ JSON.parse(result.data).selling_price }}</td>
                        <td v-else></td>
                        <td v-if="transfer.user">{{ transfer.user.name }}</td>
                        <td v-if="result.invoice_number">{{ result.invoice_number }}</td>
                        <td v-if="result.user">{{ result.user.name }}</td>
                        <td v-if="result.supplier">{{ result.supplier.name }}</td>
                    </tr>


                </tbody>
                <tfoot>
                    <tr>
                       <th>S/N</th>
                                                        <th>Description</th>
                                                        <th>Date</th>
                                                        <th>In</th>
                                                        <th>Out</th>
                                                        <th>Instore</th>
                                                        <th>C Price</th>
                                                        <th>S Price</th>
                                                        <th>Inv. Num</th>
                                                        <th>By</th>
                                                        <th>Supplier</th>
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
                        <pagination :data="laravelData" @pagination-change-page="populateLedger">
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
import { CoolSelect } from "vue-cool-select";
import axios from 'axios';


export default {
  // Using the shorthand
//   layout: Layout,
props: ['products', 'branchies'],
  data: function () {
    return {
        laravelData: {},
       filter : {
           pagination : 5,
           search : '',
           to_branch : '',
           from_date : '',
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
      this.isLoading = true;
      
     $('head').append( $('<link rel="stylesheet" id="table" class="remove" type="text/css" />').attr('href', '/dashboard/plugins/table/datatable/dt-global_style.css') );
},

mounted : function(){
   this.isLoading = false;
},

  methods: {
 

    populateLedger(page =1) {

                axios.get('/api/ledger?page=' + page +"&pagination=" + this.filter.pagination  +"&search=" + this.filter.search + "&from_date=" + this.filter.from_date + "&to_date=" + this.filter.to_date)
                    .then( response => {
                        this.laravelData = response.data;
                    });
            },

  }

};

</script>
