<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AllergeenController extends Controller
{
    /**
     * Detailscherm Allergeneninformatie (User Story 02)
     * Scenario 01: Toont alle allergenen gesorteerd op Naam ASC.
     * Scenario 02: Toont geen-allergenen melding + 4 seconden redirect indien geen allergenen.
     */
    public function show($productId)
    {
        $product = DB::table('Product')->where('Id', $productId)->first();

        if (!$product) {
            abort(404, 'Product niet gevonden');
        }

        // Haal alle allergenen op die aan dit product gekoppeld zijn, gesorteerd op Naam ASC
        $allergenen = DB::table('ProductPerAllergeen as ppa')
            ->join('Allergeen as a', 'ppa.AllergeenId', '=', 'a.Id')
            ->where('ppa.ProductId', $productId)
            ->select(
                'a.Id',
                'a.Naam',
                'a.Omschrijving'
            )
            ->orderBy('a.Naam', 'asc')
            ->get();

        $heeftAllergenen = $allergenen->isNotEmpty();

        $geenAllergenenMelding = null;
        if (!$heeftAllergenen) {
            $geenAllergenenMelding = "In dit product zitten geen stoffen die een allergische reactie kunnen veroorzaken";
        }

        return view('allergeen.show', compact(
            'product',
            'allergenen',
            'heeftAllergenen',
            'geenAllergenenMelding'
        ));
    }
}
