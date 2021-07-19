<template>
  <div>
    <div class="header header-fixed header-logo-center">
      <a href="index.html" class="header-title">Checkout</a>
      <a href="#" data-back-button class="header-icon header-icon-1"><i class="fas fa-arrow-left"></i></a>
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
<!--          @if($address)-->
          <div class="d-flex">
            <div>
              <h4>Alamat Pengiriman</h4>
            </div>
            <div class="flex-fill text-end">
              <a href="/address" class="color-theme opacity-50 "><i class="fa fa-edit pe-2"></i>Ubah</a>
            </div>
          </div>
          <p class="my-2" style="line-height: 18px">
            Kom. balitan
          </p>
          <p>
            087878
          </p>
<!--          @else-->
          <div class="d-flex">
            <div>
              <h4>Alamat Pengiriman</h4>
            </div>
          </div>
          <p class="color-red-light">Anda belum menambahkan alamat.</p>

          <a href="/address" class="btn btn-m btn-full rounded-xl text-uppercase font-500 shadow-s bg-green-light">Tambah Alamat</a>
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
            <label for="note" class="color-yellow-dark text-uppercase font-700 font-10">Catatan</label>
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
              (- Rp 0)

              <div class="input-style no-borders no-icon mb-4">
                <a href="#" data-menu="menu-cart-2">

                  <input type="email" onfocus="blur()" class="form-control validate-text placeholder-color-green" id="form2a" placeholder="Punya Kode Voucher? Ketuk disini">
                </a>
              </div>
            </div>
          </div>
          <div class="divider divider-margins mb-2"></div>
        </div>
      </div>
    </div>



    <div id="menu-cart-2" class="menu menu-box-modal">
      <div class="menu-title"><h1>Pilih Kode Voucher</h1></div>

      <div class="content mb-0">
        <div>
          <div class="input-style has-borders validate-field mb-4">
            <input type="name" class="form-control validate-name" id="form1ab" placeholder="Masukkan kode voucer.">
            <i class="fa fa-times disabled invalid color-red-dark"></i>
            <i class="fa fa-check disabled valid color-green-dark"></i>
          </div>
        </div>
        <div class="row">
          <div class="col-6"><a href="#" class="btn btn-full btn-m font-800 rounded-sm text-uppercase bg-red-light close-menu">Tutup</a></div>
          <div class="col-6"><a href="#" class="btn btn-full btn-m font-800 rounded-sm text-uppercase bg-green-light">Pakai</a></div>
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
<!--        @include('components.stickymobile.login')-->
      </div>
    </div>
  </div>
</template>

<script>
import LayoutWithoutFooter from '@/Shared/LayoutWithoutFooter'
import CartListMenus from "@/Shared/CartListMenus";
import { Inertia } from '@inertiajs/inertia'

export default {
  components: {CartListMenus},
  layout: LayoutWithoutFooter,
  props: {
    total_order: Object
  },
  data() {
    return {
      note: this.$store.state.note
    }
  },
  mounted() {
    Inertia.reload({ only: ['total_order'] });
    // Inertia.visit('/users', { search: 'John' }, { only: ['users'] })
    // console.log(this.total_order);
  },
  methods: {
    saveNote() {
      localStorage.setItem('note', this.note);
    }
  }
}
</script>