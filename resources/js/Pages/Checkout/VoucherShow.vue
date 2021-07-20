<template>
  <div>
    <div class="header header-fixed header-logo-center">
      <a href="index.html" class="header-title">Detail Voucher</a>
      <a href="#" @click="back" class="header-icon header-icon-1"><i class="fas fa-arrow-left"></i></a>
    </div>

    <div class="page-content header-clear-medium">
      <div class="card">
        <div class="content">
          <div class="row">
            <img class="p-0" :src="voucher.image_url">
          </div>

          <div class="row">
            <div class="col">
              <div class="d-flex">
                <div class="align-self-center"><i class="fa fa-clock fa-2x color-highlight-light opacity-80"></i></div>
                <div class="ms-3">
                  <div class="color-gray-dark" style="line-height: 12pt">Berlaku hingga</div>
                  <div class="font-16">{{end_at}}</div>
                </div>
              </div>
            </div>

            <div class="col">
              <div class="d-flex">
                <div class="align-self-center"><i class="fas fa-money-bill-wave-alt fa-2x color-highlight-light opacity-80"></i></div>

                <div class="ms-3" v-if="voucher.min_purchase">
                  <div class="color-gray-dark" style="line-height: 12pt">Minimum transaksi</div>
                  <div class="font-16">Rp {{voucher.min_purchase}}</div>
                </div>
                <div class="ms-3" v-else>
                  <div class="color-gray-dark" style="line-height: 14pt">Tanpa minimum transaksi</div>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <b>Syarat & Ketentuan</b>
            <p>{{voucher.content}}</p>
          </div>
        </div>
      </div>
    </div>

  </div>
</template>

<script>
import LayoutWithoutFooter from '@/Shared/LayoutWithoutFooter'

export default {
  layout: LayoutWithoutFooter,
  props: {
    voucher: Object,
    end_at: String
  },
  data() {
    return {
      //
    }
  },
  methods: {
    back() {
      window.history.back();
    },
  }
}
</script>