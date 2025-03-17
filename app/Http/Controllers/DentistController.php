<?php

namespace App\Http\Controllers;

use App\Models\Dentist;
use Illuminate\Http\Request;

class DentistController extends Controller
{
     // Get all dentists
     public function index()
     {
         $dentists = Dentist::all();
         return response()->json($dentists);
     }
 
     // Store a new dentist
     public function store(Request $request)
     {
        $data = $request->validate([
             'name' => 'required|string|max:255',
             'specialty' => 'required|string|max:255',
             'availability' => 'required|string|max:255',
        ]);
 
        $dentist = Dentist::create($data);
 
         return response()->json($dentist, 201);
     }
 
     // Get a specific dentist by ID
     public function show($id)
     {
         $dentist = Dentist::findOrFail($id);
         return response()->json($dentist);
     }
 
     // Update a dentist
     public function update(Request $request, $id)
     {
         $data = $request->validate([
             'name' => 'sometimes|string|max:255',
             'specialty' => 'sometimes|string|max:255',
             'availability' => 'sometimes|string|max:255',
         ]);
 
         $dentist = Dentist::findOrFail($id);
         $dentist->update($data);
 
         return response()->json($dentist);
     }
 
     // Delete a dentist
     public function destroy($id)
     {
         $dentist = Dentist::findOrFail($id);
         $dentist->delete();
 
         return response()->json(['message' => 'Dentist deleted successfully']);
     }
}
