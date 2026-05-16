# 🧪 Job Seeker Dashboard - Testing Guide

## Quick Start Testing

### Step 1: Login
```
URL: http://127.0.0.1:8000/login
Action: Login with seeker credentials
Expected: Redirect to http://127.0.0.1:8000/seeker/dashboard
```

---

## Testing All Pages

### 1. Dashboard Page
```
Route Name: seeker.dashboard
URL: http://127.0.0.1:8000/seeker/dashboard
Controller: App\Http\Controllers\Seeker\DashboardController@index
View: resources/views/jobseeker/index.blade.php
Expected: Dashboard with statistics, charts, and recent activity
```

**Test Steps:**
1. Click "Dashboard" in sidebar
2. Verify page loads with:
   - Welcome header
   - 8 metrics cards
   - Charts section
   - Recent activity sections
3. Verify no console errors

---

### 2. Profile Page
```
Route Name: seeker.profile
URL: http://127.0.0.1:8000/seeker/profile
Controller: App\Http\Controllers\JobSeekerProfileController@show
View: resources/views/jobseeker/profile.blade.php
Expected: User profile information display
```

**Test Steps:**
1. Click "My Profile" in sidebar
2. Verify page displays:
   - User avatar and name
   - Profile completion percentage
   - Personal information
   - Skills section
   - Experience section
   - Education section
3. Click "Edit Profile" button → should go to /seeker/profile/edit

---

### 3. Browse Jobs Page
```
Route Name: seeker.browse-jobs
URL: http://127.0.0.1:8000/seeker/browse-jobs
Controller: App\Http\Controllers\Seeker\BrowseJobsController@index
View: resources/views/jobseeker/browse-jobs.blade.php
Expected: Job listings with search and filters
```

**Test Steps:**
1. Click "Browse Jobs" in sidebar
2. Verify page displays:
   - Search box
   - Location filter
   - Job type filter
   - Salary range filters
   - Job cards with details
3. Test search functionality:
   - Enter search term → results filter
   - Select location → results filter
   - Select job type → results filter
   - Enter salary range → results filter
4. Test pagination:
   - Click next page → loads more jobs
5. Test save job:
   - Click bookmark icon → job saved

---

### 4. Applications Page
```
Route Name: seeker.applications
URL: http://127.0.0.1:8000/seeker/applications
Controller: App\Http\Controllers\Seeker\ApplicationsController@index
View: resources/views/jobseeker/applications.blade.php
Expected: Application list with status tracking
```

**Test Steps:**
1. Click "My Applications" in sidebar
2. Verify page displays:
   - Statistics cards (Total, Pending, Shortlisted, Interview, Rejected)
   - Filter tabs
   - Application cards with status
3. Test status filters:
   - Click "Pending" tab → shows pending applications
   - Click "Shortlisted" tab → shows shortlisted applications
   - Click "Interview" tab → shows interview applications
   - Click "Rejected" tab → shows rejected applications
4. Test pagination:
   - Click next page → loads more applications

---

### 5. Saved Jobs Page
```
Route Name: seeker.saved-jobs
URL: http://127.0.0.1:8000/seeker/saved-jobs
Controller: App\Http\Controllers\Seeker\SavedJobsController@index
View: resources/views/jobseeker/saved-jobs.blade.php
Expected: Saved jobs listing
```

**Test Steps:**
1. Click "Saved Jobs" in sidebar
2. Verify page displays:
   - Saved job cards
   - Job details (title, company, location)
   - Saved date
   - Deadline information
3. Test quick apply:
   - Click "Apply Now" button → should navigate to application form
4. Test remove from saved:
   - Click bookmark icon → job removed from saved
5. Test pagination:
   - Click next page → loads more saved jobs

---

### 6. Resume Page
```
Route Name: seeker.resume
URL: http://127.0.0.1:8000/seeker/resume
Controller: App\Http\Controllers\Seeker\ResumeController@index
View: resources/views/jobseeker/resume.blade.php
Expected: Resume management interface
```

**Test Steps:**
1. Click "My Resume" in sidebar
2. Verify page displays:
   - Current resume (if uploaded)
   - Download button
   - Upload/Replace option
   - Resume tips
   - File requirements
   - Statistics
3. Test download:
   - Click "Download" button → resume downloads
4. Test upload:
   - Click "Upload Resume" → file picker opens
   - Select PDF/DOC/DOCX file → uploads

---

### 7. Interviews Page
```
Route Name: seeker.interviews
URL: http://127.0.0.1:8000/seeker/interviews
Controller: App\Http\Controllers\Seeker\InterviewsController@index
View: resources/views/jobseeker/interviews.blade.php
Expected: Scheduled interviews listing
```

**Test Steps:**
1. Click "Interviews" in sidebar
2. Verify page displays:
   - Statistics cards (Total, Upcoming, Completed)
   - Interview cards with details
   - Date, time, location, type
   - Add to calendar button
3. Test add to calendar:
   - Click "Add to Calendar" → calendar event created
4. Test pagination:
   - Click next page → loads more interviews

---

### 8. Messages Page
```
Route Name: seeker.messages
URL: http://127.0.0.1:8000/seeker/messages
Controller: App\Http\Controllers\Seeker\MessagesController@index
View: resources/views/jobseeker/messages.blade.php
Expected: Messaging interface
```

**Test Steps:**
1. Click "Messages" in sidebar
2. Verify page displays:
   - Conversation list
   - Message thread
   - Message input area
   - Timestamps
3. Test message functionality:
   - Click conversation → loads messages
   - Type message → message appears
   - Send message → message sent

---

### 9. Notifications Page
```
Route Name: seeker.notifications
URL: http://127.0.0.1:8000/seeker/notifications
Controller: App\Http\Controllers\NotificationController@index
View: resources/views/jobseeker/notifications.blade.php
Expected: Notification feed with filtering
```

**Test Steps:**
1. Click "Notifications" in sidebar
2. Verify page displays:
   - Filter tabs (All, Applications, Interviews, Messages, System)
   - Notification cards
   - Read/unread status
   - Action buttons
3. Test filters:
   - Click "Applications" tab → shows application notifications
   - Click "Interviews" tab → shows interview notifications
   - Click "Messages" tab → shows message notifications
4. Test mark as read:
   - Click "Mark as Read" → notification marked as read
5. Test pagination:
   - Click next page → loads more notifications

---

### 10. Settings Page
```
Route Name: seeker.settings
URL: http://127.0.0.1:8000/seeker/settings
Controller: App\Http\Controllers\Seeker\SettingsController@index
View: resources/views/jobseeker/settings.blade.php
Expected: Account settings interface
```

**Test Steps:**
1. Click "Settings" in sidebar
2. Verify page displays:
   - Settings menu (Account, Security, Notifications, Privacy)
   - Account settings form
3. Test account settings:
   - Update name → saves changes
   - Update email → saves changes
   - Update phone → saves changes
4. Test security settings:
   - Enter current password → validates
   - Enter new password → updates password
5. Test notification preferences:
   - Toggle notification options → preferences saved
6. Test privacy settings:
   - Toggle privacy options → preferences saved

---

## Testing Navigation Links

### Sidebar Links
```
Dashboard → http://127.0.0.1:8000/seeker/dashboard
My Profile → http://127.0.0.1:8000/seeker/profile
Browse Jobs → http://127.0.0.1:8000/seeker/browse-jobs
My Applications → http://127.0.0.1:8000/seeker/applications
Saved Jobs → http://127.0.0.1:8000/seeker/saved-jobs
My Resume → http://127.0.0.1:8000/seeker/resume
Interviews → http://127.0.0.1:8000/seeker/interviews
Messages → http://127.0.0.1:8000/seeker/messages
Notifications → http://127.0.0.1:8000/seeker/notifications
Settings → http://127.0.0.1:8000/seeker/settings
```

### Quick Actions
```
Apply to Job → http://127.0.0.1:8000/jobs
Upload Resume → http://127.0.0.1:8000/seeker/profile/edit
Get Support → http://127.0.0.1:8000/seeker/notifications
```

### Topnav Links
```
Notifications Bell → http://127.0.0.1:8000/seeker/notifications
Profile Dropdown → http://127.0.0.1:8000/seeker/profile
Settings → http://127.0.0.1:8000/seeker/settings
Logout → POST http://127.0.0.1:8000/logout
```

---

## Testing Active Link Highlighting

1. Go to Dashboard → "Dashboard" link should be highlighted green
2. Go to Profile → "My Profile" link should be highlighted green
3. Go to Browse Jobs → "Browse Jobs" link should be highlighted green
4. Go to Applications → "My Applications" link should be highlighted green
5. Go to Saved Jobs → "Saved Jobs" link should be highlighted green
6. Go to Resume → "My Resume" link should be highlighted green
7. Go to Interviews → "Interviews" link should be highlighted green
8. Go to Messages → "Messages" link should be highlighted green
9. Go to Notifications → "Notifications" link should be highlighted green
10. Go to Settings → "Settings" link should be highlighted green

---

## Testing Responsive Design

### Mobile (320px)
```
1. Open DevTools (F12)
2. Toggle device toolbar
3. Select iPhone SE (375px)
4. Test all pages load correctly
5. Test sidebar collapses
6. Test all buttons clickable
7. Test navigation works
```

### Tablet (768px)
```
1. Select iPad (768px)
2. Test layout adapts
3. Test all elements visible
4. Test navigation works
```

### Desktop (1920px)
```
1. Select Desktop (1920px)
2. Test full layout
3. Test all elements visible
4. Test navigation works
```

---

## Testing Error Handling

1. **No Console Errors**
   - Open DevTools Console (F12)
   - Navigate through all pages
   - Verify no red errors appear

2. **No 404 Errors**
   - All routes should return 200 status
   - No "Not Found" messages

3. **No 500 Errors**
   - All pages should load successfully
   - No server errors

4. **Empty States**
   - If no data, empty state should display
   - Should show helpful message

---

## Testing Security

1. **Authentication Required**
   - Logout
   - Try to access /seeker/dashboard
   - Should redirect to login

2. **Role-Based Access**
   - Login as employer
   - Try to access /seeker/dashboard
   - Should be denied access

3. **User Data Scoping**
   - Login as user A
   - View applications
   - Logout and login as user B
   - Should only see user B's applications

---

## Testing Performance

1. **Page Load Time**
   - Open DevTools Network tab
   - Load each page
   - Verify load time < 2 seconds

2. **Database Queries**
   - Open Laravel Debugbar
   - Check number of queries
   - Verify no N+1 queries

3. **Memory Usage**
   - Monitor memory in DevTools
   - Verify no memory leaks

---

## Automated Testing Commands

```bash
# Run all tests
php artisan test

# Run specific test
php artisan test tests/Feature/SeekerDashboardTest.php

# Run with coverage
php artisan test --coverage

# Run specific test method
php artisan test tests/Feature/SeekerDashboardTest.php --filter=testDashboardLoads
```

---

## Troubleshooting

### Issue: Route not found
**Solution:**
1. Check route name in routes/web.php
2. Verify controller exists
3. Verify view file exists
4. Clear route cache: `php artisan route:clear`

### Issue: Page not displaying data
**Solution:**
1. Check controller is returning correct view
2. Verify data is being passed to view
3. Check view is using correct variable names
4. Check database has data

### Issue: Navigation not working
**Solution:**
1. Verify route() helper uses correct route name
2. Check link href attribute
3. Verify middleware allows access
4. Check user has correct role

### Issue: Styling issues
**Solution:**
1. Check Tailwind classes are correct
2. Verify CSS file is loaded
3. Clear browser cache
4. Run `npm run dev` to recompile assets

---

## Final Checklist

- [ ] All 10 pages load correctly
- [ ] All navigation links work
- [ ] Active link highlighting works
- [ ] All data displays correctly
- [ ] Search and filters work
- [ ] Pagination works
- [ ] Responsive design works
- [ ] No console errors
- [ ] No 404 errors
- [ ] No 500 errors
- [ ] Authentication works
- [ ] User data properly scoped
- [ ] Performance is good
- [ ] All buttons functional
- [ ] All forms submit correctly

---

**Status: READY FOR TESTING** ✅
