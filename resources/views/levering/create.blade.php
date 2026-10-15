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
                    <div class="grid grid-cols-[160px_1fr] max-w-md">
                        <span>Product</span>
                        <span>: {{ $leveringInfo->ProductNaam }}</span>
                    </div>
                    <div class="grid grid-cols-[160px_1fr] max-w-md">
                        <span>Leverancier</span>
                        <span>: {{ $leveringInfo->LeverancierNaam }}</span>
                    </div>
                    <div class="grid grid-cols-[160px_1fr] max-w-md">
                        <span>Contactpersoon</span>
                        <span>: {{ $leveringInfo->ContactPersoon }}</span>
                    </div>
                    <div class="grid grid-cols-[160px_1fr] max-w-md">
                        <span>Mobiel</span>
                        <span>: {{ $leveringInfo->Mobiel }}</span>
                    </div>
                </div>

                {{-- Formulier Nieuwe Levering --}}
                <form action="{{ route('levering.store', ['leverancierId' => $leverancierId, 'productId' => $productId]) }}" method="POST" class="max-w-md space-y-4">
                    @csrf

                    <div>
                        <label for="aantal" class="block text-base mb-1">
                            Aantal producteenheden
                        </label>
                        <input type="number" 
                               name="aantal" 
                               id="aantal" 
                               min="1" 
                               required 
                               placeholder="Bijv. 25"
                               class="w-full border border-black p-2 text-base rounded-none focus:outline-none focus:ring-1 focus:ring-black">
                        @error('aantal')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="datum_eerstvolgende_levering" class="block text-base mb-1">
                            Datum eerstvolgende levering
                        </label>
                        <input type="date" 
                               name="datum_eerstvolgende_levering" 
                               id="datum_eerstvolgende_levering" 
                               class="w-full border border-black p-2 text-base rounded-none focus:outline-none focus:ring-1 focus:ring-black">
                        @error('datum_eerstvolgende_levering')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="pt-4 flex items-center justify-between">
                        <button type="submit" class="px-6 py-2 border border-black bg-white hover:bg-gray-100 text-black font-normal text-sm">
                            Sla op
                        </button>

                        <div class="flex space-x-3">
                            <a href="{{ route('leverancier.producten', $leverancierId) }}" class="px-6 py-2 border border-black bg-white hover:bg-gray-100 text-black font-normal text-sm">
                                Terug
                            </a>
                            <a href="{{ route('dashboard') }}" class="px-6 py-2 border border-black bg-white hover:bg-gray-100 text-black font-normal text-sm">
                                Home
                            </a>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
