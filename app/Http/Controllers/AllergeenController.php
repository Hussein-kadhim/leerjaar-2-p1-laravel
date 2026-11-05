<?php

namespace App\Http\Controllers;

use App\Models\Allergeen;
use App\Models\Product;

class AllergeenController extends Controller
{
    public function show($productId)
    {
        // Product ophalen via Model Product
        $product = Product::find($productId);

        // Allergenen ophalen via Model Allergeen
        $allergenen = Allergeen::getByProductId((int) $productId);

        // Controleren of er allergenen zijn
        $heeftAllergenen = count($allergenen) > 0;
        $geenAllergenenMelding = "";

        if (!$heeftAllergenen) {
            $geenAllergenenMelding = "In dit product zitten geen stoffen die een allergische reactie kunnen veroorzaken";
        }

        return view('allergeen.show', [
            'product' => $product,
            'allergenen' => $allergenen,
            'heeftAllergenen' => $heeftAllergenen,
            'geenAllergenenMelding' => $geenAllergenenMelding
        ]);
    }
}

