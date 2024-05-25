<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class ImageController extends Controller
{
    public function update(Request $request)
{
    try {
        \Log::info($request->all());
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp,svg',
        ]);

        $imageName = 'principal';  

        // Carga la imagen en Cloudinary
        $cloudinary = app('cloudinary');
        $result = $cloudinary->uploadApi()->upload(
            $request->file('image')->getRealPath(), 
            ["public_id" => $imageName, "overwrite" => true]
        );

        return response()->json([
            'success' => 'Imagen subida con éxito.',
            'image' => $imageName
        ]);
    } catch (\Exception $e) {
        \Log::error($e->getMessage());
        return response()->json(['error' => 'Hubo un error al subir la imagen.', 'message' => $e->getMessage()], 500);
    }
}

    public function upload(Request $request)
    {
        $image = $request->file('image');

        $uploadedImage = Cloudinary::upload($image->getRealPath());

        return response()->json(['url' => $uploadedImage->getSecurePath()], 200);
    }
    public function get()
    {
        $imageName = 'principal';
    
        try {
            // Obtiene la URL de la imagen de Cloudinary
            $imageUrl = cloudinary_url($imageName);
    
            return response()->json(['image' => $imageUrl]);
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return response()->json(['error' => 'Hubo un error al obtener la imagen.', 'message' => $e->getMessage()], 500);
        }
    }
}