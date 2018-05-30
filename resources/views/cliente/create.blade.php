@extends('layouts.loja')

@section('content')
<div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                      <a href="{{ route('cliente.index') }}">Cliente</a> / Adicionar
                    </div>

                    <div class="panel-body">
                      <form action="/cliente" method="POST">
                        {!! csrf_field() !!}
                        <div class="form-group">
                          <label for="nome">Nome</label>
                          <input type="text" class="form-control" name="nome" placeholder="Nome">
                        </div>

                        <button type="submit" class="btn btn-primary">Salvar</button>
                      </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endSection
