<div>
  <div class="header header-fixed header-logo-center">
    <a href="index.html" class="header-title">Pencarian</a>
    <a href="#" data-back-button class="header-icon header-icon-1"><i class="fas fa-arrow-left"></i></a>
    <a href="/cart" class="header-icon header-icon-4">
      <i class="fa fa-shopping-basket"></i>
      <span class="badge bg-red-dark">{{ $total_item === 0 ? '' : $total_item }}</span>
    </a>
  </div>

  <div class="page-content header-clear-medium">
    <div class="search-box bg-white rounded-xl bottom-0 mx-3 mb-3">
      <i class="fa fa-search"></i>
      <input type="text" class="border-0" placeholder="Tulis disini yang ingin dicari . . .">
    </div>

    <div class="row mb-2 mx-3">
      <div class="col-12 ps-1">
        @foreach($categories as $category)
          <a href="#" class="btn btn-xxs mb-1 rounded-xl text-uppercase font-900 border-highlight color-highlight bg-theme">{{ $category->name }}</a>
        @endforeach
      </div>
    </div>

    <div class="row mb-2 mx-3">
      <div class="col-12 ps-1">
        <a href="#" class="btn btn-xxs mb-1 text-uppercase font-900 border-blue-dark color-blue-dark bg-theme">Promo</a>
        <a href="#" class="btn btn-xxs mb-1 text-uppercase font-900 border-blue-dark color-blue-dark bg-theme">Pilihan</a>
      </div>
    </div>

    <div class="row mb-0 mx-3">
      <div class="col-12 ps-1">
        <div class="input-style has-borders has-icon mb-4 input-filter">
          <i class="fa fa-sort-amount-down"></i>
          <select id="form5">
            <option value="">Terbaru</option>
            <option value="">Terlama</option>
            <option value="">Termurah</option>
            <option value="">Termahal</option>
            <option value="">Terlaris</option>
          </select>
          <span><i class="fa fa-chevron-down"></i></span>
        </div>
      </div>
    </div>

    <div class="row mb-0 mx-3">
      @foreach($menus as $i => $menu)
        <div class="col-6 p-0 m-0">
          <div class="card card-style m-1" wire:key="{{ $menu->id }}">
            <div class="card card-style me-0 ms-0 mb-0" >
              <a href="#" wire:click="selected({{ $menu }})" data-menu="menu-cart-edit-1"><img src="{{ asset($menu->image) }}"  class="rounded-sm shadow-xl img-fluid"></a>
            </div>

            <div class="content">
              <a href="#" wire:click="selected({{ $menu }})" data-menu="menu-cart-edit-1">
                <h5 class="mt-3" style="line-height: 0px">{{ $menu->name }}</h5>
                <span class="color-green-dark font-10">
                  @if($menu->in_stock)
                    In Stock
                  @else
                    Tersedia: {{ $menu->stock }}
                  @endif
                </span>
                <br>
              </a>
              @if($menu->special_price)
                <span class=" font-10" style="line-height: 0px"><del>Rp {{ $menu->price }}</del> <span class="badge bg-green-light color-white">Hemat {{ $menu->discount }}%</span></span>
              @endif

              <h5 class=" color-highlight">Rp {{ $menu->special_price ?? $menu->price }} <span class="color-gray-dark font-12 font-500">/ {{ $menu->size_per_unit }} {{ $menu->unit->name }}</span></h5>

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
          </div>
        </div>
      @endforeach
    </div>
  </div>

  @include('components.stickymobile.modal-menu')
</div>
