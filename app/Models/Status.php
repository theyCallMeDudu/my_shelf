<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Livro;
use App\Models\User;
use App\Models\UserLivro;

class Status extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'status';
    public $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = false;
    protected $fillable = ['nome'];

    public function relUserLivro(){
        return $this->hasMany('App\Models\UserLivro', 'fk_status_id');
    }

}