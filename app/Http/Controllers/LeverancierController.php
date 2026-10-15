<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class LeverancierController extends Controller
{
    /**
     * Toont het overzicht van leveranciers met het aantal verschillende producten (Wireframe-01).
     * Gesorteerd op Aantal verschillende producten aflopend.
     */
    public function index()
    {
        // Stored procedure aanroepen via PDO
        $leveranciers = DB::select('CALL spGetLeveranciersOverzicht()');

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
        // Leveranciergegevens ophalen via Stored Procedure
        $leverancierResult = DB::select('CALL spGetLeverancierById(?)', [$leverancierId]);
        $leverancier = !empty($leverancierResult) ? $leverancierResult[0] : null;

        if (!$leverancier) {
            return redirect()->route('leverancier.index');
        }

        // Geleverde producten ophalen via Stored Procedure
        $producten = DB::select('CALL spGetGeleverdeProductenByLeverancierId(?)', [$leverancierId]);

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
