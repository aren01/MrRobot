<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Breach Check Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-semibold">Checked At: {{ $breachCheck->created_at }}</h3>

                    <table class="min-w-full mt-4">
                        <thead class="bg-gray-800 text-white dark:bg-gray-900">
                            <tr>
                                <th class="px-4 py-2 text-left">Employee Email</th>
                                <th class="px-4 py-2 text-left">Breached Websites</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($breachDetails as $detail)
                            <tr class="border-b dark:border-gray-700">
                                <td class="px-4 py-2 dark:text-gray-100">{{ $detail['email'] }}</td>
                                <td class="px-4 py-2 dark:text-gray-100">
                                    @if (!empty($detail['details']) && is_array($detail['details']))
                                    @foreach ($detail['details'] as $site => $breaches)
                                    <p>{{ $site }}
                                        @if (!empty($breaches))
                                        {{ implode(', ', $breaches) }}
                                        @else

                                        @endif
                                    </p>
                                    @endforeach
                                    @else

                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="2" class="px-4 py-2 dark:text-gray-100 text-center">No breach details available</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>