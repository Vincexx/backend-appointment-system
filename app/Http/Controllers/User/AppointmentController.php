<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    public function index()
    {
        $appointments = Appointment::where('user_id', Auth::id())
            ->with(['service', 'dentist', 'location'])
            ->get();

        return response()->json($appointments);
    }

    public function store(Request $request)
    {
        $request->validate([
            'service_id' => 'required|exists:services,id',
            'dentist_id' => 'required|exists:dentists,id',
            'location_id' => 'required|exists:locations,id',
            'appointment_time' => 'required|date_format:Y-m-d H:i:s',
        ]);

        $appointment = Appointment::create([
            'user_id' => Auth::id(),
            'service_id' => $request->service_id,
            'dentist_id' => $request->dentist_id,
            'location_id' => $request->location_id,
            'appointment_time' => $request->appointment_time,
            'status' => 'pending',
        ]);

        return response()->json($appointment, 201);
    }

    public function update(Request $request, $id)
    {
        $appointment = Appointment::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $request->validate([
            'appointment_time' => 'nullable|date_format:Y-m-d H:i:s',
            'status' => 'nullable|in:pending,confirmed,cancelled',
        ]);

        $appointment->update($request->only('appointment_time', 'status'));

        return response()->json($appointment);
    }

    public function destroy($id)
    {
        $appointment = Appointment::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $appointment->delete();

        return response()->json(['message' => 'Appointment cancelled']);
    }
}
