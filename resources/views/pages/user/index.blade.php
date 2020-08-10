@extends('layouts.main')
@section('title')
    Data User
@endsection
@section('content')
    <div class="form-group">
        <button class="btn btn-primary" data-target="#tambah-user" data-toggle="modal">Tambah User</button>
    </div>
    <div class="table-responsive">
        <table class="table table-hover table-bordered table-striped">
            <thead>
            <tr>
                <th>#</th>
                <th>Nama Perusahaan</th>
                <th>Username / Email</th>
                <th>Tanggal Buat</th>
                <th>Status User</th>
                <th>AKSI</th>
            </tr>
            </thead>
            <tbody>
            @foreach($user as $key => $value)
                <tr>
                    <td>{{($key+1)}}</td>
                    <td>{{$value->nama_perusahaan}}</td>
                    <td>{{$value->email}}</td>
                    <td>{{$value->created_at}}</td>
                    <td align="center">{!!  ($value->active===1) ? '<span class="badge badge-success">ACTIVE</span>' : '<span class="badge badge-danger">NON ACTIVE</span>'!!}</td>
                    <td>
                        <a href="{{route("edit_user",$value->password)}}" class="btn btn-sm btn-success">EDIT</a>
                        <a onclick="return confirm('Anda yakin ?')" href="{{route("delete_user",$value->password)}}" class="btn btn-sm btn-danger">HAPUS</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="modal fade" id="tambah-user" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <h4 class="text-white">Tambah User</h4>
                    <button class="close text-white" data-dismiss="modal">&times;</button>
                </div>
                <form action="{{url('user/add_user')}}" method="post">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Nama Perusahaan</label>
                            <input type="text" name="nama_perusahaan" class="form-control"
                                   placeholder="Tulis nama perusahaan" required>
                        </div>
                        <div class="form-group">
                            <label for="">Email (Buat login)</label>
                            <input type="email" name="email" class="form-control" placeholder="Tulis email baru.."
                                   required>
                        </div>
                        <div class="form-group">
                            <h4 class="text-danger"><sup>*</sup>Password sama dengan email.</h4>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" type="submit">Simpan</button>
                        <button class="btn btn-default" data-dismiss="modal">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection