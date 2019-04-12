@extends('layouts.app')

@section('content')
  <pagina tamanho="12">
    @if($errors->all())<!--se tiver erro-->
    <div class="alert alert-danger alert-dismissible  " role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
      @foreach ($errors->all() as $item)
        <li>{{$item}}</li> 
       @endforeach
    </div>  
    @endif
    <painel titulo="Lista de Artigos">
      <migalhas v-bind:lista="{{$listaMigalhas}}"></migalhas>



      <tabela-lista
      v-bind:titulos="['#','Título','Descrição','Autor','Data']"
      v-bind:itens="{{json_encode($listaArtigos)}}"
      ordem="desc" ordemcol="0"
      criar="#criar" detalhe="/admin/artigos/" editar="/admin/artigos/" deletar="/admin/artigos/" token="{{csrf_token()}}"
      modal="sim"

      ></tabela-lista>
      <div align="center">
        {{$listaArtigos->links()}}

      </div>
    </painel>

  </pagina>

  <modal nome="adicionar" titulo="Adicionar">
  <formulario id="formAdicionar" css="" action="{{route('artigos.store')}}" method="post" enctype="multipart/form-data" token="{{csrf_token()}}"><!--recebe o apelido da rota o action-->

      <div class="form-group">
        <label for="titulo">Título</label>
      <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Título" value="{{old('titulo')}}"><!--pega o dado antigo-->
      </div>
      <div class="form-group">
        <label for="descricao">Descrição</label>
        <input type="text" class="form-control" id="descricao" name="descricao" placeholder="Descrição" value="{{old('descricao')}}">
      </div>
      <div class="form-group">
        <label for="conteudo">Conteudo</label>
        <textarea name="conteudo" id="conteudo" class="form-control" value="{{old('conteudo')}}" ></textarea>
       <!-- <ckeditor 
          id="conteudo"
          value="{{old('conteudo')}}" 
          v-bind:config="{
            toolbar: [
          [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript' ]
        ],
        height: 200
          }">
        </ckeditor>-->
      </div>
      <div class="form-group">
        <label for="data">Data</label>
        <input type="date" class="form-control" id="data" name="data" value="{{old('data')}}" >
      </div>
      
    </formulario>
    <span slot="botoes"> <button form="formAdicionar" class="btn btn-info">Adicionar</button></span>
   
  </modal>
  <modal nome="editar" titulo="Editar">
    <formulario id="formEditar" css="" v-bind:action="'/admin/artigos/'+$store.state.item.id" method="put" enctype="multipart/form-data" token="{{csrf_token()}}">

      <div class="form-group">
        <label for="titulo">Título</label>
        <input type="text" class="form-control" id="titulo" name="titulo" v-model="$store.state.item.titulo" placeholder="Título">
      </div>
      <div class="form-group">
        <label for="descricao">Descrição</label>
        <input type="text" class="form-control" id="descricao" name="descricao" v-model="$store.state.item.descricao" placeholder="Descrição">
      </div>
      <div class="form-group">
        <label for="edit-conteudo">Conteudo</label>
        <textarea name="conteudo" id="edit-conteudo" class="form-control" v-model="$store.state.item.conteudo"  ></textarea>
      </div>
      <div class="form-group">
        <label for="data">Data</label>
        <input type="date" class="form-control" id="data" name="data" v-model="$store.state.item.data">
      </div>
     
    </formulario>
    <span slot="botoes"> <button form="formEditar" class="btn btn-info">Atualizar</button></span>
   
  </modal>
  <modal nome="detalhe" v-bind:titulo="$store.state.item.titulo">
 
      <p>@{{$store.state.item.descricao}}</p><!--indica que vai pertencer ao javascript-->
      <p>@{{$store.state.item.conteudo}}</p>
  </modal>
@endsection
