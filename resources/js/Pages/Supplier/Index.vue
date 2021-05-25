<template>
<layout :page_title="'Suppliers'">
 <div class="row layout-top-spacing" id="cancel-row">
    <a href="#" @click='createSupplier' class="btn btn-success mb-3 ml-3" >Create Supplier</a>
                                    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                                        <div class="widget-content widget-content-area br-6">
                                            <table id="zero-config" class="table dt-table-hover" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th>Company name</th>
                                                        <th>Company contact</th>
                                                        <th>Sales Rep</th>
                                                        <th>Sales Rep Contact</th>
                                                        <th>Date</th>
                                                        <th class="no-content">Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr v-for="supplier in suppliers" :key="supplier.id">
                                                        <td>{{ supplier.name }}</td>
                                                        <td>{{ supplier.contact }}</td>
                                                        <td>{{ supplier.sales_rep }}</td>
                                                        <td>{{ supplier.sales_rep_contact }}</td>
                                                        <td>{{ supplier.created_at | moment("ddd, MMM Do YYYY") }}</td>
                                                        <td class="text-center">
                                                            
                                                            <div class="btn-group " role="group">
                                                                <button id="btnGroupVerticalDrop2" type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                Action
                                                                </button>
                                                                <div class="dropdown-menu" aria-labelledby="btnGroupVerticalDrop2">
                                                                    <a class="dropdown-item" @click="editSupplier(supplier)" href="#">Edit</a>
                                                                    <a class="dropdown-item text-danger " @click="deleteStaff(supplier)" href="#">Delete</a>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                         <th>Company name</th>
                                                        <th>Company contact</th>
                                                        <th>Sales Rep</th>
                                                        <th>Sales Rep Contact</th>
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
      <form @submit.prevent="storeSupplier">
        <div class="modal-content">
            
            <div class="modal-header">
                <h5 class="modal-title" id="createModelLabel">Add Supplier</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>
            <div class="modal-body">
                
                
                                                    <div class="form-row mb-4">
                                                        <div class="form-group col-md-6">
                                                            <label for="name">Company Name</label>
                                                            <input type="text" class="form-control" id="name" v-model="newSupplier.name" required  placeholder="Pharmacy Plus ">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="contact">Company Contact</label>
                                                            <input type="tel" class="form-control" id="contact" v-model="newSupplier.contact" required placeholder="08108568996">
                                                        </div>
                                                    </div>

                                                    <div class="form-row mb-4">
                                                        <div class="form-group col-md-6">
                                                            <label for="sale">Sales Rep</label>
                                                            <input type="text" class="form-control" id="sale" v-model="newSupplier.sales_rep" placeholder="Mr James">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="sales_contact">Sales Rep Contact</label>
                                                            <input type="tel" class="form-control" id="sales_contact" v-model="newSupplier.sales_rep_contact"  placeholder="09064629981">
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
      <form @submit.prevent="updateSupplier">
        <div class="modal-content">
            
            <div class="modal-header">
                <h5 class="modal-title" id="createModelLabel">Update Supplier</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>
            <div class="modal-body">
                
                
                                                    <div class="form-row mb-4">
                                                        <div class="form-group col-md-6">
                                                            <label for="editname">Company Name</label>
                                                            <input type="text" class="form-control" id="editname" v-model="edit.name" required  placeholder="Pharmacy Plus ">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="editcontact">Company Contact</label>
                                                            <input type="tel" class="form-control" id="editcontact" v-model="edit.contact" required placeholder="08108568996">
                                                        </div>
                                                    </div>

                                                    <div class="form-row mb-4">
                                                        <div class="form-group col-md-6">
                                                            <label for="editsale">Sales Rep</label>
                                                            <input type="text" class="form-control" id="editsale" v-model="edit.sales_rep" placeholder="Mr James">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="editsales_contact">Sales Rep Contact</label>
                                                            <input type="tel" class="form-control" id="editsales_contact" v-model="edit.sales_rep_contact"  placeholder="09064629981">
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
    suppliers : {
      type: Object,
      default: function () {
        return { "id": null, "name": null, "contact": null, "sales_rep": null, "created_at": null, "sales_rep_contact": null };
      }
    }
},

  data: function () {
    return {
        newSupplier : {
            name : '',
            contact : '',
            sales_rep : '',
            sales_rep_contact : ''
        },
        edit : {},
    };
  },

  
created : function () {
$('#profile').remove();
     $('head').append( $('<link rel="stylesheet" id="table" type="text/css" />').attr('href', '/dashboard/plugins/table/datatable/dt-global_style.css') );
},

components: {
'layout' : Layout,
    
  },

  methods: {
      createSupplier(){
          $('#createModel').modal('show');
      },

      editSupplier(supplier){
          this.edit = supplier
          $('#editModel').modal('show');
      },
      updateSupplier(){
         axios.put(route('suppliers.update', this.edit.id), this.edit)
        .then((response) => {
                this.$toast.success(response.data.success);
                $('#editModel').modal('hide');
                this.$inertia.reload();
            })
            .catch(error => {
                this.$toast.error(error.response.data.message, 'Error');
            });
    },

      storeSupplier(){
          axios.post(route('suppliers.store'), this.newSupplier)
        .then((response) => {
                this.$toast.success(response.data.success);
                this.newSupplier= {};
                $('#createModel').modal('hide');
                // this.$inertia.visit('/setup#branch');
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
    deleteStaff(supplier){
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
            axios.delete(route('suppliers.destroy',{'supplier': supplier.id}))
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
