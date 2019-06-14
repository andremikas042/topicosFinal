<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\DocBlock\Tags\Uses;

class conta extends Model
{
    protected $fillable = Array("numero", "saldo");

    public $rulles = Array(
        'numero' => 'required|min:4',
        'saldo' => 'required|min:2|max:2'
    );

    public function users()
    {
        return $this->belongsToMany(Uses::class, 'id_users');
    }
}
