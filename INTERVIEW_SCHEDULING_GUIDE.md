# Interview Scheduling Feature - Implementation Guide

## Overview
Employers can now schedule interviews with job seekers, and seekers can view their scheduled interviews with all details.

---

## Employer Features

### 1. Schedule Interview from Application
**Location:** Employer Applications View (`/employer/applications/{application}`)

**Steps:**
1. Go to Applications section
2. Click on an application to view details
3. Click "Schedule Interview" button in Quick Actions
4. Fill in the modal form:
   - Interview Date & Time (required)
   - Interview Type: Phone, Video, or In-Person (required)
   - Interviewer Name (required)
   - Interview Link (optional, for video/phone)
   - Employer Notes (optional)
5. Click "Schedule" to confirm

**What happens:**
- Application status changes to "interview"
- Interview details are saved to the database
- Seeker receives a notification about the scheduled interview

### 2. View All Interviews
**Location:** Employer Interviews Page (`/employer/interviews`)

**Features:**
- View upcoming interviews with all details
- View past interviews with outcomes
- See interview statistics (scheduled, completed, success rate)
- Quick access to interview details
- Unread message count

### 3. Manage Interview Details
**Location:** Interview Detail Page (`/employer/interviews/{application}`)

**Features:**
- View complete interview information
- See candidate details
- View communication history
- Reschedule interview (if upcoming)
- Join interview via link
- Set interview outcome (if completed)

**Actions Available:**
- **Reschedule:** Change interview date/time
- **Join Interview:** Direct link to video/phone meeting
- **Set Outcome:** Mark as Selected, Rejected, or Pending with feedback
- **View Application:** Go back to full application details

---

## Seeker Features

### 1. View Scheduled Interviews
**Location:** Seeker Interviews Page (`/seeker/interviews`)

**Features:**
- Upcoming interviews section with:
  - Job title
  - Interview type (phone/video/in-person)
  - Date and time
  - Interviewer name
  - Interview link (if available)
  - Latest messages
  - Unread message count

- Past interviews section with:
  - Interview outcome (Selected/Rejected/Pending)
  - Feedback from employer
  - Interview details

### 2. Interview Details
**Location:** Interview Detail Page (`/seeker/interviews/{application}`)

**Features:**
- Complete interview information
- Employer details
- Interview link (clickable to join)
- Communication history
- Timeline of application progress

**Actions Available:**
- **Join Interview:** Direct link to video/phone meeting
- **Request Reschedule:** Ask employer to change date/time
- **View Feedback:** See employer's feedback after interview

---

## Database Fields

All interview information is stored in the `applications` table:

| Field | Type | Description |
|-------|------|-------------|
| scheduled_date | timestamp | Interview date and time |
| interview_type | varchar | phone, video, or in-person |
| interviewer_name | varchar | Name of the interviewer |
| interview_link | varchar | Meeting link (Zoom, Teams, etc.) |
| interview_notes | text | Employer's notes about the interview |
| feedback | text | Feedback after the interview |
| interview_outcome | varchar | selected, rejected, or pending |
| interview_completed_at | timestamp | When the interview was completed |

---

## Communication System

When an interview is scheduled or outcome is set, the system automatically creates a communication record:

- **Type:** status_update
- **Recipient:** Job seeker
- **Content:** Interview scheduled/outcome notification
- **Metadata:** Interview details in JSON format

Seekers can see all communications in the interview detail view.

---

## Routes

### Employer Routes
```
GET    /employer/interviews                    - List all interviews
GET    /employer/interviews/{application}      - View interview details
POST   /employer/interviews/{application}/schedule - Schedule interview
POST   /employer/interviews/{application}/outcome  - Set interview outcome
```

### Seeker Routes
```
GET    /seeker/interviews                      - List all interviews
GET    /seeker/interviews/{application}        - View interview details
```

---

## Validation Rules

### Schedule Interview
- `scheduled_date`: Required, must be a future date
- `interview_type`: Required, must be phone/video/in-person
- `interviewer_name`: Required, max 255 characters
- `interview_link`: Optional, must be valid URL
- `employer_notes`: Optional, max 1000 characters

### Set Outcome
- `interview_outcome`: Required, must be selected/rejected/pending
- `feedback`: Optional, max 1000 characters

---

## User Experience Flow

### Employer Flow
1. View applications → Select candidate → Click "Schedule Interview"
2. Fill interview details → Submit
3. View interviews page to see all scheduled interviews
4. Click on interview to view details
5. After interview, set outcome and provide feedback

### Seeker Flow
1. Receive notification about scheduled interview
2. Go to Interviews page to see all scheduled interviews
3. Click on interview to view full details
4. Join interview via provided link
5. After interview, view feedback and outcome

---

## Files Modified/Created

### Controllers
- `app/Http/Controllers/Employer/InterviewsController.php` - Updated with schedule, show, setOutcome methods
- `app/Http/Controllers/Seeker/InterviewsController.php` - Already has index and show methods

### Views
- `resources/views/employer/interviews.blade.php` - Updated to show interview details
- `resources/views/employer/interview-detail.blade.php` - Created for interview management
- `resources/views/employer/applications-show.blade.php` - Updated with schedule button
- `resources/views/components/schedule-interview-modal.blade.php` - Created modal component
- `resources/views/seeker/interviews.blade.php` - Already displays scheduled interviews
- `resources/views/seeker/interview-detail.blade.php` - Already shows interview details

### Routes
- `routes/web.php` - Added interview routes

### Database
- `database/migrations/2026_05_18_000000_add_interview_fields_to_applications_table.php` - Interview fields
- `database/migrations/2026_05_19_000000_create_interview_communications_table.php` - Communication records

---

## Testing Checklist

- [ ] Employer can schedule interview from application
- [ ] Interview details are saved correctly
- [ ] Seeker receives notification
- [ ] Seeker can view scheduled interview
- [ ] Employer can view interview details
- [ ] Employer can reschedule interview
- [ ] Employer can set interview outcome
- [ ] Seeker can see interview outcome and feedback
- [ ] Interview link works correctly
- [ ] All validations work as expected
