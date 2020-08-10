@extends('layouts.main')
@section('title')
    Edit User
@endsection
@section("content")
    <form action="{{route('update_user')}}" method="post">
        {{ csrf_field() }}
            <div class="form-group">
                <label for="">Nama Perusahaan</label>
                <input type="hidden" name="user_id" value="{{$edit->user_id}}" required>
                <input type="text" name="nama_perusahaan" class="form-control"
                       placeholder="Tulis nama perusahaan" value="{{$edit->nama_perusahaan}}" required>
            </div>
            <div class="form-group">
                <label for="">Email (Buat login)</label>
                <input type="email" name="email" class="form-control" value="{{$edit->email}}"
                       placeholder="Tulis email baru.."
                       required>
            </div>
            <div class="form-group">
                <h4 class="text-danger"><sup>*</sup>Password sama dengan email.</h4>
            </div>
            <div class="form-group">
                <button class="btn btn-primary" type="submit">Update</button>
            </div>
    </form>
@endsection