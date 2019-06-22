<?php

namespace App\Http\Controllers;

use App\User;
use App\conta;
use App\Http\Requests\UserRequest;
use http\Env\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(User $model, conta $conta)
    {
        $title = 'Users';
        $contas = $conta->all();
        return view('users.index', ['users' => $model->paginate(15)], compact('contas', 'title'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(UserRequest $request, User $model)
    {
        $data = $request->all();
        $tipo = $request->tipo;
        if($tipo == null){
            $tipo = 'off';
        }
        $data['tipo'] = $tipo;
        $password = ['password' => Hash::make($request->get('password'))];
        $password = implode(" ",$password);
        $data['password'] = $password;
//        dd($data);
        $model->create($data);

        return redirect()->route('user.index')->withStatus(__('User successfully created.'));
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(UserRequest $request, User  $user)
    {
        $user->update(
            $request->merge(['password' => Hash::make($request->get('password'))])
                ->except([$request->get('password') ? '' : 'password']
                ));

        return redirect()->route('user.index')->withStatus(__('User successfully updated.'));
    }

    public function destroy(User  $user)
    {
        $user->delete();

        return redirect()->route('user.index')->withStatus(__('User successfully deleted.'));
    }

    public function search(UserRequest $request, User $user)
    {
        $title = 'search';
        $dataForm = $request->all();
        $users = $user->search($dataForm);
        return view('user.index', compact('users', 'title'));
    }
}
