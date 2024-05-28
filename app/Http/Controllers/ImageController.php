<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;



class ImageController extends Controller
{
    public function update(Request $request)
    {
        \Log::info($request->all());
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp,svg',
        ]);

        $imageName = 'principal.' . $request->image->extension();  

        $pathToVolume = '/app/storage';

        $extensions = ['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg'];
        foreach ($extensions as $extension) {
            $oldImage = $pathToVolume . "/principal.{$extension}";
            if (File::exists($oldImage)) {
                File::delete($oldImage);
            }
        }

        $request->image->move($pathToVolume, $imageName);

        return response()->json([
            'success' => 'Imagen subida con éxito.',
            'image' => $imageName
        ]);
    }

    public function get()
    {
        $extensions = ['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg'];
        $imagen = '';
    
        // Ruta actualizada a tu volumen `/app/storage`
        $pathToVolume = storage_path('app');
    
        foreach ($extensions as $extension) {
            if (file_exists($pathToVolume . "/principal.{$extension}")) {
                $imagen = "principal.{$extension}";
                break;
            }
        }
    
        if ($imagen === '') {
            return response()->json(['error' => 'Imagen no encontrada'], 404);
        }
    
        // Devolver la ruta al endpoint que sirve la imagen
        return response()->json(['image' => url("/image/$imagen")]);
    }


public function serveImage($filename)
{
    $path = storage_path('app/' . $filename);

    if (!File::exists($path)) {
        abort(404);
    }

    return response()->file($path);
}
}