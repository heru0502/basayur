<template>
  <div class="main-sidebar">
    <aside id="sidebar-wrapper">
      <div class="sidebar-brand">
        <a href="">BASAYUR</a>
      </div>
      <div class="sidebar-brand sidebar-brand-sm">
        <a href="#">BS</a>
      </div>
      <ul class="sidebar-menu">
        <li :class="isUrl('admin/dashboard') ? 'active' : ''">
          <a class="nav-link" href="#">
            <i class="fas fa-columns"></i> <span>Dashboard</span>
          </a>
        </li>

        <li :class="isUrl('admin/banners') ? 'active' : ''">
          <a class="nav-link" href="#">
            <i class="fas fa-newspaper"></i> <span>Banner</span>
          </a>
        </li>

        <li class="">
          <a class="nav-link" href="#">
            <i class="fas fa-newspaper"></i> <span>Menu</span>
          </a>
        </li>
      </ul>
    </aside>

  </div>

</template>

<script>
export default {
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