<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Students;
use Illuminate\Support\Carbon;

class StudentsController extends Controller
{
    public function store(Request $request)
    {
        $model = new Students;
        $model->create([
            'name' => $request->input('name'),
            'dob' => Carbon::parse($request->input('dob')),
            'gender' => $request->input('gender'),
            'current_grade'  => $request->input('current_grade'),
            'parent_id' => $request->input('parent_id')
        ]);
        return response(['success' => 1]);
    }

    public function index(Request $request)
    {
        $model = new Students;
        return $model->get();
    }

    public function show(Request $request, $id)
    {
        $model = new Students;
        return $model->find($id);
    }
}
