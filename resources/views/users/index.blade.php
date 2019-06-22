@extends('layouts.app', ['title' => __('User Management')])

@section('content')
    @include('layouts.headers.cards')
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-2 float-left">
                                <h3 class="mb-0">Usuários</h3>
                            </div>
                            <div class="col-lg-7 mr-6 col-12">
                                <form action="{{ route('user.search') }}" method="POST" role="search">
                                    {{ csrf_field() }}
                                    <div class="input-group">
                                        <input type="text" class="form-control"
                                               name="name" placeholder="Pesquisar...">
                                        <span class="input-group-btn">
                                        <button type="submit" class="btn btn-outline-light">
                                            <span class="fa fa-search"></span>
                                         </button>
                                    </span>
                                    </div>
                                </form>
                            </div>
                            <div class="col-2 float-right">
                                @if($title == 'search')
                                    <a href="{{route('user.index')}}" class="btn btn-danger">
                                        <i class="fa fa-arrow-left"></i>Voltar</a>
                                @endif
                                @if($title == 'Users')
                                    <a href="{{ route('user.create') }}" class="btn btn-primary">
                                        <i class="fa fa-plus mr-2"></i>Novo Usuário</a>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        @if (session('status'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('status') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                    </div>

                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Creation Date</th>
                                <th scope="col">Saldo</th>
                                <th scope="col">Tipo</th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>
                                        <a href="mailto:{{ $user->email }}">
                                            {{ $user->email }}
                                        </a>
                                    </td>
                                    <td>{{ $user->created_at->format('d/m/Y H:i') }}</td>
                                    <td>
                                        @foreach($contas as $conta)
                                            R${{ $conta->saldo}}
                                        @endforeach
                                    </td>
                                    <td> {{$user->tipo}} </td>
                                    <td class="text-right">
                                        <div class="btn-group">
                                            @if ($user->id != auth()->id())
                                                <form action="{{ route('user.destroy', $user) }}" method="post">
                                                    @csrf
                                                    @method('delete')

                                                    <a class="btn btn-group  btn-success"
                                                       href="{{ route('user.edit', $user) }}">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <button type="button" class="btn btn-group btn-danger"
                                                            onclick="confirm('{{ __("Are you sure you want to delete this user?") }}') ? this.parentElement.submit() : ''">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </form>
                                            @else
                                                <a class="btn btn-group btn-success"
                                                   href="{{ route('profile.edit') }}">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer py-4">
                        <nav class="d-flex justify-content-end" aria-label="...">
                            @if($title == 'Users')
                                {{$users->links()}}
                            @endif
                            @if($title == 'search')
                                <a href="{{route('user.index')}}" class="btn btn-sm btn-danger">
                                    <i class="fa fa-arrow-left"></i>@lang('labels.Back')
                                </a>
                            @endif
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        @include('layouts.footers.auth')
    </div>
@endsection