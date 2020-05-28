<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

    class Episodio extends Model
    {
        protected $fillable = ['numero'];
        public $timestamps = false;


        //Relacionamento
        public function Temporada()
        {
            return $this->belongsTo(Temporada::class);//Episodio Pertence a uma temporada
        }
    }
