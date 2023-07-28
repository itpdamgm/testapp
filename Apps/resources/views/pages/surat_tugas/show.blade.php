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
                    <h1 class="kt-portlet__head-title">
                        SURAT TUGAS
                    </h1>
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

            <div class="kt-portlet__body" id="print-area" style="font-family: 'Times New Roman';font-size: 16pt">
                @include('includes.print-header-footer')
                <table class="table table-borderless">
                    <thead>
                        <tr>
                            <td><div class="page-header-space mb-5"></div></td>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <td><div class="page-footer-space"></div></td>
                        </tr>
                    </tfoot>
                    <tbody>
                        <tr>
                            <td>
                                <div class="row mb-5">
                                    <div class="col-12 text-center">
                                        <h1 class="font-weight-bolder"><u>SURAT TUGAS</u></h1>
                                        <h3>Nomor : {{ $suratTugas->nomor }}</h3>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="row">
                                    <div class="col-12">
                                        <p style="text-indent: 50px">Berdasarkan Surat Keputusan Direktur Utama PT Air Minum Giri Menang (Perseroda) Nomor: 500.04 / DIR / AMGM / 2021 Tentang Ketentuan Perjalanan Dinas Di Lingkungan PT Air Minum Giri Menang (Perseroda),  dengan ini menugaskan kepada :</p>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @forelse($suratTugas->surat_tugas_details as $detail)
                            <tr>
                                <td class="page-row">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-3"><span style="width: 10%;display: inline-block">{{ $loop->iteration }}.</span>Nama</div>
                                                <div class="col-9"><span class="mr-2">:</span> {{ $detail->nama }}</div>
                                            </div>
                                            <div class="row">
                                                <div class="col-3"><span style="width: 10%;display: inline-block">&nbsp;</span>NIK</div>
                                                <div class="col-9"><span class="mr-2">:</span> {{ $detail->nip }}</div>
                                            </div>
                                            <div class="row">
                                                <div class="col-3"><span style="width: 10%;display: inline-block">&nbsp;</span>Gol / Pangkat</div>
                                                <div class="col-9"><span class="mr-2">:</span> {{ $detail->golongan }}</div>
                                            </div>
                                            <div class="row">
                                                <div class="col-3"><span style="width: 10%;display: inline-block">&nbsp;</span>Jabatan</div>
                                                <div class="col-9"><span class="mr-2">:</span> {{ $detail->jabatan }}</div>
                                            </div>

                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                        @endforelse
                        <tr>
                            <td class="page-row">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-3">Tujuan</div>
                                            <div class="col-9"><span class="mr-2">:</span> {{ $suratTugas->tempat_tujuan }}</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-3">Lamanya</div>
                                            <div class="col-9"><span class="mr-2">:</span> {{ $suratTugas->tgl_berangkat->translatedFormat('d F Y').' sd. '.$suratTugas->tgl_kembali->translatedFormat('d F Y'). " [ ".$suratTugas->lama_hari.' Hari ]' }}</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-3">Uraian Tugas</div>
                                            <div class="col-9"><div class="d-flex"><span class="mr-2">:</span> {{ $suratTugas->keterangan }} </div></div>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-4">
                                        <p>Demikian Surat Perintah Tugas ini dibuat untuk dilaksanakan sebagaimana mestinya.</p>
                                    </div>
                                </div>
                                <div class="row ">
                                    <div class="col-lg-4 offset-8 text-center">
                                        <p>Mataram, {{ $suratTugas->tanggal->translatedFormat('d F Y') }}</p>
                                        <p class="kt-font-bold">{{ $signatures->where('nama',$suratTugas->pemberi_tugas)->first()->jabatan??'' }}</p>
                                        <br><br><br>
                                        <p class="kt-font-bold"><u>{{ \Illuminate\Support\Str::upper($suratTugas->pemberi_tugas) }}</u></p>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="kt-portlet__foot">
                <div class="kt-form__actions">
                    <div class="row">
                        <div class="col-lg-12 ml-lg-auto">
                            <button type="button" onclick="print()" class="btn btn-brand">Cetak Data</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- end:: Content -->
@endsection

@push('scripts')
    <script src="{{ asset('plugins/printThis/printThis.js')}}"></script>
    <script>
        $(".datepick").datepicker({
            format: "dd-mm-yyyy",
            language: "id",
            autoclose: true,
            todayHighlight: true
        })


        function print(){
            $("#print-area").printThis({
                importCSS: true,
                printDelay: 1500,
                loadCSS: '{{ asset('css/print.css') }}',
                importStyle: true,
            });
        }


    </script>
@endpush
