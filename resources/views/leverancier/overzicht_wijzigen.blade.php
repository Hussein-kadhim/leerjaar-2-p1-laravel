<x-app-layout>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-sm sm:rounded-lg">

                <h1 class="text-2xl font-normal mb-6">
                    <u>Overzicht Leveranciers</u>
                </h1>

                <table class="w-full border-collapse border border-black text-left text-base mb-6">
                    <thead>
                        <tr>
                            <th class="border border-black p-2 font-normal">Naam</th>
                            <th class="border border-black p-2 font-normal">Contactpersoon</th>
                            <th class="border border-black p-2 font-normal">Leveranciernummer</th>
                            <th class="border border-black p-2 font-normal">Mobiel</th>
                            <th class="border border-black p-2 text-center font-normal">Leverancier Details</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($leveranciers as $leverancier)
                            <tr>
                                <td class="border border-black p-2">{{ $leverancier->Naam }}</td>
                                <td class="border border-black p-2">{{ $leverancier->ContactPersoon }}</td>
                                <td class="border border-black p-2">{{ $leverancier->LeverancierNummer }}</td>
                                <td class="border border-black p-2">{{ $leverancier->Mobiel }}</td>
                                <td class="border border-black p-2 text-center">
                                    {{-- Pen-icoon volgens Wireframe-02 --}}
                                    <a href="{{ route('leverancier.details', $leverancier->Id) }}" 
                                       title="Leverancier Details" 
                                       class="inline-block hover:opacity-75 transition-opacity">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline-block text-amber-800" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="border border-black p-4 text-center">
                                    Geen leveranciers gevonden.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                {{-- Server-side Pagination (max 4 per pagina) --}}
                <div class="mt-4 mb-6">
                    {{ $leveranciers->links() }}
                </div>

                {{-- Home knop rechtsonder --}}
                <div class="mt-6 flex justify-end">
                    <a href="{{ route('dashboard') }}" class="px-6 py-2 border border-black bg-white hover:bg-gray-100 text-black font-normal text-sm">
                        home
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
