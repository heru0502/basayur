<div>
  @include('components.stickymobile.footer-bar')

  <div class="page-content header-clear-small">

    <div class="card card-style">
      <div class="content">
        <div class="row mb-0 text-center">
          <a href="#" class="col-3 align-text-bottom">
            <img src="theme/images/icons/categories/vegetable.png" class="img-fluid">
            <p class="font-11 font-700 text-uppercase">SAYURAN</p>
          </a>
          <a href="#" class="col-3">
            <img src="theme/images/icons/categories/fish.png" class="img-fluid">
            <p class="font-11 font-700 text-uppercase">IKAN</p>
          </a>
          <a href="#" class="col-3">
            <img src="theme/images/icons/categories/chicken.png" class="img-fluid">
            <p class="font-11 font-700 text-uppercase">DAGING</p>
          </a>
          <a href="#" class="col-3">
            <img src="theme/images/icons/categories/seasoning.png" class="img-fluid">
            <p class="font-11 font-700 text-uppercase">BUMBU</p>
          </a>
          <div class="w-100 mb-3 mt-3"></div>
          <a href="#" class="col-3">
            <img src="theme/images/icons/categories/tempeh.png" class="img-fluid">
            <p class="font-11 font-700 text-uppercase" style="line-height: 16px">PRODUK OLAHAN</p>
          </a>
          <a href="#" class="col-3">
            <img src="theme/images/icons/categories/salted-fish.png" class="img-fluid">
            <p class="font-11 font-700 text-uppercase" style="line-height: 16px">PRODUK AWETAN</p>
          </a>
          <a href="#" class="col-3">
            <img src="theme/images/icons/categories/flour.png" class="img-fluid">
            <p class="font-11 font-700 text-uppercase" style="line-height: 16px">BAHAN BAKU</p>
          </a>
          <a href="#" class="col-3">
            <img src="theme/images/icons/categories/fruit.png" class="img-fluid">
            <p class="font-11 font-700 text-uppercase">BUAH</p>
          </a>
        </div>
      </div>
    </div>

    <div class="card ">
      <div class="content">
        <div class="d-flex mb-3">
          <div class="me-3">
            <h3>Promo Spesial</h3>
            <p class="mt-n2 color-gray-dark">
              Promo terbaru hari ini
            </p>
          </div>
          <div class="ms-auto">
            <a href="#" class="font-14 color-highlight">Lihat semua ></a>
          </div>
        </div>
      </div>

      <div class="container-fluid">
        <div class="row flex-row flex-nowrap overflow-auto mb-0">

          @foreach($menus as $i => $menu)
            <div class="card card-style-custom pb-3" style="width: 170px;" wire:key="{{ $menu->id }}">
              <a href="#" wire:click="selected({{ $menu }})" data-menu="menu-cart-edit-1"><img src="{{ asset($menu->image) }}"  class="rounded-sm shadow-xl img-fluid"></a>
              <a href="#" wire:click="selected({{ $menu }})" data-menu="menu-cart-edit-1">
                <h5 class="mt-1">{{ $menu->name }}</h5>
                <span class="color-green-dark font-10">
                  @if($menu->in_stock)
                    In Stock
                  @else
                    Tersedia: {{ $menu->stock }}
                  @endif
                </span>
              </a>
              @if($menu->special_price)
                <span class=" font-13"><del>Rp {{ $menu->price }}</del> <span class="badge bg-green-light color-white">Hemat 20%</span></span>
              @endif

              <h3 class=" color-highlight">Rp {{ $menu->special_price ?? $menu->price }} <span class="color-gray-dark font-14 font-500">/ {{ $menu->size_per_unit }} {{ $menu->unit->name }}</span></h3>

              @if(checkBuyButton($menu->id, $items))
                <a href="#" wire:click="increase({{ $menu }})" class="btn btn-xxs font-800 font-16 rounded-xl btn-full text-uppercase bg-highlight">BELI</a>
              @else
                <div class="align-self-center">
                  <div class="stepper rounded-s float-start">
                    <a href="#" class="stepper-sub" wire:click="decrease({{ $menu->id }})"><i class="fa fa-minus color-red-dark"></i></a>
                    <input type="number" min="0" max="99" value="{{ getTotalBuyNumber($menu->id, $items) }}" readonly>
                    <a href="#" class="stepper-add" wire:click="increase({{ $menu }})"><i class="fa fa-plus color-green-dark"></i></a>
                  </div>
                </div>
              @endif
            </div>
          @endforeach

        </div>
      </div>

    </div>
  </div>

  @include('components.stickymobile.modal-menu')
</div>


