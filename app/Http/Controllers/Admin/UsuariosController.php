<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Validation\Rule;

class UsuariosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $listaMigalhas = json_encode([
            ["titulo"=>"Admin","url"=>route('admin')],
            ["titulo"=>"Lista de Usuarios","url"=>""]
          ]);
  
          $listaModelo = User::select('id','name','email')->paginate(2);//dois artigos por paginas
  
  
          return view('admin.usuarios.index',compact('listaMigalhas','listaModelo'));
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
        //
        $data=$request->all();
        //validação de dados
        $validacao=\Validator::make($data,[
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);
        if($validacao->fails()){
            return redirect()->back()->withErrors($validacao)->withInput();//REDIRECIONA PARA PAGINA DE TRAS MANDANDO OS ERROS E OS DADOS
        }
        
        
         //salvando os dados no banco de dados com laravel
         //dd($request->all());
         $data['password']=bcrypt($data['password']);//criptografia
        
         User::create($data);//pronto
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
        //
        return User::find($id);
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
        if(isset($data['password'])&& $data['password']!=""){
            //se existir e nao for vazio
            $validacao=\Validator::make($data,[
                'name' => 'required|string|max:255',
                'email' => ['required','string','email','max:255',Rule::unique('users')->ignore($id)],
                'password' => 'required|string|min:6',
            ]);
            $data['password']=bcrypt($data['password']);//criptografia
        }else{
            $validacao=\Validator::make($data,[
                'name' => 'required|string|max:255',
                'email' => ['required','string','email','max:255',Rule::unique('users')->ignore($id)],
               //arruma a validação do email
            ]);
            unset($data['password']);
        }
        //validação de dados
  
        if($validacao->fails()){
            return redirect()->back()->withErrors($validacao)->withInput();//REDIRECIONA PARA PAGINA DE TRAS MANDANDO OS ERROS E OS DADOS
        }
        
        
         //salvando os dados no banco de dados com laravel
         //dd($request->all());
        
         User::find($id)->update($data);//pronto
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
