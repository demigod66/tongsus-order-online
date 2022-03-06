<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class SliderController extends Controller
{
    public function index()
    {
        $slider = Slider::all();
        if (Request()->ajax()) {
            return DataTables::of($slider)
                ->addIndexColumn()
                ->addColumn('foto_slider', function ($foto) {
                    $img = '<img src="' . asset($foto->foto_slider) . '" width="100px" height="100px" />';
                    return $img;
                })
                ->addColumn('action', function ($row) {

                    $btn = '  <a href="javascript:void(0)" title="Edit" class="btn btn-primary btn-sm" onclick="get(' . "'" . $row->id . "'" . ')"><i class="fas fa-edit"></i></a> ';
                    $btn = $btn . '  <a href="javascript:void(0)" title="Delete" class="btn btn-danger btn-sm" onclick="hapus(' . "'" . $row->id . "'" . ')"><i class="fas fa-trash"></i></a> ';

                    return $btn;
                })
                ->rawColumns(['foto_slider', 'action'])
                ->make(true);
        }
        return view('admin.slider.index');
    }


    public function store(Request $request)
    {
        request()->validate([
            'nama_slider' => 'required|min:3',
            'foto_slider' => 'required'
        ], [
            'nama_slider.required' => 'Column ini wajib diisi',
            'nama_slider.min' => 'Minimal 3 Karakter',
            'foto_slider.required' => 'Masukkan Foto'
        ]);

        $foto = $request->foto_slider;
        $new_foto = time() . $foto->getClientOriginalName();

        Slider::create([
            'nama_slider' => $request->nama_slider,
            'foto_slider' => 'uploads/slider/' . $new_foto,
        ]);


        $foto->move('uploads/slider/', $new_foto);

        echo json_encode(["status" => TRUE]);
    }

    public function edit($id)
    {
        $slider = Slider::findorfail($id);

        $data = [
            'id' => $slider->id,
            'nama_slider' => $slider->nama_slider
        ];
        echo json_encode($data);
    }

    public function update(Request $request, $id)
    {
        request()->validate([
            'nama_slider' => 'required|min:3',
        ], [
            'nama_slider.required' => 'Column ini wajib diisi',
            'nama_slider.min' => 'Minimal 3 Karakter',
        ]);

        if ($request->foto_slider != '') {
            $foto = $request->foto_slider;
            $new_foto = time() . $foto->getClientOriginalName();
            $foto->move('uploads/slider/', $new_foto);
            $slider = Slider::findorfail($id);

            $slider_data['foto_slider'] = 'uploads/slider/' . $new_foto;
            Slider::whereId($id)->update($slider_data);
            unlink($slider->foto_slider);
        }
        $slider_data = [
            'nama_slider' => $request->nama_slider,
        ];
        Slider::whereId($id)->update($slider_data);
        echo json_encode(["status" => TRUE]);
    }

    public function destroy($id)
    {
        $slider = Slider::findorfail($id);
        $slider->delete();
        unlink($slider->foto_slider);
        echo json_encode(["status" => TRUE]);
    }
}
