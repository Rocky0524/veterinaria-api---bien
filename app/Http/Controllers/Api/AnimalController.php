<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Animal; 
use Illuminate\Http\Request;
use Illuminate\Validation\Rule; 

class AnimalController extends Controller
{
  
    public function index()
    {
     
        $animales = Animal::with('dueno')->get();
        return response()->json($animales, 200);
    }

 
    public function store(Request $request)
    {
        
        $validador = validator($request->all(), [
            'nombre' => 'required|string|max:255',
          
            'tipo' => ['required', Rule::in(['perro', 'gato', 'hámster', 'conejo'])],
            'peso' => 'required|numeric',
            'dueno_id' => 'required|exists:duenos,id', 
            'enfermedad' => 'nullable|string',
            'comentarios' => 'nullable|string'
        ]);


        if ($validador->fails()) {
            return response()->json([
                'mensaje' => 'Error en los datos enviados',
                'errores' => $validador->errors()
            ], 422);
        }

  
        $animal = Animal::create($request->all());

        return response()->json([
            'mensaje' => 'Animal registrado correctamente',
            'datos' => $animal
        ], 201);
    }

   
    public function show($id)
    {
        $animal = Animal::with('dueno')->find($id);

        if (!$animal) {
            return response()->json(['mensaje' => 'Animal no encontrado'], 404);
        }

        return response()->json($animal, 200);
    }

 
    public function update(Request $request, $id)
    {
        $animal = Animal::find($id);

        if (!$animal) {
            return response()->json(['mensaje' => 'Animal no encontrado'], 404);
        }

        
        $request->validate([
            'nombre' => 'sometimes|required|string',
            'tipo' => ['sometimes', Rule::in(['perro', 'gato', 'hámster', 'conejo'])],
            'peso' => 'sometimes|numeric',
        ]);

        $animal->update($request->all());

        return response()->json([
            'mensaje' => 'Información actualizada',
            'datos' => $animal
        ], 200);
    }


    public function destroy($id)
    {
        $animal = Animal::find($id);

        if (!$animal) {
            return response()->json(['mensaje' => 'Animal no encontrado'], 404);
        }

        $animal->delete();

        return response()->json(['mensaje' => 'Animal dado de alta (eliminado)'], 200);
    }
}