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
                        RENCANA ANGGARAN BIAYA
                    </h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                    <div class="kt-portlet__head-wrapper">
                        <div class="kt-portlet__head-actions">

                            <a href="{{ route('rab.index') }}" class="btn btn-danger btn-elevate btn-icon-sm">
                                <i class="la la-times"></i>
                                Kembali
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @php $requestName  = request()->route()->getName(); @endphp
            <form action="{{ ($requestName=='rab.create' ? route('rab.store') : route('rab.update',$rab->id)) }}" novalidate="novalidate" method="post">
                @csrf
                @method(($requestName=='rab.create' ?'POST' : 'PUT'))
            <div class="kt-portlet__body">
                <div class="row">
                    <div class="col-lg-9 col-md-8 col-sm-12 form-group">
                        <label class="form-control-label">Pegawai yang ditugaskan : </label>
                        <select name="surat_tugas_detail_id" id="surat_tugas_detail_id" class="form-control select2 @error('surat_tugas_detail_id') is-invalid @enderror" required>
                            <option value="" data-position= "">-- Pilih Pegawai --</option>
                            @forelse($suratTugasDetails as $st)
                                <option value="{{ $st->id }}" {{ old('surat_tugas_detail_id',$rab->surat_tugas_detail_id??'')==$st->id ?' selected' : '' }} data-position= "{{ $st->position_id }}">
                                    [{{ $st->surat_tugas->nomor }}] - {{ $st->nip }} {{ $st->nama }}
                                </option>
                            @empty
                            @endforelse
                        </select>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-12 form-group">
                        <label class="form-control-label">Nomor RAB : </label>
                        <input type="text" name="nomor" class="form-control @error('nomor') is-invalid @enderror" placeholder=""
                               value="{{ old('nomor',$rab->nomor??'RAB-'.time()) }}" required readonly>
                    </div>
                    <div class="col-lg-6 col-md-12 col-sm-12 form-group">
                        <label class="form-control-label">Judul RAB : </label>
                        <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" placeholder=""
                               value="{{ old('nama',$rab->nama??'') }}" required>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 form-group">
                        <label class="form-control-label">Tipe Perjalanan : </label>
                        <select name="type_id" id="type_id" class="form-control @error('type_id') is-invalid @enderror" required>
                            <option value="">-- Pilih Tipe --</option>
                            @forelse($types as $type)
                                <option value="{{ $type->id }}" {{ old('type_id',$rab->type_id??'')==$type->id ?' selected' : '' }}>
                                    {{ $type->nama }}
                                </option>
                            @empty
                            @endforelse
                        </select>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 form-group">
                        <label class="form-control-label">Level Jabatan : </label>
                        <select name="position_id" id="position_id" class="form-control @error('position_id') is-invalid @enderror" required>
                            <option value="">-- Pilih Level --</option>
                            @forelse($positions as $position)
                                <option value="{{ $position->id }}" {{ old('position_id',$rab->position_id??'')==$position->id ?' selected' : '' }}>
                                    {{ $position->nama }}
                                </option>
                            @empty
                            @endforelse
                        </select>
                    </div>

                    @livewire('rincian-biaya-sppd',[
                             "rabDetails" => old('rab_details',(isset($rab) ? $rab->load('rab_details.cost')->rab_details:[])),
                             "type_id" => old('type_id',$rab->type_id??''),
                             "position_id" => old('position_id',$rab->position_id??''),
                        ])

                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-sm-12 form-group">
                        <label class="form-control-label">Disetujui: </label>
                        <select name="disetujui" id="disetujui" class="form-control @error('disetujui') is-invalid @enderror" required>
                            <option value="">-- Pilih Pejabat --</option>
                            @forelse($signatures as $signature)
                                <option value="{{ $signature->nama }}" {{ old('disetujui',$rab->disetujui??'')==$signature->nama ?' selected' : '' }}>
                                    {{ $signature->nama }}
                                </option>
                            @empty
                            @endforelse
                        </select>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 form-group">
                        <label class="form-control-label">Diperiksa: </label>
                        <select name="diperiksa" id="diperiksa" class="form-control @error('diperiksa') is-invalid @enderror" required>
                            <option value="">-- Pilih Pejabat --</option>
                            @forelse($signatures as $signature)
                                <option value="{{ $signature->nama }}" {{ old('diperiksa',$rab->diperiksa??'')==$signature->nama ?' selected' : '' }}>
                                    {{ $signature->nama }}
                                </option>
                            @empty
                            @endforelse
                        </select>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 form-group">
                        <label class="form-control-label">Pembuat: </label>
                        <select name="pembuat" id="pembuat" class="form-control @error('pembuat') is-invalid @enderror" required>
                            <option value="">-- Pilih Pejabat --</option>
                            @forelse($signatures as $signature)
                                <option value="{{ $signature->nama }}" {{ old('pembuat',$rab->pembuat??'')==$signature->nama ?' selected' : '' }}>
                                    {{ $signature->nama }}
                                </option>
                            @empty
                            @endforelse
                        </select>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 form-group">
                        <label class="form-control-label">Menyerahkan: </label>
                        <select name="menyerahkan" id="menyerahkan" class="form-control @error('menyerahkan') is-invalid @enderror" required>
                            <option value="">-- Pilih Pejabat --</option>
                            @forelse($signatures as $signature)
                                <option value="{{ $signature->nama }}" {{ old('menyerahkan',$rab->menyerahkan??'')==$signature->nama ?' selected' : '' }}>
                                    {{ $signature->nama }}
                                </option>
                            @empty
                            @endforelse
                        </select>
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
    <script>
        $(".rupiah").inputmask({
            alias : 'decimal',
            autoUnmask: true,
            groupSeparator: ",",
            radixPoint: ".",
            autoGroup: true,
        });

        $(".datepick").datepicker({
            format: "dd-mm-yyyy",
            language: "id",
            autoclose: true,
            todayHighlight: true
        })

        $(".select2").select2();
        $("#cost_id").select2();

        $("#surat_tugas_detail_id").on('change',function (e){
            $level_jab = $(this).find(':selected').data('position');

            $("#position_id").val($level_jab);
            $("#position_id").trigger('change');
        })

    </script>
@endpush
