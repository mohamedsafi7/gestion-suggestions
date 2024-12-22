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

     public function getSuggestion()
     {
         if (auth()->user()->role_id == 2) {
             // If the user is a Kaizen, show all suggestions
             $suggestions = Suggestion::with('user')->get();
         } elseif (auth()->user()->role_id === 1) {
             // If the user is an employee, show only their own suggestions
             $suggestions = Suggestion::with('user')->where('user_id', auth()->id())->get();
         } else {
             // For other roles, show nothing (or you can customize this behavior)
             $suggestions = collect(); // Empty collection
         }
     
         return view('home', compact('suggestions'));
     }
     
     public function Add()
     {
        return view('add_suggestion');
     }
     
     public function store(Request $request)
     {
         // Valider les données de la requête
         $validatedData = $request->validate([
             'titre' => 'required|string|max:255',
             'description' => 'required|string|max:1000', // Added max length for description
             'date' => 'required|date|after_or_equal:today', // Ensures the date is not in the past
             'statut' => 'nullable|in:en attente,approuvée,rejetée', // Nullable and default will be set in the DB
             'priorite' => 'required|in:basse,moyenne,haute',
             'perte_temps' => 'required|integer|min:0', // Ensure no negative time values
             'gain_temps' => 'required|integer|min:0',
             'motif' => 'required|string|max:255',
         ]);
     
         // Ajouter l'ID de l'utilisateur authentifié aux données validées
         $validatedData['user_id'] = auth()->id();
     
         // Créer une nouvelle suggestion
         $suggestion = Suggestion::create($validatedData);
     
         // Rediriger vers la page d'accueil après l'ajout
         return redirect()->route('getSuggestion')->with('success', 'Suggestion added successfully!');
     }
        
            public function updateStatus(Suggestion $suggestion, Request $request)
        {
            // Ensure only 'responsable' users can update the status
            if (auth()->user()->role_id !== 2) {
                return redirect()->route('getSuggestion')->with('error', 'You are not authorized to perform this action.');
            }

            $request->validate([
                'statut' => 'required|in:en attente,approuvée,rejetée',
            ]);

            $suggestion->update(['statut' => $request->statut]);

            return redirect()->route('getSuggestion')->with('success', 'Status updated successfully!');
        }
            public function destroy($id)
        {
            // Find the suggestion by ID and delete it
            $suggestion = Suggestion::findOrFail($id);
            $suggestion->delete();

            // Redirect back to the suggestions page with a success message
            return redirect()->route('getSuggestion')->with('success', 'Suggestion deleted successfully!');
        }

     
}
