<x-app-layout>
    <div class="py-12 bg-white">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Title Section -->
            <div class="flex justify-between mb-6">
                <h2 class="text-2xl font-bold text-gray-800">My Expenses</h2>
                <h2 class="text-xl text-gray-800">Dashboard</h2>
            </div>

            <!-- Flex Container for Table and Pie Chart -->
            <div class="flex">
                <!-- Expense Categories Table -->
                <div class="w-2/3 pr-4">
                    <table class="min-w-full bg-white border border-gray-200">
                        <thead>
                            <tr class="bg-gray-100 border-b">
                                <th class="text-left py-2 px-4 font-semibold text-gray-800">Category</th>
                                <th class="text-left py-2 px-4 font-semibold text-gray-800">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-b">
                                <td class="py-2 px-4">Category A</td>
                                <td class="py-2 px-4">$300</td>
                            </tr>
                            <tr class="border-b">
                                <td class="py-2 px-4">Category B</td>
                                <td class="py-2 px-4">$150</td>
                            </tr>
                            <!-- Add more rows as needed -->
                        </tbody>
                    </table>
                </div>

                <!-- Placeholder for Pie Chart -->
                <div class="w-1/3">
                    <canvas id="expenseChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('expenseChart').getContext('2d');
        const expenseChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['Category A', 'Category B'],
                datasets: [{
                    label: 'Expense Categories',
                    data: [300, 150], // Dummy data
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.6)',
                        'rgba(54, 162, 235, 0.6)',
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Expense Distribution'
                    }
                }
            }
        });
    </script>
</x-app-layout>