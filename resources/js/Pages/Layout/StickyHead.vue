<template>
    <div class="header-container">
                              <header class="header navbar navbar-expand-sm">
                                  <div class="d-flex">
                                      <a href="javascript:void(0);" class="sidebarCollapse" data-placement="bottom">
                                          <div class="bt-menu-trigger">
                                              <span></span>
                                          </div>
                                      </a>
                                      <div class="page-header">
                                          <div class="page-title">
                                              <h3>{{ title }}</h3>
                                          </div>
                                      </div>
                                  </div>

                                  <div class="header-actions">
                                      <div class="nav-item dropdown language-dropdown more-dropdown">
                                          <div class="dropdown custom-dropdown-icon">
                                              <a class="dropdown-toggle btn btn-success" href="#" role="button" id="customDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                  
                                                  <span>{{ $page.props.user.branch.active.shortname }}</span> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down text-white"><polyline points="6 9 12 15 18 9"></polyline></svg></a>

                                              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="customDropdown" v-if="$page.props.user.branches.length > 1">
                                                  <span v-for="branch in $page.props.user.branches" :key="branch.id">
                                                    <a  @click="changeBranch(branch)" class="dropdown-item active" data-img-value="flag-de3" :data-value="branch.shortname" href="javascript:void(0);"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg> {{branch.shortname}}</a>
                                                  </span>
                                              </div>
                                          </div>
                                      </div>

                                      <div class="toggle-notification-bar">
                                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bell"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg>
                                      </div>
                                  </div>
                              </header>
                          </div>
</template>

<script>
export default {
    props: ['title'],
    methods: {
        changeBranch(branch){
            axios.post(route('changeBranch'), branch)
        .then((response) => {
                window.location='';
            })
            .catch(error => {
                this.isLoading = false;
                let errors = error.response.data.errors;
                for (let field of Object.keys(errors)) {
                    this.$toast.error(errors[field][0], 'error');
                }
            })
        },
    },
}
</script>