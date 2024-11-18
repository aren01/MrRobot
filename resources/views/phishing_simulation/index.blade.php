<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Phishing Simulations') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="container mx-auto p-6">
                        <div class="flex justify-between items-center mb-6">
                            <h1 class="text-3xl font-bold">List of Simulations</h1>
                            <form action="{{ route('phishing.simulation.send') }}" method="POST">
                                @csrf
                                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Send Simulations</button>
                            </form>
                        </div>

                        @if (session('status'))
                        <div class="bg-green-500 dark:bg-green-700 text-white p-4 rounded-md mb-6">
                            {{ session('status') }}
                        </div>
                        @endif

                        <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden">
                            <table class="min-w-full">
                                <thead class="bg-gray-800 text-white dark:bg-gray-900">
                                    <tr>
                                        <th class="w-1/4 px-4 py-2 text-left">ID</th>
                                        <th class="w-1/4 px-4 py-2 text-left">Simulation Timestamp</th>
                                        <th class="w-1/4 px-4 py-2 text-left">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($simulations as $simulation)
                                    <tr class="border-b dark:border-gray-700">
                                        <td class="px-4 py-2 dark:text-gray-100">{{ $simulation->id }}</td>
                                        <td class="px-4 py-2 dark:text-gray-100">{{ $simulation->simulated_at }}</td>
                                        <td class="px-4 py-2 flex space-x-2">
                                            <a href="{{ route('phishing.simulation.show', $simulation->id) }}" class="bg-blue-500 text-white px-2 py-1 rounded-md hover:bg-blue-600">View</a>
                                            <form action="{{ route('phishing.simulation.destroy', $simulation->id) }}" method="POST" class="inline">
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