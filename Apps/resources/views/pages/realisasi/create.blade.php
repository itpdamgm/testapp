@extends('layouts.app')
@section('title','Realisasi RAB')
@section('content')
    <!-- begin:: Content Head -->
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">
                    Biaya Perjalanan </h3>
                <span class="kt-subheader__separator kt-hidden"></span>
                <div class="kt-subheader__breadcrumbs">
                    <a href="javascript:;" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-right-arrow"></i></a>
                    {{--                    <span class="kt-subheader__breadcrumbs-separator"></span>--}}
                    <a href="{{ route('realisasi.index') }}" class="kt-subheader__breadcrumbs-link">Realisasi RAB </a>
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
                        <i class="kt-font-brand fa fa-money-bill-wave"></i>
                    </span>
                    <h3 class="kt-portlet__head-title">
                        REALISASI ANGGARAN BIAYA
                    </h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                    <div class="kt-portlet__head-wrapper">
                        <div class="kt-portlet__head-actions">

                            <a href="{{ route('realisasi.index') }}" class="btn btn-danger btn-elevate btn-icon-sm">
                                <i class="la la-times"></i>
                                Kembali
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @php $requestName  = request()->route()->getName(); @endphp
            <form action="{{ ($requestName=='realisasi.create' ? route('realisasi.store') : route('realisasi.update',$realisasi->id)) }}" novalidate="novalidate" method="post">
                @csrf
                @method(($requestName=='realisasi.create' ?'POST' : 'PUT'))
            <div class="kt-portlet__body">
                <div class="row">
                    <div class="col-sm-12 form-group">
                        <label class="form-control-label">No RAB : </label>
                        <select name="rab_id" id="rab_id" class="form-control select2 @error('rab_id') is-invalid @enderror" required>
                            <option value="">-- Pilih RAB --</option>
                            @forelse($rabs as $rab)
                                <option value="{{ $rab->id }}" {{ old('rab_id',$realisasi->rab_id??'')==$rab->id ?' selected' : '' }}>
                                    [{{ $rab->nomor }}] - {{ $rab->surat_tugas_detail->nip }} {{ $rab->surat_tugas_detail->nama }}
                                </option>
                            @empty
                            @endforelse
                        </select>
                    </div>
                    <div class="col-sm-12 form-group">

                        @livewire('realisasi-rab',["rab_id"=>old('rab_id',$realisasi->rab_id??null)])
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-4 col-sm-12 form-group">
                        <label class="form-control-label">Maskapai : </label>
                        <input type="text" class="form-control @error('maskapai') is-invalid @enderror" name="maskapai" id="maskapai" required
                               value="{{ old('maskapai',$realisasi->maskapai??'') }}">
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-12 form-group">
                        <label class="form-control-label">No Boarding Pass : </label>
                        <input type="text" class="form-control @error('no_boarding_pass') is-invalid @enderror" name="no_boarding_pass" id="no_boarding_pass" required
                               value="{{ old('no_boarding_pass',$realisasi->no_boarding_pass??'') }}">
                    </div>


                    <div class="col-lg-3 col-md-4 col-sm-12 form-group">
                        <label class="form-control-label">No Tiket : </label>
                        <input type="text" class="form-control @error('no_tiket') is-invalid @enderror" name="no_tiket" id="no_tiket" required
                               value="{{ old('no_tiket',$realisasi->no_tiket??'') }}">
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-12 form-group">
                        <label class="form-control-label">Nama Penginapan : </label>
                        <input type="text" class="form-control @error('nama_hotel') is-invalid @enderror" name="nama_hotel" id="nama_hotel" required
                               value="{{ old('nama_hotel',$realisasi->nama_hotel??'') }}">

                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-12 form-group">
                        <label class="form-control-label">Boarding Pass (pdf) : </label>
                        @livewire('upload-file',[
                            "type"=>"document",
                            "name"=>"boarding_pass",
                            "uploaded"=>old('boarding_pass',$realisasi->boarding_pass??null) == null ? false : true,
                            "filename" =>old('boarding_pass',$realisasi->boarding_pass??null),
                            "folder"=>  isset($realisasi->id) ? "realisasi":"tmp",
                            "key"=>  $realisasi->id??null,
                            "required"=>false
                        ])

                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-12 form-group">
                        <label class="form-control-label">Tiket (pdf) : </label>
                        @livewire('upload-file',[
                            "type"=>"document",
                            "name"=>"tiket",
                            "uploaded"=>old('tiket',$realisasi->tiket??null) == null ? false : true,
                            "filename" =>old('tiket',$realisasi->tiket??null),
                            "folder"=>  isset($realisasi->id) ? "realisasi":"tmp",
                            "key"=>  $realisasi->id??null,
                            "required"=>false
                        ])
                    </div>

                    <div class="col-lg-3 col-md-4 col-sm-12 form-group">
                        <label class="form-control-label">Invoice Hotel (pdf) : </label>
                        @livewire('upload-file',[
                            "type"=>"document",
                            "name"=>"invoice",
                            "uploaded"=>old('invoice',$realisasi->invoice??null) == null ? false : true,
                            "filename" =>old('invoice',$realisasi->invoice??null),
                            "folder"=>  isset($realisasi->id) ? "realisasi":"tmp",
                            "key"=>  $realisasi->id??null,
                            "required"=>false
                        ])
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-12 form-group">
                        <label class="form-control-label">Swab (pdf) : </label>
                        @livewire('upload-file',[
                            "type"=>"document",
                            "name"=>"swab",
                            "uploaded"=>old('swab',$realisasi->swab??null) == null ? false : true,
                            "filename" =>old('swab',$realisasi->swab??null),
                            "folder"=>  isset($realisasi->id) ? "realisasi":"tmp",
                            "key"=>  $realisasi->id??null,
                            "required"=>false
                        ])
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-12 form-group">
                        <label class="form-control-label">Sewa Kendaraan (pdf) : </label>
                        @livewire('upload-file',[
                            "type"=>"document",
                            "name"=>"sewa_kendaraan",
                            "uploaded"=>old('sewa_kendaraan',$realisasi->sewa_kendaraan??null) == null ? false : true,
                            "filename" =>old('sewa_kendaraan',$realisasi->sewa_kendaraan??null),
                            "folder"=>  isset($realisasi->id) ? "realisasi":"tmp",
                            "key"=>  $realisasi->id??null,
                            "required"=>false
                        ])
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-12 form-group">
                        <label class="form-control-label">Bahan Bakar (pdf) : </label>
                        @livewire('upload-file',[
                            "type"=>"document",
                            "name"=>"bahan_bakar",
                            "uploaded"=>old('bahan_bakar',$realisasi->bahan_bakar??null) == null ? false : true,
                            "filename" =>old('bahan_bakar',$realisasi->bahan_bakar??null),
                            "folder"=>  isset($realisasi->id) ? "realisasi":"tmp",
                            "key"=>  $realisasi->id??null,
                            "required"=>false
                        ])
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-sm-12 form-group">
                        <label class="form-control-label">Mengetahui : </label>
                        <select name="signature1" id="signature1" class="form-control @error('signature1') is-invalid @enderror" required>
                            <option value="">-- Pilih Pejabat --</option>
                            @forelse($signatures as $signature)
                                <option value="{{ $signature->nama }}" {{ old('signature1',$realisasi->signature1??'')==$signature->nama ?' selected' : '' }}>
                                    {{ $signature->nama }}
                                </option>
                            @empty
                            @endforelse
                        </select>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 form-group">
                        <label class="form-control-label">Mejetujui : </label>
                        <select name="signature2" id="signature2" class="form-control @error('signature2') is-invalid @enderror" required>
                            <option value="">-- Pilih Pejabat --</option>
                            @forelse($signatures as $signature)
                                <option value="{{ $signature->nama }}" {{ old('signature2',$realisasi->signature2??'')==$signature->nama ?' selected' : '' }}>
                                    {{ $signature->nama }}
                                </option>
                            @empty
                            @endforelse
                        </select>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 form-group">
                        <label class="form-control-label">Tanda Tangan 3 : </label>
                        <input type="text" class="form-control" readonly id="ttd" name="ttd" value="{{ old('ttd',$realisasi->rab->surat_tugas_detail->nama??'') }}">
                    </div>
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
    <script>

        $(".select2").select2();
        $(".rupiah").inputmask({
            alias : 'decimal',
            autoUnmask: true,
            groupSeparator: ",",
            radixPoint: ".",
            autoGroup: true,
        });
    </script>
@endpush
