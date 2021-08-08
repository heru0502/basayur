<template>
  <div>
    <div class="search-box bg-white rounded-xl bottom-0 mx-3 mb-3">
      <i class="fa fa-search"></i>
      <input type="text" class="border-0" v-model="keyword" @keyup.enter="enterSearching" placeholder="Apa yang dicari hari ini?">
    </div>

    <slider :banners="banners"/>

    <categories/>

    <newest-menus :listMenus="newestMenus" :sort="'latest'" :title="'Menu Terbaru'" :subtitle="'Menu terbaru hari ini.'"/>

    <popular-menus :listMenus="popularMenus" :sort="'oldest'" :title="'Menu Terpopuler'" :subtitle="'Menu terpopuler hari ini.'"/>

  </div>
</template>

<script>
import Layout from '@/Shared/Layout'
import Slider from '@/Pages/Home/Slider'
import Categories from '@/Pages/Home/Categories'
import NewestMenus from '@/Pages/Home/ListMenus'
import PopularMenus from '@/Pages/Home/ListMenus'
import {Inertia} from "@inertiajs/inertia";

export default {
  layout: Layout,
  components: {
    Slider,
    Categories,
    NewestMenus,
    PopularMenus
  },
  props: {
    newestMenus: Object,
    popularMenus: Object,
    banners: Object
  },
  data() {
    return {
      keyword: ''
    }
  },
  methods: {
    enterSearching() {
      this.$store.commit('clearFilter');
      this.$store.state.keyword = this.keyword;
      Inertia.get('menus');
    }
  }
}
</script>

