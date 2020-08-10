@extends('layouts.main')
@section('title')
    Edit Transaksi
@endsection
@section('content')
    <form action="{{url('transaksi/update_transaksi')}}" method="post">
        {{ csrf_field() }}
        <input type="hidden" value="{{$edit->transaksi_id}}" name="transaksi_id">
        <div class="modal-body">
            <div class="form-group">
                <select name="kategori" class="form-control" required>
                    <option value="">Pilih Kategori</option>
                    <option value="BERAS,BERAS KEPALA KUWALITAS" {{$edit->nama_barang == 'BERAS KEPALA KUWALITAS' ? 'selected': ''}}>BERAS : Beras Kepala Kuwalitas</option>
                    <option value="BERAS,BERAS BROKEN" {{$edit->nama_barang == 'BERAS BROKEN' ? 'selected': ''}}>BERAS : Beras Broken</option>
                    <option value="BERAS,BERAS KATUL/DEDAK" {{$edit->nama_barang == 'BERAS KATUL/DEDAK' ? 'selected': ''}}>BERAS : Beras Katul/Dedak</option>
                    <option value="GABAH,GABAH KERING PANEN" {{$edit->nama_barang == 'GABAH KERING PANEN' ? 'selected': ''}}>GABAH : GABAH KERING PANEN</option>
                </select>
            </div>
            <div class="form-group">
                <label for="">Bobot (kg)</label>
                <input type="number" name="bobot" class="form-control"  value="{{$edit->bobot}}" placeholder="Tulis satuan (Kg)"
                       required>
            </div>
            <div class="form-group">
                <label for="">Harga (Rp)</label>
                <input type="number" name="harga" class="form-control" value="{{$edit->harga}}" placeholder="Tulis harga (Rp)"
                       required>
            </div>
            <div class="form-grup">
                <label for="">Jenis Jual/Beli</label>
                <select name="jenis_jual" required class="form-control">
                    <option value="">---</option>
                    <option value="jual" {{$edit->jenis_jual == 'jual' ? 'selected' : ''}}>Jual</option>
                    <option value="beli" {{$edit->jenis_jual == 'beli' ? 'selected' : ''}}>Beli</option>
                </select>
            </div>
            <div class="form-gruop">
                <label for="">Nama Pelanggan</label>
                <input type="text" name="nama_pelanggan" value="{{$edit->nama_pelanggan}}" class="form-control" placeholder="Tulis nama pelanggan" required>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-primary" type="submit">Simpan</button>
            <button class="btn btn-default" data-dismiss="modal">Batal</button>
        </div>
    </form>
@endsection