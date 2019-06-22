<!-- Modal -->
<div class="modal fade bd-example-modal-lg transferencia" id="saque" tabindex="-1" role="dialog"
     aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content border border-white">
            <div class="modal-header bg-gradient-primary">
                <h3 class="modal-title text-white" id="exampleModalLabel">Fazer Transferencias</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="panel-body">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-lg">
                                <form action="{{route('transacao.transferencia', $conta->numero)}}">
                                    <div class="form-group">
                                        <label for="input-saldo">Insira o valor em R$</label>
                                        <input type="text" class="form-control" id="input-saldo" placeholder="R$">
                                        <small>Exemplo: 5,00</small>
                                        <small class="text-warning">
                                            Atenção! Insira os dados corretamente!
                                        </small>
                                    </div>
                                    <div class="form-group">
                                        <label for="select-user">Selecione o Usuário</label>
                                        <select id="select-user" class="form-control">
                                            <option selected>Selecione</option>
                                            @foreach($users as $user)
                                                <option value="{{$user->id}}">
                                                    [ {{$user->id}} ] {{ $user->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <small class="text-warning">
                                            Atenção! O usuário que você quer transferir, precisa ter uma conta no
                                            sistema!
                                        </small>
                                    </div>
                                    <div class="form-group col-5">
                                        <button type="submit" class="btn btn-block btn-primary">
                                            <i class="fa fa-minus mr-2"></i>
                                            Transferir!
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>