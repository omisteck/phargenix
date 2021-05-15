<template>
<layout :page_title="'Setup'">
  <div class="row">
    <div class="col-lg-12 col-12 layout-spacing">
                                        <div class="statbox widget box box-shadow">
                                            <div class="widget-header">
                                                <div class="row">
                                                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                                        <h4>Business Setup</h4>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="widget-content widget-content-area animated-underline-content">
                                                
                                                <ul class="nav nav-tabs  mb-3" id="animateLine" role="tablist">
                                                    <li class="nav-item">
                                                        <a class="nav-link active" id="organization-tab" data-toggle="tab" href="#organization" role="tab" aria-controls="organization" aria-selected="true"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-briefcase"><rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path></svg> Organization</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" id="branch-tab" data-toggle="tab" href="#branch" role="tab" aria-controls="branch" aria-selected="false"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg> Branch</a>
                                                    </li>
                                                </ul>
                                
                                                <div class="tab-content" id="animateLineContent-4">
                                                    <div class="tab-pane fade show active p-4" id="organization" role="tabpanel" aria-labelledby="organization-tab">
                                                             <vue-element-loading :active="isLoading" spinner="bar-fade-scale"  color="#009688" />
                                                              <form @submit.prevent="saveBusinessDetails" enctype="multipart/form-data">
                                                             <div class="form-row mt-2">
                                                      <div class="form-group col-md-6">
                                                          <label for="inputEmail4">Logo</label>
                                                          <div v-if="business.logo == ''">
                                                            <vue-dropify :multiple="false" v-model="business.newLogo"/>
                                                          </div>
                                                          <div v-else>
                                                            <div style="position: relative;"> <img :src="business.logo" style="width: 30%; display: block" />
                                                                <a href="#" class="btn btn-md btn-primary " style="position: absolute; top: -0;" @click="changeImage"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-3"><path d="M12 20h9"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path></svg></a>
                                                            </div>
                                                            
                                                          </div>
                                                      </div>
                                                  </div>

                                                  <div class="form-row mt-2">
                                                      <div class="form-group col-md-6">
                                                          <label for="business_name">Business Name<span class="text-danger"> * </span> </label>
                                                          <input type="text" class="form-control" id="business_name" placeholder="Business name in full" required v-model="business.name" >
                                                      </div>
                                                  </div>

 <VueLoadingButton :styled="true" aria-label="Post message" @click.native="saveBusinessDetails" :loading="isLoading"> Save</VueLoadingButton>
</form>
                                                    </div>
                                                    <div class="tab-pane fade" id="branch" role="tabpanel" aria-labelledby="branch-tab">
<vue-element-loading :active="isLoading" spinner="bar-fade-scale"  color="#009688" />
                <button type="button" class="btn btn-primary mb-3 ml-3" data-toggle="modal" data-target="#createModel">Create Branch</button>
                                    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                                        <div class="widget-content widget-content-area br-6">
                                            <table id="zero-config" class="table dt-table-hover" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>Shortname</th>
                                                        <th>Address</th>
                                                        <th>Phone</th>
                                                        <th>Email</th>
                                                        <th>Date</th>
                                                        <th class="no-content">Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr v-for="branch in branches" :key="branch.name" role="row"> 
                                                        <td class="sorting_1">{{ branch.name }}</td>
                                                        <td>{{ branch.shortname }}</td>
                                                        <td>{{ branch.address }}</td>
                                                        <td>{{ branch.phone }}</td>
                                                        <td>{{ branch.email }}</td>
                                                        <td>{{ branch.created_at | moment("ddd, MMM Do YYYY") }}</td>

                                                        <td class="text-center">
                                                            
                                                            <div class="btn-group " role="group">
                                                                <button id="btnGroupVerticalDrop2" type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                Acion
                                                                </button>
                                                                <div class="dropdown-menu" aria-labelledby="btnGroupVerticalDrop2">
                                                                    <a class="dropdown-item" href="#" @click="editBranch(branch)">Edit</a>
                                                                    <a class="dropdown-item text-danger " @click="deleteBranch(branch)" href="#">Delete</a>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                   
                                                 
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                       <th>Name</th>
                                                        <th>Shortname</th>
                                                        <th>Address</th>
                                                        <th>Phone</th>
                                                        <th>Email</th>
                                                        <th>Date</th>
                                                        <th class="no-content">Actions</th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                
                                </div>
                                                    </div>
                                                </div>
                                
                                
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal fade" id="createModel" tabindex="-1" role="dialog" aria-labelledby="createModelLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <form @submit.prevent="createBranch">
        <div class="modal-content">
            
            <div class="modal-header">
                <h5 class="modal-title" id="createModelLabel">Create Branch</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>
            <div class="modal-body">
                
                
                                                    <div class="form-row mb-4">
                                                        <div class="form-group col-md-6">
                                                            <label for="name">Branch Name</label>
                                                            <input type="text" class="form-control" id="name" v-model="newBranch.name" required  placeholder="Pharmacy Plus ">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="shortname">Shortname</label>
                                                            <input type="text" class="form-control" id="shortname" v-model="newBranch.shortname"  placeholder="pharma+">
                                                        </div>
                                                    </div>
                                                    <div class="form-group mb-4">
                                                        <label for="address">Address</label>
                                                        <input type="text" class="form-control" id="address" v-model="newBranch.address"  required placeholder="1234 Main St">
                                                    </div>
                                                    <div class="form-row mb-4">
                                                        <div class="form-group col-md-6">
                                                            <label for="email">Email</label>
                                                            <input type="email" class="form-control" id="email" v-model="newBranch.email" required  placeholder="johndoe@gmail.com ">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="phone">Phone</label>
                                                            <input type="tel" class="form-control" id="phone" v-model="newBranch.phone"  required placeholder="09064629981">
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



<div class="modal fade" id="editbranch" tabindex="-1" role="dialog" aria-labelledby="editbranchLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <form @submit.prevent="updateBranch">
        <div class="modal-content">
            
            <div class="modal-header">
                <h5 class="modal-title" id="editbranchLabel">Edit Branch</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>
            <div class="modal-body">
                
                
                                                    <div class="form-row mb-4">
                                                        <div class="form-group col-md-6">
                                                            <label for="name">Branch Name</label>
                                                            <input type="text" class="form-control" id="name" v-model="edit.name" required  placeholder="Pharmacy Plus ">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="shortname">Shortname</label>
                                                            <input type="text" class="form-control" id="shortname" v-model="edit.shortname" required  placeholder="pharma+">
                                                        </div>
                                                    </div>
                                                    <div class="form-group mb-4">
                                                        <label for="address">Address</label>
                                                        <input type="text" class="form-control" id="address" v-model="edit.address"  required placeholder="1234 Main St">
                                                    </div>
                                                    <div class="form-row mb-4">
                                                        <div class="form-group col-md-6">
                                                            <label for="email">Email</label>
                                                            <input type="email" class="form-control" id="email" v-model="edit.email" required  placeholder="johndoe@gmail.com ">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="phone">Phone</label>
                                                            <input type="tel" class="form-control" id="phone" v-model="edit.phone"  required placeholder="09064629981">
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
import VueDropify from 'vue-dropify';
import VueLoadingButton from 'vue-loading-button';
import VueElementLoading from "vue-element-loading";

export default {
  // Using the shorthand
//   layout: Layout,

  data: function () {
    return {
      business:{
        logo: '',
        name: '',
        newLogo: '',
      },
      newBranch : {
          name : '',
          shortname: '',
          email : '',
          address: '',
          phone : '',

      },
      branches : [{"id": '',"name":'',"shortname":"","address":"","phone":"","email":"","created_at":"","updated_at":""}],
      edit : {},
      delete : '',
      isLoading: false,

    };
  },

//   ["business", "branches"],
  
created : function () {
    this.isLoading = true;
    this.getFreshBranch();
    this.getBusiness()
    this.isLoading = false;
},

components: {
    'vue-dropify': VueDropify,
    VueLoadingButton,
    VueElementLoading,
'layout' : Layout,
    
  },

  methods: {

       getFreshBranch(){
        axios.get(route('getBranch'))
        .then((response) => {
            this.branches = response.data.branches;
        });
    },

    getBusiness(){
        axios.get(route('organization.index'))
        .then((response) => {
            if(!response.data.business.length > 0){
                this.business = response.data.business;
            }
            
        });
    },
      
    updateBranch(){
         axios.put(route('branch.update', this.edit.id), this.edit)
        .then((response) => {
                this.$toast.success(response.data.success);
                $('#editbranch').modal('hide');
            })
            .catch(error => {
                this.$toast.error(error.response.data.message, 'Error');
            });
    },
    editBranch(branch){
        this.edit = branch;
        $('#editbranch').modal('show');
    },
    createBranch(){
        axios.post(route('branch.store'), this.newBranch)
        .then((response) => {
                this.isLoading = false;
                this.$toast.success(response.data.success);
                this.getFreshBranch();
                $('#createModel').modal('hide');
            })
            .catch(error => {
                this.isLoading = false;
                let errors = error.response.data.errors;
                for (let field of Object.keys(errors)) {
                    this.$toast.error(errors[field][0], 'error');
                }
            });
    },
    changeImage(){
        this.business.logo = '';    
    },
    saveBusinessDetails() {

        if(this.business.name != ''){
            this.isLoading = true;
            axios.post(route('organization.store'), this.business)
            .then((response) => {
                this.isLoading = false;
                this.$toast.success(response.data.success);
            })
             .catch(error => {
                this.isLoading = false;
                let errors = error.response.data.errors;
                for (let field of Object.keys(errors)) {
                    this.$toast.error(errors[field][0], 'error');
                }
            });
        }else{        
          this.$toast.error("Please enter a business name ");
        }
    // 
    },
   
    deleteBranch(branch_id){
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
            axios.delete(route('branch.destroy',{'branch': branch_id.id}))
            .then((response) => {
                this.isLoading = false;
               this.$swal.fire(
                    'Deleted!',
                    'Your branch has been deleted.',
                    'success'
                    );
                this.getFreshBranch();
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

<style>
@import '/dashboard/plugins/table/datatable/dt-global_style.css';
</style>
