@extends('layouts.jobseeker')

@section('title', 'Messages')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="bg-gradient-to-r from-indigo-600 to-purple-600 rounded-lg shadow-lg p-6">
        <div>
            <h1 class="text-3xl font-bold text-white mb-2">Messages</h1>
            <p class="text-indigo-100">Communicate with employers and recruiters</p>
        </div>
    </div>

    <!-- Messages Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Conversations List -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-xl shadow-lg p-4">
                <h2 class="text-lg font-bold text-gray-900 mb-4">Conversations</h2>
                <div class="space-y-2">
                    <!-- Sample Conversation -->
                    <div class="p-3 bg-blue-50 rounded-lg border-l-4 border-blue-600 cursor-pointer hover:bg-blue-100 transition">
                        <p class="font-semibold text-gray-900 text-sm">Tech Innovations Inc.</p>
                        <p class="text-xs text-gray-600 mt-1 truncate">Thanks for your application...</p>
                        <p class="text-xs text-gray-500 mt-1">2 hours ago</p>
                    </div>
                    <div class="p-3 bg-gray-50 rounded-lg border-l-4 border-gray-300 cursor-pointer hover:bg-gray-100 transition">
                        <p class="font-semibold text-gray-900 text-sm">Digital Solutions Ltd.</p>
                        <p class="text-xs text-gray-600 mt-1 truncate">We would like to schedule...</p>
                        <p class="text-xs text-gray-500 mt-1">1 day ago</p>
                    </div>
                    <div class="p-3 bg-gray-50 rounded-lg border-l-4 border-gray-300 cursor-pointer hover:bg-gray-100 transition">
                        <p class="font-semibold text-gray-900 text-sm">Enterprise Systems Co.</p>
                        <p class="text-xs text-gray-600 mt-1 truncate">Thank you for your interest...</p>
                        <p class="text-xs text-gray-500 mt-1">3 days ago</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Message Thread -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-xl shadow-lg p-6 flex flex-col h-full">
                <div class="border-b border-gray-200 pb-4 mb-4">
                    <h2 class="text-xl font-bold text-gray-900">Tech Innovations Inc.</h2>
                    <p class="text-sm text-gray-600">Senior React Developer Position</p>
                </div>

                <!-- Messages -->
                <div class="flex-1 space-y-4 mb-4 overflow-y-auto max-h-96">
                    <!-- Employer Message -->
                    <div class="flex gap-3">
                        <div class="w-10 h-10 rounded-full bg-blue-600 flex items-center justify-center text-white font-bold flex-shrink-0">
                            T
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-gray-900">Sarah Johnson</p>
                            <div class="mt-1 p-3 bg-gray-100 rounded-lg">
                                <p class="text-sm text-gray-800">Thanks for your application! We're impressed with your profile and would like to move forward with an interview.</p>
                            </div>
                            <p class="text-xs text-gray-500 mt-1">2 hours ago</p>
                        </div>
                    </div>

                    <!-- Your Message -->
                    <div class="flex gap-3 justify-end">
                        <div class="text-right">
                            <p class="text-sm font-semibold text-gray-900">You</p>
                            <div class="mt-1 p-3 bg-blue-600 text-white rounded-lg">
                                <p class="text-sm">Thank you for the opportunity! I'm very interested in this position.</p>
                            </div>
                            <p class="text-xs text-gray-500 mt-1">1 hour ago</p>
                        </div>
                        <div class="w-10 h-10 rounded-full bg-green-600 flex items-center justify-center text-white font-bold flex-shrink-0">
                            Y
                        </div>
                    </div>

                    <!-- Employer Message -->
                    <div class="flex gap-3">
                        <div class="w-10 h-10 rounded-full bg-blue-600 flex items-center justify-center text-white font-bold flex-shrink-0">
                            T
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-gray-900">Sarah Johnson</p>
                            <div class="mt-1 p-3 bg-gray-100 rounded-lg">
                                <p class="text-sm text-gray-800">Great! We'll send you the interview details shortly. The interview will be conducted via video call.</p>
                            </div>
                            <p class="text-xs text-gray-500 mt-1">30 minutes ago</p>
                        </div>
                    </div>
                </div>

                <!-- Message Input -->
                <div class="border-t border-gray-200 pt-4">
                    <div class="flex gap-2">
                        <input type="text" placeholder="Type your message..." class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition">
                        <button class="px-4 py-2 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition">
                            <i class="fas fa-paper-plane"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
