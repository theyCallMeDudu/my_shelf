<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assunto extends Model
{
    protected $table = 'assunto';
    public $primaryKey = 'id';
    public $incrementing = true;
    protected $fillable = [ 'nome' ];
    public $timestamps = false;

    public function relLivro(){
        return $this->hasMany('App\Models\Livro', 'fk_assunto_id');
    }
}
