<template>
  <div>
    <div class="header header-fixed header-logo-center">
      <a href="index.html" class="header-title">Voucher</a>
      <a href="#" data-back-button class="header-icon header-icon-1"><i class="fas fa-arrow-left"></i></a>
    </div>

    <div class="page-content header-clear-medium">
      <div class="card card-style">
        <div class="content">
          <div class="row mb-0">
            <div class="input-group input-style no-borders no-icon mb-0">
              <input type="text" v-model="code" @change="checkVoucherCode" class="form-control" placeholder="Masukkan kode promo">
              <button :disabled="!voucher" class="btn btn-m btn-full mb-0 ms-1 rounded-xs text-uppercase font-900 shadow-s bg-green-dark">Terapkan</button>
            </div>
          </div>
        </div>
      </div>

      <div v-if="isLoading" class="d-flex justify-content-center">
        <div class="spinner-border color-red-dark" role="status">
          <span class="sr-only">Loading...</span>
        </div>
      </div>

      <div class="card card-style" style="box-shadow: 0px 0px 5px green" v-if="voucher">
        <div class="content">
          <h4>{{voucher.title}}</h4>
          <p class="mt-1 mb-0" style="line-height: 14pt">
            {{voucher.content}}
          </p>
          <a href="#">Lihat detail</a>
        </div>
      </div>

      <div v-if="!voucher && !isLoading" class="d-flex justify-content-center">
        <h4>Voucher tidak ditemukan</h4>
      </div>
    </div>

  </div>
</template>

<script>
import LayoutWithoutFooter from '@/Shared/LayoutWithoutFooter'
import { Inertia } from '@inertiajs/inertia'

export default {
  layout: LayoutWithoutFooter,
  props: {
    voucher: Object
  },
  data() {
    return {
      code: '',
      isLoading: false
    }
  },
  methods: {
    checkVoucherCode() {
      Inertia.reload({
        only: ['voucher'],
        data: {
          code: this.code
        },
        onStart: visit => {
          this.isLoading = true;
        },
        onFinish: visit => {
          this.isLoading = false;
        }
      });
    }
  }
}
</script>