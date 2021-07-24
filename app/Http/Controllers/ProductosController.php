<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequestProducto;
use App\Models\Productos;

class ProductosController extends Controller
{
    public function index()
    {
        $productos = Productos::all();
        return response()->json([
            'productos'=> $productos
        ]);
    }


    public function create()
    {

    }


    public function store(PostRequestProducto $request)
    {
        $data = $request->validated();
        Productos::create($data);
        return response()->json([
            'mensaje'=> 'Creado con exito'
        ]);
    }


    public function show($id)
    {
        $producto = Productos::find($id);
        return response()->json([
            'producto'=> $producto
        ]);
    }


    public function edit($id)
    {

    }


    public function update(PostRequestProducto $request, Productos $producto)
    {
        $data = $request->validated();
        $producto->fill($data);
        $producto->save();
        return response()->json([
            'mensaje'=> 'Producto actualizada con exito'
        ]);
    }


    public function destroy($id)
    {
        try {
            $marca= Productos::find($id);
            $marca->delete();
            return response()->json([
                'mensaje'=> 'Producto eliminado con exito'
            ]);
        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json([
                'mensaje'=> 'A ocurrido una excpecion al intentar eliminar el producto'
            ]);
        }
    }
}
