<div>
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
              <h3 class=" color-highlight">Rp {{ $menu->special_price }} <span class="color-gray-dark font-14 font-500">/ 1 kg</span></h3>
            @else
              <h3 class=" color-highlight">Rp {{ $menu->price }} <span class="color-gray-dark font-14 font-500">/ 1 kg</span></h3>
            @endif

            @if(($items[$menu->id]['buy_number'] ?? 0) < 1)
              <a href="#" wire:click="increase({{ $menu->id }})" class="btn btn-xxs font-800 font-16 rounded-xl btn-full text-uppercase bg-highlight">BELI</a>
            @endif

            @if(($items[$menu->id]['buy_number'] ?? 0) > 0)
              <div class="align-self-center">
                <div class="stepper rounded-s float-start">
                  <a href="#" class="stepper-sub" wire:click="decrease({{ $menu->id }})"><i class="fa fa-minus color-red-dark"></i></a>
                  <input type="number" min="1" max="99" wire:model="items.{{ $menu->id }}.buy_number" readonly>
                  <a href="#" class="stepper-add" wire:click="increase({{ $menu->id }})"><i class="fa fa-plus color-green-dark"></i></a>
                </div>
              </div>
            @endif
          </div>
          @endforeach

          <div class="card card-style-custom pb-3" style="width: 170px;">
            <a href="#"><img src="theme/images/pictures/17s.jpg"  class="rounded-sm shadow-xl img-fluid"></a>
            <a href="#">
              <h5 class="mt-1">Brilliant Headset </h5>
              <span class="color-green-dark font-10">In Stock</span>
            </a>
            <span class=" font-13"><del>Rp 50.000</del> <span class="badge bg-green-light color-white">Hemat 20%</span></span>
            <h3 class=" color-highlight">Rp 40.000 <span class="color-gray-dark font-14 font-500">/ 1 kg</span></h3>

            <div class="align-self-center">
              <div class="stepper rounded-s float-start">
                <a href="#" class="stepper-sub"><i class="fa fa-minus color-red-dark"></i></a>
                <input type="number" min="1" max="99" value="10">
                <a href="#" class="stepper-add"><i class="fa fa-plus color-green-dark"></i></a>
              </div>
            </div>
          </div>

          <div class="card card-style-custom pb-3" style="width: 170px;">
            <a href="#"><img src="theme/images/pictures/17s.jpg"  class="rounded-sm shadow-xl img-fluid"></a>
            <a href="#">
              <h5 class="mt-1">Brilliant Headset 2</h5>
              <span class="color-green-dark font-10">In Stock</span>
            </a>
            <span class=" font-13"><del>Rp 50.000</del> <span class="badge bg-green-light color-white">Hemat 20%</span></span>
            <h3 class=" color-highlight">Rp 40.000 <span class="color-gray-dark font-14 font-500">/ 1 kg</span></h3>
            <a href="#" class="btn btn-xxs btn-full rounded-xl text-uppercase font-500 shadow-s bg-highlight">Beli</a>
          </div>
        </div>
      </div>

    </div>
  </div>

  @include('components.stickymobile.modal-menu')
</div>

@include('components.stickymobile.update-cart-number')


