<template>
  <div>
    <div class="header header-fixed header-logo-center">
      <a href="#" class="header-title">List Order</a>

      <inertia-link href="/order-histories" class="header-icon header-icon-4 me-3 color-highlight font-800">Riwayat</inertia-link>
    </div>

    <div class="page-content header-clear-medium">
      <div v-if="!user">
        <login/>
      </div>

      <div v-else>
        <list-card-order :orders="orders" :event="'active'"/>
      </div>
    </div>
  </div>

</template>

<script>
import Layout from '@/Shared/Layout'
import Login from "@/Shared/Login"
import ListCardOrder from "./ListCardOrder";
import {usePage} from "@inertiajs/inertia-vue3";

export default {
  layout: Layout,
  components: {Login, ListCardOrder},
  props: {
    orders: Object
  },
  data() {
    return {
      user: usePage().props.value.auth.user,
    }
  },
}
</script>