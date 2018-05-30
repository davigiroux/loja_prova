@extends('layouts.loja')
@section('content')
<div class="row">
    <div class="col-md-8 offset-md-2">
        <table class="table table-hover">
            <thead class="thead-dark">
                <div class="input-group mb-3">
                    <input type="text" id="filter" class="form-control" placeholder="Busca" aria-label="Busca" aria-describedby="basic-addon1">
                </div>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nome</th>
                    <th style="text-align: right;" scope="col">Ações</th>
                </tr>
            </thead>
            <tbody class="searchable">
                <tr>
                    <th colspan="3" scope="row">
                        <a href="{{route('cliente.create')}}">+ Adicionar novo cliente...</a>
                    </th>
                </tr>
                @foreach ($clientes as $cliente)
                <tr>
                    <th scope="row">{{$cliente->id}}</th>
                    <td>{{$cliente->nome}}</td>
                    <td style="text-align: right;">
                        <a href="{{url('/nota/'.$cliente->id)}}" class="btn btn-warning">Notas</a> |
                        <a href="{{url('/cliente/'.$cliente->id.'/edit')}}" class="btn btn-primary">Editar</a> |
                        <form style="display: inline;" action="{{url('cliente', [$cliente->id])}}" method="POST">
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="submit" class="btn btn-danger" value="Excluir" />
                        </form>
                    </td>
                </tr>
                @endForeach
            </tbody>
        </table>
    </div>
</div>
@endSection
