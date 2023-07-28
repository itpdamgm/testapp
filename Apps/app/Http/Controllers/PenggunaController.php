<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\Pegawai;
use App\Models\User;
use App\Services\MenuServices;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PenggunaController extends Controller
{
    public function data()
    {

        $data =  User::query()->select('*');
        return DataTables::of($data)
            ->editColumn('role',function($data){
                return config('constants.role.'.$data->role);
            })
            ->addColumn('action',function($data){
                $edit = "<a href='".route('users.edit',$data->id)."' class='btn btn-sm btn-clean btn-icon btn-icon-md' title='Edit Data'><i class='flaticon2-pen'></i></a>";

                $delete = "";
                if(!$data->is_admin())
                    $delete = "<a href='javascript:;' onclick='fn_deleteData(".'"'.route('users.destroy',$data->id).'"'.")' class='btn btn-sm btn-clean btn-icon btn-icon-md' title='Hapus Data'>
                    <i class='flaticon2-rubbish-bin'></i></a>";

                return $edit.'  '.$delete;
            })
            ->make(true);
    }

    public function index()
    {
        return view('pages.pengguna.index');
    }

    public function create()
    {
        $pegawai = Pegawai::query()
            ->select(['nip','nm_pegawai'])
            ->aktif()
            ->get();
        return view('pages.pengguna.create',compact('pegawai'));
    }

    public function store(UserRequest $request)
    {
        try {
            $pegawai = explode("#",$request->pegawai);
            $permissions = MenuServices::makePermisionsData($request->selectedMenus);


            User::create([
                "nip" => $pegawai[0],
                "nama" => $pegawai[1],
                "username" => $request->username,
                "password" => $request->password,
                "permissions" => json_encode($permissions),
                "role" => $request->role
            ]);

            alert()->error("Yeeaay !!","Data berhasil disimpan..!!");
            return redirect()->route('users.index');
        }catch (\Exception $e){
            alert()->error("Opps !!","Data gagal disimpan..!!");
            return redirect()->back()->withInput()->withErrors($e->getMessage());
        }
    }

    public function edit(User $user)
    {
        $pegawai = Pegawai::query()
            ->select(['nip','nm_pegawai'])
            ->aktif()
            ->get();

        return view('pages.pengguna.create',compact('pegawai','user'));
    }

    public function update(UserRequest $request, User $user)
    {
        try {
            $pegawai = explode("#",$request->pegawai);
            $permissions = MenuServices::makePermisionsData($request->selectedMenus);

            $user->update([
                "nip" => $pegawai[0],
                "nama" => $pegawai[1],
                "username" => $request->username,
                "password" => $request->password,
                "permissions" => json_encode($permissions),
                "role" => $request->role
            ]);

            alert()->error("Yeeaay !!","Data berhasil disimpan..!!");
            return redirect()->route('users.index');
        }catch (\Exception $e){
            alert()->error("Opps !!","Data gagal disimpan..!!");
            return redirect()->back()->withInput()->withErrors($e->getMessage());
        }
    }


    public function destroy(User $user)
    {
        try {
            $user->delete();

            return response()->json($this->deleteSuccess());
        }catch (\Exception $e){
            return response()->json($this->deleteFailed($e->getMessage()));
        }
    }
}
