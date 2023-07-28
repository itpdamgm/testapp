<?php

namespace App\Http\Controllers;

use App\Http\Requests\TypeRequest;
use App\Models\Type;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class TypeController extends Controller
{
    public function data()
    {

        $data =  Type::query()->select('*');
        return DataTables::of($data)

            ->addColumn('action',function($data){
                $edit = "<a href='".route('types.edit',$data->id)."' class='btn btn-sm btn-clean btn-icon btn-icon-md' title='Edit Data'><i class='flaticon2-pen'></i></a>";

//                $delete = "";
//                if(auth()->user()->is_admin())
                    $delete = "<a href='javascript:;' onclick='fn_deleteData(".'"'.route('types.destroy',$data->id).'"'.")' class='btn btn-sm btn-clean btn-icon btn-icon-md' title='Hapus Data'>
                    <i class='flaticon2-rubbish-bin'></i></a>";

                return $edit.'  '.$delete;
            })
            ->make(true);
    }

    public function index()
    {
        return view('pages.type.index');
    }

    public function create()
    {
        return view('pages.type.create');
    }

    public function store(TypeRequest $request)
    {
        try {

            Type::create($request->validated());

            alert()->error("Yeeaay !!","Data berhasil disimpan..!!");
            return redirect()->route('types.index');
        }catch (\Exception $e){
            alert()->error("Opps !!","Data gagal disimpan..!!");
            return redirect()->back()->withInput()->withErrors($e->getMessage());
        }
    }

    public function edit(Type $type)
    {
        return view('pages.type.create',compact('type'));
    }

    public function update(TypeRequest $request, Type $type)
    {
        try {

            $type->update($request->validated());

            alert()->error("Yeeaay !!","Data berhasil disimpan..!!");
            return redirect()->route('types.index');
        }catch (\Exception $e){
            alert()->error("Opps !!","Data gagal disimpan..!!");
            return redirect()->back()->withInput()->withErrors($e->getMessage());
        }
    }


    public function destroy(Type $type)
    {
        try {
            $type->delete();

            return response()->json($this->deleteSuccess());
        }catch (\Exception $e){
            return response()->json($this->deleteFailed($e->getMessage()));
        }
    }
}
