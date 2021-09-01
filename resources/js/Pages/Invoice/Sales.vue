<template>
<layout :page_title="'Invoice'">
<div class="row invoice layout-spacing">

                                    <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 col-7 m-auto">
                                        
                                        <div class="doc-container">
                
                                            <div class="row">
                
                                                <div class="col-xl-12">
                
                                                    <div class="invoice-container">
                                                        <div class="invoice-inbox">
                                                            
                                                            <div id="ct" class="">
                                                                
                                                                <div class="invoice-00001">
                                                                    <div class="content-section">
                    
                                                                        <div class="inv--head-section inv--detail-section">
                                                                        
                                                                            <div class="row">
                                                                            
                                                                                <div class="col-sm-6 col-12 mr-auto">
                                                                                    <div class="d-flex">
                                                                                        <img class="company-logo" src="/dashboard/assets/img/cork-logo.png" alt="company">
                                                                                        <h3 class="in-heading align-self-center">{{ $page.props.appName }}.</h3>
                                                                                    </div>
                                                                                </div>
                
                                                                                <div class="col-sm-6 text-sm-right">
                                                                                    <p class="inv-list-number"><span class="inv-title">Invoice : </span> <span class="inv-number">#{{ sales[0].invoice_number }}</span></p>
                                                                                </div>
                
                                                                                <div class="col-sm-6 align-self-center mt-3">
                                                                                    <p class="inv-street-addr">{{ $page.props.user.branch.active.address }}</p>
                                                                                    <p class="inv-email-address">{{ $page.props.user.branch.active.email }}</p>
                                                                                    <p class="inv-email-address">{{ $page.props.user.branch.active.phone }}</p>
                                                                                </div>
                                                                                <div class="col-sm-6 align-self-center mt-3 text-sm-right">
                                                                                    <p class="inv-created-date"><span class="inv-title">Invoice Date : </span> <span class="inv-date">{{ sales[0].created_at | moment(" Do, MMM YYYY")  }}</span></p>
                                                                                </div>
                                                                            
                                                                            </div>
                                                                            
                                                                        </div>
                    
                                                                        <div class="inv--detail-section inv--customer-detail-section">
                
                                                                            <div class="row">
                    
                                                                                <div class="col-xl-8 col-lg-7 col-md-6 col-sm-4 align-self-center">
                                                                                    <p class="inv-to">Invoice By</p>
                                                                                </div>
                
                                                                                <div class="col-xl-4 col-lg-5 col-md-6 col-sm-8 align-self-center order-sm-0 order-1 inv--payment-info">
                                                                                    <h6 class=" inv-title">Payment Info:</h6>
                                                                                </div>
                                                                                
                                                                                <div class="col-xl-8 col-lg-7 col-md-6 col-sm-4">
                                                                                    <p class="inv-customer-name">{{ sales[0].user.name | '' }}</p>
                                                                                    <p class="inv-street-addr">{{ sales[0].shift }}</p>
                                                                                </div>
                                                                                
                                                                                <div class="col-xl-4 col-lg-5 col-md-6 col-sm-8 col-12 order-sm-0 order-1">
                                                                                    <div class="inv--payment-info">
                                                                                        <p><span class=" inv-subtitle">Mode:</span> <span>{{ sales[0].mode }}</span></p>
                
                                                                                    </div>
                                                                                </div>
                
                                                                            </div>
                                                                            
                                                                        </div>
                
                                                                        <div class="inv--product-table-section">
                                                                            <div class="table-responsive">
                                                                                <table class="table">
                                                                                    <thead class="">
                                                                                        <tr>
                                                                                            <th scope="col">S.No</th>
                                                                                            <th scope="col">Items</th>
                                                                                            <th class="text-right" scope="col">Qty</th>
                                                                                            <th class="text-right" scope="col">Price</th>
                                                                                            <th class="text-right" scope="col">Amount</th>
                                                                                        </tr>
                                                                                    </thead>
                                                                                    <tbody>
                                                                                        <tr v-for="(sale, index) in sales" :key="sale.id">
                                                                                            <td>{{ index+1 }}</td>
                                                                                            <td>{{ JSON.parse(sale.data).name }}</td>
                                                                                            <td class="text-right">{{sale.qty}}</td>
                                                                                            <td class="text-right">{{ JSON.parse(sale.data).selling_price}}</td>
                                                                                            <td class="text-right">{{sale.total}}</td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                            </div>
                                                                        </div>
                                                                        
                                                                        <div class="inv--total-amounts">
                                                                        
                                                                            <div class="row mt-4">
                                                                                <div class="col-sm-5 col-12 order-sm-0 order-1">
                                                                                </div>
                                                                                <div class="col-sm-7 col-12 order-sm-1 order-0">
                                                                                    <div class="text-sm-right">
                                                                                        <div class="row">
                                                                                            <div class="col-sm-8 col-7">
                                                                                                <p class="">Sub Total: </p>
                                                                                            </div>
                                                                                            <div class="col-sm-4 col-5">
                                                                                                <p class="">{{ parseInt(sales[0].invoice_total) - parseInt(sales[0].invoice_discount)}}</p>
                                                                                            </div>
                                                                                           
                                                                                            <div class="col-sm-8 col-7">
                                                                                                <p class=" discount-rate">Discount : </p>
                                                                                            </div>
                                                                                            <div class="col-sm-4 col-5">
                                                                                                <p class="">{{sales[0].invoice_discount}}</p>
                                                                                            </div>
                                                                                            <div class="col-sm-8 col-7 grand-total-title">
                                                                                                <h4 class="">Grand Total : </h4>
                                                                                            </div>
                                                                                            <div class="col-sm-4 col-5 grand-total-amount">
                                                                                                <h4 class="">{{sales[0].invoice_total}}</h4>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                
                                                                        </div>
                
                                                                        <div class="inv--note">
                
                                                                            <div class="row mt-4">
                                                                                <div class="col-sm-12 col-12 order-sm-0 order-1">
                                                                                    <p>Note: Thank you for doing Business with us.</p>
                                                                                </div>
                                                                            </div>
                
                                                                        </div>
                    
                                                                    </div>
                                                                </div> 
                                                                
                                                            </div>
                    
                    
                                                        </div>
                    
                                                    </div>
                
                                                </div>
                
                                                <div class="col-xl-12">
                
                                                    <div class="invoice-actions-btn">
                
                                                        <div class="invoice-action-btn">
                
                                                            <div class="row">
                                                                <div class="col-xl-6 col-md-3 col-sm-6">
                                                                    <a href="#" class="btn btn-primary btn-send" data-toggle="modal" data-target="#createModel">Send Invoice</a>
                                                                </div>
                                                                <div class="col-xl-6 col-md-3 col-sm-6">
                                                                    <a :href="'/print/sales/'+ sales[0].invoice_number" class="btn btn-secondary btn-print  action-print">Print</a>
                                                                </div>
                                                                <div class="col-xl-6 col-md-3 col-sm-6">
                                                                    <a :href="'/export/invoices/pdf/'+sales[0].invoice_number" class="btn btn-success btn-download">Download</a>
                                                                </div>
                                                                <div class="col-xl-6 col-md-3 col-sm-6">
                                                                    <inertia-link :href="'/sales/'+sales[0].invoice_number+'/edit'" class="btn btn-dark btn-edit">Edit</inertia-link>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                    </div>
                                                    
                                                </div>
                
                
                                            </div>
                                            
                                            
                                        </div>
                
                                    </div>


                                    <div class="modal fade" id="createModel" tabindex="-1" role="dialog" aria-labelledby="createModelLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
<form  method="POST" @submit.prevent="sendMail"> 
        <div class="modal-content">
            
            <div class="modal-header">
                <h5 class="modal-title" id="createModelLabel">Send Invoice</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>
            <div class="modal-body">
                
                <div class="form-row mb-4">
                                                        <div class="form-group col-md-10">
                                                            <label for="email">Email</label>
                                                            <input type="email" class="form-control" id="email" v-model="mail.to" required  placeholder="Johndoe@gmail.com">
                                                        </div>
                                                        </div>


                
            </div>
            <div class="modal-footer">
                <button class="btn btn-danger" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Cancel</button>
                <button type="submit" class="btn btn-success">Mail Invoice</button>
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
import axios from 'axios';

export default {
  // Using the shorthand
//   layout: Layout,

props : ['sales'], 
  data: function () {
    return {
        mail : {
            to: '',
            invoice : ''
        }
    };
  },


created : function(){
    $(document).ready(function(){
        $('.remove').remove();
    })
},

mounted : function(){
      this.isLoading = false;
},

components: {
'layout' : Layout,
  },

  methods: {
      sendMail(){
          this.mail.invoice = this.sales[0].invoice_number;
          axios.post(route('mail.invoice'), this.mail)
          .then((response) => {
                this.$toast.success(response.data.success);
                this.mail.to = '';
                $('#createModel').modal('hide');
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
