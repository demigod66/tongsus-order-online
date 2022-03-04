<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;
use Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kategori = Kategori::all();
        if (Request()->ajax()) {
            return DataTables::of($kategori)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    $btn = '  <a href="javascript:void(0)" title="Edit" class="btn btn-primary btn-sm" onclick="get(' . "'" . $row->id . "'" . ')"><i class="fas fa-edit"></i></a> ';
                    $btn = $btn . '  <a href="javascript:void(0)" title="Delete" class="btn btn-danger btn-sm" onclick="hapus(' . "'" . $row->id . "'" . ')"><i class="fas fa-trash"></i></a> ';


                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.kategori.index');
    }


    public function store(Request $request)
    {
        request()->validate([
            'nama_kategori' => 'required|min:3|max:50',
        ], [
            'nama_kategori.required' => 'Column Ini Wajib Diisi',
            'nama_kategori.min' => 'Minimal 3 Karakter',
            'nama_kategori.max' => 'Maksimal 50 Karakter',
        ]);
        Kategori::create([
            'nama_kategori' => $request->nama_kategori,
            'slug' => Str::slug($request->nama_kategori)
        ]);

        echo json_encode(["status" => TRUE]);
    }

    public function edit($id)
    {
        $data = Kategori::findorfail($id);
        echo json_encode($data);
    }



    public function update(Request $request, $id)
    {
        request()->validate([
            'nama_kategori' => 'required|min:3|max:50',
        ], [
            'nama_kategori.required' => 'Column Ini Wajib Diisi',
            'nama_kategori.min' => 'Minimal 3 Karakter',
            'nama_kategori.max' => 'Maksimal 50 Karakter',
        ]);

        $kategori = Kategori::findorfail($id);

        $kategori->nama_kategori = $request->nama_kategori;
        $kategori->slug = Str::slug($request->nama_kategori);
        $kategori->save();

        echo json_encode(["status" => TRUE]);
    }


    public function destroy($id)
    {
        $data = Kategori::findorfail($id);
        $data->delete();

        echo json_encode(["status" => TRUE]);
    }
}
