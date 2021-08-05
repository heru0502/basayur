<template>
  <div>
    <div class="header header-fixed header-logo-center">
      <a href="index.html" class="header-title">Menu</a>
      <a href="/" class="header-icon header-icon-1"><i class="fas fa-arrow-left"></i></a>
      <a href="/cart" class="header-icon header-icon-4">
        <i class="fa fa-shopping-basket"></i>
        <span class="badge bg-red-dark">6</span>
      </a>
    </div>

    <div class="page-content header-clear-medium">
      <div class="search-box bg-white rounded-xl bottom-0 mx-3 mb-3">
        <i class="fa fa-search"></i>
        <input type="text" v-model="keyword" @keyup.enter="filter" class="border-0" placeholder="Tulis disini yang ingin dicari . . .">
      </div>

      <div class="row mb-2 mx-3">
        <div class="col-12 ps-1">
          <button
            v-for="category in categories"
            @click="selectCategory(category.id)"
            :class="(this.$store.getters.isCategorySelected(category.id) ? 'bg-highlight' : 'bg-theme') +' btn btn-xxs mb-1 me-1 rounded-xl text-uppercase font-900 border-highlight color-highlight'">
              {{category.name}}
          </button>
        </div>
      </div>

      <div class="row mb-2 mx-3">
        <div class="col-12 ps-1">
          <button class="bg-green-dark btn btn-xxs mb-1 text-uppercase font-900 border-green-dark color-green-dark"
          >Promo</button>

          <button class="bg-green-dark btn btn-xxs mb-1 text-uppercase font-900 border-green-dark color-green-dark"
          >Pilihan</button>
        </div>
      </div>

      <div class="row mb-0 mx-3">
        <div class="col-12 ps-1">
          <div class="input-style has-borders has-icon mb-4 input-filter">
            <i class="fa fa-sort-amount-down"></i>
            <select id="form5" wire:model="selected_sorting">
              <option value="latest">Terbaru</option>
              <option value="oldest">Terlama</option>
            </select>
            <span><i class="fa fa-chevron-down"></i></span>
          </div>
        </div>
      </div>

      <div v-if="isLoading" class="row col-12 mt-5">
        <div class="d-flex justify-content-center">
          <div class="spinner-border color-highlight" role="status" style="width: 3rem; height: 3rem;">
            <span class="visually-hidden">Loading...</span>
          </div>
        </div>
      </div>

      <div class="row px-3">
        <div class="col-6 m-0 p-2" v-for="menu in menus">
          <div  class="card card-style-custom p-2 m-0" style="width: 100%;" >
            <a href="#"><img :src="menu.image"  class="rounded-sm shadow-xl img-fluid"></a>
            <a href="#">
              <h5 class="mt-3" style="line-height: 0px">{{ menu.name }}</h5>
              <span v-if="menu.in_stock" class="color-green-dark font-10">In Stock</span>
              <span v-else class="color-green-dark font-10">Tersedia: {{menu.stock}}</span>
            </a>
            <span v-if="menu.original_price > menu.selling_price" class=" font-10" style="line-height: 0px"><del>Rp {{menu.original_price}}</del> <span class="badge bg-green-light color-white">Hemat {{menu.discount}}%</span></span>

            <h5 class=" color-highlight">Rp {{menu.selling_price}} <span class="color-gray-dark font-12 font-500">/ {{menu.size_per_unit}} {{menu.unit.name}}</span></h5>

            <button type="button" v-if="this.$store.getters.getTotalQty(menu.id) < 1" @click="this.$store.dispatch('addItem', {menu: menu})" class="btn btn-xxs font-800 font-16 rounded-xl btn-full text-uppercase bg-highlight">BELI</button>

            <div v-else class="align-self-center">
              <div class="stepper rounded-s float-start">
                <a @click="this.$store.dispatch('removeItem', {menu: menu})"><i class="fa fa-minus color-red-dark"></i></a>
                <input type="number" min="0" max="99" :value="this.$store.getters.getTotalQty(menu.id)" readonly>
                <a @click="this.$store.dispatch('addItem', {menu: menu})"><i class="fa fa-plus color-green-dark"></i></a>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import {Inertia} from "@inertiajs/inertia";

export default {
  props: {
    categories: Object,
    menus: Object
  },
  data() {
    return {
      isLoading: false,
      keyword: ''
    }
  },
  mounted() {
    this.filter();
  },
  methods: {
    selectCategory(id) {
      this.$store.commit('selectCategory', id);
      this.filter();
    },
    filter() {
      Inertia.reload({
        only: ['menus'],
        replace: true,
        data: {
          category_ids: this.$store.state.selectedCategories,
          keyword: this.keyword
        },
        onStart: () => {this.isLoading = true},
        onSuccess: () => {this.isLoading = false}
      })
    }
  }
}
</script>