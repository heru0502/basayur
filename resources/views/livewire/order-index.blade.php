<div>
  @include('components.stickymobile.footer-bar')

  <div class="header header-fixed header-logo-center">
    <a href="index.html" class="header-title">List Order</a>

    @auth('customer')
      <a href="/order-histories" class="header-icon header-icon-4 me-3 color-highlight font-800">Riwayat</a>
    @endauth
  </div>

  <div class="page-content header-clear-medium">

    @auth('customer')
      <div class="card card-style bg-theme pb-0">
      <div class="content">
        <a href="/order-detail" style="color: inherit; text-decoration: inherit;">
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
              #HK-0849
            </div>
            <div class="col-5 text-end">
              Minggu, 25 April 2021
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
                <i class="fa fa-check bg-green-dark"></i>
                <strong class="color-black font-400">Belum Dibayar</strong>
              </a>
            </div>
            <div class="col-5 text-end">
              Rp 100.000
            </div>
          </div>
        </a>

        <div class="divider mb-3"></div>

        <div class="row mx-1 mb-0">
          <div class="col-9">
            <a href="#" class="btn btn-xxs btn-full rounded-xl font-500 shadow-s bg-highlight">Ubah Metode Pembayaran</a>
          </div>
          <div class="col-3">
            <a href="#" class="btn btn-xxs btn-full rounded-xl font-500 shadow-s border-highlight color-highlight bg-theme"><i class="fa fa-lg fa-comment-dots"></i></a>
          </div>
        </div>
      </div>
    </div>
    @else
      <div class="card bg-transparent" data-card-height="cover">
        <div class="card-center text-center">
          @include('components.stickymobile.login')
        </div>
      </div>
    @endauth
  </div>
</div>
