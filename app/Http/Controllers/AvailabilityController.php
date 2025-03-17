<?php

namespace App\Http\Controllers;

use App\Models\Availability;
use Illuminate\Http\Request;

class AvailabilityController extends Controller
{
    public function index()
    {
        $availability = Availability::with('dentist')->get();
        return response()->json($availability);
    }

    public function store(Request $request)
    {
        $request->validate([
            'dentist_id' => 'required|exists:dentists,id',
            'date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required',
        ]);

        $availability = Availability::create($request->all());

        return response()->json($availability, 201);
    }

    public function destroy($id)
    {
        Availability::destroy($id);
        return response()->json(['message' => 'Availability deleted']);
    }
}
