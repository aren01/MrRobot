<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('View Details for ') }} {{ $employee->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-2xl font-semibold mb-4">Details for {{ $employee->name }}</h3>
                    <table class="min-w-full">
                        <thead class="bg-gray-800 text-white dark:bg-gray-900">
                            <tr>
                                <th class="px-4 py-2 text-left">Field</th>
                                <th class="px-4 py-2 text-left">Value</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-b dark:border-gray-700">
                                <td class="px-4 py-2 dark:text-gray-100">Email</td>
                                <td class="px-4 py-2 dark:text-gray-100">{{ $submittedDetails['email'] }}</td>
                            </tr>
                            <tr class="border-b dark:border-gray-700">
                                <td class="px-4 py-2 dark:text-gray-100">Password</td>
                                <td class="px-4 py-2 dark:text-gray-100">{{ $submittedDetails['password'] }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>