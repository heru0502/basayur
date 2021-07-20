<template>
  <div>
    <div class="header header-fixed header-logo-center">
      <a href="index.html" class="header-title">Voucher</a>
      <a href="#" @click="back" class="header-icon header-icon-1"><i class="fas fa-arrow-left"></i></a>
    </div>

    <div class="page-content header-clear-medium">
      <div class="card card-style">
        <div class="content">
          <div class="row mb-0">
            <div class="input-group input-style no-borders no-icon mb-0">
              <input type="text" v-model="code" @change="checkVoucherCode" class="form-control" placeholder="Masukkan kode promo">
              <button :disabled="!voucher" @click="applyVoucher" class="btn btn-m btn-full mb-0 ms-1 rounded-xs text-uppercase font-900 shadow-s bg-green-dark">Terapkan</button>
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
          <inertia-link :href="'/voucher/'+voucher.id">Lihat detail</inertia-link>
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
      code: this.$store.state.voucherCode,
      isLoading: false
    }
  },
  mounted() {
    this.setDefaultCode();
    this.checkVoucherCode();
  },
  methods: {
    back() {
      window.history.back();
    },
    setDefaultCode() {
      if (!this.code) {
        var url_string = window.location.href;
        var url = new URL(url_string);
        var c = url.searchParams.get("code");
        this.code = c;
      }
    },
    checkVoucherCode() {
      Inertia.reload({
        replace: true,
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
    },
    applyVoucher() {
      if (this.voucher) {
        this.$store.state.voucherId = this.voucher.id;
        this.$store.state.voucherCode = this.voucher.code;
        this.$store.state.voucherTitle = this.voucher.title;
        localStorage.setItem('voucherId', this.voucher.id);
        localStorage.setItem('voucherCode', this.voucher.code);
        localStorage.setItem('voucherTitle', this.voucher.title);
        this.back();
      }
    }
  }
}
</script>