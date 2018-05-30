@extends('layouts.loja')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a href="{{ route('cliente.index') }}">Cliente</a> / Editar
                </div>

                <div class="panel-body">
                    <h1>Editando: {{$cliente->nome}}</h1>
                    <form action="{{url('cliente', [$cliente->id])}}" method="POST">
                        <input type="hidden" name="_method" value="PUT"> {{ csrf_field() }}
                        <div class="form-group">
                            <label for="nome">Nome</label>
                            <input type="text" class="form-control" value="{{$cliente->nome}}" name="nome" placeholder="Nome">
                        </div>

                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endSection
