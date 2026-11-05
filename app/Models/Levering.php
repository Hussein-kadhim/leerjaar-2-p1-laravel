<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Levering extends Model
{
    use HasFactory;

    // Koppeling naar de tabel ProductPerLeverancier in de database
    protected $table = 'ProductPerLeverancier';
    protected $primaryKey = 'Id';
    public $timestamps = false;

    protected $fillable = [
        'LeverancierId',
        'ProductId',
        'DatumLevering',
        'Aantal',
        'DatumEerstVolgendeLevering',
        'IsActief',
        'Opmerking',
        'DatumAangemaakt',
        'DatumGewijzigd',
    ];

    /**
     * Relatie naar Leverancier.
     */
    public function leverancier(): BelongsTo
    {
        return $this->belongsTo(Leverancier::class, 'LeverancierId', 'Id');
    }

    /**
     * Relatie naar Product.
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'ProductId', 'Id');
    }

    /**
     * Haalt alle leveringen van een specifiek product op inclusief leverancier (Opdracht 1 US 1).
     */
    public static function getLeveringenByProductId(int $productId)
    {
        return self::leftJoin('Leverancier', 'ProductPerLeverancier.LeverancierId', '=', 'Leverancier.Id')
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
    }

    /**
     * Haalt details op voor het leveringscherm (Wireframe-04).
     */
    public static function getProductLeveringDetails(int $leverancierId, int $productId): ?object
    {
        $product = Product::find($productId);
        $leverancier = Leverancier::find($leverancierId);

        if (!$product || !$leverancier) {
            return null;
        }

        return (object) [
            'ProductId' => $product->Id,
            'ProductNaam' => $product->Naam,
            'ProductIsActief' => (bool) $product->IsActief,
            'LeverancierId' => $leverancier->Id,
            'LeverancierNaam' => $leverancier->Naam,
            'ContactPersoon' => $leverancier->ContactPersoon,
            'Mobiel' => $leverancier->Mobiel,
        ];
    }

    /**
     * Voegt een nieuwe levering toe en verhoogt de voorraad in Magazijn via het Model.
     */
    public static function voegLeveringToe(int $leverancierId, int $productId, int $aantal, ?string $datumEerstvolgende = null): bool
    {
        // 1. Nieuwe levering opslaan
        self::create([
            'LeverancierId' => $leverancierId,
            'ProductId' => $productId,
            'DatumLevering' => now()->toDateString(),
            'Aantal' => $aantal,
            'DatumEerstVolgendeLevering' => $datumEerstvolgende,
            'IsActief' => 1,
            'DatumAangemaakt' => now(),
            'DatumGewijzigd' => now(),
        ]);

        // 2. Magazijnvoorraad bijwerken via Model Magazijn
        $magazijn = Magazijn::where('ProductId', $productId)->first();
        if ($magazijn) {
            $magazijn->AantalAanwezig = ($magazijn->AantalAanwezig ?? 0) + $aantal;
            $magazijn->DatumGewijzigd = now();
            $magazijn->save();
        }

        return true;
    }
}
