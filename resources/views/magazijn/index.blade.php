<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Overzicht Magazijn Jamin') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <div class="mb-4 flex justify-between items-center">
                    <h3 class="text-xl font-bold text-gray-700">Voorraad & Producten</h3>
                    <span class="text-sm text-gray-500">Gesorteerd op Barcode (oplopend)</span>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-300 border border-gray-200 text-left text-sm">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="py-3.5 px-4 font-semibold text-gray-900 border-b">Barcode</th>
                                <th scope="col" class="py-3.5 px-4 font-semibold text-gray-900 border-b">Naam</th>
                                <th scope="col" class="py-3.5 px-4 font-semibold text-gray-900 border-b">Verpakkingseenheid</th>
                                <th scope="col" class="py-3.5 px-4 font-semibold text-gray-900 border-b">Aantal aanwezig</th>
                                <th scope="col" class="py-3.5 px-4 font-semibold text-gray-900 text-center border-b">Allergenen Info</th>
                                <th scope="col" class="py-3.5 px-4 font-semibold text-gray-900 text-center border-b">Leverantie Info</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white">
                            @forelse ($producten as $product)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="py-3 px-4 font-mono text-gray-800 border-r border-gray-100">
                                        {{ $product->Barcode }}
                                    </td>
                                    <td class="py-3 px-4 font-medium text-gray-900 border-r border-gray-100">
                                        {{ $product->Naam }}
                                    </td>
                                    <td class="py-3 px-4 text-gray-700 border-r border-gray-100">
                                        {{ str_replace('.', ',', (string)$product->VerpakkingsEenheid) }} kg
                                    </td>
                                    <td class="py-3 px-4 text-gray-700 border-r border-gray-100">
                                        @if (is_null($product->AantalAanwezig) || $product->AantalAanwezig === 0)
                                            <span class="text-red-600 font-semibold">Geen voorraad</span>
                                        @else
                                            {{ $product->AantalAanwezig }}
                                        @endif
                                    </td>
                                    <td class="py-3 px-4 text-center border-r border-gray-100">
                                        <a href="{{ route('allergeen.show', $product->Id) }}" 
                                           class="inline-flex items-center justify-center w-8 h-8 rounded-full hover:bg-red-50 text-red-600 font-extrabold text-lg transition duration-150"
                                           title="Bekijk allergeneninformatie van {{ $product->Naam }}">
                                            ❌
                                        </a>
                                    </td>
                                    <td class="py-3 px-4 text-center">
                                        <a href="{{ route('levering.show', $product->Id) }}" 
                                           class="inline-flex items-center justify-center w-8 h-8 rounded-full hover:bg-blue-50 text-blue-600 font-extrabold text-xl transition duration-150"
                                           title="Bekijk leveringsinformatie van {{ $product->Naam }}">
                                            ❓
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="py-6 text-center text-gray-500">
                                        Geen producten gevonden in het magazijn.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
