<x-app-layout>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-sm sm:rounded-lg">

                <h1 class="text-2xl font-normal mb-6">
                    <u>Geleverde producten</u>
                </h1>

                {{-- Leveranciersgegevens bovenaan volgens Wireframe-02 & Wireframe-03 --}}
                <div class="mb-6 text-base space-y-1">
                    <div class="grid grid-cols-[160px_1fr] max-w-md">
                        <span>Naam leverancier</span>
                        <span>: {{ $leverancier->Naam }}</span>
                    </div>
                    <div class="grid grid-cols-[160px_1fr] max-w-md">
                        <span>Contactpersoon</span>
                        <span>: {{ $leverancier->ContactPersoon }}</span>
                    </div>
                    <div class="grid grid-cols-[160px_1fr] max-w-md">
                        <span>Leverancier nr</span>
                        <span>: {{ $leverancier->LeverancierNummer }}</span>
                    </div>
                    <div class="grid grid-cols-[160px_1fr] max-w-md">
                        <span>Mobiel</span>
                        <span>: {{ $leverancier->Mobiel }}</span>
                    </div>
                </div>

                {{-- Tabel met geleverde producten --}}
                <table class="w-full border-collapse border border-black text-left text-base">
                    <thead>
                        <tr>
                            <th class="border border-black p-2 font-normal">Naam product</th>
                            <th class="border border-black p-2 font-normal">Aantal in Magazijn</th>
                            <th class="border border-black p-2 font-normal">Verpakkingseenheid</th>
                            <th class="border border-black p-2 font-normal">Laatste levering</th>
                            <th class="border border-black p-2 text-center font-normal">Nieuwe levering</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($heeftProducten)
                            @foreach ($producten as $product)
                                <tr>
                                    <td class="border border-black p-2">{{ $product->ProductNaam }}</td>
                                    <td class="border border-black p-2">
                                        {{ ($product->AantalAanwezig !== null) ? $product->AantalAanwezig : 'Niet op voorraad' }}
                                    </td>
                                    <td class="border border-black p-2">
                                        {{ str_replace('.', ',', (string)$product->VerpakkingsEenheid) }} kg
                                    </td>
                                    <td class="border border-black p-2">
                                        {{ $product->LaatsteLevering ? \Carbon\Carbon::parse($product->LaatsteLevering)->format('d-m-Y') : '-' }}
                                    </td>
                                    <td class="border border-black p-2 text-center">
                                        {{-- Link naar Levering toevoegen (User Story 2) --}}
                                        <a href="{{ route('levering.create', ['leverancierId' => $leverancier->Id, 'productId' => $product->ProductId]) }}" 
                                           title="Nieuwe levering toevoegen" 
                                           class="inline-block text-2xl font-bold text-green-700 hover:text-green-800 transition-colors">
                                            +
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            {{-- Wireframe-03: Melding indien geen producten geleverd --}}
                            <tr>
                                <td colspan="5" class="border border-black p-6 text-center text-lg">
                                    {{ $melding }}
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>

                {{-- Automatische redirect na 3 seconden bij Scenario 02 --}}
                @if (!$heeftProducten)
                    <script>
                        setTimeout(function() {
                            window.location.href = "{{ route('leverancier.index') }}";
                        }, 3000);
                    </script>
                @endif

                <div class="mt-6 flex justify-end space-x-3">
                    <a href="{{ route('leverancier.index') }}" class="px-6 py-2 border border-black bg-white hover:bg-gray-100 text-black font-normal text-sm">
                        Terug
                    </a>
                    <a href="{{ route('dashboard') }}" class="px-6 py-2 border border-black bg-white hover:bg-gray-100 text-black font-normal text-sm">
                        Home
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
