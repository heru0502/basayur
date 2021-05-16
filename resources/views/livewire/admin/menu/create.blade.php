<div>
  <div>
    <div class="row">
      <div class="col-12 col-md-12 col-lg-12">
        <div class="card">

          <form action="" method="POST" >
            @csrf

            <div class="card-body">
              <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Nama</label>
                <div class="col-sm-4">
                  <input type="text" class="form-control" id="inputEmail3">
                </div>
              </div>

              <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Deskripsi</label>
                <div class="col-sm-4">
                  <textarea class="form-control"></textarea>
                </div>
              </div>

              <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Kategori Menu</label>
                <div class="col-sm-4">
                  <select class="form-control">
                    <option>-</option>
                    @foreach($categories as $category)
                      <option>{{ strtoupper($category->name) }}</option>
                    @endforeach
                  </select>
                </div>
              </div>

              <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Harga</label>
                <div class="col-sm-4">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">Rp</span>
                    </div>
                    <input type="text" class="form-control">
                  </div>
                </div>
              </div>

              <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Harga Spesial</label>
                <div class="col-sm-4">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">Rp</span>
                    </div>
                    <input type="text" class="form-control">
                  </div>
                </div>
              </div>

              <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Active</label>
                <div class="col-sm-4">
                  <label class="custom-switch">
                    <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input">
                    <span class="custom-switch-indicator"></span>
                    <span class="custom-switch-description">I agree with terms and conditions</span>
                  </label>
                </div>
              </div>

              <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">In Stock</label>
                <div class="col-sm-4">
                  <div class="row col-12">
                    <label class="custom-switch">
                      <input type="checkbox" name="in_stocksss" class="custom-switch-input" wire:click="inStock" wire:model="in_stock">
                      <span class="custom-switch-indicator"></span>
                      <span class="custom-switch-description">Jika diaktifkan, maka stok akan selalu tersedia</span>
                    </label>
                  </div>

                  <div class="row col-6 mt-3">
                    <div class="input-group">
                      <input type="text" class="form-control" {{ $in_stock ? 'disabled' : '' }}>
                      <div class="input-group-prepend">
                        <span class="input-group-text">Qty</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Ukuran per Satuan</label>
                <div class="col-sm-2">
                  <input type="text" class="form-control" id="inputEmail3">
                </div>
              </div>

              <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Satuan</label>
                <div class="col-sm-10">
                  @foreach($units as $unit)
                    <div class="custom-control custom-radio custom-control-inline">
                      <input type="radio" id="{{ 'unit-'.$unit->id }}" name="unit_id" class="custom-control-input">
                      <label class="custom-control-label" for="{{ 'unit-'.$unit->id }}">{{ $unit->name }}</label>
                    </div>
                  @endforeach
                </div>
              </div>
            </div>

            <div class="card-footer">
              <button type="button" class="btn btn-primary offset-2">Simpan</button>
            </div>
          </form>

        </div>
      </div>
    </div>
  </div>
</div>
