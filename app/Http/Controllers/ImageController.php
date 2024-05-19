<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function update(Request $request)
    {
        \Log::info($request->all());
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp,svg',
        ]);

        $imageName = 'principal.' . $request->image->extension();  

        // Ruta actualizada a tu carpeta `public/img/ofertas` en tu proyecto Next.js
        $pathToNextJsPublicFolder = base_path('../front/public');

        // Elimina cualquier imagen existente
        $extensions = ['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg'];
        foreach ($extensions as $extension) {
            $oldImage = $pathToNextJsPublicFolder . "/img/ofertas/principal.{$extension}";
            if (file_exists($oldImage)) {
                unlink($oldImage);
            }
        }

        // Mueve la nueva imagen
        $request->image->move($pathToNextJsPublicFolder . '/img/ofertas/', $imageName);

        return response()->json([
            'success' => 'Imagen subida con éxito.',
            'image' => $imageName
        ]);
    }

    public function get()
    {
        $extensions = ['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg'];
        $imagen = '';

        // Ruta actualizada a tu carpeta `public/img/ofertas` en tu proyecto Next.js
        $pathToNextJsPublicFolder = base_path('../front/public');

        foreach ($extensions as $extension) {
            if (file_exists($pathToNextJsPublicFolder . "/img/ofertas/principal.{$extension}")) {
                $imagen = "principal.{$extension}";
                break;
            }
        }

        if ($imagen === '') {
            return response()->json(['error' => 'Imagen no encontrada'], 404);
        }

        // Esta ruta es relativa a la raíz de tu proyecto Next.js
        return response()->json(['image' => "/img/ofertas/{$imagen}"]);
    }
}