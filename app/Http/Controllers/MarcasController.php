<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequestMarca;
use App\Models\Marcas;
use Illuminate\Http\Request;

class MarcasController extends Controller
{
    public function index()
    {
        $marcas = Marcas::all();
        return response()->json([
            'marcas'=> $marcas
        ]);
    }


    public function create()
    {

    }


    public function store(PostRequestMarca $request)
    {
        $data = $request->validated();
        Marcas::create($data);
        return response()->json([
            'mensaje'=> 'Creado con exito'
        ]);
    }


    public function show($id)
    {
        $marca = Marcas::find($id);
        return response()->json([
            'marca'=> $marca
        ]);
    }


    public function edit($id)
    {

    }


    public function update(PostRequestMarca $request, Marcas $marca)
    {
        $data = $request->validated();
        $marca->fill($data);
        $marca->save();
        return response()->json([
            'mensaje'=> 'Marca actualizada con exito'
        ]);
    }


    public function destroy($id)
    {
        try {
            $marca= Marcas::find($id);
            $marca->delete();
            return response()->json([
                'mensaje'=> 'Marca eliminada con exito'
            ]);
        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json([
                'mensaje'=> 'A ocurrido una excpecion al intentar eliminar la marca'
            ]);
        }
    }
}
