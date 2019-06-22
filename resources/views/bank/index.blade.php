@extends('layouts.app', ['title' => __('User Management')])

@section('content')
    @include('bank.partials.bankcard')

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-3 float-left">
                                <h3 class="mb-0">Gerenciamento de Contas</h3>
                            </div>
                            <div class="col-lg-6 col-12">
                                <form action="{{ route('bank.search') }}" method="POST" role="search">
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
                            <div class="col-3 float-right">
                                @if($title == 'search')
                                    <a href="{{route('bank.index')}}" class="btn btn-danger">
                                        <i class="fa fa-arrow-left"></i>Voltar</a>
                                @endif
                                @if($title == 'Bank')
                                    <a href="{{ route('bank.create') }}" class="btn btn-primary">
                                        <i class="fa fa-plus mr-2"></i>Nova Conta</a>
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

                    @if(auth()->user()->tipo == 'on')
                        @include('users.partials.auth')
                    @else
                        @include('users.partials.guest')
                    @endif

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