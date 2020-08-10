<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User_model;
use Session;

class UserController extends Controller
{
    public function index()
    {
        $user = User_model::getAll();
        return view('pages.user.index', compact('user'));
    }

    public function add_user(Request $request)
    {
        $where = array('email' => $request->email);
        $cek = User_model::cek_user($where);
        if ($cek> 0):
            Session::flash('msg', 'Email yang Anda masukkan sudah terdaftar, silahakn gunakan email lainya.');
            return redirect('user');
        else:
        $params = array(
            'nama_perusahaan' => $request->nama_perusahaan,
            'email' => $request->email,
            'password' => md5($request->email),
            'created_at' => date('Y-m-d H:i:s')
        );

        $insert = User_model::add_user($params);

        if ($insert) {
            Session::flash('msg', 'User baru berhasil di tambahkan');
        } else {
            Session::flash('msg', 'User baru gagal di tambahkan');
        }
        return redirect(url('user'));
        endif;
    }

    public function edit($id = null)
    {
        $where = array("password" => $id);
        $edit = User_model::edit($where);
        return view("pages.user.edit", compact("edit"));
    }

    public function update(Request $request)
    {
        $params = array(
            'nama_perusahaan' => $request->nama_perusahaan,
            'email' => $request->email,
            'password' => md5($request->email)
        );
        $where = array("user_id" => $request->user_id);
        $update = User_model::updated($params, $where);

        if ($update > 0) {
            Session::flash('msg', 'User berhasil di update');
        } else {
            Session::flash('msg', 'User gagal di update');
        }
        return redirect(url('user'));
    }

    public function delete($id = null)
    {
        $where = array("password" => $id);
        $deleted = User_model::deleted($where);

        if ($deleted > 0) {
            Session::flash('msg', 'User berhasil di hapus');
        } else {
            Session::flash('msg', 'User gagal di hapus');
        }
        return redirect(url('user'));
    }
}
