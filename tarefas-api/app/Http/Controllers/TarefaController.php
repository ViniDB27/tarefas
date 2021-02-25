<?php

namespace App\Http\Controllers;

use App\Tarefa;
use Illuminate\Http\Request;

class TarefaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Tarefa::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tarefa = Tarefa::create([
            'title' => $request->input('title'),
        ]);

        return response()->json(["message" => 'Tarefa cadastrada com sucesso!', 'tarefa' => $tarefa]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

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
        $tarefa = Tarefa::all()->where('id', $id)->first();

        if(!$tarefa){
            return response()->json(["erro" => "Não temos nem uma tarefa nesse id"],404);
        }

        $tarefa->title = $request->input('title');

        $tarefa->save();

        return response()->json(["message" => "Tarefa alterada com sucesso!", "tarefa"=>$tarefa]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tarefa = Tarefa::all()->where('id', $id)->first();

        if(!$tarefa){
            return response()->json(["erro" => "Não temos nem uma tarefa nesse id"],404);
        }
        $title = $tarefa->title;
        $tarefa->delete();

        return response()->json(["message" => "Tarefa $title excluida com sucesso!"]);
    }
}
