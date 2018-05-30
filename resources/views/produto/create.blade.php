@extends('layouts.loja')

@section('content')
<div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                      <a href="{{ route('produto.index') }}">Produto</a> / Adicionar
                    </div>

                    <div class="panel-body">
                      <form action="/produto" method="POST">
                        {!! csrf_field() !!}
                        <div class="form-group">
                            <label for="nome">Nome</label>
                            <input type="text" class="form-control" name="nome" placeholder="Nome">
                        </div>
                        <div class="form-group">
                            <label for="valor">Valor</label>
                            <input type="text" class="form-control" name="valor" placeholder="Valor">
                        </div>

                        <button type="submit" class="btn btn-primary">Salvar</button>
                      </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endSection
