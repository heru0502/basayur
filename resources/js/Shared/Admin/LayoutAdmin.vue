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
  methods: {
    isUrl(...urls) {
      let currentUrl = this.$page.url.substr(1)
      if (urls[0] === '') {
        return currentUrl === ''
      }
      return urls.filter(url => currentUrl.startsWith(url)).length
    },
  },
}
</script>

