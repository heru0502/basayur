<template>
  <div>
    <div class="header header-fixed header-logo-center">
      <a href="#" class="header-title">Riwayat List Order</a>
      <a href="#" onclick="window.history.back();" class="header-icon header-icon-1"><i class="fas fa-arrow-left"></i></a>
    </div>

    <div class="page-content header-clear-medium">
      <div v-if="!user">
        <login/>
      </div>

      <div v-else>
        <list-card-order :orders="orders" :event="'inactive'"/>
      </div>
    </div>
  </div>

</template>

<script>
import Login from "@/Shared/Login"
import ListCardOrder from "./ListCardOrder";
import {usePage} from "@inertiajs/inertia-vue3";

export default {
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