@extends('layouts.jobseeker')

@section('title', 'Messages')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="bg-gradient-to-r from-indigo-600 to-purple-600 rounded-lg shadow-lg p-6">
        <h1 class="text-3xl md:text-4xl font-bold text-white mb-2">Messages</h1>
        <p class="text-indigo-100">Communicate with employers and recruiters</p>
    </div>

    <!-- Messages Container -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Conversations List -->
        <div class="lg:col-span-1 bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="p-4 border-b border-gray-200">
                <h2 class="text-lg font-bold text-gray-800">Conversations</h2>
            </div>
            <div class="divide-y divide-gray-200">
                <div class="p-4 hover:bg-gray-50 cursor-pointer transition border-l-4 border-blue-600">
                    <div class="flex items-center justify-between">
                        <div class="flex-1">
                            <h3 class="font-semibold text-gray-900">Tech Company Inc.</h3>
                            <p class="text-sm text-gray-600 truncate">Thanks for your application...</p>
                        </div>
                        <span class="bg-blue-600 text-white text-xs px-2 py-1 rounded-full">1</span>
                    </div>
                </div>
                <div class="p-4 hover:bg-gray-50 cursor-pointer transition">
                    <div class="flex items-center justify-between">
                        <div class="flex-1">
                            <h3 class="font-semibold text-gray-900">Startup Solutions</h3>
                            <p class="text-sm text-gray-600 truncate">We would like to schedule...</p>
                        </div>
                    </div>
                </div>
                <div class="p-4 hover:bg-gray-50 cursor-pointer transition">
                    <div class="flex items-center justify-between">
                        <div class="flex-1">
                            <h3 class="font-semibold text-gray-900">Global Enterprises</h3>
                            <p class="text-sm text-gray-600 truncate">Your profile looks great...</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Chat Area -->
        <div class="lg:col-span-2 bg-white rounded-xl shadow-lg overflow-hidden flex flex-col">
            <!-- Chat Header -->
            <div class="p-4 border-b border-gray-200 bg-gray-50">
                <h3 class="text-lg font-bold text-gray-900">Tech Company Inc.</h3>
                <p class="text-sm text-gray-600">Hiring Manager</p>
            </div>

            <!-- Messages -->
            <div class="flex-1 p-4 overflow-y-auto space-y-4">
                <div class="flex justify-start">
                    <div class="bg-gray-100 rounded-lg p-3 max-w-xs">
                        <p class="text-gray-800">Thanks for your application! We're impressed with your profile.</p>
                        <p class="text-xs text-gray-500 mt-1">10:30 AM</p>
                    </div>
                </div>
                <div class="flex justify-end">
                    <div class="bg-blue-600 text-white rounded-lg p-3 max-w-xs">
                        <p>Thank you! I'm very interested in this opportunity.</p>
                        <p class="text-xs text-blue-100 mt-1">10:45 AM</p>
                    </div>
                </div>
                <div class="flex justify-start">
                    <div class="bg-gray-100 rounded-lg p-3 max-w-xs">
                        <p class="text-gray-800">Would you be available for an interview next week?</p>
                        <p class="text-xs text-gray-500 mt-1">11:00 AM</p>
                    </div>
                </div>
            </div>

            <!-- Message Input -->
            <div class="p-4 border-t border-gray-200 bg-gray-50">
                <div class="flex gap-2">
                    <input type="text" placeholder="Type your message..." class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600">
                    <button class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-semibold">
                        <i class="fas fa-paper-plane\"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
