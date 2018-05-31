@extends('layouts.loja')
@section('content')
<div class="row">

    <div class="col-md-8 offset-md-2">
        <a href="{{ route('cliente.index') }}">Cliente</a> / Notas
        <h3>Notas de: {{$cliente->nome}} </h3>
        <h4>
            <a href="{{url('/nota/create/'.$cliente->id)}}" class="btn btn-success">Gerar nova nota</a>
        </h4>
        <div id="accordion" role="tablist">
            @foreach ($cliente->notas as $nota)
            <div class="card">
                <div class="card-header" role="tab" id="headingOne">
                    <h5 class="mb-0" style="display: inline; line-height: 35px;">
                        <a style="vertical-align: middle;" data-toggle="collapse" href="#{{$nota->id}}" role="button" aria-controls="{{$nota->id}}">
                            {{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $nota->created_at)->format('d/m/Y')}} --- R$ {{$nota->total}}
                        </a>
                    </h5>

                <form action="/nota/download/{{$nota->id}}" style="display: inline; float: right;" method="POST">
                    {!! csrf_field() !!}
                        <button class="btn btn-primary" style="display: inline;" type="submit">
                            <i class="fas fa-download"></i>
                        </button>
                    </form>
                </div>

                <div id="{{$nota->id}}" class="collapse" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nome</th>
                                    <th scope="col">Valor Unitário</th>
                                    <th scope="col">Quantidade</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($nota->itens as $item)
                                <tr>
                                    <th scope="row">{{$item->id}}</th>
                                    <td>{{$item->nome}}</td>
                                    <td>R$ {{number_format($item->valor, 2, ',', '.')}}</td>
                                    <td>{{$item->pivot->quantidade}}</td>
                                </tr>
                                @endForeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @endForeach
        </div>
    </div>
</div>
@endSection
