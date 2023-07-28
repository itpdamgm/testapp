@extends('layouts.app')
@section('title','RAB')
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
                    <a href="{{ route('realisasi.index') }}" class="kt-subheader__breadcrumbs-link">Realisasi </a>
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
                        DAFTAR PERNYATAAN PENGELUARAN
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

            <div class="kt-portlet__body print-area" id="print-area" style="font-family: 'Times New Roman'; font-size: 16pt">
                <table class="table table-borderless">
                    <tbody>
                    <tr><td>
                            <div class="content-space page">
                                <div class="row mb-5 mt-3">
                                    <div class="col-12 text-center">
                                        <h1><u>DAFTAR PERNYATAAN PENGELUARAN</u></h1>
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-12 p-1">Yang bertandatangan dibawah ini :</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-2 p-1 font-weight-bold">Nama</div>
                                            <div class="col-10 p-1">: {{ $rab->surat_tugas_detail->nama }}</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-2 p-1 font-weight-bold">NIK</div>
                                            <div class="col-10 p-1">: {{ $rab->surat_tugas_detail->nip }}</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-2 p-1 font-weight-bold">Jabatan</div>
                                            <div class="col-10 p-1">: {{ $rab->surat_tugas_detail->jabatan }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col-12">
                                        <p>Berdasarkan Surat Tugas (ST) Nomor : {{$rab->surat_tugas_detail->surat_tugas->nomor }} tanggal {{ $rab->surat_tugas_detail->surat_tugas->tanggal->translatedFormat('d F Y') }}
                                            Dan Surat Perintah Perjalanan Dinas (SPPD) Nomor : {{$rab->surat_tugas_detail->surat_tugas->sppd->nomor }} tanggal  {{ $rab->surat_tugas_detail->surat_tugas->sppd->created_at->translatedFormat('d F Y') }},
                                            dengan ini saya/kami menyatakan dengan sesungguhnya bahwa :
                                        </p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <ol>
                                            <li>
                                                Biaya dibawah ini tidak dapat diperoleh bukti-bukti pengeluarannya, meliputi :
                                                <table class="table table-bordered table-sm ">
                                                    <thead>
                                                    <tr>
                                                        <th style="width: 5%" class="text-center">No</th>
                                                        <th class="text-center">Jenis Biaya</th>
                                                        <th style="width: 5%" class="text-center">Satuan</th>
                                                        <th style="width: 5%" class="text-center">Qty</th>
                                                        <th style="width: 5%" class="text-center">Total Biaya</th>
                                                        <th style="width: 10%" class="text-center">Total Pemakaian</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @php $total = 0 @endphp
                                                    @forelse($rab->rab_details->where('need_prove',0)??collect() as $item)
                                                        <tr>
                                                            <td class="text-center">{{ $loop->iteration }}</td>
                                                            <td>{{ $item->nama_biaya }}</td>
                                                            <td>{{ $item->satuan }}</td>
                                                            <td class="text-center">{{ $item->qty }}</td>
                                                            <td class="text-right">{{ number_format($item->biaya*$item->qty) }}</td>
                                                            <td class="text-right">{{ number_format($item->realisasi) }}</td>
                                                        </tr>
                                                        @php $total += ($item->realisasi) @endphp
                                                    @empty
                                                    @endforelse
                                                    <tr>
                                                        <td colspan="5" class="kt-font-bold text-right">Grand Total</td>
                                                        <td class="kt-font-bold text-right">{{ number_format($total)  }}</td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </li>
                                            <li>
                                                Jumlah uang tersebut pada angka 1 diatas benar-benar dikeluarkan untuk pelaksanaan Perjalanan Dinas dimaksud dan apabila dikemudian hari terdapat kelebihan atas pembayaran, saya/kami
                                                bersedia untuk menyetor kelebihan tersebut ke Kas PT Air Minum Giri Menang (Perseroda)
                                            </li>
                                        </ol>

                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col-12">
                                        Demikian pernyataan ini saya/kami buat dengan sebenarnya, untuk dipergunakan sebagaimana mestinya.
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4 text-center">
                                        @if(isset($realisasi->signature1))
                                            <p>&nbsp;</p>
                                            <p class="kt-font-bold">Mengetahui {{ (!isset($realisasi->signature2) ? "/Menyetujui": "") }} : </p>
                                            <p class="kt-font-bold">{{ $signatures->where("nama",$realisasi->signature1)->first()->jabatan??"" }}</p>
                                            <br><br><br>
                                            <p class="kt-font-bold"><u>{{ \Illuminate\Support\Str::upper($realisasi->signature1) }}</u></p>
                                        @endif

                                    </div>
                                    <div class="col-4"></div>
                                    <div class="col-4">
                                        <div class="text-center">
                                            <p>Mataram, {{ $realisasi->created_at->translatedFormat("d F Y") }}</p>
                                            <p class="kt-font-bold">Yang melakukan perjalanan dinas</p>
                                            <p class="kt-font-bold">&nbsp;</p>
                                            <br><br><br>
                                            <p class="kt-font-bold"><u>{{ \Illuminate\Support\Str::upper($rab->surat_tugas_detail->nama) }}</u></p>
                                        </div>
                                    </div>
                                    <div class="col-12 text-center mt-3">
                                        @if(isset($realisasi->signature2))
                                            <p class="kt-font-bold">Menyetujui : </p>
                                            <p class="kt-font-bold">{{ $signatures->where("nama",$realisasi->signature2)->first()->jabatan??"" }}</p>
                                            <br><br><br>
                                            <p class="kt-font-bold"><u>{{ \Illuminate\Support\Str::upper($realisasi->signature2) }}</u></p>
                                        @endif
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
            <div class="kt-portlet__head kt-portlet__head--lg">
                <div class="kt-portlet__head-label">
                    <span class="kt-portlet__head-icon">
                        <i class="kt-font-brand fa fa-file-alt"></i>
                    </span>
                    <h3 class="kt-portlet__head-title">
                        PERHITUNGAN SPPD RAMPUNG
                    </h3>
                </div>
            </div>

            <div class="kt-portlet__body print-area" id="print-area-2" style="font-family: 'Times New Roman'; font-size: 15pt">
                <table class="table table-borderless">
                    <tbody>
                    <tr><td>
                            <div class="content-space page">
                                <div class="row mb-5 mt-3">
                                    <div class="col-12 text-center">
                                        <h1><u>PERHITUNGAN SPPD RAMPUNG</u></h1>
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <div class="col-1 kt-font-bold">I.</div>
                                    <div class="col-11 "><span class="kt-font-bold">DASAR PERJALANAN DINAS (SPPD) :</span>
                                        <table class="table table-sm table-borderless">
                                            <tr>
                                                <td>1</td>
                                                <td style="width: 20%">Tanggal</td>
                                                <td>: {{ $rab->surat_tugas_detail->surat_tugas->sppd->created_at->translatedFormat('d F Y') }}</td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td style="width: 20%">Nomor</td>
                                                <td>: {{ $rab->surat_tugas_detail->surat_tugas->sppd->nomor }}</td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td style="width: 20%">Waktu</td>
                                                <td>: {{ $rab->surat_tugas_detail->surat_tugas->sppd->tgl_berangkat->translatedFormat('d F Y').' s/d '.$rab->surat_tugas_detail->surat_tugas->sppd->tgl_kembali->translatedFormat('d F Y') }}</td>
                                            </tr>
                                            <tr>
                                                <td>4</td>
                                                <td style="width: 20%">Tempat Tujuan</td>
                                                <td>: {{ $rab->surat_tugas_detail->surat_tugas->sppd->tempat_tujuan }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <div class="col-1 kt-font-bold">II.</div>
                                    <div class="col-11 "><span class="kt-font-bold">IDENTITAS YANG MELAKUKAN PERJALANAN DINAS :</span>
                                        <table class="table table-sm table-borderless">
                                            <tr>
                                                <td>1</td>
                                                <td style="width: 20%">Nama</td>
                                                <td>: {{ $rab->surat_tugas_detail->nama }}</td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td style="width: 20%">NIK</td>
                                                <td>: {{ $rab->surat_tugas_detail->nip }}</td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td style="width: 20%">Golongan</td>
                                                <td>: {{ $rab->surat_tugas_detail->golongan }}</td>
                                            </tr>
                                            <tr>
                                                <td>4</td>
                                                <td style="width: 20%">Jabatan</td>
                                                <td>: {{ $rab->surat_tugas_detail->jabatan }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col-1 kt-font-bold">III.</div>
                                    <div class="col-11 "><span class="kt-font-bold">PERHITUNGAN SPPD RAMPUNG :</span>
                                        <table class="table table-sm table-borderless">
                                            <tr>
                                                <td>a.</td>
                                                <td style="width: 80%">Yang telah dibayar semula
                                                    <table class="table table-sm table-borderless">
                                                        @foreach($rab->rab_details as $det)
                                                        <tr>
                                                            <td style="width: 80%">- {{ $det->nama_biaya }}</td>
                                                            <td style="width: 10%">Rp.</td>
                                                            <td class="text-right">{{ number_format($det->biaya*$det->qty) }}</td>
                                                        </tr>
                                                        @endforeach
                                                    </table>
                                                </td>
                                                <td class="kt-font-bold">Rp. {{ number_format($rab->total_rab) }}</td>
                                            </tr>
                                            <tr>
                                                <td>b.</td>
                                                <td style="width: 80%">Yang dipergunakan
                                                    <table class="table table-sm table-borderless">
                                                        @php $tot_real = 0 @endphp
                                                        @foreach($rab->rab_details as $det)
                                                            <tr>
                                                                <td style="width: 80%">- {{ $det->nama_biaya }}</td>
                                                                <td style="width: 10%">Rp.</td>
                                                                <td class="text-right">{{ number_format($det->realisasi) }}</td>
                                                            </tr>
                                                            @php $tot_real += $det->realisasi @endphp
                                                        @endforeach
                                                    </table>
                                                </td>
                                                <td class="kt-font-bold">Rp. {{ number_format($tot_real) }}</td>
                                            </tr>
                                            <tr>
                                                <td>c.</td>
                                                <td style="width: 80%">Pengembalian
                                                    <table class="table table-sm table-borderless">
                                                        @php $tot_kembali = 0 @endphp
                                                        @foreach($rab->rab_details as $det)
                                                            @php $selisih = ($det->biaya*$det->qty)-$det->realisasi; @endphp
                                                            @if($selisih <> 0)
                                                            <tr>
                                                                <td style="width: 80%">- {!! ($selisih < 0 ?'Kekurangan ':'Kelebihan ').$det->nama_biaya. (!$det->selisih_diakui && $det->ket_diakui<>'' ? "<br>&nbsp;&nbsp;&nbsp;<small><em>( ".$det->ket_diakui." )<em></small>":"") !!}
                                                                </td>
                                                                <td style="width: 10%">Rp.</td>
                                                                <td class="text-right">{{ number_format(($det->biaya*$det->qty)-$det->realisasi) }}</td>
                                                            </tr>
                                                            @php $tot_kembali += ($det->selisih_diakui ? $selisih : 0) @endphp
                                                            @endif
                                                        @endforeach
                                                    </table>
                                                </td>
                                                <td class="kt-font-bold">Rp. {{ number_format($tot_kembali) }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-4 text-center">
                                        @if(isset($realisasi->signature1))
                                            <p>&nbsp;</p>
                                            <p class="kt-font-bold pb-0">Mengetahui {{ (!isset($realisasi->signature2) ? "Menyetujui": "") }} : </p>
                                            <p class="kt-font-bold">{{ $signatures->where("nama",$realisasi->signature1)->first()->jabatan??"" }}</p>
                                            <br><br>
                                            <p class="kt-font-bold"><u>{{ \Illuminate\Support\Str::upper($realisasi->signature1) }}</u></p>
                                        @endif

                                    </div>
                                    <div class="col-4"></div>
                                    <div class="col-4">
                                        <div class="text-center">
                                            <p>Mataram, {{ $realisasi->created_at->translatedFormat("d F Y") }}</p>
                                            <p class="kt-font-bold pb-0">Yang melakukan perjalanan dinas</p>
                                            <p class="kt-font-bold">&nbsp;</p>
                                            <br><br>
                                            <p class="kt-font-bold"><u>{{ \Illuminate\Support\Str::upper($rab->surat_tugas_detail->nama) }}</u></p>
                                        </div>
                                    </div>
                                    <div class="col-12 text-center mt-3">
                                        @if(isset($realisasi->signature2))
                                            <p class="kt-font-bold pb-0">Menyetujui : </p>
                                            <p class="kt-font-bold">{{ $signatures->where("nama",$realisasi->signature2)->first()->jabatan??"" }}</p>
                                            <br><br>
                                            <p class="kt-font-bold"><u>{{ \Illuminate\Support\Str::upper($realisasi->signature2) }}</u></p>
                                        @endif
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
