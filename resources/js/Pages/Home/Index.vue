<template>
  <div>
    <form method="get" action="/menus">
      <div class="search-box bg-white rounded-xl bottom-0 mx-3 mb-3">
        <i class="fa fa-search"></i>
        <input type="text" class="border-0" name="search" placeholder="Apa yang dicari hari ini?">
      </div>
    </form>

    <slider/>

    <categories/>

    <newest-menus :listMenus="newestMenus" :title="'Menu Terbaru'" :subtitle="'Menu terbaru hari ini.'"/>

    <popular-menus :listMenus="popularMenus" :title="'Menu Terpopuler'" :subtitle="'Menu terpopuler hari ini.'"/>

  </div>
</template>

<script>
import Layout from '@/Shared/Layout'
import Slider from '@/Pages/Home/Slider'
import Categories from '@/Pages/Home/Categories'
import NewestMenus from '@/Pages/Home/ListMenus'
import PopularMenus from '@/Pages/Home/ListMenus'

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
    popularMenus: Object
  }
}
</script>

