<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Ticket List') }}
            </h2>
            @notAdmin
                <a href="{{ route('tickets.create') }}" class="btn btn-primary float-end">Create Ticket</a>
            @endnotAdmin
        </div>
    </x-slot>

    <x-table>
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
                @forelse ($tickets as $ticket)
                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                        <td class="py-3 px-6">{{ $loop->iteration }}</td>
                        <td class="py-3 px-6">{{ $ticket->title }}</td>
                        <td class="py-3 px-6">{{ $ticket->appliedBy->name }}</td>
                        <td class="py-3 px-6">{{ $ticket->created_at->format('d-m-Y') }}</td>
                        <td class="py-3 px-6">
                            <span class="badge bg-info"><a href="responses/create/{{ $ticket->id }}">
                                    @notAdmin
                                        View
                                    @endnotAdmin Response
                                </a></span>
                            @if ($ticket->is_closed == 0)
                                @admin
                                    | <span class="badge bg-danger"><a href="close-ticket/{{ $ticket->id }}">Close
                                            Ticket</a></span>
                                @endadmin
                            @else
                                <span class="badge bg-danger">Ticket Closed</span>
                            @endif
                        </td>
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
    {{ $tickets->links() }}
</x-app-layout>
