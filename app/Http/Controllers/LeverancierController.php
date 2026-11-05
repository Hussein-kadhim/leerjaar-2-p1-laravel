<?php

namespace App\Http\Controllers;

use App\Models\Leverancier;
use Illuminate\Http\Request;

class LeverancierController extends Controller
{
    /**
     * BE-Opdracht 02 - Wireframe-01:
     * Toont het overzicht van leveranciers met het aantal verschillende producten.
     * Gesorteerd op Aantal verschillende producten aflopend.
     */
    public function index()
    {
        $leveranciers = Leverancier::getLeveranciersOverzicht();

        return view('leverancier.index', [
            'leveranciers' => $leveranciers,
        ]);
    }

    /**
     * BE-Opdracht 02 - Wireframe-02 & Wireframe-03:
     * Toont de geleverde verschillende producten van een leverancier.
     * Scenario 01: Toont producten gesorteerd op Aantal in Magazijn aflopend.
     * Scenario 02: Indien geen producten geleverd, toont melding en redirect na 3 seconden.
     */
    public function producten($leverancierId)
    {
        $leverancier = Leverancier::getLeverancierById((int) $leverancierId);

        if (!$leverancier) {
            return redirect()->route('leverancier.index');
        }

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

    /**
     * BE-Opdracht 03 - Wireframe-02:
     * Toont het overzicht van leveranciers voor Wijzigen Leveranciers met server-side pagination (max 4 per pagina).
     */
    public function wijzigenIndex()
    {
        $leveranciers = Leverancier::getLeveranciersPaginated(4);

        return view('leverancier.overzicht_wijzigen', [
            'leveranciers' => $leveranciers,
        ]);
    }

    /**
     * BE-Opdracht 03 - Wireframe-03:
     * Toont het detailscherm van een leverancier inclusief adresgegevens.
     */
    public function details($leverancierId)
    {
        $details = Leverancier::getDetailsById((int) $leverancierId);

        if (!$details) {
            return redirect()->route('leverancier.wijzigen');
        }

        return view('leverancier.details', [
            'leverancier' => $details,
        ]);
    }

    /**
     * BE-Opdracht 03 - Wireframe-04:
     * Toont het formulier om leveranciergegevens te wijzigen.
     */
    public function edit($leverancierId)
    {
        $details = Leverancier::getDetailsById((int) $leverancierId);

        if (!$details) {
            return redirect()->route('leverancier.wijzigen');
        }

        return view('leverancier.edit', [
            'leverancier' => $details,
        ]);
    }

    /**
     * BE-Opdracht 03 - User Story 1 (Scenario 01 & Scenario 02):
     * Verwerkt de wijziging van leveranciergegevens.
     */
    public function update(Request $request, $leverancierId)
    {
        $request->validate([
            'Naam' => 'required|string|max:100',
            'ContactPersoon' => 'required|string|max:100',
            'LeverancierNummer' => 'required|string|max:20',
            'Mobiel' => 'required|string|max:20',
            'Straatnaam' => 'required|string|max:100',
            'Huisnummer' => 'required|string|max:20',
            'Postcode' => 'required|string|max:10',
            'Stad' => 'required|string|max:100',
        ]);

        try {
            Leverancier::updateLeverancierGegevens((int) $leverancierId, $request->all());

            // Scenario 01: Succesvol gewijzigd
            return redirect()
                ->route('leverancier.edit', $leverancierId)
                ->with('success_melding', 'De wijzigingen zijn doorgevoerd');
        } catch (\Throwable $e) {
            // Scenario 02: Technische storing / duplicaat mobielnummer
            return redirect()
                ->route('leverancier.edit', $leverancierId)
                ->with('error_melding', 'Door een technische storing is het niet mogelijk de wijziging door te voeren. Probeer het op een later moment nog eens');
        }
    }
}
