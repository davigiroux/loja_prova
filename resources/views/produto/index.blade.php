@extends('layouts.loja') @section('content')
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
                    <th scope="col">Valor</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody class="searchable">
                <tr>
                <th colspan="4" scope="row"><a href="{{route('produto.create')}}">+ Adicionar novo produto...</a></th>
                </tr>
                @foreach ($produtos as $produto)
                    <tr>
                        <th scope="row">{{$produto->id}}</th>
                        <td>{{$produto->nome}}</td>
                        <td>R$ {{number_format($produto->valor, 2, ',', '.')}}</td>
                        <td>
                            <a href="{{url('/produto/'.$produto->id.'/edit')}}" class="btn btn-primary">Editar</a> |
                            <form style="display: inline;" action="{{url('produto', [$produto->id])}}" method="POST">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="submit" class="btn btn-danger" value="Excluir"/>
                                </form>
                        </td>
                    </tr>
                @endForeach
            </tbody>
        </table>
    </div>
</div>
@endSection
