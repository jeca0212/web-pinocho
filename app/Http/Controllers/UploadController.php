<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function uploadMenu20(Request $request)
{
    return $this->uploadFile($request, 'menu20.pdf');
}

public function uploadMenuGrupo(Request $request)
{
    return $this->uploadFile($request, 'menugrupo.pdf');
}

public function uploadMenuInfantil(Request $request)
{
    return $this->uploadFile($request, 'menuinfantil.pdf');
}

public function uploadRaciones(Request $request)
{
    return $this->uploadFile($request, 'raciones.pdf');
}

public function uploadTapas(Request $request)
{
    return $this->uploadFile($request, 'tapas.pdf');
}

public function uploadPostres(Request $request)
{
    return $this->uploadFile($request, 'postres.pdf');
}

private function uploadFile(Request $request, $filename)
{
    if ($request->hasFile('pdf')) {
        $file = $request->file('pdf');

        // Cambia esta línea a la ruta de la carpeta `public/pdfs` de tu aplicación Next.js
        $path = base_path('../front/public/pdfs');
        
        if (file_exists($path . '/' . $filename)) {
            unlink($path . '/' . $filename);
        }
        
        $file->move($path, $filename);

        return response()->json(['success' => 'Archivo subido con éxito']);
    } else {
        return response()->json(['error' => 'No se ha subido ningún archivo']);
    }
}
}