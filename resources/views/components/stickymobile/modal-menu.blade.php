<!--  Modal Detail Menu -->
<div id="menu-cart-edit-1" wire:ignore.self class="menu menu-box-bottom menu-box-detached d-block">
  <div class="menu-title"><a href="#" class="close-menu"><i class="fa fa-times"></i></a></div>

  <div class="content mb-1">
    <div class="row mb-0">
      <div class="col-12">
        <div wire:loading>
          <img src="{{ asset('theme/images/default-image.png') }}" class="rounded-m shadow-xl img-fluid" >
        </div>

        <div wire:loading.remove>
          <img src="{{ asset($selected_menu['image'] ?? null) }}" class="rounded-m shadow-xl img-fluid" >
        </div>
      </div>
    </div>
    <div class="row mb-1">
      <div class="col-12">
        <h5 class="mt-3" style="line-height: 12px">
          {{ $selected_menu['name'] ?? null }}
          <span class="color-green-dark font-10">
            @if($selected_menu['in_stock'])
              In Stock
            @else
              Tersedia: {{ $selected_menu['stock'] ?? null }}
            @endif
            </span>
        </h5>

        @if(($selected_menu['special_price'] ?? null))
          <div class="d-flex">
            <div>
              <span class="font-13"><del>Rp {{ $selected_menu['price'] ?? null }}</del> <span class="badge bg-green-light color-white">Hemat 20%</span></span>
            </div>

            <div class="ms-3">
              <h3 class=" color-highlight">Rp {{ $selected_menu['special_price'] ?? null }} <span class="color-gray-dark font-14 font-500">/ 1 kg</span></h3>
            </div>
          </div>
        @else
          <h3 class="color-highlight">Rp {{ $selected_menu['price'] ?? null }} <span class="color-gray-dark font-14 font-500">/ 1 kg</span></h3>
        @endif
      </div>
    </div>
    <div class="row mb-3">
      <div class="col-12">
        <p style="line-height: 14pt">{{ $selected_menu['description'] ?? null }}</p>
      </div>
    </div>

    <div class="row mb-3">
      <div wire:loading>
        <a href="#" disabled class="btn btn-sm font-800 font-16 rounded-xl btn-full text-uppercase bg-gray-dark">BELI</a>
      </div>

      <div wire:loading.remove>
        <a href="#" wire:click="increase({{ json_encode($selected_menu) }})" class="close-menu btn btn-sm font-800 font-16 rounded-xl btn-full text-uppercase bg-highlight">BELI</a>
      </div>
    </div>
  </div>
</div>