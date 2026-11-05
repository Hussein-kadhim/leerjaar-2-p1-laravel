<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $table = 'Product';
    protected $primaryKey = 'Id';
    public $timestamps = false;

    protected $fillable = [
        'Naam',
        'Barcode',
        'IsActief',
        'Opmerking',
        'DatumAangemaakt',
        'DatumGewijzigd',
    ];

    public function magazijn(): HasOne
    {
        return $this->hasOne(Magazijn::class, 'ProductId', 'Id');
    }

    public function leveringen(): HasMany
    {
        return $this->hasMany(ProductPerLeverancier::class, 'ProductId', 'Id');
    }

    public function allergenen(): HasMany
    {
        return $this->hasMany(ProductPerAllergeen::class, 'ProductId', 'Id');
    }

    /**
     * Haalt een product op inclusief magazijnvoorraad.
     */
    public static function getProductMetVoorraad(int $productId)
    {
        return self::leftJoin('Magazijn', 'Product.Id', '=', 'Magazijn.ProductId')
            ->where('Product.Id', $productId)
            ->select(
                'Product.Id',
                'Product.Naam',
                'Product.Barcode',
                'Magazijn.AantalAanwezig',
                'Magazijn.VerpakkingsEenheid'
            )
            ->first();
    }
}
