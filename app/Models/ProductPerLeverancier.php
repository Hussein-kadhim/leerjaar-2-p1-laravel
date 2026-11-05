<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductPerLeverancier extends Model
{
    use HasFactory;

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
     * Haalt details op voor het levering product scherm (Wireframe-04) via de Models.
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
     * Voegt een levering toe en verhoogt de magazijnvoorraad via Eloquent Models.
     */
    public static function voegLeveringToe(int $leverancierId, int $productId, int $aantal, ?string $datumEerstvolgende = null): bool
    {
        // 1. Nieuwe levering opslaan via Model
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
