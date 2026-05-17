# Notifications Page - Architecture & Data Flow

## System Architecture

```
┌─────────────────────────────────────────────────────────────────┐
│                     SEEKER NOTIFICATIONS PAGE                    │
│                   /seeker/notifications                          │
└─────────────────────────────────────────────────────────────────┘
                              ↓
┌─────────────────────────────────────────────────────────────────┐
│                    ROUTE HANDLER                                 │
│  Route::get('/notifications', [NotificationController::class,   │
│             'index'])->name('notifications')                     │
└─────────────────────────────────────────────────────────────────┘
                              ↓
┌─────────────────────────────────────────────────────────────────┐
│              NotificationController::index()                     │
│                                                                  │
│  1. Get authenticated user                                      │
│  2. Build query: $user->notifications()                         │
│  3. Apply type filter (if provided)                             │
│  4. Order by created_at DESC                                    │
│  5. Paginate (15 per page)                                      │
│  6. Calculate stats:                                            │
│     - Unread count                                              │
│     - Application notifications                                 │
│     - Job alerts                                                │
│  7. Return view with data                                       │
└─────────────────────────────────────────────────────────────────┘
                              ↓
┌─────────────────────────────────────────────────────────────────┐
│                    DATABASE QUERIES                              │
│                                                                  │
│  SELECT * FROM notifications                                    │
│  WHERE user_id = ? AND type = ? (optional)                      │
│  ORDER BY created_at DESC                                       │
│  LIMIT 15 OFFSET ?                                              │
│                                                                  │
│  SELECT COUNT(*) FROM notifications                             │
│  WHERE user_id = ? AND read_at IS NULL                          │
│                                                                  │
│  SELECT COUNT(*) FROM notifications                             │
│  WHERE user_id = ? AND type = 'application_status'              │
│                                                                  │
│  SELECT COUNT(*) FROM notifications                             │
│  WHERE user_id = ? AND type = 'job_match'                       │
└─────────────────────────────────────────────────────────────────┘
                              ↓
┌─────────────────────────────────────────────────────────────────┐
│                   BLADE VIEW RENDERING                           │
│              resources/views/seeker/notifications.blade.php      │
│                                                                  │
│  ┌──────────────────────────────────────────────────────────┐  │
│  │ HEADER SECTION                                           │  │
│  │ - Title: "Notifications"                                 │  │
│  │ - Mark All Read Button (conditional)                     │  │
│  └──────────────────────────────────────────────────────────┘  │
│                                                                  │
│  ┌──────────────────────────────────────────────────────────┐  │
│  │ STATS CARDS (4 columns)                                  │  │
│  │ - Total: {{ $notifications->total() }}                   │  │
│  │ - Unread: {{ $unreadCount }}                             │  │
│  │ - Applications: {{ $applicationNotifications }}           │  │
│  │ - Job Alerts: {{ $jobAlerts }}                           │  │
│  └──────────────────────────────────────────────────────────┘  │
│                                                                  │
│  ┌──────────────────────────────────────────────────────────┐  │
│  │ FILTER TABS                                              │  │
│  │ [All] [Applications] [Job Alerts] [System]               │  │
│  └──────────────────────────────────────────────────────────┘  │
│                                                                  │
│  ┌──────────────────────────────────────────────────────────┐  │
│  │ NOTIFICATIONS LIST                                       │  │
│  │ @forelse($notifications as $notification)                │  │
│  │   ┌────────────────────────────────────────────────────┐ │  │
│  │   │ [ICON] Title                                       │ │  │
│  │   │        Message                                     │ │  │
│  │   │        Time ago                                    │ │  │
│  │   │        [Mark Read] [View Details] [Delete]         │ │  │
│  │   └────────────────────────────────────────────────────┘ │  │
│  │ @empty                                                   │  │
│  │   No notifications message                              │  │
│  │ @endforelse                                              │  │
│  └──────────────────────────────────────────────────────────┘  │
│                                                                  │
│  ┌──────────────────────────────────────────────────────────┐  │
│  │ PAGINATION                                               │  │
│  │ {{ $notifications->links() }}                            │  │
│  └──────────────────────────────────────────────────────────┘  │
└─────────────────────────────────────────────────────────────────┘
                              ↓
┌─────────────────────────────────────────────────────────────────┐
│                    HTML RESPONSE                                 │
│              Rendered to user's browser                          │
└─────────────────────────────────────────────────────────────────┘
```

## User Interaction Flow

```
┌─────────────────────────────────────────────────────────────────┐
│                    USER ACTIONS                                  │
└─────────────────────────────────────────────────────────────────┘

1. FILTER BY TYPE
   User clicks filter tab
        ↓
   Browser navigates to: /seeker/notifications?type=application_status
        ↓
   Controller filters query by type
        ↓
   View displays only matching notifications

2. MARK AS READ
   User clicks "Mark as Read" button
        ↓
   Form submits: PATCH /seeker/notifications/{id}/read
        ↓
   Controller updates: read_at = now(), is_read = true
        ↓
   Page reloads with updated notification

3. MARK ALL READ
   User clicks "Mark All Read" button
        ↓
   JavaScript confirms action
        ↓
   AJAX POST to: /seeker/notifications/mark-all-read
        ↓
   Controller updates all unread notifications
        ↓
   Page reloads

4. DELETE NOTIFICATION
   User clicks delete button
        ↓
   JavaScript confirms action
        ↓
   Form submits: DELETE /seeker/notifications/{id}
        ↓
   Controller deletes notification
        ↓
   Page reloads

5. VIEW DETAILS
   User clicks "View Details" button
        ↓
   Browser navigates to: action_url (e.g., /seeker/applications)
        ↓
   Related page loads
```

## Database Schema Diagram

```
┌─────────────────────────────────────────────────────────────────┐
│                      NOTIFICATIONS TABLE                         │
├─────────────────────────────────────────────────────────────────┤
│ Column              │ Type         │ Description                 │
├─────────────────────────────────────────────────────────────────┤
│ id                  │ BIGINT (PK)  │ Primary key                 │
│ user_id             │ BIGINT (FK)  │ References users.id         │
│ type                │ VARCHAR(255) │ Notification type           │
│ subject             │ VARCHAR(255) │ Email subject               │
│ title               │ VARCHAR(255) │ Display title               │
│ message             │ TEXT         │ Notification message        │
│ action_url          │ VARCHAR(255) │ Link for "View Details"     │
│ is_read             │ BOOLEAN      │ Read status                 │
│ read_at             │ TIMESTAMP    │ When marked as read         │
│ sent_at             │ TIMESTAMP    │ When notification sent      │
│ delivery_status     │ VARCHAR(255) │ Delivery status             │
│ delivery_attempts   │ TINYINT      │ Number of attempts          │
│ last_attempt_at     │ TIMESTAMP    │ Last delivery attempt       │
│ delivery_error      │ TEXT         │ Error message if failed     │
│ created_at          │ TIMESTAMP    │ Record creation time        │
│ updated_at          │ TIMESTAMP    │ Record update time          │
└─────────────────────────────────────────────────────────────────┘

Relationships:
  notifications.user_id → users.id (Many-to-One)
  
Indexes:
  - PRIMARY KEY (id)
  - FOREIGN KEY (user_id)
  - INDEX (user_id, created_at)
  - INDEX (user_id, read_at)
  - INDEX (user_id, type)
```

## Notification Type Flow

```
┌──────────────────────────────────────────────────────────────────┐
│                   NOTIFICATION TYPES                              │
└──────────────────────────────────────────────────────────────────┘

APPLICATION_STATUS
├── Triggered by: Application review, shortlist, rejection
├── Icon: 📄 (file-alt)
├── Color: Blue
├── Action URL: /seeker/applications
└── Example: "Your application for Laravel Developer has been shortlisted"

JOB_MATCH
├── Triggered by: New job posting matches profile
├── Icon: ⭐ (star)
├── Color: Green
├── Action URL: /seeker/browse-jobs
└── Example: "A new Senior PHP Developer position matches your profile"

JOB_CLOSING
├── Triggered by: Application deadline approaching
├── Icon: ⏰ (clock)
├── Color: Orange
├── Action URL: /seeker/saved-jobs
└── Example: "The DevOps Engineer position closes in 2 days"

SYSTEM
├── Triggered by: System messages, profile updates
├── Icon: 🔔 (bell)
├── Color: Purple
├── Action URL: /seeker/profile/edit
└── Example: "Update your profile to improve job matching"
```

## State Management

```
┌──────────────────────────────────────────────────────────────────┐
│                   NOTIFICATION STATES                             │
└──────────────────────────────────────────────────────────────────┘

UNREAD STATE
├── is_read: false
├── read_at: NULL
├── Visual: Blue dot indicator
├── Actions: Mark as Read, View Details, Delete
└── Display: Highlighted background

READ STATE
├── is_read: true
├── read_at: timestamp
├── Visual: No indicator
├── Actions: View Details, Delete
└── Display: Normal background

DELETED STATE
├── Removed from database
├── No longer visible
├── Cannot be recovered
└── Triggers page reload
```

## Performance Optimization

```
┌──────────────────────────────────────────────────────────────────┐
│                   QUERY OPTIMIZATION                              │
└──────────────────────────────────────────────────────────────────┘

PAGINATION
├── Limit: 15 notifications per page
├── Reduces memory usage
├── Faster page load
└── Better UX

FILTERING
├── Type filter reduces result set
├── Indexed queries
├── Faster filtering
└── Reduced data transfer

STATS CALCULATION
├── Separate queries (can be cached)
├── Efficient COUNT queries
├── Indexed on user_id and type
└── Minimal performance impact

LAZY LOADING
├── User relationship loaded on demand
├── Reduces initial query size
├── Better for large datasets
└── Configurable eager loading
```

## Security Flow

```
┌──────────────────────────────────────────────────────────────────┐
│                   SECURITY CHECKS                                 │
└──────────────────────────────────────────────────────────────────┘

AUTHENTICATION
├── Middleware: auth
├── Redirects to login if not authenticated
└── Ensures user is logged in

AUTHORIZATION
├── Check: notification.user_id === auth()->id()
├── Prevents viewing other users' notifications
└── Prevents modifying other users' notifications

CSRF PROTECTION
├── All forms include @csrf token
├── POST/PATCH/DELETE requests validated
└── Prevents cross-site attacks

VALIDATION
├── Type filter validated
├── Page number validated
└── Notification ID validated
```

## File Structure

```
project/
├── app/
│   ├── Console/
│   │   └── Commands/
│   │       └── GenerateSampleNotifications.php
│   ├── Http/
│   │   └── Controllers/
│   │       └── NotificationController.php
│   └── Models/
│       └── Notification.php
├── database/
│   ├── migrations/
│   │   └── 2026_05_20_000000_ensure_notification_fields.php
│   └── seeders/
│       └── NotificationSeeder.php
├── resources/
│   └── views/
│       └── seeker/
│           └── notifications.blade.php
└── routes/
    └── web.php
```

## Summary

The notifications page implements a complete notification system with:
- ✅ Database-driven notifications
- ✅ Type-based filtering
- ✅ Pagination support
- ✅ Read/unread tracking
- ✅ User actions (mark read, delete)
- ✅ Security and authorization
- ✅ Responsive design
- ✅ Performance optimization
