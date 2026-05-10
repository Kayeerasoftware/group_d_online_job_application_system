@php
    $job = $job ?? new \App\Models\Job();
    $inputClass = 'w-full rounded-2xl border border-white/10 bg-slate-950/80 px-4 py-3 text-slate-100 placeholder:text-slate-500 outline-none transition focus:border-cyan-400/60 focus:ring-2 focus:ring-cyan-400/20';
    $labelClass = 'block text-xs uppercase tracking-[0.3em] text-slate-500';
    $jobType = $job->job_type instanceof \App\Enums\JobType ? $job->job_type->value : $job->job_type;
    $status = $job->status instanceof \App\Enums\JobStatus ? $job->status->value : $job->status;
@endphp

<form class="mt-6 grid gap-6 lg:grid-cols-[1.4fr_0.8fr]" method="post" action="{{ isset($job) && $job->exists ? route('jobs.update', $job) : route('jobs.store') }}">
    @csrf
    @if(isset($job) && $job->exists)
        @method('put')
    @endif

    <x-ui.panel tone="inset" class="p-5 md:p-6">
        <div class="flex items-center justify-between gap-3 border-b border-white/10 pb-4">
            <div>
                <p class="text-xs font-semibold uppercase tracking-[0.35em] text-cyan-300/70">Job details</p>
                <h2 class="mt-2 text-lg font-semibold text-white">Describe the opening clearly</h2>
            </div>
            <span class="rounded-full border border-white/10 bg-white/5 px-3 py-1 text-xs font-semibold uppercase tracking-[0.25em] text-slate-200">
                Required information
            </span>
        </div>

        <div class="mt-5 grid gap-5 md:grid-cols-2">
            <div class="space-y-2 md:col-span-2">
                <label class="{{ $labelClass }}" for="title">Job Title</label>
                <input class="{{ $inputClass }}" id="title" name="title" placeholder="e.g. Senior Laravel Developer" value="{{ old('title', $job->title) }}">
            </div>

            <div class="space-y-2 md:col-span-2">
                <label class="{{ $labelClass }}" for="description">Job Description</label>
                <textarea class="{{ $inputClass }}" id="description" name="description" rows="6" placeholder="Describe the role, responsibilities, and what success looks like.">{{ old('description', $job->description) }}</textarea>
            </div>

            <div class="space-y-2 md:col-span-2">
                <label class="{{ $labelClass }}" for="requirements">Requirements</label>
                <textarea class="{{ $inputClass }}" id="requirements" name="requirements" rows="5" placeholder="List the must-have skills, experience, and qualifications.">{{ old('requirements', $job->requirements) }}</textarea>
            </div>

            <div class="space-y-2 md:col-span-2">
                <label class="{{ $labelClass }}" for="location">Location</label>
                <input class="{{ $inputClass }}" id="location" name="location" placeholder="Remote, Kampala, Hybrid..." value="{{ old('location', $job->location) }}">
            </div>
        </div>
    </x-ui.panel>

    <div class="space-y-6">
        <x-ui.panel tone="inset" class="p-5 md:p-6">
            <p class="text-xs font-semibold uppercase tracking-[0.35em] text-cyan-300/70">Compensation</p>
            <div class="mt-4 grid gap-4">
                <div class="space-y-2">
                    <label class="{{ $labelClass }}" for="salary_min">Minimum Salary (UGX)</label>
                    <input class="{{ $inputClass }}" id="salary_min" name="salary_min" type="number" step="0.01" placeholder="0" value="{{ old('salary_min', $job->salary_min) }}">
                </div>
                <div class="space-y-2">
                    <label class="{{ $labelClass }}" for="salary_max">Maximum Salary (UGX)</label>
                    <input class="{{ $inputClass }}" id="salary_max" name="salary_max" type="number" step="0.01" placeholder="0" value="{{ old('salary_max', $job->salary_max) }}">
                </div>
            </div>
        </x-ui.panel>

        <x-ui.panel tone="inset" class="p-5 md:p-6">
            <p class="text-xs font-semibold uppercase tracking-[0.35em] text-cyan-300/70">Publishing</p>
            <div class="mt-4 grid gap-4">
                <div class="space-y-2">
                    <label class="{{ $labelClass }}" for="job_type">Job Type</label>
                    <select class="{{ $inputClass }}" id="job_type" name="job_type">
                        @foreach(['full-time','part-time','contract','internship'] as $type)
                            <option value="{{ $type }}" @selected(old('job_type', $jobType) === $type)>{{ ucfirst($type) }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="space-y-2">
                    <label class="{{ $labelClass }}" for="deadline">Application Deadline</label>
                    <input class="{{ $inputClass }}" id="deadline" name="deadline" type="date" value="{{ old('deadline', optional($job->deadline)->format('Y-m-d')) }}">
                </div>

                <div class="space-y-2">
                    <label class="{{ $labelClass }}" for="status">Status</label>
                    <select class="{{ $inputClass }}" id="status" name="status">
                        @foreach(['open','closed'] as $item)
                            <option value="{{ $item }}" @selected(old('status', $status) === $item)>{{ ucfirst($item) }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </x-ui.panel>

        <x-ui.panel tone="soft" class="p-5 md:p-6">
            <p class="text-xs font-semibold uppercase tracking-[0.35em] text-cyan-300/70">Tips</p>
            <ul class="mt-4 space-y-3 text-sm leading-6 text-slate-300">
                <li>Use a clear title so seekers can scan roles quickly.</li>
                <li>Keep responsibilities and requirements separate for readability.</li>
                <li>Open jobs invite more applications, closed jobs preserve older listings.</li>
            </ul>
        </x-ui.panel>

        <div class="flex items-center justify-end gap-3">
            <button class="inline-flex items-center justify-center rounded-2xl bg-cyan-400 px-5 py-3 text-sm font-semibold text-slate-950 transition hover:bg-cyan-300" type="submit">
                Save Job
            </button>
        </div>
    </div>
</form>
