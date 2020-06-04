<?php

namespace App\Http\Controllers;

use App\Episodio;
use App\Http\Requests\SeriesFormRequest;
use App\Serie;
use App\Services\CriadordeSerie;
use App\Services\RemoverdorDeSerie;
use App\Temporada;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SeriesController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth'); // authenticacao para todas as rotas do controller
    // }
    public function index(Request $request)
    {
        // protegendo uma funcao
        //     if (!Auth::check()) {
        //         echo "Não autenticado";
        //         exit();
        //     }

        $series = Serie::query()
            ->orderBy('nome')
            ->get();
        $mensagem = $request->session()->get('mensagem');

        return view('series.index', compact('series', 'mensagem'));
    }

    public function create()
    {
        return view('series.create');
    }

    public function store(SeriesFormRequest $request, CriadordeSerie $criadordeSerie)
    {

        $serie = $criadordeSerie->criarSerie(
            $request->nome,
            $request->qtd_temporadas,
            $request->ep_por_temporada
        );

        $request->session()
            ->flash(
                'mensagem',
                "Série {$serie->id} e suas temporadas e episodios criada com sucesso {$serie->nome}"
            );

        return redirect()->route('listar_series');
    }

    public function destroy(Request $request, RemoverdorDeSerie $removerdorDeSerie)
    {
        $nomeserie = $removerdorDeSerie->removerSerie($request->id);
        $request->session()
            ->flash(
                'mensagem',
                "Série $nomeserie removida com sucesso"
            );
        return redirect()->route('listar_series');
    }
    public function editaNome(Request $request)
    {
        $novoNome = $request->nome; // vem do form Data
        $serie = Serie::find($request->id);
        $serie->nome = $novoNome;
        $serie->save();
    }
}
