# Seeker Settings Page - Quick Setup Guide

## 🚀 5-Minute Setup

### Step 1: Run Migrations
```bash
php artisan migrate
```

This will add all user preference fields to the database.

### Step 2: Access Settings Page
```
http://localhost:8000/seeker/settings
```

### Step 3: Update Your Preferences
- Change password
- Enable/disable 2FA
- Update notification preferences
- Adjust privacy settings
- Choose theme

---

## 📋 What You Can Do

### Account Security
- ✅ Change your password
- ✅ Enable two-factor authentication
- ✅ View active sessions

### Notifications
- ✅ Toggle job recommendations
- ✅ Toggle application updates
- ✅ Toggle message notifications
- ✅ Toggle interview reminders

### Privacy
- ✅ Control profile visibility
- ✅ Show/hide email
- ✅ Show/hide phone number

### Appearance
- ✅ Choose light theme
- ✅ Choose dark theme
- ✅ Choose auto theme

---

## 🔧 Common Tasks

### Change Password
1. Go to Settings → Account Security
2. Enter current password
3. Enter new password
4. Confirm new password
5. Click "Update Password"

### Enable 2FA
1. Go to Settings → Account Security
2. Click "Enable" button
3. Confirm action
4. 2FA is now enabled

### Update Notifications
1. Go to Settings → Notifications
2. Check/uncheck preferences
3. Click "Save Preferences"

### Change Theme
1. Go to Settings → Appearance
2. Select light, dark, or auto
3. Click "Save Appearance"

---

## 📊 Database Fields

```sql
-- New fields added to users table
two_factor_enabled BOOLEAN DEFAULT FALSE
two_factor_secret VARCHAR(255) NULL
notifications_enabled BOOLEAN DEFAULT TRUE
job_recommendations BOOLEAN DEFAULT TRUE
application_updates BOOLEAN DEFAULT TRUE
message_notifications BOOLEAN DEFAULT TRUE
interview_reminders BOOLEAN DEFAULT TRUE
profile_visible BOOLEAN DEFAULT TRUE
show_email BOOLEAN DEFAULT FALSE
show_phone BOOLEAN DEFAULT FALSE
theme VARCHAR(255) DEFAULT 'light'
last_login_at TIMESTAMP NULL
```

---

## 🔗 Routes

```php
GET    /seeker/settings                      - View settings
POST   /seeker/settings/password             - Update password
POST   /seeker/settings/notifications        - Update notifications
POST   /seeker/settings/privacy              - Update privacy
POST   /seeker/settings/appearance           - Update appearance
POST   /seeker/settings/two-factor/enable    - Enable 2FA
POST   /seeker/settings/two-factor/disable   - Disable 2FA
```

---

## 🎯 Features

### Stats Dashboard
- Active Sessions: Number of active sessions
- 2FA Status: Enabled/Disabled
- Notifications: On/Off
- Last Login: When you last logged in

### Settings Sections
- Account Security: Password and 2FA
- Notifications: Notification preferences
- Privacy: Profile visibility
- Appearance: Theme selection

---

## ✅ Verification Checklist

- [ ] Migrations ran successfully
- [ ] Settings page loads
- [ ] Can change password
- [ ] Can toggle 2FA
- [ ] Can update notifications
- [ ] Can update privacy
- [ ] Can change theme
- [ ] Success messages appear
- [ ] Error messages appear
- [ ] Responsive on mobile

---

## 🐛 Quick Troubleshooting

| Issue | Solution |
|-------|----------|
| Settings page not loading | Run `php artisan migrate` |
| Can't change password | Verify current password is correct |
| 2FA toggle not working | Check database connection |
| Theme not changing | Clear browser cache |
| Validation errors | Check input requirements |

---

## 📱 Responsive Design

- **Mobile**: Full width, stacked layout
- **Tablet**: 2-column layout
- **Desktop**: 4-column layout with sticky sidebar

---

## 🔐 Security

- All forms have CSRF protection
- Passwords are hashed
- Current password required to change password
- 2FA secrets are securely generated
- User can only modify own settings

---

## 📞 Support

For help:
1. Check migrations: `php artisan migrate:status`
2. Check logs: `storage/logs/laravel.log`
3. Verify user permissions
4. Test in incognito mode

---

## 🎊 You're Ready!

The settings page is now fully functional. Users can:
- Manage their account security
- Control notifications
- Adjust privacy settings
- Customize appearance

**Status**: ✅ Ready to Use

---

**Last Updated**: 2024
