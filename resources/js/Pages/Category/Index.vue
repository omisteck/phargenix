<template>
<layout :page_title="'Categories'">
 <div class="row layout-top-spacing" id="cancel-row">
     <div class="col-lg-12">
    <a href="#" @click='createCategory' class="btn btn-success mb-3 ml-3" >Create Category</a>

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
                        <th>Category Name</th>
                         <th>Status</th>
                        <th>Date</th>
                        <th class="no-content">Actions</th>
                    </tr>
                </thead>
                <tbody>

                    <tr role="row" v-for="data in laravelData.data" :key="data.id">
                        <td class="">{{ data.name }}</td>
                        <td class="">{{ data.status }}</td>
                        <td>{{ data.created_at | moment("ddd, MMM Do YYYY") }}</td>
                        <td class="text-center">
                            <div role="group" class="btn-group "><button id="btnGroupVerticalDrop2" type="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                    class="btn btn-secondary btn-sm dropdown-toggle">
                                    Action
                                </button>
                                <div aria-labelledby="btnGroupVerticalDrop2" class="dropdown-menu"><a href="#"
                                        class="dropdown-item" @click="editCategory(data)">Edit</a> <a href="#"
                                        class="dropdown-item text-danger" @click="deleteCategory(data)">Delete</a></div>
                            </div>
                        </td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <th rowspan="1" colspan="1">Category Name</th>
                        <th rowspan="1" colspan="1">Status</th>
                        <th rowspan="1" colspan="1">Date</th>
                        <th class="no-content" rowspan="1" colspan="1">Actions</th>
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

<div class="modal fade" id="createModel" tabindex="-1" role="dialog" aria-labelledby="createModelLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <form @submit.prevent="storeCategory">
        <div class="modal-content">
            
            <div class="modal-header">
                <h5 class="modal-title" id="createModelLabel">Add Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>
            <div class="modal-body">
                
                
                                                    <div class="form-row mb-4">
                                                            <label for="name">Category Name</label>
                                                            <input type="text" class="form-control" id="name" v-model="newCategory.name" required  placeholder="Drug">
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



<div class="modal fade" id="editModel" tabindex="-1" role="dialog" aria-labelledby="editModelLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <form @submit.prevent="updateCategory">
        <div class="modal-content">
            
            <div class="modal-header">
                <h5 class="modal-title" id="createModelLabel">Update Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>
            <div class="modal-body">
                
                
                                                    <div class="form-row mb-4">
                                                        <div class="form-group col-md-6">
                                                            <label for="editname">Category Name</label>
                                                            <input type="text" class="form-control" id="editname" v-model="edit.name" required  placeholder="Pharmacy Plus ">
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

</layout>
</template>

<script>
import Layout from "../Layout/Layout.vue";
import { Inertia } from '@inertiajs/inertia'

export default {
  // Using the shorthand
//   layout: Layout,


  data: function () {
    return {
       newCategory : {
           name : '',
       },
       edit : {},

       laravelData: {},
       filter : {
           pagination : 5,
           search : '',
       },

    };
  },

mounted : function(){
   this.getResults();
      this.isLoading = true;
},

created : function () {
      this.isLoading = true;
     $('head').append( $('<link rel="stylesheet" id="table" class="remove" type="text/css" />').attr('href', '/dashboard/plugins/table/datatable/dt-global_style.css') );
},

components: {
'layout' : Layout,
    
  },

  methods: {

      getResults(page =1) {

                axios.get('api/categories?page=' + page +"&pagination=" + this.filter.pagination  +"&search=" + this.filter.search)
                    .then( response => {
                        this.laravelData = response.data;
                    });
            },

      createCategory(){
          $('#createModel').modal('show');
      },

      editCategory(category){
          this.edit = category
          $('#editModel').modal('show');
      },
      updateCategory(){
         axios.put(route('categories.update', this.edit.id), this.edit)
        .then((response) => {
                this.$toast.success(response.data.success);
                $('#editModel').modal('hide');
                this.$inertia.visit('/categories');
            })
            .catch(error => {
                let errors = error.response.data.errors;
                for (let field of Object.keys(errors)) {
                    this.$toast.error(errors[field][0], 'error');
                }
            });
    },

      storeCategory(){
          axios.post(route('categories.store'), this.newCategory)
        .then((response) => {
                this.$toast.success(response.data.success);
                this.newCategory= {};
                $('#createModel').modal('hide');
                this.$inertia.visit('/categories');
            
            })
            .catch(error => {
                this.isLoading = false;
                let errors = error.response.data.errors;
                for (let field of Object.keys(errors)) {
                    this.$toast.error(errors[field][0], 'error');
                }
            });
      },
    deleteCategory(category){
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
            axios.delete(route('categories.destroy',{'category': category.id}))
            .then((response) => {
                this.isLoading = false;
               this.$swal.fire(
                    'Deleted!',
                    'Your deleted a staff successfully.',
                    'success'
                    );
                this.$inertia.visit('/categories');
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
