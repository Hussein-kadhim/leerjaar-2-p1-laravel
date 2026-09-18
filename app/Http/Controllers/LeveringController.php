<?php

namespace App\Http\Controllers;

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
}
