<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Assunto;

class Livro extends Model
{
    protected $table = 'livro';
    public $primaryKey = 'id';
    public $incrementing = true;
    protected $fillable = [ 'titulo', 'ano', 'paginas', 'fk_assunto_id', 'fk_autor_id', 'fk_editora_id' ];
    public $timestamps = false;

    protected $guarded = [];

    public function relAutor(){
        return $this->hasOne('App\Models\Autor', 'id', 'fk_autor_id');
    }

    public function relAssunto(){
        return $this->hasOne('App\Models\Assunto', 'id', 'fk_assunto_id');
    }

    public function relEditora(){
        return $this->hasOne('App\Models\Editora', 'id', 'fk_editora_id');
    }

    public function relCapaLivro() {
        return $this->hasOne(CapaLivro::class, 'fk_livro_id');
    }

    public function relTeste() {
        return $this->hasOne(Autor::class, 'id');
    }

    public function retornoLivro($livro) {
        // select * from livro inner join autor on livro.fk_autor_id = autor.id;
        $sql = "SELECT * FROM livro ";
        $sql .= "INNER JOIN autor ";
        $sql .= "on livro.fk_autor_id = autor.id";

        $retorno = DB::select($sql);
        return $retorno;
    }
}
