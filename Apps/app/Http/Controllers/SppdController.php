<?php

namespace App\Http\Controllers;

use App\Http\Requests\SppdRequest;
use App\Models\Signature;
use App\Models\Sppd;
use App\Models\SuratTugas;
use App\Models\SuratTugasDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class SppdController extends Controller
{
    public function data()
    {
        $data =  Sppd::query()
            ->latest();
        return DataTables::of($data)
            ->addColumn('lamaHari',function ($data){
                return $data->lama_hari.' Hari';
            })
            ->addColumn('tglBerangkat',function ($data){
                return $data->tgl_berangkat->format('d-m-Y');
            })
            ->addColumn('tglKembali',function ($data){
                return $data->tgl_kembali->format('d-m-Y');
            })
            ->addColumn('action',function($data){
                $edit = "<a href='".route('sppd.edit',$data->id)."' class='btn btn-sm btn-clean btn-icon btn-icon-md' title='Edit Data'><i class='flaticon2-pen'></i></a>";
                $show = "<a href='".route('sppd.show',$data->id)."' class='btn btn-sm btn-clean btn-icon btn-icon-md' title='Cetak Data'><i class='flaticon2-printer'></i></a>";
//                $delete = "";
//                if(auth()->user()->is_admin())
                    $delete = "<a href='javascript:;' onclick='fn_deleteData(".'"'.route('sppd.destroy',$data->id).'"'.")' class='btn btn-sm btn-clean btn-icon btn-icon-md' title='Hapus Data'>
                    <i class='flaticon2-rubbish-bin'></i></a>";

                return $show.'  '.$edit.'  '.$delete;
            })
            ->make(true);
    }

    public function index()
    {
        return view('pages.sppd.index');
    }

    public function create()
    {
        $suratTugas = SuratTugas::query()
            ->whereDoesntHave('sppd')
            ->get();
        $signatures = Signature::all();
        return view('pages.sppd.create',compact('suratTugas','signatures'));
    }

    public function store(SppdRequest $request)
    {
        try {
            DB::transaction(function () use ($request){
                $sppd = Sppd::create(Arr::except($request->validated(),['rute','pengikut','ada_pengikut'])+["user_id"=>auth()->id()]);
                $data = [];
                if(!empty($request->pengikut) && $request->has('ada_pengikut')){
                    foreach (json_decode($request->pengikut) as $pengikut){
                        $data[] = [
                            "nama" => $pengikut->nama,
                            "umur" => $pengikut->umur,
                            "keterangan" => $pengikut->keterangan,
                        ];
                    }
                    $sppd->pengikut()->createMany($data);
                }

                $dataRute = [];
                if(!is_null($request->rute)){
                    foreach (json_decode($request->rute) as $rute){
                        $dataRute[] = [
                            "tiba_di" => $rute->tiba_di,
                            "tgl_tiba" => $rute->tgl_tiba,
                            "berangkat_dari" => $rute->berangkat_dari,
                            "tujuan" => $rute->tujuan,
                            "tgl_berangkat" => $rute->tgl_berangkat,
                        ];
                    }
                    $sppd->sppd_details()->createMany($dataRute);
                }

            });

            alert()->error("Yeeaay !!","Data berhasil disimpan..!!");
            return redirect()->route('sppd.index');
        }catch (\Exception $e){
            alert()->error("Opps !!","Data gagal disimpan..!!");
            return redirect()->back()->withInput()->withErrors($e->getMessage());
        }
    }

    public function show(Sppd $sppd)
    {
        return view('pages.sppd.show',compact('sppd'));
    }

    public function edit(Sppd $sppd)
    {
        $suratTugas = SuratTugas::query()
            ->whereDoesntHave('sppd',function ($query) use ($sppd) {
                return $query->where('id','<>',$sppd->id);
            })
            ->get();
        $signatures = Signature::all();

        return view('pages.sppd.create',compact('suratTugas','sppd','signatures'));
    }

    public function update(SppdRequest $request,Sppd $sppd)
    {
        try {
            DB::transaction(function () use ($request,$sppd){
                $sppd->update(Arr::except($request->validated(),['rute','pengikut','ada_pengikut'])+["user_id"=>auth()->id()]);
                $data = [];
                if(!empty($request->pengikut) && $request->has('ada_pengikut')){
                    foreach (json_decode($request->pengikut) as $pengikut){
                        $data[] = [
                            "nama" => $pengikut->nama,
                            "umur" => $pengikut->umur,
                            "keterangan" => $pengikut->keterangan,
                        ];
                    }
                    $sppd->pengikut()->delete();
                    $sppd->pengikut()->createMany($data);
                }

                $dataRute = [];
                if(!is_null($request->rute)){
                    foreach (json_decode($request->rute) as $rute){
                        $dataRute[] = [
                            "tiba_di" => $rute->tiba_di,
                            "tgl_tiba" => $rute->tgl_tiba,
                            "berangkat_dari" => $rute->berangkat_dari,
                            "tujuan" => $rute->tujuan,
                            "tgl_berangkat" => $rute->tgl_berangkat,
                        ];
                    }
                    $sppd->sppd_details()->delete();
                    $sppd->sppd_details()->createMany($dataRute);
                }

            });

            alert()->error("Yeeaay !!","Data berhasil disimpan..!!");
            return redirect()->route('sppd.index');
        }catch (\Exception $e){
            alert()->error("Opps !!","Data gagal disimpan..!!");
            return redirect()->back()->withInput()->withErrors($e->getMessage());
        }
    }

    public function destroy(Sppd $sppd)
    {
        try {
            $sppd->delete();

            return response()->json($this->deleteSuccess());
        }catch (\Exception $e){
            return response()->json($this->deleteFailed($e->getMessage()));
        }
    }

    public function print(Sppd $sppd,SuratTugasDetail $detail)
    {
        $signatures = Signature::all();
        return view('pages.sppd.print',compact('detail','sppd','signatures'));
    }
}
