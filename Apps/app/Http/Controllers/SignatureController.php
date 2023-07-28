<?php

namespace App\Http\Controllers;

use App\Http\Requests\SignatureRequest;
use App\Models\Signature;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class SignatureController extends Controller
{
    public function data()
    {

        $data =  Signature::query()->select(['*']);
        return DataTables::of($data)

            ->addColumn('action',function($data){
                $edit = "<a href='".route('signatures.edit',$data->id)."' class='btn btn-sm btn-clean btn-icon btn-icon-md' title='Edit Data'><i class='flaticon2-pen'></i></a>";

//                $delete = "";
//                if(auth()->user()->is_admin())
                    $delete = "<a href='javascript:;' onclick='fn_deleteData(".'"'.route('signatures.destroy',$data->id).'"'.")' class='btn btn-sm btn-clean btn-icon btn-icon-md' title='Hapus Data'>
                    <i class='flaticon2-rubbish-bin'></i></a>";

                return $edit.'  '.$delete;
            })
            ->make(true);
    }

    public function index()
    {
        return view('pages.signature.index');
    }

    public function create()
    {
        return view('pages.signature.create');
    }

    public function store(SignatureRequest $request)
    {
        try {
            Signature::create($request->validated());
            alert()->error("Yeeaay !!","Data berhasil disimpan..!!");
            return redirect()->route('signatures.index');
        }catch (\Exception $e){
            alert()->error("Opps !!","Data gagal disimpan..!!");
            return redirect()->back()->withInput()->withErrors($e->getMessage());
        }
    }

    public function edit(Signature $signature)
    {

        return view('pages.signature.create',compact('signature'));
    }

    public function update(SignatureRequest $request, Signature $signature)
    {
        try {
            $signature->update($request->validated());

            alert()->error("Yeeaay !!","Data berhasil disimpan..!!");
            return redirect()->route('signatures.index');
        }catch (\Exception $e){
            alert()->error("Opps !!","Data gagal disimpan..!!");
            return redirect()->back()->withInput()->withErrors($e->getMessage());
        }
    }


    public function destroy(Signature $signature)
    {
        try {
            $signature->delete();

            return response()->json($this->deleteSuccess());
        }catch (\Exception $e){
            return response()->json($this->deleteFailed($e->getMessage()));
        }
    }
}
