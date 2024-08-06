<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 gap-6 p-6">
                    <div class="bg-white dark:bg-gray-700 overflow-hidden shadow-sm rounded-lg">
                        <div class="p-4">
                            <a href="{{ route('map') }}">
                            <h3 class="text-lg font-semibold mb-2 text-white">Find Ride</h3>
                            <p class="text-gray-600 dark:text-gray-300">Search for available rides in your area</p>
                            </a>
                        </div>
                    </div>
                    <div class="bg-white dark:bg-gray-700 overflow-hidden shadow-sm rounded-lg">
                        <div class="p-4">
                            <h3 class="text-lg font-semibold mb-2 text-white">Be Driver</h3>
                            <p class="text-gray-600 dark:text-gray-300">Connect with Passanger near you</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
