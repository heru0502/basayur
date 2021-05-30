<div>
  <div class="header header-fixed header-logo-center">
    <a href="index.html" class="header-title">Cart</a>
    <a href="/" class="header-icon header-icon-1"><i class="fas fa-arrow-left"></i></a>
  </div>

  <div class="fixed-bottom card mb-0">
    <div class="d-flex flex-row-reverse m-1">
      <div class="p-2">
        <a href="/checkout" class="btn btn-m btn-full rounded-s text-uppercase font-500 shadow-s bg-highlight">Checkout</a>
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
    <div class="card gradient-orange">
      <p class="content color-white mb-4 text-center">
        Grating ongkir minimum belanja Rp 50.000
      </p>
    </div>

    <div class="card card-style">
      <div class="content">

        @foreach($items as $item)
          <div class="d-flex mb-0">
            <div>
              <img src="{{ $item['image'] }}" class="rounded-m shadow-xl" width="80">
            </div>
            <div class="ms-3">
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

              <div class="row mb-3">
                <div class="col-7">
                  <h3 class=" color-highlight">Rp {{ $item['special_price'] ?? $item['price'] }} <span class="color-gray-dark font-14 font-500">/ {{ $item['size_per_unit'] }} {{ $item['unit']['name'] }}</span></h3>
                </div>
                <div class="col-4">
                  <div class="stepper rounded-s float-start">
                    <a href="#" class="stepper-sub" wire:click.prevent="decrease({{ $item['id'] }})"><i class="fa fa-minus color-red-dark"></i></a>
                    <input type="number" min="0" max="99" value="{{ getTotalBuyNumber($item['id'], $items) }}" readonly>
                    <a href="#" class="stepper-add" wire:click.prevent="increase({{ json_encode($item) }})"><i class="fa fa-plus color-green-dark"></i></a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="divider divider-margins mb-3"></div>
        @endforeach


        <div class="row mb-0">
          <div class="col-12 pe-1">
            <a href="#" data-back-button class="btn btn-xl btn-full mb-3 rounded-xl font-700 border-white color-green-light bg-theme"><i class="fa fa-lg fa-shopping-basket"></i> Tambah lagi</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>