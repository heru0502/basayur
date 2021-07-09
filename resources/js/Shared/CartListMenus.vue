<template>
  <div>
    <div class="card card-style">
      <div class="content">

        <div class="d-flex mb-0" v-for="item in this.$store.state.items">
          <div>
            <img :src="item.image" class="rounded-m shadow-xl" width="80">
          </div>
          <div class="ms-3 flex-fill">
            <h5 class="mt-1">
              {{item.name}}
              <span v-if="item.in_stock" class="color-green-dark font-10">In Stock</span>
              <span v-else class="color-green-dark font-10">Tersedia: {{item.stock}}</span>
            </h5>

            <span v-if="item.selling_price" class="font-13"><del>Rp {{item.original_price}}</del> <span class="badge bg-green-light color-white">Hemat {{item.discount}}%</span></span>

            <div class="d-flex m-1">
              <div class="flex-grow-1">
                <h3 class="color-highlight">Rp {{item.selling_price ? item.selling_price : item.original_price}} <span class="color-gray-dark font-14 font-500">/ {{item.size_per_unit}} {{item.unit.name}}</span></h3>
              </div>
              <div class="">
                <div v-if="page === 'cart'" class="stepper rounded-s">
                  <a @click="this.$store.dispatch('removeItem', {menu: item})"><i class="fa fa-minus color-red-dark"></i></a>
                  <input type="number" min="0" max="99" :value="this.$store.getters.getTotalQty(item.id)" readonly>
                  <a @click="this.$store.dispatch('addItem', {menu: item})"><i class="fa fa-plus color-green-dark"></i></a>
                </div>

                <p v-else>x{{this.$store.getters.getTotalQty(item.id)}}</p>
              </div>
            </div>
          </div>
        </div>
        <div class="divider divider-margins mb-3"></div>

        <div class="row mb-0">
          <div class="col-12 pe-1">
            <a href="/" class="btn btn-xl btn-full mb-3 rounded-xl font-700 border-white color-green-light bg-theme"><i class="fa fa-lg fa-shopping-basket"></i> Tambah lagi</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    props: {
      page: String
    }
  }
</script>