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
                    <h3 class="text-2xl font-semibold mb-4">{{ __("Statistics") }}</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="bg-gray-100 dark:bg-gray-700 p-6 rounded-lg shadow-lg">
                            <h4 class="text-xl font-medium">{{ __('Simulations Sent') }}</h4>
                            <p class="text-3xl font-bold">{{ $simulationCount }}</p>
                        </div>
                        <div class="bg-gray-100 dark:bg-gray-700 p-6 rounded-lg shadow-lg">
                            <h4 class="text-xl font-medium">{{ __('Employees Added') }}</h4>
                            <p class="text-3xl font-bold">{{ $employeeCount }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>