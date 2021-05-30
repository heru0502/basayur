<div>
  <div class="header header-fixed header-logo-center">
    <a href="index.html" class="header-title">Alamat Pengiriman</a>
    <a href="/checkout" data-back-button class="header-icon header-icon-1"><i class="fas fa-arrow-left"></i></a>
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
            <i class="fa fa-check valid color-green-dark"></i>
            <em></em>
          </div>

          <div class="input-style input-style-always-active has-borders no-icon mb-4" wire:self.ignore>
            <label for="regency" class="color-orange-light">Pilih Kota / Kabupaten</label>
            <select id="regency" wire:model="address.regency_id">
              <option value="" selected>Pilih Kota / Kabupaten</option>
              @foreach($regencies as $regency)
                <option value="{{ $regency->id }}">{{ $regency->name }}</option>
              @endforeach
            </select>

            @if(($address['regency_id'] ?? null) != '')
              <i class="fa fa-check valid color-green-dark"></i>
            @else
              <span><i class="fa fa-chevron-down"></i></span>
            @endif

            @if($errors->has('address.regency_id') && empty($address['regency_id']))
              <i class="fa fa-times invalid color-red-dark"></i>
            @endif
            <em></em>
          </div>

          <div class="input-style input-style-always-active has-borders no-icon mb-4">
            <label for="district" class="color-orange-light">Pilih Kecamatan</label>
            <select id="district" wire:model="address.district_id">
              <option value="" selected>Pilih Kecamatan</option>
              @foreach($districts as $district)
                <option value="{{ $district->id }}">{{ $district->name }}</option>
              @endforeach
            </select>

            @if(($address['district_id'] ?? null) != '')
              <i class="fa fa-check valid color-green-dark"></i>
            @else
              <span><i class="fa fa-chevron-down"></i></span>
            @endif

            @if($errors->has('address.district_id') && empty($address['district_id']))
              <i class="fa fa-times invalid color-red-dark"></i>
            @endif
            <em></em>
          </div>

          <div class="input-style input-style-always-active has-borders no-icon mb-4">
            <label for="village" class="color-orange-light">Pilih Kelurahan</label>
            <select id="village" wire:model="address.village_id">
              <option value="" selected>Pilih Kelurahan</option>
              @foreach($villages as $village)
                <option value="{{ $village->id }}">{{ $village->name }}</option>
              @endforeach
            </select>

            @if(($address['village_id'] ?? null) != '')
              <i class="fa fa-check valid color-green-dark"></i>
            @else
              <span><i class="fa fa-chevron-down"></i></span>
            @endif

            @if($errors->has('address.village_id') && empty($address['village_id']))
              <i class="fa fa-times invalid color-red-dark"></i>
            @endif
            <em></em>
          </div>

          <div class="input-style input-style-always-active has-borders no-icon mb-4">
            <textarea id="address" wire:model="address.address" placeholder="Tulis alamat anda"></textarea>
            <label for="address" class="color-orange-light">Alamat</label>

            @if(($address['address'] ?? null) != '')
              <i class="fa fa-check valid color-green-dark"></i>
            @else
              <em class="mt-n3">(required)</em>
            @endif

            @if($errors->has('address.address') && empty($address['address']))
              <i class="fa fa-times invalid color-red-dark"></i>
            @endif
          </div>

          <div class="row mx-1">
            <button type="submit" class="btn btn-m btn-full rounded-s text-uppercase font-500 shadow-s bg-highlight">
              <div wire:loading>
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