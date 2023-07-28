<div class="col-lg-12 form-group shadow p-3">
    <label class="kt-font-bolder @error('rute') kt-font-danger @enderror"> RUTE SPPD</label>
    <div class="row mt-4">
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="row">
                <div class="col-lg-12 form-group">
                    <label class="form-control-label">Tiba Di : </label>
                    <input type="text" name="tiba_di" class="form-control " value="" wire:model.defer="tiba_di">
                </div>
                <div class="col-lg-12 form-group" wire:ignore>
                    <label class="form-control-label">Tanggal Tiba : </label>
                    <input type="text" name="tgl_tiba" class="form-control" id="tgl_tiba" value="" readonly>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="row">
                <div class="col-lg-12 form-group">
                    <label class="form-control-label">Berangkat Dari : </label>
                    <input type="text" name="berangkat_dari" class="form-control " value="" wire:model.defer="berangkat_dari">
                </div>
                <div class="col-lg-8 col-md-6 col-sm-12 form-group">
                    <label class="form-control-label">Tujuan : </label>
                    <input type="text" name="tujuan" class="form-control " value="" wire:model.defer="tujuan">
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 form-group" wire:ignore>
                    <label class="form-control-label">Tanggal Berangkat : </label>
                    <input type="text" name="tgl_jalan" class="form-control" id="tgl_jalan" value="" readonly>
                </div>
            </div>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 form-group">
            <button wire:click.prevent="add" class="btn btn-elevate btn-icon-sm btn-success">
                <i class="la la-plus"></i>Add Rute</button>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-sm">
                    <thead>
                    <tr>
                        <th style="width: 5%">#</th>
                        <th>Tiba</th>
                        <th>Berangkat</th>
                        <th style="width: 5%">Delete</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($arrRute as $detail)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <span class="kt-font-bold">Tiba di :</span> {{ $detail['tiba_di'] }}<br>
                                <span class="kt-font-bold">Pada Tanggal :</span> {{ $detail['tgl_tiba'] }}
                            </td>
                            <td>
                                <span class="kt-font-bold">Berangkat Dari :</span> {{ $detail['berangkat_dari'] }}<br>
                                <span class="kt-font-bold">Ke :</span> {{ $detail['tujuan'] }}<br>
                                <span class="kt-font-bold">Pada Tanggal :</span> {{ $detail['tgl_berangkat'] }}
                            </td>
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

    <input type="hidden" wire:model="rute" class="form-control" name="rute" required>
</div>

@push('scripts')
    <script>
        let tglTiba = $("#tgl_tiba").datepicker({
            format: "dd-mm-yyyy",
            language: "id",
            autoclose: true,
            todayHighlight: true
        })

        let tglJalan = $("#tgl_jalan").datepicker({
            format: "dd-mm-yyyy",
            language: "id",
            autoclose: true,
            todayHighlight: true
        })

        tglTiba.on('change',function (e){
            @this.set('tgl_tiba',$(this).val());
        })

        tglJalan.on('change',function (e){
            @this.set('tgl_berangkat',$(this).val());
        })

    </script>
@endpush
