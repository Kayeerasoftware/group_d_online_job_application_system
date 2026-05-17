<!-- Schedule Interview Modal -->
<div id="scheduleInterviewModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-xl shadow-2xl max-w-md w-full max-h-[90vh] overflow-y-auto">
        <!-- Header -->
        <div class="sticky top-0 bg-gradient-to-r from-emerald-600 to-teal-600 p-6 flex items-center justify-between">
            <h2 class="text-xl font-bold text-white flex items-center">
                <i class="fas fa-calendar mr-2"></i>Schedule Interview
            </h2>
            <button onclick="closeScheduleModal()" class="text-white hover:bg-white/20 p-2 rounded-lg transition">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>

        <!-- Form -->
        <form id="scheduleForm" method="POST" class="p-6 space-y-4">
            @csrf
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-calendar-alt text-emerald-600 mr-1"></i>Interview Date & Time
                </label>
                <input type="datetime-local" name="scheduled_date" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-transparent">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-video text-emerald-600 mr-1"></i>Interview Type
                </label>
                <select name="interview_type" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-transparent">
                    <option value="">Select interview type</option>
                    <option value="phone">Phone Interview</option>
                    <option value="video">Video Interview</option>
                    <option value="in-person">In-Person Interview</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-user text-emerald-600 mr-1"></i>Interviewer Name
                </label>
                <input type="text" name="interviewer_name" required placeholder="Your name" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-transparent">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-link text-emerald-600 mr-1"></i>Interview Link (for video/phone)
                </label>
                <input type="url" name="interview_link" placeholder="https://zoom.us/..." class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-transparent">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-sticky-note text-emerald-600 mr-1"></i>Notes
                </label>
                <textarea name="employer_notes" rows="3" placeholder="Add any additional notes..." class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-transparent resize-none"></textarea>
            </div>

            <!-- Buttons -->
            <div class="flex gap-3 pt-4">
                <button type="button" onclick="closeScheduleModal()" class="flex-1 px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 transition font-semibold">
                    Cancel
                </button>
                <button type="submit" class="flex-1 px-4 py-2 bg-gradient-to-r from-emerald-600 to-teal-600 text-white rounded-lg hover:shadow-lg transition font-semibold">
                    <i class="fas fa-check mr-2"></i>Schedule
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function openScheduleModal(applicationId) {
    const modal = document.getElementById('scheduleInterviewModal');
    const form = document.getElementById('scheduleForm');
    form.action = `/employer/interviews/${applicationId}/schedule`;
    modal.classList.remove('hidden');
}

function closeScheduleModal() {
    document.getElementById('scheduleInterviewModal').classList.add('hidden');
}

// Close modal when clicking outside
document.getElementById('scheduleInterviewModal')?.addEventListener('click', function(e) {
    if (e.target === this) {
        closeScheduleModal();
    }
});
</script>
