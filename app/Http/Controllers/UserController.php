<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Resources\UsuarioResource;

class UserController extends Controller
{
    
    public function login(Request $request){

       $usuario = User::where('email',$request->email)->get();
       if(count($usuario)!==0){
            $pass=$usuario[0]->password;
        $passReq = $request->password."";
        if ($pass==$passReq) {
           return new UsuarioResource($usuario[0]); 
        }
        else{            
            return ;            
        }
       }
       return ;
    }
    public function index()
    {
        return User::get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        $email = User::where('email',$request->email)->get();
        if(count($email)==0){
            $registro = User::create($request->all());
            if ($registro) {
                return 'Registrado';
            } else {
                return 'Ah ocurrido un error';
            }
        }else{
            return 'No se Registro';
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return User::find($id);
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
       
    $registro = User::updateOrCreate(['id' => $id],$request->all());
    if ($registro) {
        return 'Actualizado';
    } else {
        return 'Ah ocurrido un error';
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
        $delete = user::destroy($id);
        if ($delete) {
        return 'Eliminado';
        } else {
            return 'Ah ocurrido un error';
        }
    }
}
