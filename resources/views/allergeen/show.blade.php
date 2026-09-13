<x-app-layout>
    @if (!$heeftAllergenen)
        {{-- Scenario 02: Na 4 seconden automatische redirect naar het overzicht --}}
        <x-slot name="head">
            <meta http-equiv="refresh" content="4; url={{ route('magazijn.index') }}">
        </x-slot>
    @endif

    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                {{ __('Overzicht Allergenen') }}
            </h2>
            <a href="{{ route('magazijn.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 text-sm font-medium rounded-md transition">
                &larr; Terug naar Overzicht
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                {{-- Productgegevens boven de tabel conform Wireframe 3 --}}
                <div class="mb-6 bg-gray-50 p-4 rounded-lg border border-gray-200">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3 text-base text-gray-800">
                        <div>
                            <span class="font-bold">Naam:</span> 
                            <span>{{ $product->Naam }}</span>
                        </div>
                        <div>
                            <span class="font-bold">Barcode:</span> 
                            <span class="font-mono">{{ $product->Barcode }}</span>
                        </div>
                    </div>
                </div>

                @if ($heeftAllergenen)
                    {{-- Scenario 01: Allergenen aanwezig, toon tabel gesorteerd op Naam ASC --}}
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-300 border border-gray-200 text-left text-sm">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th scope="col" class="py-3 px-4 font-semibold text-gray-900 border-b w-1/4">Naam</th>
                                    <th scope="col" class="py-3 px-4 font-semibold text-gray-900 border-b w-3/4">Omschrijving</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-white">
                                @forelse ($allergenen as $allergeen)
                                    <tr class="hover:bg-gray-50">
                                        <td class="py-3 px-4 font-semibold text-gray-900 border-r border-gray-100">
                                            {{ $allergeen->Naam }}
                                        </td>
                                        <td class="py-3 px-4 text-gray-700">
                                            {{ $allergeen->Omschrijving }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="2" class="py-6 text-center text-gray-500">
                                            Geen allergenen gevonden.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                @else
                    {{-- Scenario 02: Geen allergenen aanwezig (bijv. Cola Flesjes) --}}
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-300 border border-gray-200 text-left text-sm mb-6">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th scope="col" class="py-3 px-4 font-semibold text-gray-900 border-b">
                                        Allergenen status van: {{ $product->Naam }}
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white">
                                <tr>
                                    <td class="py-8 px-6 text-center text-base font-semibold text-green-700 bg-green-50">
                                        {{ $geenAllergenenMelding }}
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
