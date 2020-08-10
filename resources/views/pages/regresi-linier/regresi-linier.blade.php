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
                    <input type="number" name="hari" class="form-control"
                           placeholder="Prediksi berapa hari ??. Ketik angaka.." required>
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
                <th align="center">X</th>
                <th align="center">Y</th>
                <th align="center">X^2</th>
                <th align="center">X^3</th>
                <th align="center">X^4</th>
                <th align="center">X.Y</th>
                <th align="center">X^2.Y</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $total_x = 0;
            $total_x2 = 0;
            $total_x3 = 0;
            $total_x4 = 0;
            $total_y = 0;
            $total_x2y = 0;
            $total_xy = 0;
            $total_x_min = 0;
            $total_y = 0;
            $no = 0;
            $count = count($dataset) / 2;
            $x_min = -floor($count);

            foreach ($dataset as $key => $value):
            if (count($dataset) % 2 == 0 && $x_min == 0)
                $x_min = $x_min + 1;

            $no++;
            $periode = $value->created_at;
            $y = $value->harga;
            $_total_x2 = $x_min * $x_min;
            $_total_x3 = $x_min * $x_min * $x_min;
            $_total_x4 = $x_min * $x_min * $x_min * $x_min;
            $_total_xy = $x_min * $value->harga;
            $_total_x2y = $value->harga * $_total_x2;

            $total_x2 += $x_min * $x_min;
            $total_x3 += $x_min * $x_min * $x_min;
            $total_x4 += $x_min * $x_min * $x_min * $x_min;
            $total_xy += $x_min * $value->harga;
            $total_x2y += $value->harga * $_total_x2;
            $total_x_min += $x_min;
            $total_y += $value->harga;

            ?>
            <tr>
                <td>{{$no}}</td>
                <td>{{ $value->kategori }}</td>
                <td>{{ $value->nama }}</td>
                <td>{{ $periode }}</td>
                <td>{{ $x_min }}</td>
                <td align="center"><span class="badge badge-info">Rp {{$y}}</span></td>
                <td align="right">{{$_total_x2}}</td>
                <td align="right">{{$_total_x3}}</td>
                <td align="right">{{$_total_x4}}</td>
                <td align="right">{{$_total_xy}}</td>
                <td align="right">{{$_total_x2y}}</td>
            </tr>
            <?php

            $x_min++;
            //            $x_plus++;
            endforeach;
            ?>
            </tbody>
            <tfooter>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>{{ $total_x_min }}</td>
                    <td align="center"><span class="badge badge-info">Rp {{$total_y}}</span></td>
                    <td align="right">{{number_format($total_x2)}}</td>
                    <td align="right">{{number_format($total_x3)}}</td>
                    <td align="right">{{number_format($total_x4)}}</td>
                    <td align="right">{{number_format($total_xy)}}</td>
                    <td align="right">{{number_format($total_x2y)}}</td>
                </tr>

            </tfooter>
        </table>
        <?php
        //        echo "Total N ".$total_data = $no;
        //        echo "<br>Total B ".$b = $total_xy / $total_x2;
        //        echo "<br>Total C ".$c = $total_data * $total_x2y - $total_x2 * $total_y;//pembilang
        //        echo "<br>Total P ".$penyebut = $total_data * $total_x4 - (($total_x2)^2); //penyebut
        //        echo "<br>Hasi Bagi C/P ".$hasil_bagi = $c / $penyebut;
        //
        //        echo "<br> Total A ".$a = $total_y - $hasil_bagi * $total_x2;
        //        echo "<br> Hasil Bagi A/N ".$a_bagi = $a / $total_data;
        //        echo "<br> Diprediksi sebanyak ".$hari." hari kedepan";
        //        echo "<br> Hasil Akhir ".$hasil_akir = $a_bagi + $b * $hari + $hasil_bagi * (4);
        $total_data = $no;
        $b = $total_xy / $total_x2;
        $c = $total_data * $total_x2y - $total_x2 * $total_y;//pembilang
        $penyebut = $total_data * $total_x4 - (($total_x2) ^ 2); //penyebut
        $hasil_bagi = $c / $penyebut;

        $a = $total_y - $hasil_bagi * $total_x2;
        $a_bagi = $a / $total_data;
        echo "<br> Diprediksi sebanyak " . $hari . " hari kedepan";
        echo "<br> Hasil akhirnya Adalah Rp<b>" . $hasil_akir = number_format($a_bagi + $b * $hari + $hasil_bagi * (4))."</b>";
        //        echo $hasil_akir;
        ?>
        <br><br><br>
    </div>
@endsection