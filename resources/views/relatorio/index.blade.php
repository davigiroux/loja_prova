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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
        crossorigin="anonymous">
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
                <div class="row">
                    <div class="col-md-10 offset-md-1">
                        <h1>Gerar relatório </h1>
                        <hr style="border: 2px solid #08052b; border-radius: 3px; margin-bottom: 50px;">
                        <form action="/relatorio" method="POST">
                            {!! csrf_field() !!}
                            <h3>Cliente</h3>
                            <hr>
                            <div class="input-group" style="width: 50%; margin-bottom: 30px;">
                                <select style="margin-right: 10px; margin-bottom: 20px;" class="custom-select" name="cliente_id" id="cliente_id">
                                    <option value="0" selected>Todos os clientes</option>
                                    @foreach ($clientes as $cliente)
                                    <option value="{{$cliente->id}}">{{$cliente->nome}}</option>
                                    @endForeach
                                </select>
                            </div>
                            <h3>Período de geração da nota</h3>
                            <p> <i> Caso alguma data não for selecionada, todas as datas das notas serão trazidas.</i></p>
                            <hr>
                            <div style="padding-bottom: 40px;" class="row">
                                <div class="col-md-6">
                                    Data Início:
                                    <input id="dataInicio" name="dataInicio" width="80%" />
                                </div>
                                <div class="col-md-6">
                                    Data Fim:
                                    <input name="dataFim" id="dataFim" width="80%" />
                                </div>
                            </div>

                            <h3>Valor da nota</h3>
                            <p> <i> Caso nenhum valor for preenchido, todos os valores das notas serão trazidos.</i></p>
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    Valor inicial:
                                    <div class="input-group mb-3">
                                        <input id="valor_inicial" name="valor_inicial" type="text" class="form-control" placeholder="Valor inicial" aria-label="Valor inicial">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    Valor final:
                                    <div class="input-group mb-3">
                                        <input id="valor_final" name="valor_final" type="text" class="form-control" placeholder="Valor final" aria-label="Valor final">
                                    </div>
                                </div>
                            </div>
                            <div style="text-align: right;">
                                <button type="submit" class="btn btn-primary">Gerar relatório</button>
                            </div>
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
                </div>
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
