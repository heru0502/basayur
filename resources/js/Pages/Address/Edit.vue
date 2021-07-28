<template>
  <div>
    <div class="header header-fixed header-logo-center">
      <a href="index.html" class="header-title">Alamat Pengiriman</a>
      <a href="#" @click="back" class="header-icon header-icon-1"><i class="fas fa-arrow-left"></i></a>
    </div>

    <div class="page-content header-clear-medium">
      <div class="card card-style">
        <div class="content">
          <form @submit.prevent="submit">
            <div class="input-style input-style-always-active has-borders no-icon mb-4">
              <label for="form5" class="color-green-dark">Pilih Provinsi</label>
              <select id="form5" disabled>
                <option value="" v-for="province in provinces">{{province.name}}</option>
              </select>
              <em></em>
            </div>

            <div class="input-style input-style-always-active has-borders no-icon mb-0">
              <label class="color-green-dark">Pilih Kota / Kabupaten</label>
              <select v-model="form.regency_id" @change="reload('districts')">
                <option value="" selected>-- Pilih --</option>
                <option v-for="regency in regencies" :value="regency.id">{{regency.name}}</option>
              </select>
              <span><i class="fa fa-chevron-down"></i></span>
              <em class="mt-n3 me-4">(required)</em>
              <i v-if="errors.regency_id" class="fa fa-times invalid color-red-dark"></i>
            </div>
            <span v-if="errors.regency_id" class="color-red-light ms-1 mb-2">{{errors.regency_id}}</span>

            <div class="input-style input-style-always-active has-borders no-icon mb-0 mt-4">
              <label class="color-green-dark">Pilih Kecamatan</label>
              <select v-model="form.district_id" @change="reload('villages')">
                <option value="" selected>-- Pilih --</option>
                <option v-for="district in districts" :value="district.id">{{district.name}}</option>
              </select>
              <span><i class="fa fa-chevron-down"></i></span>
              <em class="mt-n3 me-4">(required)</em>
              <i v-if="errors.district_id" class="fa fa-times invalid color-red-dark"></i>
            </div>
            <span v-if="errors.district_id" class="color-red-light ms-1 mb-2">{{errors.district_id}}</span>

            <div class="input-style input-style-always-active has-borders no-icon mb-0 mt-4">
              <label class="color-green-dark">Pilih Kelurahan</label>
              <select v-model="form.village_id">
                <option value="" selected>-- Pilih --</option>
                <option v-for="village in villages" :value="village.id">{{village.name}}</option>
              </select>
              <span><i class="fa fa-chevron-down"></i></span>
              <em class="mt-n3 me-4">(required)</em>
              <i v-if="errors.village_id" class="fa fa-times invalid color-red-dark"></i>
            </div>
            <span v-if="errors.village_id" class="color-red-light ms-1 mb-2">{{errors.village_id}}</span>

            <div class="input-style input-style-always-active has-borders no-icon mb-0 mt-4">
              <textarea v-model="form.address" placeholder="Tulis detail alamat..."></textarea>
              <label class="color-green-dark">Alamat</label>
              <em class="mt-n3 me-4">(required)</em>
              <i v-if="errors.address" class="fa fa-times invalid color-red-dark"></i>
            </div>
            <span v-if="errors.address" class="color-red-light ms-1 mb-2">{{errors.address}}</span>

            <div class="divider divider-margins my-4"></div>

            <div class="input-style input-style-always-active has-borders no-icon validate-field mb-0">
              <input type="text" class="form-control validate-name" v-model="form.phone_number" placeholder="08xxx">
              <label class="color-green-dark">No. HP</label>
              <em class="mt-n3 me-4">(required)</em>
              <i v-if="errors.phone_number" class="fa fa-times invalid color-red-dark"></i>
            </div>
            <span v-if="errors.phone_number" class="color-red-light ms-1 mb-2">{{errors.phone_number}}</span>

<!--            <div class="divider divider-margins mb-4"></div>-->

<!--            <span class="color-highlight">Lokasi</span>-->
<!--            <div class="responsive-iframe add-iframe" v-if="this.$store.state.addressLatLong">-->
<!--              <iframe style="pointer-events: none;" class="location-map" src='https://maps.google.com/maps?q=banjarbaru&t=&z=13&ie=UTF8&iwloc=&output=embed'></iframe>-->
<!--            </div>-->

<!--            <inertia-link v-else href="/address/map" class="btn btn-xxl btn-full mb-3 rounded-0 border-highlight color-gray-dark bg-gray-light">Tambahkan lokasi</inertia-link>-->

            <div class="row mx-1 mt-4">
              <button type="submit" class="btn btn-m btn-full rounded-s text-uppercase font-500 shadow-s bg-highlight">
                Simpan
              </button>
            </div>
          </form>

        </div>
      </div>
    </div>
  </div>
</template>

<script>
  import {Inertia} from "@inertiajs/inertia";

  export default {
    props: {
      provinces: Object,
      regencies: Object,
      districts: Object,
      villages: Object,
      errors: Object
    },
    data() {
      return {
        form: {
          regency_id: '',
          district_id: '',
          village_id: '',
          address: '',
          phone_number: ''
        }
      }
    },
    mounted() {

    },
    methods: {
      back() {
        window.history.back();
      },
      reload(event) {
        Inertia.reload({
          replace: true,
          only: [event],
          data: {
            regency_id: this.form.regency_id,
            district_id: this.form.district_id
          },
          // onStart: visit => {
          //   this.isLoading = true;
          // },
          // onFinish: visit => {
          //   this.isLoading = false;
          // }
        });
      },
      submit() {
        this.$inertia.post('/address', this.form);
      }
      // geoLocate() {
      //   function success(position) {
      //     const latitude  = position.coords.latitude;
      //     const longitude = position.coords.longitude;
      //     var mapL1 = 'https://maps.google.com/maps?q=';
      //     var mapL2 = latitude+',';
      //     var mapL3 = longitude;
      //     var mapL4 = '&z=16&t=&output=embed'
      //     var mapLinkEmbed = mapL1 + mapL2 + mapL3 + mapL4;
      //     document.getElementsByClassName('location-map')[0].setAttribute('src',mapLinkEmbed);
      //     console.log(latitude+','+longitude);
      //   }
      //   function error() {
      //     // locationCoordinates.textContent = 'Unable to retrieve your location';
      //   }
      //   navigator.geolocation.getCurrentPosition(success, error);
      // }
    }
  }
</script>