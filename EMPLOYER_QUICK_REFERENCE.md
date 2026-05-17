# Employer Functionalities - Quick Reference Guide

## File Structure

```
app/
├── Http/Controllers/Employer/
│   ├── DashboardController.php      ✅ Dashboard with metrics
│   ├── ApplicationController.php    ✅ Application management
│   ├── ProfileController.php        ✅ Profile management
│   ├── InterviewsController.php     ✅ Interview management
│   ├── MessagesController.php       ✅ Messaging system
│   ├── NotificationsController.php  ✅ Notifications
│   └── SettingsController.php       ✅ Settings & preferences
│
├── Models/
│   ├── Job.php                      ✅ Job model
│   ├── Application.php              ✅ Application model
│   ├── EmployerProfile.php          ✅ Employer profile model
│   ├── Notification.php             ✅ Notification model
│   └── User.php                     ✅ User model
│
└── Enums/
    ├── JobStatus.php                ✅ Job status enum
    ├── JobType.php                  ✅ Job type enum
    ├── ApplicationStatus.php         ✅ Application status enum
    └── NotificationChannel.php       ✅ Notification channel enum

resources/views/employer/
├── dashboard.blade.php              ✅ Dashboard view
├── applications.blade.php           ✅ Applications list
├── applications-show.blade.php      ✅ Application details
├── profile.blade.php                ✅ Profile view
├── profile-edit.blade.php           ✅ Profile edit form
├── interviews.blade.php             ✅ Interviews list
├── messages.blade.php               ✅ Messages view
├── notifications.blade.php          ✅ Notifications list
└── settings.blade.php               ✅ Settings view

resources/views/jobs/
├── create.blade.php                 ✅ Create job form
├── edit.blade.php                   ✅ Edit job form
├── _form.blade.php                  ✅ Job form component
├── employer-index.blade.php         ✅ Employer jobs list
└── show.blade.php                   ✅ Job details view
```

## Key Routes

```php
// Dashboard
GET /employer/dashboard

// Profile Management
GET    /employer/profile
GET    /employer/profile/edit
PUT    /employer/profile

// Job Management
GET    /jobs/create
POST   /jobs
GET    /jobs/{job}
GET    /jobs/{job}/edit
PUT    /jobs/{job}
DELETE /jobs/{job}

// Application Management
GET    /employer/applications
GET    /employer/applications/{application}
PATCH  /employer/applications/{application}/status

// Interview Management
GET /employer/interviews

// Messaging
GET /employer/messages

// Notifications
GET   /employer/notifications
PATCH /employer/notifications/{notification}/read

// Settings
GET /employer/settings
```

## Controller Methods

### DashboardController
```php
public function index(Request $request): View
// Returns dashboard with stats, recent jobs, applications, notifications
```

### ApplicationController
```php
public function index(Request $request): View
// List all applications with filtering and search

public function show(Request $request, Application $application): View
// Show application details

public function update(Request $request, Application $application): RedirectResponse
// Update application status and notes
```

### ProfileController
```php
public function show(Request $request): View
// Display employer profile

public function edit(Request $request): View
// Show profile edit form

public function update(Request $request): RedirectResponse
// Update profile information
```

### InterviewsController
```php
public function index(Request $request): View
// List interviews with statistics
```

### MessagesController
```php
public function index(Request $request): View
// List conversations with candidates
```

### NotificationsController
```php
public function index(Request $request): View
// List notifications with filtering

public function markRead(Request $request, Notification $notification): RedirectResponse
// Mark notification as read
```

### SettingsController
```php
public function index(Request $request): View
// Display settings page

public function updateNotifications(Request $request): RedirectResponse
// Update notification preferences

public function updatePassword(Request $request): RedirectResponse
// Update password
```

## Data Structures

### Dashboard Stats
```php
$stats = [
    'active_jobs' => int,
    'jobs_this_month' => int,
    'total_applications' => int,
    'pending_applications' => int,
    'shortlisted' => int,
    'interviews' => int,
]
```

### Application Status Values
```
'pending'    - Initial status
'reviewed'   - Employer has reviewed
'shortlisted' - Candidate shortlisted
'interview'  - Interview scheduled
'rejected'   - Application rejected
'hired'      - Candidate hired
```

### Job Type Values
```
'full-time'
'part-time'
'contract'
'internship'
```

### Job Status Values
```
'open'   - Accepting applications
'closed' - Not accepting applications
```

## Validation Rules

### Job Creation/Update
```php
'title' => 'required|string|max:255',
'description' => 'required|string|max:5000',
'requirements' => 'required|string|max:5000',
'location' => 'required|string|max:255',
'salary_min' => 'nullable|numeric|decimal:2',
'salary_max' => 'nullable|numeric|decimal:2',
'job_type' => 'required|in:full-time,part-time,contract,internship',
'deadline' => 'nullable|date',
'status' => 'required|in:open,closed',
```

### Profile Update
```php
'company_name' => 'required|string|max:255',
'industry' => 'required|string',
'company_size' => 'required|string',
'location' => 'required|string|max:255',
'phone' => 'nullable|string|max:20',
'website' => 'nullable|url',
'description' => 'nullable|string|max:2000',
'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
```

### Application Status Update
```php
'status' => 'required|in:pending,reviewed,shortlisted,interview,rejected,hired',
'employer_notes' => 'nullable|string|max:1000',
```

## Query Examples

### Get Employer's Jobs
```php
$jobs = Job::where('employer_id', $userId)
    ->withCount('applications')
    ->latest()
    ->paginate(10);
```

### Get Employer's Applications
```php
$applications = Application::whereHas('job', 
    fn($q) => $q->where('employer_id', $userId)
)
->with(['seeker', 'job'])
->latest()
->paginate(15);
```

### Get Employer's Notifications
```php
$notifications = Notification::where('user_id', $userId)
    ->latest()
    ->paginate(20);
```

### Get Shortlisted Candidates
```php
$shortlisted = Application::whereHas('job', 
    fn($q) => $q->where('employer_id', $userId)
)
->where('status', 'shortlisted')
->count();
```

## Authorization Checks

### In Controller
```php
// Check if user owns the job
if ($job->employer_id !== $request->user()->id) {
    abort(403);
}

// Using policy
$this->authorize('update', $application);
```

### In Blade
```blade
@can('update', $application)
    <!-- Show update button -->
@endcan
```

## Common Patterns

### Filtering Applications
```php
$applications = Application::whereHas('job', fn($q) => $q->where('employer_id', $userId))
    ->when($request->search, fn($q) => 
        $q->whereHas('seeker', fn($sq) => 
            $sq->where('name', 'like', '%' . $request->search . '%')
        )
    )
    ->when($request->status, fn($q) => $q->where('status', $request->status))
    ->when($request->job_id, fn($q) => $q->where('job_id', $request->job_id))
    ->latest()
    ->paginate(15);
```

### Calculating Profile Completion
```php
$fields = ['company_name', 'industry', 'location', 'description', 'website'];
$completed = collect($fields)->filter(fn($field) => !empty($profile->$field))->count();
$percentage = (int)(($completed / count($fields)) * 100);
```

### Sending Notifications
```php
Notification::create([
    'user_id' => $userId,
    'type' => 'application',
    'subject' => 'New Application',
    'message' => 'You have a new application',
    'is_read' => false,
]);
```

## Testing Checklist

- [ ] Dashboard loads with correct stats
- [ ] Can create job posting
- [ ] Can edit job posting
- [ ] Can delete job posting
- [ ] Can view applications
- [ ] Can update application status
- [ ] Can view application details
- [ ] Can update profile
- [ ] Can upload profile picture
- [ ] Can view interviews
- [ ] Can send messages
- [ ] Can view notifications
- [ ] Can mark notifications as read
- [ ] Can update settings
- [ ] Authorization works correctly
- [ ] Validation works correctly
- [ ] Pagination works correctly
- [ ] Search and filtering work correctly

## Debugging Tips

### Check User Role
```php
dd($request->user()->role); // Should be 'employer'
```

### Check Job Ownership
```php
dd($job->employer_id === $request->user()->id);
```

### Check Application Count
```php
dd(Application::whereHas('job', fn($q) => $q->where('employer_id', $userId))->count());
```

### Check Notifications
```php
dd(Notification::where('user_id', $userId)->latest()->get());
```

## Performance Optimization

### Use Eager Loading
```php
$applications = Application::with(['seeker', 'job'])->get();
```

### Use Pagination
```php
$applications = Application::paginate(15);
```

### Use Indexes
```sql
CREATE INDEX idx_job_employer_id ON jobs(employer_id);
CREATE INDEX idx_application_job_id ON applications(job_id);
CREATE INDEX idx_notification_user_id ON notifications(user_id);
```

### Cache Dashboard Stats
```php
$stats = Cache::remember('employer_stats_' . $userId, 3600, function() {
    return [
        'active_jobs' => Job::where('employer_id', $userId)->count(),
        // ... other stats
    ];
});
```

## Common Issues & Solutions

### Applications not showing
- Check if jobs are posted
- Verify job status is 'open'
- Check employer_id matches

### Profile picture not uploading
- Check file size (max 5MB)
- Verify file format
- Check storage permissions

### Notifications not appearing
- Check notification settings
- Verify user_id is correct
- Check delivery status

### Authorization errors
- Verify user is logged in
- Check user role is 'employer'
- Verify resource ownership

## Resources

- [Laravel Documentation](https://laravel.com/docs)
- [Blade Templating](https://laravel.com/docs/blade)
- [Eloquent ORM](https://laravel.com/docs/eloquent)
- [Authorization](https://laravel.com/docs/authorization)
- [Validation](https://laravel.com/docs/validation)
