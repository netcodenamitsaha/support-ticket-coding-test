<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Response List') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 flex justify-center">
                    <div class="overflow-x-auto">
                        @forelse ($responses as $response)
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
                                    <tr class="border-b border-gray-200 hover:bg-gray-100"></tr>
                                        <td class="py-3 px-6">{{ $loop->iteration }}</td>
                                        <td class="py-3 px-6">{{ $response->ticket->title }}</td>
                                        <td class="py-3 px-6">{{ $response->ticket->appliedBy->name }}</td>
                                        <td class="py-3 px-6">{{ $response->response }}</td>
                                        <td class="py-3 px-6">{{ $response->appliedBy->name }}</td>
                                        <td class="py-3 px-6">{{ $response->created_at->format('d-m-Y') }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        @empty
                            <div class="alert alert-warning mb-0 px-xl-5" role="alert">
                                No data found
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{ $responses->links() }}
</x-app-layout>
