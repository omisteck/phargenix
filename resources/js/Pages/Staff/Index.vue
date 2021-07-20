<template>
<layout :page_title="'Staffs'">
 <div class="row layout-top-spacing" id="cancel-row">
     
<div class="col-lg-12">
     <a href="#" class="btn btn-success mb-3 ml-3" data-toggle="modal" data-target="#createModel">Create Staff</a>
</div>

     <div class="col-xl-10 col-lg-10 col-sm-12  layout-spacing">

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
                        <th>Name</th>
                                                        <th>Position</th>
                                                        <th>Office</th>
                                                        <th>Start date</th>
                                                        <th>Last login</th>
                                                        <th class="no-content">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    
 <tr v-for="staff in laravelData.data" :key="staff.id" v-if="staff.user != null">
         <td>{{ staff.user.name }}</td>
        <td>{{ staff.user.position }}</td>
                                                        <td v-if="staff.branch != null ">{{ staff.branch.shortname }}</td>
                                                        <td v-else>No Branch </td>
                                                        <td>{{ staff.user.created_at | moment("ddd, MMM Do YYYY") }}</td>
                                                        <td>{{ staff.user.last_login | moment("ddd, MMM Do YYYY") }}</td>
                                                         <td class="text-center">
                                                            
                                                            <div class="btn-group " role="group">
                                                                <button id="btnGroupVerticalDrop2" type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                Action
                                                                </button>
                                                                <div class="dropdown-menu" aria-labelledby="btnGroupVerticalDrop2">
                                                                    <a href="#" @click="edit(staff)" class="dropdown-item">Edit</a>
                                                                    <a class="dropdown-item text-danger " @click="deleteStaff(staff.user)" href="#">Delete</a>
                                                                </div>
                                                            </div>
                                                        </td>

                                                    </tr> 

                </tbody>
                <tfoot>
                    <tr>
                        <th>Name</th>
                                                        <th>Position</th>
                                                        <th>Office</th>
                                                        <th>Start date</th>
                                                        <th>Last login</th>
                                                        <th></th>
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
<form  method="POST" @submit.prevent="createStaff"> 
        <div class="modal-content">
            
            <div class="modal-header">
                <h5 class="modal-title" id="createModelLabel">Add Staff</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>
            <div class="modal-body">
                

                                                    <div class="form-row mb-4">
                                                        <div class="form-group col-md-6">
                                                            <label for="name">Name</label>
                                                            <input type="text" class="form-control" id="name" v-model="staff.name" required  placeholder="John Doe">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="shortname">Username</label>
                                                            <input type="text" class="form-control" id="shortname" v-model="staff.username"  required placeholder="Doe201">
                                                        </div>
                                                    </div>

                                                     <div class="form-group mb-4">
                                                        <label for="password">Password</label>
                                                        <input type="password" class="form-control" id="password" v-model="staff.password" >
                                                    </div>
                    
                                                <div class="form-row mb-4">
                                                        <div class="form-group col-md-6">
                                                            <label for="email">Email</label>
                                                        <input type="text" class="form-control" id="email" v-model="staff.email" placeholder="Johndoe@gmail.com">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="phone">Phone</label>
                                                            <input type="text" class="form-control" id="phone" v-model="staff.phone" required placeholder="09064629981">
                                                        </div>
                                                    </div>
                                                  <div class="form-row mb-4">
                                                      <div class="form-group col-md-3">
                                                        <label for="address">Role</label>
                                                        <select class="form-control d-inline-block" v-model="staff.position" required>
                                                            <option v-for="role in roles" :key="role.id" :value="role.name" >{{ role.name }}</option>
                                                        </select>
                                                      </div>

                                                      <div class="form-group col-md-9">
                                                        <label for="address">Address</label>
                                                        <input type="text" class="form-control" id="address" v-model="staff.address" placeholder="1234 Main Street, Lagos State, Nigeria">
                                                      </div>
                                                    </div>

                                                     <div class="form-group mb-4">
                                                         <label for="address">Branch</label>
<vue-taggable-select
    make-it-taggable="good!"
    :taggable="true"
    v-model="staff.branch"
    :options="branches"
></vue-taggable-select>
                                                    </div>


                                                
                
            </div>
            <div class="modal-footer">
                <button class="btn btn-danger" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>
                <button type="submit" class="btn btn-primary">Create Staff</button>
            </div>
        </div>
    </form>
    </div> 
</div>



<div class="modal fade" id="editModel" tabindex="-1" role="dialog" aria-labelledby="editModelLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
<form  method="POST" @submit.prevent="updateStaff"> 
        <div class="modal-content">
            
            <div class="modal-header">
                <h5 class="modal-title" id="editModelLabel">Edit {{ staff.name }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>
            <div class="modal-body">
                
                

                                                    <div class="form-row mb-4">
                                                        <div class="form-group col-md-6">
                                                            <label for="name">Name</label>
                                                            <input type="text" class="form-control" id="name" v-model="staff.name" required  placeholder="John Doe">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="shortname">Username</label>
                                                            <input type="text" class="form-control" id="shortname" v-model="staff.username"  required placeholder="Doe201">
                                                        </div>
                                                    </div>

                                                     <div class="form-group mb-4">
                                                        <label for="password">Password</label>
                                                        <input type="password" class="form-control" id="password" v-model="staff.password" >
                                                    </div>
                    
                                                <div class="form-row mb-4">
                                                        <div class="form-group col-md-6">
                                                            <label for="email">Email</label>
                                                        <input type="text" class="form-control" id="email" v-model="staff.email" placeholder="Johndoe@gmail.com">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="phone">Phone</label>
                                                            <input type="text" class="form-control" id="phone" v-model="staff.phone" required placeholder="09064629981">
                                                        </div>
                                                    </div>
                                                  <div class="form-group mb-4">
                                                        <label for="address">Address</label>
                                                        <input type="text" class="form-control" id="address" v-model="staff.address" placeholder="1234 Main Street, Lagos State, Nigeria">
                                                    </div>

                                                     <div class="form-group mb-4">
                                                         <label for="address">Branch</label>
                                                         <vue-taggable-select
    make-it-taggable="good!"
    :taggable="true"
    v-model="editBranch"
    :options="branches"
></vue-taggable-select>
<div class="mt-3">
<h6>Selected: </h6>
<p class="text-secondary">
    <button type="button" @click="deleteBranch(branch, index)" class="btn btn-primary m-2" v-for="(branch, index) in editBranch" :key="branch">
  {{ branch }} <span class="badge badge-danger">x</span>
  <span class="sr-only">delete</span>
</button>
 </p>
</div>

      
                                              </div>


                                                     <div class="form-group mb-4">
                                                         <label for="address">Role</label>
                                                        <select class="form-control" v-model="staff.position" required>
                                                            <option v-for="role in roles" :key="role.id" :value="role.name" >{{ role.name }}</option>
                                                        </select>
                                                    </div>

                
            </div>
            <div class="modal-footer">
                <button class="btn btn-danger" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>
                <button type="submit" class="btn btn-primary">Update Staff</button>
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
import VueTaggableSelect from "vue-taggable-select";

export default {
  // Using the shorthand
//   layout: Layout,

props : ['branches', 'roles'],

  data: function () {
    return {
    
        laravelData: {},
       filter : {
           pagination : 5,
           search : '',
       },
        staff : {
              name : '',
            username : '',
            password : '',
            phone : '',
            email : '',
            address : '',
            position : '',
            branch : [],
        },

        editBranch : {
        },
    };
  },


mounted : function(){
   this.getResults();
      this.isLoading = false;
},

created : function () {
      this.isLoading = true;
     $('head').append( $('<link rel="stylesheet" id="table" class="remove" type="text/css" />').attr('href', '/dashboard/plugins/table/datatable/dt-global_style.css') );
},

components: {
'layout' : Layout,
    VueTaggableSelect
  },

  methods: {

       notEmptyObject(someObject){
      return Object.keys(someObject).length
    },

      edit(user){
          this.staff = user.user;
          axios.get(route('staff.branches', {user : this.staff.id}))
          .then(response => {
              this.editBranch = response.data;
          });
    
          $('#editModel').modal('show');
      },
      getResults(page =1) {

                axios.get('api/staffs?page=' + page +"&pagination=" + this.filter.pagination  +"&search=" + this.filter.search)
                    .then( response => {
                        this.laravelData = response.data;
                    });
            },

    createStaff(){
            axios.post(route('user.store'), this.staff)
        .then((response) => {
                this.staff= {};
                $('#createModel').modal('hide');
                this.$toast.success(response.data.success);
                this.getResults();
            })
            .catch(error => {
                let errors = error.response.data.errors;
                for (let field of Object.keys(errors)) {
                    this.$toast.error(errors[field][0], 'error');
                }
            });
        },

    deleteStaff(staff){

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
            axios.delete(route('user.destroy',{'user': staff.id}))
            .then((response) => {
                
               this.$swal.fire(
                    'Deleted!',
                    'Your deleted a staff successfully.',
                    'success'
                    );
                    this.getResults();
                // this.$inertia.visit('staffs');
            })
             .catch(error => {
                let errors = error.response.data.errors;
                for (let field of Object.keys(errors)) {
                    this.$toast.error(errors[field][0], 'error');
                }
            });
  } 
})

    },
updateStaff(){
    this.staff.branch = this.editBranch;
            axios.put(route('user.update', this.staff.id), this.staff)
        .then((response) => {
                this.$toast.success(response.data.success);
                this.staff ={};
                $('#editModel').modal('hide');
                this.getResults();
            })
            .catch(error => {
                this.isLoading = false;
                let errors = error.response.data.errors;
                for (let field of Object.keys(errors)) {
                    this.$toast.error(errors[field][0], 'error');
                }
            });
        },
deleteBranch(branch, index){
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
            axios.post(route('deleteBranch',{'branch': branch, 'user' : this.staff.id }))
            .then((response) => {
               this.$swal.fire(
                    'Deleted!',
                    'You remove a branch successfully.',
                    'success'
                    );
                this.editBranch.splice(index,1);
                this.getResults();
            })
             .catch(error => {
                let errors = error.response.data.errors;
                for (let field of Object.keys(errors)) {
                    this.$toast.error(errors[field][0], 'error');
                }
            });
  } 
})
        },
  }

};

</script>