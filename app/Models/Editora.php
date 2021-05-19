<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Editora extends Model
{
    protected $table = 'editora';
    public $primaryKey = 'id';
    public $incrementing = 'true';
    protected $fillable = [ 'nome' ];

    public function relLivro(){
        return $this->hasMany('App\Models\Livro', 'fk_editora_id');
    }
}
