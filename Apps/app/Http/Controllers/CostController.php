<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaguRequest;
use App\Models\Cost;
use App\Models\CostType;
use App\Models\Position;
use App\Models\Type;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class CostController extends Controller
{
    public function data()
    {

        $data =  Cost::query()
            ->with(['position','type','cost_type'])
            ->latest();
        return DataTables::of($data)
            ->editColumn('biaya',function($data){
                return number_format($data->pagu);
            })
            ->editColumn('isActive',function($data){
                return ($data->is_active?'Ya':'Tidak');
            })
            ->addColumn('action',function($data){
                $edit = "<a href='".route('costs.edit',$data->id)."' class='btn btn-sm btn-clean btn-icon btn-icon-md' title='Edit Data'><i class='flaticon2-pen'></i></a>";

//                $delete = "";
//                if(auth()->user()->is_admin())
                    $delete = "<a href='javascript:;' onclick='fn_deleteData(".'"'.route('costs.destroy',$data->id).'"'.")' class='btn btn-sm btn-clean btn-icon btn-icon-md' title='Hapus Data'>
                    <i class='flaticon2-rubbish-bin'></i></a>";

                return $edit.'  '.$delete;
            })
            ->make(true);
    }

    public function index()
    {
        return view('pages.cost.index');
    }

    public function create()
    {
        $positions = Position::all();
        $types = Type::all();
        $costTypes = CostType::all();
        return view('pages.cost.create',compact('positions','types','costTypes'));
    }

    public function store(PaguRequest $request)
    {
        try {
            DB::transaction(function () use ($request){
                $cost = Cost::create(Arr::except($request->validated(),['cost_details','ada_rincian']));
                $data = [];
                if(!empty($request->cost_details) && $request->has('ada_rincian')){
                    foreach (json_decode($request->cost_details) as $detail){
                        $data[] = [
                            "nama" => $detail->nama,
                            "biaya" => $detail->biaya
                        ];
                    }
                    $cost->details()->createMany($data);
                }

            });

            alert()->error("Yeeaay !!","Data berhasil disimpan..!!");
            return redirect()->route('costs.index');
        }catch (\Exception $e){
            alert()->error("Opps !!","Data gagal disimpan..!!");
            return redirect()->back()->withInput()->withErrors($e->getMessage());
        }
    }

    public function edit(Cost $cost)
    {
        $positions = Position::all();
        $types = Type::all();
        $costTypes = CostType::all();
        return view('pages.cost.create',compact('cost','positions','types','costTypes'));
    }

    public function update(PaguRequest $request, Cost $cost)
    {
        try {
            $cost->update(Arr::except($request->validated(),['cost_details','ada_rincian']));
            $cost->details()->delete();
            $data = [];
            if(!empty($request->cost_details) && $request->has('ada_rincian')){
                foreach (json_decode($request->cost_details) as $detail){
                    $data[] = [
                        "nama" => $detail->nama,
                        "biaya" => $detail->biaya
                    ];
                }
                $cost->details()->createMany($data);
            }


            alert()->error("Yeeaay !!","Data berhasil disimpan..!!");
            return redirect()->route('costs.index');
        }catch (\Exception $e){
            alert()->error("Opps !!","Data gagal disimpan..!!");
            return redirect()->back()->withInput()->withErrors($e->getMessage());
        }
    }


    public function destroy(Cost $cost)
    {
        try {
            $cost->delete();

            return response()->json($this->deleteSuccess());
        }catch (\Exception $e){
            return response()->json($this->deleteFailed($e->getMessage()));
        }
    }
}
