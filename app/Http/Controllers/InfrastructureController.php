<?php

namespace App\Http\Controllers;

use App\Infrastructure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InfrastructureController extends Controller
{
    public function index()
    {
        return Infrastructure::leftJoin('barangays','infrastructure.barangay_id','=','barangays.id')
        ->select('infrastructure.*')
        ->get();
    }

    public function update(Request $request, $id)
    {
        $infrastructure = Infrastructure::findOrFail($id);
        $infrastructure->update($request->all());
    }
}
