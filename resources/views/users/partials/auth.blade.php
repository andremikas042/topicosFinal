<div class="table-responsive">
    <table class="table align-items-center table-flush">
        <thead class="thead-light">
        <tr>
            <th scope="col">Numero da Conta</th>
            <th scope="col">Usuário [id]</th>
            <th scope="col">Saldo</th>
            <th scope="col">Creation Date</th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        @foreach($contas as $conta)
            <tr>
                <td> {{$conta->numero}} </td>
                <td>
                    [{{$conta->id_users}}]
                </td>
                <td> {{$conta->saldo}} </td>
                <td> {{$conta->created_at}} </td>
                <td class="btn-group">
                    <form action="{{ route('bank.destroy', $conta) }}" method="GET">
                        @csrf
                        @method('delete')
                        <a class="btn btn-success"
                           href="{{ route('user.edit', $conta   ) }}">
                            <i class="fa fa-pen"></i>
                        </a>
                        <a class="btn btn-danger text-white"
                           onclick="confirm('{{ __("Tem certeza que quer Deletar?") }}') ? this.parentElement.submit() : ''">
                            <i class="fa fa-trash"></i>
                        </a>
                    </form>
                </td>
            </tr>
        @endforeach


        </tbody>
    </table>
</div>