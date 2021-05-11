<template>
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
                                                        <a class="nav-link active" id="animated-underline-home-tab" data-toggle="tab" href="#animated-underline-home" role="tab" aria-controls="animated-underline-home" aria-selected="true"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-briefcase"><rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path></svg> Organization</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" id="animated-underline-profile-tab" data-toggle="tab" href="#animated-underline-profile" role="tab" aria-controls="animated-underline-profile" aria-selected="false"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg> Branch</a>
                                                    </li>
                                                </ul>
                                
                                                <div class="tab-content" id="animateLineContent-4">
                                                    <div class="tab-pane fade show active p-4" id="animated-underline-home" role="tabpanel" aria-labelledby="animated-underline-home-tab">
                                                             <vue-element-loading :active="isLoading" spinner="bar-fade-scale"  color="#009688" />
                                                              <form enctype="multipart/form-data">
                                                             <div class="form-row mt-2">
                                                      <div class="form-group col-md-6">
                                                          <label for="inputEmail4">Logo</label>
                                                          <vue-dropify v-model="business.logo" />
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
                                                    <div class="tab-pane fade" id="animated-underline-profile" role="tabpanel" aria-labelledby="animated-underline-profile-tab">
<vue-element-loading :active="isLoading" spinner="bar-fade-scale"  color="#009688" />
                <button type="button" class="btn btn-primary mb-3 ml-3" data-toggle="modal" data-target="#exampleModal">Create Branch</button>
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
                                                    <tr>
                                                        <td>Tiger Nixon</td>
                                                        <td>System Architect</td>
                                                        <td>Edinburgh</td>
                                                        <td>61</td>
                                                        <td>2011/04/25</td>
                                                        <td>$320,800</td>
                                                        <td class="text-center">
                                                            
                                                            <div class="btn-group dropleft" role="group">
                                                                <button id="btnGroupVerticalDrop2" type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                Dropdown <svg> ... </svg>
                                                                </button>
                                                                <div class="dropdown-menu" aria-labelledby="btnGroupVerticalDrop2">
                                                                    <a class="dropdown-item" href="#">Dropdown link</a>
                                                                    <a class="dropdown-item" href="#">Dropdown link</a>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Garrett Winters</td>
                                                        <td>Accountant</td>
                                                        <td>Tokyo</td>
                                                        <td>63</td>
                                                        <td>2011/07/25</td>
                                                        <td>$170,750</td>
                                                        <td class="text-center">
                                                            <div class="btn-group dropleft" role="group">
                                                                <button id="btnGroupVerticalDrop2" type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                Dropdown <svg> ... </svg>
                                                                </button>
                                                                <div class="dropdown-menu" aria-labelledby="btnGroupVerticalDrop2">
                                                                    <a class="dropdown-item" href="#">Edit</a>
                                                                    <a class="dropdown-item text-danger " href="#">Delete</a>
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
                                                        <th>Age</th>
                                                        <th>Start date</th>
                                                        <th>Salary</th>
                                                        <th></th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                
                                </div>
                                                    </div>
                                                    <div class="tab-pane fade" id="animated-underline-contact" role="tabpanel" aria-labelledby="animated-underline-contact-tab">
                                                        <p class="dropcap  dc-outline-primary">
                                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                                            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                                            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                                            consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                                                            cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                                                            proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                                                        </p>
                                                    </div>
                                                </div>
                                
                                                <div class="code-section-container">
                                                            
                                
                                                    <div class="code-section text-left">
                                                        <pre>
                                &lt;ul class="nav nav-tabs  mb-3" id="animateLine" role="tablist"&gt;
                                &lt;li class="nav-item"&gt;
                                &lt;a class="nav-link active" id="animated-underline-home-tab" data-toggle="tab" href="#animated-underline-home" role="tab" aria-controls="animated-underline-home" aria-selected="true"&gt;&lt;svg&gt; ... &lt;/svg&gt; Home&lt;/a&gt;
                                &lt;/li&gt;
                                &lt;li class="nav-item"&gt;
                                &lt;a class="nav-link" id="animated-underline-profile-tab" data-toggle="tab" href="#animated-underline-profile" role="tab" aria-controls="animated-underline-profile" aria-selected="false"&gt;&lt;svg&gt; ... &lt;/svg&gt; Profile&lt;/a&gt;
                                &lt;/li&gt;
                                &lt;li class="nav-item"&gt;
                                &lt;a class="nav-link" id="animated-underline-contact-tab" data-toggle="tab" href="#animated-underline-contact" role="tab" aria-controls="animated-underline-contact" aria-selected="false"&gt;&lt;svg&gt; ... &lt;/svg&gt; Contact&lt;/a&gt;
                                &lt;/li&gt;
                                &lt;/ul&gt;
                                
                                &lt;div class="tab-content" id="animateLineContent-4"&gt;
                                &lt;div class="tab-pane fade show active" id="animated-underline-home" role="tabpanel" aria-labelledby="animated-underline-home-tab"&gt;
                                &lt;p class="mb-4"&gt;
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.                                                
                                &lt;/p&gt;
                                
                                &lt;p&gt;
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                                &lt;/p&gt;      
                                &lt;/div&gt;
                                &lt;div class="tab-pane fade" id="animated-underline-profile" role="tabpanel" aria-labelledby="animated-underline-profile-tab"&gt;
                                &lt;div class="media"&gt;
                                &lt;img class="mr-3" src="assets/img/profile-32.jpeg" alt="Generic placeholder image"&gt;
                                &lt;div class="media-body"&gt;
                                Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                                &lt;/div&gt;
                                &lt;/div&gt;
                                &lt;/div&gt;
                                &lt;div class="tab-pane fade" id="animated-underline-contact" role="tabpanel" aria-labelledby="animated-underline-contact-tab"&gt;
                                &lt;p class="dropcap  dc-outline-primary"&gt;
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                                cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                                proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                                &lt;/p&gt;
                                &lt;/div&gt;
                                &lt;/div&gt;
                                </pre>
                                                    </div>
                                                </div>
                                
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <form>
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create Branch</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>
            <div class="modal-body">
                
                
                                                    <div class="form-row mb-4">
                                                        <div class="form-group col-md-6">
                                                            <label for="inputEmail4">Branch Name</label>
                                                            <input type="email" class="form-control" id="inputEmail4" placeholder="Pharmacy Plus ">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="inputPassword4">Shortname</label>
                                                            <input type="password" class="form-control" id="inputPassword4" placeholder="pharma+">
                                                        </div>
                                                    </div>
                                                    <div class="form-group mb-4">
                                                        <label for="inputAddress">Address</label>
                                                        <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St">
                                                    </div>
                                                    <div class="form-row mb-4">
                                                        <div class="form-group col-md-6">
                                                            <label for="inputEmail4">Email</label>
                                                            <input type="email" class="form-control" id="inputEmail4" placeholder="Pharmacy Plus ">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="inputPassword4">Phone</label>
                                                            <input type="password" class="form-control" id="inputPassword4" placeholder="pharma+">
                                                        </div>
                                                    </div>
                                                    
                                                

            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>
                <button type="button" class="btn btn-primary">Save</button>
            </div>
        </div>
    </form>
    </div> 
</div>
  </div>
</template>

<script>
import Layout from "../Layout/Layout.vue";
import VueDropify from 'vue-dropify';
import VueLoadingButton from 'vue-loading-button';
import VueElementLoading from "vue-element-loading";

export default {
  // Using the shorthand
  layout: Layout,

  data: function () {
    return {
      business: {
        logo: '',
        name: '',
        shortname: ''
      },
      isLoading: false,

    };
  },

  props: ["name", "newClass"],
  
components: {
    'vue-dropify': VueDropify,
    VueLoadingButton,
    VueElementLoading,
    
  },

  methods: {
    saveBusinessDetails() {
      this.isLoading = true;
      setTimeout(() => (this.isLoading = false), 1300);
    },

    deleteBranch(){
      this.isLoading = true;
      this.$swal('Hello Vue world!!!');
    }
  }

};

</script>
