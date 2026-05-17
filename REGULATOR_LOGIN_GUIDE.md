# Regulator Login Guide

## Overview
This guide explains how to create a regulator account and login to the system.

---

## Prerequisites

Before a regulator can login, they need:
1. A user account with `regulator` role
2. An active account status (`is_active = true`)
3. Valid email and password

---

## Method 1: Create Regulator via Artisan Tinker (For Developers)

### Step 1: Open Tinker
```bash
php artisan tinker
```

### Step 2: Create Regulator User
```php
$user = User::create([
    'name' => 'John Regulator',
    'email' => 'regulator@example.com',
    'password' => bcrypt('password123'),
    'role' => 'regulator',
    'is_active' => true,
]);
```

### Step 3: Verify Creation
```php
$user = User::where('email', 'regulator@example.com')->first();
dd($user);
```

### Step 4: Exit Tinker
```php
exit
```

---

## Method 2: Create Regulator via Database (For Admins)

### Using MySQL Command Line
```sql
INSERT INTO users (name, email, password, role, is_active, created_at, updated_at)
VALUES (
    'John Regulator',
    'regulator@example.com',
    '$2y$12$...',  -- bcrypt hashed password
    'regulator',
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
   - `name`: Regulator's name
   - `email`: Regulator's email
   - `password`: Bcrypt hashed password
   - `role`: `regulator`
   - `is_active`: `1` (true)

---

## Method 3: Create Regulator via Seeder (For Development)

### Step 1: Create Seeder
```bash
php artisan make:seeder RegulatorSeeder
```

### Step 2: Edit Seeder
File: `database/seeders/RegulatorSeeder.php`

```php
<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class RegulatorSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'System Regulator',
            'email' => 'regulator@example.com',
            'password' => bcrypt('password123'),
            'role' => 'regulator',
            'is_active' => true,
        ]);
    }
}
```

### Step 3: Run Seeder
```bash
php artisan db:seed --class=RegulatorSeeder
```

---

## Method 4: Create Regulator via Admin Panel (Future Feature)

Once admin panel is fully implemented, admins can create regulators through:
1. Admin Dashboard
2. User Management section
3. Create New User form
4. Select "Regulator" as role

---

## Login Process

### Step 1: Go to Login Page
```
URL: http://your-domain.com/login
```

### Step 2: Enter Credentials
- **Email**: regulator@example.com
- **Password**: password123

### Step 3: Click Login
The system will:
1. Verify email exists
2. Verify password is correct
3. Check if account is active
4. Check if role is "regulator"
5. Redirect to regulator dashboard

### Step 4: Access Regulator Dashboard
After successful login, you'll be redirected to:
```
URL: http://your-domain.com/regulator/dashboard
```

---

## Regulator Dashboard Access

Once logged in, regulators can access:

### Main Dashboard
- **URL**: `/regulator/dashboard`
- **Shows**: System overview, metrics, recent activity

### Compliance Reports
- **URL**: `/regulator/compliance`
- **Shows**: All compliance reports with filtering

### Audit Logs
- **URL**: `/regulator/audit-logs`
- **Shows**: System activity tracking

### System Monitoring
- **URL**: `/regulator/system-monitoring`
- **Shows**: Real-time system metrics

### Profile
- **URL**: `/regulator/profile`
- **Shows**: Regulator profile information

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
- Contact admin to activate account
- Or update in database: `UPDATE users SET is_active = 1 WHERE email = 'regulator@example.com';`

### Issue: "Access Denied"
**Cause**: User role is not "regulator"
**Solution**:
- Verify role is set to "regulator"
- Update if needed: `UPDATE users SET role = 'regulator' WHERE email = 'regulator@example.com';`

### Issue: "Page Not Found"
**Cause**: Routes not configured or cache not cleared
**Solution**:
```bash
php artisan route:cache
php artisan route:clear
php artisan cache:clear
```

### Issue: "Middleware Error"
**Cause**: IsRegulator middleware not registered
**Solution**:
- Verify middleware exists: `app/Http/Middleware/IsRegulator.php`
- Verify routes use correct middleware: `middleware(['auth', 'regulator'])`

---

## Password Management

### Change Password After Login

1. Go to Profile: `/regulator/profile`
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

### For Regulators
1. ✅ Use strong passwords (8+ characters, mix of letters/numbers/symbols)
2. ✅ Don't share login credentials
3. ✅ Log out when finished
4. ✅ Change password regularly
5. ✅ Report suspicious activity

### For Administrators
1. ✅ Create strong temporary passwords
2. ✅ Require password change on first login
3. ✅ Monitor login attempts
4. ✅ Disable inactive accounts
5. ✅ Review audit logs regularly

---

## Quick Reference

### Create Regulator (Tinker)
```bash
php artisan tinker
$user = User::create(['name' => 'Name', 'email' => 'email@example.com', 'password' => bcrypt('password'), 'role' => 'regulator', 'is_active' => true]);
exit
```

### Login URL
```
http://your-domain.com/login
```

### Dashboard URL
```
http://your-domain.com/regulator/dashboard
```

### Verify Regulator Exists
```bash
php artisan tinker
User::where('role', 'regulator')->get();
exit
```

### Activate Regulator
```bash
php artisan tinker
$user = User::find(1);
$user->is_active = true;
$user->save();
exit
```

---

## Common Scenarios

### Scenario 1: New Regulator First Login
1. Admin creates regulator account
2. Admin sends login credentials to regulator
3. Regulator goes to `/login`
4. Regulator enters email and password
5. Regulator is redirected to `/regulator/dashboard`
6. Regulator changes password in profile settings

### Scenario 2: Regulator Forgot Password
1. Regulator goes to `/login`
2. Regulator clicks "Forgot Password"
3. Regulator enters email
4. Regulator receives reset email
5. Regulator clicks link in email
6. Regulator sets new password
7. Regulator logs in with new password

### Scenario 3: Admin Needs to Reset Regulator Password
1. Admin opens Tinker
2. Admin finds regulator: `$user = User::where('email', 'regulator@example.com')->first();`
3. Admin updates password: `$user->password = bcrypt('newpassword'); $user->save();`
4. Admin sends new password to regulator
5. Regulator logs in and changes password

---

## Database Schema

### Users Table Relevant Columns
```sql
CREATE TABLE users (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role VARCHAR(50) NOT NULL,  -- 'regulator', 'admin', 'employer', 'seeker'
    is_active BOOLEAN DEFAULT 1,
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);
```

### Verify Regulator in Database
```sql
SELECT * FROM users WHERE role = 'regulator' AND is_active = 1;
```

---

## API Reference (If Using API)

### Login Endpoint
```
POST /api/login
Content-Type: application/json

{
    "email": "regulator@example.com",
    "password": "password123"
}
```

### Response
```json
{
    "token": "eyJ0eXAiOiJKV1QiLCJhbGc...",
    "user": {
        "id": 1,
        "name": "John Regulator",
        "email": "regulator@example.com",
        "role": "regulator"
    }
}
```

---

## Support

### For Login Issues
1. Check email and password
2. Verify account is active
3. Verify role is "regulator"
4. Clear browser cache
5. Try different browser
6. Contact admin

### For Account Issues
1. Contact system administrator
2. Provide email address
3. Request password reset
4. Request account activation

---

## Summary

### To Login as Regulator:
1. **Create Account** (if not exists)
   - Use Tinker, Database, or Seeder
   - Set role to "regulator"
   - Set is_active to true

2. **Go to Login Page**
   - URL: `/login`

3. **Enter Credentials**
   - Email: regulator@example.com
   - Password: (your password)

4. **Click Login**
   - System verifies credentials
   - Redirects to dashboard

5. **Access Dashboard**
   - URL: `/regulator/dashboard`
   - View system metrics
   - Access compliance reports
   - Monitor audit logs

---

**Version**: 1.0
**Last Updated**: 2024
**Status**: Complete
