<?php

namespace Tests\Feature;

use App\Services\CriadordeSerie;
use App\Services\RemoverdorDeSerie;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RemovedorSerieTest extends TestCase
{
    /** @var Serie */
    private $serie;
    use RefreshDatabase;
    protected function setUp(): void
    {
        parent::setUp();
        $criadorDeSerie = new CriadordeSerie();
        $this->serie = $criadorDeSerie->criarSerie(
            'Nome da série',
            1,
            1
        );
    }

    public function testRemoverUmaSerie()
    {
        $this->assertDatabaseHas('series', ['id' => $this->serie->id]);
        $removedorDeSerie = new RemoverdorDeSerie();
        $nomeSerie = $removedorDeSerie->removerSerie($this->serie->id);
        $this->assertIsString($nomeSerie);
        $this->assertEquals('Nome da série', $this->serie->nome);
        $this->assertDatabaseMissing('series', ['id' => $this->serie->id]);
    }
}
