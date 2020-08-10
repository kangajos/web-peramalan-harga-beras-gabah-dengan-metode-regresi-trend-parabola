<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;

class AuthController extends Controller
{
    public function index()
    {
        if (Session::has('email')) {
            return redirect('dashboard');
        }
        else
        {
            return view('layouts.mainlogin');
        }
    }

    public function check(Request $request)
    {
        $where = array('email' => $request->email, 'password' => md5($request->password), 'active' => 1);
        $result = DB::table('tb_user')->where($where)->first();
        if (!empty($result)) {
            Session::put(array('email' => $result->email, 'level' => $result->nama_perusahaan, 'level' => $result->level));
            return redirect(url("dashboard"));
        } else {
            Session::flash('msg', 'Login gagal.<br>Silahkan cek kembali email dan password Anda.');
            return redirect("/auth");
        }
    }

    public function out()
    {
        Session::flush();
        return redirect(url("auth"));
    }
}
