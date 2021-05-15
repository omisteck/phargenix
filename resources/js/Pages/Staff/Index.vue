<template>
<layout :page_title="'Staffs'">
 <div class="row layout-top-spacing" id="cancel-row">
     

     <inertia-link :href="$route('user.create')" class="btn btn-success mb-3 ml-3" >Create Branch</inertia-link>
                                    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                                        <div class="widget-content widget-content-area br-6">
                                            <table id="zero-config" class="table dt-table-hover" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>Position</th>
                                                        <th>Office</th>
                                                        <th>Start date</th>
                                                        <th>Last login</th>
                                                        <th class="no-content">Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr v-for="staff in staffs" :key="staff.id">
                                                        <td>{{ staff.name }}</td>
                                                        <td>{{ staff.position }}</td>
                                                        <td>{{ staff.branch[0].shortname }}</td>
                                                        <td>{{ staff.created_at | moment("ddd, MMM Do YYYY") }}</td>
                                                        <td>{{ staff.last_login | moment("ddd, MMM Do YYYY") }}</td>
                                                        <td class="text-center">
                                                            
                                                            <div class="btn-group " role="group">
                                                                <button id="btnGroupVerticalDrop2" type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                Action
                                                                </button>
                                                                <div class="dropdown-menu" aria-labelledby="btnGroupVerticalDrop2">
                                                                    <inertia-link href="$route('')" class="dropdown-item">Edit</inertia-link>
                                                                    <a class="dropdown-item text-danger " @click="deleteStaff(staff)" href="#">Delete</a>
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
    staffs : {
      type: Object,
      default: function () {
        return { "id": null, "user_id": null, "branch_id": null, "organization_id": null, "created_at": null, "updated_at": null };
      }
    }
},

  data: function () {
    return {
    
    };
  },

  
mounted : function () {

},

components: {
'layout' : Layout,
    
  },

  methods: {


    deleteStaff(staff){
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
            axios.delete(route('user.destroy',{'user': staff.id}))
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

<style>
@import '/dashboard/plugins/table/datatable/dt-global_style.css';
</style>
