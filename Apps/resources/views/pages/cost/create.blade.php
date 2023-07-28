@extends('layouts.app')

@section('title','Biaya')

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
                    <a href="{{ route('costs.index') }}" class="kt-subheader__breadcrumbs-link">Biaya - Biaya </a>
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
                        <i class="kt-font-brand fa fa-money-bill-wave"></i>
                    </span>
                    <h3 class="kt-portlet__head-title">
                        BIAYA - BIAYA
                    </h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                    <div class="kt-portlet__head-wrapper">
                        <div class="kt-portlet__head-actions">

                            <a href="{{ route('costs.index') }}" class="btn btn-danger btn-elevate btn-icon-sm">
                                <i class="la la-times"></i>
                                Kembali
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @php $requestName  = request()->route()->getName(); @endphp
            <form action="{{ ($requestName=='costs.create' ? route('costs.store') : route('costs.update',$cost->id)) }}" novalidate="novalidate" method="post">
                @csrf
                @method(($requestName=='costs.create' ?'POST' : 'PUT'))
            <div class="kt-portlet__body">
                <div class="row">
                    <div class="col-lg-2 col-md-2 col-sm-12 form-group">
                        <label class="form-control-label">Tahun SK : </label>
                        <input type="number" name="sk_tahun" class="form-control @error('sk_tahun') is-invalid @enderror" placeholder=""
                               value="{{ old('sk_tahun',$cost->sk_tahun??now()->format('Y')) }}" required step="1">
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                        <label class="form-control-label">Nama Biaya : </label>
                        <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" placeholder=""
                               value="{{ old('nama',$cost->nama??'') }}" required>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12 form-group">
                        <label class="form-control-label">Jenis Biaya : </label>
                        <select name="cost_type_id" id="cost_type_id" class="form-control @error('is_active') is-invalid @enderror" required>
                            <option value="" ></option>
                            @forelse($costTypes as $costType)
                                <option value="{{$costType->id}}" {{ old('cost_type_id',$cost->cost_type_id??'')==$costType->id ? 'selected' : '' }}>
                                    {{ $costType->nama }}
                                </option>
                            @empty
                            @endforelse

                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-4 col-sm-12 form-group">
                        <label class="form-control-label">Level Jabatan : </label>
                        <select name="position_id" id="position_id" class="form-control @error('position_id') is-invalid @enderror">
                            <option value="" ></option>
                            @forelse($positions as $position)
                                <option value="{{ $position->id }}" {{ old('position_id',$cost->position_id??'')==$position->id ? 'selected' : '' }}>
                                    {{ $position->nama }}
                                </option>
                            @empty
                            @endforelse
                        </select>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12 form-group">
                        <label class="form-control-label">Tipe Perjalanan : </label>
                        <select name="type_id" id="type_id" class="form-control @error('type_id') is-invalid @enderror">
                            <option value="" ></option>
                            @forelse($types as $type)
                                <option value="{{ $type->id }}" {{ old('type_id',$cost->type_id??'')==$type->id ? 'selected' : '' }}>
                                    {{ $type->nama }}
                                </option>
                            @empty
                            @endforelse
                        </select>
                    </div>
                    <div class="col-lg-2 col-md-4 col-sm-12 form-group">
                        <label class="form-control-label">Biaya : </label>
                        <input type="text" name="pagu" id="pagu" class="form-control rupiah @error('pagu') is-invalid @enderror" placeholder=""
                               value="{{ old('pagu',$cost->pagu??'0') }}" required @if(isset($cost) && count($cost->details)>0) readonly @endif>
                    </div>
                </div>
                <div class="row">
                    @livewire('cost-details',[
                         "costDetails" => old('cost_details',$cost->details??[])
                    ])

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
        $(".select2").select2();
        $(".rupiah").inputmask({
            alias : 'decimal',
            autoUnmask: true,
            groupSeparator: ",",
            radixPoint: ".",
            autoGroup: true,
        });
        Livewire.on('adaRincian',(data) => {
            let pagu = document.getElementById('pagu');
            let biaya = document.getElementById('biaya');
            if(data.rincian){
                pagu.readOnly = true;
                pagu.value = data.total_biaya;
                biaya.readOnly = false;
                biaya.value = 0;
            }else{
                pagu.readOnly = false;
                pagu.value = 0;
                biaya.readOnly = true;
                biaya.value = 0;
            }
        });


    </script>
@endpush
