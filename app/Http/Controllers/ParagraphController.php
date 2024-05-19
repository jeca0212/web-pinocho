<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Parrafo;

class ParagraphController extends Controller
{
    public function index()
    {
        return Parrafo::all();
    }

    public function update(Request $request, $id)
    {
        $parrafo = Parrafo::findOrFail($id);
        $parrafo->contenido = $request->contenido;
        $parrafo->save();

        return $parrafo;
    }
  

}