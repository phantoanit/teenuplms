<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Subscriptions;

class SubscriptionsController extends Controller
{
    public function store(Request $request)
    {
        $model = new Subscriptions;
        $model->create([
            'student_id' => $request->input('student_id'),
            'package_name' => $request->input('package_name'),
            'start_date' => Carbon::parse($request->input('start_date')),
            'end_date' => Carbon::parse($request->input('end_date')),
            'total_sessions' => $request->input('total_sessions'),
            'used_sessions' => $request->input('total_sessions'),
        ]);
        return response(['success' => 1]);
    }

    public function update(Request $request, $id)
    {
        $model = new Subscriptions;
        $data = $model->find($id);
        if (!$data) {
            return response(['success' => 0, 'message' => 'Không có gói học tồn tại']);
        } else {
            $data->decrement('used_sessions');
        }
        return response(['success' => 1]);
    }

    public function show(Request $request, $id)
    {
        $model = new Subscriptions;
        return $model->find($id);
    }
}
