<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Dueno;
use Illuminate\Http\Request;

class DuenoController extends Controller
{
    public function index()
    {
        return response()->json(Dueno::all(), 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'apellido' => 'required'
        ]);

        $dueno = Dueno::create($request->all());
        return response()->json($dueno, 201);
    }

    public function destroy($id)
    {
        $dueno = Dueno::find($id);
        if (!$dueno) {
            return response()->json(['mensaje' => 'Dueño no encontrado'], 404);
        }

       
        $dueno->delete();

        return response()->json(['mensaje' => 'Dueño y todos sus animales eliminados'], 200);
    }
}