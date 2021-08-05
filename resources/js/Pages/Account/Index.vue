<template>
  <div>
    <div class="header header-fixed header-logo-center">
      <a href="index.html" class="header-title">Akun</a>
    </div>

    <div class="page-content header-clear-medium">
      <div v-if="!user">
        <login/>
      </div>

      <div v-else>
        <div class="card card-style">
          <div class="d-flex content">
            <div class="flex-grow-1">
              <div>
                <h1 class="font-700 mb-1">{{user.name}}</h1>
                <p class="mb-0 pb-1 pe-3">
                  {{user.email}}
                </p>
              </div>
            </div>
            <div>
              <img :src="user.profile_photo_path"  width="80" class="rounded-circle mt- shadow-xl preload-img">
            </div>
          </div>
        </div>

        <div class="card card-style">
          <div class="content">

            <a href="#" style="color: inherit; text-decoration: inherit;">
              <div class="d-flex mb-2">
                <div>
                  Voucher Saya
                </div>
                <div class="flex-fill text-end color-highlight">
                  <i class="fa fa-chevron-right"></i>
                </div>
              </div>
            </a>
            <div class="divider divider-margins mb-2"></div>

            <inertia-link href="/address" style="color: inherit; text-decoration: inherit;">
              <div class="d-flex mb-2">
                <div>
                  Alamat Saya
                </div>
                <div class="flex-fill text-end color-highlight">
                  <i class="fa fa-chevron-right"></i>
                </div>
              </div>
            </inertia-link>
            <div class="divider divider-margins mb-2"></div>

            <a href="#" style="color: inherit; text-decoration: inherit;">
              <div class="d-flex mb-2">
                <div>
                  Privasi dan Kebijakan
                </div>
                <div class="flex-fill text-end color-highlight">
                  <i class="fa fa-chevron-right"></i>
                </div>
              </div>
            </a>
            <div class="divider divider-margins mb-2"></div>

            <a href="#" style="color: inherit; text-decoration: inherit;">
              <div class="d-flex mb-2">
                <div>
                  Bantuan
                </div>
                <div class="flex-fill text-end color-highlight">
                  <i class="fa fa-chevron-right"></i>
                </div>
              </div>
            </a>
            <div class="divider divider-margins mb-2"></div>

            <a href="#" style="color: inherit; text-decoration: inherit;">
              <div class="d-flex mb-2">
                <div>
                  Chat
                </div>
                <div class="flex-fill text-end color-highlight">
                  <i class="fa fa-chevron-right"></i>
                </div>
              </div>
            </a>
            <div class="divider divider-margins mb-2"></div>

            <a href="#" @click="logout" style="color: inherit; text-decoration: inherit;">
              <div class="d-flex mb-2">
                <div>
                  Logout
                </div>
                <div class="flex-fill text-end color-highlight">
                  <i class="fa fa-chevron-right"></i>
                </div>
              </div>
            </a>
          </div>
        </div>
      </div>

    </div>
  </div>

</template>

<script>
import Layout from '@/Shared/Layout'
import Login from "@/Shared/Login"
import { usePage } from '@inertiajs/inertia-vue3'
import {Inertia} from "@inertiajs/inertia";

export default {
  layout: Layout,
  components: {Login},
  data() {
    return {
      user: usePage().props.value.auth.user
    }
  },
  methods: {
    logout() {
      Inertia.post('auth/logout')
    }
  }
}
</script>