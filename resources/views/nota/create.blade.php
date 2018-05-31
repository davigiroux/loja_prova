@extends('layouts.loja') @section('content')
<div class="row">
    <div class="col-md-8 offset-md-2">
        <a href="{{ route('cliente.index') }}">Cliente</a> / <a href="{{ url('/nota/'.$cliente->id) }}">Notas</a> / Gerar nota
        <h3>Nova nota para: {{$cliente->nome}} </h3>
        <form>
            <p>
                <a class="btn" data-toggle="collapse" href="#add-produto" role="button" aria-expanded="false" aria-controls="add-produto">
                    Lançar produto
                </a>
            </p>
            <div class="collapse" id="add-produto">
                <div class="card card-body">
                    <div class="input-group mb-3">
                        <select style="margin-right: 10px; width:" class="custom-select col-7" id="produtos">
                            <option selected>Escolha um produto...</option>
                            @foreach ($produtos as $produto)
                            <option value="{{$produto->id}}">{{$produto->nome}}</option>
                            @endForeach @foreach ($produtos as $produto)
                            <input type="hidden" id="{{'valor-'.$produto->id}}" value="{{$produto->valor}}"> @endForeach
                        </select>
                        <input style="margin-right: 10px;" type="text" class="form-control col-1" value="1" id="quantidade" placeholder="Quantidade de itens">

                        <button style="margin-right: 10px;" type="button" onclick="adicionaProduto()"  class="btn btn-success col-2">Adicionar</button>

                        <button class="btn btn-secondary" type="button" data-toggle="collapse" data-target="#criaProduto" aria-expanded="false" aria-controls="criaProduto">
                            Criar Produto
                        </button>
                        <br>
                    </div>
                </div>
            </div>


            <div style="margin-top: 30px;" class="collapse" id="criaProduto">
                <div class="card card-body">
                    <label class="sr-only" for="nome">Nome</label>
                    <input type="text" class="form-control mb-2 mr-sm-2" name="nome_produto" id="nome_produto" placeholder="Nome do Produto">

                    <label class="sr-only" for="valor">Valor</label>
                    <div class="input-group mb-2 mr-sm-2">
                        <input type="text" class="form-control" name="valor_produto" id="valor_produto" placeholder="Valor unitário">
                    </div>

                    <label class="sr-only" for="quantidade">Quantidade</label>
                    <div class="input-group mb-2 mr-sm-2">
                        <input type="text" class="form-control" name="quantidade_produto" id="quantidade_produto" placeholder="Quantidade de produtos que deseja adicionar na nota">
                    </div>

                    <button data-toggle="collapse" data-target="#criaProduto" aria-controls="criaProduto" type="button" onclick="criarProduto()" class="btn btn-primary col-md-4 offset-md-4">Criar</button>
                </div>
            </div>
            <table id="minhaTabela" class="table">
                <br>
                <br>
                <h5>Lista de produtos</h5>
                <thead>
                    <th>Produto</th>
                    <th>Valor</th>
                    <th>Quantidade</th>
                    <th>Total Produto</th>
                </thead>
                <tbody>
                    @foreach ($nota->itens as $item)
                    <tr>
                        <th scope="row">{{$item->nome}}</th>
                        <td>{{$item->valor}}</td>
                        <td>{{$item->pivot->quantidade}}</td>
                        <td>{{$item->pivot->quantidade * $item->valor}}</td>
                    </tr>
                    @endForeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="4" style="text-align: right;">
                            <strong>
                                Valor total:
                                <span id="total"> {{$nota->valor}}</span>
                            </strong>
                        </td>
                        <input type="hidden" id="cliente_id" value="{{$cliente->id}}">
                    </tr>
                </tfoot>
            </table>

            <button type="button" onclick="enviarNota()" class="btn btn-primary">Finalizar</button>
        </form>
    </div>

    <script>
        let produtos = [];

        function adicionaProduto() {
            let produto_id = $('#produtos :selected').val()


            let prod = produtos.find(p => p.id === produto_id)
            const valor = Number($('#valor-' + produto_id).val());
            const qtd = Number($('#quantidade').val());
            const prod_nome = $('#produtos :selected').text()
            if(prod) {
                prod.quantidade+=qtd
                const total = prod.quantidade * valor
                $('#'+prod_nome).text(prod.quantidade)
                $('#total-prod-'+prod_nome).text(parseFloat(total).toFixed(2))
            } else {
                produtos.push({
                    id: produto_id,
                    quantidade: qtd
                });
                adicionaNaTabela($('#produtos :selected')
                .text(), $('#valor-'+produto_id).val(), $('#quantidade').val())
            }




            atualizaTotal(valor, qtd, produto_id);
        }

        function adicionaNaTabela(produto, valor, quantidade) {
            const total = quantidade * valor;
            $('#minhaTabela').append(
                `
                <tr>
                    <td>${produto}</td>
                    <td>${parseFloat(valor).toFixed(2)}</td>
                    <td id="${produto}">${quantidade} </td>
                    <td id="total-prod-${produto}">${parseFloat(total).toFixed(2)} </td>
                </tr>
            `
            );
        }

        function atualizaTotal(valor, qtd, produto) {
            let total = Number($('#total').val());
            total = total + valor * qtd;
            total = total.toFixed(2);
            $('#total').val(total);

            $('#total').text(total);
        }

        function enviarNota() {
            $.post("/nota", {
                    '_token': $('meta[name=csrf-token]').attr('content'),
                    total: $('#total').val(),
                    cliente_id: $('#cliente_id').val(),
                    produtos
                },
                function (data, status) {
                    window.location.href = '/nota/' + $('#cliente_id').val();
                });
        }

        function criarProduto() {
            $.post("/produto", {
                    '_token': $('meta[name=csrf-token]').attr('content'),
                    nome: $('#nome_produto').val(),
                    valor: $('#valor_produto').val(),
                    isNota: true
                },
                function (produto_id, status) {
                    if(status === 'success') {
                        adicionaNaTabela($('#nome_produto').val(), $('#valor_produto').val(), $('#quantidade_produto').val())

                        const valor = $('#valor_produto').val();
                        const quantidade = Number($('#quantidade_produto').val());

                        atualizaTotal(valor, quantidade, produto_id)
                        produtos.push({
                            id: produto_id,
                            quantidade: quantidade
                        });

                        $('#nome_produto').val('')
                        $('#valor_produto').val('')
                        $('#quantidade_produto').val('')
                    }
                });
        }

    </script>

</div>
@endSection
