# Seeker Notifications Page - Database Integration

## Overview
The `/seeker/notifications` page has been fully updated to fetch and display notifications from the database with proper filtering, pagination, and user interactions.

## Changes Made

### 1. Database Schema
**Migration**: `2026_05_20_000000_ensure_notification_fields.php`
- Ensures all required fields exist in the `notifications` table:
  - `title` - Notification title
  - `action_url` - URL to navigate when clicking "View Details"
  - `read_at` - Timestamp when notification was marked as read

### 2. Models

#### Notification Model (`app/Models/Notification.php`)
- Simplified casting to use string types instead of enums
- Includes all fillable fields for database operations
- Proper datetime casting for timestamps

#### User Model (`app/Models/User.php`)
- Already has `notifications()` relationship defined
- Returns all notifications for the user

### 3. Controller

#### NotificationController (`app/Http/Controllers/NotificationController.php`)
**Key Methods:**

- `index(Request $request)` - Fetches notifications with filtering
  - Supports type filtering via query parameter: `?type=application_status`
  - Paginates results (15 per page)
  - Calculates stats: total, unread, application notifications, job alerts
  - Returns view with all necessary data

- `markRead(Request $request, Notification $notification)` - Marks single notification as read
  - Updates both `read_at` and `is_read` fields
  - Includes authorization check

- `markAllRead(Request $request)` - Marks all unread notifications as read
  - Returns JSON response for AJAX calls
  - Updates both fields for consistency

- `destroy(Notification $notification)` - Deletes a notification
  - Includes authorization check

### 4. View

#### Notifications View (`resources/views/seeker/notifications.blade.php`)
**Features:**

- **Header Section**
  - Displays user greeting with icon
  - "Mark All Read" button (only shows when unread notifications exist)

- **Stats Cards**
  - Total notifications count
  - Unread count
  - Application notifications count
  - Job alerts count

- **Filter Tabs**
  - All (default)
  - Applications (`type=application_status`)
  - Job Alerts (`type=job_match`)
  - System (`type=system`)

- **Notifications List**
  - Each notification displays:
    - Icon based on type
    - Title and message
    - Time since creation (relative)
    - Unread indicator (blue dot)
    - Actions: Mark as Read, View Details, Delete
  - Empty state when no notifications

- **Pagination**
  - Displays pagination links if more than 15 notifications

### 5. Seeder

#### NotificationSeeder (`database/seeders/NotificationSeeder.php`)
- Creates sample notifications for testing
- Generates 6 different notification types per seeker user
- Alternates between read and unread status
- Sets realistic timestamps

### 6. Artisan Command

#### GenerateSampleNotifications (`app/Console/Commands/GenerateSampleNotifications.php`)
- Command: `php artisan notifications:generate`
- Options:
  - `--user-id=ID` - Generate notifications for specific user
  - Without option: generates for first 3 seeker users

## Notification Types

The system supports the following notification types:

| Type | Title | Use Case |
|------|-------|----------|
| `application_status` | Application Status Update | Application reviews, interview invitations |
| `job_match` | New Job Match | Matching job opportunities |
| `job_closing` | Job Closing Soon | Application deadline reminders |
| `system` | System Notification | Profile updates, system messages |

## Database Fields

```sql
notifications table:
- id (primary key)
- user_id (foreign key to users)
- type (string) - notification type
- subject (string) - email subject
- title (string) - notification title
- message (text) - notification message
- action_url (string) - URL for "View Details" button
- is_read (boolean) - read status
- read_at (timestamp) - when marked as read
- sent_at (timestamp) - when notification was sent
- delivery_status (string) - delivery status
- delivery_attempts (integer) - number of delivery attempts
- last_attempt_at (timestamp) - last delivery attempt
- delivery_error (text) - error message if failed
- created_at (timestamp)
- updated_at (timestamp)
```

## Routes

All routes are prefixed with `/seeker` and require authentication:

```php
GET    /seeker/notifications                    - List notifications
PATCH  /seeker/notifications/{notification}/read - Mark as read
POST   /seeker/notifications/mark-all-read      - Mark all as read
DELETE /seeker/notifications/{notification}     - Delete notification
```

## Usage

### Setup

1. Run migrations:
```bash
php artisan migrate
```

2. Generate sample notifications:
```bash
php artisan notifications:generate
```

Or for a specific user:
```bash
php artisan notifications:generate --user-id=1
```

3. Run seeder:
```bash
php artisan db:seed --class=NotificationSeeder
```

### Accessing the Page

Navigate to: `/seeker/notifications`

### Filtering

- All notifications: `/seeker/notifications`
- Application updates: `/seeker/notifications?type=application_status`
- Job matches: `/seeker/notifications?type=job_match`
- System messages: `/seeker/notifications?type=system`

## Features

✅ **Database Integration** - All notifications fetched from database
✅ **Type Filtering** - Filter by notification type
✅ **Pagination** - 15 notifications per page
✅ **Read Status** - Track read/unread notifications
✅ **Mark as Read** - Individual or bulk marking
✅ **Delete** - Remove notifications with confirmation
✅ **Action URLs** - Navigate to related pages
✅ **Responsive Design** - Works on mobile and desktop
✅ **Error Handling** - Graceful error messages
✅ **Authorization** - Users can only see their own notifications

## Testing

1. Create a seeker user account
2. Run: `php artisan notifications:generate --user-id=<user_id>`
3. Login as the seeker
4. Navigate to `/seeker/notifications`
5. Test filtering, marking as read, and deleting

## Future Enhancements

- Real-time notifications using WebSockets
- Email notification preferences
- Notification templates
- Bulk operations (select multiple and delete)
- Search functionality
- Export notifications
