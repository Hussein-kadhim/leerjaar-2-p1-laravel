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
                        <a href="{{ route('magazijn.index') }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded shadow">
                            Overzicht Magazijn Jamin
                        </a>
                        <a href="{{ route('leverancier.index') }}" class="inline-block text-white font-medium py-2 px-4 rounded shadow" style="background-color: #f97316;">
                            Overzicht Leveranciers
                        </a>
                        <a href="{{ route('leverancier.wijzigen') }}" class="inline-block bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded shadow">
                            Wijzigen Leveranciers
                        </a>
                    </div>

                    <div class="mt-6 pt-4 border-t border-gray-200">
                        <a href="{{ route('leverancier.wijzigen') }}" class="text-blue-600 hover:text-blue-800 text-lg font-medium">
                            <u>Wijzigen Leveranciers</u>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
