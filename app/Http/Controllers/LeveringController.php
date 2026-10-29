<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LeveringController extends Controller
{
    public function show($productId)
    {
        // Product en Magazijn voorraad ophalen via leftJoin
        $product = DB::table('Product')
            ->leftJoin('Magazijn', 'Product.Id', '=', 'Magazijn.ProductId')
            ->where('Product.Id', $productId)
            ->select(
                'Product.Id',
                'Product.Naam',
                'Product.Barcode',
                'Magazijn.AantalAanwezig',
                'Magazijn.VerpakkingsEenheid'
            )
            ->first();

        // Leveringen en leverancier ophalen via leftJoin
        $leveringen = DB::table('ProductPerLeverancier')
            ->leftJoin('Leverancier', 'ProductPerLeverancier.LeverancierId', '=', 'Leverancier.Id')
            ->where('ProductPerLeverancier.ProductId', $productId)
            ->select(
                'ProductPerLeverancier.*',
                'Leverancier.Naam as LeverancierNaam',
                'Leverancier.ContactPersoon',
                'Leverancier.LeverancierNummer',
                'Leverancier.Mobiel'
            )
            ->orderBy('ProductPerLeverancier.DatumLevering', 'asc')
            ->get();

        $leverancier = $leveringen->first();

        // Controleren of er voorraad is
        $heeftVoorraad = true;
        $geenVoorraadMelding = "";

        if (!$product || $product->AantalAanwezig === null || $product->AantalAanwezig == 0) {
            $heeftVoorraad = false;
            $geenVoorraadMelding = "Er is van dit product op dit moment geen voorraad aanwezig, de verwachte eerstvolgende levering is: 30-04-2023";
        }

        return view('levering.show', [
            'product' => $product,
            'magazijn' => $product,
            'leveringen' => $leveringen,
            'leverancier' => $leverancier,
            'heeftVoorraad' => $heeftVoorraad,
            'geenVoorraadMelding' => $geenVoorraadMelding
        ]);
    }

    /**
     * Detailscherm Levering product (Wireframe-04).
     */
    public function create($leverancierId, $productId)
    {
        $details = DB::select('CALL spGetProductLeveringDetails(?, ?)', [$leverancierId, $productId]);
        $leveringInfo = !empty($details) ? $details[0] : null;

        if (!$leveringInfo) {
            return redirect()->route('leverancier.index');
        }

        return view('levering.create', [
            'leveringInfo' => $leveringInfo,
            'leverancierId' => $leverancierId,
            'productId' => $productId,
        ]);
    }

    /**
     * Verwerkt de levering van een product.
     * Scenario 01: Verhoogt de voorraad en legt levering vast.
     * Scenario 02: Als product niet actief is (IsActief == false), toon melding en stuur na 4 sec door.
     */
    public function store(Request $request, $leverancierId, $productId)
    {
        $request->validate([
            'aantal' => 'required|integer|min:1',
            'datum_eerstvolgende_levering' => 'nullable|date',
        ]);

        // Haal product- en leveranciergegevens op
        $details = DB::select('CALL spGetProductLeveringDetails(?, ?)', [$leverancierId, $productId]);
        $leveringInfo = !empty($details) ? $details[0] : null;

        if (!$leveringInfo) {
            return redirect()->route('leverancier.index');
        }

        // Scenario 02: Product is niet actief (Winegums van Basset)
        if (!$leveringInfo->ProductIsActief) {
            return redirect()
                ->route('levering.create', ['leverancierId' => $leverancierId, 'productId' => $productId])
                ->with('inactief_melding', "Het product {$leveringInfo->ProductNaam} van de leverancier {$leveringInfo->LeverancierNaam} wordt niet meer geproduceerd");
        }

        // Scenario 01: Product is actief -> toevoegen via Stored Procedure
        $aantal = (int) $request->input('aantal');
        $datumEerstvolgende = $request->input('datum_eerstvolgende_levering') ?: null;

        DB::statement('CALL spVoegProductLeveringToe(?, ?, ?, ?)', [
            $leverancierId,
            $productId,
            $aantal,
            $datumEerstvolgende,
        ]);

        return redirect()->route('leverancier.producten', $leverancierId);
    }
}
