<div class="col-lg-12 form-group shadow p-3">
    <label class="kt-checkbox kt-checkbox--bold kt-checkbox--brand">
        <input type="checkbox" wire:model="ada_rincian" name="ada_rincian"> Rincian Biaya
        <span></span>
    </label>
    <div class="row mt-4">
        <div class="col-lg-8 col-md-5 col-sm-12 form-group">
            <input type="text" class="form-control" wire:model.defer="nama" @if(!$ada_rincian) disabled @endif>
        </div>
        <div class="col-lg-2 col-md-4 col-sm-12 form-group" wire:ignore>
            <input type="text" class="form-control rupiah" @if(!$ada_rincian) readonly @endif id="biaya" value="0">
        </div>
        <div class="col-lg-2 col-md-3 col-sm-12 form-group">
            <button wire:click.prevent="addDetail" class="btn btn-elevate btn-icon-sm btn-success btn-block" @if(!$ada_rincian) disabled @endif>
                <i class="la la-plus"></i>Add Detail</button>
        </div>
        <div class="col-lg-12">
            <table class="table table-striped table-bordered table-sm">
                <thead>
                    <tr>
                        <th style="width: 5%">#</th>
                        <th>Nama Rincian</th>
                        <th style="width: 15%;">Biaya</th>
                        <th style="width: 5%">Delete</th>
                    </tr>
                </thead>
                <tbody>
                @forelse($costDetails as $detail)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $detail['nama'] }}</td>
                        <td>{{ number_format($detail['biaya']) }}</td>
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

    <input type="hidden" wire:model="cost_details" class="form-control" name="cost_details">
</div>

@push('scripts')
    <script>
        $("#biaya").on('blur',function (){
            @this.set('biaya',$(this).val());
        });
    </script>
@endpush
