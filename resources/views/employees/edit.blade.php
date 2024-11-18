<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Employee') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1 class="text-3xl font-bold mb-6">Edit Employee</h1>

                    @if ($errors->any())
                    <div class="bg-red-500 dark:bg-red-700 text-white p-4 rounded-md mb-6">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <form action="{{ route('employees.update', $employee->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="name" class="block text-gray-700 dark:text-gray-300">Name:</label>
                            <input type="text" name="name" id="name" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-300 dark:bg-gray-900 dark:text-gray-100" value="{{ $employee->name }}">
                        </div>

                        <div class="mb-4">
                            <label for="email" class="block text-gray-700 dark:text-gray-300">Email:</label>
                            <input type="email" name="email" id="email" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-300 dark:bg-gray-900 dark:text-gray-100" value="{{ $employee->email }}">
                        </div>

                        <div class="flex justify-end">
                            <button type="submit" class="bg-blue-500 dark:bg-blue-700 text-white px-4 py-2 rounded-md hover:bg-blue-600 dark:hover:bg-blue-500">Update Employee</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>