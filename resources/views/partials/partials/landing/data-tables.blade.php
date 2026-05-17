<!-- Data Tables Section - Two long tables with continuous bars -->
<div class="mb-6 p-4">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
        <!-- Job Categories Performance Table -->
        <div class="bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden">
            <div class="bg-gradient-to-r from-blue-600 to-cyan-600 p-4">
                <h3 class="text-lg font-bold text-white flex items-center">
                    <i class="fas fa-chart-bar mr-2"></i>
                    Job Categories Performance
                </h3>
            </div>
            <div class="data-table-container p-4">
                <div class="space-y-3">
                    @php
                        $categories = [
                            ['name' => 'Technology', 'jobs' => $totalJobs * 0.35, 'applications' => $applications * 0.4],
                            ['name' => 'Finance', 'jobs' => $totalJobs * 0.2, 'applications' => $applications * 0.25],
                            ['name' => 'Healthcare', 'jobs' => $totalJobs * 0.15, 'applications' => $applications * 0.15],
                            ['name' => 'Education', 'jobs' => $totalJobs * 0.12, 'applications' => $applications * 0.1],
                            ['name' => 'Marketing', 'jobs' => $totalJobs * 0.1, 'applications' => $applications * 0.05],
                            ['name' => 'Construction', 'jobs' => $totalJobs * 0.08, 'applications' => $applications * 0.05]
                        ];
                        $maxJobs = max(array_column($categories, 'jobs'));
                    @endphp
                    
                    @foreach($categories as $category)
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                        <div class="flex-1">
                            <div class="flex justify-between items-center mb-2">
                                <span class="font-semibold text-gray-800">{{ $category['name'] }}</span>
                                <span class="text-sm text-gray-600">{{ number_format($category['jobs']) }} jobs</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2 mb-1">
                                <div class="progress-bar bg-gradient-to-r from-blue-500 to-cyan-500 h-2 rounded-full" 
                                     data-width="{{ ($category['jobs'] / $maxJobs) * 100 }}" 
                                     style="width: 0%; --target-width: {{ ($category['jobs'] / $maxJobs) * 100 }}%"></div>
                            </div>
                            <div class="flex justify-between text-xs text-gray-500">
                                <span>{{ number_format($category['applications']) }} applications</span>
                                <span>{{ number_format(($category['applications'] / $category['jobs']) * 100, 1) }}% rate</span>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- User Activity Analytics Table -->
        <div class="bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden">
            <div class="bg-gradient-to-r from-purple-600 to-pink-600 p-4">
                <h3 class="text-lg font-bold text-white flex items-center">
                    <i class="fas fa-users mr-2"></i>
                    User Activity Analytics
                </h3>
            </div>
            <div class="data-table-container p-4">
                <div class="space-y-3">
                    @php
                        $activities = [
                            ['name' => 'Daily Active Users', 'count' => $activeUsers * 0.8, 'percentage' => 80],
                            ['name' => 'Weekly Active Users', 'count' => $activeUsers * 0.95, 'percentage' => 95],
                            ['name' => 'Job Views', 'count' => $totalJobs * 5.2, 'percentage' => 85],
                            ['name' => 'Profile Updates', 'count' => $seekers * 0.3, 'percentage' => 30],
                            ['name' => 'Messages Sent', 'count' => $applications * 1.5, 'percentage' => 65],
                            ['name' => 'Search Queries', 'count' => $totalJobs * 8.7, 'percentage' => 92]
                        ];
                    @endphp
                    
                    @foreach($activities as $activity)
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                        <div class="flex-1">
                            <div class="flex justify-between items-center mb-2">
                                <span class="font-semibold text-gray-800">{{ $activity['name'] }}</span>
                                <span class="text-sm text-gray-600">{{ number_format($activity['count']) }}</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2 mb-1">
                                <div class="progress-bar bg-gradient-to-r from-purple-500 to-pink-500 h-2 rounded-full animate-slide-right" 
                                     data-width="{{ $activity['percentage'] }}" 
                                     style="width: 0%; --target-width: {{ $activity['percentage'] }}%"></div>
                            </div>
                            <div class="flex justify-between text-xs text-gray-500">
                                <span>{{ $activity['percentage'] }}% engagement</span>
                                <span class="flex items-center">
                                    @if($activity['percentage'] > 70)
                                        <i class="fas fa-arrow-up text-green-500 mr-1"></i>
                                        <span class="text-green-500">High</span>
                                    @elseif($activity['percentage'] > 40)
                                        <i class="fas fa-arrow-right text-yellow-500 mr-1"></i>
                                        <span class="text-yellow-500">Medium</span>
                                    @else
                                        <i class="fas fa-arrow-down text-red-500 mr-1"></i>
                                        <span class="text-red-500">Low</span>
                                    @endif
                                </span>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>