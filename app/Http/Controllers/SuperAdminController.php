<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Alert;
use Illuminate\Support\Facades\Auth;
use Session;
use Illuminate\Support\Facades\Crypt;
use App\User;
use Maatwebsite\Excel\Facades\Excel;
use Hash;
use App\AuthGroupPermission;
use App\AuthPermission;
use App\AuthGroup;
use App\MasterHelpdeskModel;

class SuperAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function master_user()
    {
        $user = DB::table('users')
                ->select('users.name as nama_user', 'users.username', 'departments.name as nama_dept', 'auth_group.name as nama_auth', 'users.id')
                ->join('auth_group', 'auth_group.id', '=', 'users.auth_group_id')
                ->join('departments', 'departments.id', '=', 'users.dept_id')
                ->get();

        $dept = DB::table('departments')->orderBy('name')->get();
        $auth_group = DB::table('auth_group')->orderBy('name')->get();

        return view('super_admin.master_user', compact('user', 'dept', 'auth_group'));
    }

    public function master_dept()
    {
        $dept = DB::table('departments')->orderBy("name", "ASC")
                ->get();

        return view('super_admin.master_dept', compact('dept'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
     
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

           User::insert([
            'name' => $request->name,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'dept_id' => $request->dept,
            'email' => $request->email,
            'kode_area' => $request->kode_area,
            'auth_group_id' => $request->auth_group_id,
        ]);
        
        $auth       = AuthGroup::find($request->auth_group_id);
        $permission = AuthPermission::where('codename', $auth->name)->first();

        AuthGroupPermission::insert([
            'group_id' => $auth->id,
            'permission_id' => $permission->id,
        ]);

        Session::flash('info', 'User Berhasil Di Buat..');
        return back();
    }
    public function add_dept(Request $request)
    {

           DB::table('departments')->insert([
            'name' => $request->name,
        ]);

        Session::flash('info', 'Dept Berhasil Di Buat..');
        return back();
    }

    public function master_gangguan()
    {
        $data = DB::table('master_gangguan')
                    ->select('master_gangguan.id', 
                            'master_gangguan_solved.penanganan', 
                            'master_gangguan.kode_gangguan',
                            'master_gangguan.deskripsi'
                            )
                    ->join('master_gangguan_solved', 'master_gangguan.kode_gangguan', '=', 'master_gangguan_solved.kode_gangguan');

        $sub = $data->get();

        $data = $data->groupBy('kode_gangguan')->get();

        return view('super_admin.master_gangguan', compact('data', 'sub'));
    }

    public function cari_penanganan($kode_gangguan)
    {
        $data = DB::table('master_gangguan_solved')
                    ->where('kode_gangguan', $kode_gangguan)
                    ->get();
        return response()->json(['status' => 1, 'data' => $data]);  
    }

    public function hapus_gangguan($kode_gangguan)
    {
        $data = DB::table('master_gangguan')
                    ->where('kode_gangguan', $kode_gangguan)
                    ->delete();

        $data = DB::table('master_gangguan_solved')
                    ->where('kode_gangguan', $kode_gangguan)
                    ->delete();

    Session::flash('success', 'User Berhasil Di Update..');
    return back();
    }

    public function add_gangguan(Request $request)
    {
         $data = DB::table('master_gangguan')
                    ->orderBy('id', 'DESC')
                    ->first();
            if($data->deskripsi == $request->deskripsi)
            {
                Session::flash('error', 'Master Gangguan Yang Kamu Masukan Sudah Ada..');
                return back();
            }
            $nomer = (int)$data->id + 1;

            DB::table('master_gangguan')
                ->insert([
                    'kode_gangguan' => 'G'.$nomer,
                    'deskripsi' => $request->deskripsi,
                ]);

        for($i = 0; $i < count($request->penanganan); $i++)
        {
            DB::table('master_gangguan_solved')
                        ->insert([
                            'kode_gangguan' =>'G'.$nomer,
                            'penanganan' => $request->penanganan[$i],
                        ]);
        }
            Session::flash('info', 'Data Berhasil Di Simpan..');
            return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data =  DB::table('users')
                ->where('users.id', $id)
                ->select('users.name as nama_user', 'departments.name as dept_name', 'departments.id as id_dept', 'users.id', 'users.email', 'users.username', 'users.password')
                ->join('departments', 'departments.id', '=', 'users.dept_id')
                ->first();

        $dept = DB::table('departments')->orderBy('name')->get();
        $auth_group = DB::table('auth_group')->orderBy('name')->get();

        return view('super_admin.edit_user', compact('data', 'dept', 'auth_group'));
    }

    public function update_user(Request $request, $id)
    {
        User::where('id', $id)->update([
            'name' => $request->name,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'auth_group_id' => $request->auth_group_id,
            'dept_id' => $request->dept,
            'email' => $request->email,
            'auth_group_id' => $request->auth_group_id,
            'kode_area' => $request->kode_area,
        ]);

        Session::flash('success', 'User Berhasil Di Update..');
        return redirect('/super_admin/master_user');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dept = DB::table('users')->where('id', $id)->delete();

        Session::flash('success', 'User Berhasil Di Hapus..');
        return back();
    }
}
