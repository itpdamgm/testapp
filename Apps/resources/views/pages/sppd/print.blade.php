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

                            <a href="{{ route('sppd.show',$sppd->id) }}" class="btn btn-danger btn-elevate btn-icon-sm">
                                <i class="la la-times"></i>
                                Kembali
                            </a>
                        </div>
                    </div>
                </div>

            </div>

            <div class="kt-portlet__body print-area" id="print-area" style="font-family: 'Times New Roman';font-size: 16pt">
                @include('includes.print-header-footer')
                <table class="table table-borderless">
                    <thead>
                        <tr>
                            <td><div class="page-header-space"></div></td>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <td><div class="page-footer-space"></div></td>
                        </tr>
                    </tfoot>
                    <tbody>
                        <tr><td style="page-break-inside: avoid !important;">
                                <div class="content-space page">
                                    <div class="row mb-5 mt-3">
                                        <div class="col-12 text-center">
                                            <h1><u>SURAT PERINTAH PERJALANAN DINAS</u></h1>
                                            <h3>Nomor : {{ $sppd->nomor }}</h3>
                                        </div>
                                    </div>

                                    <div class="row mb-4">
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-6 border border-dark p-1">1. Pejabat berwenang yang memberi Perintah</div>
                                                <div class="col-6 border border-dark p-1">{{ $signatures->where('nama',$sppd->pemberi_tugas)->first()->jabatan??'' }} PT Air Minum Giri Menang (Perseroda)</div>
                                            </div>

                                            <div class="row">
                                                <div class="col-6 border border-dark p-1">2. Nama Pegawai yang diperintahkan</div>
                                                <div class="col-6 border border-dark p-1">{{ $detail->nama }}</div>
                                            </div>
                                            <div class="row">
                                                <div class="col-6 border border-dark p-1">3. a. Pangkat dan golongan <br>
                                                    &nbsp;&nbsp;&nbsp; b. Jabatan <br>
                                                    &nbsp;&nbsp;&nbsp; c. Gaji Pokok<br>
                                                    &nbsp;&nbsp;&nbsp; d. Tingkat menurut peraturan perjalanan dinas</div>
                                                <div class="col-6 border border-dark p-1">{{ 'a. '.$detail->golongan }}<br>{{ 'b. '.$detail->jabatan }}<br>c. -<br>d. -</div>
                                            </div>
                                            <div class="row">
                                                <div class="col-6 border border-dark p-1">4. Maksud Perjalanan Dinas </div>
                                                <div class="col-6 border border-dark p-1">{{ $sppd->maksud }}</div>
                                            </div>
                                            <div class="row">
                                                <div class="col-6 border border-dark p-1">5. Alat Angkutan yang dipergunakan </div>
                                                <div class="col-6 border border-dark p-1">{{ $sppd->alat_angkutan }}</div>
                                            </div>
                                            <div class="row">
                                                <div class="col-6 border border-dark p-1">6. a. Tempat Berangkat <br>
                                                    &nbsp;&nbsp;&nbsp; b. Tempat Tujuan </div>
                                                <div class="col-6 border border-dark p-1">{{ 'a. '.$sppd->tempat_berangkat }}<br>{{ 'b. '.$sppd->tempat_tujuan }}</div>
                                            </div>
                                            <div class="row">
                                                <div class="col-6 border border-dark p-1">7. a. Lamanya perjalanan dinas <br>
                                                    &nbsp;&nbsp;&nbsp; b. Tanggal berangkat<br>
                                                    &nbsp;&nbsp;&nbsp; c. Tanggal harus kembali</div>
                                                <div class="col-6 border border-dark p-1">{{ 'a. '.$sppd->lama_hari.' Hari' }}<br>
                                                    {{ 'b. '.$sppd->tgl_berangkat->translatedFormat('d F Y') }}<br>
                                                    {{ 'c. '.$sppd->tgl_kembali->translatedFormat('d F Y') }}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-6 border border-dark p-1">8. Pengikut </div>
                                                <div class="col-6 border border-dark p-1">
                                                    <table class="table table-sm table-borderless">
                                                        <tr>
                                                            <td style="width: 5%" class="text-center">#</td>
                                                            <td class="text-center">Nama</td>
                                                            <td style="width: 10%" class="text-center">Umur</td>
                                                            <td class="text-center">Hubungan keluarga / Keterangan</td>
                                                        </tr>
                                                        @forelse($sppd->pengikut as $pengikut)
                                                            <tr>
                                                                <td>{{ $loop->iteration }}</td>
                                                                <td>{{ $pengikut->nama }}</td>
                                                                <td>{{ $pengikut->umur.' Tahun' }}</td>
                                                                <td>{{ $pengikut->keterangan }}</td>
                                                            </tr>
                                                        @empty
                                                        @endforelse
                                                    </table>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-6 border border-dark p-1">9. Pembebanan Anggaran <br>
                                                    &nbsp;&nbsp;&nbsp; a. Instansi<br>
                                                    &nbsp;&nbsp;&nbsp; b. Kode Perkiraan</div>
                                                <div class="col-6 border border-dark p-1"> &nbsp;<br>
                                                    {{ 'a. '.$sppd->beban_instansi }}<br>
                                                    {{ 'b. '.$sppd->beban_kode_akun }}
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-6 border border-dark p-1">10. Keterangan lain - lain </div>
                                                <div class="col-6 border border-dark p-1"> &nbsp;</div>
                                            </div>
                                            <div class="row">
                                                <div class="col-6 ">Tembusan disampaikan kepada : </div>
                                                <div class="col-6 "> &nbsp;</div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-5 offset-7">
                                            <table class="table table-borderless table-condensed table-sm">
                                                <tr>
                                                    <td style="width: 50%">DIKELUARKAN DI</td>
                                                    <td>: Mataram</td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 50%">PADA TANGGAL</td>
                                                    <td>: {{ $sppd->created_at->translatedFormat('d F Y') }}</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2" class="text-center">
                                                        <p class="kt-font-bold">{{ strtoupper($signatures->where('nama',$sppd->pemberi_tugas)->first()->jabatan??'') }}</p>
                                                        <br><br>
                                                        <p class="kt-font-bold"><u>{{ \Illuminate\Support\Str::upper($sppd->pemberi_tugas) }}</u></p>
                                                    </td>

                                                </tr>
                                            </table>
                                        </div>
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

        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__body print-area" id="print-area-2" style="font-family: 'Times New Roman';font-size: 16pt">
                <table class="table table-borderless">
                    <tbody>
                    <tr><td>
                            <div class="content-space page">

                                <div class="row">
                                    <div class="col-6 p-2">&nbsp;</div>
                                    <div class="col-6 p-2">
                                        <table class="table table-sm table-borderless">
                                            <tr>
                                                <td style="width: 50%">Berangkat dari (tempat kedudukan)</td>
                                                <td style="width: 50%">: {{ $sppd->tempat_berangkat }}</td>
                                            </tr>
                                            <tr>
                                                <td style="width: 50%">Pada tanggal</td>
                                                <td style="width: 50%">: {{ $sppd->tgl_berangkat->translatedFormat('d F Y') }}</td>
                                            </tr>
                                            <tr>
                                                <td style="width: 50%">Ke</td>
                                                <td style="width: 50%">: {{ $sppd->tempat_tujuan }}</td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">{{ $signatures->where('nama',$sppd->pemberi_tugas)->first()->jabatan??'' }} PT Air Minum Giri Menang (Perseroda)<br>
                                                    Jalan PendidikanNo. 39 Telp 632510 - 623934 Mataram <br><br><br>
                                                    <u>({{ \Illuminate\Support\Str::upper($sppd->pemberi_tugas) }})</u>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>

                                @forelse($sppd->sppd_details as $detail)
                                    <div class="row">
                                        <div class="col-6 border-top border-dark p-2">
                                            <table class="table table-sm table-borderless">
                                                <tr>
                                                    <td rowspan="4" style="width: 5%;">{{ NumConvert::roman($loop->iteration) }}</td>
                                                    <td style="width: 40%">Tiba di </td>
                                                    <td style="width: 55%">: {{ $detail->tiba_di }}</td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 40%">Pada Tanggal </td>
                                                    <td style="width: 60%">: {{ $detail->tgl_tiba->translatedFormat('d F Y') }}</td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 40%">Kepala </td>
                                                    <td style="width: 60%">: &nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 40%">&nbsp;</td>
                                                    <td style="width: 60%">&nbsp;</td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="col-6 border-top border-dark p-2">
                                            <table class="table table-sm table-borderless">
                                                <tr>
                                                    <td style="width: 40%">Berangkat dari </td>
                                                    <td style="width: 60%">: {{ $detail->berangkat_dari }}</td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 40%">Ke </td>
                                                    <td style="width: 60%">: {{ $detail->tujuan }}</td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 40%">Pada Tanggal </td>
                                                    <td style="width: 60%">: {{ $detail->tgl_berangkat->translatedFormat('d F Y') }}</td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 40%">Kepala </td>
                                                    <td style="width: 60%">: &nbsp;</td>
                                                </tr>

                                            </table>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6 border-dark p-2 mt-4">
                                            <table class="table table-sm table-borderless">
                                                <tr>
                                                    <td style="width: 5%"></td>
                                                    <td style="width: 95%">( .................................................................. )</td>
                                                </tr>
                                            </table>

                                        </div>
                                        <div class="col-6 border-dark p-2 mt-4">
                                            <table class="table table-sm table-borderless">
                                                <tr>
                                                    <td>( .................................................................. )</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                @empty
                                @endforelse
                                <div class="row">
                                    <div class="col-6 border-top border-dark p-2">
                                        <table class="table table-sm table-borderless">
                                            <tr>
                                                <td rowspan="4" style="width: 5%">{{ NumConvert::roman($sppd->sppd_details->count()+1) }}</td>
                                                <td style="width: 40%">Tiba kembali di (tempat kedudukan) </td>
                                                <td style="width: 55%">: {{ $sppd->tempat_berangkat }}</td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">Pejabat yang bemberi Perintah </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">{{ $signatures->where('nama',$sppd->pemberi_tugas)->first()->jabatan??'' }} PT Air Minum Giri Menang (Perseroda)
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="col-6 border-top border-dark p-2">
                                        <table class="table table-sm table-borderless">
                                            <tr>
                                                <td>Telah diperiksa dengan ketentuan perjalanan tersebut diatas benar dilakukan atas perintahnya dan semata-mata untuk kepetningan jababtan dalam waktu sesingkat-singkatnya.</td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">Pejabat yang bemberi Perintah </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">{{ $signatures->where('nama',$sppd->pemberi_tugas)->first()->jabatan??'' }} PT Air Minum Giri Menang (Perseroda)
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6 border-dark p-2 mt-5">
                                        <table class="table table-sm table-borderless">
                                            <tr>
                                                <td style="width: 5%"></td>
                                                <td style="width: 95%">( {{ \Illuminate\Support\Str::upper($sppd->pemberi_tugas) }} )</td>
                                            </tr>
                                        </table>

                                    </div>
                                    <div class="col-6 border-dark p-2 mt-5">
                                        <table class="table table-sm table-borderless">
                                            <tr>
                                                <td>( {{ \Illuminate\Support\Str::upper($sppd->pemberi_tugas) }} )</td>
                                            </tr>
                                        </table>

                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-6 border-top border-dark p-2 ">
                                        <table class="table table-sm table-borderless">
                                            <tr>
                                                <td style="width: 5%">{{ NumConvert::roman($sppd->sppd_details->count()+2) }}</td>
                                                <td style="width: 95%">CATATAN LAIN</td>
                                            </tr>
                                        </table>

                                    </div>
                                    <div class="col-6 border-top border-dark p-2">
                                        <table class="table table-sm table-borderless">
                                            <tr>
                                                <td>{{ $sppd->catatan }}</td>
                                            </tr>
                                        </table>

                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-6 border-top border-dark p-2">
                                        <table class="table table-sm table-borderless">
                                            <tr>
                                                <td style="width: 5%">{{ NumConvert::roman($sppd->sppd_details->count()+3) }}</td>
                                                <td style="width: 95%">PERHATIAN</td>
                                            </tr>
                                        </table>

                                    </div>
                                    <div class="col-6 border-top border-dark p-2">
                                        <table class="table table-sm table-borderless">
                                            <tr>
                                                <td>{{ $sppd->perhatian }}</td>
                                            </tr>
                                        </table>

                                    </div>
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
                            <button type="button" onclick="print2()" class="btn btn-brand">Cetak Data</button>
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

        function print2(){
            $("#print-area-2").printThis({
                importCSS: true,
                printDelay: 1500,
                loadCSS: '{{ asset('css/print.css') }}',
                importStyle: true,
            });
        }


    </script>
@endpush
