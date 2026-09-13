<x-app-layout>
    @if (!$heeftVoorraad)
        {{-- Scenario 02: Na 4 seconden automatische redirect naar het overzicht --}}
        <x-slot name="head">
            <meta http-equiv="refresh" content="4; url={{ route('magazijn.index') }}">
        </x-slot>
    @endif

    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                {{ __('LeveringsInformatie') }}
            </h2>
            <a href="{{ route('magazijn.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 text-sm font-medium rounded-md transition">
                &larr; Terug naar Overzicht
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                @if ($heeftVoorraad)
                    {{-- Scenario 01: Voorraad aanwezig, toon leveranciergegevens en leveringstabel --}}
                    
                    {{-- Leveranciergegevens boven de tabel conform Wireframe 2 --}}
                    <div class="mb-6 bg-gray-50 p-4 rounded-lg border border-gray-200">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3 text-base text-gray-800">
                            <div>
                                <span class="font-bold">Naam Leverancier:</span> 
                                <span>{{ $leverancier?->LeverancierNaam ?? 'Onbekend' }}</span>
                            </div>
                            <div>
                                <span class="font-bold">Contactpersoon leverancier:</span> 
                                <span>{{ $leverancier?->ContactPersoon ?? 'Onbekend' }}</span>
                            </div>
                            <div>
                                <span class="font-bold">Leverancier nummer:</span> 
                                <span>{{ $leverancier?->LeverancierNummer ?? 'Onbekend' }}</span>
                            </div>
                            <div>
                                <span class="font-bold">Mobiel:</span> 
                                <span>{{ $leverancier?->Mobiel ?? 'Onbekend' }}</span>
                            </div>
                        </div>
                    </div>

                    {{-- Tabel leveringen gesorteerd op Datum laatste levering (DatumLevering) ASC --}}
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-300 border border-gray-200 text-left text-sm">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th scope="col" class="py-3 px-4 font-semibold text-gray-900 border-b">Naam Product</th>
                                    <th scope="col" class="py-3 px-4 font-semibold text-gray-900 border-b">Datum laatste levering</th>
                                    <th scope="col" class="py-3 px-4 font-semibold text-gray-900 border-b">Aantal</th>
                                    <th scope="col" class="py-3 px-4 font-semibold text-gray-900 border-b">Eerstvolgende levering</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-white">
                                @forelse ($leveringen as $levering)
                                    <tr class="hover:bg-gray-50">
                                        <td class="py-3 px-4 font-medium text-gray-900 border-r border-gray-100">
                                            {{ $product->Naam }}
                                        </td>
                                        <td class="py-3 px-4 text-gray-700 border-r border-gray-100">
                                            {{ date('d-m-Y', strtotime($levering->DatumLevering)) }}
                                        </td>
                                        <td class="py-3 px-4 text-gray-700 border-r border-gray-100">
                                            {{ $levering->Aantal }}
                                        </td>
                                        <td class="py-3 px-4 text-gray-700">
                                            @if ($levering->DatumEerstVolgendeLevering)
                                                {{ date('d-m-Y', strtotime($levering->DatumEerstVolgendeLevering)) }}
                                            @else
                                                <span class="text-gray-400 italic">Onbekend</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="py-6 text-center text-gray-500">
                                            Geen leveringsgegevens bekend voor dit product.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                @else
                    {{-- Scenario 02: Geen voorraad aanwezig (bijv. Winegums) --}}
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-300 border border-gray-200 text-left text-sm mb-6">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th scope="col" class="py-3 px-4 font-semibold text-gray-900 border-b">
                                        Status voorraad van: {{ $product->Naam }}
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white">
                                <tr>
                                    <td class="py-8 px-6 text-center text-base font-semibold text-red-600 bg-red-50">
                                        {{ $geenVoorraadMelding }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="p-4 bg-yellow-50 border border-yellow-200 rounded-lg text-yellow-800 text-center text-sm">
                        U wordt over <span id="countdown" class="font-bold text-base">4</span> seconden automatisch doorverwezen naar de pagina Overzicht Magazijn Jamin...
                    </div>

                    <script>
                        let seconds = 4;
                        const countdownEl = document.getElementById('countdown');
                        const interval = setInterval(() => {
                            seconds--;
                            if (countdownEl) countdownEl.innerText = seconds;
                            if (seconds <= 0) {
                                clearInterval(interval);
                                window.location.href = "{{ route('magazijn.index') }}";
                            }
                        }, 1000);
                    </script>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>
