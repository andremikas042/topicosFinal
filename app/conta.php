<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\DocBlock\Tags\Uses;

class conta extends Model
{
    protected $fillable = ['id','numero', 'saldo', 'id_users'];

    public $rulles = Array(
        'id' => 'required',
        'numero' => 'required',
        'saldo' => 'required',
        'id_users' => 'required'
    );

    public function users()
    {
        return $this->belongsToMany(User::class, 'id_users');
    }

    public function search(Array $data)
    {
        $users = $this->where(function ($query) use ($data) {
            if (isset($data['name'])) ;
            $query->where('id', 'like', '%' . $data['name'] . '%');
        });
        return $users->get();
    }
}
