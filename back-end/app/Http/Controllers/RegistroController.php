<?php

namespace App\Http\Controllers;
use App\Models\Registro;
use Illuminate\Support\Facades\DB;
use Throwable;
use Illuminate\Http\Request;

class RegistroController extends Controller
{
    //
    public function registrar(Request $request){
        try {

            $registro                   = new Registro;
            $registro->nome             = $request->nome;
            $registro->cpf              = $request->cpf;
            $registro->data_nascimento  = date( 'd/m/Y' , strtotime($request->nascimento ));
            $registro->email            = $request->email;
            $registro->save();

            return response()->json([
                'msg' => 'Cadastro efetuado com sucesso',
                'codigo' => '200'

            ]);
        } catch (Throwable $e) {

            return response()->json([
                'mensagem' => 'Erro ao salvar Usuarios',
                'status' => '500'
            ]);
        }
    }
}
