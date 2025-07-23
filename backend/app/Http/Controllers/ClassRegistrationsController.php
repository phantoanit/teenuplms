<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClassRegistrations;
use App\Models\Classes;
use App\Models\Students;

class ClassRegistrationsController extends Controller
{
    public function register(Request $request, $id)
    {
        
        $classes = new Classes;

        $time_slot = $request->input('time_slot');
        $classExists = $classes->where('time_slot', $time_slot)
            ->where('id', '!=', $id)
            ->exists();
        if ($classExists) {
            return response(['success' => 0, 'message' => 'Lớp học khác cùng khung giờ đã tồn tại']);
        }

        $classItem = $classes->find($id);
        if (!$classItem) {
            return response(['success' => 0, 'message' => 'Lớp học không tồn tại']);
        }

        $students = new Students;
        if (!$students->find($request->input('student_id'))) {
            return response(['success' => 0, 'message' => 'Học sinh không tồn tại']);
        }

        $model = new ClassRegistrations;
        $model->create([
            'class_id' => $id,
            'student_id' => $request->input('student_id'),
        ]);
        return response(['success' => 1]);
    }
}
