<div class="row">
    <div class="col-lg-12 form-group">
        <div class="row mt-4">
            <div class="col-lg-2 col-md-3 col-sm-12 form-group">
                <select name="internal" id="internal" class="form-control" wire:model="internal">
                    <option value="1">Internal</option>
                    <option value="0">Eksternal</option>
                </select>
            </div>
            <div class="col-lg-8 col-md-6 col-sm-12 form-group" wire:ignore>
                <select name="pegawai" id="pegawai" class="form-control select2">
                    <option value="" selected>-- Pilih Pegawai --</option>
                    @foreach($pegawai as $peg)
                        <option value="{{ $peg->id }}">{{ $peg->nm_pegawai }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-lg-2 col-md-3 col-sm-12 form-group" >
                <select name="position_id" id="position_id" class="form-control" wire:model.defer="position_id">
                    <option value="" selected>-- Level Jabatan --</option>
                    @foreach($positions as $post)
                        <option value="{{ $post->id }}">{{ $post->nama }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="row">

            <div class="col-lg-2 col-md-4 col-sm-12 form-group">
                <input type="text" class="form-control"  placeholder="N.I.P" wire:model.defer="nip" @if($internal) disabled @endif>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-12 form-group">
                <input type="text" class="form-control" wire:model.defer="nama" placeholder="Nama" @if($internal) disabled @endif>
            </div>

            <div class="col-lg-4 col-md-4 col-sm-12 form-group">
                <input type="text" class="form-control" wire:model.defer="jabatan" placeholder="Jabatan" @if($internal) disabled @endif>
            </div>

            <div class="col-lg-2 col-md-8 col-sm-12 form-group">
                <input type="text" class="form-control" wire:model.defer="golongan" placeholder="Golongan" @if($internal) disabled @endif>
            </div>

            <div class="col-lg-1 col-md-4 col-sm-12 form-group">
                <button wire:click.prevent="addData" class="btn btn-elevate btn-icon-sm btn-success btn-block">
                    <i class="la la-plus p-0"></i></button>
            </div>
            <div class="col-lg-12">
                <div class="table-responsive">
                <table class="table table-striped table-bordered table-sm" style="width: 100% !important;">
                    <thead>
                    <tr>
                        <th style="width: 5%">#</th>
                        <th style="width: 5%">N.I.P</th>
                        <th>Nama</th>
                        <th>Jabatan</th>
                        <th>Golongan</th>
                        <th>Internal</th>
                        <th style="width: 5%">Delete</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($suratTugasDetail as $detail)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $detail->nip }}</td>
                            <td>{{ $detail->nama }}</td>
                            <td>{{ $detail->jabatan }}</td>
                            <td>{{ $detail->golongan  }}</td>
                            <td>{{ $detail->is_internal ?'Ya' : 'Tidak'  }}</td>
                            <td><a href='javascript:;' onclick='fn_deleteData({{ $detail->id }})'
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
    </div>
</div>

@push('scripts')
    <script>
        $("#pegawai").select2();
        $("#pegawai").on('change',function (){
            @this.getPegawai($(this).val());
        })

        $("#internal").on('change',function (){
            let internal = $(this).val();
            if(internal==='1'){
                $("#pegawai").attr('disabled',false)
            }else{
                $("#pegawai").val('').trigger('change');
                $("#pegawai").attr('disabled',true)
            }

        })

        function fn_deleteData(id)
        {
            swal.fire({
                title:"Yakin akan dihapus ?",
                text:"Data akan dihapus secara permanent !",
                type:"warning",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then(function(yes) {
                if(yes){
                    @this.delete(id);
                }

            });
        }
    </script>
@endpush
