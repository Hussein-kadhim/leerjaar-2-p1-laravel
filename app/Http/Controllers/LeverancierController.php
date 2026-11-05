<?php

namespace App\Http\Controllers;

use App\Models\Leverancier;

class LeverancierController extends Controller
{
    /**
     * Toont het overzicht van leveranciers met het aantal verschillende producten (Wireframe-01).
     * Gesorteerd op Aantal verschillende producten aflopend.
     */
    public function index()
    {
        // Data ophalen via Model Leverancier (MVC)
        $leveranciers = Leverancier::getLeveranciersOverzicht();

        return view('leverancier.index', [
            'leveranciers' => $leveranciers,
        ]);
    }

    /**
     * Toont de geleverde verschillende producten van een leverancier (Wireframe-02 & Wireframe-03).
     * Scenario 01: Toont producten gesorteerd op Aantal in Magazijn aflopend.
     * Scenario 02: Indien geen producten geleverd, toont melding en redirect na 3 seconden.
     */
    public function producten($leverancierId)
    {
        // Leveranciergegevens ophalen via Model Leverancier
        $leverancier = Leverancier::getLeverancierById((int) $leverancierId);

        if (!$leverancier) {
            return redirect()->route('leverancier.index');
        }

        // Geleverde producten ophalen via Model Leverancier
        $producten = Leverancier::getGeleverdeProducten((int) $leverancierId);

        $heeftProducten = count($producten) > 0;
        $melding = '';

        if (!$heeftProducten) {
            $melding = 'Dit bedrijf heeft tot nu toe geen producten geleverd aan Jamin';
        }

        return view('leverancier.producten', [
            'leverancier' => $leverancier,
            'producten' => $producten,
            'heeftProducten' => $heeftProducten,
            'melding' => $melding,
        ]);
    }
}
