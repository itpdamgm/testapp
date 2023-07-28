<?php

namespace App\Http\Controllers;

use App\Http\Requests\PositionRequest;
use App\Models\Position;

use Yajra\DataTables\Facades\DataTables;

class PositionController extends Controller
{
    public function data()
    {

        $data =  Position::query()->select('*');
        return DataTables::of($data)

            ->editColumn('isInternal',function($data){
                return ($data->is_internal?'Ya':'Tidak');
            })
            ->addColumn('action',function($data){
                $edit = "<a href='".route('positions.edit',$data->id)."' class='btn btn-sm btn-clean btn-icon btn-icon-md' title='Edit Data'><i class='flaticon2-pen'></i></a>";

//                $delete = "";
//                if(auth()->user()->is_admin())
                    $delete = "<a href='javascript:;' onclick='fn_deleteData(".'"'.route('positions.destroy',$data->id).'"'.")' class='btn btn-sm btn-clean btn-icon btn-icon-md' title='Hapus Data'>
                    <i class='flaticon2-rubbish-bin'></i></a>";

                return $edit.'  '.$delete;
            })
            ->make(true);
    }

    public function index()
    {
        return view('pages.position.index');
    }

    public function create()
    {
        return view('pages.position.create');
    }

    public function store(PositionRequest $request)
    {
        try {

            Position::create($request->validated());

            alert()->error("Yeeaay !!","Data berhasil disimpan..!!");
            return redirect()->route('positions.index');
        }catch (\Exception $e){
            alert()->error("Opps !!","Data gagal disimpan..!!");
            return redirect()->back()->withInput()->withErrors($e->getMessage());
        }
    }

    public function edit(Position $position)
    {
        return view('pages.position.create',compact('position'));
    }

    public function update(PositionRequest $request, Position $position)
    {
        try {

            $position->update($request->validated());

            alert()->error("Yeeaay !!","Data berhasil disimpan..!!");
            return redirect()->route('positions.index');
        }catch (\Exception $e){
            alert()->error("Opps !!","Data gagal disimpan..!!");
            return redirect()->back()->withInput()->withErrors($e->getMessage());
        }
    }


    public function destroy(Position $position)
    {
        try {
            $position->delete();

            return response()->json($this->deleteSuccess());
        }catch (\Exception $e){
            return response()->json($this->deleteFailed($e->getMessage()));
        }
    }
}
