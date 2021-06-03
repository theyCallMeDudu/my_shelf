<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FotoUser extends Model
{
    protected $table = 'foto_user';
    public $primaryKey = 'id';
    public $incrementing = true;
    protected $fillable = [ 'nome', 'user_id' ];
    public $timestamps = false;

    public function relUser() {
        return $this->belongsTo(User::class, 'user_id');
    }
    
}
