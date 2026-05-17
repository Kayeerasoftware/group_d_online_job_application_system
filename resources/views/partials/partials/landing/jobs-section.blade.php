<!-- Jobs Grid/List Section - Copied from seeker/browse-jobs -->
<div class="p-4">
    <!-- Results Count & View Toggle -->
    <div class="flex justify-between items-center mb-6">
        <p class="text-gray-600 font-semibold">Showing <span class="text-blue-600" id="showingCount">{{ $jobs->count() }}</span> jobs out of <span class="text-blue-600" id="totalCount">{{ $jobs->total() }}</span> jobs</p>
        <div class="flex gap-2">
            <button onclick="switchView('grid')" id="gridViewBtn" class="px-4 py-2 bg-blue-600 text-white rounded-lg font-semibold transition-all duration-300">
                <i class="fas fa-th mr-2"></i>View Grid
            </button>
            <button onclick="switchView('list')" id="listViewBtn" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg font-semibold transition-all duration-300 hover:bg-gray-400">
                <i class="fas fa-list mr-2"></i>View List
            </button>
        </div>
    </div>

    <!-- Job Listings Grid -->
    <div id="gridView" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
        @foreach($jobs as $job)
        <div class="job-card relative bg-white rounded-lg shadow-md hover:shadow-lg transition-all duration-300 border-l-4 border-blue-600 p-4 flex flex-col"
             data-job-id="{{ $job->id }}"
             data-title="{{ strtolower($job->title ?? '') }}"
             data-location="{{ strtolower($job->location ?? '') }}"
             data-category="{{ strtolower($job->category ?? '') }}"
             data-job-type="{{ strtolower($job->job_type instanceof \App\Enums\JobType ? $job->job_type->value : ($job->job_type ?? '')) }}"
             data-created-at="{{ $job->created_at }}">

            <!-- Company Logo (Top Right - Rectangular) -->
            <div class="absolute top-0 right-0">
                @if($job->employer?->employerProfile?->company_logo)
                    <img src="{{ asset($job->employer->employerProfile->company_logo) }}" alt="Company" class="h-24 w-32 object-cover bg-gray-300/30" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                    <div class="h-24 w-32 bg-gray-300/30 flex items-center justify-center text-2xl font-bold text-gray-600 hidden">{{ substr($job->employer?->name ?? 'C', 0, 1) }}</div>
                @else
                    <div class="h-24 w-32 bg-gray-300/30 flex items-center justify-center text-2xl font-bold text-gray-600">{{ substr($job->employer?->name ?? 'C', 0, 1) }}</div>
                @endif
            </div>

            <!-- Content (Left Side) -->
            <div class="pr-36">

            <!-- Status Badge -->
            <div class="flex items-center justify-between gap-2 mb-3">
                @php
                    $daysUntilDeadline = $job->deadline ? now()->diffInDays($job->deadline, false) : null;
                    if ($daysUntilDeadline === null) {
                        $statusBadge = 'bg-green-100 text-green-800';
                        $statusText = 'Open';
                    } elseif ($daysUntilDeadline <= 0) {
                        $statusBadge = 'bg-red-100 text-red-800';
                        $statusText = 'Closed';
                    } elseif ($daysUntilDeadline <= 3) {
                        $statusBadge = 'bg-orange-100 text-orange-800';
                        $statusText = 'Closing Soon';
                    } else {
                        $statusBadge = 'bg-green-100 text-green-800';
                        $statusText = 'Open';
                    }
                @endphp
                <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $statusBadge }}">
                    {{ $statusText }}
                </span>
                @if(auth()->check() && !in_array($job->id, $savedJobIds))
                <form action="{{ route('seeker.saved-jobs.store', $job) }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="px-3 py-1 bg-yellow-100 text-yellow-700 rounded text-xs font-semibold hover:bg-yellow-200 transition">
                        Save
                    </button>
                </form>
                @elseif(auth()->check())
                <span class="px-3 py-1 bg-green-100 text-green-700 rounded text-xs font-semibold">
                    <i class="fas fa-check mr-1"></i>Saved
                </span>
                @endif
            </div>

            <!-- Job Title -->
            <div class="mb-3">
                <p class="text-xs text-gray-500 font-semibold uppercase tracking-wide">Job</p>
                <h3 class="text-lg font-bold text-gray-900 line-clamp-2">{{ $job->title ?? 'N/A' }}</h3>
            </div>

            <!-- Company -->
            <div class="mb-3">
                <p class="text-xs text-gray-500 font-semibold uppercase tracking-wide">Company</p>
                <p class="text-sm text-gray-700 font-semibold line-clamp-1">{{ $job->employer?->employerProfile?->company_name ?? $job->employer?->name ?? 'Unknown' }}</p>
            </div>

            <!-- Description -->
            <p class="text-gray-600 mb-4 line-clamp-3 text-sm flex-grow">{{ $job->description ?? 'No description' }}</p>

            <!-- Details -->
            <div class="space-y-2 mb-4 pb-4 border-b border-gray-200 text-sm text-gray-600">
                <p><i class="fas fa-map-marker-alt mr-2 text-blue-600 w-4"></i>{{ $job->location ?? 'Not specified' }}</p>
                <p><i class="fas fa-briefcase mr-2 text-blue-600 w-4"></i>{{ ucfirst($job->job_type instanceof \App\Enums\JobType ? $job->job_type->value : ($job->job_type ?? 'N/A')) }}</p>
                @if($job->salary_min || $job->salary_max)
                <p><i class="fas fa-dollar-sign mr-2 text-blue-600 w-4"></i>
                    @if($job->salary_min && $job->salary_max)
                        UGX {{ number_format((int)$job->salary_min) }} - {{ number_format((int)$job->salary_max) }}
                    @elseif($job->salary_min)
                        From UGX {{ number_format((int)$job->salary_min) }}
                    @else
                        Up to UGX {{ number_format((int)$job->salary_max) }}
                    @endif
                </p>
                @endif
            </div>

            <!-- Action Buttons -->
            <div class="flex gap-2 flex-col">
                @if(auth()->check() && auth()->user()->isSeeker())
                    @if(in_array($job->id, $appliedJobIds))
                        <button disabled class="px-4 py-2 bg-gray-400 text-white rounded font-semibold cursor-not-allowed">
                            <i class="fas fa-check mr-2"></i>Applied
                        </button>
                    @else
                        <a href="{{ route('seeker.applications.create', ['job_id' => $job->id]) }}" class="px-4 py-2 bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded font-semibold hover:shadow-md transition text-center">
                            <i class="fas fa-paper-plane mr-2"></i>Apply
                        </a>
                    @endif
                    <a href="{{ route('jobs.show', $job) }}" class="px-4 py-2 border border-blue-600 text-blue-600 rounded font-semibold hover:bg-blue-50 transition text-center">
                        <i class="fas fa-eye mr-2"></i>Details
                    </a>
                @else
                    <a href="{{ route('login') }}" class="px-4 py-2 bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded font-semibold hover:shadow-md transition text-center">
                        <i class="fas fa-sign-in-alt mr-2"></i>Apply
                    </a>
                    <a href="{{ route('jobs.show', $job) }}" class="px-4 py-2 border border-blue-600 text-blue-600 rounded font-semibold hover:bg-blue-50 transition text-center">
                        <i class="fas fa-eye mr-2"></i>View Details
                    </a>
                @endif
            </div>

            </div>
        </div>
        @endforeach
    </div>

    <!-- Job Listings Table -->
    <div id="listView" class="hidden">
        <div class="overflow-x-auto bg-white rounded-lg shadow-md border border-gray-200">
            <table class="w-full">
                <thead class="bg-gradient-to-r from-blue-600 to-cyan-600 text-white">
                    <tr>
                        <th class="px-6 py-4 text-left font-semibold">Job Title</th>
                        <th class="px-6 py-4 text-left font-semibold">Company</th>
                        <th class="px-6 py-4 text-left font-semibold">Location</th>
                        <th class="px-6 py-4 text-left font-semibold">Type</th>
                        <th class="px-6 py-4 text-left font-semibold">Salary</th>
                        <th class="px-6 py-4 text-center font-semibold">Actions</th>
                    </tr>
                </thead>
                <tbody id="tableBody" class="divide-y divide-gray-200">
                    @foreach($jobs as $job)
                    <tr class="hover:bg-gray-50 transition-colors job-table-row"
                        data-job-id="{{ $job->id }}"
                        data-title="{{ strtolower($job->title ?? '') }}"
                        data-location="{{ strtolower($job->location ?? '') }}"
                        data-category="{{ strtolower($job->category ?? '') }}"
                        data-job-type="{{ strtolower($job->job_type instanceof \App\Enums\JobType ? $job->job_type->value : ($job->job_type ?? '')) }}">
                        <td class="px-6 py-4 font-semibold text-gray-900">{{ $job->title ?? 'N/A' }}</td>
                        <td class="px-6 py-4 text-gray-700 flex items-center gap-2">
                            @if($job->employer?->employerProfile?->company_logo)
                                <img src="{{ asset($job->employer->employerProfile->company_logo) }}" alt="Company" class="w-10 h-10 rounded-full object-cover border-2 border-gray-200" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                <div class="w-10 h-10 rounded-full bg-gray-300/30 flex items-center justify-center text-sm font-bold text-gray-600 border-2 border-gray-200 hidden">{{ substr($job->employer?->name ?? 'C', 0, 1) }}</div>
                            @else
                                <div class="w-10 h-10 rounded-full bg-gray-300/30 flex items-center justify-center text-sm font-bold text-gray-600 border-2 border-gray-200">{{ substr($job->employer?->name ?? 'C', 0, 1) }}</div>
                            @endif
                            <span>{{ $job->employer?->employerProfile?->company_name ?? $job->employer?->name ?? 'Unknown' }}</span>
                        </td>
                        <td class="px-6 py-4 text-gray-700">{{ $job->location ?? 'Not specified' }}</td>
                        <td class="px-6 py-4">
                            <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded text-xs font-semibold">
                                {{ ucfirst($job->job_type instanceof \App\Enums\JobType ? $job->job_type->value : ($job->job_type ?? 'N/A')) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-gray-700">
                            @if($job->salary_min || $job->salary_max)
                                @if($job->salary_min && $job->salary_max)
                                    UGX {{ number_format((int)$job->salary_min) }} - {{ number_format((int)$job->salary_max) }}
                                @elseif($job->salary_min)
                                    From UGX {{ number_format((int)$job->salary_min) }}
                                @else
                                    Up to UGX {{ number_format((int)$job->salary_max) }}
                                @endif
                            @else
                                <span class="text-gray-400">Not specified</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-center">
                            <div class="flex gap-2 justify-center">
                                @if(auth()->check() && auth()->user()->isSeeker())
                                    @if(in_array($job->id, $appliedJobIds))
                                        <button disabled class="px-3 py-1 bg-gray-400 text-white rounded text-xs font-semibold cursor-not-allowed">
                                            <i class="fas fa-check mr-1"></i>Applied
                                        </button>
                                    @else
                                        <a href="{{ route('seeker.applications.create', ['job_id' => $job->id]) }}" class="px-3 py-1 bg-blue-600 text-white rounded text-xs font-semibold hover:bg-blue-700 transition">
                                            <i class="fas fa-paper-plane mr-1"></i>Apply
                                        </a>
                                    @endif
                                    <a href="{{ route('jobs.show', $job) }}" class="px-3 py-1 border border-blue-600 text-blue-600 rounded text-xs font-semibold hover:bg-blue-50 transition">
                        <i class="fas fa-eye mr-1"></i>View
                    </a>
                                @else
                                    <a href="{{ route('login') }}" class="px-3 py-1 bg-blue-600 text-white rounded text-xs font-semibold hover:bg-blue-700 transition">
                                        <i class="fas fa-paper-plane mr-1"></i>Apply
                                    </a>
                                    <a href="{{ route('jobs.show', $job) }}" class="px-3 py-1 border border-blue-600 text-blue-600 rounded text-xs font-semibold hover:bg-blue-50 transition">
                        <i class="fas fa-eye mr-1"></i>View
                    </a>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- No Jobs Message -->
    <div id="noJobsMessage" class="hidden bg-white rounded-lg shadow-md p-12 text-center border border-gray-100">
        <i class="fas fa-briefcase text-gray-400 text-4xl mb-4 block"></i>
        <h3 class="text-xl font-bold text-gray-900 mb-2">No Jobs Found</h3>
        <p class="text-gray-600">Try adjusting your search filters or check back later for new opportunities.</p>
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $jobs->links() }}
    </div>
</div>

<script>
// Job filtering and view switching functionality
const allJobs = document.querySelectorAll('.job-card');
const allTableRows = document.querySelectorAll('.job-table-row');
const searchInput = document.getElementById('searchInput');
const locationInput = document.getElementById('locationInput');
const categoryInput = document.getElementById('categoryInput');
const jobTypeInput = document.getElementById('jobTypeInput');
const levelInput = document.getElementById('levelInput');
const workArrangementInput = document.getElementById('workArrangementInput');
const sortInput = document.getElementById('sortInput');
const noJobsMessage = document.getElementById('noJobsMessage');
const gridViewBtn = document.getElementById('gridViewBtn');
const listViewBtn = document.getElementById('listViewBtn');
const gridView = document.getElementById('gridView');
const listView = document.getElementById('listView');

function filterJobs() {
    const searchTerm = searchInput?.value.toLowerCase() || '';
    const locationTerm = locationInput?.value.toLowerCase() || '';
    const category = categoryInput?.value.toLowerCase() || '';
    const jobType = jobTypeInput?.value.toLowerCase() || '';

    let visibleCards = [];
    let visibleRows = [];

    allJobs.forEach(card => {
        const title = card.dataset.title || '';
        const location = card.dataset.location || '';
        const cardCategory = card.dataset.category || '';
        const cardJobType = card.dataset.jobType || '';

        const matchesSearch = !searchTerm || title.includes(searchTerm) || card.textContent.toLowerCase().includes(searchTerm);
        const matchesLocation = !locationTerm || location.includes(locationTerm);
        const matchesCategory = !category || cardCategory.includes(category);
        const matchesJobType = !jobType || cardJobType.includes(jobType);

        if (matchesSearch && matchesLocation && matchesCategory && matchesJobType) {
            card.style.display = '';
            visibleCards.push(card);
        } else {
            card.style.display = 'none';
        }
    });

    allTableRows.forEach(row => {
        const title = row.dataset.title || '';
        const location = row.dataset.location || '';
        const cardCategory = row.dataset.category || '';
        const cardJobType = row.dataset.jobType || '';

        const matchesSearch = !searchTerm || title.includes(searchTerm) || row.textContent.toLowerCase().includes(searchTerm);
        const matchesLocation = !locationTerm || location.includes(locationTerm);
        const matchesCategory = !category || cardCategory.includes(category);
        const matchesJobType = !jobType || cardJobType.includes(jobType);

        if (matchesSearch && matchesLocation && matchesCategory && matchesJobType) {
            row.style.display = '';
            visibleRows.push(row);
        } else {
            row.style.display = 'none';
        }
    });

    // Show/hide no results message
    if (visibleCards.length === 0) {
        noJobsMessage?.classList.remove('hidden');
    } else {
        noJobsMessage?.classList.add('hidden');
    }

    document.getElementById('showingCount').textContent = visibleCards.length;
}

function switchView(view) {
    if (view === 'grid') {
        gridView?.classList.remove('hidden');
        listView?.classList.add('hidden');
        gridViewBtn?.classList.add('bg-blue-600', 'text-white');
        gridViewBtn?.classList.remove('bg-gray-300', 'text-gray-700');
        listViewBtn?.classList.remove('bg-blue-600', 'text-white');
        listViewBtn?.classList.add('bg-gray-300', 'text-gray-700');
    } else {
        listView?.classList.remove('hidden');
        gridView?.classList.add('hidden');
        listViewBtn?.classList.add('bg-blue-600', 'text-white');
        listViewBtn?.classList.remove('bg-gray-300', 'text-gray-700');
        gridViewBtn?.classList.remove('bg-blue-600', 'text-white');
        gridViewBtn?.classList.add('bg-gray-300', 'text-gray-700');
    }
}

function resetFilters() {
    if (searchInput) searchInput.value = '';
    if (locationInput) locationInput.value = '';
    if (categoryInput) categoryInput.value = '';
    if (jobTypeInput) jobTypeInput.value = '';
    if (levelInput) levelInput.value = '';
    if (workArrangementInput) workArrangementInput.value = '';
    if (sortInput) sortInput.value = 'newest';
    filterJobs();
}

// Event listeners
searchInput?.addEventListener('input', filterJobs);
locationInput?.addEventListener('input', filterJobs);
categoryInput?.addEventListener('change', filterJobs);
jobTypeInput?.addEventListener('change', filterJobs);
levelInput?.addEventListener('change', filterJobs);
workArrangementInput?.addEventListener('change', filterJobs);
sortInput?.addEventListener('change', filterJobs);

// Initial filter
filterJobs();
</script>
