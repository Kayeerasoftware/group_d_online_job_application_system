<!-- Charts Section - 4 charts in one line -->
<div class="mb-6 p-4">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
        <!-- Line Chart -->
        <div class="bg-white rounded-xl shadow-lg p-4 border border-gray-200">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-bold text-gray-800">Job Trends</h3>
                <i class="fas fa-chart-line text-blue-500"></i>
            </div>
            <div class="chart-container">
                <canvas id="lineChart"></canvas>
            </div>
        </div>

        <!-- Bar Chart (Histogram) -->
        <div class="bg-white rounded-xl shadow-lg p-4 border border-gray-200">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-bold text-gray-800">Applications</h3>
                <i class="fas fa-chart-bar text-green-500"></i>
            </div>
            <div class="chart-container">
                <canvas id="barChart"></canvas>
            </div>
        </div>

        <!-- Advanced Chart (Area Chart) -->
        <div class="bg-white rounded-xl shadow-lg p-4 border border-gray-200">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-bold text-gray-800">Growth Rate</h3>
                <i class="fas fa-chart-area text-purple-500"></i>
            </div>
            <div class="chart-container">
                <canvas id="areaChart"></canvas>
            </div>
        </div>

        <!-- Pie Chart -->
        <div class="bg-white rounded-xl shadow-lg p-4 border border-gray-200">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-bold text-gray-800">Job Types</h3>
                <i class="fas fa-chart-pie text-orange-500"></i>
            </div>
            <div class="chart-container">
                <canvas id="pieChart"></canvas>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Line Chart
    const lineCtx = document.getElementById('lineChart').getContext('2d');
    new Chart(lineCtx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
            datasets: [{
                label: 'Jobs Posted',
                data: [{{ $totalJobs * 0.1 }}, {{ $totalJobs * 0.15 }}, {{ $totalJobs * 0.2 }}, {{ $totalJobs * 0.25 }}, {{ $totalJobs * 0.15 }}, {{ $totalJobs * 0.15 }}],
                borderColor: 'rgb(59, 130, 246)',
                backgroundColor: 'rgba(59, 130, 246, 0.1)',
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: { y: { beginAtZero: true } }
        }
    });

    // Bar Chart
    const barCtx = document.getElementById('barChart').getContext('2d');
    new Chart(barCtx, {
        type: 'bar',
        data: {
            labels: ['Pending', 'Reviewed', 'Shortlisted', 'Hired'],
            datasets: [{
                data: [{{ $applications * 0.4 }}, {{ $applications * 0.3 }}, {{ $applications * 0.2 }}, {{ $applications * 0.1 }}],
                backgroundColor: ['#f59e0b', '#10b981', '#3b82f6', '#8b5cf6']
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: { y: { beginAtZero: true } }
        }
    });

    // Area Chart
    const areaCtx = document.getElementById('areaChart').getContext('2d');
    new Chart(areaCtx, {
        type: 'line',
        data: {
            labels: ['Week 1', 'Week 2', 'Week 3', 'Week 4'],
            datasets: [{
                label: 'User Growth',
                data: [{{ $activeUsers * 0.7 }}, {{ $activeUsers * 0.8 }}, {{ $activeUsers * 0.9 }}, {{ $activeUsers }}],
                borderColor: 'rgb(147, 51, 234)',
                backgroundColor: 'rgba(147, 51, 234, 0.2)',
                fill: true,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: { y: { beginAtZero: true } }
        }
    });

    // Pie Chart
    const pieCtx = document.getElementById('pieChart').getContext('2d');
    new Chart(pieCtx, {
        type: 'doughnut',
        data: {
            labels: ['Full-time', 'Part-time', 'Contract', 'Internship'],
            datasets: [{
                data: [{{ $totalJobs * 0.5 }}, {{ $totalJobs * 0.2 }}, {{ $totalJobs * 0.2 }}, {{ $totalJobs * 0.1 }}],
                backgroundColor: ['#ef4444', '#f97316', '#eab308', '#22c55e']
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { position: 'bottom', labels: { boxWidth: 12, fontSize: 10 } } }
        }
    });
});
</script>