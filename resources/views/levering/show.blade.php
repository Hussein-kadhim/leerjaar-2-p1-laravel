<x-app-layout>
    @if (!$heeftVoorraad)
        <x-slot name="head">
            <meta http-equiv="refresh" content="4; url={{ route('magazijn.index') }}">
        </x-slot>
    @endif

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            LeveringsInformatie
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded shadow">

                <h3 class="text-lg font-bold mb-4">LeveringsInformatie</h3>

                @if ($heeftVoorraad)
                    {{-- Leverancier gegevens boven de tabel --}}
                    <div class="mb-4 space-y-1 text-sm">
                        <p><strong>Naam Leverancier:</strong> {{ $leverancier->LeverancierNaam ?? '' }}</p>
                        <p><strong>Contactpersoon leverancier:</strong> {{ $leverancier->ContactPersoon ?? '' }}</p>
                        <p><strong>Leverancier nummer:</strong> {{ $leverancier->LeverancierNummer ?? '' }}</p>
                        <p><strong>Mobiel:</strong> {{ $leverancier->Mobiel ?? '' }}</p>
                    </div>

                    {{-- Tabel met leveringen --}}
                    <table class="w-full border-collapse border border-gray-300 text-left">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="border border-gray-300 p-2">Naam Product</th>
                                <th class="border border-gray-300 p-2">Datum laatste levering</th>
                                <th class="border border-gray-300 p-2">Aantal</th>
                                <th class="border border-gray-300 p-2">Eerstvolgende levering</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($leveringen as $levering)
                                <tr class="hover:bg-gray-50">
                                    <td class="border border-gray-300 p-2">{{ $product->Naam }}</td>
                                    <td class="border border-gray-300 p-2">{{ date('d-m-Y', strtotime($levering->DatumLevering)) }}</td>
                                    <td class="border border-gray-300 p-2">{{ $levering->Aantal }}</td>
                                    <td class="border border-gray-300 p-2">
                                        @if ($levering->DatumEerstVolgendeLevering)
                                            {{ date('d-m-Y', strtotime($levering->DatumEerstVolgendeLevering)) }}
                                        @else
                                            -
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                @else
                    {{-- Geen voorraad melding --}}
                    <table class="w-full border-collapse border border-gray-300 text-center mb-4">
                        <tbody>
                            <tr>
                                <td class="border border-gray-300 p-6 text-red-600 font-semibold">
                                    {{ $geenVoorraadMelding }}
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <p class="text-sm text-gray-500 text-center">
                        Je wordt binnen 4 seconden doorgestuurd naar het overzicht...
                    </p>

                    <script>
                        setTimeout(function() {
                            window.location.href = "{{ route('magazijn.index') }}";
                        }, 4000);
                    </script>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>
