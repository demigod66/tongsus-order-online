<?php

namespace App\Http\Controllers;

use App\Models\About;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class AboutController extends Controller
{
    public function index()
    {
        $about = About::all();
        if (Request()->ajax()) {
            return DataTables::of($about)
                ->addIndexColumn()
                ->addColumn('foto', function ($foto) {
                    $img = '<img src="' . asset($foto->file) . '" width="100px" height="100px" />';

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
        return view('admin.about.index');
    }


    public function store(Request $request)
    {
        request()->validate([
            'deskripsi' => 'required',
            'file' => 'required'
        ], [
            'deskripsi.required' => 'column ini wajib diisi',
            'file.required' => 'column ini wajib diisi'
        ]);

        $file = $request->file;
        $new_file = Str::random() . $file->getClientOriginalName();

        About::create([
            'deskripsi' => $request->deskripsi,
            'file' => 'uploads/about/' . $new_file,
        ]);


        $file->move('uploads/about/', $new_file);

        echo json_encode(["status" => TRUE]);
    }

    public function edit($id)
    {
        $about = About::findorfail($id);

        $data = [
            'id' => $about->id,
            'deskripsi' => $about->deskripsi
        ];
        echo json_encode($data);
    }

    public function update(Request $request, $id)
    {
        request()->validate([
            'deskripsi' => 'required'
        ], [
            'deskripsi.required' => 'column ini wajib diisi'
        ]);

        $about =  About::findorfail($id);

        if ($request->has('file')) {
            $file = $request->file;
            $new_file = Str::random(16) . $file->getClientOriginalName();
            $file->move('uploads/about/', $new_file);

            // if ($produk->file != '') {
            //     unlink($produk->file);
            // }
        }
        $about->deskripsi = $request->deskripsi;
        $about->save();


        echo json_encode(["status" => TRUE]);
    }

    public function destroy($id)
    {
        $about = About::findorfail($id);
        $about->delete();

        echo json_encode(["status" => TRUE]);
    }
}
