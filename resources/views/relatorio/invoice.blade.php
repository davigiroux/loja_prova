<div class="container">
    @foreach($clientes as $cliente)
    <h2>Cliente: <strong>{{$cliente->nome}}</strong></h2>
    <hr>
        @foreach($cliente->notas as $nota)
            <h3>
                Data da nota: {{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $nota->created_at)->format('d/m/Y')}}
            </h3>
            <table style="width:100%; margin-bottom: 50px;">
                <thead style="background-color: #969696; color: white;">
                    <tr>
                        <th style="padding: 5px 10px; border: 1px solid black; margin: 0;" scope="col">#</th>
                        <th style="padding: 5px 20px; border: 1px solid black; margin: 0;" scope="col">Nome</th>
                        <th style="padding: 5px 10px; border: 1px solid black; margin: 0;" scope="col">Valor</th>
                        <th style="padding: 5px 10px; border: 1px solid black; margin: 0;" scope="col">Quantidade</th>
                        <th style="padding: 5px 10px; border: 1px solid black; margin: 0;" scope="col">Total do produto</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($nota->itens as $item)
                    <tr>
                        <td style="padding: 5px 10px; border: 1px solid black; margin: 0;">{{$item->id}}</td>
                        <td style="padding: 5px 20px; border: 1px solid black; margin: 0;">{{$item->nome}}</td>
                        <td style="padding: 5px 10px; border: 1px solid black; margin: 0;">R$ {{number_format($item->valor, 2, ',', '.')}}</td>
                        <td style="padding: 5px 10px; border: 1px solid black; margin: 0;">{{$item->pivot->quantidade}}</td>
                        <td style="padding: 5px 10px; border: 1px solid black; margin: 0;">
                            R$ {{ number_format($item->valor * $item->pivot->quantidade, 2, ',', '.') }}
                        </td>
                    </tr>
                    @endForeach
                </tbody>
                <tfoot>
                    <td style="text-align: right;" colspan="5"><strong> Valor total: R$ {{number_format($nota->total, 2, ',', '.')}}</strong></td>
                </tfoot>
            </table>
        @endForeach
    @endForeach
</div>
