<x-app-layout>
    <div class="py-12 bg-white">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Title Section -->
            <div class="flex justify-between mb-6">
                <h2 class="text-2xl font-bold text-gray-800">Roles</h2>
                <h2 class="text-xl text-gray-800">User Management > Roles</h2>
            </div>

            <!-- Flex Container for Table and Modal -->
            <div class="flex">
                <!-- Expense Categories Table -->
                <div class="w-2/3 pr-4">
                    <table class="min-w-full bg-white border border-gray-200">
                        <thead>
                            <tr class="bg-gray-100 border-b">
                                <th class="text-left py-2 px-4 font-semibold text-gray-800">Display Name</th>
                                <th class="text-left py-2 px-4 font-semibold text-gray-800">Description</th>
                                <th class="text-left py-2 px-4 font-semibold text-gray-800">Created at</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-b cursor-pointer" onclick="openEditModal('Role 1', 'Description 1', '2023-09-24')">
                                <td class="py-2 px-4">Role 1</td>
                                <td class="py-2 px-4">Description 1</td>
                                <td class="py-2 px-4">2023-09-24</td>
                            </tr>
                            <tr class="border-b cursor-pointer" onclick="openEditModal('Role 2', 'Description 2', '2023-09-25')">
                                <td class="py-2 px-4">Role 2</td>
                                <td class="py-2 px-4">Description 2</td>
                                <td class="py-2 px-4">2023-09-25</td>
                            </tr>

                        </tbody>
                    </table>
                    <div class="mb-6 mt-10 flex justify-end">
                        <button class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded"
                            onclick="toggleModal(true)">
                            Add New Role
                        </button>
                    </div>
                </div>

                <!-- Modal for Adding New Role -->
                <div id="roleModal" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center hidden">
                    <div class="bg-white w-full max-w-lg mx-auto rounded-lg shadow-lg p-6">
                        <div class="flex justify-between items-center mb-4">
                            <h2 class="text-xl font-bold text-gray-800">Add New Role</h2>
                            <button class="text-gray-600 hover:text-gray-800" onclick="toggleModal(false)">&times;</button>
                        </div>
                        <form id="addRoleForm">
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2">Display Name</label>
                                <input type="text" name="display_name" class="w-full px-3 py-2 border rounded focus:outline-none focus:ring focus:border-blue-300" required>
                            </div>
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2">Description</label>
                                <textarea name="description" class="w-full px-3 py-2 border rounded focus:outline-none focus:ring focus:border-blue-300" required></textarea>
                            </div>
                            <div class="flex justify-end">
                                <button type="button" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded mr-2" onclick="toggleModal(false)">Cancel</button>
                                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">Save</button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Modal for Editing Role -->
                <div id="editRoleModal" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center hidden">
                    <div class="bg-white w-full max-w-lg mx-auto rounded-lg shadow-lg p-6">
                        <div class="flex justify-between items-center mb-4">
                            <h2 class="text-xl font-bold text-gray-800">Edit Role</h2>
                            <button class="text-gray-600 hover:text-gray-800" onclick="toggleEditModal(false)">&times;</button>
                        </div>
                        <form id="editRoleForm">
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2">Display Name</label>
                                <input type="text" id="editDisplayName" name="display_name" class="w-full px-3 py-2 border rounded focus:outline-none focus:ring focus:border-blue-300" required>
                            </div>
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2">Description</label>
                                <textarea id="editDescription" name="description" class="w-full px-3 py-2 border rounded focus:outline-none focus:ring focus:border-blue-300" required></textarea>
                            </div>
                            <div class="flex justify-end">
                                <button type="button" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded mr-2" onclick="toggleEditModal(false)">Cancel</button>
                                <button type="button" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded" onclick="deleteRole()">Delete</button>
                                <button type="button" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded" onclick="updateRole()">Update</button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Scripts -->
                <script>
                    // Toggle modal visibility for Add Role
                    function toggleModal(show) {
                        const modal = document.getElementById('roleModal');
                        modal.classList.toggle('hidden', !show);
                    }

                    // Toggle modal visibility for Edit Role
                    function toggleEditModal(show) {
                        const modal = document.getElementById('editRoleModal');
                        modal.classList.toggle('hidden', !show);
                    }

                    // Open Edit Modal with data from the selected row
                    function openEditModal(displayName, description, createdAt) {
                        document.getElementById('editDisplayName').value = displayName;
                        document.getElementById('editDescription').value = description;
                        toggleEditModal(true);
                    }

                    // Handle form submission for adding new role
                    document.getElementById('addRoleForm').addEventListener('submit', function(event) {
                        event.preventDefault();
                        // Handle adding role logic here (e.g., via Ajax)
                        toggleModal(false); // Hide the modal on submit
                    });

                    // Function to handle role deletion
                    function deleteRole() {
                        // Handle deletion logic here (e.g., via Ajax)
                        alert("Role deleted!"); // Placeholder for actual deletion logic
                        toggleEditModal(false);
                    }

                    // Function to handle role update
                    function updateRole() {
                        // Handle updating logic here (e.g., via Ajax)
                        alert("Role updated!"); // Placeholder for actual update logic
                        toggleEditModal(false);
                    }
                </script>
            </div>
        </div>
    </div>
</x-app-layout>