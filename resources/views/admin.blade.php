@extends('layouts.app')

@section('content')
<pagina tamanho="8">
    <painel titulo="Dashboard">
       <!-- <migalhas v-bind:lista=""></migalhas>-->
        <div class="row"><!--o can faz a altorisação-->
            @can('autor')
            <div class="col-md-4">
            <caixa qtd="{{$totalArtigos}}" titulo="Artigos" url="{{route('artigos.index')}}" cor="orange" icone="ion ion-pie-graph"></caixa>

            </div>
            @endcan
            @can('eAdmin')
            <div class="col-md-4">
                 <caixa qtd="{{$totalUsuarios}}" titulo="Usuarios" url="{{route('usuarios.index')}}" cor="blue" icone="ion ion-person-stalker"></caixa>
                 


             </div>
             <div class="col-md-4">
                 <caixa qtd="{{$totalAutores}}" titulo="Autores" url="{{route('autores.index')}}" cor="red" icone="ion ion-person"></caixa>


             </div>
             <div class="col-md-4">
                <caixa qtd="{{$totalAdm}}" titulo="Admin" url="{{route('adm.index')}}" cor="grey" icone="ion ion-person"></caixa>


            </div>
               </div>
               @endcan


        </div>
</pagina>
@endsection
