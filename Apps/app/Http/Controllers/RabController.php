<?php

namespace App\Http\Controllers;

use App\Http\Requests\RabRequest;
use App\Models\Position;
use App\Models\Rab;
use App\Models\Signature;
use App\Models\SuratTugasDetail;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class RabController extends Controller
{
    public function data()
    {
        $data =  Rab::query()
            ->with(['position','type','surat_tugas_detail.surat_tugas.sppd'])
            ->latest();
        return DataTables::of($data)
            ->addColumn('no_sppd',function($data){
                $sppd = $data->surat_tugas_detail->surat_tugas->sppd;

                return $sppd->nomor??'';
            })
            ->addColumn('total',function($data){
                return number_format($data->total_rab);
            })
            ->addColumn('maksud',function($data){
                $sppd = $data->surat_tugas_detail->surat_tugas->sppd;

                return $sppd->maksud??'';
            })
            ->addColumn('action',function($data){
                $edit = "<a href='".route('rab.edit',$data->id)."' class='btn btn-sm btn-clean btn-icon btn-icon-md' title='Edit Data'><i class='flaticon2-pen'></i></a>";
                $show = "<a href='".route('rab.show',$data->id)."' class='btn btn-sm btn-clean btn-icon btn-icon-md' title='Cetak Data'><i class='flaticon2-printer'></i></a>";
//                $delete = "";
//                if(auth()->user()->is_admin())
                    $delete = "<a href='javascript:;' onclick='fn_deleteData(".'"'.route('rab.destroy',$data->id).'"'.")' class='btn btn-sm btn-clean btn-icon btn-icon-md' title='Hapus Data'>
                    <i class='flaticon2-rubbish-bin'></i></a>";

                return $show.'  '.$edit.'  '.$delete;
            })
            ->make(true);
    }

    public function index()
    {

        return view('pages.rab.index');
    }

    public function create()
    {
        $signatures = Signature::all();
        $suratTugasDetails = SuratTugasDetail::query()
            ->with('surat_tugas')
            ->whereDoesntHave('rab')
            ->get();

        $types = Type::all();
        $positions = Position::all();

        return view('pages.rab.create',compact('suratTugasDetails','positions','types','signatures'));
    }

    public function store(RabRequest $request)
    {
        try {
            DB::transaction(function () use ($request){
                $data = [];
                $total_rab = 0;
                if(!empty($request->rab_details)){
                    foreach (json_decode($request->rab_details) as $det){
                        $data[] = [
                            "cost_id" => $det->cost_id,
                            "nama_biaya" => $det->nama,
                            "satuan" => $det->satuan,
                            "qty" => $det->qty,
                            "biaya" => $det->biaya
                        ];
                        $total_rab += $det->sub_total;
                    }

                    $rab = Rab::create(Arr::except($request->validated(),'rab_details')+["user_id"=>auth()->id(),'total_rab'=>$total_rab]);
                    $rab->rab_details()->createMany($data);
                }else{
                    throw new \Exception('RAB Details Not Found');
                }

            });

            alert()->error("Yeeaay !!","Data berhasil disimpan..!!");
            return redirect()->route('rab.index');
        }catch (\Exception $e){
            alert()->error("Opps !!","Data gagal disimpan..!!");
            return redirect()->back()->withInput()->withErrors($e->getMessage());
        }
    }

    public function show(Rab $rab)
    {
        $sppd = $rab->surat_tugas_detail->surat_tugas->sppd;
        $signatures = Signature::all();
        return view('pages.rab.show',compact('rab','sppd','signatures'));
    }

    public function edit(Rab $rab)
    {
        $signatures = Signature::all();
        $suratTugasDetails = SuratTugasDetail::query()
            ->with('surat_tugas')
            ->whereDoesntHave('rab',function ($query) use ($rab) {
                return $query->where('id','<>',$rab->id);
            })
            ->get();

        $types = Type::all();
        $positions = Position::all();

        return view('pages.rab.create',compact('suratTugasDetails','positions','types','rab','signatures'));
    }

    public function update(RabRequest $request,Rab $rab)
    {
        try {
            DB::transaction(function () use ($request,$rab) {
                $data = [];
                $total_rab = 0;
                if (!empty($request->rab_details)) {
                    foreach (json_decode($request->rab_details) as $det){
                        $data[] = [
                            "cost_id" => $det->cost_id,
                            "nama_biaya" => $det->nama,
                            "satuan" => $det->satuan,
                            "qty" => $det->qty,
                            "biaya" => $det->biaya
                        ];
                        $total_rab += $det->sub_total;
                    }
                    $rab->update(Arr::except($request->validated(), 'rab_details') + ["user_id" => auth()->id(),'total_rab'=>$total_rab]);
                    $rab->rab_details()->delete();
                    $rab->rab_details()->createMany($data);
                } else {
                    throw new \Exception('RAB Details Not Found');
                }

            });
            alert()->error("Yeeaay !!","Data berhasil disimpan..!!");
            return redirect()->route('rab.index');
        }catch (\Exception $e){
            alert()->error("Opps !!","Data gagal disimpan..!!");
            return redirect()->back()->withInput()->withErrors($e->getMessage());
        }
    }

    public function destroy(Rab $rab)
    {
        try {
            $rab->delete();

            return response()->json($this->deleteSuccess());
        }catch (\Exception $e){
            return response()->json($this->deleteFailed($e->getMessage()));
        }
    }
}
