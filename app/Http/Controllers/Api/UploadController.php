<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UploadController extends Controller
{
  public function uploadImage(Request $request)
  {
    if ($request->has('image')) {
      $image = $request->image;
      $nameFile = time() . '.' . $image->getClientOriginalExtension();
      $path = public_path('upload/images');
      $image->move($path, $nameFile);

      return response()->json([
        'image_path' => '/upload/images/' . $nameFile,
        'base_url' => url('/'),
      ]);
    }

    return response()->noContent();
  }

  public function uploadImages(Request $request)
  {
    if ($request->has('image')) {
      $images = $request->image;
      $nameFiles = [];

      foreach ($images as $key => $image) {
        $nameFile = time() . '-' . $key . '.' . $image->getClientOriginalExtension();
        $path = public_path('upload/images');
        $image->move($path, $nameFile);

        // Tampung nameFile ke array
        array_push($nameFiles, '/upload/images/' . $nameFile);
      }

      return response()->json([
        'image_paths' => $nameFiles,
        'base_url' => url('/'),
      ]);
    }

    return response()->noContent();
  }
}
