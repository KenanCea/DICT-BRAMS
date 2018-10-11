<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        return Member::paginate(2000);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required|string|max:50',
            'family_name' => 'required|string|max:50',
            'middle_name' => 'required|string|max:50',
            'age' => 'required|integer',
            'sex' => 'required|string|max:50',
        ]);
        return Member::create([
            'first_name' => $request['first_name'],
            'family_name' => $request['family_name'],
            'middle_name' => $request['middle_name'],
            'age' => $request['age'],
            'sex' => $request['sex'],
        ]);
    }

    public function show($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $member = Member::findOrFail($id);
        $this->validate($request, [
            'first_name' => 'required|string|max:50',
            'family_name' => 'required|string|max:50',
            'middle_name' => 'required|string|max:50',
            'age' => 'required|integer',
            'sex' => 'required|string|max:50',
        ]);
        $member->update($request->all());
    }

    public function destroy($id)
    {
        $member = Member::findOrFail($id);
        $member->delete();
    }
}
