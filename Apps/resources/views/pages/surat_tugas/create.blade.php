@extends('layouts.app')
@section('title','Surat Tugas')
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
                    <a href="{{ route('surat-tugas.index') }}" class="kt-subheader__breadcrumbs-link">Surat Tugas </a>
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
                        <i class="kt-font-brand fa fa-file-alt"></i>
                    </span>
                    <h3 class="kt-portlet__head-title">
                        SURAT TUGAS
                    </h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                    <div class="kt-portlet__head-wrapper">
                        <div class="kt-portlet__head-actions">

                            <a href="{{ route('surat-tugas.index') }}" class="btn btn-danger btn-elevate btn-icon-sm">
                                <i class="la la-times"></i>
                                Kembali
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @php $requestName  = request()->route()->getName(); @endphp
            <form action="{{ ($requestName=='surat-tugas.create' ? route('surat-tugas.store') : route('surat-tugas.update',$suratTugas->id)) }}" novalidate="novalidate" method="post">
                @csrf
                @method(($requestName=='surat-tugas.create' ?'POST' : 'PUT'))
            <div class="kt-portlet__body">
                <div class="row">
                    <div class="col-lg-3 col-md-4 col-sm-12 form-group">
                        <label class="form-control-label">Nomor : </label>
                        <input type="text" name="nomor" class="form-control @error('nomor') is-invalid @enderror" placeholder=""
                               value="{{ old('nomor',$suratTugas->nomor??'') }}" required>
                    </div>
                    <div class="col-lg-2 col-md-4 col-sm-12 form-group">
                        <label class="form-control-label">Tanggal : </label>
                        <input type="text" name="tanggal" class="form-control datepick @error('tanggal') is-invalid @enderror" placeholder=""
                               value="{{ old('tanggal',($suratTugas->tanggal??now())->format('d-m-Y')) }}" required readonly="">
                    </div>
                    <div class="col-lg-7 col-md-4 col-sm-12 form-group">
                        <label class="form-control-label">Pemberi Tugas: </label>
                        <select name="pemberi_tugas" id="pemberi_tugas" class="form-control @error('pemberi_tugas') is-invalid @enderror" required>
                            <option value="">-- Pilih Pejabat --</option>
                            @forelse($signatures as $signature)
                                <option value="{{ $signature->nama }}" {{ old('pemberi_tugas',$suratTugas->pemberi_tugas??'')==$signature->nama ?' selected' : '' }}>
                                    {{ $signature->nama }}
                                </option>
                            @empty
                            @endforelse
                        </select>
                    </div>
                    <div class="col-lg-2 col-md-6 col-sm-12 form-group">
                        <label class="form-control-label">Tgl Berangkat  : </label>
                        <input type="text" name="tgl_berangkat" class="form-control datepick @error('tgl_berangkat') is-invalid @enderror" placeholder=""
                               value="{{ old('tgl_berangkat',($suratTugas->tgl_berangkat??now())->format('d-m-Y')) }}" required readonly="">
                    </div>
                    <div class="col-lg-2 col-md-6 col-sm-12 form-group">
                        <label class="form-control-label">Tgl Kembali  : </label>
                        <input type="text" name="tgl_kembali" class="form-control datepick @error('tgl_kembali') is-invalid @enderror" placeholder=""
                               value="{{ old('tgl_kembali',($suratTugas->tgl_kembali??now())->format('d-m-Y')) }}" required readonly="">
                    </div>
                    <div class="col-lg-2 col-md-6 col-sm-12 form-group">
                        <label class="form-control-label">Lama Hari : </label>
                        <input type="number" name="lama_hari" class="form-control @error('lama_hari') is-invalid @enderror" placeholder=""
                               value="{{ old('lama_hari',$suratTugas->lama_hari??'1') }}" required min="1" >
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 form-group">
                        <label class="form-control-label">Tempat Berangkat : </label>
                        <input type="text" name="tempat_berangkat" class="form-control @error('tempat_berangkat') is-invalid @enderror" placeholder=""
                               value="{{ old('tempat_berangkat',$suratTugas->tempat_berangkat??'Mataram') }}" required>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 form-group">
                        <label class="form-control-label">Tempat Tujuan : </label>
                        <input type="text" name="tempat_tujuan" class="form-control @error('tempat_tujuan') is-invalid @enderror" placeholder=""
                               value="{{ old('tempat_tujuan',$suratTugas->tempat_tujuan??'') }}" required>
                    </div>
                    <div class="col-lg-12 col-md-12 form-group">
                        <label class="form-control-label">Untuk : </label>
                        <textarea name="keterangan" id="keterangan" cols="30" rows="5"
                                  class="form-control @error('keterangan') is-invalid @enderror" required>{{ old('keterangan',$suratTugas->keterangan??'') }}</textarea>
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
        $(".datepick").datepicker({
            format: "dd-mm-yyyy",
            language: "id",
            autoclose: true,
            todayHighlight: true,
            orientation:'bottom'
        })


    </script>
@endpush
