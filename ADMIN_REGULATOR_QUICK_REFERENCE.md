# Admin & Regulator Quick Reference Guide

## Regulator Access

### Dashboard
- **URL**: `/regulator/dashboard`
- **Purpose**: System overview, compliance metrics, recent activity
- **Accessible to**: Users with `regulator` role

### Compliance Monitoring
- **URL**: `/regulator/compliance`
- **Features**:
  - View all compliance reports
  - Filter by status (pending, submitted, approved, rejected)
  - Filter by date range
  - View detailed report information
  - Download reports

### Audit Logs
- **URL**: `/regulator/audit-logs`
- **Features**:
  - Track all system activities
  - View user actions
  - Monitor model changes
  - IP address tracking

### System Monitoring
- **URL**: `/regulator/system-monitoring`
- **Metrics**:
  - User statistics by role
  - Job statistics by status
  - Application statistics
  - Recent users and jobs

### Profile Management
- **View Profile**: `/regulator/profile`
- **Edit Profile**: `/regulator/profile/edit`
- **Update Password**: POST to `/regulator/profile/password`

---

## Admin Access

### Job Moderation
- **URL**: `/admin/jobs`
- **Actions**:
  - View all jobs
  - Flag jobs for review
  - Unflag jobs
  - Approve jobs
  - Reject jobs with reason
  - Delete jobs

**Job Moderation Routes**:
```
GET    /admin/jobs                    - List jobs
GET    /admin/jobs/{job}              - View job details
POST   /admin/jobs/{job}/flag         - Flag job
POST   /admin/jobs/{job}/unflag       - Unflag job
POST   /admin/jobs/{job}/approve      - Approve job
POST   /admin/jobs/{job}/reject       - Reject job
DELETE /admin/jobs/{job}              - Delete job
```

### Application Management
- **URL**: `/admin/applications`
- **Features**:
  - View all applications
  - Filter by status
  - Filter by job
  - View application details
  - Delete applications

**Application Routes**:
```
GET    /admin/applications            - List applications
GET    /admin/applications/{app}      - View application
GET    /admin/applications/filter     - Filter applications
DELETE /admin/applications/{app}      - Delete application
```

### Employer Management
- **URL**: `/admin/employers`
- **Actions**:
  - View all employers
  - View employer profiles
  - Suspend employer accounts
  - Activate employer accounts
  - Delete employer accounts

**Employer Routes**:
```
GET    /admin/employers               - List employers
GET    /admin/employers/{user}        - View employer details
POST   /admin/employers/{user}/suspend    - Suspend employer
POST   /admin/employers/{user}/activate   - Activate employer
DELETE /admin/employers/{user}        - Delete employer
```

### User Management
- **URL**: `/admin/users`
- **Features**:
  - View all users
  - Manage user roles
  - Suspend/activate users
  - Delete users

### Audit Logs
- **URL**: `/admin/audit-logs`
- **Purpose**: Track all system activities and changes

### System Settings
- **URL**: `/admin/system`
- **Purpose**: Configure system integration settings

### Compliance Reports
- **URL**: `/admin/reports`
- **Features**:
  - Create compliance reports
  - View reports
  - Submit reports
  - Download reports

---

## Key Features by Role

### Regulator
✅ Monitor system compliance
✅ Review audit logs
✅ Track system health
✅ View compliance reports
✅ Manage profile
✅ Real-time metrics

### Admin
✅ Moderate job listings
✅ Manage applications
✅ Manage employer accounts
✅ Manage user accounts
✅ View audit logs
✅ Configure system settings
✅ Generate compliance reports

---

## Common Tasks

### As a Regulator

**Check System Health**
1. Go to `/regulator/dashboard`
2. Review key metrics
3. Check recent activity

**Review Compliance Reports**
1. Go to `/regulator/compliance`
2. Filter by status or date
3. Click "View" to see details

**Monitor System Activity**
1. Go to `/regulator/audit-logs`
2. Review recent actions
3. Check user activities

### As an Admin

**Moderate a Job**
1. Go to `/admin/jobs`
2. Click on job to view details
3. Choose action: Flag, Approve, Reject, or Delete
4. Provide reason if needed

**Manage Employer**
1. Go to `/admin/employers`
2. Click on employer to view profile
3. Choose action: Suspend, Activate, or Delete

**Review Applications**
1. Go to `/admin/applications`
2. Filter by status or job
3. View application details
4. Delete if necessary

---

## Middleware Protection

All routes are protected by role-based middleware:
- Regulator routes: `middleware(['auth', 'regulator'])`
- Admin routes: `middleware(['auth', 'admin'])`

**Access Requirements**:
- User must be authenticated
- User must have correct role
- User account must be active

---

## Error Handling

### 403 Forbidden
- User doesn't have required role
- User account is inactive
- Insufficient permissions

### 404 Not Found
- Resource doesn't exist
- User doesn't have access to resource

### Validation Errors
- Required fields missing
- Invalid input format
- Duplicate entries

---

## Audit Logging

All actions are logged with:
- User ID
- Action type (created, updated, deleted, flagged, etc.)
- Model type and ID
- Timestamp
- IP address (when available)
- Description (for important actions)

---

## Tips & Best Practices

1. **Always provide reasons** when rejecting jobs or suspending employers
2. **Review audit logs regularly** to track system activity
3. **Use filters** to find specific reports or applications
4. **Check system monitoring** for unusual patterns
5. **Keep profile information updated**
6. **Use strong passwords** for admin/regulator accounts
7. **Log out** when finished with sensitive operations

---

## Support & Troubleshooting

### Can't access regulator/admin panel?
- Verify your role is set correctly
- Check if your account is active
- Clear browser cache and try again

### Missing data in reports?
- Check date filters
- Verify status filters
- Ensure data exists in system

### Actions not saving?
- Check form validation errors
- Verify required fields are filled
- Check browser console for errors

---

**Last Updated**: 2024
**Version**: 1.0
