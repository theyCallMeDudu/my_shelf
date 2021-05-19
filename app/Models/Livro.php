<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Livro extends Model
{
    protected $table = 'livro';
    public $primaryKey = 'id';
    public $incrementing = true;
    protected $fillable = [ 'titulo', 'ano', 'paginas', 'fk_assunto_id', 'fk_autor_id', 'fk_editora_id' ];
    public $timestamps = false;

    public function relAutor(){
        return $this->hasOne('App\Autor', 'id', 'fk_autor_id');
    }

    public function relAssunto(){
        return $this->hasOne('App\Assunto', 'id', 'fk_assunto_id');
    }

    public function relEditora(){
        return $this->hasOne('App\Editora', 'id', 'fk_editora_id');
    }
}
