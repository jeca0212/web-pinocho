<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class ImageController extends Controller
{
    public function update(Request $request)
    {
        \Log::info($request->all());
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp,svg',
        ]);

        $imageName = 'principal.' . $request->image->extension();  

        // Carga la imagen en Cloudinary
        $cloudinary = app('cloudinary');
        $result = $cloudinary->uploadApi()->upload(
            $request->file('image')->getRealPath(), 
            ["public_id" => $imageName]
        );

        return response()->json([
            'success' => 'Imagen subida con éxito.',
            'image' => $imageName
        ]);
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
    
        // Obtiene la URL de la imagen de Cloudinary
        $cloudinary = app('cloudinary');
        $imageUrl = $cloudinary->api()->resource($imageName)['secure_url'];
    
        if (!$imageUrl) {
            return response()->json(['error' => 'Imagen no encontrada'], 404);
        }
    
        return response()->json(['image' => $imageUrl]);
    }
}