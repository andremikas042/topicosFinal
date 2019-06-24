<!-- Modal -->
<div class="modal fade bd-example-modal-lg deposito" id="exampleModalCenter" tabindex="-1" role="dialog"
     aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content border border-white">
            <div class="modal-header bg-gradient-success">
                <h3 class="modal-title text-white" id="exampleModalLabel">Fazer Depósito em: {{$conta->id}}</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="panel-body">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-lg">
                                {{--<form action="{{route('transacao.deposito', $conta->id, $conta->saldo)}}">--}}
                                <form action="{{route('transacao.deposito', $conta->id, $conta->saldo)}}">
                                    <div class="form-group">
                                        <label for="input-saldo">Insira o valor em R$</label>
                                        <input type="text" name="saldoValor" class="form-control" id="input-saldo"
                                               placeholder="R$">
                                        <small>Exemplo: 5,00</small>
                                    </div>
                                    <div class="form-group col-5">
                                        <button type="submit" class="btn btn-block btn-success">
                                            <i class="fa fa-plus mr-2"></i>
                                            Depositar!
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