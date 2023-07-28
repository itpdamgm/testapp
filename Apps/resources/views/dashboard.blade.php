@extends('layouts.app')

@section('title','Dashboard')
@section('content')
    <!-- begin:: Content Head -->
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">
                    DASHBOARD </h3>
                <span class="kt-subheader__separator kt-hidden"></span>
            </div>

        </div>
    </div>

    <!-- end:: Content Head -->

    <!-- begin:: Content -->
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">

        <div class="kt-portlet">
            <div class="kt-portlet__body  kt-portlet__body--fit">
                <div class="row row-no-padding row-col-separator-lg">
                    <div class="col-md-12 col-lg-6 col-xl-3">

                        <!--begin::Total Profit-->
                        <div class="kt-widget24">
                            <div class="kt-widget24__details">
                                <div class="kt-widget24__info">
                                    <h4 class="kt-widget24__title">
                                        Total Biaya SPPD
                                    </h4>
                                    <span class="kt-widget24__desc">Tahun Ini</span>
                                </div>
                                <span class="kt-widget24__stats kt-font-brand">Rp. {{ number_format($total_biaya) }}</span>
                            </div>
                            <div class="progress progress--sm">
                                <div class="progress-bar kt-bg-brand" role="progressbar" style="width: 100%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>

                        <!--end::Total Profit-->
                    </div>
                    <div class="col-md-12 col-lg-6 col-xl-3">

                        <!--begin::New Feedbacks-->
                        <div class="kt-widget24">
                            <div class="kt-widget24__details">
                                <div class="kt-widget24__info">
                                    <h4 class="kt-widget24__title">
                                        Jumlah SPPD
                                    </h4>
                                    <span class="kt-widget24__desc">Tahun Ini</span>
                                </div>
                                <span class="kt-widget24__stats kt-font-warning">{{ $total_sppd }}</span>
                            </div>
                            <div class="progress progress--sm">
                                <div class="progress-bar kt-bg-warning" role="progressbar" style="width: 100%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>

                        </div>

                        <!--end::New Feedbacks-->
                    </div>
                    <div class="col-md-12 col-lg-6 col-xl-3">

                        <!--begin::New Orders-->
                        <div class="kt-widget24">
                            <div class="kt-widget24__details">
                                <div class="kt-widget24__info">
                                    <h4 class="kt-widget24__title">
                                        On Going SPPD
                                    </h4>
                                    <span class="kt-widget24__desc">SPPD Belum Realisasi</span>
                                </div>
                                <span class="kt-widget24__stats kt-font-danger">{{ $sppd_ongoing }}</span>
                            </div>
                            <div class="progress progress--sm">
                                <div class="progress-bar kt-bg-danger" role="progressbar" style="width: 100%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>

                        <!--end::New Orders-->
                    </div>
                    <div class="col-md-12 col-lg-6 col-xl-3">

                        <!--begin::New Users-->
                        <div class="kt-widget24">
                            <div class="kt-widget24__details">
                                <div class="kt-widget24__info">
                                    <h4 class="kt-widget24__title">
                                        Jumlah Pegawai
                                    </h4>
                                    <span class="kt-widget24__desc">Pegawai Yang Tugas Dinas</span>
                                </div>
                                <span class="kt-widget24__stats kt-font-success">{{ $total_pegawai }}</span>
                            </div>
                            <div class="progress progress--sm">
                                <div class="progress-bar kt-bg-success" role="progressbar" style="width: 100%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
{{--                            <div class="kt-widget24__action">--}}
{{--													<span class="kt-widget24__change">--}}
{{--														Change--}}
{{--													</span>--}}
{{--                                <span class="kt-widget24__number">--}}
{{--														90%--}}
{{--													</span>--}}
{{--                            </div>--}}
                        </div>

                        <!--end::New Users-->
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- end:: Content -->
@endsection
