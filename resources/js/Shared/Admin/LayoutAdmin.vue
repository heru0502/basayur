<template>
  <div id="app">
    <div class="main-wrapper">
      <navbar/>
      <sidebar/>

      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            Halaman
          </div>

          <div class="section-body">
            <slot/>
          </div>
        </section>
      </div>
    </div>
  </div>
</template>

<script>
import Navbar from '@/Shared/Admin/Navbar'
import Sidebar from '@/Shared/Admin/Sidebar'

export default {
  components: {
    Navbar,
    Sidebar
  },
  data() {
    return {
      active: null,
    }
  },
  mounted() {
    //
  },

}
</script>

