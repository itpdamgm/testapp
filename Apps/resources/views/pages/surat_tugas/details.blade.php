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
                    <span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Add Pegawai</span>
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
                        [{{ $suratTugas->nomor }}] - DAFTAR PEGAWAI
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
            <div class="kt-portlet__body">
                @livewire('surat-tugas-details',[
                                         "suratTugas" => ($suratTugas??null)
                                    ])
            </div>

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
