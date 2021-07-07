<template>
  <div>
    <div class="header header-fixed header-logo-center">
      <a href="index.html" class="header-title">Cart</a>
      <a href="#" data-back-button class="header-icon header-icon-1"><i class="fas fa-arrow-left"></i></a>
    </div>

    <div class="fixed-bottom card mb-0">
      <div class="d-flex flex-row-reverse m-1">
        <div class="p-2">
          <a href="/checkout" v-if="this.$store.state.items.length" class="btn btn-m btn-full rounded-s text-uppercase font-500 shadow-s bg-highlight">Checkout</a>
          <a href="#" v-else class="btn btn-m btn-full rounded-s text-uppercase font-500 shadow-s bg-gray-dark" disabled>Checkout</a>
        </div>
        <div class="p-2 text-end">
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

      <div class="card card-style">
        <div class="content">

          <div class="d-flex mb-0" v-for="item in this.$store.state.items">
            <div>
              <img :src="item.image" class="rounded-m shadow-xl" width="80">
            </div>
            <div class="ms-3 flex-fill">
              <h5 class="mt-1">
                {{item.name}}
                <span v-if="item.in_stock" class="color-green-dark font-10">In Stock</span>
                <span v-else class="color-green-dark font-10">Tersedia: {{item.stock}}</span>
              </h5>

              <span v-if="item.selling_price" class="font-13"><del>Rp {{item.original_price}}</del> <span class="badge bg-green-light color-white">Hemat {{item.discount}}%</span></span>

              <div class="row mb-3">
                <div class="col-7">
                  <h3 class="color-highlight">Rp {{item.selling_price ? item.selling_price : item.original_price}} <span class="color-gray-dark font-14 font-500">/ {{item.size_per_unit}} {{item.unit.name}}</span></h3>
                </div>
                <div class="col-4">
                  <div class="stepper rounded-s float-start">
                    <a @click="this.$store.dispatch('removeItem', {menu: item})"><i class="fa fa-minus color-red-dark"></i></a>
                    <input type="number" min="0" max="99" :value="this.$store.getters.getTotalQty(item.id)" readonly>
                    <a @click="this.$store.dispatch('addItem', {menu: item})"><i class="fa fa-plus color-green-dark"></i></a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="divider divider-margins mb-3"></div>


          <div class="row mb-0">
            <div class="col-12 pe-1">
              <a href="/" class="btn btn-xl btn-full mb-3 rounded-xl font-700 border-white color-green-light bg-theme"><i class="fa fa-lg fa-shopping-basket"></i> Tambah lagi</a>
            </div>
          </div>
        </div>
      </div>


    </div>
  </div>
</template>

<script>
import LayoutWithoutFooter from '@/Shared/LayoutWithoutFooter'
import Slider from '@/Pages/Home/Slider'
import Categories from '@/Pages/Home/Categories'
import NewestMenus from '@/Pages/Home/ListMenus'
import PopularMenus from '@/Pages/Home/ListMenus'

export default {
  layout: LayoutWithoutFooter,
  components: {
    Slider,
    Categories,
    NewestMenus,
    PopularMenus
  },
  props: {
    newestMenus: Object,
    popularMenus: Object
  }
}
</script>