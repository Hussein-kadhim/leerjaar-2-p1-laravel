<x-app-layout>
    @if (!$heeftAllergenen)
        <x-slot name="head">
            <meta http-equiv="refresh" content="4; url={{ route('magazijn.index') }}">
        </x-slot>
    @endif

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Overzicht Allergenen
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded shadow">

                <h3 class="text-lg font-bold mb-4">Overzicht Allergenen</h3>

                {{-- Product info boven de tabel --}}
                <div class="mb-4 space-y-1 text-sm">
                    <p><strong>Naam:</strong> {{ $product->Naam }}</p>
                    <p><strong>Barcode:</strong> {{ $product->Barcode }}</p>
                </div>

                @if ($heeftAllergenen)
                    {{-- Tabel met allergenen --}}
                    <table class="w-full border-collapse border border-gray-300 text-left">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="border border-gray-300 p-2 w-1/4">Naam</th>
                                <th class="border border-gray-300 p-2 w-3/4">Omschrijving</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($allergenen as $allergeen)
                                <tr class="hover:bg-gray-50">
                                    <td class="border border-gray-300 p-2 font-medium">{{ $allergeen->Naam }}</td>
                                    <td class="border border-gray-300 p-2">{{ $allergeen->Omschrijving }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                @else
                    {{-- Geen allergenen melding --}}
                    <table class="w-full border-collapse border border-gray-300 text-center mb-4">
                        <tbody>
                            <tr>
                                <td class="border border-gray-300 p-6 text-green-700 font-semibold">
                                    {{ $geenAllergenenMelding }}
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
