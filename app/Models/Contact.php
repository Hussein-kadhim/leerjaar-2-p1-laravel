<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Contact extends Model
{
    use HasFactory;

    protected $table = 'Contact';
    protected $primaryKey = 'Id';
    public $timestamps = false;

    protected $fillable = [
        'Straat',
        'Huisnummer',
        'Postcode',
        'Stad',
        'IsActief',
        'Opmerking',
        'DatumAangemaakt',
        'DatumGewijzigd',
    ];

    /**
     * Relatie naar Leverancier.
     */
    public function leverancier(): HasOne
    {
        return $this->hasOne(Leverancier::class, 'ContactId', 'Id');
    }
}
