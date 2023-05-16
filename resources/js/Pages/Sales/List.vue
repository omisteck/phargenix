<template>
<layout :page_title="'Sales'">
 <div class="row layout-top-spacing" id="cancel-row">
 
                                    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                                        <vue-element-loading :active="isLoading" spinner="bar-fade-scale"  color="#009688" />
                                                                 <div class="widget-content widget-content-area br-6">
    <div id="zero-config_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
        <div class="table-responsive">
            <table id="zero-config" class="table dt-table-hover dataTable" style="width: 100%;" role="grid">
                <thead>
                    <tr role="row">
                                                        <th>Invoice Number</th>
                                                        <th>Product</th>
                                                        <th>Selling Price</th>
                                                        <th>Qty</th>
                                                        <th>Total</th>
                                                        <th>Mode</th>
                                                        <th>Shift</th>
                                                        <th>Staff</th>
                                                        <th class="no-content">Actions</th>
                                                    </tr>
                </thead>
                <tbody>

 <tr v-for="sale in sales" :key="sale.id">
 <td>{{ sale.invoice_number }}</td>
                                                        <td>{{ JSON.parse(sale.data).name }}</td>
                                                        <td>{{ JSON.parse(sale.data).selling_price }}</td>
                                                        <td>{{ sale.qty }}</td>
                                                        <td>{{ sale.total }}</td>
                                                        <td>{{ sale.mode }}</td>
                                                        <td>{{ sale.shift }}</td>
                                                        <td v-if="sale.user != null">{{ sale.user.name }}</td>
                                                        <td v-else>No user </td>
                                                        <td class="text-center">
                                                            
                                                            <div class="btn-group " role="group">
                                                                <button id="btnGroupVerticalDrop2" type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                Action
                                                                </button>
                                                                <div class="dropdown-menu" aria-labelledby="btnGroupVerticalDrop2">
                                                                    <inertia-link class="dropdown-item" :href="'/invoices/'+ sale.invoice_number">Print Recipt</inertia-link>
                                                                    <inertia-link class="dropdown-item" :href="'/sales/'+sale.invoice_number+'/edit'">Edit</inertia-link>
                                                                    <a class="dropdown-item text-danger " @click="deleteSale(sale)" href="#">Delete</a>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr> 

                </tbody>
                <tfoot>
                    
                    <tr>
                       <th></th>
                                                        <th></th>
                                                        <th></th>
                                                        <th></th>
                                                        <th>Total</th>
                                                        <th></th>
                                                        <th></th>
                                                        <th></th>
                        <th class="no-content"><h4>&#8358;{{ total }}</h4></th>
                    </tr>
                    <tr>
                       <th></th>
                                                        <th></th>
                                                        <th></th>
                                                        <th></th>
                                                        <th>Discount</th>
                                                        <th></th>
                                                        <th></th>
                                                        <th></th>
                        <th class="no-content"><h4>&#8358;{{ discount }}</h4></th>
                    </tr>
                    <tr>
                       <th></th>
                                                        <th></th>
                                                        <th></th>
                                                        <th></th>
                                                        <th>Grand Total</th>
                                                        <th></th>
                                                        <th></th>
                                                        <th></th>
                        <th class="no-content"><h4>&#8358;{{ sum }}</h4></th>
                    </tr>
                </tfoot>
            </table>
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

props : ['sales', 'sum', 'total', 'discount'],

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
   this.isLoading = false;
},

  methods: {

  }

};

</script>
