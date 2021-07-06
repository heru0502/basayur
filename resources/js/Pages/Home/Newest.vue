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
            <a href="#"><img :src="menu.image"  class="rounded-sm shadow-xl img-fluid"></a>
            <a href="#">
              <h5 class="mt-3" style="line-height: 0px">{{ menu.name }}</h5>
              <span v-if="menu.in_stock" class="color-green-dark font-10">In Stock</span>
              <span v-else class="color-green-dark font-10">Tersedia: {{menu.stock}}</span>
            </a>
            <span v-if="menu.original_price > menu.selling_price" class=" font-10" style="line-height: 0px"><del>Rp {{menu.original_price}}</del> <span class="badge bg-green-light color-white">Hemat {{menu.discount}}%</span></span>

            <h5 class=" color-highlight">Rp {{menu.selling_price}} <span class="color-gray-dark font-12 font-500">/ {{menu.size_per_unit}} {{menu.unit.name}}</span></h5>

            <a href="#" class="btn btn-xxs font-800 font-16 rounded-xl btn-full text-uppercase bg-highlight">BELI</a>

            <div class="align-self-center">
              <div class="stepper rounded-s float-start">
                <a href="#" @click="qty=qty-1"><i class="fa fa-minus color-red-dark"></i></a>
                <input type="number" min="0" max="99" :value="getTotalQty(menu.id)" readonly>
                <a href="#" @click="addItem(menu)"><i class="fa fa-plus color-green-dark"></i></a>
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
      newestMenus: Object,
    },
    data() {
      return {
        items: [],
        totalQty: 0,
        newItem: null,
        qty: 0
      }
    },
    mounted() {
      // localStorage.removeItem('items');
      if (localStorage.getItem('items')) {
        try {
          this.items = JSON.parse(localStorage.getItem('items'));
          this.totalQty = this.$store.state.count;
        } catch (e) {
          localStorage.removeItem('items');
        }
      }
    },
    methods: {
      getTotalQty(id) {
        let checkItems = this.items.filter(function (item) {
          return item.id === id;
        });

        if (checkItems.length) {
          return checkItems[0].qty;
        }

        return 0;
      },
      addItem(menu) {
        this.$store.commit('increment');
        this.newItem = menu;

        // Check menu exist or not
        var checkItems = this.items.filter(function (item) {
          return item.id === menu.id;
        });

        if (checkItems.length) {
          // Update qty
          const remapItems = this.items.map(item => {
            if (item.id === menu.id) {
              const ii = item;
              ii.qty = item.qty + 1;
              return ii;
            }

            return item;
          });

          this.items = remapItems;
        }
        else {
          // Insert new item
          this.newItem.qty = 1;
          this.items.push(this.newItem);
        }

        // Count total qty
        let n = 0;
        this.items.map(item => {
          n += item.qty;
        });
        this.totalQty = n;

        this.newItem = '';

        this.saveItems();
      },
      saveItems() {
        localStorage.removeItem('items');
        const parsed = JSON.stringify(this.items);
        localStorage.setItem('items', parsed);
        localStorage.setItem('totalQty', this.totalQty);
      }
    }
  }
</script>