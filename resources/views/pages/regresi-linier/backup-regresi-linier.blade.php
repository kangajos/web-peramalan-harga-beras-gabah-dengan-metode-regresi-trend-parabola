@extends('layouts.main')
@section('title')
    Hasil Hitung Dataset
@endsection
@section('content')
    <div class="form-group">
        <form action="{{route("regresi_linier")}}" method="post">
            {{csrf_field()}}
            <div class="form-group row">
                <div class="col-md-3">
                    <select name="kategori" class="form-control" required>
                        <option value="">Pilih Kategori</option>
                        <option value="BERAS,BERAS KUWALITAS KEPALA">BERAS : Beras Kuawalitas Kepala</option>
                        <option value="BERAS,BERAS BROKEN">BERAS : Beras Broken</option>
                        <option value="BERAS,KATUL/DEDAK">BERAS :katul/Dedak</option>
                        <option value="GABAH,GABAH KERING PANEN">GABAH : GABAH KERING PANEN</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <input type="number" name="hari" class="form-control" placeholder="Prediksi berapa hari ??. Ketik angaka.." required>
                </div>
                <div class="col-md-3 mr-auto">
                    <button class="btn btn-primary btn-sm" type="submit">Hitung..</button>
                </div>

            </div>
        </form>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover" id="bootstrap-data-table-export">
            <thead class="bg-dark text-white">
            <tr>
                <th width="27">No</th>
                <th>Kategori</th>
                <th>Nama</th>
                <th>Tanggal</th>
                <th align="center">Index Harga</th>
                <th align="right">X</th>
                <th align="right">Y</th>
                <th align="center">XX</th>
                <th align="right">XY</th>
                <th></th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @php
                $total_x = 0;
                $total_y = 0;
                $total_xx = 0;
                $total_xy = 0;
                $x = -1;
                $no = 0;

               foreach ($dataset as $key => $value):

                $no++;
                $x++;
                $periode = $value->created_at;
                $jumlah = $value->harga;
                $xx = $x * $x;
                $xy = $x * $jumlah;
                $total_x = $total_x + $x;
                $total_y = $total_y + $jumlah;
                $total_xx = $total_xx + $xx;
                $total_xy = $total_xy + $xy;
                $rata_x = $total_x / $no;
                $rata_y = $total_y / $no;


            @endphp
            <tr>
                <td>{{$no}}</td>
                <td>{{ $value->kategori }}</td>
                <td>{{ $value->nama }}</td>
                <td>{{ $periode }}</td>
                <td align="center"><span class="badge badge-info">Rp {{$jumlah}}</span></td>
                <td align="right">{{$x}}</td>
                <td align="right">{{$jumlah}}</td>
                <td align="center">{{$xx}}</td>
                <td align="right">{{$xy}}</td>
                <td>
                    <a href="#" class="btn btn-primary btn-sm">EDIT</a>
                </td>
                <td>
                    <a href="#" class="btn btn-danger btn-sm">HAPUS</a>
                </td>
            </tr>
            @php
                endforeach;
            @endphp
            </tbody>
            <tfooter>
                <tr>
                    <td></td>
                    <td></td>
                    <td>Jumlah</td>
                    <td align="right"><strong>{{$total_x}}</strong></td>
                    <td align="right"><strong>{{$total_y}}</strong></td>
                    <td align="center"><strong>{{$total_xx}}</strong></td>
                    <td align="right"><strong>{{$total_xy}}</strong></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td>Rata-rata</td>
                    <td align="right"><strong>{{$rata_x}}</strong></td>
                    <td width="70" align="right"><strong>{{$rata_y}}</strong></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td></td>
                    <td></td>
                </tr>
            </tfooter>
        </table>
        @php
            $b1 = ($total_xy - (($total_x * $total_y) / $no)) / ($total_xx - (($total_x * $total_x) / $no));
            $b0 = ($total_y / $no) - $b1 * ($total_x / $no);

            echo "Rumus Regresi Linear<br>";
            echo "<strong> Y = $b0 + $b1 X </strong> <br>";

            //if ($prediksi) {
                $x = $x +  $hari;
                $y = $b0 + $b1 * $x;
                echo "Prediksi harga untuk <strong> $nama</strong> dalam <strong>$hari hari</strong> kedepan adalah <strong>". $y ." Rupiah</strong>";
            //}
        @endphp
        <br><br><br>
    </div>
@endsection