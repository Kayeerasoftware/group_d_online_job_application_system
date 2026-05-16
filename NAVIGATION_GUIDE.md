# Seeker Dashboard Navigation Guide

## Hash-Based Navigation

The seeker dashboard uses hash-based navigation for a single-page application experience. Click any sidebar link to navigate between pages without full page reloads.

## Navigation Links

### Main Dashboard Pages

| Page | Hash | Icon | Description |
|------|------|------|-------------|
| Dashboard | `#dashboard` | 🏠 | Main dashboard with analytics and overview |
| My Profile | `#profile` | 👤 | User profile, skills, experience, education |
| Browse Jobs | `#browse` | 🔍 | Search and browse available job listings |
| My Applications | `#applications` | 📄 | Track all job applications and status |
| Saved Jobs | `#saved` | 🔖 | View bookmarked job opportunities |
| My Resume | `#resume` | 📋 | Upload and manage resume versions |
| Interviews | `#interviews` | 📅 | Schedule and track interviews |
| Messages | `#messages` | 💬 | Communicate with recruiters |
| Notifications | `#notifications` | 🔔 | View all alerts and updates |
| Settings | `#settings` | ⚙️ | Account preferences and security |

## Quick Actions (Sidebar)

### Apply to Job
- **Route**: `{{ route('jobs.index') }}`
- **Action**: Browse and apply to jobs
- **Icon**: ➕ Plus Circle

### Upload Resume
- **Route**: `{{ route('seeker.profile.edit') }}`
- **Action**: Upload or update resume
- **Icon**: 📤 Upload

### Get Support
- **Route**: `{{ route('seeker.notifications.index') }}`
- **Action**: Contact support team
- **Icon**: 🎧 Headset

## How to Navigate

### Using Sidebar Links
1. Click any link in the sidebar
2. The page will update without reloading
3. URL hash will change (e.g., `#dashboard`)
4. Browser back/forward buttons work normally

### Direct URL Navigation
You can also navigate directly by typing the hash in the URL:
- `http://yoursite.com/seeker/dashboard#profile`
- `http://yoursite.com/seeker/dashboard#applications`
- `http://yoursite.com/seeker/dashboard#messages`

### Programmatic Navigation
In JavaScript, you can navigate using:
```javascript
// Change hash
window.location.hash = 'profile';

// Or use Alpine.js
activeLink = 'applications';
```

## Page Features

### Dashboard (`#dashboard`)
- Welcome header with user info
- 8 key metrics cards
- Interactive charts with tabs
- Recent activity section
- Year filter for analytics

### My Profile (`#profile`)
- Profile header with avatar
- Personal information
- Skills management
- Experience timeline
- Education section
- Quick action buttons

### Browse Jobs (`#browse`)
- Advanced search filters
- Job listings with details
- Apply and view buttons
- Pagination
- Sorting options

### My Applications (`#applications`)
- Application statistics
- Filtered application list
- Status indicators
- Search functionality
- Pagination

### Saved Jobs (`#saved`)
- Saved jobs grid
- Category and location filters
- Quick apply buttons
- Bookmark management
- Job details

### My Resume (`#resume`)
- Active resume display
- Resume versions history
- Upload new resume
- Download and delete options
- Resume tips

### Interviews (`#interviews`)
- Upcoming interviews
- Past interviews
- Interview details
- Join call buttons
- Preparation resources

### Messages (`#messages`)
- Conversation list
- Active chat display
- Message thread
- Send message functionality
- Recruiter information

### Notifications (`#notifications`)
- Notification list
- Filter by type
- Mark as read
- Quick actions
- Timestamp display

### Settings (`#settings`)
- Account settings
- Notification preferences
- Privacy & security
- Theme preferences
- Language selection

## Sidebar Active Link Highlighting

The sidebar automatically highlights the current page based on the URL hash:
- Active link has blue background (`bg-blue-100 text-blue-700`)
- Inactive links have gray text (`text-gray-700`)
- Hover effect on all links

## Mobile Navigation

On mobile devices:
- Sidebar slides in from the left
- Click menu toggle button to open/close
- Sidebar closes automatically after clicking a link
- Full-width content area

## Browser Compatibility

Hash-based navigation works in all modern browsers:
- ✅ Chrome/Edge
- ✅ Firefox
- ✅ Safari
- ✅ Mobile browsers

## Tips & Tricks

1. **Bookmark Pages**: You can bookmark specific pages using the hash URL
2. **Share Links**: Share direct links to specific pages with colleagues
3. **Back Button**: Use browser back button to return to previous page
4. **Deep Linking**: Link directly to specific pages from external sources
5. **Keyboard Navigation**: Use Tab key to navigate through links

## Troubleshooting

### Page Not Loading
- Check if hash is spelled correctly
- Ensure JavaScript is enabled
- Clear browser cache

### Sidebar Not Highlighting
- Refresh the page
- Check browser console for errors
- Verify Alpine.js is loaded

### Navigation Not Working
- Check if sidebar is open on mobile
- Verify JavaScript is enabled
- Try a different browser

## Code Examples

### Navigate from Button
```html
<a href="#profile" class="btn">Go to Profile</a>
```

### Navigate from JavaScript
```javascript
// Alpine.js
@click="activeLink = 'applications'"

// Vanilla JavaScript
window.location.hash = 'messages';
```

### Check Current Page
```javascript
// Alpine.js
x-show="activeLink === 'dashboard'"

// JavaScript
if (window.location.hash.slice(1) === 'profile') {
    // Do something
}
```

## Default Page

When you first visit the dashboard, it defaults to:
- **Hash**: `#dashboard`
- **Page**: Main Dashboard

## Session Persistence

The current page hash is preserved:
- When you refresh the page
- When you close and reopen the browser
- When you navigate away and return

## Performance Notes

- Pages load instantly (no server requests)
- Smooth transitions between pages
- Minimal bandwidth usage
- Optimized for mobile devices
- No page flickering

---

**Last Updated**: December 2024
**Version**: 1.0
**Status**: Production Ready
