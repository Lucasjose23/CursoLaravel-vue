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
    <painel titulo="Lista de Admin">
      <migalhas v-bind:lista="{{$listaMigalhas}}"></migalhas>



      <tabela-lista
      v-bind:titulos="['#','Nome','Email']"
      v-bind:itens="{{json_encode($listaModelo)}}"
      ordem="desc" ordemcol="1"
      criar="#criar" detalhe="/admin/adm/" editar="/admin/adm/" 
      modal="sim"

      ></tabela-lista>
      <div align="center">
        {{$listaModelo->links()}}

      </div>
    </painel>

  </pagina>

  <modal nome="adicionar" titulo="Adicionar">
  <formulario id="formAdicionar" css="" action="{{route('adm.store')}}" method="post" enctype="multipart/form-data" token="{{csrf_token()}}"><!--recebe o apelido da rota o action-->

      <div class="form-group">
        <label for="name">Nome</label>
      <input type="text" class="form-control" id="name" name="name" placeholder="Nome" value="{{old('name')}}"><!--pega o dado antigo-->
      </div>
      <div class="form-group">
        <label for="email">Email</label>
        <input type="text" class="form-control" id="email" name="email" placeholder="Email" value="{{old('email')}}">
      </div>
      <div class="form-group">
        <label for="adm">Admin</label>
        <select id="adm" name="adm" class="form-control" >
          <option value="S">SIM</option>
          <option value="N">NAO</option>
        </select>
      </div>
   
      <div class="form-group">
        <label for="password">Senha</label>
        <input type="password" class="form-control" id="password" name="password" value="{{old('password')}}" >
      </div>
      
    </formulario>
    <span slot="botoes"> <button form="formAdicionar" class="btn btn-info">Adicionar</button></span>
   
  </modal>
  <modal nome="editar" titulo="Editar">
    <formulario id="formEditar" css="" v-bind:action="'/admin/admin/'+$store.state.item.id" method="put" enctype="multipart/form-data" token="{{csrf_token()}}">

      <div class="form-group">
        <label for="name">Nome</label>
        <input type="text" class="form-control" id="name" name="name" v-model="$store.state.item.name" placeholder="Nome">
      </div>
      <div class="form-group">
        <label for="email">Email</label>
        <input type="text" class="form-control" id="email" name="email" v-model="$store.state.item.email" placeholder="Email">
      </div>
      <div class="form-group">
        <label for="adm">Admin</label>
        <select id="adm" name="adm" class="form-control" v-model="$store.state.item.autor">
          <option value="N">NAO</option>
          <option value="S">SIM</option>
        </select>
      </div>
      <div class="form-group">
        <label for="password">Senha</label>
        <input type="password" class="form-control" id="password" name="password"  >
      </div>
     
    </formulario>
    <span slot="botoes"> <button form="formEditar" class="btn btn-info">Atualizar</button></span>
   
  </modal>
  <modal nome="detalhe" v-bind:titulo="$store.state.item.name">
      <p>@{{$store.state.item.email}}</p><!--indica que vai pertencer ao javascript-->
  </modal>
@endsection
