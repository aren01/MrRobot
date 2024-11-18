<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Employees') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="container mx-auto p-6">
                        <div class="flex justify-between items-center mb-6">
                            <h1 class="text-3xl font-bold">List of Employees</h1>
                            <a href="{{ route('employees.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Add New Employee</a>
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
                                        <th class="w-1/3 px-4 py-2 text-left">Name</th>
                                        <th class="w-1/3 px-4 py-2 text-left">Email</th>
                                        <th class="w-1/3 px-4 py-2 text-left">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($employees as $employee)
                                    <tr class="border-b dark:border-gray-700">
                                        <td class="px-4 py-2 dark:text-gray-100">{{ $employee->name }}</td>
                                        <td class="px-4 py-2 dark:text-gray-100">{{ $employee->email }}</td>
                                        <td class="px-4 py-2">
                                            <a href="{{ route('employees.edit', $employee->id) }}" class="bg-yellow-500 dark:bg-yellow-600 text-white px-2 py-1 rounded-md hover:bg-yellow-600 dark:hover:bg-yellow-500">Edit</a>
                                            <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="bg-red-500 dark:bg-red-600 text-white px-2 py-1 rounded-md hover:bg-red-600 dark:hover:bg-red-500">Delete</button>
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