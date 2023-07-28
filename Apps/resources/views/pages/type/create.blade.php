@extends('layouts.app')
@section('title','Jenis Perjalanan')
@section('content')
    <!-- begin:: Content Head -->
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">
                    SETTINGS </h3>
                <span class="kt-subheader__separator kt-hidden"></span>
                <div class="kt-subheader__breadcrumbs">
                    <a href="javascript:;" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-right-arrow"></i></a>
                    {{--                    <span class="kt-subheader__breadcrumbs-separator"></span>--}}
                    <a href="{{ route('types.index') }}" class="kt-subheader__breadcrumbs-link">Jenis Perjalanan </a>
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
                        <i class="kt-font-brand fa fa-map-signs"></i>
                    </span>
                    <h3 class="kt-portlet__head-title">
                        JENIS PERJALANAN
                    </h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                    <div class="kt-portlet__head-wrapper">
                        <div class="kt-portlet__head-actions">

                            <a href="{{ route('types.index') }}" class="btn btn-danger btn-elevate btn-icon-sm">
                                <i class="la la-times"></i>
                                Kembali
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @php $requestName  = request()->route()->getName(); @endphp
            <form action="{{ ($requestName=='types.create' ? route('types.store') : route('types.update',$type->id)) }}" novalidate="novalidate" method="post">
                @csrf
                @method(($requestName=='types.create' ?'POST' : 'PUT'))
            <div class="kt-portlet__body">
                <div class="row">
                    <div class="col-lg-12 form-group">
                        <label class="form-control-label">Nama Jenis Perjalanan : </label>
                        <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" placeholder=""
                               value="{{ old('nama',$type->nama??'') }}" required>
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
    @livewireScripts
    <script>
        $(".select2").select2();
    </script>
@endpush
