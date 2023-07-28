<div class="col-sm-12">
    <div class="row mt-4">
        <div class="col-lg-3 col-md-6 col-sm-12 mb-2" wire:ignore>
            <label class="form-control-label">Jenis Biaya : </label>
            <select name="cost_id" id="cost_id" class="form-control @error('cost_id') is-invalid @enderror" required>
                <option value="">-- Pilih Biaya --</option>
                @forelse($select2Data as $item)
                    <option value="{{ $item['id'] }}">{{ $item["text"] }}</option>
                @empty
                @endforelse
            </select>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-12 mb-2">
            <label class="form-control-label">Keterangan Biaya : </label>
            <input type="text" class="form-control"  value="" wire:model.defer="nama">
        </div>
        <div class="col-lg-2 col-md-4 col-sm-12 mb-2">
            <label class="form-control-label">Satuan : </label>
            <input type="text" class="form-control"  value="" wire:model.defer="satuan">
        </div>
        <div class="col-lg-1 col-md-4 col-sm-12 mb-2" >
            <label class="form-control-label">Qty : </label>
            <input type="number" class="form-control" value="0" wire:model.defer="qty">
        </div>
        <div class="col-lg-2 col-md-4 col-sm-12 mb-2" wire:ignore>
            <label class="form-control-label">Biaya : </label>
            <input type="text" class="form-control rupiah"  id="biaya" value="0">
        </div>

        <div class="col-lg-2 col-md-3 col-sm-12 form-group">
            <button wire:click.prevent="addDetail" class="btn btn-elevate btn-icon-sm btn-success btn-block">
                <i class="la la-plus"></i>Add Detail</button>
        </div>
        <div class="col-lg-12">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-sm" style="width: 100%;">
                    <thead>
                    <tr>
                        <th style="width: 5%">#</th>
                        <th>Jenis Biaya</th>
                        <th>Satuan</th>
                        <th>Jml</th>
                        <th style="width: 15%;">Biaya</th>
                        <th style="width: 15%;">Subtotal</th>
                        <th style="width: 5%">Delete</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($rabDetails as $detail)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $detail['nama'] }}</td>
                            <td>{{ $detail['satuan'] }}</td>
                            <td>{{ $detail['qty'] }}</td>
                            <td>{{ number_format($detail['biaya']) }}</td>
                            <td>{{ number_format($detail['sub_total']) }}</td>
                            <td><a href='javascript:;' wire:click.prevent="deleteDetail({{$loop->index}})"
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

    <div class="row">
        <div class="offset-8 col-lg-4  form-group">
            <label class="form-control-label">TOTAL BIAYA : </label>
            <input type="text" name="total_rab" class="form-control @error('total_rab') is-invalid @enderror" placeholder=""
                   value="{{ old('total_rab',number_format($rab->total_rab??0)) }}" required readonly wire:model="total_biaya">
        </div>
    </div>
    <input type="hidden" wire:model="rab_details" class="form-control" name="rab_details">
</div>

@push('scripts')
    <script>
        $("#biaya").on('blur',function (){
            @this.set('biaya',$(this).val());
        });

        $("#type_id").on('change',function (e){
            @this.set('type_id',$(this).val());
        });

        $("#position_id").on('change',function (e){
            @this.set('position_id',$(this).val());
        });

        $("#cost_id").on('change',function (e){
            @this.set('cost_id',$(this).val());
        });

        Livewire.on('reinit',(e)=>{
            $("#cost_id").select2().empty();
            $("#cost_id").select2({
                data : @this.select2Data
            })

        })

        Livewire.on('selectedCost',(data)=>{
            $("#biaya").val(data[1]);
        })

        Livewire.on('refreshElement',(e)=>{
            $("#cost_id").val('').trigger('change');
            $("#biaya").val(0);
        })
    </script>
@endpush
