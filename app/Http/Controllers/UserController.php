<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();  
        return response()->json(['users' =>$users]); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (User::where('email', $request->email)->orWhere('document_id', $request->documentId)->exists()) {
            return ['error' => 'El usuario ya existe']; 
        }else{
            //Instanciamos la clase Pokemons
            $user = new User;
            //Declaramos el nombre con el nombre enviado en el request
            $user->name = $request->name;
            $user->last_name = $request->lastName;
            $user->document_id = $request->documentId;
            $user->email = $request->email;
            $user->phone = $request->phone;
            //Guardamos el cambio en nuestro modelo
            $user->save();
            return ['success' => 'Usuario creado con exito']; 
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);  
        if($user){
            return response()->json(['user' =>$user]);
        }else{
            return ['error' => 'El usuario no existe'];
        }
        
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
        $user = User::find($id);

        if ($user) {
            $user->name = $request->name;
            $user->last_name = $request->lastName;
            $user->document_id = $request->documentId;
            $user->email = $request->email;
            $user->phone = $request->phone;

            $user->update($request->all());

            return response()->json(['user' =>$user, 'success' => 'Usuario editado con exito']); 
            
        }else{
            return ['error' => 'No se pudo editar el usuario']; 
        }
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
    }
}
