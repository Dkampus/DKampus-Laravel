<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Account Management') }}
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
                                <th scope="col" class="px-6 py-3 tracking-wider">Restriction</th>
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
                                    <td class="text-center">{{ ucfirst($user->role) ?? 'null' }}</td>
                                    <td class="text-center">{{ $user->restriction ? 'True' : 'False' ?? 'null' }}</td>
                                    <td class="text-center">
                                        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                                                onclick="editUser(this)"
                                                data-id="{{ $user->id }}"
                                                data-nama_user="{{ $user->nama_user }}"
                                                data-email="{{ $user->email }}"
                                                data-no_telp="{{ $user->no_telp }}"
                                                data-role="{{ $user->role }}"
                                                data-restriction="{{ $user->restriction }}">
                                            Edit
                                        </button>
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
    {{-- modal edit --}}
    <div class="fixed z-10 inset-0 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true" id="modal-edit">
        <div class="flex items end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                <div class="bg-white dark:bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg font-medium leading-6 text-gray-900 dark:text-gray-200" id="modal-headline">
                                Edit User
                            </h3>
                        </div>
                    </div>
                    <form action="#" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-4 mt-4">
                            <label for="nama_user" class="block text-gray-700 dark:text-gray-200 text-sm font-bold mb-2">Name</label>
                            <input type="text" name="nama_user" id="nama_user" class="block w-full" value="{{ $user->nama_user }}">
                        </div>
                        <div class="mb-4">
                            <label for="email" class="block text-gray-700 dark:text-gray-200 text-sm font-bold mb-2">Email</label>
                            <input type="email" name="email" id="email" class="block w-full" value="{{ $user->email }}">
                        </div>
                        <div class="mb-4">
                            <label for="no_telp" class="block text-gray-700 dark:text-gray-200 text-sm font-bold mb-2">No. Telp</label>
                            <input type="text" name="no_telp" id="no_telp" class="block w-full" value="{{ $user->no_telp }}">
                        </div>
                        <div class="mb-4">
                            <label for="role" class="block text-gray-700 dark:text-gray-200 text-sm font-bold mb-2">Role</label>
                            <select name="role" id="role" class="block w-full">
                                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="customer" {{ $user->role == 'customer' ? 'selected' : '' }}>Customer</option>
                                <option value="courier" {{ $user->role == 'courier' ? 'selected' : '' }}>Courier</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="restriction" class="block text-gray-700 dark:text-gray-200 text-sm font-bold mb-2">Restriction</label>
                            <select name="restriction" id="restriction" class="block w-full">
                                <option value="1" {{ $user->restriction == 1 ? 'selected' : '' }}>True</option>
                                <option value="0" {{ $user->restriction == 0 ? 'selected' : '' }}>False</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Simpan
                            </button>
                            <button type="button" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" onclick="closeModal('modal-edit')">
                                Batal
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<script>

    function editUser(button) {
        // Get data from data-* attributes
        var id = button.getAttribute('data-id');
        var name = button.getAttribute('data-nama_user');
        var email = button.getAttribute('data-email');
        var phone = button.getAttribute('data-no_telp');
        var role = button.getAttribute('data-role');
        var restriction = button.getAttribute('data-restriction');

        // Fill the form in the modal with the data
        document.getElementById('nama_user').value = name;
        document.getElementById('email').value = email;
        document.getElementById('no_telp').value = phone;
        document.getElementById('role').value = role;
        document.getElementById('restriction').value = restriction;

        // Update the form action to point to the update route
        var form = document.querySelector('#modal-edit form');
        // form.action = '/account/update/' + id;

        // Show the modal
        openModal('modal-edit');
    }

    function openModal(id) {
        document.getElementById(id).classList.remove('hidden');
    }

    function closeModal(id) {
        document.getElementById(id).classList.add('hidden');
    }
</script>
