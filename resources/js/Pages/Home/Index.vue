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

    <newest :newestMenus="newestMenus"/>

  </div>
</template>

<script>
import Layout from '@/Shared/Layout'
import Slider from '@/Pages/Home/Slider'
import Categories from '@/Pages/Home/Categories'
import Newest from '@/Pages/Home/Newest'

export default {
  layout: Layout,
  components: {
    Slider,
    Categories,
    Newest
  },
  props: {
    newestMenus: Object
  }
}
</script>