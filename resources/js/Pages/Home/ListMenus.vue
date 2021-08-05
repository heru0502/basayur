<template>
  <div>
    <div class="card ">
      <div class="content">
        <div class="d-flex mb-3">
          <div class="me-3">
            <h3>{{title}}</h3>
            <p class="mt-n2 color-gray-dark">
              {{subtitle}}
            </p>
          </div>
          <div class="ms-auto">
            <a href="#" @click="clickSorting" class="font-14 color-highlight">Lihat semua ></a>
          </div>
        </div>
      </div>

      <div class="container-fluid">
        <div class="row flex-row flex-nowrap overflow-auto mb-0">

          <div v-for="menu in listMenus" class="card card-style-custom pb-3" style="width: 130px;" >
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
      listMenus: Object,
      title: String,
      subtitle: String,
      sort: String
    },
    methods: {
      clickSorting() {
        this.$store.commit('clearFilter');
        this.$store.state.selectedSorting = this.sort;
        Inertia.get('menus');
      }
    }
  }
</script>