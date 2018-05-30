<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ Session::token() }}">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/gijgo@1.9.6/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://cdn.jsdelivr.net/npm/gijgo@1.9.6/css/gijgo.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/gijgo@1.9.6/js/messages/messages.pt-br.js" type="text/javascript"></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    Loja
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <li>
                            <a class="nav-link" href="{{route('cliente.index')}}">Cliente</a>
                        </li>
                        <li>
                            <a class="nav-link" href="{{route('produto.index')}}">Produto</a>
                        </li>
                        <li>
                            <a class="nav-link" href="{{route('relatorio.index')}}">Relatórios</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">

            <div class="container">
                <h1>Filtros: </h1>
                <form action="/relatorio" method="POST">
                    {!! csrf_field() !!}
                    <div class="input-group mb-3">
                        <select style="margin-right: 10px;" class="custom-select col-7" name="cliente_id" id="cliente_id">
                            <option value="0" selected>Todos os clientes</option>
                            @foreach ($clientes as $cliente)
                            <option value="{{$cliente->id}}">{{$cliente->nome}}</option>
                            @endForeach
                        </select>
                    </div>
                    <div style="margin-bottom: 30px;">
                        Data Início:
                        <input id="dataInicio" name="dataInicio" width="275"  />
                        Data Fim:
                        <input style="display: inline;" name="dataFim" id="dataFim" width="275" />
                    </div>
                    <button type="submit" class="btn btn-primary">Gerar relatório</button>
                </form>
                <script>
                    $('#dataInicio').datepicker({
                        uiLibrary: 'bootstrap4',
                        locale: 'pt-br',
                        format: 'dd/mm/yyyy'
                    });

                    $('#dataFim').datepicker({
                        uiLibrary: 'bootstrap4',
                        locale: 'pt-br',
                        format: 'dd/mm/yyyy'
                    });

                </script>
            </div>
        </main>
    </div>

    <script>
        $(document).ready(function () {
            (function ($) {
                $('#filter').keyup(function () {
                    var rex = new RegExp($(this).val(), 'i');
                    $('.searchable tr').hide();
                    $('.searchable tr').filter(function () {
                        return rex.test($(this).text());
                    }).show();
                })
            }(jQuery));
        });

    </script>
</body>

</html>
