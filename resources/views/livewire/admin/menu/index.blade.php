<div>
  <div class="row">
    <div class="col-12 col-md-12 col-lg-12">
      <div class="card">
        <div class="card-header">
          <h4>
            <a href="{{ route('menus.create') }}" class="btn btn-primary">Tambah</a>
            <button class="btn btn-danger" wire:click="remove"><i class="fa fa-trash"></i></button>
          </h4>

          <div class="card-header-form">
            <div class="input-group">
              <input type="text" class="form-control" wire:model="search" placeholder="Search">
              <div class="input-group-btn">
                <button class="btn btn-primary"><i class="fas fa-search"></i></button>
              </div>
            </div>
          </div>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-striped">
              <tr>
                <th></th>
                <th>Nama</th>
                <th>Kategori</th>
                <th>Harga (Rp)</th>
                <th>Active</th>
                <th>Stock</th>
                <th>Satuan</th>
                <th>Gambar</th>
              </tr>

              @foreach($menus as $i => $menu)
              <tr>
                <td class="p-0 text-center">
                  <div class="custom-checkbox custom-control">
                    <input type="checkbox" class="custom-control-input" id="checkbox-{{$i}}" wire:click="countChecked" wire:model="checks.{{ $menu->id }}">
                    <label for="checkbox-{{$i}}" class="custom-control-label">&nbsp;</label>
                  </div>
                </td>
                <td>
                  <a href="{{ route('menus.edit', $menu->id) }}">{{ $menu->name }}</a>
                </td>
                <td>{{ $menu->category->name }}</td>
                <td>
                  @if($menu->special_price)
                    {{ $menu->special_price }}
                    <del><small>{{ $menu->price }}</small></del>
                  @else
                    {{ $menu->price }}
                  @endif
                </td>
                <td>
                  @if($menu->is_active)
                    <badge class="badge badge-success"><i class="fa fa-check"></i> Active</badge>
                  @else
                    <badge class="badge badge-secondary">Inactive</badge>
                  @endif
                </td>
                <td>
                  @if($menu->in_stock)
                    <span class="text-green-400">In stock</span>
                  @else
                    {{ $menu->stock }}
                  @endif
                </td>
                <td>{{ '/ '. $menu->size_per_unit .' '. $menu->unit->name }}</td>
                <td><img width="100" src="{{ $menu->image }}"></td>
              </tr>
              @endforeach
            </table>
          </div>
        </div>

        <div class="card-footer text-right">
          <nav class="d-inline-block">
            {{ $menus->links() }}
          </nav>
        </div>
      </div>
    </div>
  </div>
</div>

@include('components.toast')

@push('javascript')
  <script>
    Livewire.on('sweet-alert', message => {
      swal({
        title: 'Anda yakin ingin menghapus data berikut?',
        text: message,
        icon: 'warning',
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
          window.livewire.emit('removeAll');
          swal('Data berhasil dihapus!', {
            icon: 'success',
          });
        } else {
          swal('Data batal dihapus!');
        }
      });
    });

    Livewire.on('no-selected', message => {
      swal('Pilih Dulu', 'Anda belum ada memilih data satupun!', 'info');
    });
  </script>
@endpush
