<?php

namespace App\Http\Controllers;


use App\Temporada;
use Illuminate\Http\Request;

class EpisodiosController extends Controller
{
    public function index(Temporada $temporada) // esse paramento vem da rota
    {
        $episodios = $temporada->episodios;
        // echo "<pre>";
        // var_dump($episodios);
        // echo "</pre>";
        return view('episodios.index', compact('episodios'));
    }
}
