<div class="row g-3">
    <div class="col-md-8">
        <label class="form-label fw-semibold">Job Title <span class="text-danger">*</span></label>
        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
               value="{{ old('title', $job->title ?? '') }}" required>
        @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="col-md-4">
        <label class="form-label fw-semibold">Job Type <span class="text-danger">*</span></label>
        <select name="job_type" class="form-select @error('job_type') is-invalid @enderror" required>
            @foreach(['full-time','part-time','contract','remote'] as $type)
                <option value="{{ $type }}" {{ old('job_type', $job->job_type ?? '') === $type ? 'selected' : '' }}>
                    {{ ucfirst($type) }}
                </option>
            @endforeach
        </select>
        @error('job_type')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="col-md-6">
        <label class="form-label fw-semibold">Company Name <span class="text-danger">*</span></label>
        <input type="text" name="company_name" class="form-control @error('company_name') is-invalid @enderror"
               value="{{ old('company_name', $job->company_name ?? '') }}" required>
        @error('company_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="col-md-6">
        <label class="form-label fw-semibold">Location <span class="text-danger">*</span></label>
        <input type="text" name="location" class="form-control @error('location') is-invalid @enderror"
               value="{{ old('location', $job->location ?? '') }}" placeholder="e.g. Kampala, Uganda" required>
        @error('location')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="col-md-6">
        <label class="form-label fw-semibold">Salary (UGX) <span class="text-danger">*</span></label>
        <input type="number" name="salary" class="form-control @error('salary') is-invalid @enderror"
               value="{{ old('salary', $job->salary ?? '') }}" min="0" step="1000" required>
        @error('salary')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="col-md-6">
        <label class="form-label fw-semibold">Application Deadline</label>
        <input type="date" name="deadline" class="form-control @error('deadline') is-invalid @enderror"
               value="{{ old('deadline', isset($job->deadline) ? $job->deadline->format('Y-m-d') : '') }}">
        @error('deadline')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="col-12">
        <label class="form-label fw-semibold">Job Description <span class="text-danger">*</span></label>
        <textarea name="description" class="form-control @error('description') is-invalid @enderror"
                  rows="8" placeholder="Describe the role, responsibilities, and requirements..." required>{{ old('description', $job->description ?? '') }}</textarea>
        @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
</div>
