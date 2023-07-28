<?php

namespace App\Http\Controllers;

use App\Http\Requests\RabRealisasiRequest;
use App\Models\Rab;
use App\Models\RabDetail;
use App\Models\RabRealisasi;
use App\Models\Signature;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class RabRealisasiController extends Controller
{
    public function data()
    {
        $data =  Rab::query()
            ->with(['surat_tugas_detail.surat_tugas.sppd','realisasi'])
            ->whereHas('realisasi')
            ->latest();
        return DataTables::of($data)
            ->addColumn('no_sppd',function($data){
                return $data->surat_tugas_detail->surat_tugas->sppd->nomor;
            })

            ->addColumn('tgl_rab',function($data){
                return $data->created_at->format('d F Y');

            })
            ->addColumn('tgl_realisasi',function($data){
                return $data->realisasi->created_at->format('d F Y');

            })
            ->addColumn('total',function($data){
                return number_format($data->total_rab);
            })
            ->addColumn('action',function($data){
                $edit = "<a href='".route('realisasi.edit',$data->realisasi->id)."' class='btn btn-sm btn-clean btn-icon btn-icon-md' title='Edit Data'><i class='flaticon2-pen'></i></a>";
                $show = "<a href='".route('realisasi.show',$data->realisasi->id)."' class='btn btn-sm btn-clean btn-icon btn-icon-md' title='Cetak Data'><i class='flaticon2-printer'></i></a>";
//                $delete = "";
//                if(auth()->user()->is_admin())
                    $delete = "<a href='javascript:;' onclick='fn_deleteData(".'"'.route('realisasi.destroy',$data->realisasi->id).'"'.")' class='btn btn-sm btn-clean btn-icon btn-icon-md' title='Hapus Data'>
                    <i class='flaticon2-rubbish-bin'></i></a>";

                return $show.'  '.$edit.'  '.$delete;
            })
            ->make(true);
    }

    public function index()
    {

        return view('pages.realisasi.index');
    }

    public function create()
    {
        $signatures = Signature::all();
        $rabs =  Rab::query()
            ->with(['surat_tugas_detail'])
            ->whereDoesntHave('realisasi')
            ->get();

        return view('pages.realisasi.create',compact('signatures','rabs'));
    }

    public function store(RabRealisasiRequest $request)
    {
        try {
            DB::transaction(function () use ($request){
                $realisasi = RabRealisasi::create(Arr::except($request->validated(),['details','bukti','diakui','ket_diakui'])+["user_id"=>auth()->id(),'tambahan'=>null]);
                if(!empty($request->details)){
                    foreach ($request->details as $key =>$val){
                        RabDetail::find($key)->update([
                            'realisasi'=>str_replace(",","",$val),
                            "need_prove" => isset($request->bukti[$key]),
                            "selisih_diakui" => isset($request->diakui[$key]),
                            "ket_diakui" => $request->ket_diakui[$key]??null,
                        ]);
                    }

                }else{
                    throw new \Exception('RAB Details Not Found');
                }

                if(isset($request->boarding_pass))
                    Storage::disk('public')->move('tmp/'.$request->boarding_pass,'realisasi/'.$realisasi->id.'/'.$request->boarding_pass);

                if(isset($request->tiket))
                    Storage::disk('public')->move('tmp/'.$request->tiket,'realisasi/'.$realisasi->id.'/'.$request->tiket);

                if(isset($request->invoice))
                    Storage::disk('public')->move('tmp/'.$request->invoice,'realisasi/'.$realisasi->id.'/'.$request->invoice);

                if(isset($request->swab))
                    Storage::disk('public')->move('tmp/'.$request->swab,'realisasi/'.$realisasi->id.'/'.$request->swab);

                if(isset($request->sewa_kendaraan))
                    Storage::disk('public')->move('tmp/'.$request->sewa_kendaraan,'realisasi/'.$realisasi->id.'/'.$request->sewa_kendaraan);

                if(isset($request->bahan_bakar))
                    Storage::disk('public')->move('tmp/'.$request->bahan_bakar,'realisasi/'.$realisasi->id.'/'.$request->bahan_bakar);
            });

            alert()->error("Yeeaay !!","Data berhasil disimpan..!!");
            return redirect()->route('realisasi.index');
        }catch (\Exception $e){
            alert()->error("Opps !!","Data gagal disimpan..!!");
            return redirect()->back()->withInput()->withErrors($e->getMessage());
        }
    }

    public function show(RabRealisasi $realisasi)
    {
        $signatures = Signature::all();
        $rab = $realisasi->rab->load(['surat_tugas_detail.surat_tugas.sppd']);
        return view('pages.realisasi.show', compact('rab','signatures','realisasi'));
    }

    public function edit(RabRealisasi $realisasi)
    {
        $signatures = Signature::all();
        $rabs = Rab::query()
            ->with('surat_tugas_detail')
            ->whereDoesntHave('realisasi',function ($query) use ($realisasi) {
                return $query->where('id','<>',$realisasi->id);
            })
            ->get();


        return view('pages.realisasi.create',compact('realisasi','rabs','signatures'));
    }

    public function update(RabRealisasiRequest $request,RabRealisasi $realisasi)
    {
        try {
            DB::transaction(function () use ($request,$realisasi) {

//                if($request->boarding_pass !== $realisasi->boarding_pass)
//                    Storage::disk('public')->move('tmp/'.$request->boarding_pass,'realisasi/'.$realisasi->id.'/'.$request->boarding_pass);
//
//                if($request->tiket !== $realisasi->tiket)
//                    Storage::disk('public')->move('tmp/'.$request->tiket,'realisasi/'.$realisasi->id.'/'.$request->tiket);
//
//                if($request->invoice !== $realisasi->invoice)
//                    Storage::disk('public')->move('tmp/'.$request->invoice,'realisasi/'.$realisasi->id.'/'.$request->invoice);
//
//                if($request->swab !== $realisasi->swab)
//                    Storage::disk('public')->move('tmp/'.$request->swab,'realisasi/'.$realisasi->id.'/'.$request->swab);
//
//                if($request->sewa_kendaraan !== $realisasi->sewa_kendaraan)
//                    Storage::disk('public')->move('tmp/'.$request->sewa_kendaraan,'realisasi/'.$realisasi->id.'/'.$request->sewa_kendaraan);
//
//                if($request->bahan_bakar !== $realisasi->bahan_bakar)
//                    Storage::disk('public')->move('tmp/'.$request->bahan_bakar,'realisasi/'.$realisasi->id.'/'.$request->bahan_bakar);

                $realisasi->update(Arr::except($request->validated(),['details','bukti','diakui','ket_diakui'])+["user_id"=>auth()->id(),'tambahan'=>null]);
                if(!empty($request->details)){
                    foreach ($request->details as $key =>$val){
                        RabDetail::find($key)->update([
                            'realisasi'=>str_replace(",","",$val),
                            "need_prove" => isset($request->bukti[$key]),
                            "selisih_diakui" => isset($request->diakui[$key]),
                            "ket_diakui" => $request->ket_diakui[$key] ?? null,
                        ]);
                    }

                }else{
                    throw new \Exception('RAB Details Not Found');
                }


            });


            alert()->error("Yeeaay !!","Data berhasil disimpan..!!");
            return redirect()->route('realisasi.index');
        }catch (\Exception $e){
            alert()->error("Opps !!","Data gagal disimpan..!!");
            return redirect()->back()->withInput()->withErrors($e->getMessage());
        }
    }

    public function destroy(RabRealisasi $realisasi)
    {
        try {
            $id = $realisasi->id;
            DB::transaction(function () use ($realisasi) {
                RabDetail::where('rab_id',$realisasi->rab_id)->update(['realisasi'=>null]);
                $realisasi->delete();
            });
            Storage::disk('public')->deleteDirectory('realisasi/'.$id);

            return response()->json($this->deleteSuccess());
        }catch (\Exception $e){
            return response()->json($this->deleteFailed($e->getMessage()));
        }
    }}
