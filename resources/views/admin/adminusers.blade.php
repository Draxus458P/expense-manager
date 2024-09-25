<x-app-layout>
    <div class="py-12 bg-white">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
            <div id="successMessage" class="bg-green-500 text-white px-4 py-2 rounded mb-4">
                {{ session('success') }}
            </div>
            @endif

            <!-- Title Section -->
            <div class="flex justify-between mb-6">
                <h2 class="text-2xl font-bold text-gray-800">Users</h2>
                <h2 class="text-xl text-gray-800">User Management > Users</h2>
            </div>

            <!-- Flex Container for Table and Modals -->
            <div class="flex">
                <!-- Users Table -->
                <div class="w-2/3 pr-4">
                    <table class="min-w-full bg-white border border-gray-200">
                        <thead>
                            <tr class="bg-gray-100 border-b">
                                <th class="text-left py-2 px-4 font-semibold text-gray-800">Display Name</th>
                                <th class="text-left py-2 px-4 font-semibold text-gray-800">Email Address</th>
                                <th class="text-left py-2 px-4 font-semibold text-gray-800">Role</th>
                                <th class="text-left py-2 px-4 font-semibold text-gray-800">Created at</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                            <tr class="border-b cursor-pointer" onclick="openEditModal('{{ $user->name }}', '{{ $user->email }}', '{{ $user->role }}')">
                                <td class="py-2 px-4">{{ $user->name }}</td>
                                <td class="py-2 px-4">{{ $user->email }}</td>
                                <td class="py-2 px-4">{{ ucfirst($user->role) }}</td>
                                <td class="py-2 px-4">{{ $user->created_at->format('Y-m-d') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mb-6 mt-10 flex justify-end">
                        <button class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded" onclick="toggleModal(true)">
                            Add User
                        </button>
                    </div>
                </div>

                <!-- Modal for Adding New User -->
                <div id="userModal" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center hidden">
                    <div class="bg-white w-full max-w-lg mx-auto rounded-lg shadow-lg p-6">
                        <div class="flex justify-between items-center mb-4">
                            <h2 class="text-xl font-bold text-gray-800">Add User</h2>
                            <button class="text-gray-600 hover:text-gray-800" onclick="toggleModal(false)">&times;</button>
                        </div>
                        <form id="addUserForm" action="{{ route('users.store') }}" method="POST">
                            @csrf
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2">Name</label>
                                <input type="text" name="name" class="w-full px-3 py-2 border rounded focus:outline-none focus:ring focus:border-blue-300" required>
                            </div>
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2">Email Address</label>
                                <input type="email" name="email" class="w-full px-3 py-2 border rounded focus:outline-none focus:ring focus:border-blue-300" required>
                            </div>
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2">Role</label>
                                <select name="role" class="w-full px-3 py-2 border rounded focus:outline-none focus:ring focus:border-blue-300" required>
                                    <option value="" disabled selected>Select a role</option>
                                    <option value="user">User</option>
                                    <option value="admin">Admin</option>
                                </select>
                            </div>
                            <div class="flex justify-end">
                                <button type="button" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded mr-2" onclick="toggleModal(false)">Cancel</button>
                                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">Save</button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Modal for Editing User -->
                <div id="editUserModal" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center hidden">
                    <div class="bg-white w-full max-w-lg mx-auto rounded-lg shadow-lg p-6">
                        <div class="flex justify-between items-center mb-4">
                            <h2 class="text-xl font-bold text-gray-800">Edit User</h2>
                            <button class="text-gray-600 hover:text-gray-800" onclick="toggleEditModal(false)">&times;</button>
                        </div>
                        <form id="editUserForm" action="{{ route('users.update', ['user' => 'userId']) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2">Name</label>
                                <input type="text" id="editName" name="name" class="w-full px-3 py-2 border rounded focus:outline-none focus:ring focus:border-blue-300" required>
                            </div>
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2">Email Address</label>
                                <input type="email" id="editEmail" name="email" class="w-full px-3 py-2 border rounded focus:outline-none focus:ring focus:border-blue-300" required>
                            </div>
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2">Role</label>
                                <select id="editRole" name="role" class="w-full px-3 py-2 border rounded focus:outline-none focus:ring focus:border-blue-300" required>
                                    <option value="" disabled>Select a role</option>
                                    <option value="user">User</option>
                                    <option value="admin">Admin</option>
                                </select>
                            </div>
                            <div class="flex justify-end">
                                <button type="button" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded mr-2" onclick="toggleEditModal(false)">Cancel</button>
                                <button type="button" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded" onclick="deleteUser()">Delete</button>
                                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">Update</button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Scripts -->
                <script>
                    // Toggle modal visibility for Add User
                    function toggleModal(show) {
                        const modal = document.getElementById('userModal');
                        modal.classList.toggle('hidden', !show);
                    }

                    // Toggle modal visibility for Edit User
                    function toggleEditModal(show) {
                        const modal = document.getElementById('editUserModal');
                        modal.classList.toggle('hidden', !show);
                    }

                    // Open Edit Modal with data from the selected row
                    function openEditModal(name, email, role) {
                        document.getElementById('editName').value = name;
                        document.getElementById('editEmail').value = email;
                        document.getElementById('editRole').value = role;
                        toggleEditModal(true);
                    }

                    // Function to handle user deletion
                    function deleteUser() {
                        // Handle deletion logic here (e.g., via Ajax)
                        alert("User deleted!"); // Placeholder for actual deletion logic
                        toggleEditModal(false);
                    }
                </script>

                <script>
                    // Auto-hide success message after 3 seconds
                    setTimeout(() => {
                        const alert = document.getElementById('successMessage');
                        if (alert) {
                            alert.style.display = 'none';
                        }
                    }, 3000);
                </script>
            </div>
        </div>
    </div>
</x-app-layout>