<template>
  <div>
    <div class="card mt-3">
      <div class="content">
        <div class="row mb-0 text-center">
          <inertia-link href="#" @click="selectCategory(1)" class="col-3 align-text-bottom">
            <img src="theme/images/icons/categories/vegetable.png" class="img-fluid p-1">
            <p class="font-11 font-700 text-uppercase">SAYURAN</p>
          </inertia-link>
          <inertia-link href="#" @click="selectCategory(2)" class="col-3">
            <img src="theme/images/icons/categories/fish.png" class="img-fluid p-2">
            <p class="font-11 font-700 text-uppercase">IKAN</p>
          </inertia-link>
          <inertia-link href="#" @click="selectCategory(3)" class="col-3">
            <img src="theme/images/icons/categories/chicken.png" class="img-fluid p-1">
            <p class="font-11 font-700 text-uppercase">DAGING</p>
          </inertia-link>
          <inertia-link href="#" @click="selectCategory(4)" class="col-3">
            <img src="theme/images/icons/categories/seasoning.png" class="img-fluid p-1">
            <p class="font-11 font-700 text-uppercase">BUMBU</p>
          </inertia-link>
          <div class="w-100 mb-3 mt-3"></div>
          <inertia-link href="#" @click="selectCategory(5)" class="col-3">
            <img src="theme/images/icons/categories/tempeh.png" class="img-fluid p-1">
            <p class="font-11 font-700 text-uppercase" style="line-height: 16px">PRODUK OLAHAN</p>
          </inertia-link>
          <inertia-link href="#" @click="selectCategory(6)" class="col-3">
            <img src="theme/images/icons/categories/salted-fish.png" class="img-fluid p-1">
            <p class="font-11 font-700 text-uppercase" style="line-height: 16px">PRODUK AWETAN</p>
          </inertia-link>
          <inertia-link href="#" @click="selectCategory(7)" class="col-3">
            <img src="theme/images/icons/categories/flour.png" class="img-fluid p-2">
            <p class="font-11 font-700 text-uppercase" style="line-height: 16px">BAHAN BAKU</p>
          </inertia-link>
          <inertia-link href="#" @click="selectCategory(8)" class="col-3">
            <img src="theme/images/icons/categories/fruit.png" class="img-fluid p-1">
            <p class="font-11 font-700 text-uppercase">BUAH</p>
          </inertia-link>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import {Inertia} from "@inertiajs/inertia";

export default {
  methods: {
    selectCategory(id) {
      this.$store.commit('clearFilter');
      this.$store.commit('selectCategory', id);
      Inertia.get('menus');
    },
  }
}
</script>