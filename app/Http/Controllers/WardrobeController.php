<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Wardrobe;
use \App\Models\JenisWardrobe;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class WardrobeController extends Controller
{
    function index()
    {
        $jenis = JenisWardrobe::orderBy('id', 'desc')->get();
        $data = Wardrobe::orderBy('created_at', 'DESC');
        $data = $data->paginate(env('PAGINATION_LIMIT', 30));
        return view('wardrobe.index')->with('data', $data)->with('jenis', $jenis)->with('routeFilter', route('wardrobe.filter'))->with('routeDetail', route('wardrobe.detail'))->with('routeJenis', route('wardrobe.jenis'));
    }

    public function create()
    {
        $jenis = JenisWardrobe::orderBy('id', 'DESC')->get();
        return view('wardrobe.form')
            ->with('pagetype', 'POST')
            ->with('item', null)
            ->with('jenis', $jenis)
            ->with('route', route('wardrobe.store'));
    }

    public function store(Request $request)
    {
        $item = new Wardrobe();
        $this->push($item, $request, 'POST');
        // session()->flash('success', 'Wardrobe sudah disimpan. ');
        return redirect(route('wardrobe.index'));
    }

    public function show($id)
    {
        $data = Wardrobe::find($id);
        return view('wardrobe.detail')->with('data', $data)->render();
    }

    public function edit($id)
    {
        $jenis = JenisWardrobe::orderBy('id', 'DESC')->get();
        $item = Wardrobe::find($id);
        return view('wardrobe.form')
            ->with('pagetype', 'PATCH')
            ->with('item', $item)
            ->with('jenis', $jenis)
            ->with('route', route('wardrobe.update', $id));
    }

    public function update(Request $request, $id)
    {
        $item = Wardrobe::find($id);
        $this->push($item, $request, 'PATCH');
        session()->flash('info', 'Wardrobe sudah disimpan');
        return redirect(route('wardrobe.index'));
    }

    public function destroy($id)
    {
        $item = Wardrobe::find($id);
        if ($item) {
            $item->delete();
            File::delete(public_path('uploads/wardrobe/' . $item->image_url));
            session()->flash('success', 'Wardrobe sudah dihapus');
        } else {
            session()->flash('error', 'Wardrobe tidak ditemukan');
        }
    }

    public function filter(Request $request)
    {
        $data = DB::table('wardrobe')->orderByDesc('created_at');
        $wardrobe = Wardrobe::orderBy('created_at', 'DESC');
        if ($request->all) $data = $wardrobe;
        if ($request->keyword != "") {
            $data = $wardrobe->where(function ($query) use ($request) {
                $query->where('merk', 'like', '%' . $request->keyword . '%')
                    ->orWhere('serial_number', 'like', '%' . $request->keyword . '%')
                    ->orWhere('size', 'like', '%' . $request->keyword . '%');
            });
        }
        if ($request->tipe != "all") $data = $data->where('tipe', $request->tipe);
        if ($request->category != "all") $data = $data->where('category', $request->category);
        if ($request->jenis != "all") $data = $data->where('jenis_id', $request->jenis);

        $data = $data->paginate(env('PAGINATION_LIMIT', 30));
        return view('wardrobe.pagination')->with('data', $data)->render();
    }

    public function detail(Request $request)
    {
        $data = Wardrobe::find($request->id);
        return view('wardrobe.detail')->with('data', $data)->render();
    }

    public function push($item, $request, $state)
    {
        Validator::make($request->all(), [
            'merk' => 'required',
            'tipe' => 'required',
            'price' => 'required',
            'category' => 'required',
            'jumlah' => 'required',
            'serial_number' => 'required',
            'size' => 'required',
            'jenis_id' => 'required',
        ])->validate();
        if ($state == 'POST') {
            Validator::make($request->all(), [
                'thumbnail' => 'required',
            ])->validate();
        }

        foreach ($request->all() as $key => $value) {
            if ($key != '_token' && $key != 'thumbnail' && $key != "_method") $item->$key = $value;
        }
        if ($request->has('thumbnail')) {
            $img = $request->file('thumbnail');
            $directory = public_path('/uploads/wardrobe/');
            $extension = $img->getClientOriginalExtension();
            $filename = date('mdYHis') . uniqid() . '.' . $extension;
            $img->move($directory, $filename);
            $item->image_url = $filename;
        }
        if($item->save()) {
            session()->flash('success', 'Wardrobe sudah disimpan');
        } else {
            session()->flash('error', 'Wardrobe gagal disimpan');
        }
    }
    public function jenis(Request $request){
        $data = new JenisWardrobe();
        $jenis = JenisWardrobe::orderBy('id', 'desc')->get();
        if($request->nama){
            $data->nama = $request->nama;
            if($data->save()) return response()->json(['type' => "success", 'message' => "Jenis $data->nama sudah disimpan"]);
            return response()->json(['type' => "warning", 'message' => "Jenis $data->nama gagal disimpan"]);
        }
        return response()->json($jenis);
    }

}
