<template>
<layout :page_title="'Products'">
 <div class="row layout-top-spacing" id="cancel-row">
     <div class="col-lg-12">
        <a href="#" data-toggle="modal" data-target="#createModel" class="btn btn-success mb-3 ml-3" >Create Product</a>
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
                                                        <th>Product Name</th>
                                                        <th>Branch</th>
                                                        <th>Selling Price</th>
                                                        <th>Cost Price</th>
                                                        <th>Instore</th>
                                                        <th class="no-content">Actions</th>
                                                    </tr>
                </thead>
                <tbody>

 <tr v-for="product in laravelData.data" :key="product.id">
 <td>{{ product.name }}</td>
                                                        <td>{{ product.branch.shortname }}</td>
                                                        <td>{{ product.selling_price }}</td>
                                                        <td>{{ product.cost_price }}</td>
                                                        <td>{{ product.instore }}</td>
                                                        <td class="text-center">
                                                            
                                                            <div class="btn-group " role="group">
                                                                <button id="btnGroupVerticalDrop2" type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                Action
                                                                </button>
                                                                <div class="dropdown-menu" aria-labelledby="btnGroupVerticalDrop2">
                                                                    <a class="dropdown-item" @click="editProduct(product)" href="#">Edit</a>
                                                                    <a class="dropdown-item text-danger " @click="deleteProduct(product)" href="#">Delete</a>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr> 

                </tbody>
                <tfoot>
                    <tr>
                       <th>Product Name</th>
                                                        <th>Branch</th>
                                                        <th>Selling Price</th>
                                                        <th>Cost Price</th>
                                                        <th>Instore</th>
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

<div class="modal fade" id="createModel" tabindex="-1" role="dialog" aria-labelledby="createModelLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <form @submit.prevent="storeProduct">
        <div class="modal-content">
            
            <div class="modal-header">
                <h5 class="modal-title" id="createModelLabel">Add Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>
            <div class="modal-body">
                
                
                                                    <div class="form-row mb-4">
                                                            <label for="name">Product Name</label>
                                                            <input type="text" class="form-control" id="name" v-model="product.name" required  placeholder="Pharmacy Plus ">
                                                    </div>

                                                    <div class="form-row mb-4">
                                                        <div class="form-group col-md-6">
                                                            <label for="sale">Selling Price</label>
                                                            <input type="text" class="form-control" id="sale" v-model="product.selling_price"  required placeholder="Mr James">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="sales_contact">Cost Price</label>
                                                            <input type="tel" class="form-control" id="sales_contact" v-model="product.cost_price" required placeholder="09064629981">
                                                        </div>
                                                    </div>

                                                     <div class="form-row mb-4">
                                                      <div class="form-group col-md-6">
                                                        <label for="address">Category</label>
                                                        <select class="form-control d-inline-block" v-model="product.category_id" required>
                                                            <option value='' disabled>Select Category</option>
                                                            <option v-for="category in categories" :key="category.id" :value="category.id" >{{ category.name }}</option>
                                                        </select>
                                                      </div>

                                                      <div class="form-group col-md-6">
                                                        <label for="address">For Branch</label>
                                                        <select class="form-control d-inline-block" v-model="product.branch_id" required>
                                                            <option value='' disabled>Select Branch</option>
                                                            <option v-for="branch in branchies" :key="branch.id" :value="branch.id" >{{ branch.shortname }}</option>
                                                        </select>
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



<div class="modal fade" id="editModel" tabindex="-1" role="dialog" aria-labelledby="editModelLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <form @submit.prevent="updateProduct">
        <div class="modal-content">
            
            <div class="modal-header">
                <h5 class="modal-title" id="createModelLabel">Update Supplier</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>
            <div class="modal-body">
                
                
                                                <div class="form-row mb-4">
                                                            <label for="name">Product Name</label>
                                                            <input type="text" class="form-control" id="name" v-model="edit.name" required  placeholder="Pharmacy Plus ">
                                                    </div>

                                                    <div class="form-row mb-4">
                                                        <div class="form-group col-md-6">
                                                            <label for="sale">Selling Price</label>
                                                            <input type="text" class="form-control" id="sale" v-model="edit.selling_price"  required placeholder="Mr James">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="sales_contact">Cost Price</label>
                                                            <input type="tel" class="form-control" id="sales_contact" v-model="edit.cost_price" required placeholder="09064629981">
                                                        </div>
                                                    </div>

                                                     <div class="form-row mb-4">
                                                      <div class="form-group col-md-6">
                                                        <label for="address">Category</label>
                                                        <select class="form-control d-inline-block" v-model="edit.category_id" required>
                                                            <option value='' disabled>Select Category</option>
                                                            <option v-for="category in categories" :key="category.id" :value="category.id" >{{ category.name }}</option>
                                                        </select>
                                                      </div>

                                                      <div class="form-group col-md-6">
                                                        <label for="address">For Branch</label>
                                                        <select class="form-control d-inline-block" v-model="edit.branch_id" required>
                                                            <option value='' disabled>Select Branch</option>
                                                            <option v-for="branch in branchies" :key="branch.id" :value="branch.id" >{{ branch.shortname }}</option>
                                                        </select>
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

props : ['branchies', 'categories'],

  data: function () {
    return {
        laravelData: {},
       filter : {
           pagination : 5,
           search : '',
       },

        product : {
            name : '',
            category_id : '',
            branch_id : '',
            cost_price : 0,
            selling_price : 0,
        },
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
   this.getResults();
      this.isLoading = false;
},

  methods: {

      getResults(page =1) {
          this.isLoading = true;
                axios.get('api/products?page=' + page +"&pagination=" + this.filter.pagination  +"&search=" + this.filter.search)
                    .then( response => {
                        this.laravelData = response.data;
                        this.isLoading = false;
                    });
            },

      editProduct(product){
          this.edit = product;
          $('#editModel').modal('show');
      },
      updateProduct(){
         axios.put(route('products.update', this.edit.id), this.edit)
        .then((response) => {
                this.$toast.success(response.data.success);
                $('#editModel').modal('hide');
                this.$inertia.visit('products');
            })
            .catch(error => {
                let errors = error.response.data.errors;
                for (let field of Object.keys(errors)) {
                    this.$toast.error(errors[field][0], 'error');
                }
            });
    },

      storeProduct(){
          axios.post(route('products.store'), this.product)
        .then((response) => {
                this.$toast.success(response.data.success);
                this.product= {};
                $('#createModel').modal('hide');
                this.$inertia.visit('products');
            })
            .catch(error => {
                this.isLoading = false;
                let errors = error.response.data.errors;
                for (let field of Object.keys(errors)) {
                    this.$toast.error(errors[field][0], 'error');
                }
            });
      },
    deleteProduct(product){
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
            axios.delete(route('products.destroy',{'product': product.id}))
            .then((response) => {
                this.isLoading = false;
               this.$swal.fire(
                    'Deleted!',
                    'Your deleted a Product successfully.',
                    'success'
                    );
                this.$inertia.visit('products');
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
