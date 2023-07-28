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
                    <span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Cetak Data</span>
                </div>
            </div>

        </div>
    </div>

    <!-- begin:: Content -->
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">

        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head kt-portlet__head--lg">
                <div class="kt-portlet__head-label">
                    <span class="kt-portlet__head-icon">
                        <i class="kt-font-brand fa fa-file-alt"></i>
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

            <div class="kt-portlet__body" >
                <div class="kt-notes">
                    <div class="kt-notes__items">
                        @forelse($sppd->surat_tugas->surat_tugas_details as $peg)
                            <div class="kt-notes__item">
                                <div class="kt-notes__media">
                                    <span class="kt-notes__icon kt-notes__icon--danger kt-font-boldest">
                                        <i class="flaticon2-user kt-font-danger"></i>
                                    </span>
                                </div>
                                <div class="kt-notes__content">
                                    <div class="kt-notes__section">
                                        <div class="kt-notes__info">
                                            <a href="{{ route('sppd.detail.print',[$sppd->id,$peg->id]) }}" class="kt-notes__title">
                                                {{ $peg->nama }}
                                            </a>
                                            <span class="kt-notes__desc">{{ $peg->nip }}</span>
                                        </div>
                                        <div class="kt-notes__dropdown">
                                            <a href="{{ route('sppd.detail.print',[$sppd->id,$peg->id]) }}" class="btn btn-sm btn-icon-md btn-icon" >
                                                <i class="flaticon2-printer kt-font-brand"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <span class="kt-notes__body">
                                        <b>Jabatan :</b> {{ $peg->jabatan }}<br>
                                        <b>Golongan :</b> {{ $peg->golongan }}
                                    </span>
                                </div>
                            </div>
                        @empty
                        @endforelse
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- end:: Content -->
@endsection
