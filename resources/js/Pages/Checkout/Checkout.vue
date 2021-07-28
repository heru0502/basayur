<template>
  <div>
    <div class="header header-fixed header-logo-center">
      <a href="index.html" class="header-title">Checkout</a>
      <a href="#" @click="back" class="header-icon header-icon-1"><i class="fas fa-arrow-left"></i></a>
    </div>

    <div class="fixed-bottom card mb-0" style="z-index: 1">
      <div class="d-flex flex-row-reverse m-1">
        <div class="p-0">
          <inertia-link href="/select-payment" id="next_page" class="btn btn-m btn-full rounded-s text-uppercase font-500 shadow-s bg-highlight">Bayar</inertia-link>
        </div>
        <div class="pe-2 text-end align-self-center">
          <h3 class="mb-0 color-highlight">Rp {{total_order ? total_order.grand_total : 0}}</h3>
<!--          <img src="theme/images/pictures/coins.png" height="20"> <span class="color-highlight ">Dapatkan 50 poin</span>-->
        </div>
        <div class="p-2 flex-fill">
          Total Pembayaran :
        </div>
      </div>
    </div>

    <div class="page-content header-clear-medium">
      <div class="card card-style card-danger border-red-dark" id="address_card">
        <div class="content border-red-dark">

          <div v-if="address">
            <div class="d-flex">
              <div>
                <h4>Alamat Pengiriman</h4>
              </div>
              <div class="flex-fill text-end">
                <inertia-link href="/address" class="color-theme opacity-50 "><i class="fa fa-edit pe-2"></i>Ubah</inertia-link>
              </div>
            </div>
            <p class="mb-0" style="line-height: 18px">
              {{address.address}}
            </p>
            <p>
              {{address.phone_number}}
            </p>
          </div>

          <div v-else>
            <div class="d-flex">
              <div>
                <h4>Alamat Pengiriman</h4>
              </div>
            </div>
            <p class="color-red-light">Anda belum menambahkan alamat.</p>

            <inertia-link v-if="user" href="/address" class="btn btn-m btn-full rounded-xl text-uppercase font-500 shadow-s bg-green-light">Tambah Alamat</inertia-link>
            <a v-else @click="errorNoAuth" href="#" class="btn btn-m btn-full rounded-xl text-uppercase font-500 shadow-s bg-green-light">Tambah Alamat</a>
          </div>
        </div>
      </div>

      <cart-list-menus :page="'checkout'"/>

<!--      <div class="card card-style bg-yellow-light">-->
<!--        <p class="content color-white mb-4 text-center">-->
<!--          Apabila barang tidak tersedia, anda cukup membayar yang tersedia saja.-->
<!--        </p>-->
<!--      </div>-->

      <div class="card card-style">
        <div class="content">
          <div class="d-flex">
            <div>
              <h4>Waktu Pengiriman</h4>
            </div>
          </div>
          <div class="d-flex mb-1">
            <div>
              Tanggal Pengiriman
            </div>
            <div class="flex-fill text-end">
              01-02-2021
            </div>
          </div>
          <div class="divider divider-margins mb-2"></div>

          <div class="d-flex mb-1">
            <div>
              Waktu Pengiriman
            </div>
            <div class="flex-fill text-end">
              08:00
            </div>
          </div>
          <div class="divider divider-margins mb-4"></div>

          <div class="input-style input-style-always-active has-borders mb-4">
            <input type="text" v-model="note" @change="saveNote" class="form-control" placeholder="...">
            <label class="color-yellow-dark text-uppercase font-700 font-10">Catatan</label>
            <em>(opsional)</em>
          </div>
        </div>
      </div>

      <div class="card card-style">
        <div class="content">
          <div class="d-flex">
            <div>
              <h4>Ringkasan Pembayaran</h4>
            </div>
          </div>
          <div class="d-flex mb-1">
            <div>
              Total Belanja
            </div>
            <div class="flex-fill text-end">
              Rp {{ total_order ? total_order.subtotal : 0 }}
            </div>
          </div>
          <div class="divider divider-margins mb-2"></div>

          <div class="d-flex mb-1">
            <div>
              <p class="mb-0" style="line-height: 8pt">Ongkos Kirim</p>
              <span class="font-11 color-orange-light">GRATIS ONGKIR minimal belanja Rp 30.000</span>
            </div>
            <div class="flex-fill text-end">
              Rp {{ total_order ? total_order.delivery_price : 0 }}
            </div>
          </div>
          <div class="divider divider-margins mb-2"></div>

          <div class="row mb-1">
            <div class="col-5">
              Voucher
            </div>
            <div class="col-7 text-end">
              <span :class="this.$store.state.voucherId ? 'color-green-dark' : ''">(- Rp {{ total_order ? total_order.discount_price : 0 }})</span>

              <div class="input-style no-borders no-icon mb-4">
                <div class="d-flex">
                  <div class="align-self-center">
                    <i v-if="this.$store.state.voucherId" @click="removeVoucher" class="fa fa-times color-red-dark"></i>
                  </div>
                  <div class="flex-fill ms-3">
                    <inertia-link href="/voucher">
                      <input type="text" v-model="voucherUsage" onfocus="blur()" class="form-control validate-text placeholder-color-green color-green-dark" placeholder="Punya Kode Voucher? Ketuk disini">
                    </inertia-link>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="divider divider-margins mb-2"></div>
        </div>
      </div>
    </div>

  </div>
</template>

<script>
import LayoutWithoutFooter from '@/Shared/LayoutWithoutFooter'
import CartListMenus from "@/Shared/CartListMenus";
import { Inertia } from '@inertiajs/inertia'
import { usePage } from '@inertiajs/inertia-vue3'
import Swal from 'sweetalert2'

export default {
  components: {CartListMenus},
  layout: LayoutWithoutFooter,
  props: {
    address: Object,
    total_order: Object
  },
  data() {
    return {
      user: usePage().props.value.auth.user,
      note: this.$store.state.note,
      voucherUsage: this.$store.state.voucherId ? '('+this.$store.state.voucherCode+') '+ this.$store.state.voucherTitle : '',
      items: []
    }
  },
  mounted() {
    this.setParamUrl();
    this.reCountTotal();
  },
  methods: {
    saveNote() {
      this.$store.state.note = this.note;
      localStorage.setItem('note', this.note);
    },
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
    removeVoucher() {
      this.$store.state.voucherId = '';
      this.$store.state.voucherCode = '';
      this.$store.state.voucherTitle = '';
      localStorage.removeItem('voucherId');
      localStorage.removeItem('voucherCode');
      localStorage.removeItem('voucherTitle');
      this.reCountTotal();
      this.voucherUsage = '';
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
    errorNoAuth() {
      Swal.fire({
        title: 'Anda Belum Login!',
        text: 'Untuk melanjutkan silahkan login terlebih dahulu',
        icon: 'warning',
        confirmButtonText: 'Daftar / Login',
        confirmButtonColor: '#A0D468',
        showCloseButton: true,
      }).then((result) => {
        if (result.isConfirmed) {
          Inertia.get('/account');
        }
      });
    }
  }
}
</script>