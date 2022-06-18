<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="py-3 px-4">
                        <div class="flex gap-4 mb-4">
                            <p class="font-bold"> {{ $tokenName }}</p>
                            <p> {{ $token }}</p>
                        </div>
                        <div class="bg-blue-500 rounded p-2 text-white">
                            <p>Make sure to copy your token now. You won't be able to see it again!</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
