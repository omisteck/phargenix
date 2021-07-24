<template>
<layout :page_title="'Remit'">
 <div class="row layout-top-spacing" id="cancel-row">
     <div class="col-lg-12">
        <a href="#" class="btn btn-success mb-3 ml-3"  data-toggle="modal" data-target="#createModel" >New Remit</a>
     </div>
    

                                    <div class="col-xl-11 col-lg-11 col-sm-12  layout-spacing">
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
                                                        <th>Date</th>
                                                        <th>Staff</th>
                                                        <th>Cash</th>
                                                        <th>Pos</th>
                                                        <th>Transfer</th>
                                                        <th>Total</th>
                                                        <th>Remit Total</th>
                                                        <th>Balance</th>
                                                        <th class="no-content">Actions</th>
                                                    </tr>
                </thead>
                <tbody>
                    <tr v-for="remit in laravelData.data" :key="remit.id">
                        <td>{{ remit.created_at | moment("ddd, MMM Do YYYY") }}</td>
                        <td v-if="remit.user">{{ remit.user.name }}</td>
                        <td v-else>User Deleted</td>
                        <td>&#8358;{{ remit.Cash }}</td>
                        <td>&#8358;{{ remit.POS }}</td>
                        <td>&#8358;{{ remit.Transfer }}</td>
                        <td>{{ remit.Total }}</td>
                        <td>{{ remit.Remitted }}</td>
                        <td>{{ remit.Balance }}</td>

                                                        <td class="text-center">
                                                          <a href="#" @click="delItem(remit)">
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg> 
                                                                        </a>
                                                        <a href="#" @click="editRecon(remit)">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg>
                                                        </a>
                                                        </td>
                    </tr>


                </tbody>
                <tfoot>
                    <tr>
                       <th>Date</th>
                                                        <th>Staff</th>
                                                        <th>Cash</th>
                                                        <th>Pos</th>
                                                        <th>Transfer</th>
                                                        <th>Total</th>
                                                        <th>Remit Total</th>
                                                        <th>Balance</th>
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
<form  method="POST" @submit.prevent="remitSave"> 
        <div class="modal-content">
            
            <div class="modal-header">
                <h5 class="modal-title" id="createModelLabel">Remit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>
            <div class="modal-body">

                   <div class="form-row mb-2">
                        <div class="form-group col-md-6">
                            <label for="type">Staff</label>
                            <div class="col">
                                                         <select id="staff" class="form-control d-inline-block" v-model="remit.staff" @change="getData" required>
                                                                <option value='' disabled>Select Staff</option>
                                                                <option v-for="staff in staffs" :key="staff.id" :value="staff.user.id" >{{staff.user.name}}</option>
                                                            </select>
                                                      </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="qty">Date</label>
                            <input type="date" v-model="remit.date" @change="getData" class="form-control text-primary" required >
                        </div>
                   </div>
                <div>
                    <vue-element-loading :active="Loading" spinner="bar-fade-scale"  color="#009688" />
                   <div class="form-row mb-2">
                        <div class="form-group col-md-4">
                            <label>Cash</label>
                            <h2>{{ remit.cash }}</h2>
                        </div>
                        <div class="form-group col-md-4">
                            <label>POS</label>
                            <h2>{{ remit.pos }}</h2>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Transfer</label>
                            <h2>{{ remit.transfer }}</h2>
                        </div>
                   </div>

                   <div class="form-row mb-1" v-if="show">
                       <a :href="'/staff/sales/details?staff=' + remit.staff + '&date=' + remit.date" > View Sales List</a>
                   </div>


                   <div class="form-row mb-2">
                        <div class="form-group col-md-6">
                            <label for="type">Expected Remit</label>
                             <input type="number" v-model="remit.total" disabled class="form-control text-primary" required >
                        </div>
                        <div class="form-group col-md-6">
                            <label for="qty">Remitted Cash</label>
                            <input type="number" v-model="remit.remitted" class="form-control text-primary" required >
                        </div>
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

<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="editLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
<form  method="POST" @submit.prevent="remitUpdate"> 
        <div class="modal-content">
            
            <div class="modal-header">
                <h5 class="modal-title" id="editLabel">Edit remit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>
            <div class="modal-body">

                   <div class="form-row mb-2">
                        <div class="form-group col-md-6">
                            <label for="type">Staff</label>
                            <input v-if="edit.user" type="text" v-model="edit.user.name" class="form-control text-primary" required >
                        </div>
                        <div class="form-group col-md-6">
                            <label for="qty">Date</label>
                            <input type="date" v-model="edit.Date" class="form-control text-primary" required >
                        </div>
                   </div>
                <div>
                   <div class="form-row mb-2">
                        <div class="form-group col-md-4">
                            <label>Cash</label>
                            <h2>{{ edit.Cash }}</h2>
                        </div>
                        <div class="form-group col-md-4">
                            <label>POS</label>
                            <h2>{{ edit.POS }}</h2>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Transfer</label>
                            <h2>{{ edit.Transfer }}</h2>
                        </div>
                   </div>

                   <div class="form-row mb-1">
                       <a :href="'/staff/sales/details?staff=' + edit.staff + '&date=' + edit.date" > View Sales List</a>
                   </div>


                   <div class="form-row mb-2">
                        <div class="form-group col-md-6">
                            <label for="type">Expected Remit</label>
                             <input type="number" v-model="edit.Total" disabled class="form-control text-primary" required >
                        </div>
                        <div class="form-group col-md-6">
                            <label for="qty">Remitted Cash</label>
                            <input type="number" v-model="edit.Remitted" class="form-control text-primary" required >
                        </div>
                   </div>
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
props: ['staffs'],
  data: function () {
    return {
        laravelData: {},
       filter : {
           pagination : 5,
           search : '',
       },
       isLoading: false,
       Loading: false,
       show: false,
       remit : {},
       edit : {},
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
   this.getResults();
   this.isLoading = false;
},

  methods: {

editRecon(remit){
    this.edit = remit;
    $('#edit').modal('show');
},

getData(){
    if(this.remit.staff  && this.remit.date){
        this.Loading =true;
        axios.post('remit/stat', this.remit)
            .then( response => {
                this.remit.pos = response.data.pos;
                this.remit.cash = response.data.cash;
                this.remit.transfer = response.data.transfer;
                this.remit.total = response.data.total;
                this.show = true;
                this.Loading = false;
            });
    }
},
      remitSave(){
          this.isLoading = true;
        axios.put(route('remit.store'), this.remit)
        .then((response) => {
                this.remit = {};
                this.show = false;
                this.getResults();
                this.isLoading = false;
                $('#createModel').modal('hide');
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

    remitUpdate(){
        this.isLoading = true;
        axios.put(route('remit.update', this.edit.id), this.edit )
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

                axios.get('/api/remit?page=' + page +"&pagination=" + this.filter.pagination  +"&search=" + this.filter.search)
                    .then( response => {
                        this.laravelData = response.data;
                    });
            },


    delItem(remit){
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
            axios.delete(route('remit.destroy',{'remit' : remit.id}))
            .then((response) => {
                this.getResults();
                this.isLoading = false;
               this.$swal.fire(
                    'Deleted!',
                    'remit Deleted succesfully.',
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
