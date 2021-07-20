<template>
    <div>
          <!-- BEGIN LOADER -->
  <!-- <div id="load_screen"> <div class="loader"> <div class="loader-content">
      <div class="spinner-grow align-self-center"></div>
  </div></div></div> -->
  <!--  END LOADER -->

  <!--  BEGIN MAIN CONTAINER  -->
  <div class="main-container" id="container">

      <div class="overlay"></div>
      <div class="search-overlay"></div>

        <main-menu />
        
      <!--  BEGIN CONTENT AREA  -->
      <div id="content" class="main-content">
          <div class="layout-px-spacing">

              <div class="content-container">

                  <div class="col-left layout-top-spacing">
                      <div class="col-left-content">

                           <!--  BEGIN STICKY HEAD  -->
                          <sticky-head  :title="page_title" />

                          <div class="admin-data-content layout-top-spacing">
                             
                                <slot />

                           
                          </div>
                          <div class="footer-wrapper col-xl-12">
                              <div class="footer-section f-section-1">
                                  <p class="">© 2020 <a target="_blank" href="tel:09064629981">Omisteck</a></p>
                              </div>
                              <div class="footer-section f-section-2">
                                  <p class="">Coded with <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-heart"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg></p>
                              </div>
                          </div>
                      </div>
                  </div>
                  <!--  Right Bar -->
                <rightbar />
              </div>
          </div>

      </div>
      <!--  END CONTENT AREA  -->
  </div>
  <!-- END MAIN CONTAINER -->

    </div>
</template>
<script>
import Menu from './Menu.vue'
import Rightbar from './Rightbar.vue'
import StickyHead from './StickyHead.vue'

export default {
  components: { 'main-menu' : Menu, Rightbar, StickyHead },
    props: ['page_title'],
}

</script>
