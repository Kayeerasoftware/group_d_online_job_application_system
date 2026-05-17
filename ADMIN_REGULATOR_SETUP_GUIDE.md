# Admin & Regulator Setup & Deployment Guide

## Prerequisites

- Laravel 11+ installed
- PHP 8.2+ 
- MySQL database
- Composer installed
- Node.js and npm (for frontend assets)

---

## Installation Steps

### 1. Update Enums
The `UserRole` enum has been updated to include the `Regulator` role.

**File**: `app/Enums/UserRole.php`
```php
enum UserRole: string
{
    case Seeker = 'seeker';
    case Employer = 'employer';
    case Admin = 'admin';
    case Regulator = 'regulator';  // NEW
}
```

### 2. Create Regulator Users

To create a regulator user, use the following command or create through the admin panel:

```bash
php artisan tinker
```

Then in tinker:
```php
$user = User::create([
    'name' => 'Regulator Name',
    'email' => 'regulator@example.com',
    'password' => bcrypt('password'),
    'role' => 'regulator',
    'is_active' => true,
]);
```

Or use a seeder:
```bash
php artisan make:seeder RegulatorSeeder
```

### 3. Database Migrations

Ensure all existing migrations are run:
```bash
php artisan migrate
```

The following tables should exist:
- `users` (with `role` and `is_active` columns)
- `jobs` (with `is_flagged` column)
- `applications`
- `audit_logs`
- `regulatory_reports`
- `employer_profiles`

### 4. Clear Cache

After deploying new code:
```bash
php artisan cache:clear
php artisan config:clear
php artisan route:cache
```

### 5. Compile Assets

If you've modified any frontend assets:
```bash
npm run build
```

For development:
```bash
npm run dev
```

---

## File Structure

### New Controllers
```
app/Http/Controllers/
├── Regulator/
│   ├── DashboardController.php
│   ├── ComplianceController.php
│   ├── SystemMonitoringController.php
│   └── ProfileController.php
└── Admin/
    ├── JobModerationController.php (enhanced)
    ├── ApplicationManagementController.php (new)
    └── EmployerManagementController.php (new)
```

### New Middleware
```
app/Http/Middleware/
└── IsRegulator.php
```

### New Views
```
resources/views/
├── regulator/
│   ├── dashboard.blade.php
│   ├── profile.blade.php
│   ├── profile-edit.blade.php
│   ├── compliance/
│   │   ├── index.blade.php
│   │   ├── show.blade.php
│   │   └── audit.blade.php
│   └── system-monitoring/
│       └── index.blade.php
└── admin/
    ├── jobs/
    │   ├── index.blade.php (if not exists)
    │   └── show.blade.php (if not exists)
    ├── applications/
    │   ├── index.blade.php (if not exists)
    │   └── show.blade.php (if not exists)
    └── employers/
        ├── index.blade.php (if not exists)
        └── show.blade.php (if not exists)
```

---

## Configuration

### 1. Update Kernel (if needed)

If using custom middleware registration, ensure `IsRegulator` is registered in `app/Http/Kernel.php`:

```php
protected $routeMiddleware = [
    // ... existing middleware
    'regulator' => \App\Http\Middleware\IsRegulator::class,
];
```

### 2. Update Routes

Routes are already configured in `routes/web.php`. Verify the following route groups exist:

```php
Route::prefix('regulator')->middleware(['auth', 'regulator'])->name('regulator.')->group(function () {
    // Regulator routes
});

Route::prefix('admin')->middleware(['auth', 'admin'])->name('admin.')->group(function () {
    // Admin routes
});
```

### 3. Update Navigation

Add navigation links to your layout files:

**For Regulator**:
```blade
@if(auth()->user()->role === 'regulator')
    <a href="{{ route('regulator.dashboard') }}">Regulator Dashboard</a>
    <a href="{{ route('regulator.compliance.index') }}">Compliance Reports</a>
    <a href="{{ route('regulator.audit-logs') }}">Audit Logs</a>
    <a href="{{ route('regulator.system-monitoring') }}">System Monitoring</a>
@endif
```

**For Admin**:
```blade
@if(auth()->user()->role === 'admin')
    <a href="{{ route('admin.dashboard') }}">Admin Dashboard</a>
    <a href="{{ route('admin.jobs.index') }}">Job Moderation</a>
    <a href="{{ route('admin.applications.index') }}">Applications</a>
    <a href="{{ route('admin.employers.index') }}">Employers</a>
@endif
```

---

## Testing

### 1. Test Regulator Access

```bash
# Create test regulator
php artisan tinker
$user = User::factory()->create(['role' => 'regulator']);

# Test routes
curl http://localhost:8000/regulator/dashboard
```

### 2. Test Admin Access

```bash
# Create test admin
php artisan tinker
$user = User::factory()->create(['role' => 'admin']);

# Test routes
curl http://localhost:8000/admin/jobs
curl http://localhost:8000/admin/applications
curl http://localhost:8000/admin/employers
```

### 3. Test Middleware Protection

```bash
# Try accessing without authentication
curl http://localhost:8000/regulator/dashboard
# Should redirect to login

# Try accessing with wrong role
# Should return 403 Forbidden
```

### 4. Run Tests

```bash
php artisan test
```

---

## Deployment Checklist

- [ ] All migrations run successfully
- [ ] Regulator role added to UserRole enum
- [ ] New controllers created
- [ ] New middleware created
- [ ] New views created
- [ ] Routes configured
- [ ] Navigation updated
- [ ] Middleware registered (if needed)
- [ ] Cache cleared
- [ ] Assets compiled
- [ ] Test regulator access
- [ ] Test admin access
- [ ] Test middleware protection
- [ ] Verify audit logging
- [ ] Check error handling
- [ ] Test pagination
- [ ] Test filtering
- [ ] Verify form validation

---

## Troubleshooting

### Issue: "Class not found" error

**Solution**: Run composer autoload
```bash
composer dump-autoload
```

### Issue: Routes not working

**Solution**: Clear route cache
```bash
php artisan route:cache
php artisan route:clear
```

### Issue: Views not found

**Solution**: Verify view paths and clear cache
```bash
php artisan view:clear
```

### Issue: Middleware not protecting routes

**Solution**: Verify middleware is registered in Kernel.php and routes use correct middleware

### Issue: Database errors

**Solution**: Run migrations
```bash
php artisan migrate
php artisan migrate:refresh --seed
```

---

## Performance Optimization

### 1. Database Indexing

Ensure these columns are indexed:
```sql
ALTER TABLE users ADD INDEX idx_role (role);
ALTER TABLE users ADD INDEX idx_is_active (is_active);
ALTER TABLE jobs ADD INDEX idx_is_flagged (is_flagged);
ALTER TABLE jobs ADD INDEX idx_status (status);
ALTER TABLE applications ADD INDEX idx_status (status);
ALTER TABLE audit_logs ADD INDEX idx_user_id (user_id);
ALTER TABLE audit_logs ADD INDEX idx_created_at (created_at);
```

### 2. Query Optimization

Use eager loading in controllers:
```php
$jobs = Job::with('employer')->paginate(15);
$applications = Application::with(['job', 'user'])->paginate(15);
```

### 3. Caching

Cache frequently accessed data:
```php
$stats = Cache::remember('user_stats', 3600, function () {
    return [
        'total' => User::count(),
        'seekers' => User::where('role', 'seeker')->count(),
    ];
});
```

---

## Security Considerations

### 1. Role-Based Access Control
- All routes protected by role middleware
- User active status verified
- Unauthorized access returns 403

### 2. Audit Logging
- All actions logged to audit_logs table
- User identification tracked
- Timestamps recorded

### 3. Input Validation
- All forms validated
- CSRF protection enabled
- SQL injection prevention

### 4. Password Security
- Passwords hashed with bcrypt
- Password change functionality available
- Current password verification required

---

## Monitoring & Maintenance

### 1. Regular Backups
```bash
# Backup database
mysqldump -u user -p database > backup.sql
```

### 2. Log Monitoring
```bash
# Check application logs
tail -f storage/logs/laravel.log
```

### 3. Audit Log Review
- Regularly review audit logs
- Monitor for suspicious activities
- Check for failed access attempts

### 4. Performance Monitoring
- Monitor query performance
- Check database size
- Review slow query logs

---

## Rollback Procedure

If issues occur after deployment:

### 1. Revert Code Changes
```bash
git revert <commit-hash>
git push
```

### 2. Clear Cache
```bash
php artisan cache:clear
php artisan config:clear
php artisan route:clear
```

### 3. Restore Database (if needed)
```bash
mysql -u user -p database < backup.sql
```

---

## Support & Documentation

- **Implementation Guide**: `ADMIN_REGULATOR_IMPLEMENTATION.md`
- **Quick Reference**: `ADMIN_REGULATOR_QUICK_REFERENCE.md`
- **Laravel Documentation**: https://laravel.com/docs
- **Database Schema**: Check migrations in `database/migrations/`

---

## Version History

| Version | Date | Changes |
|---------|------|---------|
| 1.0 | 2024 | Initial implementation |

---

**Last Updated**: 2024
**Status**: Ready for Production
