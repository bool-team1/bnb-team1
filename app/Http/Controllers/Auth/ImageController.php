<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function store()
    {
        $img_path = Storage::put('uploads', $dati['image']);
    }
}
