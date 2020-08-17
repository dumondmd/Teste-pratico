<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Veiculo;
use App\User;

class VeiculosController extends Controller
{
   
    public function ListarCliente(){
        $users = User::all();
        return $users->toJson();
    }
    public function ListarClienteId($id){
        $cliente = User::find($id);
        if(isset($cliente)){
            return json_encode($cliente);
        }
        return response('Cliente não encontrado', 404);
    }



    public function indexView()
    {
       //
    }

    public function buscaAvancada($id)
    {
        
        if($id != 2){
            $veiculos = DB::table('veiculos')
                ->join('users', 'veiculos.proprietario', '=', 'users.id')
                ->where('deleted_at', '=', null)
                ->where('proprietario', '=', $id)
                ->select('veiculos.*', 'users.name' )
                ->get();     
            return $veiculos->toJson();
        }
        else {
            $veiculos = DB::table('veiculos')
                ->join('users', 'veiculos.proprietario', '=', 'users.id')
                ->where('deleted_at', '=', null)                
                ->select('veiculos.*', 'users.name' )
                ->get();     
            return $veiculos->toJson();
        }
    }

    public function index()
    {
        // $veiculos = Veiculo::whereNull('deleted_at')->get(); 
        // return $veiculos->toJson();
    }

    
    public function create()
    {
        //
    }

   
    public function store(Request $request)
    {           
        $veiculo = new Veiculo();       
        $veiculo->placa = $request->input('placa');
        $veiculo->renavam = $request->input('renavam');
        $veiculo->modelo = $request->input('modelo');
        $veiculo->marca = $request->input('marca');
        $veiculo->ano = $request->input('ano');
        $veiculo->proprietario = $request->input('proprietario');    
        $veiculo->save();
        return json_encode($veiculo);
    }


    public function show($id)
    {
        $veiculo = Veiculo::find($id);
        if(isset($veiculo)){
            return json_encode($veiculo);
        }
        return response('Veículo não encontrado', 404);
    }


    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $veiculo = Veiculo::find($id);
        if(isset($veiculo)){
            $veiculo->placa = $request->input('placa');
            $veiculo->renavam = $request->input('renavam');
            $veiculo->modelo = $request->input('modelo');
            $veiculo->marca = $request->input('marca');
            $veiculo->ano = $request->input('ano');
            $veiculo->proprietario = $request->input('proprietario'); 
            $veiculo->save();
            return json_encode($veiculo);
        }
        return response('Veículo não encontrado', 404);
    }

    public function destroy($id)
    {
        $exclusao = date('Y-m-d H:i:s');                      
        $veiculo = Veiculo::findOrFail($id);
        if(isset($veiculo)){
            $veiculo->deleted_at = $exclusao;            
            $veiculo->save();
            return response()->json("Aluno de id: ".$id." excluido com sucesso! Hora exclusao ".$exclusao);
        }
        return response('Aluno não encontrado', 404);
    }
}