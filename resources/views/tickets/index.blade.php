<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Ticket List') }}
            </h2>
            @if (auth()->user()->isAdmin == 0)
                <a href="{{ route('tickets.create') }}" class="btn btn-primary float-end">Create Ticket</a>
            @endif
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 flex justify-center">
                    <div class="overflow-x-auto">
                        @forelse ($tickets as $ticket)
                            <table class="min-w-full table-auto border-collapse text-center">
                                <thead>
                                    <tr class="bg-gray-200 text-left text-sm leading-normal">
                                        <th class="py-3 px-6 font-medium text-gray-600">Sl. no</th>
                                        <th class="py-3 px-6 font-medium text-gray-600">Title</th>
                                        <th class="py-3 px-6 font-medium text-gray-600">Ticket Creator</th>
                                        <th class="py-3 px-6 font-medium text-gray-600">Created At</th>
                                        <th class="py-3 px-6 font-medium text-gray-600">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="text-sm text-gray-700">
                                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                                        <td class="py-3 px-6">{{ $loop->iteration }}</td>
                                        <td class="py-3 px-6">{{ $ticket->title }}</td>
                                        <td class="py-3 px-6">{{ $ticket->appliedBy->name }}</td>
                                        <td class="py-3 px-6">{{ $ticket->created_at->format('d-m-Y') }}</td>
                                        <td class="py-3 px-6">
                                            <span class="badge bg-info"><a href="responses/create/{{ $ticket->id }}">@if (auth()->user()->isAdmin == 0) View @endif Response
                                                </a></span>
                                            @if ($ticket->is_closed == 0)
                                                @if (auth()->user()->isAdmin == 1)
                                                    | <span class="badge bg-danger"><a href="close-ticket/{{ $ticket->id }}">Close Ticket</a></span>
                                                @endif
                                            @else
                                                <span class="badge bg-danger">Ticket Closed</span>
                                            @endif
                                        </td>
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
    {{ $tickets->links() }}
</x-app-layout>
