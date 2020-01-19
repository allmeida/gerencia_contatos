@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <center><h1>Formulário de Contatos</h1></center>
                </div>

                <div class="card-body">
                    @if(isset($contato))
                        <form action="{{ route('contatos.update', $contato->id) }}" method="post" enctype="multipart/form-data">
                            @method('PUT')
                        @else
                            <form action="{{ route('contatos.store') }}" method="post" enctype="multipart/form-data">
                        @endif
                            @csrf
                            <div class="form-group">
                                <label for="nome">Nome</label>
                                <input type="text" class="form-control" name="nome" value="{{ $contato->nome ?? old('nome') }}">
                            </div>
                            <div class="form-group">
                                <label for="cpf">Cpf</label>
                                <input type="text" class="form-control" name="cpf" value="{{ $contato->cpf ?? old('cpf') }}">
                            </div>
                            <div class="form-group">
                                <label for="data_nascimento">Data de Nascimento</label>
                                <input type="date" class="form-control" name="data_nascimento" value="{{ $contato->data_nascimento ?? old('data_nascimento') }}">
                            </div>
                            <div class="form-group">
                                <label for="telefone">Telefone</label>
                                <input type="text" class="form-control" name="telefone" value="{{ $contato->telefone ?? old('telefone') }}">
                            </div>
                            <div class="form-group">
                                <label for="email">E-mail</label>
                                <input type="email" class="form-control" name="email" value="{{ $contato->email ?? old('email') }}">
                            </div>
                            <div class="form-group">
                                <input type="file" name="foto_contato">
                            </div>
                            <div>
                                <input type="submit" class="btn btn-primary" value="Salvar" >
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
