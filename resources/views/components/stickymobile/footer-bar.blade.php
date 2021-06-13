<div id="footer-bar" class="footer-bar-1">
  <a href="/" class="{{ request()->routeIs('home') ? 'active-nav' : '' }}" wire:ignore><i class="fa fa-store"></i><span>Beranda</span></a>
  <a href="/orders" class="{{ request()->routeIs('order') ? 'active-nav' : '' }}" wire:ignore><i class="fa fa-clipboard-list"></i><span>Pesanan</span></a>
  <a href="/cart"><i class="fa fa-shopping-basket"></i><span>Keranjang</span><em id="total_item" class="badge bg-red-dark">{{ $total_item === 0 ? '' : $total_item }}</em></a>
  <a href="#" class="{{ request()->routeIs('search') ? 'active-nav' : '' }}" wire:ignore><i class="fa fa-book-reader"></i><span>Bantuan</span></a>
  <a href="/account" class="{{ request()->routeIs('account') ? 'active-nav' : '' }}" wire:ignore><i class="fa fa-user-circle"></i><span>Akun</span></a>
</div>