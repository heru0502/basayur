<template>
  <div>
    <div id="footer-bar" class="footer-bar-1">
      <inertia-link href="/" :class="isUrl('') ? 'active-nav' : ''"><i class="fa fa-store"></i><span>Beranda</span></inertia-link>
      <inertia-link href="/orders" :class="isUrl('orders') ? 'active-nav' : ''"><i class="fa fa-clipboard-list"></i><span>Pesanan</span></inertia-link>
      <inertia-link href="/cart">
        <i class="fa fa-shopping-basket"></i><span>Keranjang</span>
        <em id="total_item" v-if="this.$store.state.totalQty > 0" class="badge bg-red-dark">{{this.$store.state.totalQty}}</em>
      </inertia-link>
      <inertia-link href="/help" :class="isUrl('help') ? 'active-nav' : ''"><i class="fa fa-book-reader"></i><span>Bantuan</span></inertia-link>
      <inertia-link href="/account" :class="isUrl('account') ? 'active-nav' : ''"><i class="fa fa-user-circle"></i><span>Akun</span></inertia-link>
    </div>

    <div class="page-content header-clear-small">
      <slot />
    </div>
  </div>
</template>

<script>
  export default {
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