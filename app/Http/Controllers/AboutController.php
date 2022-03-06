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
                ->addColumn('foto_deskripsi', function ($foto) {
                    $img = '<img src="' . asset($foto->foto_deskripsi) . '" width="100px" height="100px" />';

                    return $img;
                })
                ->addColumn('action', function ($row) {

                    $btn = '  <a href="javascript:void(0)" title="Edit" class="btn btn-primary btn-sm" onclick="get(' . "'" . $row->id . "'" . ')"><i class="fas fa-edit"></i></a> ';
                    $btn = $btn . '  <a href="javascript:void(0)" title="Delete" class="btn btn-danger btn-sm" onclick="hapus(' . "'" . $row->id . "'" . ')"><i class="fas fa-trash"></i></a> ';


                    return $btn;
                })
                ->rawColumns(['action', 'foto_deskripsi'])
                ->make(true);
        }
        return view('admin.about.index');
    }


    public function store(Request $request)
    {
        request()->validate([
            'deskripsi' => 'required',
            'foto_deskripsi' => 'required'
        ], [
            'deskripsi.required' => 'column ini wajib diisi',
            'foto_deskripsi.required' => 'column ini wajib diisi'
        ]);

        $foto = $request->foto_deskripsi;
        $new_foto = time() . $foto->getClientOriginalName();

        About::create([
            'deskripsi' => $request->deskripsi,
            'foto_deskripsi' => 'uploads/about/' . $new_foto,
        ]);


        $foto->move('uploads/about/', $new_foto);

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

        if ($request->foto_deskripsi != '') {
            $foto = $request->foto_deskripsi;
            $new_foto = time() . $foto->getClientOriginalName();
            $foto->move('uploads/about/', $new_foto);
            $about = About::findorfail($id);

            $about_data['foto_deskripsi'] = 'uploads/about/' . $new_foto;
            About::whereId($id)->update($about_data);
            unlink($about->foto_deskripsi);
        }
        $about_data = [
            'deskripsi' => $request->deskripsi,
        ];
        About::whereId($id)->update($about_data);
        echo json_encode(["status" => TRUE]);
    }

    public function destroy($id)
    {
        $about = About::findorfail($id);
        $about->delete();
        unlink($about->foto_deskripsi);

        echo json_encode(["status" => TRUE]);
    }
}
