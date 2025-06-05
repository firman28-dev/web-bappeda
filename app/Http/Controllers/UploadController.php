<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UploadController extends Controller
{
   public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpg,jpeg,png,gif,webp|max:5120',
        ]);

        // if (!$request->hasFile('image')) {
        //     return response()->json(['error' => 'No file uploaded'], 400);
        // }

        $file     = $request->file('image');
        $filename = Str::random(20) . '.' . $file->getClientOriginalExtension();

        $destination = public_path('uploads/page_system/konten');

        if (!is_dir($destination)) {
            mkdir($destination, 0755, true);
        }

        $file->move($destination, $filename);

        return response()->json([
            'url'  => asset('uploads/page_system/konten/' . $filename), 
            'name' => $filename, 
        ]);
    }

}
