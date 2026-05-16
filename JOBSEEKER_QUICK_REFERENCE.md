# Job Seeker Dashboard - Quick Reference Guide

## File Structure

### Views (resources/views/jobseeker/)
```
jobseeker/
├── index.blade.php              # Dashboard page
├── profile.blade.php            # Profile view page
├── browse-jobs.blade.php        # Browse and search jobs
├── applications.blade.php       # View applications with status
├── saved-jobs.blade.php         # Saved jobs collection
├── resume.blade.php             # Resume management
├── interviews.blade.php         # Scheduled interviews
├── messages.blade.php           # Messaging interface
├── notifications.blade.php      # Notifications feed
└── settings.blade.php           # Account settings
```

### Controllers (app/Http/Controllers/Seeker/)
```
Seeker/
├── DashboardController.php      # Dashboard statistics and data
├── BrowseJobsController.php     # Job search and filtering
├── ApplicationsController.php    # Application management
├── SavedJobsController.php      # Saved jobs listing
├── InterviewsController.php     # Interview tracking
├── MessagesController.php       # Messaging system
├── ResumeController.php         # Resume management
├── SettingsController.php       # Account settings
├── NotificationController.php   # Notifications (existing)
└── ProfileController.php        # Profile management (existing)
```

### Routes (routes/web.php)
```php
Route::prefix('seeker')->middleware(['auth', 'seeker'])->name('seeker.')->group(function () {
    Route::get('/dashboard', [SeekerDashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [JobSeekerProfileController::class, 'show'])->name('profile');
    Route::get('/browse-jobs', [BrowseJobsController::class, 'index'])->name('browse-jobs');
    Route::get('/applications', [ApplicationsController::class, 'index'])->name('applications');
    Route::get('/saved-jobs', [SavedJobsController::class, 'index'])->name('saved-jobs');
    Route::get('/resume', [ResumeController::class, 'index'])->name('resume');
    Route::get('/interviews', [InterviewsController::class, 'index'])->name('interviews');
    Route::get('/messages', [MessagesController::class, 'index'])->name('messages');
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications');
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings');
    // ... other routes
});
```

## Navigation Links

All pages are accessible via the sidebar in `resources/views/partials/jobseeker-sidenav.blade.php`:

| Page | Route | Icon |
|------|-------|------|
| Dashboard | `/seeker/dashboard` | fa-home |
| Profile | `/seeker/profile` | fa-user |
| Browse Jobs | `/seeker/browse-jobs` | fa-search |
| Applications | `/seeker/applications` | fa-file-alt |
| Saved Jobs | `/seeker/saved-jobs` | fa-bookmark |
| Resume | `/seeker/resume` | fa-file-pdf |
| Interviews | `/seeker/interviews` | fa-calendar-check |
| Messages | `/seeker/messages` | fa-envelope |
| Notifications | `/seeker/notifications` | fa-bell |
| Settings | `/seeker/settings` | fa-cog |

## Key Features by Page

### Dashboard
- Welcome header with user greeting
- 8 metrics cards with real-time data
- Interactive charts (Overview, Applications, Jobs tabs)
- Recent activity sections
- Profile completion percentage

### Profile
- User information display
- Skills section
- Experience section
- Education section
- Quick action buttons
- Profile statistics

### Browse Jobs
- Advanced search (title, location, type, salary)
- Job cards with company info
- Save/bookmark functionality
- Pagination
- Empty state handling

### Applications
- Status statistics
- Filter by status (Pending, Shortlisted, Interview, Rejected)
- Application cards with details
- Color-coded status badges
- Pagination

### Saved Jobs
- Grid layout of saved jobs
- Quick apply buttons
- Remove from saved
- Deadline information
- Empty state

### Resume
- Current resume display
- Download functionality
- Upload/replace option
- Resume tips
- File requirements
- Statistics

### Interviews
- Interview statistics
- Upcoming vs completed
- Date, time, location, type
- Add to calendar
- Interview notes
- Pagination

### Messages
- Conversation list
- Message thread
- Message input
- Timestamps
- Employer/seeker differentiation

### Notifications
- Filter tabs
- Notification cards
- Read/unread status
- Action buttons
- Timestamps

### Settings
- Account settings
- Security (password change, 2FA)
- Notification preferences
- Privacy settings
- Danger zone

## Database Queries

### Browse Jobs
```php
Job::where('status', 'open')
   ->search($request->search)
   ->where('location', 'like', "%{$request->location}%")
   ->where('job_type', $request->job_type)
   ->where('salary_min', '>=', $request->salary_min)
   ->where('salary_max', '<=', $request->salary_max)
   ->with('employer')
   ->latest()
   ->paginate(15);
```

### Applications
```php
Application::where('job_seeker_id', $user->id)
           ->with('job.employer')
           ->where('status', $request->status)
           ->latest()
           ->paginate(20);
```

### Saved Jobs
```php
SavedJob::where('job_seeker_id', $user->id)
        ->with('job.employer')
        ->latest()
        ->paginate(15);
```

### Interviews
```php
Application::where('job_seeker_id', $user->id)
           ->where('status', 'interview')
           ->with('job.employer')
           ->latest()
           ->paginate(20);
```

## Styling

### Color Scheme
- Primary Blue: `#2563eb` (bg-blue-600)
- Success Green: `#16a34a` (bg-green-600)
- Warning Orange: `#ea580c` (bg-orange-600)
- Danger Red: `#dc2626` (bg-red-600)
- Info Purple: `#7c3aed` (bg-purple-600)

### Common Classes
- Headers: `bg-gradient-to-r from-[color]-600 to-[color]-600`
- Cards: `bg-white rounded-xl shadow-lg p-6`
- Buttons: `px-4 py-2 bg-[color]-600 text-white rounded-lg font-semibold hover:bg-[color]-700 transition`
- Badges: `px-3 py-1 bg-[color]-100 text-[color]-700 rounded-full text-xs font-semibold`

## Middleware

All seeker routes are protected by:
1. `auth` - User must be authenticated
2. `seeker` - User must have 'seeker' role

## Pagination

All list pages support pagination:
- Browse Jobs: 15 items per page
- Applications: 20 items per page
- Saved Jobs: 15 items per page
- Interviews: 20 items per page
- Notifications: 20 items per page

## Search & Filters

### Browse Jobs
- Search: Title, description, location, requirements
- Location: Exact match
- Job Type: Exact match
- Salary Min/Max: Range filter

### Applications
- Status: Pending, Shortlisted, Interview, Rejected

### Notifications
- Type: All, Applications, Interviews, Messages, System

## Common Patterns

### Empty State
```blade
<div class="bg-white rounded-xl shadow-lg p-12 text-center">
    <i class="fas fa-[icon] text-6xl text-gray-300 mb-4 block"></i>
    <h3 class="text-2xl font-bold text-gray-900 mb-2">No items found</h3>
    <p class="text-gray-600 mb-6">Description</p>
    <a href="{{ route('...') }}" class="inline-block px-6 py-3 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition">
        Action
    </a>
</div>
```

### Status Badge
```blade
<span class="px-4 py-2 rounded-full font-semibold text-sm {{ $statusColors[$status]['badge'] }}">
    <i class="{{ $statusColors[$status]['icon'] }} mr-1"></i>{{ ucfirst($status) }}
</span>
```

### Card Layout
```blade
<div class="bg-white rounded-xl shadow-lg hover:shadow-xl transition p-6 border-l-4 border-[color]-600">
    <!-- Content -->
</div>
```

## Testing Checklist

- [ ] All routes accessible with authentication
- [ ] Sidebar navigation works correctly
- [ ] Active link highlighting works
- [ ] Search and filters work on browse jobs
- [ ] Pagination works on all list pages
- [ ] Status filters work on applications
- [ ] Save/unsave jobs works
- [ ] Empty states display correctly
- [ ] Responsive design on mobile
- [ ] All buttons and links functional
- [ ] Data displays correctly from database
- [ ] No console errors

## Future Enhancements

1. Real-time messaging with WebSockets
2. Interview scheduling with calendar
3. Resume parsing and analysis
4. AI job recommendations
5. Application analytics
6. Email notifications
7. Mobile app
8. Advanced search filters
9. Job alerts
10. Profile strength indicator
