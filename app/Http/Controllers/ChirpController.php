<?php

namespace App\Http\Controllers;

use App\Models\Chirp;
use App\Models\User;
use App\Notifications\NewChirp;
use Illuminate\Http\Request;
use Notification;

class ChirpController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // dd(User::all());
        //
        return view("chirps.index", [
            //ici j'ai un tableau associatif avec une clé et une valeur
            'chirps' => Chirp::orderBy('created_at', 'DESC')->get()
        ]); //chirps en simple guillemet ici est utilisé pour afficher les éléments dans le view
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validated = $request->validate([
            'message' => 'required|string|max:255',
        ]);

        //envoi des données au BDD
        $createdChirp = $request->user()->chirps()->create($validated);
        // dd($createdChirp);
        // $createdChirp->notify(User::all(), new NewChirp($createdChirp)); // envoie une notification
        // Notification::send(["tiburcekouagou@gmail.com"]);
        //rediriger sur chirps.index
        return redirect(route('chirps.index'));

        // dd($validated);
        // dd($request->user());
    }

    /**
     * Show the form for editing the specified resource.
     * Permet de montrer le formulaire quand on veut éditer
     */
    public function edit(Chirp $chirp)
    {
        //
        // dd('En cours d\édition ');
        return view('chirps.edit', ['chirp' => $chirp]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Chirp $chirp)
    {
        //vérifier que l'utlisateur à l'autorisation de mise à jour de commentaires
        $this->authorize('update', $chirp);

        // dd('Mise à jour en cours');
        $validated = $request->validate([
            'message' => 'required|string|max:255',
        ]); //validation des données

        $chirp->update($validated); //mise à jour

        return redirect(route('chirps.index')); //redirection
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Chirp $chirp)
    {
        //vérifier l'autorisation de l'utiliateur
        $this->authorize('delete', $chirp);

        //supprimer la ressource
        $chirp->delete();

        //rediriger vers la page des commentaires
        return redirect(route('chirps.index'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Chirp $chirp)
    {
        //
    }

}