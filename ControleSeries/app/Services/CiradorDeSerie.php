<?php
namespace App\Services;
use App\Serie;

class CriadordeSerie
{
    public function criarSerie(string $nomeSerie, int $qtd_temporadas, int $ep_por_temporada): Serie
    {
        $serie = Serie::create(['nome' => $nomeSerie]);
        $qtdTemporadas = $qtd_temporadas; // inpourt do html

        for ($i = 1; $i < $qtdTemporadas; $i++) {
            $temporada =  $serie->temporadas()->create(['numero' => $i]); // chama o  relacionamento de serie com temporada


            for ($j = 1; $j < $ep_por_temporada; $j++) {
                $temporada->episodios()->create(['numero' => $j]);
            }
        }

        return $serie;
    }
}
