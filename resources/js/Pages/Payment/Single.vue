<template>
<layout :page_title="'Payment List'">
 <div class="row layout-top-spacing" id="cancel-row">
   
                                    <div class="col-xl-10 col-lg-10 col-sm-12  layout-spacing">
                                                                 <div class="widget-content widget-content-area br-6">
    <div id="zero-config_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
        <div class="table-responsive">
            <table id="zero-config" class="table dt-table-hover dataTable" style="width: 100%;" role="grid">
                <thead>
                    <tr role="row">
                                                        <th>Supplier </th>
                                                        <th>Amount</th>
                                                        <th>Inovice</th>
                                                        <th>Mode</th>
                                                        <th>Remark</th>
                                                        <th>By</th>
                                                        <th>Date</th>
                                                        <th class="no-content">Actions</th>
                                                    </tr>
                </thead>
                <tbody>

 <tr v-for="payment in payments" :key="payment.id">
 <td v-if="payment.supplier">{{ payment.supplier.name }}</td>
 <td v-else>Deleted Supplier</td>
                                                        <td>{{ payment.amount }}</td>
                                                        <td>{{ payment.invoice_number }}</td>
                                                        <td>{{ payment.mode }}</td>
                                                        <td>{{ payment.remark }}</td>
                                                        <td v-if="payment.user">{{ payment.user.name }}</td>
                                                        <td v-else>Deleted User</td>
                                                        <td>{{ payment.created_at | moment("D MMMM, YYYY") }}</td>
                                                        <td class="text-center">
                                                            
                                                            <div class="btn-group " role="group">
                                                                <button id="btnGroupVerticalDrop2" type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                Action
                                                                </button>
                                                                <div class="dropdown-menu" aria-labelledby="btnGroupVerticalDrop2">
                                                                    <a class="dropdown-item" @click="editPayment(payment)" href="#">Edit</a>
                                                                </div>
                                                            </div> 
                                                        </td>
                                                    </tr> 

                </tbody>
                <tfoot>
                    <tr>
                      <th>Supplier </th>
                                                        <th>Amount</th>
                                                        <th>Inovice</th>
                                                        <th>Mode</th>
                                                        <th>Remark</th>
                                                        <th>By</th>
                                                        <th>Date</th>
                                                        <th>Action</th>
                    </tr>
                </tfoot>
            </table>
        </div>
       
    </div>
</div>
                                    </div>
                                
                                </div>


<div class="modal fade" id="createModel" tabindex="-1" role="dialog" aria-labelledby="createModelLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
<form @submit.prevent="update()"> 
        <div class="modal-content">
            
            <div class="modal-header">
                <h5 class="modal-title" id="createModelLabel">Edit Payment</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>
            <div class="modal-body">


                <div class="form-row mb-4">
                                                      <div class="form-group col-md-6">
                                                        <label for="invoice">Invoice Number</label>
                                                        <input type="number" minlength="2" class="form-control" id="invoice" v-model="edit.invoice_number"  required placeholder="Invoice Number">
                                                      </div>

                                                      <div class="form-group col-md-6">
                                                         <label for="date">Payment Date</label>
                                                            <input type="date" class="form-control" id="date" v-model="edit.created_at" required placeholder="Payment date">
                                                      </div>

                                                    </div>

                                                     <div class="form-row mb-4">
                                                        <div class="form-group col-md-6">
                                                         <label for="amount">Amount</label>
                                                            <input type="number" min="1" class="form-control" id="amount" v-model="edit.amount"  required placeholder="Amount"> 
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="mode">Mode</label>
                                                            <select id="mode" class="form-control d-inline-block" v-model="edit.mode" required>
                                                                <option value='' disabled>Select Payment Mode</option>
                                                                <option value="Cash">Cash</option>
                                                                <option value="Bank Deposit">Bank Deposit</option>
                                                                <option value="Transfer">Transfer</option>
                                                                <option value="Others">Others</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="form-row mb-4">
                                                        <label for="remark">Remark</label>
                                                        <textarea id="remark" class="form-control" v-model="edit.remark" cols="4" rows="5" ></textarea>
                                                    </div>
                                                    
                
            </div>

             <div class="modal-footer">
                <button class="btn btn-danger" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </div>
    </form>
    </div> 
</div>  
</layout>
</template>

<script>
import Layout from "../Layout/Layout.vue";
import { Inertia } from '@inertiajs/inertia'
import moment from 'moment'

export default {
  // Using the shorthand
//   layout: Layout,

props : ['payments'],

  data: function () {
    return {
      edit : {},
    };
  },



components: {
'layout' : Layout,
    
  },
  created : function () {
      this.isLoading = true;
     $('head').append( $('<link rel="stylesheet" id="table" class="remove" type="text/css" />').attr('href', '/dashboard/plugins/table/datatable/dt-global_style.css') );
},

  mounted : function(){
   
},

  methods: {
     editPayment(payment){
       this.edit = payment;
       $('#createModel').modal('show');
     },

     update(){
       axios.put(route('payments.update', this.edit.id), this.edit)
        .then((response) => {
                this.$toast.success(response.data.success);
                $('#editModel').modal('hide');
            })
            .catch(error => {
                let errors = error.response.data.errors;
                for (let field of Object.keys(errors)) {
                    this.$toast.error(errors[field][0], 'error');
                }
            });
     }

  }

};

</script>
