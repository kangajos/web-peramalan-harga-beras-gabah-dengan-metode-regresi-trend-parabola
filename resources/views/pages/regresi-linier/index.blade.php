@extends('layouts.main')
@section('title')
    Dataset
@endsection
@section('content')
    <div class="form-group">
        <form action="{{route("regresi_linier")}}" method="post">
            {{csrf_field()}}
            <div class="form-group row">
                <div class="col-md-2">
                    <a href="#" class="btn btn-info btn-sm" data-toggle="modal" data-target="#tambah-dataset">Tambah Dataset</a>
                </div>
                <div class="col-md-10">
                    <div class="col-md-5">
                        <div class="form-group">
                            <select name="kategori" class="form-control" required>
                                <option value="">Pilih Kategori</option>
                                <option value="BERAS,BERAS KUWALITAS KEPALA">BERAS : Beras Kuwalitas Kepala</option>
                                <option value="BERAS,BERAS BROKEN">BERAS : Beras Broken</option>
                                <option value="BERAS,KATUL/DEDAK">BERAS : Beras Katul/Dedak</option>
                                <option value="GABAH,GABAH KERING PANEN">GABAH : GABAH KERING PANEN</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <input type="number" name="hari" class="form-control"
                                   placeholder="Prediksi berapa hari ??. Ketik angaka.." required>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="form-group">
                            <button class="btn btn-primary btn-sm" type="submit">Hitung</button>
                        </div>
                    </div>
                </div>

            </div>
        </form>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover" id="bootstrap-data-table-export">
            <thead class="bg-dark text-white">
            <tr>
                <th>No</th>
                <th>Kategori</th>
                <th>Nama</th>
                <th>Index Harga</th>
                <th>Tanggal</th>
                <th></th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($dataset as $key => $value)
                <tr>
                    <td>{{ ($key+1) }}</td>
                    <td>{{ strtoupper($value->kategori) }}</td>
                    <td>{{ $value->nama }}</td>
                    <td><span class="badge badge-success">Rp {{ number_format($value->harga) }}</span></td>
                    <td>{{ $value->created_at }}</td>
                    <td>
                        <a href="" class="btn btn-primary btn-sm">EDIT</a>
                    </td>
                    <td>
                        <a href="{{url("deleted_dataset/".$value->dataset_id)}}" class="btn btn-danger btn-sm" onclick="return confirm('Anda Yakin ?')">HAPUS</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
            </tfooter>
        </table>
    </div>

{{--    modal dataset--}}
    <div class="modal fade" id="tambah-dataset" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Tambah Dataset</h3>
                    <button class="close" data-dismiss="modal">&times;</button>
                </div>
                <form action="{{route('add_dataset')}}" method="post">
                    {{csrf_field()}}
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
                            <label for="harga">Harga</label>
                            <input type="number" id="harga" name="harga" class="form-control" placeholder="ketik harga" required>
                        </div>
                        <div class="form-group">
                            <label for="tanggla">Harga</label>
                            <input type="date" id="tanggal" name="tanggal" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary btn-sm" type="submit">Simpan</button>
                        <button class="btn btn-default btn-sm" data-dismiss="modal">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
