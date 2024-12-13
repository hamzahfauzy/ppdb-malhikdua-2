<?php

namespace App\Http\Controllers\Staff;

use App\Models\Staff;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OperatorController extends Controller {

    public function index()
    {
        $data = Staff::where('is_admin', 0)->get();
        return view('staff.operator.index', compact('data'));
    }

    public function create()
    {
        return view('staff.operator.create', [
            'operator' => null
        ]);
    }

    public function edit(Staff $operator)
    {
        return view('staff.operator.edit', [
            'operator' => $operator
        ]);
    }

    public function store(Request $request)
    {
        $request->merge([
            'status' => 'ACTIVE',
            'is_admin' => 0,
            'password' => bcrypt($request->password),
        ]);

        Staff::create($request->all());
        return redirect()->route('staff.operator.index')->with(['success' => 'Berhasil membuat operator']);
    }
    
    public function update(Request $request, Staff $operator)
    {
        if(empty($request->password))
        {
            unset($request['password']);
        }
        else
        {
            $request['password'] = bcrypt($request->password);
        }

        $operator->update($request->all());
        return redirect()->route('staff.operator.index')->with(['success' => 'Berhasil update operator']);
    }

}