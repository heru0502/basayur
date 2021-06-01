<div>
  <div class="header header-fixed header-logo-center">
    <a href="index.html" class="header-title">Checkout</a>
    <a href="#" data-back-button class="header-icon header-icon-1"><i class="fas fa-arrow-left"></i></a>
  </div>

  <div class="fixed-bottom card mb-0" style="z-index: 1">
    <div class="d-flex flex-row-reverse m-1">
      <div class="p-2">
        <a href="/payment-method" class="btn btn-m btn-full rounded-s text-uppercase font-500 shadow-s bg-highlight">Bayar</a>
      </div>
      <div class="p-2 text-end">
        <h3 class="mb-0 color-highlight">Rp {{ $subtotal }}</h3>
        <img src="theme/images/pictures/coins.png" height="20"> <span class="color-highlight ">Dapatkan 50 poin</span>
      </div>
      <div class="p-2 flex-fill">
        Total Pembayaran :
      </div>
    </div>
  </div>

  <div class="page-content header-clear-medium">
    <div class="card card-style">
      <div class="content">
        @if($address)
          <div class="d-flex">
            <div>
              <h4>Alamat Pengiriman</h4>
            </div>
            <div class="flex-fill text-end">
              <a href="/address" class="color-theme opacity-50 "><i class="fa fa-edit pe-2"></i>Ubah</a>
            </div>
          </div>
          <p class="my-2" style="line-height: 18px">
            {{ $address->address }}
          </p>
          <p>
            {{ $address->phone_number }}
          </p>
        @else
          <div class="d-flex">
            <div>
              <h4>Alamat Pengiriman</h4>
            </div>
          </div>
          <p class="color-red-light">Anda belum menambahkan alamat.</p>

          @auth('customer')
            <a href="/address" class="btn btn-m btn-full rounded-xl text-uppercase font-500 shadow-s bg-green-light">Tambah Alamat</a>
          @else
            <a href="#" data-menu="menu-login-1" class="btn btn-m btn-full rounded-xl text-uppercase font-500 shadow-s bg-green-light">Tambah Alamat</a>
          @endauth
        @endif
      </div>
    </div>

    <div class="card card-style">
      <div class="content">
        @foreach($items as $item)
          <div class="d-flex mb-0">
            <div>
              <img src="{{ $item['image'] }}" class="rounded-m shadow-xl" width="80">
            </div>
            <div class="ms-3 flex-fill">
              <h5 class="mt-1">
                {{ $item['name'] }}
                <span class="color-green-dark font-10">
                  @if($item['in_stock'])
                    In Stock
                  @else
                    Tersedia: {{ $item['stock'] }}
                  @endif
                </span>
              </h5>

              @if($item['special_price'])
                <span class="font-13"><del>Rp {{ $item['price'] }}</del> <span class="badge bg-green-light color-white">Hemat {{ $item['discount'] }}%</span></span>
              @endif

              <div class="d-flex m-1">
                <div class="">
                  <h3 class=" color-highlight">Rp {{ $item['special_price'] ?? $item['price'] }} <span class="color-gray-dark font-14 font-500">/ {{ $item['size_per_unit'] }} {{ $item['unit']['name'] }}</span></h3>
                </div>
                <div class="flex-fill text-end">
                  <p>x{{ getTotalBuyNumber($item['id'], $items) }}</p>
                </div>
              </div>
            </div>
          </div>
          <div class="divider divider-margins mb-3"></div>
        @endforeach

        <div class="row mb-0">
          <div class="col-12 pe-1">
            <a href="/" class="btn btn-xl btn-full mb-3 rounded-xl font-700 border-white color-green-light bg-theme"><i class="fa fa-lg fa-shopping-basket"></i> Belanja lagi</a>
          </div>
        </div>
      </div>
    </div>

    <div class="card card-style bg-yellow-light">
      <p class="content color-white mb-4 text-center">
        Apabila barang tidak tersedia, anda cukup membayar yang tersedia saja.
      </p>
    </div>

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
            {{ $shipment_date }}
          </div>
        </div>
        <div class="divider divider-margins mb-2"></div>

        <div class="d-flex mb-1">
          <div>
            Waktu Pengiriman
          </div>
          <div class="flex-fill text-end">
            {{ $shipment_time }}
          </div>
        </div>
        <div class="divider divider-margins mb-4"></div>

        <div class="input-style input-style-always-active has-borders validate-field mb-4">
          <input type="text" wire:model="note" wire:keydown.debounce.1s="saveNote" class="form-control" id="note" placeholder="Tulis catatan anda disini...">
          <label for="note" class="color-theme opacity-50 text-uppercase font-700 font-10">Catatan</label>
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
            {{ "Subtotal ($total_item item)" }}
          </div>
          <div class="flex-fill text-end">
            Rp {{ $subtotal }}
          </div>
        </div>
        <div class="divider divider-margins mb-2"></div>

        <div class="d-flex mb-1">
          <div>
            <p class="mb-0" style="line-height: 8pt">Ongkos Kirim</p>
            <span class="font-11 color-orange-light">GRATIS ONGKIR minimal belanja Rp 30.000</span>
          </div>
          <div class="flex-fill text-end">
            Rp {{ $shipment_price }}
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
      @include('components.stickymobile.login')
    </div>
  </div>
</div>
