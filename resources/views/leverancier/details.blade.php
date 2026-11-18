<x-app-layout>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-sm sm:rounded-lg">

                <h1 class="text-2xl font-normal mb-6">
                    <u>Leverancier Details</u>
                </h1>

                {{-- Tabel volgens Wireframe-03 --}}
                <table class="max-w-xl w-full border-collapse border border-black text-left text-base mb-6">
                    <tbody>
                        <tr>
                            <td class="border border-black p-2 font-normal w-1/3">Naam</td>
                            <td class="border border-black p-2">{{ $leverancier->Naam }}</td>
                        </tr>
                        <tr>
                            <td class="border border-black p-2 font-normal">Contactpersoon</td>
                            <td class="border border-black p-2">{{ $leverancier->ContactPersoon }}</td>
                        </tr>
                        <tr>
                            <td class="border border-black p-2 font-normal">Leveranciernummer</td>
                            <td class="border border-black p-2">{{ $leverancier->LeverancierNummer }}</td>
                        </tr>
                        <tr>
                            <td class="border border-black p-2 font-normal">Mobiel</td>
                            <td class="border border-black p-2">{{ $leverancier->Mobiel }}</td>
                        </tr>
                        <tr>
                            <td class="border border-black p-2 font-normal">Straatnaam</td>
                            <td class="border border-black p-2">{{ $leverancier->Straatnaam ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td class="border border-black p-2 font-normal">Huisnummer</td>
                            <td class="border border-black p-2">{{ $leverancier->Huisnummer ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td class="border border-black p-2 font-normal">Postcode</td>
                            <td class="border border-black p-2">{{ $leverancier->Postcode ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td class="border border-black p-2 font-normal">Stad</td>
                            <td class="border border-black p-2">{{ $leverancier->Stad ?? '-' }}</td>
                        </tr>
                    </tbody>
                </table>

                {{-- Knoppenbalk onderaan: Wijzig links, terug en home rechts --}}
                <div class="mt-6 flex flex-row justify-between items-center max-w-xl">
                    <div>
                        <a href="{{ route('leverancier.edit', $leverancier->LeverancierId) }}" 
                           class="px-6 py-2 border border-black bg-white hover:bg-gray-100 text-black font-normal text-sm inline-block">
                            Wijzig
                        </a>
                    </div>
                    <div class="flex flex-row gap-3 items-center">
                        <a href="{{ route('leverancier.wijzigen') }}" 
                           class="px-6 py-2 border border-black bg-white hover:bg-gray-100 text-black font-normal text-sm inline-block">
                            terug
                        </a>
                        <a href="{{ route('dashboard') }}" 
                           class="px-6 py-2 border border-black bg-white hover:bg-gray-100 text-black font-normal text-sm inline-block">
                            home
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
