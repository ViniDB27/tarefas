<?php

namespace App\Http\Controllers;

use App\Tarefa;
use Illuminate\Http\Request;

class TarefaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Tarefa::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            "name"          => 'required|max:100',
            "pending"     => 'required|boolean'
        ]);


        $tarefa = Tarefa::create([
            'name' => $request->input('name'),
            'pending' => $request->input('pending'),
        ]);

        return response()->json(["message" => 'Tarefa cadastrada com sucesso!', 'tarefa' => $tarefa]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            "name"          => 'required|max:100',
            "pending"     => 'required|boolean'
        ]);

        $tarefa = Tarefa::all()->where('id', $id)->first();

        if(!$tarefa){
            return response()->json(["erro" => "Não temos nem uma tarefa nesse id"],404);
        }

        $tarefa->name = $request->input('name');
        $tarefa->pending = $request->input('pending');

        $tarefa->save();

        return response()->json(["message" => "Tarefa alterada com sucesso!", "tarefa"=>$tarefa]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
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

    public function toggleTask(Request $request,$id)
    {
        $this->validate($request,[
            "pending"     => 'required|boolean'
        ]);

        $tarefa = Tarefa::all()->where('id', $id)->first();

        if(!$tarefa){
            return response()->json(["erro" => "Não temos nem uma tarefa nesse id"],404);
        }

        $tarefa->pending = $request->input('pending');

        $tarefa->save();

        return response()->json(["message" => "Tarefa alterada com sucesso!", "tarefa"=>$tarefa]);
    }
}
