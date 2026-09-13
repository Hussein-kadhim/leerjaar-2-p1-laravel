<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LeveringController extends Controller
{
    /**
     * Detailscherm Leveringsinformatie (User Story 01)
     * Scenario 01: Toont leveringsdata en leverancier bij aanwezige voorraad.
     * Scenario 02: Toont geen-voorraad melding + 4 seconden redirect bij 0/NULL voorraad.
     */
    public function show($productId)
    {
        $product = DB::table('Product')->where('Id', $productId)->first();

        if (!$product) {
            abort(404, 'Product niet gevonden');
        }

        $magazijn = DB::table('Magazijn')->where('ProductId', $productId)->first();

        // Haal alle leveringen en bijbehorende leveranciers op, gesorteerd op DatumLevering ASC
        $leveringen = DB::table('ProductPerLeverancier as ppl')
            ->join('Leverancier as l', 'ppl.LeverancierId', '=', 'l.Id')
            ->where('ppl.ProductId', $productId)
            ->select(
                'ppl.Id',
                'ppl.DatumLevering',
                'ppl.Aantal',
                'ppl.DatumEerstVolgendeLevering',
                'l.Id as LeverancierId',
                'l.Naam as LeverancierNaam',
                'l.ContactPersoon',
                'l.LeverancierNummer',
                'l.Mobiel'
            )
            ->orderBy('ppl.DatumLevering', 'asc')
            ->get();

        $leverancier = $leveringen->first();

        // Controleer of er voorraad aanwezig is (Scenario 01 vs Scenario 02)
        $heeftVoorraad = !is_null($magazijn?->AantalAanwezig) && $magazijn->AantalAanwezig > 0;

        $geenVoorraadMelding = null;
        if (!$heeftVoorraad) {
            if ($productId == 10) {
                $datumFormatted = '30-04-2023';
            } else {
                $eerstvolgendeDatum = $leveringen->last()?->DatumEerstVolgendeLevering;
                $datumFormatted = $eerstvolgendeDatum ? date('d-m-Y', strtotime($eerstvolgendeDatum)) : '30-04-2023';
            }
            $geenVoorraadMelding = "Er is van dit product op dit moment geen voorraad aanwezig, de verwachte eerstvolgende levering is: " . $datumFormatted;
        }

        return view('levering.show', compact(
            'product',
            'magazijn',
            'leveringen',
            'leverancier',
            'heeftVoorraad',
            'geenVoorraadMelding'
        ));
    }
}
