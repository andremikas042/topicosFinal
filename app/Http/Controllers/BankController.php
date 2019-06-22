<?php

namespace App\Http\Controllers;

use App\conta;
use App\User;
use App\Repositories\BankRepository;
use Illuminate\Http\Request;


class BankController extends Controller
{
    private $paginate = 10;

    public function index(User $user)
    {
        $title = 'Bank';
        $users = $user->all();
        $contas = conta::paginate($this->paginate);
        return view('bank.index', ['contas' => $contas], compact('title', 'users'));
    }

    public function create(conta $conta, User $user)
    {
        $title = 'Create new Conta';
        $contas = $conta->all();
        $users = $user->all();
        return view('bank.create', compact('contas', 'users', 'title'));
    }

    public function store(Request $request, conta $conta)
    {
        $data = $request->all();
        $saldoAtual = 0;
        $saldoAtual = (string)$saldoAtual;
        $data['saldo'] = $saldoAtual;
//    dd($data);
        $conta->create($data);

        return redirect()->route('bank.index')
            ->with("sucesso", "Registro Gravado Com Sucesso");
    }

    public function edit(conta $conta)
    {
        $contas = $conta->all();
        return view('bank.edit', compact('contas'));
    }

    public
    function update(Request $request, conta $conta)
    {
        $data = $request->all();
        $saldoAtual = 0;
        $saldoAtual = (string)$saldoAtual;
        $data['saldo'] = $saldoAtual;

        $conta->create($data);

        return redirect()->route('bank.index')
            ->with("sucesso", "Registro Atualizado Com Sucesso");

    }

    public function show(/*FlockRepository $repository, $id*/)
    {
//        $animal = $repository->find($id);
//        return view('animals.flock.show', compact('animal', 'id'));
    }

    public function destroy($id, conta $conta)
    {
        try {
            $data = $conta->find($id);
            $data->delete();
            //ou
            //$estado->destroy($id);
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()
                ->action("BankController@index")
                ->with("erro", "Houve um erro ao excluir o registro");
        }

        return redirect()
            ->action("BankController@index")
            ->with("sucesso", "Registro excluído com sucesso");
    }

    public function search(Request $request, conta $conta)
    {
        $title = 'search';
        $dataForm = $request->all();
        $contas = $conta->search($dataForm);

        return view('bank.index', compact('contas', 'title'));
    }

    public function deposito(conta $conta, BankRepository $bankRepository, Request $request, $saldo)
    {
        $valor = $request->valor;
        $saldoInicial = $bankRepository->find($saldo);
        if ($valor < 0) {
            dd('valor negativo!!!' . $valor);
            return redirect()
                ->action("BankController@index")
                ->with("erro", "Não é possível depositar um valor negativo");
        } else if ($valor > 0) {
            $saldoAtual = $saldoInicial + $valor;
            $saldo = (string)$saldoAtual;
            $data['saldo'] = $saldo;
            $animal = $bankRepository->updateAccont($data, $saldo);
            $data->update());
            return redirect()
                ->action("BankController@index")
                ->with("sucesso", "Depósito efetuado com sucesso");
        } else {
            return $php_errormsg;
        }

    }

    public function saque()
    {
        //
    }

    public function transferenca()
    {
        //
    }

}