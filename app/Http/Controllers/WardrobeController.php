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


}
