@extends('layouts.employer')

@section('title', 'Interview Details')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 p-3 md:p-6">
    <!-- Back Button -->
    <div class="mb-4">
        <a href="{{ route('employer.interviews') }}" class="inline-flex items-center gap-2 text-purple-600 hover:text-purple-700 font-semibold">
            <i class="fas fa-arrow-left"></i>Back to Interviews
        </a>
    </div>

    <!-- Header -->
    <div class="bg-white rounded-xl shadow-lg p-6 mb-6 border border-purple-100">
        <div class="flex items-start justify-between gap-4">
            <div class="flex-1">
                <div class="flex items-center gap-3 mb-2">
                    <h1 class="text-2xl md:text-3xl font-bold text-gray-900">{{ $application->job->title }}</h1>
                    @if($application->interview_type)
                    <span class="inline-flex items-center gap-1 px-3 py-1 text-sm font-medium bg-purple-100 text-purple-800 rounded-full">
                        <i class="fas fa-{{ $application->interview_type === 'video' ? 'video' : ($application->interview_type === 'phone' ? 'phone' : 'building') }}"></i>{{ ucfirst($application->interview_type) }}
                    </span>
                    @endif
                </div>
                <p class="text-lg text-gray-600">{{ $seeker->name }}</p>
                
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-4">
                    <div>
                        <p class="text-sm text-gray-600">Interview Date</p>
                        <p class="text-lg font-semibold text-gray-900">{{ $application->scheduled_date->format('M d, Y') }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Interview Time</p>
                        <p class="text-lg font-semibold text-gray-900">{{ $application->scheduled_date->format('h:i A') }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Interviewer</p>
                        <p class="text-lg font-semibold text-gray-900">{{ $application->interviewer_name ?? 'HR Team' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Status</p>
                        <p class="text-lg font-semibold">
                            @if($application->scheduled_date > now())
                            <span class="text-purple-600">Upcoming</span>
                            @else
                            <span class="text-emerald-600">Completed</span>
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Communication Section -->
        <div class="lg:col-span-2">
            <!-- Interview Details Card -->
            <div class="bg-white rounded-xl shadow-lg p-6 mb-6 border border-gray-100">
                <h2 class="text-xl font-bold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-info-circle text-purple-600 mr-2"></i>Interview Details
                </h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <p class="text-sm text-gray-600 font-medium">Candidate Email</p>
                        <p class="text-gray-900 font-semibold">{{ $seeker->email }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600 font-medium">Candidate Phone</p>
                        <p class="text-gray-900 font-semibold">{{ $seeker->phone ?? 'N/A' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600 font-medium">Interview Type</p>
                        <p class="text-gray-900 font-semibold">{{ ucfirst($application->interview_type ?? 'Not Set') }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600 font-medium">Applied Date</p>
                        <p class="text-gray-900 font-semibold">{{ $application->applied_date->format('M d, Y') }}</p>
                    </div>
                </div>

                @if($application->interview_notes)
                <div class="mb-4 p-4 bg-blue-50 rounded-lg border border-blue-200">
                    <p class="text-sm text-blue-900"><strong>Employer Notes:</strong></p>
                    <p class="text-sm text-blue-800 mt-1">{{ $application->interview_notes }}</p>
                </div>
                @endif

                @if($application->interview_link)
                <div class="mb-4 p-4 bg-green-50 rounded-lg border border-green-200">
                    <p class="text-sm text-green-900"><strong>Interview Link:</strong></p>
                    <a href="{{ $application->interview_link }}" target="_blank" class="text-sm text-green-600 hover:text-green-700 font-semibold mt-1 inline-flex items-center gap-2">
                        <i class="fas fa-external-link-alt"></i>{{ $application->interview_link }}
                    </a>
                </div>
                @endif

                @if($application->feedback)
                <div class="p-4 bg-amber-50 rounded-lg border border-amber-200">
                    <p class="text-sm text-amber-900"><strong>Feedback:</strong></p>
                    <p class="text-sm text-amber-800 mt-1">{{ $application->feedback }}</p>
                </div>
                @endif
            </div>

            <!-- Messages Section -->
            <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100">
                <h2 class="text-xl font-bold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-comments text-purple-600 mr-2"></i>Communication
                </h2>

                <!-- Messages Container -->
                <div class="bg-gray-50 rounded-lg p-4 mb-4 h-96 overflow-y-auto space-y-4" id="messagesContainer">
                    @forelse($communications as $comm)
                    <div class="flex {{ $comm->sender_id === auth()->id() ? 'justify-end' : 'justify-start' }}">
                        <div class="max-w-xs {{ $comm->sender_id === auth()->id() ? 'bg-purple-100 text-purple-900' : 'bg-gray-200 text-gray-900' }} rounded-lg p-3">
                            <p class="text-xs font-semibold mb-1">
                                {{ $comm->sender_id === auth()->id() ? 'You' : $comm->sender->name }}
                            </p>
                            
                            @if($comm->message_type === 'text')
                            <p class="text-sm">{{ $comm->message }}</p>
                            @elseif($comm->message_type === 'status_update')
                            <div class="text-sm italic">
                                <i class="fas fa-info-circle mr-1"></i>{{ $comm->message }}
                            </div>
                            @else
                            <p class="text-sm">{{ $comm->message }}</p>
                            @endif
                            
                            <p class="text-xs mt-2 opacity-70">{{ $comm->created_at->format('M d, h:i A') }}</p>
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-8 text-gray-500">
                        <i class="fas fa-comments text-3xl mb-2 opacity-50"></i>
                        <p>No messages yet</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Sidebar Actions -->
        <div class="space-y-4">
            <!-- Candidate Info -->
            <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100">
                <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-user text-purple-600 mr-2"></i>Candidate
                </h3>
                <div class="space-y-3">
                    <div>
                        <p class="text-sm text-gray-600">Name</p>
                        <p class="font-semibold text-gray-900">{{ $seeker->name }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Email</p>
                        <p class="font-semibold text-gray-900 break-all">{{ $seeker->email }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Phone</p>
                        <p class="font-semibold text-gray-900">{{ $seeker->phone ?? 'N/A' }}</p>
                    </div>
                </div>
            </div>

            <!-- Interview Actions -->
            <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100">
                <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-lightning-bolt text-amber-600 mr-2"></i>Actions
                </h3>
                <div class="space-y-2">
                    @if($application->scheduled_date > now())
                    <button onclick="openRescheduleModal()" class="w-full px-4 py-2 bg-white text-amber-600 border border-amber-200 rounded-lg hover:bg-amber-50 transition-all duration-300 font-semibold text-sm">
                        <i class="fas fa-calendar-times mr-2"></i>Reschedule
                    </button>
                    @endif

                    @if($application->interview_link)
                    <a href="{{ $application->interview_link }}" target="_blank" class="block w-full px-4 py-2 bg-gradient-to-r from-purple-600 to-purple-700 text-white rounded-lg hover:shadow-lg transition-all duration-300 font-semibold text-sm text-center">
                        <i class="fas fa-video mr-2"></i>Join Interview
                    </a>
                    @endif

                    @if($application->scheduled_date <= now() && !$application->interview_outcome)
                    <button onclick="openOutcomeModal()" class="w-full px-4 py-2 bg-white text-emerald-600 border border-emerald-200 rounded-lg hover:bg-emerald-50 transition-all duration-300 font-semibold text-sm">
                        <i class="fas fa-check-circle mr-2"></i>Set Outcome
                    </button>
                    @endif

                    <a href="{{ route('employer.applications.show', $application->id) }}" class="block w-full px-4 py-2 bg-white text-blue-600 border border-blue-200 rounded-lg hover:bg-blue-50 transition-all duration-300 font-semibold text-sm text-center">
                        <i class="fas fa-file-alt mr-2"></i>View Application
                    </a>
                </div>
            </div>

            <!-- Interview Timeline -->
            <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100">
                <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-timeline text-blue-600 mr-2"></i>Timeline
                </h3>
                <div class="space-y-3 text-sm">
                    <div class="flex gap-3">
                        <div class="w-2 h-2 bg-purple-600 rounded-full mt-1.5 flex-shrink-0"></div>
                        <div>
                            <p class="font-semibold text-gray-900">Applied</p>
                            <p class="text-gray-600">{{ $application->applied_date->format('M d, Y') }}</p>
                        </div>
                    </div>
                    <div class="flex gap-3">
                        <div class="w-2 h-2 bg-purple-600 rounded-full mt-1.5 flex-shrink-0"></div>
                        <div>
                            <p class="font-semibold text-gray-900">Interview Scheduled</p>
                            <p class="text-gray-600">{{ $application->scheduled_date->format('M d, Y') }}</p>
                        </div>
                    </div>
                    @if($application->interview_completed_at)
                    <div class="flex gap-3">
                        <div class="w-2 h-2 bg-emerald-600 rounded-full mt-1.5 flex-shrink-0"></div>
                        <div>
                            <p class="font-semibold text-gray-900">Interview Completed</p>
                            <p class="text-gray-600">{{ $application->interview_completed_at->format('M d, Y') }}</p>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Reschedule Modal -->
<div id="rescheduleModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4">
    <div class="bg-white rounded-xl shadow-2xl max-w-md w-full p-6">
        <h2 class="text-2xl font-bold text-gray-900 mb-4">Reschedule Interview</h2>
        <form id="rescheduleForm" method="POST" action="{{ route('employer.interviews.schedule', $application->id) }}" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">New Date & Time</label>
                <input type="datetime-local" name="scheduled_date" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500" value="{{ $application->scheduled_date->format('Y-m-d\TH:i') }}">
            </div>
            <div class="flex gap-2">
                <button type="button" onclick="closeRescheduleModal()" class="flex-1 px-4 py-2 bg-gray-200 text-gray-900 rounded-lg hover:bg-gray-300 transition-all duration-300 font-semibold">
                    Cancel
                </button>
                <button type="submit" class="flex-1 px-4 py-2 bg-gradient-to-r from-purple-600 to-purple-700 text-white rounded-lg hover:shadow-lg transition-all duration-300 font-semibold">
                    Reschedule
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Outcome Modal -->
<div id="outcomeModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4">
    <div class="bg-white rounded-xl shadow-2xl max-w-md w-full p-6">
        <h2 class="text-2xl font-bold text-gray-900 mb-4">Set Interview Outcome</h2>
        <form id="outcomeForm" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Outcome</label>
                <select name="interview_outcome" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
                    <option value="">Select outcome</option>
                    <option value="selected">Selected</option>
                    <option value="rejected">Rejected</option>
                    <option value="pending">Pending</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Feedback</label>
                <textarea name="feedback" placeholder="Add interview feedback..." class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500" rows="3"></textarea>
            </div>
            <div class="flex gap-2">
                <button type="button" onclick="closeOutcomeModal()" class="flex-1 px-4 py-2 bg-gray-200 text-gray-900 rounded-lg hover:bg-gray-300 transition-all duration-300 font-semibold">
                    Cancel
                </button>
                <button type="submit" class="flex-1 px-4 py-2 bg-gradient-to-r from-emerald-600 to-emerald-700 text-white rounded-lg hover:shadow-lg transition-all duration-300 font-semibold">
                    Save
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function openRescheduleModal() {
    document.getElementById('rescheduleModal').classList.remove('hidden');
}

function closeRescheduleModal() {
    document.getElementById('rescheduleModal').classList.add('hidden');
}

function openOutcomeModal() {
    document.getElementById('outcomeModal').classList.remove('hidden');
}

function closeOutcomeModal() {
    document.getElementById('outcomeModal').classList.add('hidden');
}

document.getElementById('outcomeForm').addEventListener('submit', async (e) => {
    e.preventDefault();
    const formData = new FormData(e.target);
    
    try {
        const response = await fetch(`/employer/interviews/{{ $application->id }}/outcome`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
            },
            body: JSON.stringify({
                interview_outcome: formData.get('interview_outcome'),
                feedback: formData.get('feedback'),
            }),
        });

        if (response.ok) {
            closeOutcomeModal();
            location.reload();
        }
    } catch (error) {
        console.error('Error saving outcome:', error);
    }
});
</script>
@endsection
