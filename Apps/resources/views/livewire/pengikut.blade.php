<div class="col-lg-12 form-group shadow p-3">
    <label class="kt-checkbox kt-checkbox--bold kt-checkbox--brand kt-font-bolder">
        <input type="checkbox" wire:model="ada_pengikut" name="ada_pengikut"> ADA PENGIKUT
        <span></span>
    </label>
    <div class="row mt-4">
        <div class="col-lg-4 col-md-8 col-sm-12 form-group">
            <input type="text" class="form-control" wire:model.defer="nama" @if(!$ada_pengikut) disabled @endif placeholder="nama">
        </div>
        <div class="col-lg-2 col-md-4 col-sm-12 form-group" wire:model.defer="umur">
            <input type="number" class="form-control" @if(!$ada_pengikut) disabled @endif id="umur" value="0" placeholder="umur">
        </div>
        <div class="col-lg-4 col-md-8 col-sm-12 form-group">
            <input type="text" class="form-control" wire:model.defer="keterangan" @if(!$ada_pengikut) disabled @endif placeholder="hubungan keluarga/keterangan">
        </div>
        <div class="col-lg-2 col-md-4 col-sm-12 form-group">
            <button wire:click.prevent="add" class="btn btn-elevate btn-icon-sm btn-success btn-block" @if(!$ada_pengikut) disabled @endif>
                <i class="la la-plus"></i>Add</button>
        </div>
        <div class="col-lg-12">
            <div class="table-responsive">
            <table class="table table-striped table-bordered table-sm">
                <thead>
                <tr>
                    <th style="width: 5%">#</th>
                    <th>Nama Pengikut</th>
                    <th style="width: 15%;">Umur</th>
                    <th >Hubungan Keluarga/Keterangan</th>
                    <th style="width: 5%">Delete</th>
                </tr>
                </thead>
                <tbody>
                @forelse($arrPengikut as $detail)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $detail['nama'] }}</td>
                        <td>{{ $detail['umur'] }}</td>
                        <td>{{ $detail['keterangan'] }}</td>
                        <td><a href='javascript:;' wire:click.prevent="delete({{$loop->index}})"
                               class='btn btn-sm btn-clean btn-icon btn-icon-md' title='Hapus Data'>
                                <i class='flaticon2-rubbish-bin'></i></a>
                        </td>
                    </tr>
                @empty
                @endforelse
                </tbody>
            </table>
            </div>
        </div>
    </div>

    <input type="hidden" wire:model="pengikut" class="form-control" name="pengikut">
</div>
