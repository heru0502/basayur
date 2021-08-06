<template>
  <div>
    <div class="header header-fixed header-logo-center">
      <a href="index.html" class="header-title">Lokasi</a>
      <a href="#"  class="header-icon header-icon-1"><i class="fas fa-arrow-left"></i></a>
    </div>

    <div class="fixed-bottom card mb-0" style="z-index: 1">
      <div class="content">

        <div class="row mb-2">
          <div v-if="geoAllowed">
            <p class="mb-1">
              Akurasi: {{accuracy}} meter -
              <span v-if="accuracy < 25" class="color-green-dark">Sangat Akurat!</span>
              <span v-else-if="accuracy < 60" class="color-yellow-dark">Lumayan akurat</span>
              <span v-else class="color-red-dark">Nyasar</span>
            </p>

            <p v-if="accuracy >= 60" style="line-height: 14pt">Maaf sistem kami tidak berhasil mendapatkan lokasi anda secara akurat.</p>
          </div>

          <div v-if="!geoAllowed && !isLoading">

            <span class="color-red-dark">Gagal mendapatkan titik lokasi</span><br>
            <p style="line-height: 14pt">Pastikan anda sudah mengijinkan sistem kami untuk mendapatkan lokasi anda.</p>

          </div>
        </div>

        <div class="row mb-0 px-2">
          <button @click="getPosition"
            :class="(isLoading ? 'bg-gray-dark' : 'bg-highlight') +' col me-2 btn btn-m btn-full text-uppercase font-800 rounded-xl shadow-l'"
            :disabled="isLoading === true">Simpan Lokasi Ini
          </button>

          <button @click="getPosition"
            :class="(isLoading ? 'bg-gray-dark' : 'border-blue-dark color-blue-dark bg-theme') +' col-auto btn btn-m text-uppercase font-800 rounded-xl '"
            :disabled="isLoading === true"><i class="fas fa-crosshairs"></i> Cari Lokasi
          </button>
        </div>
      </div>
    </div>

    <div class="page-content header-clear mb-0 pb-0">
      <div class="card mb-0 map-full" data-card-height="cover">
        <div class="card-top">

          <div v-if="isLoading" class="row justify-content-center mt-5">
            <div class="spinner-border color-highlight" role="status">
              <span class="sr-only">Loading...</span>
            </div>
            <br>
            <p class="text-center">Mohon tunggu, sistem kami sedang mencari lokasi anda . . .</p>
          </div>

          <iframe v-if="geoAllowed && !isLoading" class="location-map" :src="'https://maps.google.com/maps?q='+ latlong +'&t=&z=15&ie=UTF8&iwloc=&output=embed'"></iframe>

        </div>
      </div>
    </div>
  </div>
</template>

<script>
import 'izitoast/dist/css/iziToast.min.css'
import iziToast from 'izitoast'

export default {
  data() {
    return {
      latitude: '',
      longitude: '',
      latlong: 'banjarbaru',
      accuracy: 0,
      isLoading: false,
      timer: null,
      count: 0,
      watchId: null,
      geoAllowed: false
    }
  },
  mounted() {
    this.getPosition();
  },
  methods: {
    reset() {
      this.latlong = 'banjarbaru';
      this.accuracy = 0;
      this.count = 0;
      this.timer = null;
    },
    getPosition() {
      this.reset();
      if (navigator.geolocation) {
        this.isLoading = true;

        const options = {
          enableHighAccuracy: true
        };

        this.watchId = navigator.geolocation.watchPosition(this.showPosition, this.errorGetPosition, options)
      }
    },
    showPosition(position) {
      this.geoAllowed = true;
      if (this.timer === null) {
        this.timer = setInterval(this.increaseCount, 1000);
      }

      console.log('latlong: '+position.coords.latitude+' '+position.coords.longitude);
      this.latitude = position.coords.latitude;
      this.longitude = position.coords.longitude;
      this.latlong = this.latitude+','+this.longitude;
      this.accuracy = position.coords.accuracy;

      if (this.accuracy < 25) {
        iziToast.success({
          message: 'Lokasi ditemukan secara akurat!',
          maxWidth: '90%',
          position: 'bottomCenter',
          class: 'myOwnToast',
          progressBar: false,
          transitionInMobile: 'flipInX'
        });

        this.stopWatch();
      }
    },
    errorGetPosition() {
      this.geoAllowed = false;
      this.stopWatch();
      iziToast.error({
        message: 'Gagal mendapatkan lokasi',
        maxWidth: '90%',
        position: 'bottomCenter',
        class: 'myOwnToast',
        progressBar: false,
        transitionInMobile: 'flipInX'
      });
    },
    increaseCount() {
      this.count++;

      if (this.count > 10) {
        if (this.accuracy >= 25 && this.accuracy < 60) {
          iziToast.warning({
            message: 'Lokasi ditemukan walaupun kurang akurat',
            maxWidth: '90%',
            position: 'bottomCenter',
            class: 'myOwnToast',
            progressBar: false,
            transitionInMobile: 'flipInX'
          });
        }
        else if (this.accuracy >= 60) {
          iziToast.error({
            message: 'Lokasi tidak akurat!',
            maxWidth: '90%',
            position: 'bottomCenter',
            class: 'myOwnToast',
            progressBar: false,
            transitionInMobile: 'flipInX'
          });
        }

        this.stopWatch();
      }
    },
    stopWatch() {
      this.isLoading = false;
      clearInterval(this.timer);
      navigator.geolocation.clearWatch(this.watchId);
    }
  }
}
</script>

<style>
.myOwnToast {
  border-radius: 10px !important;
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
  margin-bottom: 130px;
}
</style>