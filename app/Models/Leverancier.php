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
     * Relatie naar leveringen via ProductPerLeverancier.
     */
    public function leveringen(): HasMany
    {
        return $this->hasMany(ProductPerLeverancier::class, 'LeverancierId', 'Id');
    }

    /**
     * Haalt overzicht van leveranciers op inclusief aantal verschillende producten via Stored Procedure (Wireframe-01).
     * Gesorteerd op AantalVerschillendeProducten DESC.
     */
    public static function getLeveranciersOverzicht(): array
    {
        return DB::select('CALL spGetLeveranciersOverzicht()');
    }

    /**
     * Haalt specifieke leverancier op per Id via Stored Procedure.
     */
    public static function getLeverancierById(int $leverancierId): ?object
    {
        $result = DB::select('CALL spGetLeverancierById(?)', [$leverancierId]);
        return !empty($result) ? $result[0] : null;
    }

    /**
     * Haalt alle geleverde producten van een leverancier op via Stored Procedure (Wireframe-02 & Wireframe-03).
     * Gesorteerd op Aantal in Magazijn DESC.
     */
    public static function getGeleverdeProducten(int $leverancierId): array
    {
        return DB::select('CALL spGetGeleverdeProductenByLeverancierId(?)', [$leverancierId]);
    }
}

