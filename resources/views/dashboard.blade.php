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
                    <p class="text-base text-gray-700 mb-4">Je bent ingelogd als: <span class="font-semibold">{{ $rol }}</span></p>

                    <div class="mt-4 pt-4 border-t border-gray-200">
                        <a href="{{ route('magazijn.index') }}" class="inline-flex items-center px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg shadow transition duration-150">
                            📦 Ga naar Overzicht Magazijn Jamin &rarr;
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
