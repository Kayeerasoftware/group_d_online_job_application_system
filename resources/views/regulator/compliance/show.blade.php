@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="mb-8">
        <a href="{{ route('regulator.compliance.index') }}" class="text-blue-600 hover:text-blue-900 font-medium mb-4 inline-block">
            ← Back to Reports
        </a>
        <h1 class="text-3xl font-bold text-gray-900">Compliance Report #{{ $report->id }}</h1>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Content -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-lg shadow p-6 mb-6">
                <h2 class="text-xl font-semibold text-gray-900 mb-4">Report Details</h2>
                <div class="space-y-4">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm text-gray-600">Report Type</p>
                            <p class="text-lg font-medium text-gray-900">{{ ucfirst($report->report_type) }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Status</p>
                            <p class="text-lg font-medium">
                                <span class="px-3 py-1 rounded-full text-sm font-medium
                                    @if($report->status === 'pending') bg-yellow-100 text-yellow-800
                                    @elseif($report->status === 'submitted') bg-blue-100 text-blue-800
                                    @elseif($report->status === 'approved') bg-green-100 text-green-800
                                    @else bg-red-100 text-red-800
                                    @endif">
                                    {{ ucfirst($report->status) }}
                                </span>
                            </p>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm text-gray-600">Submitted By</p>
                            <p class="text-lg font-medium text-gray-900">{{ $report->user->name ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Submitted Date</p>
                            <p class="text-lg font-medium text-gray-900">{{ $report->created_at->format('M d, Y H:i') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Report Content -->
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-xl font-semibold text-gray-900 mb-4">Report Content</h2>
                <div class="prose prose-sm max-w-none">
                    {!! nl2br(e($report->content)) !!}
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div>
            <div class="bg-white rounded-lg shadow p-6 sticky top-4">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Actions</h3>
                <div class="space-y-3">
                    @if($report->file_path)
                        <a href="{{ route('regulator.compliance.show', $report) }}" class="block w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded text-center transition">
                            Download Report
                        </a>
                    @endif
                    <a href="{{ route('regulator.compliance.index') }}" class="block w-full bg-gray-600 hover:bg-gray-700 text-white font-medium py-2 px-4 rounded text-center transition">
                        Back to List
                    </a>
                </div>

                <div class="mt-6 pt-6 border-t border-gray-200">
                    <h4 class="font-semibold text-gray-900 mb-3">Report Metadata</h4>
                    <div class="space-y-2 text-sm">
                        <div>
                            <p class="text-gray-600">Created</p>
                            <p class="text-gray-900">{{ $report->created_at->format('M d, Y') }}</p>
                        </div>
                        <div>
                            <p class="text-gray-600">Last Updated</p>
                            <p class="text-gray-900">{{ $report->updated_at->format('M d, Y') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
