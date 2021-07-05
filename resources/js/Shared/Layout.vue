<template>
  <div>
    <div id="footer-bar" class="footer-bar-1">
      <inertia-link href="/"><i class="fa fa-store"></i><span>Beranda</span></inertia-link>
      <inertia-link href="/orders"><i class="fa fa-clipboard-list"></i><span>Pesanan</span></inertia-link>
      <inertia-link href="/cart"><i class="fa fa-shopping-basket"></i><span>Keranjang</span><em id="total_item" class="badge bg-red-dark">0</em></inertia-link>
      <inertia-link href="#"><i class="fa fa-book-reader"></i><span>Bantuan</span></inertia-link>
      <inertia-link href="/account"><i class="fa fa-user-circle"></i><span>Akun</span></inertia-link>
    </div>

    <div class="page-content header-clear-small">
      <slot />
    </div>
  </div>
</template>