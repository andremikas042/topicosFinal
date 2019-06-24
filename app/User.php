<?php

namespace App;

use http\Exception;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\QueryException;
use App\conta;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'tipo',
        'name',
        'cpf',
        'email',
        'password',
        'cep',
        'cidade',
        'estado',
        'numero',
        'rua',
    ];

    public $rulles = Array(
        'tipo' => 'required|min:4',
        'nome' => 'required|min:4',
        'cpf' => 'required|min:11',
        'email' => 'required|min:11',
        'password' => 'required|min:8',
        'cep' => 'required|min:8',
        'cidade' => 'required|min:25',
        'estado' => 'required|min:25',
        'numero' => 'required|min:5',
        'rua' => 'required|min:50',
    );

    public function user()
    {
        return $this->belongsToMany(conta::class, 'id_contas');
    }


    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

//    public function conta()
//    {
//        return $this->hasOne(conta::class);
//    }

    public function conta()
    {
        return $this->hasOne(conta::class, 'id_contas');
    }

    public function search(Array $data)
    {
        $users = $this->where(function ($query) use ($data) {
            if (isset($data['name'])) {
                $query->where('name', 'like', '%' . $data['name'] . '%');
            } else {
                $error = db2_stmt_error();
                return redirect()
                    ->action("CidadeController@listar")
                    ->with("error", "Houve um erro ao excluir o registro");
            }
        });
        return $users->get();
    }
}
