<template>
  <div>
    <div class="header header-fixed header-logo-center">
      <a href="#" class="header-title">Detail Order</a>
      <a href="#" onclick="window.history.back();" class="header-icon header-icon-1"><i class="fas fa-arrow-left"></i></a>
    </div>

    <div class="fixed-bottom card mb-0 p-2">
      <div class="row mx-1 mb-0">
<!--        <div class="col-9">-->
<!--          <a href="#" class="btn btn-m btn-full rounded-xl font-500 shadow-s bg-highlight">Ubah Metode Pembayaran</a>-->
<!--        </div>-->
        <div class="col">
          <a href="https://wa.me/62895325270701" target="_blank" class="btn btn-m btn-full has-icon rounded-xl font-800 text-uppercase shadow-s border-highlight color-highlight bg-theme">
            Hubungi CS <i class="far fa-lg fa-comment-dots"></i>
          </a>
        </div>
      </div>
    </div>

    <div class="page-content header-clear-medium">
      <div class="card card-style bg-theme pb-0 mb-0">
        <div class="content">
          <div class="mb-3">
            <p class="mb-0" style="line-height: 8pt">Order ID</p>
            <p class="font-700 font-14">#{{order.order_number}}</p>
          </div>

          <div class="mb-3">
            <p class="mb-0" style="line-height: 8pt">Tanggal Pesan</p>
            <p class="font-700 font-14">{{order.created_at_string}}</p>
          </div>

          <div class="mb-3">
            <p class="mb-0" style="line-height: 8pt">Waktu Pengiriman</p>
            <p class="font-700 font-14 color-highlight">{{order.delivery_date}} ~ 07.00 - 10.00</p>
          </div>

          <div class="mb-3">
            <p class="mb-1" style="line-height: 8pt">Total Tagihan</p>
            <p class="font-700 font-18">Rp {{order.grand_total}}</p>
          </div>

          <div class="mb-3">
            <p class="mb-0" style="line-height: 8pt">Metode Pembayaran</p>
            <p class="font-700 font-14">COD (Bayar ditempat)</p>
          </div>

          <div>
            <div class="card bg-yellow-light opacity-50 mb-0">
              <div class="content text-center color-black m-3" style="line-height: 12pt">
                Kami sedang melakukan konfirmasi pembayaran anda, jika anda belum melakukan pembayaran,
                maka diharapkan untuk melakukan pembayaran
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="timeline-body mt-0">
        <div class="timeline-deco"></div>

        <div v-for="status in status_orders" class="timeline-item">
          <i :class="status.icon+' '+status.color+' shadow-l timeline-icon top-0'"></i>
          <div class="timeline-item-content rounded-s py-1 my-2">
            <h5 class="font-400 pt-1">{{status.title}}</h5>
            <p class="opacity-50 font-14 mb-2" style="line-height: 12pt">{{status.message}}</p>
          </div>
        </div>
      </div>

      <div class="accordion" id="accordion-1">
        <div class="card card-style">
          <div class="content m-0">
            <button class="btn accordion-btn no-effect"  data-bs-toggle="collapse" data-bs-target="#collapse1">
              <span class="font-15">Ringkasan Belanja</span>
              <i class="fa fa-chevron-down font-10 accordion-icon"></i>
            </button>
            <div id="collapse1" class="collapse show" data-parent="#accordion-1">
              <div class="pt-1 pb-2 px-3">
                <div v-for="item in order.items" class="d-flex mb-2">
                  <div>
                    <img :src="item.menu.image" class="rounded-m shadow-xl" width="60">
                  </div>
                  <div class="ms-3 flex-fill">
                    <h5 class="mt-0">{{item.menu.name}}</h5>
                    <div class="d-flex m-1">
                      <div class="">
                        <h5 class=" color-highlight">Rp {{item.selling_price}} <span class="color-gray-dark font-14 font-500">/ {{item.size_per_unit}} {{item.unit.name}}</span></h5>
                      </div>
                      <div class="flex-fill text-end">
                        <p>x{{item.qty}}</p>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="divider divider-margins mb-2"></div>

                <div class="d-flex mb-0">
                  <div>
                    Subtotal
                  </div>
                  <div class="flex-fill text-end">
                    Rp {{order.subtotal}}
                  </div>
                </div>

                <div class="d-flex mb-0">
                  <div>
                    <p>Biaya Pengiriman</p>
                  </div>
                  <div class="flex-fill text-end">
                    <span v-if="order.delivery_price > 0">{{order.delivery_price}}</span>
                    <span v-else>Gratis Ongkir</span>
                  </div>
                </div>
                <div class="divider divider-margins mb-2"></div>

                <div class="row mb-0">
                  <div class="col-5">
                    Total
                  </div>
                  <div class="col-7 text-end">
                    Rp {{order.grand_total}}
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="accordion" id="accordion-2">
        <div class="card card-style">
          <div class="content m-0">
            <button class="btn accordion-btn no-effect"  data-bs-toggle="collapse" data-bs-target="#collapse2">
              <span class="font-15">Alamat Pengiriman</span>
              <i class="fa fa-chevron-down font-10 accordion-icon"></i>
            </button>
            <div id="collapse2" class="collapse"  data-parent="#accordion-2">
              <div class="pt-1 pb-2 ps-3 pe-3">
                <p class="mb-0" style="line-height: 14pt">
                  <span class="font-800"></span>{{order.address.customer.name}}<br>
                  No. HP ({{order.address.phone_number}})<br>
                  {{order.address.address}},
                  {{order.address.village.name}},
                  {{order.address.village.district.name}},
                  {{order.address.village.district.regency.name}},
                  {{order.address.village.district.regency.province.name}}
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="accordion" id="accordion-3">
        <div class="card card-style">
          <div class="content m-0">
            <button class="btn accordion-btn no-effect"  data-bs-toggle="collapse" data-bs-target="#collapse3">
              <span class="font-15">Tanggal & Waktu Pengiriman</span>
              <i class="fa fa-chevron-down font-10 accordion-icon"></i>
            </button>
            <div id="collapse3" class="collapse"  data-parent="#accordion-3">
              <div class="pt-1 pb-2 ps-3 pe-3">
                <p class="mb-0" style="line-height: 14pt">
                  Pesanan anda akan dikirim pada <b>{{order.delivery_date}}</b> pada pukul <b>07.00 - 10.00</b>
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    order: Object,
    status_orders: Object
  },
  mounted() {
    console.log(this.order)
  }
}
</script>