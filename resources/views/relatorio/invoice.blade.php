<div class="container">
    @foreach($clientes as $cliente)
    <h1>{{$cliente->nome}}</h1>
    <hr>
        @foreach($cliente->notas as $nota)
            <h3>
                Data da nota: {{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $nota->created_at)->format('d/m/Y')}} --- Valor total: R$ {{$nota->total}}
            </h3>
            <table style="width:100%; margin-bottom: 50px;">
                <thead style="background-color: #343434; color: white;">
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
            </table>
        @endForeach
    @endForeach
</div>
