<?php

namespace App\Http\Controllers;

use App\Models\SejarahDesa;
use Illuminate\Http\Request;

class SejarahDesaController extends Controller
{
    
    public function userIndex()
    {
        $sejarahDesas = SejarahDesa::latest()->get();

        return view('pages.landing.profildesa.SejarahDesa', [
            'sejarahDesas' => $sejarahDesas,
        ]);
    }
}
