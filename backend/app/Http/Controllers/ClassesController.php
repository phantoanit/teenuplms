<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Classes;

class ClassesController extends Controller
{
    public function store(Request $request)
    {
        $model = new Classes;
        $model->create([
            'name' => $request->input('name'),
            'subject' => $request->input('subject'),
            'day_of_week' => $request->input('day_of_week'),
            'time_slot' => $request->input('time_slot'),
            'teacher_name'  => $request->input('teacher_name'),
            'max_students' => $request->input('max_students')
        ]);
        return response(['success' => 1]);
    }

    public function index(Request $request)
    {
        $model = new Classes;
        if ($request->input('day')) {
            $model = $model->where('day_of_week', $request->input('day'));
        }
        return $model->get();
    }
}
