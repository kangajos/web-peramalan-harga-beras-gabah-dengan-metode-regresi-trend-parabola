<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Input;

use App\Transaksi;
use DB;

class RegresiLinierController extends Controller
{
    public function __construct()
    {
        if (!Session::has('email')) {
            return redirect('auth');
        }
    }

    public function index()
    {
        if (!Session::has('email')) {
            return redirect('auth');
        }
        $pie_chart_gabah = DB::table('tb_transaksi')->select('nama_barang', DB::raw('SUM(harga) as total'))->where(array('created_by' => Session::get('email'), 'kategori' => 'GABAH'))->groupBy('nama_barang')->get();
        $pie_chart_beras = DB::table('tb_transaksi')->select('nama_barang', DB::raw('SUM(harga) as total'))->where(array('created_by' => Session::get('email'), 'kategori' => 'BERAS'))->groupBy('nama_barang')->get();
        $nama_gabah = "";
        $total_gabah = null;
        $_total_gabah = 0;

        foreach ($pie_chart_gabah as $key => $value) {
            $nama_gabah .= '"' . $value->nama_barang . '",';
            $total_gabah .= $value->total . ",";
            $_total_gabah += $value->total;
        }

        $nama_beras = "";
        $total_beras = null;
        $_total_beras = 0;
        foreach ($pie_chart_beras as $key => $value) {
            $nama_beras .= '"' . $value->nama_barang . '",';
            $total_beras .= $value->total . ",";
            $_total_beras += $value->total;
        }

        $nama_gabah = substr($nama_gabah, 0, -1);
        $total_gabah = substr($total_gabah, 0, -1);

        $nama_beras = substr($nama_beras, 0, -1);
        $total_beras = substr($total_beras, 0, -1);
        $email = Session::get("email");
        $beras =
            DB::table("tb_transaksi")
                ->select('nama_barang',
                    DB::raw('SUM(harga) as total'),
                    DB::raw('MONTH(tanggal) as bulan')
                )
                ->where('created_by', $email)
                ->where('kategori', 'BERAS')
                ->whereYear('tanggal', date('Y'))
                ->groupBy('nama_barang', 'bulan')
                ->orderBy('bulan', 'ASC')->get();
//        return dd($beras);
        $barchart_beras = "";
        $bulan_beras = array();
        foreach ($beras as $key => $value) {
            $bulan_beras[] = $value->bulan;
            if (($key + 1) % 1 == 0) {
                $border_rgba1 = "rgba(0, 123, 255, 0.9)";
                $bckg_rgba1 = "rgba(0, 123, 255, 0.5)";
            }

            if (($key + 1) % 2 == 0) {
                $border_rgba1 = "rgba(0,0,0,0.09)";
                $bckg_rgba1 = "rgba(0, 159, 215, 0.5)";
            }

            if (($key + 1) % 3 == 0) {
                $border_rgba1 = "rgba(0,0,0,0.09)";
                $bckg_rgba1 = "rgba(25,29,59,0.7)";
            }
            $barchart_beras .= "
            {
                        label: \"$value->nama_barang\",
                        data: [$value->total],
                        borderColor: \"$border_rgba1\",
                        borderWidth: \"0\",
                        backgroundColor: \"$bckg_rgba1\"
                    },";
        }
        $bulan_beras_hasil = self::bulan($bulan_beras);

        $gabah =
            DB::table("tb_transaksi")
                ->select('nama_barang',
                    DB::raw('SUM(harga) as total'),
                    DB::raw('MONTH(tanggal) as bulan')
                )
                ->where('created_by', $email)
                ->where('kategori', 'GABAH')
                ->whereYear('tanggal', date('Y'))
                ->groupBy('nama_barang', 'bulan')
                ->orderBy('bulan', 'ASC')->get();

        $barchart_gabah = "";
//        return dd($beras);
        $bulan_gabah = array();
        foreach ($gabah as $key => $value) {
            $bulan_gabah[] = $value->bulan;
            if (($key + 1) % 1 == 0) {
                $border_rgba1 = "rgba(0, 123, 255, 0.9)";
                $bckg_rgba1 = "rgba(0, 123, 255, 0.5)";
            }

            if (($key + 1) % 2 == 0) {
                $border_rgba1 = "rgba(0,0,0,0.09)";
                $bckg_rgba1 = "rgba(0, 159, 215, 0.5)";
            }

            if (($key + 1) % 3 == 0) {
                $border_rgba1 = "rgba(0,0,0,0.09)";
                $bckg_rgba1 = "rgba(25,29,59,0.7)";
            }
            $barchart_gabah .= "
            {
                        label: \"$value->nama_barang\",
                        data: [$value->total],
                        borderColor: \"$border_rgba1\",
                        borderWidth: \"0\",
                        backgroundColor: \"$bckg_rgba1\"
                    },";
        }
        $bulan_gabah_hasil = self::bulan($bulan_gabah);
        return view('pages.dashboard.index', compact('nama_gabah', 'total_gabah', '_total_gabah', 'nama_beras', 'total_beras', '_total_beras', 'beras', 'barchart_beras', 'barchart_gabah', 'bulan_gabah_hasil','bulan_beras_hasil'));
//        return view('pages.dashboard.index', compact('beras'));
    }

    static function bulan($bulan = array())
    {
        $month = array();
        asort($bulan);
        foreach ($bulan as $item) {
//            return $item;
            switch ($item) {
                case $item == 1:
                    $nama_bulan = "Januari";
                    break;
                case $item == 2:
                    $nama_bulan = "Februari";
                    break;
                case $item == 3:
                    $nama_bulan = "Maret";
                    break;
                case $item == 4:
                    $nama_bulan = "April";
                    break;
                case $item == 5:
                    $nama_bulan = "Mei";
                    break;
                case $item == 6:
                    $nama_bulan = "Juni";
                    break;
                case $item == 7:
                    $nama_bulan = "Juli";
                    break;
                case $item == 8:
                    $nama_bulan = "Agustus";
                    break;
                case $item == 9:
                    $nama_bulan = "September";
                    break;
                case $item == 10:
                    $nama_bulan = "November";
                    break;
                case $item == 11:
                    $nama_bulan = "Oktober";
                    break;
                case $item == 12:
                    $nama_bulan = "Desember";
                    break;
            }
            $month[] = $nama_bulan;
        }
        $hasil = array_unique($month);
        $hasil_ = "";
        foreach ($hasil as $val) {
            $hasil_ .="'".$val."',";
        }
        return $hasil_;
    }

    public function dataset()
    {
        $dataset = DB::table('tb_dataset')->where('created_by', Session::get('email'))->limit(10)->get();
//        ->where(array('kategori' => 'BERAS', 'nama'=> 'BERAS BROKEN'))
        return view('pages.regresi-linier.index', compact('dataset'));
    }

    public function add_dataset(Request $request)
    {
        $_kategori = explode(',', $request->kategori);
        $tanggal = date('Y-m-d', strtotime($request->tanggal));
        $harga = $request->harga;
        $created_by = Session::get('email');

        $params = array(
            'kategori' => strtoupper($_kategori[0]),
            'nama' => strtoupper($_kategori[1]),
            'created_at' => $tanggal,
            'harga' => $harga,
            'created_by' => $created_by,
            'updated_at' => date('Y-m-d H:i:s')
        );

        $insert = Transaksi::add_dataset($params);
        $msg = "Dataset gagal ditambahkan.";
        if ($insert)
            $msg = "Dataset berhasil ditambahkan";

        Session::flash('msg', $msg);
        return redirect("dataset");
    }

    public function deleted_dataset($dataset_id = null)
    {
        $created_by = Session::get('email');
        $deleted = DB::table('tb_dataset')->where(array('created_by' => $created_by, 'dataset_id' => $dataset_id))->delete();
        $msg = "Dataset gagal di hapus";
        if ($deleted > 0)
            $msg = "Dataset berhasil di hapus";

        Session::flash('msg', $msg);
        return redirect("dataset");

    }

    public function regresi_linier(Request $request)
    {
        if (!$request)
            return redirect("dataset");

        $_kategori = explode(',', $request->kategori);
        $kategori = isset($_kategori[0]) ? $_kategori[0] : '';
        $nama = isset($_kategori[1]) ? $_kategori[1] : '';
        $hari = $request->hari;

        $where = array('kategori' => $kategori, 'nama' => $nama);
        $data['nama'] = $nama;
        $data['dataset'] = DB::table('tb_dataset')->where($where)->orderBy('created_at', 'ASC')->limit(123)->get();
//        $data['dataset'] = DB::table('tb_dataset')->where($where)->whereBetween('created_at', ['2018-01-01', '2018-04-30'])->orderBy('created_at', 'ASC')->get();
        $data['hari'] = $hari;

        return view('pages.regresi-linier.regresi-linier', $data);
    }

    public function transaksi()
    {
        $transaksi = Transaksi::getAll();
        return view('pages.transaksi.index', compact('transaksi'));
    }

    public function add_transaksi(Request $request)
    {
        $kategori = explode(',', $request->kategori);
        $params = array(
            'kategori' => strtoupper($kategori[0]),
            'nama_barang' => strtoupper($kategori[1]),
            'bobot' => $request->bobot,
            'harga' => $request->harga,
            'jenis_jual' => $request->jenis_jual,
            'nama_pelanggan' => $request->nama_pelanggan,
            'tanggal' => date('Y-m-d H:i:s'),
            'created_by' => Session::get('email')
        );
//        return dd($params);
        $insert = Transaksi::add_transaksi($params);
        if ($insert) {
            Session::flash('msg', 'Transaksi berhasil di tambahkan');
        } else {
            Session::flash('msg', 'Transaksi gagal di tambahkan');
        }
        return redirect(url('transaksi'));
    }

    public function edit_transaksi($transaksi_id = NULL)
    {
        $where = array('transaksi_id' => $transaksi_id);
        $edit = Transaksi::edit_transaksi($where);
        return view('pages.transaksi.edit', compact('edit'));
    }

    public function update_transaksi(Request $request)
    {
        $kategori = explode(',', $request->kategori);
        $params = array(
            'kategori' => strtoupper($kategori[0]),
            'nama_barang' => strtoupper($kategori[1]),
            'bobot' => $request->bobot,
            'harga' => $request->harga,
            'jenis_jual' => $request->jenis_jual,
            'nama_pelanggan' => $request->nama_pelanggan,
            'updated_at' => date('Y-m-d H:i:s')
        );
        $where = array('transaksi_id' => $request->transaksi_id);

        $update = Transaksi::update_transaksi($params, $where);

        if ($update > 0) {
            Session::flash('msg', 'Transaksi berhasil di update');
        } else {
            Session::flash('msg', 'Transaksi gagal di update');
        }
        return redirect(url('transaksi'));
    }

    public function delete_transaksi($transaksi_id = NULL)
    {
        $where = array('transaksi_id' => $transaksi_id);
        $deleted = Transaksi::delete_transaksi($where);

        if ($deleted > 0) {
            Session::flash('msg', 'Transaksi berhasil dihapus');
        } else {
            Session::flash('msg', 'Transaksi gagal dihapus');
        }
        return redirect(url('transaksi'));
    }
}
