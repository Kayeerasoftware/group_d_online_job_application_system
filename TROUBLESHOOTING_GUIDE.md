# 🔧 Troubleshooting Guide - Notifications & Settings Pages

## ✅ Migrations Successfully Run

The following migrations have been executed:
- ✅ `2026_05_20_000000_ensure_notification_fields` - Notification fields
- ✅ `2026_05_21_000000_add_user_preferences` - User preference fields

---

## 🐛 Common Issues & Solutions

### Issue 1: "Unknown column" Error

**Error Message:**
```
SQLSTATE[42S22]: Column not found: 1054 Unknown column 'two_factor_enabled' in 'field list'
```

**Solution:**
```bash
# Run migrations
php artisan migrate

# Verify migrations ran
php artisan migrate:status
```

**Status:** ✅ FIXED - Migrations have been run

---

### Issue 2: Settings Page Not Loading

**Symptoms:**
- Blank page
- 500 error
- Database errors

**Solution:**
```bash
# 1. Run migrations
php artisan migrate

# 2. Clear cache
php artisan cache:clear

# 3. Refresh page
```

---

### Issue 3: Notifications Not Displaying

**Symptoms:**
- Empty notifications list
- No data showing

**Solution:**
```bash
# Generate sample notifications
php artisan notifications:generate

# Or for specific user
php artisan notifications:generate --user-id=1
```

---

### Issue 4: Form Validation Errors

**Symptoms:**
- "The password field is required"
- Validation errors not clearing

**Solution:**
1. Ensure all required fields are filled
2. Check password requirements (min 8 characters)
3. Verify password confirmation matches
4. Clear browser cache

---

### Issue 5: 2FA Toggle Not Working

**Symptoms:**
- Button doesn't respond
- No success message

**Solution:**
```bash
# 1. Check database connection
php artisan tinker
>>> DB::connection()->getPdo()

# 2. Verify user record exists
>>> User::find(1)

# 3. Check user preferences
>>> User::find(1)->two_factor_enabled
```

---

### Issue 6: Theme Not Changing

**Symptoms:**
- Theme selection doesn't persist
- Page doesn't change appearance

**Solution:**
1. Clear browser cache
2. Hard refresh (Ctrl+Shift+R)
3. Check database for theme value
4. Verify form submission

---

### Issue 7: Notifications Not Filtering

**Symptoms:**
- Filter tabs don't work
- All notifications show regardless of filter

**Solution:**
```bash
# Check notification types in database
php artisan tinker
>>> Notification::distinct()->pluck('type')

# Verify filter values match
# Should be: application_status, job_match, system, job_closing
```

---

### Issue 8: Permission Denied Error

**Symptoms:**
- 403 Forbidden error
- Can't access settings

**Solution:**
1. Ensure you're logged in as a seeker
2. Check user role: `User::find(1)->role`
3. Verify middleware is correct
4. Check authentication

---

### Issue 9: Database Connection Error

**Symptoms:**
- "Connection refused"
- "SQLSTATE[HY000]"

**Solution:**
```bash
# 1. Check .env file
cat .env | grep DB_

# 2. Verify MySQL is running
# 3. Test connection
php artisan tinker
>>> DB::connection()->getPdo()

# 4. Check credentials
```

---

### Issue 10: CSRF Token Mismatch

**Symptoms:**
- "CSRF token mismatch" error
- Forms won't submit

**Solution:**
1. Clear browser cookies
2. Clear Laravel cache: `php artisan cache:clear`
3. Refresh page
4. Try again

---

## 🔍 Debugging Steps

### Step 1: Check Migrations
```bash
php artisan migrate:status
```

Expected output:
```
2026_05_20_000000_ensure_notification_fields ........... DONE
2026_05_21_000000_add_user_preferences ................ DONE
```

### Step 2: Check Database
```bash
php artisan tinker
>>> Schema::hasColumn('users', 'two_factor_enabled')
>>> Schema::hasColumn('notifications', 'title')
```

### Step 3: Check User Data
```bash
php artisan tinker
>>> User::find(1)->toArray()
```

### Step 4: Check Logs
```bash
tail -f storage/logs/laravel.log
```

### Step 5: Test Routes
```bash
php artisan route:list | grep settings
php artisan route:list | grep notifications
```

---

## 📋 Verification Checklist

After running migrations, verify:

- [ ] Migrations show as DONE
- [ ] No database errors
- [ ] Settings page loads
- [ ] Notifications page loads
- [ ] Can change password
- [ ] Can toggle 2FA
- [ ] Can update notifications
- [ ] Can update privacy
- [ ] Can change theme
- [ ] Success messages appear

---

## 🚀 Quick Fix Commands

### Clear Everything
```bash
php artisan cache:clear
php artisan config:clear
php artisan view:clear
php artisan route:clear
```

### Reset Database
```bash
php artisan migrate:reset
php artisan migrate
```

### Generate Sample Data
```bash
php artisan notifications:generate
```

### Check Status
```bash
php artisan migrate:status
php artisan route:list
```

---

## 📞 Getting Help

### Check Logs
```bash
tail -f storage/logs/laravel.log
```

### Test Database
```bash
php artisan tinker
>>> DB::table('users')->count()
>>> DB::table('notifications')->count()
```

### Verify Setup
```bash
php artisan migrate:status
php artisan route:list | grep seeker
```

---

## ✅ Current Status

**Migrations**: ✅ SUCCESSFULLY RUN
- Notification fields added
- User preference fields added

**Next Steps**:
1. Access `/seeker/settings`
2. Access `/seeker/notifications`
3. Test all features
4. Report any issues

---

## 🎯 If You Still Have Issues

1. **Check migrations ran**: `php artisan migrate:status`
2. **Clear cache**: `php artisan cache:clear`
3. **Check logs**: `tail -f storage/logs/laravel.log`
4. **Verify database**: `php artisan tinker`
5. **Test routes**: `php artisan route:list`

---

**Last Updated**: 2024
**Status**: ✅ Migrations Complete - Ready to Use
