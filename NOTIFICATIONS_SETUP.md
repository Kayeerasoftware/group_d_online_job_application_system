# Notifications Page - Quick Setup Guide

## Step 1: Run Migrations
```bash
php artisan migrate
```

This will:
- Create the `notifications` table (if not exists)
- Add missing columns: `title`, `action_url`, `read_at`

## Step 2: Generate Sample Data
Choose one option:

**Option A: Generate for all seeker users**
```bash
php artisan notifications:generate
```

**Option B: Generate for specific user**
```bash
php artisan notifications:generate --user-id=1
```

**Option C: Run the seeder**
```bash
php artisan db:seed --class=NotificationSeeder
```

## Step 3: Access the Page
1. Login as a seeker user
2. Navigate to: `http://localhost:8000/seeker/notifications`

## What You'll See

### Stats Cards
- **Total**: Total number of notifications
- **Unread**: Number of unread notifications
- **Application**: Application status notifications
- **Job Alerts**: Job match notifications

### Filter Tabs
- **All**: Show all notifications
- **Applications**: Show only application status updates
- **Job Alerts**: Show only job matches
- **System**: Show only system messages

### Notification List
Each notification shows:
- Icon (based on type)
- Title and message
- Time since creation
- Blue dot indicator for unread
- Action buttons:
  - Mark as Read (for unread)
  - View Details (if action_url exists)
  - Delete

## Features

✅ **Filter by Type** - Click filter tabs to see specific notification types
✅ **Mark as Read** - Click "Mark as Read" button on unread notifications
✅ **Mark All Read** - Click "Mark All Read" button in header (only shows if unread exist)
✅ **Delete** - Click delete button with confirmation
✅ **Pagination** - Navigate through pages if more than 15 notifications
✅ **View Details** - Click "View Details" to navigate to related page

## Database Queries

### View all notifications for a user
```php
$notifications = auth()->user()->notifications()->get();
```

### View unread notifications
```php
$unread = auth()->user()->notifications()->whereNull('read_at')->get();
```

### Filter by type
```php
$applications = auth()->user()->notifications()
    ->where('type', 'application_status')
    ->get();
```

### Mark as read
```php
$notification->update(['read_at' => now(), 'is_read' => true]);
```

## Troubleshooting

### No notifications showing?
1. Check if user has notifications in database:
   ```bash
   php artisan tinker
   >>> User::find(1)->notifications()->count()
   ```

2. Generate sample notifications:
   ```bash
   php artisan notifications:generate --user-id=1
   ```

### Columns missing error?
Run migrations:
```bash
php artisan migrate
```

### Permission denied error?
Ensure you're logged in as a seeker user and accessing your own notifications.

## Database Schema

```sql
CREATE TABLE notifications (
    id BIGINT PRIMARY KEY,
    user_id BIGINT NOT NULL,
    type VARCHAR(255),
    subject VARCHAR(255),
    title VARCHAR(255),
    message TEXT,
    action_url VARCHAR(255),
    is_read BOOLEAN DEFAULT FALSE,
    read_at TIMESTAMP NULL,
    sent_at TIMESTAMP NULL,
    delivery_status VARCHAR(255),
    delivery_attempts TINYINT DEFAULT 0,
    last_attempt_at TIMESTAMP NULL,
    delivery_error TEXT NULL,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
);
```

## API Endpoints

### Get Notifications
```
GET /seeker/notifications
GET /seeker/notifications?type=application_status
GET /seeker/notifications?page=2
```

### Mark as Read
```
PATCH /seeker/notifications/{id}/read
```

### Mark All as Read
```
POST /seeker/notifications/mark-all-read
```

### Delete Notification
```
DELETE /seeker/notifications/{id}
```

## Sample Notification Data

The system creates these notification types:

1. **Application Status Update** - Application reviews, shortlists
2. **New Job Match** - Matching job opportunities
3. **Job Closing Soon** - Application deadline reminders
4. **System Notification** - Profile updates, system messages
5. **Interview Scheduled** - Interview invitations
6. **New Opportunity** - New job postings

Each has:
- Unique title and message
- Action URL for navigation
- Type for filtering
- Read/unread status
- Timestamp
