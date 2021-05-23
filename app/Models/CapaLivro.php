<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CapaLivro extends Model
{
    protected $table = 'capa_livro';
    public $primaryKey = 'id';
    public $incrementing = true;
    protected $fillable = [ 'nome', 'fk_livro_id' ];
    public $timestamps = false;

    public function relLivro() {
        return $this->belongsTo(Livro::class, 'fk_livro_id');
    }
    
}
