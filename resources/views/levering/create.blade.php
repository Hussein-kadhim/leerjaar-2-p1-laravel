<x-app-layout>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-sm sm:rounded-lg">

                <h1 class="text-2xl font-normal mb-6">
                    <u>Levering Product</u>
                </h1>

                {{-- Melding indien product niet meer actief is (Scenario 02) --}}
                @if (session('inactief_melding'))
                    <div class="mb-6 p-4 border border-red-500 bg-red-50 text-red-700 text-lg rounded">
                        {{ session('inactief_melding') }}
                    </div>

                    {{-- Na 4 seconden automatisch doorsturen naar scherm Geleverde producten --}}
                    <script>
                        setTimeout(function() {
                            window.location.href = "{{ route('leverancier.producten', $leverancierId) }}";
                        }, 4000);
                    </script>
                @endif

                {{-- Product- en Leveranciersgegevens (Wireframe-04) --}}
                <div class="mb-6 text-base space-y-1">
                    <p><span style="display: inline-block; min-width: 170px;">Product:</span> {{ $leveringInfo->ProductNaam }}</p>
                    <p><span style="display: inline-block; min-width: 170px;">Leverancier:</span> {{ $leveringInfo->LeverancierNaam }}</p>
                    <p><span style="display: inline-block; min-width: 170px;">Contactpersoon:</span> {{ $leveringInfo->ContactPersoon }}</p>
                    <p><span style="display: inline-block; min-width: 170px;">Mobiel:</span> {{ $leveringInfo->Mobiel }}</p>
                </div>

                {{-- Formulier Nieuwe Levering --}}
                <form action="{{ route('levering.store', ['leverancierId' => $leverancierId, 'productId' => $productId]) }}" method="POST" style="width: 100%;">
                    @csrf

                    <div style="margin-bottom: 16px;">
                        <label for="aantal" style="display: block; margin-bottom: 4px; font-size: 1rem;">
                            Aantal producteenheden
                        </label>
                        <input type="number" 
                               name="aantal" 
                               id="aantal" 
                               min="1" 
                               required 
                               placeholder="Bijv. 25"
                               style="width: 260px; max-width: 100%; display: block; border: 1px solid black; padding: 8px; font-size: 1rem;">
                        @error('aantal')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div style="margin-bottom: 16px;">
                        <label for="datum_eerstvolgende_levering" style="display: block; margin-bottom: 4px; font-size: 1rem;">
                            Datum eerstvolgende levering
                        </label>
                        <input type="date" 
                               name="datum_eerstvolgende_levering" 
                               id="datum_eerstvolgende_levering" 
                               style="width: 260px; max-width: 100%; display: block; border: 1px solid black; padding: 8px; font-size: 1rem;">
                        @error('datum_eerstvolgende_levering')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Knoppenbalk op dezelfde regel: Sla op links, Terug en Home rechts --}}
                    <div style="display: flex; flex-direction: row; justify-content: space-between; align-items: center; width: 100%; margin-top: 32px;">
                        <div>
                            <button type="submit" class="px-6 py-2 border border-black bg-white hover:bg-gray-100 text-black font-normal text-sm" style="display: inline-block;">
                                Sla op
                            </button>
                        </div>

                        <div style="display: flex; flex-direction: row; gap: 12px; align-items: center;">
                            <a href="{{ route('leverancier.producten', $leverancierId) }}" class="px-6 py-2 border border-black bg-white hover:bg-gray-100 text-black font-normal text-sm" style="display: inline-block; white-space: nowrap;">
                                Terug
                            </a>
                            <a href="{{ route('dashboard') }}" class="px-6 py-2 border border-black bg-white hover:bg-gray-100 text-black font-normal text-sm" style="display: inline-block; white-space: nowrap;">
                                Home
                            </a>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
