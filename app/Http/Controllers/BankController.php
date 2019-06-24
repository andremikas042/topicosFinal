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
        return view('bank.index', ['contas' => $contas], compact('title', 'users', 'contas'));
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

    public function update(Request $request, conta $conta)
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

    public function deposito(conta $conta, Request $request, $id)
    {
        $contas = $conta->all();
        $valor = $request->saldoValor;
        if ($valor < 0) {
            dd('valor negativo!!!' . $valor);
            return redirect()
                ->action("BankController@index")
                ->with("erro", "Não é possível depositar um valor negativo");
        } else if ($valor > 0) {
            $contas = $conta->find($id);
            $saldo = $contas->saldo;
            $saldoAtual = $saldo + $valor;
            $saldonovo = (string)$saldoAtual;
            $contas->update([
                'id' => $request['id'],
                'numero' => $contas['numero'],
                'saldo' => $saldonovo,
                'id_users' => $contas['id_users'],
            ]);
            return redirect()
                ->action("BankController@index")
                ->with("sucesso", "Depósito efetuado com sucesso");
        } else {
            return redirect()->action("BankController@index");
        }

    }

    public function saque(conta $conta, Request $request, $id)
    {
        $contas = $conta->all();
        $valor = $request->valor;
//        dd($valor);
        if ($valor < 0) {
            dd('valor negativo!!!' . $valor);
            return redirect()
                ->action("BankController@index")
                ->with("erro", "Não é possível sacar um valor negativo");
        } else if ($valor > 0) {
            $contas = $conta->find($id);
            $saldo = $contas->saldo;
            $saldoAtual = $saldo - $valor;
            $saldonovo = (string)$saldoAtual;
//            dd($saldonovo);
            $contas->update([
                'id' => $request['id'],
                'numero' => $contas['numero'],
                'saldo' => $saldonovo,
                'id_users' => $contas['id_users'],
            ]);
            return redirect()
                ->action("BankController@index")
                ->with("sucesso", "Depósito efetuado com sucesso");
        } else {
            return redirect()->action("BankController@index");
        }
    }

    public function transferencia(conta $conta, User $user, Request $request, $id)
    {
        dd($id);
        $usuarios = $user->all();
        $contas = $conta->all();
        $valor = $request->valor;
        $idUser = $request->idUser;
        if ($idUser != auth()->id()) {
            return redirect()
                ->action("BankController@index")
                ->with("erro", "Não é possível transferir um valor pra si mesmo! escolha outra conta!");
        } else if ($valor > 0) {
            $contas = $conta->find($id);
            $usuarios = $user->find($id);
            $saldo = $contas->saldo;
            $saldoAtual = $saldo - $valor;
            $saldonovo = (string)$saldoAtual;
//            dd($saldonovo);
            $contas->update([
                'id' => $request['id'],
                'numero' => $contas['numero'],
                'saldo' => $saldonovo,
                'id_users' => $contas['id_users'],
            ]);
            return redirect()
                ->action("BankController@index")
                ->with("sucesso", "Depósito efetuado com sucesso");
        } else {
            return redirect()->action("BankController@index");
        }
    }

}