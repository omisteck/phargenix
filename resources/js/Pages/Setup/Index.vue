<template>
<layout :page_title="'Setup'">
  <div class="row">
    <div class="col-lg-10 col-12 layout-spacing">
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
                                                        <th>Shortname</th>
                                                        <th>Address</th>
                                                        <th>Phone</th>
                                                        <th>Email</th>
                                                        <th>Date</th>
                                                        <th class="no-content">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    
 <tr v-for="branch in laravelData.data" :key="branch.id">
<td >{{ branch.name }}</td>
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
import VueLoadingButton from 'vue-loading-button';
import VueElementLoading from "vue-element-loading";

export default {
  // Using the shorthand
//   layout: Layout,

  data: function () {
    return {
        
        laravelData: {},
       filter : {
           pagination : 5,
           search : '',
       },
    //   business:{
    //     newLogo: '',
    //   },
      newBranch : {
          name : '',
          shortname: '',
          email : '',
          address: '',
          phone : '',

      },
      edit : {},
      delete : '',
      isLoading: false,

    };
  },

props :{
    business : {
        type: Object,
      default: function () {
        return { logo: '', name: ''};
      }
    }, 
    branches : {
         type: Object,
      default: function () {
        return [{"id": null,"name":null,"shortname":null,"address":null,"phone":null,"email":null,"created_at":null,"updated_at":null}];
      }
    }
    },
  
created : function () {
    this.isLoading = true;
    this.getBusiness()
},

mounted : function(){
   this.getResults();
   this.isLoading = false;
},
components: {
    VueLoadingButton,
    VueElementLoading,
'layout' : Layout,
    
  },

  methods: {
     
      getResults(page =1) {

                axios.get('api/branch?page=' + page +"&pagination=" + this.filter.pagination  +"&search=" + this.filter.search)
                    .then( response => {
                        this.laravelData = response.data;
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
                this.getResults();
            })
            .catch(error => {
                let errors = error.response.data.errors;
                for (let field of Object.keys(errors)) {
                    this.$toast.error(errors[field][0], 'error');
                }
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
                this.newBranch= {};
                this.getResults();
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
                this.getResults();
                this.isLoading = false;
               this.$swal.fire(
                    'Deleted!',
                    'Your branch has been deleted.',
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
