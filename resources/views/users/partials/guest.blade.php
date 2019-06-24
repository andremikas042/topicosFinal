<div class="table-responsive">
    <table class="table align-items-center table-flush">
        <thead class="thead-light">
        <tr>
            <th scope="col">ID do Usuario</th>
            <th scope="col">ID da Conta</th>
            <th scope="col">Numero da Conta</th>
            <th scope="col">Saldo</th>
            <th scope="col">Creation Date</th>
            <th scope="col">Transações</th>
        </tr>
        </thead>
        <tbody>

        @foreach($users as $user)
            <h2 class="text-hide">{{$user->id}}</h2>
        @endforeach

        @if(auth()->user()->id == $user->id)
            @foreach($contas as $conta)
                <tr>
                    <td> [{{$conta->id_users}}]</td>
                    <td> {{$conta->id}} </td>
                    <td> {{$conta->numero}} </td>
                    <td> {{$conta->saldo}} </td>
                    <td> {{$conta->created_at}} </td>
                    <td class="btn-group text-white">
                        <a class="btn btn-sm btn-success" href data-toggle="modal" data-target=".deposito">
                            <i class="fa fa-plus"></i>
                        </a>
                        <a class="btn btn-sm btn-warning" href data-toggle="modal" data-target=".saque">
                            <i class="fa fa-minus"></i>
                        </a>
                        <a class="btn btn-sm btn-primary" href data-toggle="modal" data-target=".transferencia">
                            <i class="fa fa-expand-arrows-alt"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
        @endif

        @include('bank.partials.modals.deposito')
        @include('bank.partials.modals.saque')
        @include('bank.partials.modals.transferencia')
        </tbody>
    </table>
</div>