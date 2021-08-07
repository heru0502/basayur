<template>
  <div>
    <div class="header header-fixed header-logo-center">
      <a href="#" class="header-title">Alamat Pengiriman</a>
      <a href="#" onclick="window.history.back();" class="header-icon header-icon-1"><i class="fas fa-arrow-left"></i></a>
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
              <textarea v-model="form.address"></textarea>
              <label class="color-green-dark">Alamat</label>
              <em class="mt-n3 me-4">(required)</em>
              <i v-if="errors.address" class="fa fa-times invalid color-red-dark"></i>
            </div>
            <span v-if="errors.address" class="color-red-light ms-1 mb-2">{{errors.address}}</span>

            <div class="divider divider-margins my-4"></div>

            <div class="input-style input-style-always-active has-borders no-icon validate-field mb-0">
              <input type="text" class="form-control validate-name" v-model="form.phone_number">
              <label class="color-green-dark">No. HP</label>
              <em class="mt-n3 me-4">(required)</em>
              <i v-if="errors.phone_number" class="fa fa-times invalid color-red-dark"></i>
            </div>
            <span v-if="errors.phone_number" class="color-red-light ms-1 mb-2">{{errors.phone_number}}</span>

            <div class="divider divider-margins mb-4"></div>

            <span class="color-green-dark">Lokasi</span>

            <inertia-link href="/address/map" v-if="form.location_point">
              <div class="responsive-iframe add-iframe" >
                  <iframe style="pointer-events: none;"
                    class="location-map"
                    :src="'https://maps.google.com/maps?q=' +form.location_point+ '&t=&z=15&ie=UTF8&iwloc=&output=embed'">
                  </iframe>
              </div>
            </inertia-link>

            <inertia-link v-else href="/address/map"
              class="btn btn-xxl btn-full mb-3 rounded-m border-gray-dark color-gray-dark bg-gray-light">
              Tambahkan lokasi
            </inertia-link>

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
  import iziToast from 'izitoast'

  export default {
    props: {
      address: Object,
      provinces: Object,
      regencies: Object,
      districts: Object,
      villages: Object,
      errors: Object,
    },
    remember: {
      data: ['form'],
    },
    data() {
      return {
        form: {
          regency_id: this.address ? this.address.village.district.regency.id : '',
          district_id: this.address ? this.address.village.district.id : '',
          village_id: this.address ? this.address.village_id : '',
          address: this.address ? this.address.address : '',
          phone_number: this.address ? this.address.phone_number : '',
          location_point: this.address ? this.address.location_point : this.$store.state.latLong
        }
      }
    },
    mounted() {
      //
    },
    methods: {
      reload(event) {
        Inertia.reload({
          replace: true,
          only: [event],
          data: {
            regency_id: this.form.regency_id,
            district_id: this.form.district_id
          },
        });
      },
      submit() {
        Inertia.post('/address', this.form, {
          replace: true,
          onSuccess: () => {
            iziToast.success({
              message: 'Alamat berhasil disimpan',
              maxWidth: '90%',
              position: 'bottomCenter',
              // class: 'myOwnToast',
              progressBar: false,
              transitionInMobile: 'flipInX'
            });
          }
        });
      }
    }
  }
</script>