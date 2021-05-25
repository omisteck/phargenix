<template>
<layout :page_title="'Categories'">
 <div class="row layout-top-spacing" id="cancel-row">
    <a href="#" @click='createCategory' class="btn btn-success mb-3 ml-3" >Create Category</a>
                                    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                                        <div class="widget-content widget-content-area br-6">
                                            <table id="zero-config" class="table dt-table-hover" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th>Category Name</th>
                                                        <th>Status</th>
                                                        <th>Date</th>
                                                        <th class="no-content">Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr v-for="category in categories" :key="category.id">
                                                        <td>{{ category.name }}</td>
                                                        <td>{{ category.status }}</td>
                                                        <td>{{ category.created_at | moment("ddd, MMM Do YYYY") }}</td>
                                                        <td class="text-center">
                                                            
                                                            <div class="btn-group " role="group">
                                                                <button id="btnGroupVerticalDrop2" type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                Action
                                                                </button>
                                                                <div class="dropdown-menu" aria-labelledby="btnGroupVerticalDrop2">
                                                                    <a class="dropdown-item" @click="editCategory(category)" href="#">Edit</a>
                                                                    <a class="dropdown-item text-danger " @click="deleteCategory(category)" href="#">Delete</a>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th>Category Name</th>
                                                        <th>Status</th>
                                                        <th>Date</th>
                                                        <th class="no-content">Actions</th>
                                                    </tr>
                                                </tfoot>
                                            </table>
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
                                                        <div class="form-group col-md-6">
                                                            <label for="editcontact">Company Contact</label>
                                                            <input type="tel" class="form-control" id="editcontact" v-model="edit.contact" required placeholder="08108568996">
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

props : {
    categories : {
      type: Object,
      default: function () {
        return { "id": null, "name": null, "status": null, "created_at": null };
      }
    }
},

  data: function () {
    return {
       newCategory : {
           name : '',
       },
       edit : {},
    };
  },

mounted : function(){
    $('#zero-config').DataTable({
            "dom": "<'dt--top-section'<'row'<'col-12 col-sm-6 d-flex justify-content-sm-start justify-content-center'l><'col-12 col-sm-6 d-flex justify-content-sm-end justify-content-center mt-sm-0 mt-3'f>>>" +
        "<'table-responsive'tr>" +
        "<'dt--bottom-section d-sm-flex justify-content-sm-between text-center'<'dt--pages-count  mb-sm-0 mb-3'i><'dt--pagination'p>>",
            "oLanguage": {
                "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
                "sInfo": "Showing page _PAGE_ of _PAGES_",
                "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                "sSearchPlaceholder": "Search...",
               "sLengthMenu": "Results :  _MENU_",
            },
            "stripeClasses": [],
            "lengthMenu": [5, 10, 20, 50],
            "pageLength": 5 ,
        });

},
created : function () {
$('#profile').remove();
     $('head').append( $('<link rel="stylesheet" id="table" type="text/css" />').attr('href', '/dashboard/plugins/table/datatable/dt-global_style.css') );
},

components: {
'layout' : Layout,
    
  },

  methods: {
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
                this.$inertia.reload();
            })
            .catch(error => {
                this.$toast.error(error.response.data.message, 'Error');
            });
    },

      storeCategory(){
          axios.post(route('categories.store'), this.newCategory)
        .then((response) => {
                this.$toast.success(response.data.success);
                this.newCategory= {};
                $('#createModel').modal('hide');
                // this.$inertia.reload();
                window.location.reload()
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
                this.$inertia.reload();
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
