<?php

use App\Models\Leverancier;
use App\Models\Contact;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

test('Unit Test 1: leverancier model heeft een belongsTo relatie met contact', function () {
    $leverancier = new Leverancier();
    expect($leverancier->contact())->toBeInstanceOf(BelongsTo::class);
});

test('Unit Test 2: leverancier model bevat alle vereiste fillable attributen voor wijzigen', function () {
    $leverancier = new Leverancier();
    $fillables = $leverancier->getFillable();

    expect($fillables)
        ->toContain('Naam')
        ->toContain('ContactPersoon')
        ->toContain('LeverancierNummer')
        ->toContain('Mobiel')
        ->toContain('ContactId');
});
