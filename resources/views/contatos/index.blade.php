@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Lista de Contatos
                    <a class="btn btn-primary float-right" href="{{ route('contatos.create') }}">Novo Contato</a>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @forelse($contatos as $contato)
                        @if($contato->foto)
                            <img src="{{ url('images/' . $contato->foto) }}" style="width: 150px" class="img-thumbnail">
                        @endif
                        <br>
                        Nome: {{ $contato->nome }}<br>
                        Cpf: {{ $contato->cpf }}<br>
                        Data de Nascimento: {{ $contato->data_nascimento }}<br>
                        Telefone: {{ $contato->telefone }}<br>
                        E-mail: {{ $contato->email }}<br>
                        <a class="btn btn-primary" href="{{ route('contatos.edit', $contato->id)}}">Editar</a>
                        <a class="btn btn-danger" href="{{ route('contatos.destroy', $contato->id)}}">Excluir</a>
                        <hr>
                    @empty
                        <h3>Você não possui contatos cadastrados</h3>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
