<x-app-layout>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-sm sm:rounded-lg">

                <h1 class="text-2xl font-normal mb-6">
                    <u>Wijzig Leveranciergegevens</u>
                </h1>

                {{-- Scenario 01: Succesmelding --}}
                @if (session('success_melding'))
                    <div class="mb-6 p-4 border border-green-500 bg-green-50 text-green-700 text-lg rounded">
                        {{ session('success_melding') }}
                    </div>

                    {{-- Na 3 seconden doorsturen naar Leverancier Details --}}
                    <script>
                        setTimeout(function() {
                            window.location.href = "{{ route('leverancier.details', $leverancier->LeverancierId) }}";
                        }, 3000);
                    </script>
                @endif

                {{-- Scenario 02: Foutmelding bij technische storing --}}
                @if (session('error_melding'))
                    <div class="mb-6 p-4 border border-red-500 bg-red-50 text-red-700 text-lg rounded">
                        {{ session('error_melding') }}
                    </div>

                    {{-- Na 3 seconden doorsturen naar Leverancier Details --}}
                    <script>
                        setTimeout(function() {
                            window.location.href = "{{ route('leverancier.details', $leverancier->LeverancierId) }}";
                        }, 3000);
                    </script>
                @endif

                {{-- Formulier volgens Wireframe-04 (Label links, input rechts) --}}
                <form action="{{ route('leverancier.update', $leverancier->LeverancierId) }}" method="POST" class="max-w-xl">
                    @csrf

                    <table class="w-full border-separate border-spacing-y-3 mb-6">
                        <tbody>
                            <tr>
                                <td class="w-48 align-middle text-base font-normal pr-4">
                                    <label for="Naam">Naam:</label>
                                </td>
                                <td>
                                    <input type="text" 
                                           name="Naam" 
                                           id="Naam" 
                                           value="{{ old('Naam', $leverancier->Naam) }}" 
                                           required 
                                           class="w-full border border-black p-2 text-base rounded-none focus:outline-none focus:ring-1 focus:ring-black">
                                    @error('Naam')
                                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </td>
                            </tr>

                            <tr>
                                <td class="w-48 align-middle text-base font-normal pr-4">
                                    <label for="ContactPersoon">Contactpersoon:</label>
                                </td>
                                <td>
                                    <input type="text" 
                                           name="ContactPersoon" 
                                           id="ContactPersoon" 
                                           value="{{ old('ContactPersoon', $leverancier->ContactPersoon) }}" 
                                           required 
                                           class="w-full border border-black p-2 text-base rounded-none focus:outline-none focus:ring-1 focus:ring-black">
                                    @error('ContactPersoon')
                                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </td>
                            </tr>

                            <tr>
                                <td class="w-48 align-middle text-base font-normal pr-4">
                                    <label for="LeverancierNummer">Leveranciernummer:</label>
                                </td>
                                <td>
                                    <input type="text" 
                                           name="LeverancierNummer" 
                                           id="LeverancierNummer" 
                                           value="{{ old('LeverancierNummer', $leverancier->LeverancierNummer) }}" 
                                           required 
                                           class="w-full border border-black p-2 text-base rounded-none focus:outline-none focus:ring-1 focus:ring-black">
                                    @error('LeverancierNummer')
                                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </td>
                            </tr>

                            <tr>
                                <td class="w-48 align-middle text-base font-normal pr-4">
                                    <label for="Mobiel">Mobiel:</label>
                                </td>
                                <td>
                                    <input type="text" 
                                           name="Mobiel" 
                                           id="Mobiel" 
                                           value="{{ old('Mobiel', $leverancier->Mobiel) }}" 
                                           required 
                                           class="w-full border border-black p-2 text-base rounded-none focus:outline-none focus:ring-1 focus:ring-black">
                                    @error('Mobiel')
                                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </td>
                            </tr>

                            <tr>
                                <td class="w-48 align-middle text-base font-normal pr-4">
                                    <label for="Straatnaam">Straatnaam:</label>
                                </td>
                                <td>
                                    <input type="text" 
                                           name="Straatnaam" 
                                           id="Straatnaam" 
                                           value="{{ old('Straatnaam', $leverancier->Straatnaam) }}" 
                                           required 
                                           class="w-full border border-black p-2 text-base rounded-none focus:outline-none focus:ring-1 focus:ring-black">
                                    @error('Straatnaam')
                                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </td>
                            </tr>

                            <tr>
                                <td class="w-48 align-middle text-base font-normal pr-4">
                                    <label for="Huisnummer">Huisnummer:</label>
                                </td>
                                <td>
                                    <input type="text" 
                                           name="Huisnummer" 
                                           id="Huisnummer" 
                                           value="{{ old('Huisnummer', $leverancier->Huisnummer) }}" 
                                           required 
                                           class="w-full border border-black p-2 text-base rounded-none focus:outline-none focus:ring-1 focus:ring-black">
                                    @error('Huisnummer')
                                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </td>
                            </tr>

                            <tr>
                                <td class="w-48 align-middle text-base font-normal pr-4">
                                    <label for="Postcode">Postcode:</label>
                                </td>
                                <td>
                                    <input type="text" 
                                           name="Postcode" 
                                           id="Postcode" 
                                           value="{{ old('Postcode', $leverancier->Postcode) }}" 
                                           required 
                                           class="w-full border border-black p-2 text-base rounded-none focus:outline-none focus:ring-1 focus:ring-black">
                                    @error('Postcode')
                                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </td>
                            </tr>

                            <tr>
                                <td class="w-48 align-middle text-base font-normal pr-4">
                                    <label for="Stad">Stad:</label>
                                </td>
                                <td>
                                    <input type="text" 
                                           name="Stad" 
                                           id="Stad" 
                                           value="{{ old('Stad', $leverancier->Stad) }}" 
                                           required 
                                           class="w-full border border-black p-2 text-base rounded-none focus:outline-none focus:ring-1 focus:ring-black">
                                    @error('Stad')
                                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    {{-- Knoppenbalk: Sla Op links, terug en home rechts --}}
                    <div class="mt-6 flex flex-row justify-between items-center">
                        <div>
                            <button type="submit" 
                                    class="px-6 py-2 border border-black bg-white hover:bg-gray-100 text-black font-normal text-sm">
                                Sla Op
                            </button>
                        </div>
                        <div class="flex flex-row gap-3 items-center">
                            <a href="{{ route('leverancier.details', $leverancier->LeverancierId) }}" 
                               class="px-6 py-2 border border-black bg-white hover:bg-gray-100 text-black font-normal text-sm inline-block">
                                terug
                            </a>
                            <a href="{{ route('dashboard') }}" 
                               class="px-6 py-2 border border-black bg-white hover:bg-gray-100 text-black font-normal text-sm inline-block">
                                home
                            </a>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
