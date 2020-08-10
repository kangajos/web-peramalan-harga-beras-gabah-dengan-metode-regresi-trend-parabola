@extends('layouts.main')
@section('title')
    Transaksi
@endsection
@section('content')
    <div class="form-group">
        <button class="btn btn-primary btn-md" data-toggle="modal" data-target="#tambah-transaksi">Tambah Transaksi
        </button>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped" id="bootstrap-data-table-export">
            <thead>
            <tr>
                <th>#</th>
                <th>Kategori</th>
                <th>Nama Barang</th>
                <th>Bobot (Kg)</th>
                <th>Harga (Rp)</th>
                <th>Tanggal Transaksi</th>
                <th>Dibuat Oleh</th>
                <th>Jual/Beli</th>
                <th>Customer</th>
                <th>AKSI</th>
            </tr>
            </thead>
            <tbody>
            @foreach($transaksi as $key => $value)
                <tr>
                    <td>{{($key+1)}}</td>
                    <td>{{strtoupper($value->kategori)}}</td>
                    <td>{{$value->nama_barang}}</td>
                    <td>{{$value->bobot}} <sup class="badge badge-success">Kg</sup></td>
                    <td><span class="badge badge-success">Rp <h5>{{number_format($value->harga)}}</h5></span></td>
                    <td>{{$value->tanggal}}</td>
                    <td>{{$value->created_by}}</td>
                    <td><span class="badge {{$value->jenis_jual=='jual' ? 'badge-success' : 'badge-info'}}"><h6>{{$value->jenis_jual}}</h6></span></td>
                    <td><span class="badge badge-primary"><h6>{{$value->nama_pelanggan}}</h6></span></td>
                    <td>
                        <a href="{{url("transaksi/edit_transaksi/$value->transaksi_id")}}"
                           class="btn btn-sm btn-success btn-block">EDIT</a>
                        <a href="{{url("transaksi/delete_transaksi/$value->transaksi_id")}}"
                           onclick="return confirm('Anda Yakin ?')" class="btn btn-sm btn-danger btn-block">HAPUS</a>
                    </td>
                </tr>
            @endforeach()
            </tbody>
        </table>
    </div>

    {{--    modal tambah transaksi --}}
    <div class="modal fade" id="tambah-transaksi" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <h4 class="text-white">Tambah Transaksi</h4>
                    <button class="close text-white" data-dismiss="modal">&times;</button>
                </div>
                <form action="{{url('add_transaksi')}}" method="post">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="form-group">
                            <select name="kategori" class="form-control" required>
                                <option value="">Pilih Kategori</option>
                                <option value="BERAS,BERAS KEPALA KUWALITAS">BERAS : Beras Kepala Kuwalitas</option>
                                <option value="BERAS,BERAS BROKEN">BERAS : Beras Broken</option>
                                <option value="BERAS,BERAS KATUL/DEDAK">BERAS : Beras Katul/Dedak</option>
                                <option value="GABAH,GABAH KERING PANEN">GABAH : GABAH KERING PANEN</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Bobot (kg)</label>
                            <input type="number" name="bobot" class="form-control" placeholder="Tulis satuan (Kg)"
                                   required>
                        </div>
                        <div class="form-group">
                            <label for="">Harga (Rp)</label>
                            <input type="number" name="harga" class="form-control" placeholder="Tulis harga (Rp)"
                                   required>
                        </div>
                        <div class="form-grup">
                            <label for="">Jenis Jual/Beli</label>
                            <select name="jenis_jual" required class="form-control">
                                <option value="">---</option>
                                <option value="jual">Jual</option>
                                <option value="beli">Beli</option>
                            </select>
                        </div>
                        <div class="form-gruop">
                            <label for="">Nama Pelanggan</label>
                            <input type="text" name="nama_pelanggan" class="form-control"
                                   placeholder="Tulis nama pelanggan" required>
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