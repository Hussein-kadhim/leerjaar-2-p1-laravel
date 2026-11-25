<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="text-2xl font-normal mb-4"><u>Homepagina</u></h1>
                    <p class="text-base text-gray-700 mb-6">Je bent ingelogd als: <span class="font-semibold">{{ $rol }}</span></p>

                    <div class="flex flex-wrap gap-4 items-center">
                        <a href="{{ route('magazijn.index') }}" class="inline-block font-medium py-2 px-4 rounded shadow text-white" style="background-color: #2563eb; color: #ffffff;">
                            Overzicht Magazijn Jamin
                        </a>
                        <a href="{{ route('leverancier.index') }}" class="inline-block font-medium py-2 px-4 rounded shadow text-white" style="background-color: #f97316; color: #ffffff;">
                            Overzicht Leveranciers
                        </a>
                        <a href="{{ route('leverancier.wijzigen') }}" class="inline-block font-medium py-2 px-4 rounded shadow text-white" style="background-color: #7c3aed; color: #ffffff;">
                            Wijzigen Leveranciers
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
