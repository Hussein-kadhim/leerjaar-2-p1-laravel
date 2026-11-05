<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;

class Leverancier extends Model
{
    use HasFactory;

    protected $table = 'Leverancier';
    protected $primaryKey = 'Id';
    public $timestamps = false;

    protected $fillable = [
        'Naam',
        'ContactPersoon',
        'LeverancierNummer',
        'Mobiel',
        'ContactId',
        'IsActief',
        'Opmerking',
        'DatumAangemaakt',
        'DatumGewijzigd',
    ];

    /**
     * Relatie: 1 Leverancier hoort bij 1 Contact (Adresgegevens).
     */
    public function contact(): BelongsTo
    {
        return $this->belongsTo(Contact::class, 'ContactId', 'Id');
    }

    /**
     * Relatie: 1 Leverancier heeft meerdere leveringen via ProductPerLeverancier.
     */
    public function leveringen(): HasMany
    {
        return $this->hasMany(ProductPerLeverancier::class, 'LeverancierId', 'Id');
    }

    /**
     * Haalt overzicht van leveranciers op via het Model (Opdracht 2).
     * Telt het aantal unieke producten en sorteert aflopend (Wireframe-01).
     */
    public static function getLeveranciersOverzicht()
    {
        return self::select('Leverancier.*')
            ->selectRaw('COUNT(DISTINCT ProductPerLeverancier.ProductId) as AantalVerschillendeProducten')
            ->leftJoin('ProductPerLeverancier', 'Leverancier.Id', '=', 'ProductPerLeverancier.LeverancierId')
            ->groupBy(
                'Leverancier.Id',
                'Leverancier.Naam',
                'Leverancier.ContactPersoon',
                'Leverancier.LeverancierNummer',
                'Leverancier.Mobiel',
                'Leverancier.ContactId',
                'Leverancier.IsActief',
                'Leverancier.Opmerking',
                'Leverancier.DatumAangemaakt',
                'Leverancier.DatumGewijzigd'
            )
            ->orderByDesc('AantalVerschillendeProducten')
            ->get();
    }

    /**
     * Haalt overzicht van leveranciers op met server-side pagination (Opdracht 3 Wireframe-02).
     * Maximaal 4 records per pagina.
     */
    public static function getLeveranciersPaginated(int $perPage = 4)
    {
        return self::orderBy('Id', 'asc')->paginate($perPage);
    }

    /**
     * Haalt 1 specifieke leverancier op via het Model.
     */
    public static function getLeverancierById(int $leverancierId): ?self
    {
        return self::find($leverancierId);
    }

    /**
     * Haalt leverancier details inclusief adres op (Opdracht 3 Wireframe-03 & 04).
     */
    public static function getDetailsById(int $leverancierId): ?object
    {
        // Kan via Stored Procedure of Eloquent; we ondersteunen beide!
        $result = DB::select('CALL spGetLeverancierDetailsById(?)', [$leverancierId]);
        if (!empty($result)) {
            return $result[0];
        }

        // Fallback via Eloquent
        $leverancier = self::with('contact')->find($leverancierId);
        if (!$leverancier) {
            return null;
        }

        return (object) [
            'LeverancierId' => $leverancier->Id,
            'Naam' => $leverancier->Naam,
            'ContactPersoon' => $leverancier->ContactPersoon,
            'LeverancierNummer' => $leverancier->LeverancierNummer,
            'Mobiel' => $leverancier->Mobiel,
            'ContactId' => $leverancier->ContactId,
            'Straatnaam' => $leverancier->contact?->Straat ?? '',
            'Huisnummer' => $leverancier->contact?->Huisnummer ?? '',
            'Postcode' => $leverancier->contact?->Postcode ?? '',
            'Stad' => $leverancier->contact?->Stad ?? '',
        ];
    }

    /**
     * Wijzigt leveranciergegevens en contactgegevens (Opdracht 3 User Story 1).
     * Gooit exception bij storing of duplicaat mobielnummer.
     */
    public static function updateLeverancierGegevens(int $leverancierId, array $data): bool
    {
        // Valideer uniek mobielnummer (mag niet voorkomen bij andere leverancier)
        $bestaatMobiel = self::where('Mobiel', $data['Mobiel'])
            ->where('Id', '!=', $leverancierId)
            ->exists();

        if ($bestaatMobiel) {
            throw new \Exception('Mobielnummer is al in gebruik bij een andere leverancier.');
        }

        // Aanroep via Stored Procedure (Verplicht: Stored Procedures & PDO)
        DB::statement('CALL spWijzigLeverancier(?, ?, ?, ?, ?, ?, ?, ?, ?)', [
            $leverancierId,
            $data['Naam'],
            $data['ContactPersoon'],
            $data['LeverancierNummer'],
            $data['Mobiel'],
            $data['Straatnaam'],
            $data['Huisnummer'],
            $data['Postcode'],
            $data['Stad'],
        ]);

        return true;
    }

    /**
     * Haalt alle geleverde producten van een leverancier op via de Models (Wireframe-02 & Wireframe-03 van Opdracht 2).
     * Gesorteerd op Aantal in Magazijn aflopend.
     */
    public static function getGeleverdeProducten(int $leverancierId)
    {
        return Product::select(
                'Product.Id as ProductId',
                'Product.Naam as ProductNaam',
                'Product.IsActief as ProductIsActief',
                'Magazijn.AantalAanwezig',
                'Magazijn.VerpakkingsEenheid',
                DB::raw('MAX(ProductPerLeverancier.DatumLevering) as LaatsteLevering')
            )
            ->join('ProductPerLeverancier', 'Product.Id', '=', 'ProductPerLeverancier.ProductId')
            ->leftJoin('Magazijn', 'Product.Id', '=', 'Magazijn.ProductId')
            ->where('ProductPerLeverancier.LeverancierId', $leverancierId)
            ->groupBy(
                'Product.Id',
                'Product.Naam',
                'Product.IsActief',
                'Magazijn.AantalAanwezig',
                'Magazijn.VerpakkingsEenheid'
            )
            ->orderByDesc('Magazijn.AantalAanwezig')
            ->get();
    }
}
