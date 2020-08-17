<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexView()
    {
        //return view('veiculoutos');
        //$user = User::all();
        $usuarioadm = Auth::user()->role;
        $usuarioInfo = Auth::user()->role;

        if($usuarioadm = 2){
            return view('veiculos');
        }
        else {
            return view('cliente', compact('usuarioInfo'));
        }

        
    }

    public function index()
    {
        $veiculos = Veiculo::all();
        return $veiculos->toJson();
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $veiculo = Veiculo::find($id);
        if(isset($veiculo)){
            return json_encode($veiculo);
        }
        return response('Veículo não encontrado', 404);
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
