<?php

namespace App\Http\Controllers;
use App\Models\Registro;
use Illuminate\Support\Facades\DB;
use Throwable;
use Illuminate\Http\Request;

class ListarController extends Controller
{
    //

    Public function listar(){

        try {
            $listar = DB::table('registro_usuarios')->limit(10)->get();

            return response()->json([
                'result' => $listar
            ]);
        } catch (Throwable $e) {
            return response()->json([
                'mensagem' => 'Erro ao Obter Usuarios',
                'status' => '500'
            ]);
        }
    }

    public function remover(Request $request){
            try {
                $remover = DB::table('registro_usuarios')->where('id',$request[0]['id'])->delete();

                return response()->json([
                    'msg' => 'Usuário deletádo com sucesso'
                ]);
            } catch (Throwable $e) {
                return response()->json([
                    'mensagem' => 'Erro ao Deletar Usuarios',
                    'status' => '500'
            ]);
        }   
    }

    public function editar(Request $request){
        try {

            $registro = DB::table('registro_usuarios')
            ->where('id', $request['id'])
            ->update([
                'nome' => $request['nome'],
                'cpf' => $request['cpf'],
                'email' => $request['email'],
                'data_nascimento' => $request['nascimento']
                ]);

            return response()->json([
                'msg' => 'Usuário editado com sucesso',
                'codigo' => '200'

            ]);
        } catch (Throwable $e) {

            return response()->json([
                'mensagem' => 'Erro ao salvar Usuarios',
                'status' => '500'
            ]);
        }
    }

    Public function pesquisa(Request $request){
        try {

            $buscar = DB::table('registro_usuarios')
            ->where('nome', 'like', '%'.$request['buscas'].'%')
            ->orWhere('email', "like", '%'.$request['buscas'].'%')->get();
            return response()->json([
                'result' => $buscar
            ]);
        } catch (Throwable $e) {
            return response()->json([
                'mensagem' => 'Erro ao Obter Usuarios',
                'status' => '500'
            ]);
        }
    }
}
