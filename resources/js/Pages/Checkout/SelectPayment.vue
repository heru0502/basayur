<template>
  <div>
    <div class="header header-fixed header-logo-center">
      <a href="index.html" class="header-title">PIlih Pembayaran</a>
      <a href="#" @click="back" class="header-icon header-icon-1"><i class="fas fa-arrow-left"></i></a>
    </div>

    <div class="fixed-bottom card mb-0 px-2 py-3" style="z-index: 1">
      <a href="#" wire:click="createOrder()" class="btn btn-m btn-full rounded-s text-uppercase font-500 shadow-s bg-highlight">Buat Pesanan</a>
    </div>

    <div class="page-content header-clear-medium">
      <div class="card card-style">
        <div class="content">
          <h5>Ringkasan Pembayaran</h5>
          <div class="divider divider-margins my-3"></div>

          <div class="d-flex mb-0">
            <div>
              Total Belanja
            </div>
            <div class="flex-fill text-end">
              Rp {{total_order ? total_order.subtotal : 0}}
            </div>
          </div>

          <div class="d-flex mb-0">
            <div>
              <p>Biaya Pengiriman</p>
            </div>
            <div class="flex-fill text-end color-red-light">
              Rp {{total_order ? total_order.delivery_price : 0}}
            </div>
          </div>

          <div class="d-flex mb-0">
            <div>
              <p>Voucher</p>
            </div>
            <div class="flex-fill text-end color-green-light">
              - Rp {{total_order ? total_order.discount_price : 0}}
            </div>
          </div>
          <div class="divider divider-margins mb-2"></div>

          <div class="row mb-0">
            <div class="col-5">
              Total
            </div>
            <div class="col-7 text-end">
              Rp {{total_order ? total_order.grand_total : 0}}
            </div>
          </div>
        </div>
      </div>

      <div class="accordion" id="accordion-1">
        <div class="card card-style">
          <div class="content m-0">
            <button class="btn accordion-btn no-effect"  data-bs-toggle="collapse" data-bs-target="#collapse2">
              <span class="font-15">Ringkasan Belanja</span>
              <i class="fa fa-chevron-down font-10 accordion-icon"></i>
            </button>
            <div id="collapse2" class="collapse"  data-parent="#accordion-1">
              <div class="pt-1 pb-2 ps-3 pe-3">
                <div class="d-flex mb-0" v-for="item in this.$store.state.items">
                  <div>
                    <p>{{item.qty}}x {{item.name}}</p>
                  </div>
                  <div class="flex-fill text-end">
                    Rp {{item.selling_price}}
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="card card-style">
        <div class="content">
          <h5>Pilih metode pembayaran</h5>
          <div class="divider divider-margins my-3"></div>

          <div class="row mb-0 bg-gray-light">
            <div class="col-3">
              <img src="theme/images/icons/payment-methods/gopay.png" class="img-fluid">
            </div>
            <div class="col-7 p-0 align-self-center">
              <p class="mb-1" style="line-height: 11pt">SEGERA HADIR</p>
<!--              <p class="font-11" style="line-height: 11pt">Pembayaran menggunakan aplikasi GOPAY</p>-->
            </div>
            <div class="col-2 align-self-center">
              <div class="form-check icon-check">
                <input class="form-check-input" type="radio" name="inlineRadioOptions" value="" id="radio1" disabled>
                <label class="form-check-label" for="radio1">&nbsp;</label>
                <i class="icon-check-1 fa fa-circle color-gray-dark font-16"></i>
                <i class="icon-check-2 fa fa-check-circle font-16 color-highlight"></i>
              </div>
            </div>
          </div>
          <div class="divider divider-margins mb-3"></div>

          <div class="row mb-0 bg-gray-light">
            <div class="col-3">
              <img src="theme/images/icons/payment-methods/ovo.png" class="img-fluid">
            </div>
            <div class="col-7 p-0 align-self-center">
              <p class="mb-1" style="line-height: 11pt">SEGERA HADIR</p>
<!--              <p class="font-11" style="line-height: 11pt">Pembayaran menggunakan aplikasi OVO</p>-->
            </div>
            <div class="col-2 align-self-center">
              <div class="form-check icon-check">
                <input class="form-check-input" type="radio" name="inlineRadioOptions" value="" id="radio2" disabled>
                <label class="form-check-label" for="radio2">&nbsp;</label>
                <i class="icon-check-1 fa fa-circle color-gray-dark font-16"></i>
                <i class="icon-check-2 fa fa-check-circle font-16 color-highlight"></i>
              </div>
            </div>
          </div>
          <div class="divider divider-margins mb-3"></div>

          <div class="row mb-0">
            <div class="col-3">
              <img src="theme/images/icons/payment-methods/cod.png" class="img-fluid">
            </div>
            <div class="col-7 p-0 align-self-center">
              <p class="mb-1" style="line-height: 11pt">COD (Cash on Delivery)</p>
              <p class="font-11" style="line-height: 11pt">Bayar ketika barang anda terima</p>
            </div>
            <div class="col-2 align-self-center">
              <div class="form-check icon-check">
                <input class="form-check-input" type="radio" name="inlineRadioOptions" value="" id="radio3" checked>
                <label class="form-check-label" for="radio3">&nbsp;</label>
                <i class="icon-check-1 fa fa-circle color-gray-dark font-16"></i>
                <i class="icon-check-2 fa fa-check-circle font-16 color-highlight"></i>
              </div>
            </div>
          </div>
          <div class="divider divider-margins mb-3"></div>
        </div>
      </div>
    </div>

    <div id="menu-login-1" class="menu menu-box-bottom menu-box-detached rounded-m" data-menu-height="600" data-menu-effect="menu-over">
      <div class="menu-title mt-n1">
        <h1>Login</h1>
        <p class="color-theme opacity-50">Please enter your credentials below</p>
        <a href="#" class="close-menu"><i class="fa fa-times"></i></a>
      </div>

      <div class="content mb-0">
        @include('components.stickymobile.login')
      </div>
    </div>
  </div>
</template>

<script>
import LayoutWithoutFooter from '@/Shared/LayoutWithoutFooter'
import {Inertia} from "@inertiajs/inertia";

export default {
  layout: LayoutWithoutFooter,
  props: {
    total_order: Object
  },
  data() {
    return {
      items: []
    }
  },
  mounted() {
    this.setParamUrl();
    this.reCountTotal();
    console.log(this.total_order);
  },
  methods: {
    back() {
      window.history.back();
    },
    reCountTotal() {
      Inertia.reload({
        replace: true,
        only: ['total_order'],
        data: {
          order_items: this.items,
          voucher_id: this.$store.state.voucherId
        },
      });
    },
    setParamUrl() {
      let items = this.$store.state.items;

      items = items.map(function(item) {
        let a = {};
        a.menu_id = item.id;
        a.qty = item.qty;
        return a;
      });

      items = JSON.stringify(items);
      this.items = items;
    },
  }
}
</script>