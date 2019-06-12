<?php

namespace App\Http\Controllers;

use App\Communication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommunicationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Communication::leftJoin('barangays','communications.barangay_id','=','barangays.id')
        ->select('communications.*')
        ->get();
    }

    public function update(Request $request, $id)
    {
        $communication = Communication::findOrFail($id);
        $communication->update($request->all());
    }
}
