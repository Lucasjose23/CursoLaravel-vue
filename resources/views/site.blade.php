@extends('layouts.app')

@section('content')
<pagina tamanho="12">
        <painel titulo="Artigos">
        <p>
        <form class="form-inline" action="{{route('site')}}" method="GET">
             
        <input type="search" class="form-control" id="busca" name="busca" placeholder="buscar" value="{{isset($busca)?$busca:""}}" ><!--pega o dado antigo-->
              <button class="btn btn-info">buscar</button>
        </form>
        </p>
            <div class="row">
                @foreach ($lista as $key => $value)
                    <artigocard
                    titulo="{{$value->titulo}}"
                    descricao="{{str_limit($value->descricao,40,"...")}}"
                    link="{{route('artigo',[$value->id,str_slug($value->titulo)])}}"
                    imagem=""
                    data="{{$value->data}}"
                    autor="{{$value->autor}}"
                    sm="6"
                    md="4"
                    ></artigocard>
                @endforeach
              

            </div>
            <div align="center">
                    {{$lista->links()}}
            
            </div>

        </painel>

</pagina>
@endsection
