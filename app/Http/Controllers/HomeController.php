<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'images.*' => 'required|image'
        ]);

        foreach ($data['images'] as $image) {
            $image->store('/', 'public');
        }
    }
}
