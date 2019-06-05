<?php

namespace App\Http\Controllers;

use App\Landuse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LandUseController extends Controller
{
    public function index()
    {
        return Landuse::leftJoin('barangays','landuses.barangay_id','=','barangays.id')
        ->select('landuses.*')
        ->get();
    }

    public function update(Request $request, $id)
    {
        $landuse = Landuse::findOrFail($id);
        $landuse->update($request->all());
    }
}
