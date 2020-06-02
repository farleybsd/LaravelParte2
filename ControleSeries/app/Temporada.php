<?php

namespace App;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class Temporada extends Model
{

    protected $fillable = ['numero'];
    public $timestamps = false;

    public function episodios()
    {
        return $this->hasMany(Episodio::class); //muitos episodios
    }

    //Relacionamento
    public function serie()
    {

        return $this->belongsTo(Serie::class); // Temporada pertence a uma serie

    }

    public function getEpisodiosAssistidos(): Collection
    {
        return $this->episodios->filter(function (Episodio $episodio) {

            return $episodio->assistido;
        });
    }
}
