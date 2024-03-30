<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('User Management') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{--Table data--}}
                    <div class="overflow-auto">
                        <table class="min-w-full divide-y divide-gray-200 space-x-4">
                            <thead>
                            <tr>
                                <th scope="col" class="px-6 py-3 tracking-wider">User ID</th>
                                <th scope="col" class="px-6 py-3 tracking-wider">Name</th>
                                <th scope="col" class="px-6 py-3 tracking-wider">Email</th>
                                <th scope="col" class="px-6 py-3 tracking-wider">Phone Number</th>
                                <th scope="col" class="px-6 py-3 tracking-wider">Role</th>
                                <th scope="col" class="px-6 py-3 tracking-wider">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td class="text-center">{{ $user->id ?? 'null' }}</td>
                                    <td>{{ $user->nama_user ?? 'null' }}</td>
                                    <td>{{ $user->email ?? 'null' }}</td>
                                    <td class="text-center">{{ $user->no_telp ?? 'null' }}</td>
                                    <td class="text-center">{{ $user->role ?? 'null' }}</td>
                                    <td class="text-center">
                                        <a href="#" class="text-indigo-600 hover:text-indigo-900">Edit</a>
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
</x-app-layout>
<script>
</script>
