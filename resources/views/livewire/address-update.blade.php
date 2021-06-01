<div>
  <div class="header header-fixed header-logo-center">
    <a href="index.html" class="header-title">Alamat Pengiriman</a>
    <a href="#" data-back-button class="header-icon header-icon-1"><i class="fas fa-arrow-left"></i></a>
  </div>

  <div class="page-content header-clear-medium">
    <div class="card card-style">
      <div class="content">
        <form wire:submit.prevent="save">
          <div class="input-style input-style-always-active has-borders no-icon mb-4">
            <label for="form5" class="color-orange-light">Pilih Provinsi</label>
            <select id="form5" disabled>
              @foreach($provinces as $province)
                <option value="{{ $province->id }}">{{ $province->name }}</option>
              @endforeach
            </select>
            <em></em>
          </div>

          <div class="input-style input-style-always-active has-borders no-icon mb-4" wire:self.ignore>
            <label for="regency" class="color-orange-light">Pilih Kota / Kabupaten</label>
            <select id="regency" wire:model="regency_id">
              <option value="" selected>Pilih Kota / Kabupaten</option>
              @foreach($regencies as $regency)
                <option value="{{ $regency->id }}">{{ $regency->name }}</option>
              @endforeach
            </select>
            <span><i class="fa fa-chevron-down"></i></span>
            <em class="mt-n3 me-4">(required)</em>

            @if($errors->has('regency_id') && empty($regency_id))
              <i class="fa fa-times invalid color-red-dark"></i>
            @endif

            <em class="mt-n3 me-4">(required)</em>
          </div>

          <div class="input-style input-style-always-active has-borders no-icon mb-4">
            <label for="district" class="color-orange-light">Pilih Kecamatan</label>
            <select id="district" wire:model="district_id">
              <option value="" selected>Pilih Kecamatan</option>
              @foreach($districts as $district)
                <option value="{{ $district->id }}">{{ $district->name }}</option>
              @endforeach
            </select>
            <span><i class="fa fa-chevron-down"></i></span>
            <em class="mt-n3 me-4">(required)</em>

            @if($errors->has('district_id') && empty($district_id))
              <i class="fa fa-times invalid color-red-dark"></i>
            @endif

            <em class="mt-n3 me-4">(required)</em>
          </div>

          <div class="input-style input-style-always-active has-borders no-icon mb-4">
            <label for="village" class="color-orange-light">Pilih Kelurahan</label>
            <select id="village" wire:model="address.village_id">
              <option value="" selected>Pilih Kelurahan</option>
              @foreach($villages as $village)
                <option value="{{ $village->id }}">{{ $village->name }}</option>
              @endforeach
            </select>
            <span><i class="fa fa-chevron-down"></i></span>
            <em class="mt-n3 me-4">(required)</em>

            @if($errors->has('address.village_id') && empty($address['village_id']))
              <i class="fa fa-times invalid color-red-dark"></i>
            @endif
          </div>

          <div class="input-style input-style-always-active has-borders no-icon mb-4">
            <textarea id="address" wire:model="address.address" placeholder="Tulis alamat anda"></textarea>
            <label for="address" class="color-orange-light">Alamat</label>
            <em class="mt-n3 me-4">(required)</em>

            @if($errors->has('address.address') && empty($address['address']))
              <i class="fa fa-times invalid color-red-dark"></i>
            @endif
          </div>

          <div class="divider divider-margins mb-4"></div>

          <div class="input-style input-style-always-active has-borders no-icon validate-field mb-4">
            <input type="text" wire:model="address.phone_number" class="form-control validate-name" id="phone_number" placeholder="0878123xxxxx">
            <label for="phone_number" class="color-highlight">No. HP</label>
            <em class="mt-n3 me-4">(required)</em>

            @if($errors->has('address.phone_number'))
              <i class="fa fa-times invalid color-red-dark"></i>
            @endif
          </div>

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