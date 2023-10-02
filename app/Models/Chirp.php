<?php

namespace App\Models;

use App\Events\ChirpCreatedEvent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chirp extends Model
{
    use HasFactory;
    /**
     * Champs qu'on peut soumettre
     */
    protected $fillabe = [
        'message'
    ];

    //établir une connexion entre un commentaire et son User
    public function user(){
        return $this->belongsTo(User::class);
    }

    protected $dispatchesEvents = [
        'created' => ChirpCreatedEvent::class,
        // 'updated' => ,
        // 'deleted' => ,
    ];

    /**
     * Champs qu'on ne peut pas soumettre
     */
    protected $guarded = [];


}
