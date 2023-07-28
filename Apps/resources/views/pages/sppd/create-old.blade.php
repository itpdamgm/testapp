@extends('layouts.app')
@section('title','SPPD')
@section('content')
    <!-- begin:: Content Head -->
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">
                    Penugasan </h3>
                <span class="kt-subheader__separator kt-hidden"></span>
                <div class="kt-subheader__breadcrumbs">
                    <a href="javascript:;" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-right-arrow"></i></a>
                    {{--                    <span class="kt-subheader__breadcrumbs-separator"></span>--}}
                    <a href="{{ route('sppd.index') }}" class="kt-subheader__breadcrumbs-link">SPPD </a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Add Data</span>
                </div>
            </div>

        </div>
    </div>

    <!-- end:: Content Head -->
    @if($errors->any())
    <div class="alert alert-warning fade show" role="alert">
        <div class="alert-text">Oppss !!
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        <div class="alert-close">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="la la-close"></i></span>
            </button>
        </div>
    </div>
    @endif
    <!-- begin:: Content -->
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">

        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head kt-portlet__head--lg">
                <div class="kt-portlet__head-label">
                    <span class="kt-portlet__head-icon">
                        <i class="kt-font-brand fa fa-tasks"></i>
                    </span>
                    <h3 class="kt-portlet__head-title">
                        SURAT PERINTAH PERJALANAN DINAS
                    </h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                    <div class="kt-portlet__head-wrapper">
                        <div class="kt-portlet__head-actions">

                            <a href="{{ route('sppd.index') }}" class="btn btn-danger btn-elevate btn-icon-sm">
                                <i class="la la-times"></i>
                                Kembali
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @php $requestName  = request()->route()->getName(); @endphp
            <form action="{{ ($requestName=='sppd.create' ? route('sppd.store') : route('sppd.update',$sppd->id)) }}" novalidate="novalidate" method="post">
                @csrf
                @method(($requestName=='sppd.create' ?'POST' : 'PUT'))
            <div class="kt-portlet__body">
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-sm-12 form-group">
                        <label class="form-control-label">Nomor Surat Tugas : </label>
                        <select name="surat_tugas_id" id="surat_tugas_id" class="form-control select2 @error('surat_tugas_id') is-invalid @enderror" required>
                            <option value="">-- Pilih Surat Tugas --</option>
                            @forelse($suratTugas as $st)
                                <option value="{{ $st->id }}" {{ old('surat_tugas_id',$sppd->surat_tugas_id??'')==$st->id ?' selected' : '' }}>
                                    {{ $st->nomor }}
                                </option>
                            @empty
                            @endforelse
                        </select>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 form-group">
                        <label class="form-control-label">Nomor SPPD : </label>
                        <input type="text" name="nomor" class="form-control @error('nomor') is-invalid @enderror" placeholder=""
                               value="{{ old('nomor',$sppd->nomor??'') }}" required>
                    </div>
                    <div class="col-lg-2 col-md-6 col-sm-12 form-group">
                        <label class="form-control-label">Tgl Berangkat  : </label>
                        <input type="text" name="tgl_berangkat" class="form-control datepick @error('tgl_berangkat') is-invalid @enderror" placeholder=""
                               value="{{ old('tgl_berangkat',($sppd->tgl_berangkat??now())->format('d-m-Y')) }}" required readonly="">
                    </div>
                    <div class="col-lg-2 col-md-6 col-sm-12 form-group">
                        <label class="form-control-label">Tgl Kembali  : </label>
                        <input type="text" name="tgl_kembali" class="form-control datepick @error('tgl_kembali') is-invalid @enderror" placeholder=""
                               value="{{ old('tgl_kembali',($sppd->tgl_kembali??now())->format('d-m-Y')) }}" required readonly="">
                    </div>
                    <div class="col-lg-2 col-md-6 col-sm-12 form-group">
                        <label class="form-control-label">Lama Hari : </label>
                        <input type="number" name="lama_hari" class="form-control @error('lama_hari') is-invalid @enderror" placeholder=""
                               value="{{ old('lama_hari',$sppd->lama_hari??'1') }}" required min="1" >
                    </div>
                    <div class="col-lg-12 col-md-12 form-group">
                        <label class="form-control-label">Maksud Perjalanan Dinas : </label>
                        <textarea name="maksud" id="maksud" cols="30" rows="5"
                                  class="form-control @error('maksud') is-invalid @enderror" required>{{ old('maksud',$sppd->maksud??'') }}</textarea>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 form-group">
                        <label class="form-control-label">Tempat Berangkat : </label>
                        <input type="text" name="tempat_berangkat" class="form-control @error('tempat_berangkat') is-invalid @enderror" placeholder=""
                               value="{{ old('tempat_berangkat',$sppd->tempat_berangkat??'Mataram') }}" required>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 form-group">
                        <label class="form-control-label">Tempat Tujuan : </label>
                        <input type="text" name="tempat_tujuan" class="form-control @error('tempat_tujuan') is-invalid @enderror" placeholder=""
                               value="{{ old('tempat_tujuan',$sppd->tempat_tujuan??'') }}" required>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 form-group">
                        <label class="form-control-label">Instansi (Beban Anggaran) : </label>
                        <input type="text" name="beban_instansi" class="form-control @error('beban_instansi') is-invalid @enderror" placeholder=""
                               value="{{ old('beban_instansi',$sppd->beban_instansi??'PT Air Minum Giri Menang (Perseroda)') }}" required>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 form-group">
                        <label class="form-control-label">Kode Perkiraan : </label>
                        <input type="text" name="beban_kode_akun" class="form-control @error('beban_kode_akun') is-invalid @enderror" placeholder=""
                               value="{{ old('beban_kode_akun',$sppd->beban_kode_akun??'') }}" required>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-12 form-group">
                        <label class="form-control-label">Alat Transportasi : </label>
                        <select name="alat_angkutan" id="alat_angkutan" class="form-control @error('alat_angkutan') is-invalid @enderror" required>
                            <option value="">-- Pilih Alat Angkutan --</option>
                            @forelse(config('constants.alat_angkutan') as $alat)
                                <option value="{{ $alat }}" {{ old('alat_angkutan',$sppd->alat_angkutan??'')==$alat ?'selected' : '' }}>
                                    {{ $alat }}
                                </option>
                            @empty
                            @endforelse
                        </select>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-12 form-group">
                        <label class="form-control-label">Pemberi Tugas: </label>
                        <select name="pemberi_tugas" id="pemberi_tugas" class="form-control @error('pemberi_tugas') is-invalid @enderror" required>
                            <option value="">-- Pilih Pejabat --</option>
                            @forelse($signatures as $signature)
                                <option value="{{ $signature->nama }}" {{ old('pemberi_tugas',$sppd->pemberi_tugas??'')==$signature->nama ?' selected' : '' }}>
                                    {{ $signature->nama }}
                                </option>
                            @empty
                            @endforelse
                        </select>
                    </div>
                    <div class="col-lg-6 col-md-4 col-sm-12 form-group">
                        <label class="form-control-label">Keterangan Lain : </label>
                        <input type="text" name="keterangan_lain" class="form-control @error('keterangan_lain') is-invalid @enderror" placeholder=""
                               value="{{ old('keterangan_lain',$sppd->keterangan_lain??'') }}" required>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                        <label class="form-control-label">Catatan : </label>
                        <input type="text" name="catatan" class="form-control @error('catatan') is-invalid @enderror" placeholder=""
                               value="{{ old('catatan',$sppd->catatan??'') }}" required>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                        <label class="form-control-label">Perhatian : </label>
                        <input type="text" name="perhatian" class="form-control @error('perhatian') is-invalid @enderror" placeholder=""
                               value="{{ old('perhatian',$sppd->perhatian??'') }}" required>
                    </div>

                    @livewire('pengikut',[
                             "arrPengikut" => old('pengikut',$sppd->pengikut??[])
                        ])

                    @livewire('rute-sppd',["arrRute" => old('rute',$sppd->sppd_details??[])] )
                </div>




            </div>
            <div class="kt-portlet__foot">
                <div class="kt-form__actions">
                    <div class="row">
                        <div class="col-lg-12 ml-lg-auto">
                            <button type="submit" class="btn btn-brand">Simpan Data</button>
                        </div>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>

    <!-- end:: Content -->
@endsection
@push('css')
    @livewireStyles
@endpush
@push('scripts')
    @include('includes.swal-delete')
    <script>
        $(".datepick").datepicker({
            format: "dd-mm-yyyy",
            language: "id",
            autoclose: true,
            todayHighlight: true,
            orientation:'bottom'
        })


        let select2El = $(".select2").select2();
        select2El.on('change',function (e){
            console.log(e.target.value);
        })

    </script>
@endpush
