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
                    <a href="{{ route('rab.index') }}" class="kt-subheader__breadcrumbs-link">Rencana Anggaran Biaya </a>
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
                        {{ \Illuminate\Support\Str::upper($rab->nama) }}
                    </h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                    <div class="kt-portlet__head-wrapper">
                        <div class="kt-portlet__head-actions">

                            <a href="{{ route('rab.index',$rab->id) }}" class="btn btn-danger btn-elevate btn-icon-sm">
                                <i class="la la-times"></i>
                                Kembali
                            </a>
                        </div>
                    </div>
                </div>

            </div>

            <div class="kt-portlet__body print-area" id="print-area" style="font-family: 'Times New Roman';font-size: 16pt">
                <table class="table table-borderless">
                    <tbody>
                    <tr><td>
                            <div class="content-space page">
                                <div class="row mb-5 mt-3">
                                    <div class="col-12 text-center">
                                        <h1><u>{{ \Illuminate\Support\Str::upper($rab->nama) }}</u></h1>
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-2 p-1 font-weight-bold">Nama</div>
                                            <div class="col-10 p-1"><div class="d-flex"><span class="mr-2">:</span> {{ $rab->surat_tugas_detail->nama }}</div></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-2 p-1 font-weight-bold">NIK</div>
                                            <div class="col-10 p-1"><div class="d-flex"><span class="mr-2">:</span> {{ $rab->surat_tugas_detail->nip }}</div></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-2 p-1 font-weight-bold">Jabatan</div>
                                            <div class="col-10 p-1"><div class="d-flex"><span class="mr-2">:</span> {{ $rab->surat_tugas_detail->jabatan }}</div></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-2 p-1 font-weight-bold">Kegiatan</div>
                                            <div class="col-10 p-1"><div class="d-flex"><span class="mr-2">:</span> {{ $sppd->maksud }} </div></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-2 p-1 font-weight-bold">Tempat</div>
                                            <div class="col-10 p-1"><div class="d-flex"><span class="mr-2">:</span> {{ $sppd->tempat_tujuan }}</div></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-2 p-1 font-weight-bold">Tanggal</div>
                                            <div class="col-10 p-1"><div class="d-flex"><span class="mr-2">:</span> {{ $sppd->tgl_berangkat->translatedFormat('d F Y').' s/d '.$sppd->tgl_kembali->translatedFormat('d F Y') }}</div></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <table class="table table-bordered table-sm " >
                                            <thead>
                                            <tr>
                                                <th style="width: 5%" class="text-center">No</th>
                                                <th class="text-center">Jenis Biaya</th>
                                                <th style="width: 5%" class="text-center">Satuan</th>
                                                <th style="width: 5%" class="text-center">Qty</th>
                                                <th style="width: 10%" class="text-center">Biaya</th>
                                                <th class="text-center">Sub Total</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @forelse($rab->rab_details as $item)
                                                <tr>
                                                    <td class="text-center">{{ $loop->iteration }}</td>
                                                    <td>{{ $item->nama_biaya }}</td>
                                                    <td>{{ $item->satuan }}</td>
                                                    <td class="text-center">{{ $item->qty }}</td>
                                                    <td class="text-right">{{ number_format($item->biaya) }}</td>
                                                    <td class="text-right">{{ number_format($item->biaya*$item->qty) }}</td>
                                                </tr>
                                            @empty
                                            @endforelse
                                            <tr>
                                                <td colspan="5" class="kt-font-bold text-right">Total</td>
                                                <td class="kt-font-bold text-right">{{ number_format($rab->total_rab)  }}</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-4 text-center mb-4">
                                        <p>&nbsp;</p>
                                        <p class="kt-font-bold mb-0">Disetujui Oleh : </p>
                                        <p class="kt-font-bold">{{ $signatures->where('nama',$rab->disetujui)->first()->jabatan??'' }}</p>
                                        <br><br><br>
                                        <p class="kt-font-bold"><u>{{ \Illuminate\Support\Str::upper($rab->disetujui) }}</u></p>
                                    </div>
                                    <div class="col-4 text-center mb-4">
                                        <p>&nbsp;</p>
                                        <p class="kt-font-bold mb-0">Diperiksa Oleh :</p>
                                        <p class="kt-font-bold">{{ $signatures->where('nama',$rab->diperiksa)->first()->jabatan??'' }}</p>
                                        <br><br><br>
                                        <p class="kt-font-bold"><u>{{ \Illuminate\Support\Str::upper($rab->diperiksa) }}</u></p>
                                    </div>
                                    <div class="col-4 text-center mb-4">
                                        <p>Mataram, {{ $sppd->created_at->translatedFormat('d F Y') }}</p>
                                        <p class="kt-font-bold mb-0">Pembuat Rincian</p>
                                        <p class="kt-font-bold">{{ $signatures->where('nama',$rab->pembuat)->first()->jabatan??'' }}</p>
                                        <br><br><br>
                                        <p class="kt-font-bold"><u>{{ \Illuminate\Support\Str::upper($rab->pembuat) }}</u></p>
                                    </div>
                                    <div class="col-6 text-center mt-4">
                                        <p class="kt-font-bold mb-0">Yang Menerima</p>
                                        <p class="kt-font-bold">{{ $rab->surat_tugas_detail->jabatan }}</p>
                                        <br><br><br>
                                        <p class="kt-font-bold"><u>{{ \Illuminate\Support\Str::upper($rab->surat_tugas_detail->nama) }}</u></p>
                                    </div>
                                    <div class="col-6 text-center mt-4">
                                        <p class="kt-font-bold mb-0">Yang Menyerahkan</p>
                                        <p class="kt-font-bold">{{ $signatures->where('nama',$rab->menyerahkan)->first()->jabatan??'' }}</p>
                                        <br><br><br>
                                        <p class="kt-font-bold"><u>{{ \Illuminate\Support\Str::upper($rab->menyerahkan) }}</u></p>
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
    </script>
@endpush
