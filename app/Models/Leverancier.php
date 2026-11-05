<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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
        'IsActief',
        'Opmerking',
        'DatumAangemaakt',
        'DatumGewijzigd',
    ];

    /**
     * Relatie: 1 Leverancier heeft meerdere leveringen via ProductPerLeverancier.
     */
    public function leveringen(): HasMany
    {
        return $this->hasMany(ProductPerLeverancier::class, 'LeverancierId', 'Id');
    }

    /**
     * Haalt overzicht van leveranciers op via het Model.
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
                'Leverancier.IsActief',
                'Leverancier.Opmerking',
                'Leverancier.DatumAangemaakt',
                'Leverancier.DatumGewijzigd'
            )
            ->orderByDesc('AantalVerschillendeProducten')
            ->get();
    }

    /**
     * Haalt 1 specifieke leverancier op via het Model.
     */
    public static function getLeverancierById(int $leverancierId): ?self
    {
        return self::find($leverancierId);
    }

    /**
     * Haalt alle geleverde producten van een leverancier op via de Models (Wireframe-02 & Wireframe-03).
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
