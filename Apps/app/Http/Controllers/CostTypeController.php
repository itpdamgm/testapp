<?php

namespace App\Http\Controllers;

use App\Http\Requests\CostTypeRequest;
use App\Models\CostType;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CostTypeController extends Controller
{
    public function data()
    {

        $data =  CostType::query()->select('*');
        return DataTables::of($data)

            ->addColumn('action',function($data){
                $edit = "<a href='".route('cost-types.edit',$data->id)."' class='btn btn-sm btn-clean btn-icon btn-icon-md' title='Edit Data'><i class='flaticon2-pen'></i></a>";
//
//                $delete = "";
//                if(auth()->user()->is_admin())
                    $delete = "<a href='javascript:;' onclick='fn_deleteData(".'"'.route('cost-types.destroy',$data->id).'"'.")' class='btn btn-sm btn-clean btn-icon btn-icon-md' title='Hapus Data'>
                    <i class='flaticon2-rubbish-bin'></i></a>";

                return $edit.'  '.$delete;
            })
            ->make(true);
    }

    public function index()
    {
        return view('pages.cost_type.index');
    }

    public function create()
    {
        return view('pages.cost_type.create');
    }

    public function store(CostTypeRequest $request)
    {
        try {

            CostType::create($request->validated());

            alert()->error("Yeeaay !!","Data berhasil disimpan..!!");
            return redirect()->route('cost-types.index');
        }catch (\Exception $e){
            alert()->error("Opps !!","Data gagal disimpan..!!");
            return redirect()->back()->withInput()->withErrors($e->getMessage());
        }
    }

    public function edit(CostType $cost_type)
    {
        return view('pages.cost_type.create',compact('cost_type'));
    }

    public function update(CostTypeRequest $request, CostType $cost_type)
    {
        try {

            $cost_type->update($request->validated());

            alert()->error("Yeeaay !!","Data berhasil disimpan..!!");
            return redirect()->route('cost-types.index');
        }catch (\Exception $e){
            alert()->error("Opps !!","Data gagal disimpan..!!");
            return redirect()->back()->withInput()->withErrors($e->getMessage());
        }
    }


    public function destroy(CostType $cost_type)
    {
        try {
            $cost_type->delete();

            return response()->json($this->deleteSuccess());
        }catch (\Exception $e){
            return response()->json($this->deleteFailed($e->getMessage()));
        }
    }
}
