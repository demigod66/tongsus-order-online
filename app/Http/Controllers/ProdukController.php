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
                ->addColumn('foto', function ($foto) {
                    $img = '<img src="' . asset('uploads/produk/' . $foto->file) . '" width="100px" height="100px" />';

                    return $img;
                })
                ->addColumn('action', function ($row) {

                    $btn = '  <a href="javascript:void(0)" title="Edit" class="btn btn-primary btn-sm" onclick="get(' . "'" . $row->id . "'" . ')"><i class="fas fa-edit"></i></a> ';
                    $btn = $btn . '  <a href="javascript:void(0)" title="Delete" class="btn btn-danger btn-sm" onclick="hapus(' . "'" . $row->id . "'" . ')"><i class="fas fa-trash"></i></a> ';


                    return $btn;
                })
                ->rawColumns(['action', 'foto'])
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
            'file' => 'required',
            'keterangan' => 'required'
        ], [
            'nama_produk.required' => 'Column Ini Wajib Diisi',
            'nama_produk.max' => 'Maksimal 50 Karakter',
            'qty.required' => 'Column Ini Wajib Diisi',
            'qty.numeric' => 'Harus Berbentuk Angka',
            'harga.required' => 'Column Ini Wajib Diisi',
            'harga.numeric' => 'Harus Berbentuk Angka',
            'file.required' => 'Column Ini Wajib Diisi',
            'keterangan.required' => 'Column Ini Wajib Diisi'
        ]);

        $file = $request->file;
        $new_file = Str::random() . $file->getClientOriginalName();

        Produk::create([
            'nama_produk' => $request->nama_produk,
            'kategori_id' => $request->kategori_id,
            'qty' => $request->qty,
            'harga' => $request->harga,
            'file' => 'uploads/produk/' . $new_file,
            'keterangan' => $request->keterangan
        ]);

        $file->move('uploads/produk', $new_file);

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

        $produk =  Produk::findorfail($id);

        if ($request->has('file')) {
            $file = $request->file;
            $new_file = Str::random(16) . $file->getClientOriginalName();
            $file->move('uploads/produk/', $new_file);

            // if ($produk->file != '') {
            //     unlink($produk->file);
            // }
        }
        $produk->nama_produk = $request->nama_produk;
        $produk->kategori_id = $request->kategori_id;
        $produk->qty = $request->qty;
        $produk->harga = $request->harga;
        $produk->keterangan = $request->keterangan;
        $produk->file = $request->file != '' ? $new_file : $produk->file;
        $produk->save();


        echo json_encode(["status" => TRUE]);
    }


    public function destroy($id)
    {
        $data = Produk::findorfail($id);
        $data->delete();

        echo json_encode(["status" => TRUE]);
    }
}
