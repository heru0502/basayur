<template>
  <div>
    <div class="header header-fixed header-logo-center">
      <a href="index.html" class="header-title">Alamat Pengiriman</a>
      <a href="#" @click="back" class="header-icon header-icon-1"><i class="fas fa-arrow-left"></i></a>
    </div>

    <div class="page-content header-clear-medium">
      <div class="card card-style">
        <div class="content">
          <form >
            <div class="input-style input-style-always-active has-borders no-icon mb-4">
              <label for="form5" class="color-orange-light">Pilih Provinsi</label>
              <select id="form5" disabled>
                <option value="">Nama</option>
              </select>
              <em></em>
            </div>

            <div class="input-style input-style-always-active has-borders no-icon mb-4" wire:self.ignore>
              <label for="regency" class="color-orange-light">Pilih Kota / Kabupaten</label>
              <select id="regency" wire:model="regency_id">
                <option value="" selected>Pilih Kota / Kabupaten</option>
                <option value="">Nama</option>
              </select>
              <span><i class="fa fa-chevron-down"></i></span>
              <em class="mt-n3 me-4">(required)</em>
            </div>

            <div class="input-style input-style-always-active has-borders no-icon mb-4">
              <label for="district" class="color-orange-light">Pilih Kecamatan</label>
              <select id="district" wire:model="district_id">
                <option value="" selected>Pilih Kecamatan</option>
                <option value="">Nama</option>
              </select>
              <span><i class="fa fa-chevron-down"></i></span>
              <em class="mt-n3 me-4">(required)</em>
            </div>

            <div class="input-style input-style-always-active has-borders no-icon mb-4">
              <label for="village" class="color-orange-light">Pilih Kelurahan</label>
              <select id="village" wire:model="address.village_id">
                <option value="" selected>Pilih Kelurahan</option>
                <option value="">Nama</option>
              </select>
              <span><i class="fa fa-chevron-down"></i></span>
              <em class="mt-n3 me-4">(required)</em>
            </div>

            <div class="input-style input-style-always-active has-borders no-icon mb-4">
              <textarea id="address" wire:model="address.address" placeholder="Tulis alamat anda"></textarea>
              <label for="address" class="color-orange-light">Alamat</label>
              <em class="mt-n3 me-4">(required)</em>
            </div>

            <div class="divider divider-margins mb-4"></div>

            <div class="input-style input-style-always-active has-borders no-icon validate-field mb-4">
              <input type="text" wire:model="address.phone_number" class="form-control validate-name" id="phone_number" placeholder="0878123xxxxx">
              <label for="phone_number" class="color-highlight">No. HP</label>
              <em class="mt-n3 me-4">(required)</em>
            </div>

            <div class="divider divider-margins mb-4"></div>

            <div class="responsive-iframe add-iframe">
              <iframe class="location-map" src='https://maps.google.com/maps?q=banjarbaru&t=&z=13&ie=UTF8&iwloc=&output=embed'></iframe>
            </div>

            <div class="divider divider-margins mb-4"></div>

            <div class="row mx-1">
              <button type="submit" class="btn btn-m btn-full rounded-s text-uppercase font-500 shadow-s bg-highlight">
                <div wire:loading.delay>
                  <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                </div>

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
  export default {
    mounted() {
      this.geoLocate();
    },
    methods: {
      back() {
        window.history.back();
      },
      geoLocate() {
        function success(position) {
          const latitude  = position.coords.latitude;
          const longitude = position.coords.longitude;
          var mapL1 = 'https://maps.google.com/maps?q=';
          var mapL2 = latitude+',';
          var mapL3 = longitude;
          var mapL4 = '&z=16&t=&output=embed'
          var mapLinkEmbed = mapL1 + mapL2 + mapL3 + mapL4;
          document.getElementsByClassName('location-map')[0].setAttribute('src',mapLinkEmbed);
          console.log(latitude+','+longitude);
        }
        function error() {
          // locationCoordinates.textContent = 'Unable to retrieve your location';
        }
        navigator.geolocation.getCurrentPosition(success, error);


      }
    }
  }
</script>