<?php

namespace App\Http\Controllers;

use App\Models\Magazijn;

class MagazijnController extends Controller
{
    public function index()
    {
        // Haal alle producten op met de magazijn voorraad via Model Magazijn
        $producten = Magazijn::getMagazijnOverzicht();

        return view('magazijn.index', [
            'producten' => $producten
        ]);
    }
}
