<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class ProdukController extends Controller
{

    public function __construct()
    {
        $this->data = new Produk();
    }
    public function index()
    {
        $kategori = Kategori::all();
        $data = $this->data->getKategori();
        if (Request()->ajax()) {
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('foto_produk', function ($foto) {
                    $img = '<img src="' . asset($foto->foto_produk) . '" width="100px" height="100px" />';

                    return $img;
                })
                ->addColumn('action', function ($row) {

                    $btn = '  <a href="javascript:void(0)" title="Edit" class="btn btn-primary btn-sm" onclick="get(' . "'" . $row->id . "'" . ')"><i class="fas fa-edit"></i></a> ';
                    $btn = $btn . '  <a href="javascript:void(0)" title="Delete" class="btn btn-danger btn-sm" onclick="hapus(' . "'" . $row->id . "'" . ')"><i class="fas fa-trash"></i></a> ';


                    return $btn;
                })
                ->rawColumns(['action', 'foto_produk'])
                ->make(true);
        }
        return view('admin.produk.index', compact('kategori'));
    }

    public function store(Request $request)
    {
        request()->validate([
            'nama_produk' => 'required|max:50',
            'kategori_id' => 'required|max:50',
            'qty' => 'required|numeric',
            'harga' => 'required|numeric',
            'foto_produk' => 'required',
            'keterangan' => 'required'
        ], [
            'nama_produk.required' => 'Column Ini Wajib Diisi',
            'nama_produk.max' => 'Maksimal 50 Karakter',
            'qty.required' => 'Column Ini Wajib Diisi',
            'qty.numeric' => 'Harus Berbentuk Angka',
            'harga.required' => 'Column Ini Wajib Diisi',
            'harga.numeric' => 'Harus Berbentuk Angka',
            'foto_produk.required' => 'Column Ini Wajib Diisi',
            'keterangan.required' => 'Column Ini Wajib Diisi'
        ]);

        $foto = $request->foto_produk;
        $new_foto = time() . $foto->getClientOriginalName();

        Produk::create([
            'nama_produk' => $request->nama_produk,
            'kategori_id' => $request->kategori_id,
            'qty' => $request->qty,
            'harga' => $request->harga,
            'foto_produk' => 'uploads/produk/' . $new_foto,
            'keterangan' => $request->keterangan
        ]);

        $foto->move('uploads/produk', $new_foto);

        echo json_encode(["status" => TRUE]);
    }


    public function edit($id)
    {
        $produk = DB::table('produk')
            ->join('kategori', 'kategori.id', '=', 'produk.kategori_id')
            ->where('produk.id', '=', $id)
            ->select('produk.*', 'kategori.nama_kategori')
            ->first();


        $data = [
            'id' => $produk->id,
            'nama_produk' => $produk->nama_produk,
            'kategori_id' => $produk->kategori_id,
            'qty' => $produk->qty,
            'harga' => $produk->harga,
            'keterangan' => $produk->keterangan,
        ];

        echo json_encode($data);
    }


    public function update(Request $request, $id)
    {
        request()->validate([
            'nama_produk' => 'required|max:50',
            'kategori_id' => 'required|max:50',
            'qty' => 'required|numeric',
            'harga' => 'required|numeric',
            'keterangan' => 'required'
        ], [
            'nama_produk.required' => 'Column Ini Wajib Diisi',
            'nama_produk.max' => 'Maksimal 50 Karakter',
            'kategori_id.required' => 'Column Ini Wajib Diisi',
            'kategori_id.max' => 'Maksimal 50 Karakter',
            'qty.required' => 'Column Ini Wajib Diisi',
            'qty.numeric' => 'Harus Berbentuk Angka',
            'harga.required' => 'Column Ini Wajib Diisi',
            'harga.numeric' => 'Harus Berbentuk Angka',
            'keterangan.required' => 'Column Ini Wajib Diisi'
        ]);

        if ($request->foto_produk != '') {
            $foto = $request->foto_produk;
            $new_foto = time() . $foto->getClientOriginalName();
            $foto->move('uploads/produk/', $new_foto);
            $produk = Produk::findorfail($id);

            $produk_data['foto_produk'] = 'uploads/produk/' . $new_foto;
            Produk::whereId($id)->update($produk_data);
            unlink($produk->foto_produk);
        }
        $produk_data = [
            'nama_produk' => $request->nama_produk,
            'kategori_id' => $request->kategori_id,
            'qty' => $request->qty,
            'harga' => $request->harga,
            'keterangan' => $request->keterangan,
        ];
        Produk::whereId($id)->update($produk_data);
        echo json_encode(["status" => TRUE]);
    }


    public function destroy($id)
    {
        $produk = Produk::findorfail($id);
        $produk->delete();
        unlink($produk->foto_produk);
        echo json_encode(["status" => TRUE]);
    }
}
