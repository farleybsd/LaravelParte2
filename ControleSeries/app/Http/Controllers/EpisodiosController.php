<?php

namespace App\Http\Controllers;

use App\Episodio;
use App\Temporada;
use Illuminate\Http\Request;

class EpisodiosController extends Controller
{
    public function index(Temporada $temporada, Request $request) // esse paramento vem da rota
    {
        //$episodios = $temporada->episodios;
        // echo "<pre>";
        // var_dump($episodios);
        // echo "</pre>";
        $temporadaId = $temporada->id;
        return view('episodios.index', [
            'episodios' => $temporada->episodios,
            'temporadaId' => $temporada->id,
            'mensagem' => $request->session()->get('mensagem')
        ]);
    }

    public function assistir(Temporada $temporada, Request $request)
    {
        //var_dump($request->episodios); //name do input do html
        $episodioAssistido = $request->episodios;
        $temporada->episodios->each(function (Episodio $episodio) use ($episodioAssistido) {
            $episodio->assistido = in_array($episodio->id, $episodioAssistido); //coluna do banco

            // $episodio->save();
        }); // each e tipo um cursos ele execulta uma funcao passando o seu valor de parametro varivas vezes

        $temporada->push();
        //return redirect('/temporadas/' . $temporada->id . '/episodios');
        $request->session()->flash('mensagem', 'Episódios Marcados como assistidos');
        return redirect()->back();
    }
}
