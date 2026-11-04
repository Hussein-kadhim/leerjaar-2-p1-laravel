<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\DB;

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
     * Details voor levering product ophalen via Stored Procedure (Wireframe-04).
     */
    public static function getProductLeveringDetails(int $leverancierId, int $productId): ?object
    {
        $details = DB::select('CALL spGetProductLeveringDetails(?, ?)', [$leverancierId, $productId]);
        return !empty($details) ? $details[0] : null;
    }

    /**
     * Voegt een nieuwe levering toe en werkt de voorraad bij via Stored Procedure.
     */
    public static function voegLeveringToe(int $leverancierId, int $productId, int $aantal, ?string $datumEerstvolgende = null): bool
    {
        return DB::statement('CALL spVoegProductLeveringToe(?, ?, ?, ?)', [
            $leverancierId,
            $productId,
            $aantal,
            $datumEerstvolgende,
        ]);
    }
}

