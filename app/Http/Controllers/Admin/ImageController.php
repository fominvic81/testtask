<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ImageHelper;
use App\Http\Controllers\Controller;
use App\Models\Editor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ImageController extends Controller
{
    public function store(Request $request)
    {   
        $data = $request->validate([
            'image' => ['required', 'image', 'max:64000'],
        ]);

        $name = ImageHelper::uploadImage($data['image']);
        $url = ImageHelper::url($name);

        return response()->json(['name' => $name, 'url' => $url]);
    }
}
