<?php

namespace App\Http\Controllers;

use App\Http\Requests\SuratTugasRequest;
use App\Models\Signature;
use App\Models\SuratTugas;
use App\Models\SuratTugasDetail;
use App\Services\SuratTugasServices;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class SuratTugasController extends Controller
{
    public function data()
    {

        $data =  SuratTugas::query()
            ->with('surat_tugas_details')
            ->select('*')->latest();

        return DataTables::of($data)
            ->editColumn('tanggal', function ($data){
                return $data->tanggal->format('d-m-Y');
            })
            ->addColumn('action',function($data){
                $edit = "<a href='".route('surat-tugas.edit',$data->id)."' class='btn btn-sm btn-clean btn-icon btn-icon-md' title='Edit Data'><i class='flaticon2-pen'></i></a>";
                $show = "<a href='".route('surat-tugas.show',$data->id)."' class='btn btn-sm btn-clean btn-icon btn-icon-md' title='Cetak Data'><i class='flaticon2-printer'></i></a>";
                $add = "<a href='".route('surat-tugas.add-pegawai.index',$data->id)."' class='btn btn-sm btn-clean btn-icon btn-icon-md' title='Add Pegawai'><i class='flaticon2-add'></i></a>";
//                $delete = "";
//                if(auth()->user()->is_admin())
                    $delete = "<a href='javascript:;' onclick='fn_deleteData(".'"'.route('surat-tugas.destroy',$data->id).'"'.")' class='btn btn-sm btn-clean btn-icon btn-icon-md' title='Hapus Data'>
                    <i class='flaticon2-rubbish-bin'></i></a>";

                return $add.'  '.$show.'  '.$edit.'  '.$delete;
            })
            ->make(true);
    }

    public function index()
    {
        return view('pages.surat_tugas.index');
    }

    public function create()
    {
        $signatures = Signature::all();
        return view('pages.surat_tugas.create',compact('signatures'));
    }

    public function store(SuratTugasRequest $request)
    {
        try {
            DB::transaction(function () use ($request){
                SuratTugas::create($request->validated()+["user_id"=>auth()->id()]);

            });

            alert()->error("Yeeaay !!","Data berhasil disimpan..!!");
            return redirect()->route('surat-tugas.index');
        }catch (\Exception $e){
            alert()->error("Opps !!","Data gagal disimpan..!!");
            return redirect()->back()->withInput()->withErrors($e->getMessage());
        }
    }

    public function edit($id)
    {
        $suratTugas = SuratTugas::findOrFail($id);
        $signatures = Signature::all();
        return view('pages.surat_tugas.create',compact('suratTugas','signatures'));
    }

    public function show($id)
    {
        $suratTugas = SuratTugas::findOrFail($id);
        $suratTugas->load('surat_tugas_details');
        $signatures = Signature::all();
        return view('pages.surat_tugas.show',compact('suratTugas','signatures'));
    }

    public function update(SuratTugasRequest $request, $id)
    {
        try {
            DB::transaction(function () use ($request,$id){

                $suratTugas = SuratTugas::findOrFail($id);
                $suratTugas->update($request->validated()+["user_id"=>auth()->id()]);

            });
            alert()->error("Yeeaay !!","Data berhasil disimpan..!!");
            return redirect()->route('surat-tugas.index');
        }catch (\Exception $e){
            alert()->error("Opps !!","Data gagal disimpan..!!");
            return redirect()->back()->withInput()->withErrors($e->getMessage());
        }
    }


    public function destroy($id)
    {
        try {
            $suratTugas = SuratTugas::findOrFail($id);
            $suratTugas->delete();

            return response()->json($this->deleteSuccess());
        }catch (\Exception $e){
            return response()->json($this->deleteFailed($e->getMessage()));
        }
    }

    public function add_pegawai($id)
    {
        $suratTugas = SuratTugas::query()
            ->with('surat_tugas_details')
            ->where('id',$id)
            ->firstOrFail();
        return view('pages.surat_tugas.details',compact('suratTugas'));
    }

}
