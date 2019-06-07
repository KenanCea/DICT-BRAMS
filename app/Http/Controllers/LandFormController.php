<?php

namespace App\Http\Controllers;

use App\LandForm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LandFormController extends Controller
{
    public function index()
    {
        return LandForm::leftJoin('barangays','landforms.barangay_id','=','barangays.id')
        ->select('landforms.*')
        ->get();
    }

    public function update(Request $request, $id)
    {
        $landform = LandForm::findOrFail($id);
        $landform->update($request->all());
    }
}
