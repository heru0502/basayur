<template>
  <div>
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

          <div v-for="menu in newestMenus" class="card card-style-custom pb-3" style="width: 130px;" >
            <a href="#" data-menu="menu-cart-edit-1"><img :src="menu.image"  class="rounded-sm shadow-xl img-fluid"></a>
            <a href="#" data-menu="menu-cart-edit-1">
              <h5 class="mt-3" style="line-height: 0px">{{ menu.name }}</h5>
              <span class="color-green-dark font-10">
                  In Stock
                </span>
            </a>
            <span class=" font-10" style="line-height: 0px"><del>Rp 20000</del> <span class="badge bg-green-light color-white">Hemat 20%</span></span>

            <h5 class=" color-highlight">Rp 15000 <span class="color-gray-dark font-12 font-500">/ 1 kg</span></h5>

            <a href="#" wire:click="increase({{ $menu }})" class="btn btn-xxs font-800 font-16 rounded-xl btn-full text-uppercase bg-highlight">BELI</a>

            <div class="align-self-center">
              <div class="stepper rounded-s float-start">
                <a href="#" class="stepper-sub" wire:click.prevent="decrease({{ $menu->id }})"><i class="fa fa-minus color-red-dark"></i></a>
                <input type="number" min="0" max="99" value="{{ getTotalBuyNumber($menu->id, $items) }}" readonly>
                <a href="#" class="stepper-add" wire:click.prevent="increase({{ $menu }})"><i class="fa fa-plus color-green-dark"></i></a>
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
      newestMenus: Object
    }
  }
</script>