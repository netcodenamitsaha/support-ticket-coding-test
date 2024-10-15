<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Response List') }}
            </h2>
        </div>
    </x-slot>

    <x-table>
        <table class="min-w-full table-auto border-collapse text-center">
            <thead>
                <tr class="bg-gray-200 text-left text-sm leading-normal">
                    <th class="py-3 px-6 font-medium text-gray-600">Sl. no</th>
                    <th class="py-3 px-6 font-medium text-gray-600">Ticket Title</th>
                    <th class="py-3 px-6 font-medium text-gray-600">Ticket Creator</th>
                    <th class="py-3 px-6 font-medium text-gray-600">Response</th>
                    <th class="py-3 px-6 font-medium text-gray-600">Admin Name</th>
                    <th class="py-3 px-6 font-medium text-gray-600">Created At</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($responses as $response)
                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                        <td class="py-3 px-6">{{ $loop->iteration }}</td>
                        <td class="py-3 px-6">{{ $response->ticket->title }}</td>
                        <td class="py-3 px-6">{{ $response->ticket->appliedBy->name }}</td>
                        <td class="py-3 px-6">{{ $response->response }}</td>
                        <td class="py-3 px-6">{{ $response->appliedBy->name }}</td>
                        <td class="py-3 px-6">{{ $response->created_at->format('d-m-Y') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="py-3 px-6 text-center text-gray-600 font-medium text-lg uppercase">
                            No data found
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </x-table>
    {{ $responses->links() }}
</x-app-layout>
