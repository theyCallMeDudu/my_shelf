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

    public function retornoLivro($autor = null, $assunto = null, $editora = null, $titulo = null) {
        // select * from livro inner join autor on livro.fk_autor_id = autor.id;
        $retorno = null;

        $sql = "";
        $sql .= "SELECT";
        $sql .= " l.id,";
        $sql .= " l.titulo,";
        $sql .= " l.ano,";
        $sql .= " c.nome as capa,";
        $sql .= " a.nome as autor,";
        $sql .= " e.nome as editora,";
        $sql .= " ass.nome as assunto";
        $sql .= " FROM livro as l";
        $sql .= " LEFT JOIN capa_livro as c ON l.id = c.fk_livro_id";
        $sql .= " INNER JOIN autor as a ON l.fk_autor_id = a.id";
        $sql .= " INNER JOIN editora as e ON l.fk_editora_id = e.id";
        $sql .= " INNER JOIN assunto as ass ON l.fk_assunto_id = ass.id";
        $sql .= " WHERE 1 = 1 ";

        if (isset($autor) && $autor != '') {
            $sql .= " AND a.id = " .$autor;
        }

        if (isset($assunto) && $assunto != '') {
            $sql .= " AND ass.id = " .$assunto;
        }

        if (isset($editora) && $editora != '') {
            $sql .= " AND e.id = " .$editora;
        }

        if (isset($titulo) && $titulo != '') {
            $sql .= " AND l.id = " .$titulo;
        }
        

        $retorno = DB::select($sql);
        return $retorno;
    }
}
