@extends('layouts.app')

@section('content')
<pagina tamanho="12">
        <painel >
        <h2 class="text-center">{{$artigo->titulo}}</h2>
        <h4 class="text-center">{{$artigo->descricao}}</h4> 
        <p class="text-center">
            {{!!$artigo->conteudo!!}}<!--nessa configuração interpreta html-->
        </p>   
    <p class="text-center"><small>{{date('d/m/Y',strtotime($artigo->data))}} - {{$artigo->user->name}}</small></p> 
        </painel>

</pagina>
@endsection
