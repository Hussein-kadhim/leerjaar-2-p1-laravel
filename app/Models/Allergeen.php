<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Allergeen extends Model
{
    use HasFactory;

    protected $table = 'Allergeen';
    protected $primaryKey = 'Id';
    public $timestamps = false;

    protected $fillable = [
        'Naam',
        'Omschrijving',
        'IsActief',
        'Opmerking',
        'DatumAangemaakt',
        'DatumGewijzigd',
    ];

    public function productAllergenen(): HasMany
    {
        return $this->hasMany(ProductPerAllergeen::class, 'AllergeenId', 'Id');
    }

    /**
     * Haalt alle allergenen op voor een specifiek product.
     */
    public static function getByProductId(int $productId)
    {
        return self::join('ProductPerAllergeen', 'Allergeen.Id', '=', 'ProductPerAllergeen.AllergeenId')
            ->where('ProductPerAllergeen.ProductId', $productId)
            ->select('Allergeen.Naam', 'Allergeen.Omschrijving')
            ->orderBy('Allergeen.Naam', 'asc')
            ->get();
    }
}
