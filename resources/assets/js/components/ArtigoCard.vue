<template>
   <div class="col-sm-6 col-md-4">
                    <div class="thumbnail">
                    <img src="https://www.grupoescolar.com/a/b/artigo-1F.jpg" alt="...">
                    <div class="caption">
                        <small>{{data | formataData}}-{{autor}}</small>
                        <h3>{{titulo}}</h3>
                        <p>{{descricao}}</p>
                        <p><a v-bind:href="link" class="btn btn-primary" role="button">Leia mais</a> </p>
                    </div>
                    </div>
    </div>
    
</template>

<script>
    export default {
        props:['titulo','descricao','link','imagem','data','autor','sm','md'],
         filters :{
        //filtros chamados com o pipe
        formataData: function(valor){
          if(!valor) return '';
          valor=valor.toString();
          if(valor.split('-').length==3){
            //separa pelo tracinho
            valor=valor.split('-');
            return valor[2]+'-'+valor[1]+'-'+valor[0];
          }
          return valor ;
        }
      }

    }
</script>