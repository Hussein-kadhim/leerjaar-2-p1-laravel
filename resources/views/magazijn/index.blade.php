<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Overzicht Magazijn Jamin
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded shadow">

                <h3 class="text-lg font-bold mb-4">Overzicht Magazijn Jamin</h3>

                <table class="w-full border-collapse border border-gray-300 text-left">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border border-gray-300 p-2">Barcode</th>
                            <th class="border border-gray-300 p-2">Naam</th>
                            <th class="border border-gray-300 p-2">Verpakkingseenheid</th>
                            <th class="border border-gray-300 p-2">Aantal aanwezig</th>
                            <th class="border border-gray-300 p-2 text-center">Allergenen Info</th>
                            <th class="border border-gray-300 p-2 text-center">Leverantie Info</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($producten as $product)
                            <tr class="hover:bg-gray-50">
                                <td class="border border-gray-300 p-2">{{ $product->Barcode }}</td>
                                <td class="border border-gray-300 p-2">{{ $product->Naam }}</td>
                                <td class="border border-gray-300 p-2">{{ str_replace('.', ',', (string)$product->VerpakkingsEenheid) }} kg</td>
                                <td class="border border-gray-300 p-2">
                                    @if ($product->AantalAanwezig === null || $product->AantalAanwezig === 0)
                                        <span class="text-red-600 font-bold">Geen voorraad</span>
                                    @else
                                        {{ $product->AantalAanwezig }}
                                    @endif
                                </td>
                                <td class="border border-gray-300 p-2 text-center">
                                    <a href="{{ route('allergeen.show', $product->Id) }}" class="text-red-600 font-bold text-xl no-underline hover:underline">
                                        X
                                    </a>
                                </td>
                                <td class="border border-gray-300 p-2 text-center">
                                    <a href="{{ route('levering.show', $product->Id) }}" class="text-blue-600 font-bold text-xl no-underline hover:underline">
                                        ?
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</x-app-layout>
