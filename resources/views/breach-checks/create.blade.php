<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Add New Breach Check') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('breach-checks.check') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="employees" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Select Employees</label>
                            <select id="employees" name="employee_ids[]" multiple class="mt-1 block w-full dark:bg-gray-700 dark:text-gray-200">
                                @foreach ($employees as $employee)
                                <option value="{{ $employee->id }}">{{ $employee->name }} - {{ $employee->email }}</option>
                                @endforeach
                            </select>
                            @error('employee_ids')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="flex justify-end">
                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Check Breach</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>