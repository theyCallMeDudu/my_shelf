<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Autor extends Model
{
    protected $table = 'autor';
    public $primaryKey = 'id';
    public $incrementing = 'true';
    protected $fillable = [ 'nome' ];

    public function relLivro(){
        return $this->hasMany('App\Models\Livro', 'fk_autor_id');
    }
}
