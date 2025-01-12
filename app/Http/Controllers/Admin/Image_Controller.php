<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Image_Controller extends Controller
{
    public function store(Request $request)
    {
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('uploads/page_system', $filename, 'public'); // Simpan ke folder 'public/uploads'

            // Kembalikan URL file untuk digunakan di TinyMCE
            return response()->json(['location' => asset('storage/' . $path)]);
        }

        return response()->json(['error' => 'No file uploaded'], 400);
    }
}
