<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Breach Checks') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="container mx-auto p-6">
                        <div class="flex justify-between items-center mb-6">
                            <h1 class="text-3xl font-bold">List of Breach Checks</h1>
                            <a href="{{ route('breach-checks.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Add Breach Check</a>
                        </div>

                        @if (session('success'))
                        <div class="bg-green-500 dark:bg-green-700 text-white p-4 rounded-md mb-6">
                            {{ session('success') }}
                        </div>
                        @endif

                        @if (session('error'))
                        <div class="bg-red-500 dark:bg-red-700 text-white p-4 rounded-md mb-6">
                            {{ session('error') }}
                        </div>
                        @endif

                        <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden">
                            <table class="min-w-full">
                                <thead class="bg-gray-800 text-white dark:bg-gray-900">
                                    <tr>
                                        <th class="w-1/4 px-4 py-2 text-left">ID</th>
                                        <th class="w-1/4 px-4 py-2 text-left">Checked At</th>
                                        <th class="w-1/4 px-4 py-2 text-left">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($breachChecks as $breachCheck)
                                    <tr class="border-b dark:border-gray-700">
                                        <td class="px-4 py-2 dark:text-gray-100">{{ $breachCheck->id }}</td>
                                        <td class="px-4 py-2 dark:text-gray-100">{{ $breachCheck->created_at }}</td>
                                        <td class="px-4 py-2">
                                            <a href="{{ route('breach-checks.show', $breachCheck->id) }}" class="bg-blue-500 text-white px-2 py-1 rounded-md hover:bg-blue-600">View</a>
                                            <form action="{{ route('breach-checks.destroy', $breachCheck->id) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded-md hover:bg-red-600">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>