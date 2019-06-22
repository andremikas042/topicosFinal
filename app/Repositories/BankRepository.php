<?php

namespace App\Repositories;

use App\Animal;
use App\conta;
use App\Cow;
use App\Bull;
use App\Base\Repository;
use App\Http\Requests;

class BankRepository extends Repository
{
    protected function getClass()
    {
        return conta::class;
    }

    public function createAccont($data)
    {
        return $this->model->create($data);
    }

    public function updateAccont($data, $saldo)
    {
        return $this->model->update($data);
    }
}
