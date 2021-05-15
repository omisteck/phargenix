<template>
<layout :page_title="'Create Staff'">
    <div class="row layout-spacing">

                                    <!-- Content -->
                                    <div class="col-xl-5 col-lg-4 col-md-4 col-sm-12 layout-top-spacing">
                                
                                        <div class="user-profile layout-spacing">
                                            <div class="widget-content widget-content-area">
                                                <div class="d-flex justify-content-between">
                                                    <h3 class="">Info</h3>
                                                    <a href="#" class="mt-2 edit-profile"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-3"><path d="M12 20h9"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path></svg></a>
                                                </div>
                                                <div class="text-center user-info">
                                                    <img :src="'https://ui-avatars.com/api/?background=0D8ABC&color=fff&name='+ staff.name" alt="avatar">
                                                    <p class="">{{ staff.name }}</p>
                                                </div>
                                                <div class="user-info-list">
                                
                                                    <div class="">



                                                    <div class="form-row mb-4">
                                                        <div class="form-group col-md-6">
                                                            <label for="name">Name</label>
                                                            <input type="text" class="form-control" id="name" v-model="staff.name" required  placeholder="John Doe">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="shortname">Username</label>
                                                            <input type="text" class="form-control" id="shortname" v-model="staff.username" placeholder="Doe201">
                                                        </div>
                                                    </div>
                    
                                                <div class="form-row mb-4">
                                                        <div class="form-group col-md-6">
                                                            <label for="address">Email</label>
                                                        <input type="text" class="form-control" id="address" v-model="staff.email" required placeholder="Johndoe@gmail.com">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="shortname">Phone</label>
                                                            <input type="text" class="form-control" id="shortname" v-model="staff.phone" placeholder="09064629981">
                                                        </div>
                                                    </div>

                                                    <div class="form-group mb-4">
                                                        <label for="address">Address</label>
                                                        <input type="text" class="form-control" id="address" v-model="staff.address" required placeholder="1234 Main Street, Lagos State, Nigeria">
                                                    </div>

                                                     <div class="form-group mb-4">
                                                        <select class="form-control  basic">
    <option selected="selected">orange</option>
    <option>white</option>
    <option>purple</option>
</select>
                                                    </div>
                                                   
                                                        
                                                    </div>                                    
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="col-xl-7 col-lg-8 col-md-8 col-sm-12 layout-top-spacing">

                                        <div class="bio layout-spacing ">
                                            <div class="widget-content widget-content-area">
                                                <h3 class="">Roles Available</h3>
                                                <p>Please pick from the available roles to assign role and permission to a staff</p>
                                
                                                <!-- <p>Sed vulputate, ligula eget mollis auctor, lectus elit feugiat urna, eget euismod turpis lectus sed ex. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nunc ut velit finibus, scelerisque sapien vitae, pharetra est. Nunc accumsan ligula vehicula scelerisque vulputate.</p> -->
                                
                                                <div class="bio-skill-box">
                                
                                                    <div class="row">
                                                        
                                                        <div class="col-12 col-xl-6 col-lg-6 col-sm-6 mb-xl-5 mb-5 ">
                                                            
                                                            <div class="d-flex b-skills">
                                                                <div>
                                                                </div>
                                                                <div class="">
                                                                    <h5>Sass Applications</h5>
                                                                    <p>Duis aute irure dolor in reprehenderit in voluptate velit esse eu fugiat nulla pariatur.</p>
                                                                </div>
                                                            </div>
                                
                                                        </div>
                                
                                                        <div class="col-12 col-xl-6 col-lg-6 col-sm-6 mb-xl-5 mb-5 ">
                                                            
                                                            <div class="d-flex b-skills">
                                                                <div>
                                                                </div>
                                                                <div class="">
                                                                    <h5>Github Countributer</h5>
                                                                    <p>Ut enim ad minim veniam, quis nostrud exercitation aliquip ex ea commodo consequat.</p>
                                                                </div>
                                                            </div>
                                
                                                        </div>
                                
                                                        <div class="col-12 col-xl-6 col-lg-6 col-sm-6 mb-xl-0 mb-5 ">
                                                            
                                                            <div class="d-flex b-skills">
                                                                <div>
                                                                </div>
                                                                <div class="">
                                                                    <h5>Photograhpy</h5>
                                                                    <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia anim id est laborum.</p>
                                                                </div>
                                                            </div>
                                
                                                        </div>
                                
                                                        <div class="col-12 col-xl-6 col-lg-6 col-sm-6 mb-xl-0 mb-0 ">
                                                            
                                                            <div class="d-flex b-skills">
                                                                <div>
                                                                </div>
                                                                <div class="">
                                                                    <h5>Mobile Apps</h5>
                                                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do et dolore magna aliqua.</p>
                                                                </div>
                                                            </div>
                                
                                                        </div>
                                
                                                    </div>
                                
                                                </div>
                                
                                            </div>                                
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



  data: function () {
      return {
          staff : {
              name : '',
            username : '',
            phone : '',
            email : '',
            address : ''
        }
    };
  },

  
mounted : function () {
    
    },

components: {
    'layout' : Layout,
    
  },

  methods: {
      
      }
};

</script>
<style>
@import "/dashboard/assets/css/scrollspyNav.css";
@import "/dashboard/plugins/select2/select2.min.css";
@import '/dashboard/assets/css/users/user-profile.css';
</style>