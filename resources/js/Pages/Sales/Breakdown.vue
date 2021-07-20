<template>
<layout :page_title="'Sales Breakdown'">
    
 <div class="row layout-top-spacing" id="cancel-row">

<div class="col-xl-10 col-lg-10 col-md-10 col-12 layout-spacing">
                                        <div class="widget-content-area br-4">
                                            <div class="widget-one p-3">
                                                <div class="row">
                                                    <div class="col-3"><input type="date" class="form-control" placeholder="Date" v-model="filter.date" required @change="getData" /></div>

                                                    <div class="col-3">
                                                            <select id="mode" class="form-control d-inline-block" v-model="filter.shift" @change="getData" required>
                                                                <option value='' disabled>Select Shift</option>
                                                                <option value="Morning">Morning</option>
                                                                <option value="Afternoon">Afternoon</option>
                                                            </select></div>
                                                
                                                    <div class="col">
                                                         <select id="staff" class="form-control d-inline-block" v-model="filter.staff" @change="getData" required>
                                                                <option value='' disabled>Select Select</option>
                                                                <option v-for="staff in staffs" :key="staff.id" :value="staff.user.id" >{{staff.user.name}}</option>
                                                            </select>
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
                    <div class="dataTables_length"><label>Results : <select v-model="filter.pagination" @change="getData"
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
                                                        <th>Date</th>
                                                        <th>Staff</th>
                                                        <th>Branch</th>
                                                        <th>No. Sales</th>
                                                        <th>Total</th>
                                                        <th>Action</th>
                                                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(sale, index) in laravelData.data" :key="sale.id" >
                        <td>{{ sale[0].created_at | moment("ddd, MM Do YYYY") }}</td>
                        <td v-if="sale[0].user">{{ sale[0].user.name }}</td>
                        <td v-if="sale[0].branch">{{ sale[0].branch.name }}</td> 
                        <td>{{ sale.count }}</td> 
                        <td> &#8358;{{ sale.grandTotal }}</td>
                        <td>
                            <inertia-link :href="'/staff/sales/details?staff=' + filter.staff + '&date=' + sale.date + '&shift=' + filter.shift">
                            <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg> </inertia-link>
                        </td>
                    </tr>


                </tbody>
                <tfoot>
                    <tr>
                                                        <th>Date</th>
                                                        <th>Staff</th>
                                                        <th>Branch</th>
                                                        <th>No. Sales</th>
                                                        <th>Total</th>
                                                        <th>Action</th>
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
                        <pagination :data="laravelData" @pagination-change-page="getData">
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
props: ['staffs'],
  data: function () {
    return {
        laravelData: {},
       filter : {
           pagination : 5,
           staff : '',
           date : '',
           shift : '',
       },
       isLoading: false,
        
    };
  },



components: {
'layout' : Layout,
VueElementLoading,
    
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
   this.isLoading = false;
},

  methods: {
 

    getData(page =1) {
                if(this.filter.staff != ""){
                    axios.get('/api/breakdown?page=' + page +"&pagination=" + this.filter.pagination  +"&staff=" + this.filter.staff + "&date=" + this.filter.date + "&shift=" + this.filter.shift)
                    .then( response => {
                        this.laravelData = response.data;
                        console.log(response.data);
                    });
                }else{
                    this.$toast.error('Select staff first', 'error');
                }
                
            },
              subTotal(sales,index){
   return sales.reduce((acc, item) => acc + parseInt(item[index]), 0);
},


  },


};

</script>
