<?php

namespace App\Http\Controllers\Api\Map_Attendances;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use Illuminate\Http\Request;

class GetAttendancesController extends Controller
{
    public function index(Request $request)
    {
        $userId = $request->input('user_id');
        $generalId = $request->input('general_id');
        $date = $request->input('date');

        $attendances = Attendance::where('user_id', $userId)
            ->where('general_id', $generalId)
            ->whereDate('created_at', $date)
            ->get();

        return response()->json($attendances);
    }
}
