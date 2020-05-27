    <?php

    namespace App;

    use Illuminate\Database\Eloquent\Model;

    class Temporada extends Model
    {
        public function episodios()
        {
            return $this->hasMany(Episodio::class);//muitos episodios
        }

        //Relacionamento
        public function serie()
        {

            return $this->belongsTo(Serie::class); // Temporada pertence a uma serie

        }
    }
