<template>
  <div>
    <div class="header header-fixed header-logo-center">
      <a href="index.html" class="header-title">Akun</a>
    </div>

    <div class="page-content header-clear-medium">
      <div class="card card-style">
        <div class="d-flex content">
          <div class="flex-grow-1">
            <div>
              <h1 class="font-700 mb-1">Nama</h1>
              <p class="mb-0 pb-1 pe-3">
                087815932909
              </p>
            </div>
          </div>
          <div>
            <img src="#"  width="80" class="rounded-circle mt- shadow-xl preload-img">
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

          <a href="#" style="color: inherit; text-decoration: inherit;">
            <div class="d-flex mb-2">
              <div>
                Alamat Saya
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

          <form method="POST" action="">

            <a href="#" style="color: inherit; text-decoration: inherit;" onclick="event.preventDefault();this.closest('form').submit();">
              <div class="d-flex mb-2">
                <div>
                  Logout
                </div>
                <div class="flex-fill text-end color-highlight">
                  <i class="fa fa-chevron-right"></i>
                </div>
              </div>
            </a>
          </form>
        </div>
      </div>
    </div>
  </div>

</template>

<script>
import Layout from '@/Shared/Layout'

export default {
  layout: Layout
}
</script>