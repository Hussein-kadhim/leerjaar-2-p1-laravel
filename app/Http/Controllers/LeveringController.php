<?php

namespace App\Http\Controllers;

use App\Models\Levering;
use App\Models\Product;
use Illuminate\Http\Request;

class LeveringController extends Controller
{
    public function show($productId)
    {
        // Product en Magazijn voorraad ophalen via Model Product
        $product = Product::getProductMetVoorraad((int) $productId);

        // Leveringen en leverancier ophalen via Model Levering
        $leveringen = Levering::getLeveringenByProductId((int) $productId);

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
        // Haal product- en leveranciergegevens op via Model Levering (MVC)
        $leveringInfo = Levering::getProductLeveringDetails((int) $leverancierId, (int) $productId);

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

        // Haal product- en leveranciergegevens op via Model Levering
        $leveringInfo = Levering::getProductLeveringDetails((int) $leverancierId, (int) $productId);

        if (!$leveringInfo) {
            return redirect()->route('leverancier.index');
        }

        // Scenario 02: Product is niet actief (Winegums van Basset)
        if (!$leveringInfo->ProductIsActief) {
            return redirect()
                ->route('levering.create', ['leverancierId' => $leverancierId, 'productId' => $productId])
                ->with('inactief_melding', "Het product {$leveringInfo->ProductNaam} van de leverancier {$leveringInfo->LeverancierNaam} wordt niet meer geproduceerd");
        }

        // Scenario 01: Product is actief -> toevoegen via Model Levering (MVC)
        $aantal = (int) $request->input('aantal');
        $datumEerstvolgende = $request->input('datum_eerstvolgende_levering') ?: null;

        Levering::voegLeveringToe(
            (int) $leverancierId,
            (int) $productId,
            $aantal,
            $datumEerstvolgende
        );

        return redirect()->route('leverancier.producten', $leverancierId);
    }
}
