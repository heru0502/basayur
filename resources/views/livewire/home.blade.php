<div>
  @include('components.stickymobile.footer-bar')

  <div class="page-content header-clear-small">
    <div class="search-box bg-white rounded-xl bottom-0 mx-3 mb-3">
      <i class="fa fa-search"></i>
      <input type="text" class="border-0" placeholder="Apa yang dicari hari ini?">
    </div>

    <div class="splide single-slider slider-arrows" wire:ignore id="single-slider-3">
      <div class="splide__track">
        <div class="splide__list">
          <div class="splide__slide">
            <div data-card-height="200" class="card mx-3 bg-18 rounded-m shadow-l">
              <div class="card-bottom text-center mb-3">
                <h2 class="color-white text-uppercase font-900 mb-0">Splendid Simplicity</h2>
                <p class="under-heading color-white">A new generation of Mobile Kits.</p>
              </div>
              <div class="card-overlay bg-gradient"></div>
            </div>
          </div>
          <div class="splide__slide">
            <div data-card-height="200" class="card mx-3 bg-14 rounded-m shadow-l">
              <div class="card-bottom text-center mb-3">
                <h2 class="color-white text-uppercase font-900 mb-0">Top Notch Quality</h2>
                <p class="under-heading color-white">Flexibility, Speed, Ease of Use.</p>
              </div>
              <div class="card-overlay bg-gradient"></div>
            </div>
          </div>
          <div class="splide__slide">
            <div data-card-height="200" class="card mx-3 bg-14 rounded-m shadow-l">
              <div class="card-bottom text-center mb-3">
                <h2 class="color-white text-uppercase font-900 mb-0">Perfectly Organized</h2>
                <p class="under-heading color-white">Mobile Website, or App or PWA Ready.</p>
              </div>
              <div class="card-overlay bg-gradient"></div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="card card-style mt-3">
      <div class="content">
        <div class="row mb-0 text-center">
          <a href="{{ '/menus?'. http_build_query(['selected_categories' => [1]]) }}" class="col-3 align-text-bottom">
            <img src="theme/images/icons/categories/vegetable.png" class="img-fluid">
            <p class="font-11 font-700 text-uppercase">SAYURAN</p>
          </a>
          <a href="{{ '/menus?'. http_build_query(['selected_categories' => [2]]) }}" class="col-3">
            <img src="theme/images/icons/categories/fish.png" class="img-fluid">
            <p class="font-11 font-700 text-uppercase">IKAN</p>
          </a>
          <a href="{{ '/menus?'. http_build_query(['selected_categories' => [3]]) }}" class="col-3">
            <img src="theme/images/icons/categories/chicken.png" class="img-fluid">
            <p class="font-11 font-700 text-uppercase">DAGING</p>
          </a>
          <a href="{{ '/menus?'. http_build_query(['selected_categories' => [4]]) }}" class="col-3">
            <img src="theme/images/icons/categories/seasoning.png" class="img-fluid">
            <p class="font-11 font-700 text-uppercase">BUMBU</p>
          </a>
          <div class="w-100 mb-3 mt-3"></div>
          <a href="{{ '/menus?'. http_build_query(['selected_categories' => [5]]) }}" class="col-3">
            <img src="theme/images/icons/categories/tempeh.png" class="img-fluid">
            <p class="font-11 font-700 text-uppercase" style="line-height: 16px">PRODUK OLAHAN</p>
          </a>
          <a href="{{ '/menus?'. http_build_query(['selected_categories' => [6]]) }}" class="col-3">
            <img src="theme/images/icons/categories/salted-fish.png" class="img-fluid">
            <p class="font-11 font-700 text-uppercase" style="line-height: 16px">PRODUK AWETAN</p>
          </a>
          <a href="{{ '/menus?'. http_build_query(['selected_categories' => [7]]) }}" class="col-3">
            <img src="theme/images/icons/categories/flour.png" class="img-fluid">
            <p class="font-11 font-700 text-uppercase" style="line-height: 16px">BAHAN BAKU</p>
          </a>
          <a href="{{ '/menus?'. http_build_query(['selected_categories' => [8]]) }}" class="col-3">
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
            <a href="/menus?selected_filter=is_promo" class="font-14 color-highlight">Lihat semua ></a>
          </div>
        </div>
      </div>

      <div class="container-fluid">
        <div class="row flex-row flex-nowrap overflow-auto mb-0">

          @foreach($menus['promo'] as $i => $menu)
            <div class="card card-style-custom pb-3" style="width: 130px;" wire:key="{{ $menu->id }}">
              <a href="#" wire:click="selected({{ $menu }})" data-menu="menu-cart-edit-1"><img src="{{ asset($menu->image) }}"  class="rounded-sm shadow-xl img-fluid"></a>
              <a href="#" wire:click="selected({{ $menu }})" data-menu="menu-cart-edit-1">
                <h5 class="mt-3" style="line-height: 0px">{{ $menu->name }}</h5>
                <span class="color-green-dark font-10">
                  @if($menu->in_stock)
                    In Stock
                  @else
                    Tersedia: {{ $menu->stock }}
                  @endif
                </span>
              </a>
              @if($menu->original_price > $menu->selling_price)
                <span class=" font-10" style="line-height: 0px"><del>Rp {{ $menu->original_price }}</del> <span class="badge bg-green-light color-white">Hemat {{ $menu->discount }}%</span></span>
              @endif

              <h5 class=" color-highlight">Rp {{ $menu->selling_price }} <span class="color-gray-dark font-12 font-500">/ {{ $menu->size_per_unit }} {{ $menu->unit->name }}</span></h5>

              @if(checkBuyButton($menu->id, $items))
                <a href="#" wire:click="increase({{ $menu }})" class="btn btn-xxs font-800 font-16 rounded-xl btn-full text-uppercase bg-highlight">BELI</a>
              @else
                <div class="align-self-center">
                  <div class="stepper rounded-s float-start">
                    <a href="#" class="stepper-sub" wire:click.prevent="decrease({{ $menu->id }})"><i class="fa fa-minus color-red-dark"></i></a>
                    <input type="number" min="0" max="99" value="{{ getTotalBuyNumber($menu->id, $items) }}" readonly>
                    <a href="#" class="stepper-add" wire:click.prevent="increase({{ $menu }})"><i class="fa fa-plus color-green-dark"></i></a>
                  </div>
                </div>
              @endif
            </div>
          @endforeach

        </div>
      </div>

    </div>

    <div class="card ">
      <div class="content">
        <div class="d-flex mb-3">
          <div class="me-3">
            <h3>Menu Terbaru</h3>
            <p class="mt-n2 color-gray-dark">
              Menu terbaru hari ini
            </p>
          </div>
          <div class="ms-auto">
            <a href="/menus" class="font-14 color-highlight">Lihat semua ></a>
          </div>
        </div>
      </div>

      <div class="container-fluid">
        <div class="row flex-row flex-nowrap overflow-auto mb-0">

          @foreach($menus['latest'] as $i => $menu)
            <div class="card card-style-custom pb-3" style="width: 130px;" wire:key="{{ $menu->id }}">
              <a href="#" wire:click="selected({{ $menu }})" data-menu="menu-cart-edit-1"><img src="{{ asset($menu->image) }}"  class="rounded-sm shadow-xl img-fluid"></a>
              <a href="#" wire:click="selected({{ $menu }})" data-menu="menu-cart-edit-1">
                <h5 class="mt-3" style="line-height: 0px">{{ $menu->name }}</h5>
                <span class="color-green-dark font-10">
                  @if($menu->in_stock)
                    In Stock
                  @else
                    Tersedia: {{ $menu->stock }}
                  @endif
                </span>
              </a>
              @if($menu->original_price > $menu->selling_price)
                <span class=" font-10" style="line-height: 0px"><del>Rp {{ $menu->original_price }}</del> <span class="badge bg-green-light color-white">Hemat {{ $menu->discount }}%</span></span>
              @endif

              <h5 class=" color-highlight">Rp {{ $menu->selling_price }} <span class="color-gray-dark font-12 font-500">/ {{ $menu->size_per_unit }} {{ $menu->unit->name }}</span></h5>

              @if(checkBuyButton($menu->id, $items))
                <a href="#" wire:click="increase({{ $menu }})" class="btn btn-xxs font-800 font-16 rounded-xl btn-full text-uppercase bg-highlight">BELI</a>
              @else
                <div class="align-self-center">
                  <div class="stepper rounded-s float-start">
                    <a href="#" class="stepper-sub" wire:click.prevent="decrease({{ $menu->id }})"><i class="fa fa-minus color-red-dark"></i></a>
                    <input type="number" min="0" max="99" value="{{ getTotalBuyNumber($menu->id, $items) }}" readonly>
                    <a href="#" class="stepper-add" wire:click.prevent="increase({{ $menu }})"><i class="fa fa-plus color-green-dark"></i></a>
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



