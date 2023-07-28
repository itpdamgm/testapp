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
                    <a href="javascript:;" class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">SPPD</a>
{{--                    <span class="kt-subheader__breadcrumbs-separator"></span>--}}
{{--                    <span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Active link</span>--}}
                </div>
            </div>

        </div>
    </div>

    <!-- end:: Content Head -->

    <!-- begin:: Content -->
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">

        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head kt-portlet__head--lg">
                <div class="kt-portlet__head-label">
                    <span class="kt-portlet__head-icon">
                        <i class="kt-font-brand fa fa-tasks"></i>
                    </span>
                    <h3 class="kt-portlet__head-title">
                        SURAT PERINTAH PERJALANAN TUGAS
                    </h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                    <div class="kt-portlet__head-wrapper">
                        <div class="kt-portlet__head-actions">

                            <a href="{{ route('sppd.create') }}" class="btn btn-brand btn-elevate btn-icon-sm">
                                <i class="la la-plus"></i>
                                New Record
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="kt-portlet__body">
                <table class="table table-bordered table-striped" id="dataTable">
                    <thead>
                        <tr>
                            <th style="width: 5%;">#</th>
                            <th style="width: 10%">Nomor</th>
                            <th>Maksud Perjalanan</th>
                            <th style="width: 5%">Tgl Berangkat</th>
                            <th style="width: 5%">Tgl Kembali</th>
                            <th style="width: 5%">Lama</th>
                            <th style="width: 15%">Action</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- end:: Content -->
@endsection

@push('css')
    <link href="{{ asset('plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
@endpush

@push('scripts')
    <!--begin::Page Vendors(used by this page) -->
    <script src="{{ asset('plugins/custom/datatables/datatables.bundle.js') }}" type="text/javascript"></script>

    <!--end::Page Vendors -->
    @include('includes.swal-delete')
    <script>
        $('#dataTable').DataTable({
            language:{
                "info": "Data _START_ sampai _END_ dari _TOTAL_ data.",
            },
            processing: true,
            serverSide: true,
            responsive:true,
            lengthChange:false,
            ajax: '{!! route('sppd.data') !!}',
            columns: [
                { data: 'id', name: 'id',render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                { data: 'nomor', name: 'nomor' },
                { data: 'maksud', name: 'maksud' },
                { data: 'tglBerangkat', name: 'tgl_berangkat' },
                { data: 'tglKembali', name: 'tgl_kembali' },
                { data: 'lamaHari', name: 'lama_hari' },
                { data: 'action', name: 'action' }
            ],
            render: function (data, type, row, meta) {
                return meta.row + meta.settings._iDisplayStart + 1;
            }
        });
    </script>
@endpush
