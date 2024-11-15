<x-app-layout>
    <div class="py-12 bg-white">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Title Section -->
            <div class="flex justify-between mb-6">
                <h2 class="text-2xl font-bold text-gray-800">Expenses</h2>
                <h2 class="text-xl text-gray-800">Expense Management > Expenses</h2>
            </div>

            <!-- Flex Container for Table and Modal -->
            <div class="flex">
                <!-- Expense Categories Table -->
                <div class="w-2/3 pr-4">
                    <table class="min-w-full bg-white border border-gray-200">
                        <thead>
                            <tr class="bg-gray-100 border-b">
                                <th class="text-left py-2 px-4 font-semibold text-gray-800">Expense Category</th>
                                <th class="text-left py-2 px-4 font-semibold text-gray-800">Amount</th>
                                <th class="text-left py-2 px-4 font-semibold text-gray-800">Entry Date</th>
                                <th class="text-left py-2 px-4 font-semibold text-gray-800">Created at</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-b cursor-pointer" onclick="openEditModal('Travel', '100', '2023-09-24', '2023-09-22')">
                                <td class="py-2 px-4">Expense 1</td>
                                <td class="py-2 px-4">100</td>
                                <td class="py-2 px-4">2023-09-24</td>
                                <td class="py-2 px-4">2023-09-22</td>
                            </tr>
                            <tr class="border-b cursor-pointer" onclick="openEditModal('Food', '200', '2023-09-25', '2023-09-23')">
                                <td class="py-2 px-4">Expense 2</td>
                                <td class="py-2 px-4">200</td>
                                <td class="py-2 px-4">2023-09-25</td>
                                <td class="py-2 px-4">2023-09-23</td>
                            </tr>
                        </tbody>
                    </table>

                    <!-- Modal for Editing Expense -->
                    <div id="editRoleModal" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center hidden">
                        <div class="bg-white w-full max-w-lg mx-auto rounded-lg shadow-lg p-6">
                            <div class="flex justify-between items-center mb-4">
                                <h2 class="text-xl font-bold text-gray-800">Update Expense</h2>
                                <button class="text-gray-600 hover:text-gray-800" onclick="toggleEditModal(false)">&times;</button>
                            </div>
                            <form id="editRoleForm">
                                <div class="mb-4">
                                    <label class="block text-gray-700 text-sm font-bold mb-2">Expense Category</label>
                                    <select id="editCategory" name="category" class="w-full px-3 py-2 border rounded focus:outline-none focus:ring focus:border-blue-300" required>
                                        <option value="" disabled selected>Select a category</option>
                                        <option value="Travel">Travel</option>
                                        <option value="Food">Food</option>
                                    </select>
                                </div>
                                <div class="mb-4">
                                    <label class="block text-gray-700 text-sm font-bold mb-2">Amount</label>
                                    <input type="text" id="editAmount" name="amount" class="w-full px-3 py-2 border rounded focus:outline-none focus:ring focus:border-blue-300" required>
                                </div>
                                <div class="mb-4">
                                    <label class="block text-gray-700 text-sm font-bold mb-2">Entry Date</label>
                                    <input type="date" id="editDate" name="date" class="w-full px-3 py-2 border rounded focus:outline-none focus:ring focus:border-blue-300" required>
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
                        // Toggle modal visibility for Add Expense
                        function toggleModal(show) {
                            const modal = document.getElementById('roleModal');
                            modal.classList.toggle('hidden', !show);
                        }

                        // Toggle modal visibility for Edit Expense
                        function toggleEditModal(show) {
                            const modal = document.getElementById('editRoleModal');
                            modal.classList.toggle('hidden', !show);
                        }

                        // Open Edit Modal with data from the selected row
                        function openEditModal(category, amount, entryDate, createdAt) {
                            document.getElementById('editCategory').value = category;
                            document.getElementById('editAmount').value = amount;
                            document.getElementById('editDate').value = entryDate;
                            toggleEditModal(true);
                        }

                        // Handle form submission for adding new expense
                        document.getElementById('addRoleForm').addEventListener('submit', function(event) {
                            event.preventDefault();
                            // Handle adding expense logic here (e.g., via Ajax)
                            toggleModal(false); // Hide the modal on submit
                        });

                        // Function to handle expense deletion
                        function deleteRole() {
                            // Handle deletion logic here (e.g., via Ajax)
                            alert("Expense deleted!"); // Placeholder for actual deletion logic
                            toggleEditModal(false);
                        }

                        // Function to handle expense update
                        function updateRole() {
                            // Handle updating logic here (e.g., via Ajax)
                            alert("Expense updated!"); // Placeholder for actual update logic
                            toggleEditModal(false);
                        }
                    </script>
                </div>
            </div>
        </div>
</x-app-layout>