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

    

}
