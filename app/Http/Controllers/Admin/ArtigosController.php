<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Artigo;


class ArtigosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listaMigalhas = json_encode([
          ["titulo"=>"Admin","url"=>route('admin')],
          ["titulo"=>"Lista de artigos","url"=>""]
        ]);

        //$listaArtigos = Artigo::select('id','titulo','descricao','user_id','data')->paginate(2);//dois artigos por paginas
       /* foreach ($listaArtigos as $key => $value) {
            # uma maneira de pegar o nome do usuario
            //$value->user_id=\App\User::find($value->user_id)->name;
            //outra
            //$value->user_id=$value->user->name;
            //unset($value->user);//remove oq nao precisa
          
            
        }*/
          //outra logica com database qyery builder
        //$listaArtigos=DB::table('artigos')->join('users','users.id','=','artigos.user_id')->select('artigos.id','artigos.titulo','artigos.descricao','users.name','artigos.data')->whereNull('deleted_at')->paginate(2);
        $listaArtigos=Artigo::listaArtigos(2);
        return view('admin.artigos.index',compact('listaMigalhas','listaArtigos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data=$request->all();
       //validação de dados
       $validacao=\Validator::make($data,[
           "titulo" =>"required",
           "descricao" =>"required",
           "conteudo" =>"required",
           "data" =>"required"
       ]);
       if($validacao->fails()){
           return redirect()->back()->withErrors($validacao)->withInput();//REDIRECIONA PARA PAGINA DE TRAS MANDANDO OS ERROS E OS DADOS
       }
       
       
        //salvando os dados no banco de dados com laravel
        //dd($request->all());
       
        Artigo::create($data);//pronto
        return redirect()->back();


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //retorna dados
        return Artigo::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $data=$request->all();
        //validação de dados
        $validacao=\Validator::make($data,[
            "titulo" =>"required",
            "descricao" =>"required",
            "conteudo" =>"required",
            "data" =>"required"
        ]);
        if($validacao->fails()){
            return redirect()->back()->withErrors($validacao)->withInput();//REDIRECIONA PARA PAGINA DE TRAS MANDANDO OS ERROS E OS DADOS
        }
        
        
         //salvando os dados no banco de dados com laravel
         //dd($request->all());
        
         Artigo::find($id)->update($data);//pronto
         return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        Artigo::find($id)->delete();
        return redirect()->back();
    }
}
