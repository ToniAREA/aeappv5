<?php

namespace App\Http\Controllers\Traits;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

trait MediaUploadingTrait
{
    public function storeMedia(Request $request)
    {
        // Validates file size
        if ($request->has('size')) {
            $this->validate($request, [
                'file' => 'max:' . $request->input('size') * 1024,
            ]);
        }

        // If width or height is preset - we are validating it as an image
        if ($request->has('width') || $request->has('height')) {
            $this->validate($request, [
                'file' => sprintf(
                    'image|dimensions:max_width=%s,max_height=%s',
                    $request->input('width', 100000),
                    $request->input('height', 100000)
                ),
            ]);
        }

        $path = storage_path('tmp/uploads');

        try {
            if (!file_exists($path)) {
                mkdir($path, 0755, true);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to create directory'], 500);
        }

        $file = $request->file('file');
        $originalName = $file->getClientOriginalName();
        $uniqueName = uniqid() . '_' . trim($originalName);

        // Move the original file to the tmp folder
        $file->move($path, $uniqueName);

        // Optimize and convert image to WebP using Intervention Image
        $image = Image::make($path . '/' . $uniqueName);

        // Redimensionar si es necesario
        $image->resize(800, null, function ($constraint) {
            $constraint->aspectRatio(); // Mantener la proporción
        });

        // Convertir a WebP y guardar en la misma carpeta
        $webpName = pathinfo($uniqueName, PATHINFO_FILENAME) . '.webp';
        $image->encode('webp', 75) // 75 es la calidad, puedes ajustarlo
              ->save($path . '/' . $webpName);

        // Opcional: eliminar la imagen original si solo necesitas la versión WebP
        unlink($path . '/' . $uniqueName);

        return response()->json([
            'name'          => $webpName,
            'original_name' => $originalName,
        ]);
    }
}