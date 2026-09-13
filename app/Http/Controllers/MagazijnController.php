<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MagazijnController extends Controller
{
    /**
     * Toont het overzicht van alle producten in het magazijn.
     * Gesorteerd op Barcode oplopend (ASC).
     */
    public function index()
    {
        $producten = DB::table('Product as p')
            ->leftJoin('Magazijn as m', 'p.Id', '=', 'm.ProductId')
            ->select(
                'p.Id',
                'p.Naam',
                'p.Barcode',
                'm.VerpakkingsEenheid',
                'm.AantalAanwezig'
            )
            ->where('p.IsActief', 1)
            ->orderBy('p.Barcode', 'asc')
            ->get();

        return view('magazijn.index', compact('producten'));
    }
}
