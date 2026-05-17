# Notifications Page - Quick Reference Guide

## 🚀 Getting Started (5 Minutes)

### Step 1: Run Migrations
```bash
php artisan migrate
```

### Step 2: Generate Sample Data
```bash
php artisan notifications:generate
```

### Step 3: Access Page
```
http://localhost:8000/seeker/notifications
```

---

## 📋 File Locations

| File | Location | Purpose |
|------|----------|---------|
| Controller | `app/Http/Controllers/NotificationController.php` | Handle requests |
| Model | `app/Models/Notification.php` | Database model |
| View | `resources/views/seeker/notifications.blade.php` | UI rendering |
| Migration | `database/migrations/2026_05_20_000000_ensure_notification_fields.php` | Schema |
| Seeder | `database/seeders/NotificationSeeder.php` | Sample data |
| Command | `app/Console/Commands/GenerateSampleNotifications.php` | Data generation |

---

## 🎯 Key Features at a Glance

```
┌─────────────────────────────────────────────────────────────┐
│                    NOTIFICATIONS PAGE                        │
├─────────────────────────────────────────────────────────────┤
│                                                              │
│  📊 STATS CARDS                                             │
│  ├─ Total: 24                                               │
│  ├─ Unread: 5                                               │
│  ├─ Applications: 12                                        │
│  └─ Job Alerts: 8                                           │
│                                                              │
│  🔍 FILTER TABS                                             │
│  ├─ All                                                     │
│  ├─ Applications                                            │
│  ├─ Job Alerts                                              │
│  └─ System                                                  │
│                                                              │
│  📬 NOTIFICATIONS LIST                                      │
│  ├─ [Icon] Title                                            │
│  │   Message                                                │
│  │   Time ago                                               │
│  │   [Mark Read] [View Details] [Delete]                    │
│  │                                                          │
│  ├─ [Icon] Title                                            │
│  │   Message                                                │
│  │   Time ago                                               │
│  │   [Mark Read] [View Details] [Delete]                    │
│  │                                                          │
│  └─ ... (paginated)                                         │
│                                                              │
│  📄 PAGINATION                                              │
│  └─ [1] [2] [3] [Next]                                      │
│                                                              │
└─────────────────────────────────────────────────────────────┘
```

---

## 🔧 Common Commands

### Generate Sample Notifications
```bash
# For all seeker users
php artisan notifications:generate

# For specific user
php artisan notifications:generate --user-id=1
```

### Run Seeder
```bash
php artisan db:seed --class=NotificationSeeder
```

### Clear Cache
```bash
php artisan cache:clear
```

### Check Database
```bash
php artisan tinker
>>> User::find(1)->notifications()->count()
```

---

## 📊 Database Queries

### Get All Notifications
```php
$notifications = auth()->user()->notifications()->get();
```

### Get Unread
```php
$unread = auth()->user()->notifications()
    ->whereNull('read_at')
    ->get();
```

### Filter by Type
```php
$applications = auth()->user()->notifications()
    ->where('type', 'application_status')
    ->get();
```

### Mark as Read
```php
$notification->update([
    'read_at' => now(),
    'is_read' => true
]);
```

### Delete
```php
$notification->delete();
```

---

## 🎨 Notification Types

```
APPLICATION_STATUS
├─ Icon: 📄 (file-alt)
├─ Color: Blue
├─ Example: "Application shortlisted"
└─ Action: /seeker/applications

JOB_MATCH
├─ Icon: ⭐ (star)
├─ Color: Green
├─ Example: "New job matches your profile"
└─ Action: /seeker/browse-jobs

JOB_CLOSING
├─ Icon: ⏰ (clock)
├─ Color: Orange
├─ Example: "Application deadline approaching"
└─ Action: /seeker/saved-jobs

SYSTEM
├─ Icon: 🔔 (bell)
├─ Color: Purple
├─ Example: "Update your profile"
└─ Action: /seeker/profile/edit
```

---

## 🔗 Routes

```
GET    /seeker/notifications
GET    /seeker/notifications?type=application_status
GET    /seeker/notifications?page=2
PATCH  /seeker/notifications/{id}/read
POST   /seeker/notifications/mark-all-read
DELETE /seeker/notifications/{id}
```

---

## 🎯 User Actions

### Mark as Read
```
Click "Mark as Read" button
    ↓
PATCH /seeker/notifications/{id}/read
    ↓
Update: read_at = now(), is_read = true
    ↓
Page reloads
```

### Mark All Read
```
Click "Mark All Read" button
    ↓
Confirm dialog
    ↓
POST /seeker/notifications/mark-all-read
    ↓
Update all unread notifications
    ↓
Page reloads
```

### Delete
```
Click delete button
    ↓
Confirm dialog
    ↓
DELETE /seeker/notifications/{id}
    ↓
Remove from database
    ↓
Page reloads
```

### Filter
```
Click filter tab
    ↓
Navigate to: /seeker/notifications?type=TYPE
    ↓
Controller filters query
    ↓
View displays filtered results
```

---

## 🐛 Troubleshooting Quick Fixes

| Issue | Solution |
|-------|----------|
| No notifications | `php artisan notifications:generate --user-id=1` |
| Column not found | `php artisan migrate` |
| Permission denied | Login as seeker user |
| Cache issues | `php artisan cache:clear` |
| Database errors | Check `storage/logs/laravel.log` |

---

## 📱 Responsive Breakpoints

```
Mobile (< 768px)
├─ Stats: 2 columns
├─ Tabs: wrap
└─ Full width

Tablet (768px - 1024px)
├─ Stats: 3-4 columns
├─ Tabs: fit on line
└─ Balanced layout

Desktop (> 1024px)
├─ Stats: 4 columns
├─ Tabs: full width
└─ Professional layout
```

---

## 🔐 Security Checklist

- [x] Authentication required
- [x] Authorization checks
- [x] CSRF protection
- [x] Input validation
- [x] Error handling
- [x] Confirmation dialogs

---

## 📊 Performance Tips

1. **Pagination** - 15 per page reduces load
2. **Filtering** - Reduces result set
3. **Indexing** - Queries use indexes
4. **Caching** - Stats can be cached
5. **Lazy Loading** - Relationships on demand

---

## 🎓 Learning Resources

- **Setup**: Read `NOTIFICATIONS_SETUP.md`
- **Details**: Read `NOTIFICATIONS_PAGE_DOCUMENTATION.md`
- **Architecture**: Read `NOTIFICATIONS_ARCHITECTURE.md`
- **Checklist**: Use `NOTIFICATIONS_CHECKLIST.md`

---

## 📞 Quick Help

### Where is the notifications page?
```
/seeker/notifications
```

### How do I generate test data?
```bash
php artisan notifications:generate
```

### How do I filter notifications?
```
Click filter tabs or use: ?type=application_status
```

### How do I mark as read?
```
Click "Mark as Read" button on notification
```

### How do I delete a notification?
```
Click delete button and confirm
```

---

## 🎯 Next Steps

1. ✅ Run migrations
2. ✅ Generate sample data
3. ✅ Access page
4. ✅ Test features
5. ✅ Deploy to production

---

## 📋 Verification

- [ ] Notifications display
- [ ] Filtering works
- [ ] Mark as read works
- [ ] Delete works
- [ ] Pagination works
- [ ] Responsive design works
- [ ] No errors in console
- [ ] No errors in logs

---

## 🎊 You're All Set!

The notifications page is ready to use. Start by:

1. Running migrations
2. Generating sample data
3. Accessing the page
4. Testing features

For detailed information, see the documentation files.

---

## 📞 Support

- **Documentation**: See `.md` files in project root
- **Logs**: Check `storage/logs/laravel.log`
- **Database**: Use `php artisan tinker`
- **Help**: Review troubleshooting section

---

**Status**: ✅ Ready for Production
**Last Updated**: 2024
