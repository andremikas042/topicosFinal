@extends('layouts.app', ['title' => __('User Management')])

@section('content')
    @include('users.partials.header', ['title' => __('Add User')])

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">
                                    Gerenciamento de Contas
                                </h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('bank.index') }}"
                                   class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('bank.store') }}" enctype="multipart/form-data">
                            @csrf

                            <h6 class="heading-small text-muted mb-4">Criar Contas</h6>


                            <div class="form-group{{ $errors->has('numero') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="numero">Número da Conta</label>
                                <input type="number" name="numero" id="numero" class="form-control" required>

                                @if ($errors->has('numero'))
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('numero') }}</strong>
                                        </span>
                                @endif
                            </div>

                            @if(auth()->user()->tipo == 'on')
                                <div class="form-group{{ $errors->has('id_users') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="user_id">Selecionar o Usuário</label>
                                    <select id="user_id" class="form-control" required name="id_users">
                                        @foreach($users as $user)
                                            <option value="{{$user->id}}"> [ {{$user->id}} ] {{ $user->name }} </option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('user_id'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('user_id') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            @else
                                <div class="form-group{{ $errors->has('id_users') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="user_id">Selecionar o Usuário</label>
                                    <select id="user_id" class="form-control" required name="id_users">
                                        @foreach($users as $user)
                                            <option value="{{auth()->id}}"> [ {{$user->id}} ] {{ $user->name }} </option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('user_id'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('user_id') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            @endif


                            <div class="form-group{{ $errors->has('saldo') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="saldo">Saldo Atual</label>
                                <div class="form-control form-control-alternative">
                                    {{--@foreach($contas as $conta) {{$saldo}} @endforeach--}}0
                                </div>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-success btn-lg mt-4">Agora Vai!</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @include('layouts.footers.auth')
    </div>
@endsection