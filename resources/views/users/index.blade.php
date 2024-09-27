<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Users List') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 flex justify-center">
                    <div class="overflow-x-auto">
                        <table class="min-w-full table-auto border-collapse text-center">
                            <thead>
                                <tr class="bg-gray-200 text-left text-sm leading-normal">
                                    <th class="py-3 px-6 font-medium text-gray-600">Sl. no</th>
                                    <th class="py-3 px-6 font-medium text-gray-600">Name</th>
                                    <th class="py-3 px-6 font-medium text-gray-600">Email</th>
                                    <th class="py-3 px-6 font-medium text-gray-600">Action</th>
                                </tr>
                            </thead>
                            <tbody class="text-sm text-gray-700">
                                @forelse ($users as $user)
                                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                                        <td class="py-3 px-6">{{ $loop->iteration }}</td>
                                        <td class="py-3 px-6">{{ $user->name }}</td>
                                        <td class="py-3 px-6">{{ $user->email }}</td>
                                        <td class="py-3 px-6">
                                            @if ($user->isAdmin == 1)
                                                <span class="badge bg-danger"><a href="update-admin/{{ $user->id }}/1">Remove Admin</a></span>
                                            @else
                                                <span class="badge bg-success"><a href="update-admin/{{ $user->id }}/0">Make Admin</a></span>
                                            @endif

                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="py-3 px-6 font-medium text-gray-600" colspan="4">No data found
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
