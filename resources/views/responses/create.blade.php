<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Ticket Response') }}
            </h2>
            <a href="{{ route('tickets.index') }}" class="btn btn-success float-end">Ticket List</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 flex justify-center">
                    <div class="overflow-x-auto">

                        <form action="{{ route('responses.store') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label for="ticket_title" class="form-label">Ticket Title</label>
                                <input type="text" class="form-control" name="ticket_title" id="ticket_title"
                                    value="{{ $ticket->title }}" readonly>
                                <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">
                            </div>
                            <div class="mb-3">
                                <label for="ticket_description" class="form-label">Ticket Description</label>
                                <textarea class="form-control" name="ticket_description" id="ticket_description" rows="3" readonly>{{ $ticket->description }}</textarea>
                            </div>
                            @if ($response)
                                <label for="response" class="form-label">Admin's Response</label>
                                <textarea class="form-control" rows="3" readonly>{{ $response }}</textarea>
                            @endif
                            @can('is-admin')
                                @if ($ticket->is_closed == 0 && $ticket->is_responsed == 0)
                                    <div class="mb-3">
                                        <label for="response" class="form-label">Admin's Response</label>
                                        <textarea class="form-control" name="response" id="response" rows="3"></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </div>
                                @endif
                            @endcan
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
