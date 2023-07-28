<div class="table-responsive">
    <table class="table table-striped table-bordered table-sm" style="width: 100%;">
        <thead>
        <tr>
            <th style="width: 5%">#</th>
            <th>Jenis Biaya</th>
            <th style="width: 5%" class="text-center">Jml</th>
            <th style="width: 10%;" class="text-center">Biaya</th>
            <th style="width: 10%;" class="text-center">Total</th>
            <th style="width: 15%;" class="text-center">Realisasi</th>
            <th style="width: 5%;" class="text-center">Ada Bukti?</th>
            <th style="width: 5%;" class="text-center">Selisih Diakui?</th>
            <th class="text-center">Keterangan</th>
        </tr>
        </thead>
        <tbody>
            @forelse($rab['rab_details']??[] as $details)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ ($details['nama_biaya']??'') }}</td>
                    <td>{{ $details['qty'] }}</td>
                    <td class="text-right">{{ number_format($details['biaya']) }}</td>
                    <td class="text-right">{{ number_format($details['biaya']*$details['qty']) }}</td>
                    <td>
                        <div wire:ignore>
                            <input type="text" class="form-control rupiah" name="details[{{ $details['id'] }}]"
                                   id="realisasi-{{ $details['id'] }}"
                                   value="{{ number_format($details['realisasi']??0) }}">
                        </div>
                    </td>
                    <td class="text-center">
                        <div >
                            <label class="kt-checkbox kt-checkbox--bold kt-checkbox--success">
                                <input type="checkbox" name="bukti[{{ $details['id'] }}]"
                                       data-realisasi="{{$details['realisasi']}}"
                                       data-id="{{$details['id']}}"
                                       data-biaya = "{{ $details['biaya']*$details['qty'] }}"
                                       data-persen="{{$details['cost']['cost_type']['penggunaan_tanpa_bukti']??0}}"
                                       class="checkBukti" value="ok" {{ $details['need_prove'] ? 'checked' : '' }}>
                                <span></span>
                            </label>
                        </div>
                    </td>
                    <td>
                        <div >
                            <label class="kt-checkbox kt-checkbox--bold kt-checkbox--primary">
                                <input type="checkbox" class="form-control" name="diakui[{{ $details['id'] }}]" value="ok" {{ $details['selisih_diakui'] ? 'checked' : '' }}>
                                <span></span>
                            </label>
                        </div>
                    </td>
                    <td>
                        <div>
                            <input type="text" class="form-control" name="ket_diakui[{{ $details['id'] }}]" value="{{ $details['ket_diakui']??'' }}">
                            <span></span>
                        </div>
                    </td>

                </tr>
            @empty
            @endforelse
        </tbody>
    </table>
</div>

@push('scripts')
    <script>
        $(".select2").on('change',function (e){
            @this.set('rab_id',$(this).val());

        });

        $(".checkBukti").change(function() {
            let id = $(this).data('id');
            let biaya = $(this).data('biaya');
            let persen = $(this).data('persen');

            let hitung =  Math.round(biaya*(persen/100));
            // console.log(biaya)
            // console.log(hitung)
            if(this.checked) {
                $("#realisasi-"+id).val(0);
            }else{
                $("#realisasi-"+id).val(hitung);

            }
        });

        Livewire.on('reinit', (data)=>{
            $nama = (data) ? data.surat_tugas_detail.nama : '';
            $("#ttd").val($nama);
            $(".rupiah").inputmask({
                alias : 'decimal',
                autoUnmask: true,
                groupSeparator: ",",
                radixPoint: ".",
                autoGroup: true,
            });

            $(".checkBukti").change(function() {
                let id = $(this).data('id');
                let biaya = $(this).data('biaya');
                let persen = $(this).data('persen');

                let hitung =  Math.round(biaya*(persen/100));
                // console.log(biaya)
                // console.log(hitung)
                if(this.checked) {
                    $("#realisasi-"+id).val(0);
                }else{
                    $("#realisasi-"+id).val(hitung);

                }
            });
        })
    </script>
@endpush
