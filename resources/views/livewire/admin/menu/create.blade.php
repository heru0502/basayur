<div>
  <div>
    <div class="row">
      <div class="col-12 col-md-12 col-lg-12">
        <div class="card">

          <form method="POST" wire:submit.prevent="save">
            @csrf

            <div class="card-body">
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group row">
                    <label for="name" class="col-sm-3 col-form-label">Nama</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control @error('menu.name') is-invalid @enderror" id="name" name="name" wire:model="menu.name">
                      @error('menu.name')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                      @enderror
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="description" class="col-sm-3 col-form-label">Deskripsi</label>
                    <div class="col-sm-9">
                      <textarea class="form-control" id="description" wire:model="menu.description"></textarea>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="menu_category_id" class="col-sm-3 col-form-label">Kategori Menu</label>
                    <div class="col-sm-9">
                      <select class="form-control @error('menu.menu_category_id') is-invalid @enderror" id="menu_category_id" name="menu_category_id" wire:model="menu.menu_category_id">
                        <option>-</option>
                        @foreach($categories as $category)
                          <option value="{{ $category->id }}">{{ strtoupper($category->name) }}</option>
                        @endforeach
                      </select>

                      @error('menu.menu_category_id')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                      @enderror
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-3 col-form-label">Harga Asli</label>
                    <div class="col-sm-9">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text">Rp</span>
                        </div>
                        <input type="text" class="form-control @error('menu.original_price') is-invalid @enderror" wire:model="menu.original_price">

                        @error('menu.original_price')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                        @enderror
                      </div>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-3 col-form-label">Harga Jual</label>
                    <div class="col-sm-9">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text">Rp</span>
                        </div>
                        <input type="text" class="form-control @error('menu.selling_price') is-invalid @enderror" wire:model="menu.selling_price">

                        @error('menu.selling_price')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                        @enderror
                      </div>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-3 col-form-label">Active</label>
                    <div class="col-sm-9">
                      <label class="custom-switch pl-0">
                        <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input" wire:model="menu.is_active">
                        <span class="custom-switch-indicator"></span>
                      </label>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-3 col-form-label">Stock</label>
                    <div class="col-sm-9">
                      <div class="row col-12">
                        <label class="custom-switch pl-0">
                          <input type="checkbox" name="in_stock" class="custom-switch-input" wire:click="inStock" wire:model="menu.in_stock">
                          <span class="custom-switch-indicator"></span>
                          <span class="custom-switch-description">In stock</span>
                        </label>
                      </div>

                      <div class="row col-sm-12 mt-3">
                        <div class="input-group">
                          <input type="text" class="form-control @error('menu.stock') is-invalid @enderror" wire:model="menu.stock" {{ $in_stock ? 'disabled' : '' }}>
                          @error('menu.stock')
                          <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                          @enderror
                          <div class="input-group-prepend">
                            <span class="input-group-text">Qty</span>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-sm-6">
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-3 col-form-label">Ukuran per Satuan</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control @error('menu.size_per_unit') is-invalid @enderror" id="inputEmail3" wire:model="menu.size_per_unit">

                      @error('menu.size_per_unit')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                      @enderror
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-3 col-form-label">Satuan</label>
                    <div class="col-sm-9">
                      @foreach($units as $i => $unit)
                        <div class="custom-control custom-radio ">
                          <input type="radio" id="{{ 'unit-'.$unit->id }}" name="unit_id" class="custom-control-input @error('menu.unit_id') is-invalid @enderror" wire:model="menu.unit_id" value="{{ $unit->id }}">
                          <label class="custom-control-label" for="{{ 'unit-'.$unit->id }}">{{ $unit->name }}</label>

                          @if($i === (count($units) -1))
                            @error('menu.unit_id')
                            <div class="invalid-feedback">
                              {{ $message }}
                            </div>
                            @enderror
                          @endif
                        </div>
                      @endforeach
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-3 col-form-label">Gambar</label>
                    <div class="col-sm-9">
                      <input type="file" class="@error('image') is-invalid @enderror" wire:model="image">

                      <div wire:loading wire:target="image">
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                      </div>

                      @if ($image)
                        <p>Photo Preview:</p>
                        <img src="{{ $image->temporaryUrl() }}">
                      @endif

                      @if ($menu['image'] && !$image)
                        <img src="{{ asset($menu['image']) }}">
                      @endif

                      @error('image') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="card-footer">
              <button type="submit" class="btn btn-primary offset-sm-6">
                <div wire:loading.delay>
                  <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                </div>
                Simpan
              </button>
              <a href="{{ route('admin.menus.index') }}" class="btn btn-secondary">Batal</a>
            </div>
          </form>

        </div>
      </div>
    </div>
  </div>
</div>
