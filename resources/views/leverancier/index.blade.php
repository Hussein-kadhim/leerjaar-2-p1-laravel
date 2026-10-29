<x-app-layout>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-sm sm:rounded-lg">

                <h1 class="text-2xl font-normal mb-6">
                    <u>Overzicht leveranciers</u>
                </h1>

                <table class="w-full border-collapse border border-black text-left text-base">
                    <thead>
                        <tr>
                            <th class="border border-black p-2 font-normal">Naam</th>
                            <th class="border border-black p-2 font-normal">Contactpersoon</th>
                            <th class="border border-black p-2 font-normal">Leveranciernummer</th>
                            <th class="border border-black p-2 font-normal">Mobiel</th>
                            <th class="border border-black p-2 font-normal">Aantal verschillende producten</th>
                            <th class="border border-black p-2 text-center font-normal">Toon producten</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($leveranciers as $leverancier)
                            <tr>
                                <td class="border border-black p-2">{{ $leverancier->Naam }}</td>
                                <td class="border border-black p-2">{{ $leverancier->ContactPersoon }}</td>
                                <td class="border border-black p-2">{{ $leverancier->LeverancierNummer }}</td>
                                <td class="border border-black p-2">{{ $leverancier->Mobiel }}</td>
                                <td class="border border-black p-2 text-center">{{ $leverancier->AantalVerschillendeProducten }}</td>
                                <td class="border border-black p-2 text-center">
                                    <a href="{{ route('leverancier.producten', $leverancier->Id) }}" 
                                       title="Toon producten" 
                                       class="inline-block hover:opacity-75 transition-opacity">
                                        {{-- Box icoon (Wireframe-01) --}}
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline-block text-amber-700" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="border border-black p-4 text-center">
                                    Geen leveranciers gevonden.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="mt-6 flex justify-end" style="display: flex; justify-content: flex-end;">
                    <a href="{{ route('dashboard') }}" class="px-6 py-2 border border-black bg-white hover:bg-gray-100 text-black font-normal text-sm">
                        Home
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
