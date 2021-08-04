<template>
  <div v-if="isLoading" class="d-flex justify-content-center">
    <div class="spinner-border color-highlight" role="status">
      <span class="sr-only">Loading...</span>
    </div>
  </div>

  <div v-for="order in orders" class="card card-style bg-theme pb-0">
    <div class="content">
      <inertia-link :href="'/orders/'+order.id" style="color: inherit; text-decoration: inherit;">
        <div class="row mb-0 opacity-50">
          <div class="col-7">
            Order ID
          </div>
          <div class="col-5 text-end">
            Tanggal Pengiriman
          </div>
        </div>
        <div class="row mb-0" style="line-height: 12pt">
          <div class="col-7">
            #{{order.order_number}}
          </div>
          <div class="col-5 text-end">
            {{order.delivery_date}}
          </div>
        </div>

        <div class="row mb-0 mt-3 opacity-50">
          <div class="col-7">
            Status Pemesanan
          </div>
          <div class="col-5 text-end">
            Total Tagihan
          </div>
        </div>
        <div class="row mb-0" style="line-height: 12pt">
          <div class="col-7">
            <a href="#" class="chip chip-small bg-gray-light">
              <i :class="order.status_order.icon +' '+ order.status_order.color"></i>
              <strong class="color-black font-400">{{order.status_order.title}}</strong>
            </a>
          </div>
          <div class="col-5 text-end">
            Rp {{order.grand_total}}
          </div>
        </div>
      </inertia-link>

      <div class="divider mb-3"></div>

      <div class="row mx-1 mb-0">
        <!--              <div class="col-9">-->
        <!--                <a href="#" class="btn btn-xxs btn-full rounded-xl font-500 shadow-s bg-highlight">Ubah Metode Pembayaran</a>-->
        <!--              </div>-->
        <div class="col">
          <a href="https://wa.me/62895325270701" target="_blank" class="btn btn-xxs btn-full has-icon rounded-xl font-800 text-uppercase shadow-s border-highlight color-highlight bg-theme">
            Hubungi CS <i class="far fa-lg fa-comment-dots"></i>
          </a>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import {Inertia} from "@inertiajs/inertia";

export default {
  props: {
    orders: Object,
    event: String
  },
  data() {
    return {
      isLoading: false
    }
  },
  mounted() {
    Inertia.reload({
      replace: true,
      only: ['orders'],
      data: {
        event: this.event
      },
      onStart: () => {this.isLoading = true},
      onSuccess: () => {this.isLoading = false}
    });
  },
}
</script>