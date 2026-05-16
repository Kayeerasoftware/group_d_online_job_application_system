@extends('layouts.jobseeker')

@section('title', 'Interviews')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="bg-gradient-to-r from-orange-600 to-red-600 rounded-lg shadow-lg p-6">
        <h1 class="text-3xl md:text-4xl font-bold text-white mb-2">Interviews</h1>
        <p class="text-orange-100">Manage your scheduled interviews</p>
    </div>

    <!-- Interviews List -->
    <div class="bg-white rounded-xl shadow-lg p-6">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Scheduled Interviews</h2>
        <div class="space-y-4">
            <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition">
                <div class="flex items-start justify-between">
                    <div class="flex-1">
                        <h3 class="text-lg font-bold text-gray-900">Senior Developer Interview</h3>
                        <p class="text-gray-600 mt-1">Tech Company Inc.</p>
                        <div class="flex items-center gap-4 mt-3 text-sm text-gray-500">
                            <span><i class="fas fa-calendar mr-2"></i>May 15, 2026</span>
                            <span><i class="fas fa-clock mr-2"></i>2:00 PM</span>
                            <span><i class="fas fa-video mr-2"></i>Video Call</span>
                        </div>
                    </div>
                    <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm font-semibold">Confirmed</span>
                </div>
            </div>

            <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition">
                <div class="flex items-start justify-between">
                    <div class="flex-1">
                        <h3 class="text-lg font-bold text-gray-900">Junior Developer Interview</h3>
                        <p class="text-gray-600 mt-1">Startup Solutions</p>
                        <div class="flex items-center gap-4 mt-3 text-sm text-gray-500">
                            <span><i class="fas fa-calendar mr-2"></i>May 20, 2026</span>
                            <span><i class="fas fa-clock mr-2"></i>10:00 AM</span>
                            <span><i class="fas fa-map-marker mr-2"></i>In-person</span>
                        </div>
                    </div>
                    <span class="px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-sm font-semibold">Pending</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Interview Tips -->
    <div class="bg-blue-50 rounded-xl shadow-lg p-6 border border-blue-200">
        <h2 class="text-xl font-bold text-blue-900 mb-4 flex items-center">
            <i class="fas fa-lightbulb text-blue-600 mr-2\"></i>Interview Tips
        </h2>
        <ul class="space-y-2 text-blue-800">
            <li class="flex items-start">
                <i class="fas fa-check text-green-600 mr-3 mt-1\"></i>
                <span>Prepare by researching the company and role</span>
            </li>
            <li class="flex items-start">
                <i class="fas fa-check text-green-600 mr-3 mt-1\"></i>
                <span>Test your audio and video setup before the call</span>
            </li>
            <li class="flex items-start">
                <i class="fas fa-check text-green-600 mr-3 mt-1\"></i>
                <span>Dress professionally and arrive 10 minutes early</span>
            </li>
            <li class="flex items-start">
                <i class="fas fa-check text-green-600 mr-3 mt-1\"></i>
                <span>Prepare questions to ask the interviewer</span>
            </li>
        </ul>
    </div>
</div>
@endsection
