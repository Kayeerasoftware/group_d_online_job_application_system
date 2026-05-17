# Admin Login Guide

## Overview
This guide explains how to create an admin account and login to the system.

---

## Prerequisites

Before an admin can login, they need:
1. A user account with `admin` role
2. An active account status (`is_active = true`)
3. Valid email and password

---

## Method 1: Create Admin via Artisan Tinker (For Developers)

### Step 1: Open Tinker
```bash
php artisan tinker
```

### Step 2: Create Admin User
```php
$user = User::create([
    'name' => 'John Admin',
    'email' => 'admin@example.com',
    'password' => bcrypt('password123'),
    'role' => 'admin',
    'is_active' => true,
]);
```

### Step 3: Verify Creation
```php
$user = User::where('email', 'admin@example.com')->first();
dd($user);
```

### Step 4: Exit Tinker
```php
exit
```

---

## Method 2: Create Admin via Database (For Admins)

### Using MySQL Command Line
```sql
INSERT INTO users (name, email, password, role, is_active, created_at, updated_at)
VALUES (
    'John Admin',
    'admin@example.com',
    '$2y$12$...',  -- bcrypt hashed password
    'admin',
    1,
    NOW(),
    NOW()
);
```

### Using MySQL Workbench
1. Open MySQL Workbench
2. Connect to your database
3. Navigate to `users` table
4. Insert new row with:
   - `name`: Admin's name
   - `email`: Admin's email
   - `password`: Bcrypt hashed password
   - `role`: `admin`
   - `is_active`: `1` (true)

---

## Method 3: Create Admin via Seeder (For Development)

### Step 1: Create Seeder
```bash
php artisan make:seeder AdminSeeder
```

### Step 2: Edit Seeder
File: `database/seeders/AdminSeeder.php`

```php
<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'System Administrator',
            'email' => 'admin@example.com',
            'password' => bcrypt('password123'),
            'role' => 'admin',
            'is_active' => true,
        ]);
    }
}
```

### Step 3: Run Seeder
```bash
php artisan db:seed --class=AdminSeeder
```

---

## Login Process

### Step 1: Go to Login Page
```
URL: http://your-domain.com/login
```

### Step 2: Enter Credentials
- **Email**: admin@example.com
- **Password**: password123

### Step 3: Click Login
The system will:
1. Verify email exists
2. Verify password is correct
3. Check if account is active
4. Check if role is "admin"
5. Redirect to admin dashboard

### Step 4: Access Admin Dashboard
After successful login, you'll be redirected to:
```
URL: http://your-domain.com/admin/dashboard
```

---

## Admin Dashboard Access

Once logged in, admins can access:

### Main Dashboard
- **URL**: `/admin/dashboard`
- **Shows**: System overview, metrics, pending reports

### Job Moderation
- **URL**: `/admin/jobs`
- **Actions**: Flag, approve, reject, delete jobs

### Application Management
- **URL**: `/admin/applications`
- **Actions**: View, filter, delete applications

### Employer Management
- **URL**: `/admin/employers`
- **Actions**: View, suspend, activate, delete employers

### User Management
- **URL**: `/admin/users`
- **Actions**: Manage user roles, suspend, delete users

### Audit Logs
- **URL**: `/admin/audit-logs`
- **Shows**: System activity tracking

### System Settings
- **URL**: `/admin/system`
- **Actions**: Configure system integration settings

### Compliance Reports
- **URL**: `/admin/reports`
- **Actions**: Create, view, submit compliance reports

### Profile
- **URL**: `/admin/profile`
- **Shows**: Admin profile information

---

## Troubleshooting Login Issues

### Issue: "Invalid Credentials"
**Cause**: Email or password is incorrect
**Solution**: 
- Verify email address is correct
- Verify password is correct
- Check if account exists

### Issue: "Account Inactive"
**Cause**: Account is_active = false
**Solution**:
- Contact super admin to activate account
- Or update in database: `UPDATE users SET is_active = 1 WHERE email = 'admin@example.com';`

### Issue: "Access Denied"
**Cause**: User role is not "admin"
**Solution**:
- Verify role is set to "admin"
- Update if needed: `UPDATE users SET role = 'admin' WHERE email = 'admin@example.com';`

### Issue: "Page Not Found"
**Cause**: Routes not configured or cache not cleared
**Solution**:
```bash
php artisan route:cache
php artisan route:clear
php artisan cache:clear
```

### Issue: "Middleware Error"
**Cause**: IsAdmin middleware not registered
**Solution**:
- Verify middleware exists: `app/Http/Middleware/IsAdmin.php`
- Verify routes use correct middleware: `middleware(['auth', 'admin'])`

---

## Password Management

### Change Password After Login

1. Go to Profile: `/admin/profile`
2. Click "Edit Profile"
3. Scroll to "Change Password" section
4. Enter:
   - Current Password
   - New Password
   - Confirm Password
5. Click "Update Password"

### Reset Forgotten Password

1. Go to Login page: `/login`
2. Click "Forgot Password"
3. Enter email address
4. Check email for reset link
5. Click link and set new password

---

## Security Best Practices

### For Admins
1. ✅ Use strong passwords (8+ characters, mix of letters/numbers/symbols)
2. ✅ Don't share login credentials
3. ✅ Log out when finished
4. ✅ Change password regularly
5. ✅ Report suspicious activity
6. ✅ Review audit logs regularly

### For Super Admins
1. ✅ Create strong temporary passwords
2. ✅ Require password change on first login
3. ✅ Monitor login attempts
4. ✅ Disable inactive accounts
5. ✅ Review audit logs regularly
6. ✅ Limit admin account creation

---

## Quick Reference

### Create Admin (Tinker)
```bash
php artisan tinker
$user = User::create(['name' => 'Name', 'email' => 'email@example.com', 'password' => bcrypt('password'), 'role' => 'admin', 'is_active' => true]);
exit
```

### Login URL
```
http://your-domain.com/login
```

### Dashboard URL
```
http://your-domain.com/admin/dashboard
```

### Verify Admin Exists
```bash
php artisan tinker
User::where('role', 'admin')->get();
exit
```

### Activate Admin
```bash
php artisan tinker
$user = User::find(1);
$user->is_active = true;
$user->save();
exit
```

---

## Common Scenarios

### Scenario 1: New Admin First Login
1. Super admin creates admin account
2. Super admin sends login credentials to admin
3. Admin goes to `/login`
4. Admin enters email and password
5. Admin is redirected to `/admin/dashboard`
6. Admin changes password in profile settings

### Scenario 2: Admin Forgot Password
1. Admin goes to `/login`
2. Admin clicks "Forgot Password"
3. Admin enters email
4. Admin receives reset email
5. Admin clicks link in email
6. Admin sets new password
7. Admin logs in with new password

### Scenario 3: Super Admin Needs to Reset Admin Password
1. Super admin opens Tinker
2. Super admin finds admin: `$user = User::where('email', 'admin@example.com')->first();`
3. Super admin updates password: `$user->password = bcrypt('newpassword'); $user->save();`
4. Super admin sends new password to admin
5. Admin logs in and changes password

---

## Admin Roles & Permissions

### Admin Capabilities
- ✅ Moderate job listings
- ✅ Approve/reject jobs
- ✅ Flag suspicious jobs
- ✅ Manage applications
- ✅ Manage employer accounts
- ✅ Manage user accounts
- ✅ View audit logs
- ✅ Configure system settings
- ✅ Generate compliance reports

### Admin Restrictions
- ❌ Cannot delete other admins
- ❌ Cannot modify system core files
- ❌ Cannot access regulator functions
- ❌ Cannot access employer/seeker dashboards

---

## Database Schema

### Users Table Relevant Columns
```sql
CREATE TABLE users (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role VARCHAR(50) NOT NULL,  -- 'admin', 'regulator', 'employer', 'seeker'
    is_active BOOLEAN DEFAULT 1,
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);
```

### Verify Admin in Database
```sql
SELECT * FROM users WHERE role = 'admin' AND is_active = 1;
```

---

## API Reference (If Using API)

### Login Endpoint
```
POST /api/login
Content-Type: application/json

{
    "email": "admin@example.com",
    "password": "password123"
}
```

### Response
```json
{
    "token": "eyJ0eXAiOiJKV1QiLCJhbGc...",
    "user": {
        "id": 1,
        "name": "John Admin",
        "email": "admin@example.com",
        "role": "admin"
    }
}
```

---

## Admin Features Overview

### Job Moderation
- List all jobs
- View job details
- Flag jobs for review
- Approve jobs
- Reject jobs with reason
- Delete jobs

### Application Management
- List all applications
- View application details
- Filter by status and job
- Delete applications

### Employer Management
- List all employers
- View employer profiles
- Suspend employer accounts
- Activate employer accounts
- Delete employer accounts

### User Management
- List all users
- View user details
- Change user roles
- Suspend users
- Delete users

### System Monitoring
- View audit logs
- Configure system settings
- Generate compliance reports
- Monitor system health

---

## Support

### For Login Issues
1. Check email and password
2. Verify account is active
3. Verify role is "admin"
4. Clear browser cache
5. Try different browser
6. Contact super admin

### For Account Issues
1. Contact super administrator
2. Provide email address
3. Request password reset
4. Request account activation

### For Permission Issues
1. Verify admin role is set correctly
2. Check middleware configuration
3. Clear route cache
4. Contact development team

---

## Summary

### To Login as Admin:
1. **Create Account** (if not exists)
   - Use Tinker, Database, or Seeder
   - Set role to "admin"
   - Set is_active to true

2. **Go to Login Page**
   - URL: `/login`

3. **Enter Credentials**
   - Email: admin@example.com
   - Password: (your password)

4. **Click Login**
   - System verifies credentials
   - Redirects to dashboard

5. **Access Dashboard**
   - URL: `/admin/dashboard`
   - Moderate jobs
   - Manage applications
   - Manage employers
   - View audit logs

---

## Next Steps

1. **Change Password** - Update default password
2. **Review Dashboard** - Familiarize with interface
3. **Check Audit Logs** - Monitor system activity
4. **Configure Settings** - Set up system preferences
5. **Create Regulators** - Add regulatory oversight

---

**Version**: 1.0
**Last Updated**: 2024
**Status**: Complete
