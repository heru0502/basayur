<template>
  <div>
    <div class="header header-fixed header-logo-center">
      <a href="index.html" class="header-title">Cart</a>
      <a href="#" data-back-button class="header-icon header-icon-1"><i class="fas fa-arrow-left"></i></a>
    </div>

    <div class="fixed-bottom card mb-0">
      <div class="d-flex flex-row-reverse m-1">
        <div class="p-0">
          <inertia-link :href="'/checkout?order_items='+items" v-if="this.$store.state.items.length" class="btn btn-m btn-full rounded-s text-uppercase font-500 shadow-s bg-highlight">Checkout</inertia-link>
          <a href="#" v-else class="btn btn-m btn-full rounded-s text-uppercase font-500 shadow-s bg-gray-dark" disabled>Checkout</a>
        </div>
        <div class="pe-2 text-end">
          <h3 class="mb-0 color-highlight">Rp 9000</h3>
          <img src="theme/images/pictures/coins.png" height="20"> <span class="color-highlight ">Dapatkan 50 poin</span>
        </div>
        <div class="p-2 flex-fill">
          Total Pembayaran :
        </div>
      </div>
    </div>

    <div class="page-content header-clear-medium">
      <div class="card gradient-orange">
        <p class="content color-white mb-4 text-center">
          Grating ongkir minimum belanja Rp 50.000
        </p>
      </div>


<!--      <div class="row mb-0 text-center p-5">-->
<!--        <img class="img-fluid" src="{{ asset('theme/images/cart-empty.png') }}">-->
<!--        <p class="font-14 font-700 mt-3">Keranjang masih kosong</p>-->
<!--      </div>-->

      <cart-list-menus :page="'cart'"/>


    </div>


    <div id="snackbar-5" class="snackbar-toast bg-red-dark" data-bs-delay="3000" data-bs-autohide="true"><i class="fa fa-times me-3"></i>{{ errors.order_items }}</div>

  </div>
</template>

<script>
import LayoutWithoutFooter from '@/Shared/LayoutWithoutFooter'
import CartListMenus from "@/Shared/CartListMenus"

export default {
  components: {CartListMenus},
  layout: LayoutWithoutFooter,
  props: {
    errors: Object,
  },
  data() {
    return {
      items: []
    }
  },
  mounted() {
    this.checkStock();
    this.setParamUrl();
  },
  methods: {
    checkStock() {
      let items = this.$store.state.items;
      let store = this.$store;

      if (this.errors.order_items) {
        var snackID = document.getElementById('snackbar-5');
        snackID = new bootstrap.Toast(snackID);
        snackID.show();

        let unavailbaleMenuIds = this.errors.unavailable_menu_ids;
        unavailbaleMenuIds.forEach(function (menu_id, index) {
          let checkItems = items.filter(function (item) {
            return item.id === menu_id;
          });

          if (checkItems.length) {
            store.dispatch('removeItemDirect', {menu: checkItems[0]});
          }
        });
      }
    },
    setParamUrl() {
      let items = this.$store.state.items;

      items = items.map(function(item) {
        let a = {};
        a.menu_id = item.id;
        a.qty = item.qty;
        return a;
      });

      items = JSON.stringify(items);
      this.items = items;
    }
  }
}
</script>