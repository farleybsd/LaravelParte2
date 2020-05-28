<?php

namespace App\Services;

use App\{Serie, Temporada, Episodio};
use Illuminate\Support\Facades\DB;

class RemoverdorDeSerie
{
    public function removerSerie(int $serieId): string
    {
        $nomeserie = ''; //& valor por referencia

        DB::transaction(function () use (&$nomeserie, $serieId) {
            $serie = Serie::find($serieId);

            $nomeserie = $serie->nome;

            $serie->temporadas->each(function (Temporada $temporada) {


                $temporada->episodios->each(function (Episodio $episodio) {
                    $episodio->delete();
                });
                $temporada->delete();
            });
            $serie->delete();
        });


        return $nomeserie;
    }
}
