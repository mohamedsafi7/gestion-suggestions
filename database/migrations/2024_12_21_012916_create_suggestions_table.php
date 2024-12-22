<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Suggestion;

class SuggestionController extends Controller
{
    /**
     * Store a new suggestion.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date',
            'statut' => 'nullable|in:en attente,approuvée,rejetée',
            'priorite' => 'required|in:basse,moyenne,haute',
            'perte_temps' => 'required|integer|min:0',
            'gain_temps' => 'required|integer|min:0',
            'motif' => 'required|string',
            'user_id' => 'required|exists:users,id',
        ]);

        // Create a new suggestion
        $suggestion = Suggestion::create($validatedData);

        return response()->json([
            'message' => 'Suggestion added successfully!',
            'suggestion' => $suggestion,
        ], 201);
    }
}
