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
                    <form action="{{ route('token.store') }}" method="POST">
                        @csrf

                        <div class="flex flex-row">
                            <div class="grow">
                                <x-label for="name" :value="__('Add new token')" />
                
                                <div class="flex flex-row item-stretch mt-2">
                                    <x-input id="name" class="block w-full"
                                                type="text"
                                                required
                                                minlength="3"
                                                maxlength="32"
                                                value=""
                                                name="name" />

                                    <x-button class="ml-3">
                                        {{ __('ADD') }}
                                    </x-button>
                                </div>
                            </div>
                        </div>
                        @error('name')
                            <p class="msg-error mt-3 list-disc list-inside text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </form>

                    @forelse($tokens as $token)
                    <div class="flex flex-col gap-4 divide-y pt-2 pb-2 mt-6">
                        <div class="flex flex-col">
                            <p class="hover:text-blue-500 text-black">
                                {{ $token->name }}
                            </p>
                            <div class="flex flex-col gap-2 mt-2 mb-2 text-gray-600">
                                <p class="text-xs">
                                    Last used: {{$token->last_used_at ? $token->last_used_at->diffForHumans() : 'never'}}
                                </p>
                            </div>
                            <div class="flex flex-row gap-4 mt-2">
                                <form
                                    action="{{ route('token.destroy', $token->id) }}"
                                    method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-white text-xs bg-gradient-to-r from-red-500 via-red-600 to-red-700 hover:bg-gradient-to-br focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-md px-3 py-1 text-center">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    
                    @empty
                    <div class="mt-6 text text-center">
                        <p>You haven't created any tokens yet</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
