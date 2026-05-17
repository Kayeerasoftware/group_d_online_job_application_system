# Quick Start: Login for Regulator & Admin

## 🚀 Get Started in 5 Minutes

### For Regulator

#### Step 1: Create Regulator Account (One-time)
```bash
php artisan tinker
```

Then paste this:
```php
User::create([
    'name' => 'Regulator Name',
    'email' => 'regulator@example.com',
    'password' => bcrypt('password123'),
    'role' => 'regulator',
    'is_active' => true,
]);
exit
```

#### Step 2: Login
1. Go to: `http://localhost:8000/login`
2. Email: `regulator@example.com`
3. Password: `password123`
4. Click Login

#### Step 3: Access Dashboard
You'll be redirected to: `http://localhost:8000/regulator/dashboard`

---

### For Admin

#### Step 1: Create Admin Account (One-time)
```bash
php artisan tinker
```

Then paste this:
```php
User::create([
    'name' => 'Admin Name',
    'email' => 'admin@example.com',
    'password' => bcrypt('password123'),
    'role' => 'admin',
    'is_active' => true,
]);
exit
```

#### Step 2: Login
1. Go to: `http://localhost:8000/login`
2. Email: `admin@example.com`
3. Password: `password123`
4. Click Login

#### Step 3: Access Dashboard
You'll be redirected to: `http://localhost:8000/admin/dashboard`

---

## 📋 Available URLs

### Regulator URLs
| URL | Purpose |
|-----|---------|
| `/regulator/dashboard` | Main dashboard |
| `/regulator/compliance` | Compliance reports |
| `/regulator/audit-logs` | Audit logs |
| `/regulator/system-monitoring` | System metrics |
| `/regulator/profile` | Profile settings |

### Admin URLs
| URL | Purpose |
|-----|---------|
| `/admin/dashboard` | Main dashboard |
| `/admin/jobs` | Job moderation |
| `/admin/applications` | Application management |
| `/admin/employers` | Employer management |
| `/admin/users` | User management |
| `/admin/audit-logs` | Audit logs |
| `/admin/system` | System settings |
| `/admin/reports` | Compliance reports |
| `/admin/profile` | Profile settings |

---

## 🔑 Default Credentials

### Regulator
- **Email**: regulator@example.com
- **Password**: password123
- **URL**: http://localhost:8000/login

### Admin
- **Email**: admin@example.com
- **Password**: password123
- **URL**: http://localhost:8000/login

---

## ⚡ Quick Commands

### Create Multiple Users
```bash
php artisan tinker
```

```php
// Create regulator
User::create(['name' => 'Regulator 1', 'email' => 'reg1@example.com', 'password' => bcrypt('pass'), 'role' => 'regulator', 'is_active' => true]);

// Create admin
User::create(['name' => 'Admin 1', 'email' => 'admin1@example.com', 'password' => bcrypt('pass'), 'role' => 'admin', 'is_active' => true]);

// Create employer
User::create(['name' => 'Employer 1', 'email' => 'emp1@example.com', 'password' => bcrypt('pass'), 'role' => 'employer', 'is_active' => true]);

// Create seeker
User::create(['name' => 'Seeker 1', 'email' => 'seek1@example.com', 'password' => bcrypt('pass'), 'role' => 'seeker', 'is_active' => true]);

exit
```

### List All Users
```bash
php artisan tinker
User::all();
exit
```

### List Users by Role
```bash
php artisan tinker
User::where('role', 'regulator')->get();
User::where('role', 'admin')->get();
exit
```

### Activate User
```bash
php artisan tinker
$user = User::find(1);
$user->is_active = true;
$user->save();
exit
```

### Change User Password
```bash
php artisan tinker
$user = User::find(1);
$user->password = bcrypt('newpassword');
$user->save();
exit
```

---

## 🆘 Troubleshooting

### "Invalid Credentials"
- Check email spelling
- Check password spelling
- Verify user exists: `User::where('email', 'regulator@example.com')->first();`

### "Access Denied"
- Verify role: `User::find(1)->role;`
- Verify active: `User::find(1)->is_active;`

### "Page Not Found"
```bash
php artisan route:cache
php artisan route:clear
php artisan cache:clear
```

### "Middleware Error"
- Verify middleware exists
- Clear cache and routes

---

## 📚 Full Documentation

For detailed information, see:
- [REGULATOR_LOGIN_GUIDE.md](REGULATOR_LOGIN_GUIDE.md)
- [ADMIN_LOGIN_GUIDE.md](ADMIN_LOGIN_GUIDE.md)
- [ADMIN_REGULATOR_QUICK_REFERENCE.md](ADMIN_REGULATOR_QUICK_REFERENCE.md)

---

## ✅ Verification

### Verify Regulator Login Works
1. Create regulator account
2. Go to `/login`
3. Enter credentials
4. Should redirect to `/regulator/dashboard`
5. Should see dashboard with metrics

### Verify Admin Login Works
1. Create admin account
2. Go to `/login`
3. Enter credentials
4. Should redirect to `/admin/dashboard`
5. Should see dashboard with options

---

## 🎯 Next Steps

1. ✅ Create accounts
2. ✅ Login
3. ✅ Explore dashboards
4. ✅ Change passwords
5. ✅ Review documentation

---

**That's it! You're ready to go! 🚀**

For more details, check the full documentation files.
