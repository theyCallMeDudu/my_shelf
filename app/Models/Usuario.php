<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table = 'usuario';
    public $primaryKey = 'id';
    public $incrementing = true;
    protected $fillable = [ 'nome', 'email', 'senha' ];
    public $timestamps = false;

    
}
