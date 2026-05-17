# Interview Scheduling - Quick Reference

## For Employers

### Schedule an Interview
1. Go to **Applications** (`/employer/applications`)
2. Click on a candidate's application
3. Click **"Schedule Interview"** button
4. Fill in:
   - Date & Time (required)
   - Interview Type: Phone/Video/In-Person (required)
   - Interviewer Name (required)
   - Meeting Link (optional)
   - Notes (optional)
5. Click **"Schedule"**

### View All Interviews
- Go to **Interviews** (`/employer/interviews`)
- See upcoming and past interviews
- View statistics and success rate

### Manage Interview
1. Go to **Interviews** → Click on an interview
2. Available actions:
   - **Reschedule** - Change date/time
   - **Join Interview** - Open meeting link
   - **Set Outcome** - Mark as Selected/Rejected/Pending
   - **View Application** - See full application

---

## For Job Seekers

### View Scheduled Interviews
1. Go to **Interviews** (`/seeker/interviews`)
2. See all upcoming and past interviews
3. View interview details:
   - Date & Time
   - Interview Type
   - Interviewer Name
   - Meeting Link
   - Employer Notes

### Join Interview
1. Go to **Interviews** → Click on interview
2. Click **"Join Interview"** button
3. Opens meeting link in new tab

### Check Interview Outcome
1. Go to **Interviews** → Click on past interview
2. View:
   - Interview Outcome (Selected/Rejected/Pending)
   - Employer Feedback
   - Interview Details

---

## Database Fields

```
scheduled_date          - Interview date/time
interview_type          - phone, video, in-person
interviewer_name        - Name of interviewer
interview_link          - Meeting link URL
interview_notes         - Employer notes
feedback                - Interview feedback
interview_outcome       - selected, rejected, pending
interview_completed_at  - Completion timestamp
```

---

## API Endpoints

### Employer
```
GET    /employer/interviews
GET    /employer/interviews/{id}
POST   /employer/interviews/{id}/schedule
POST   /employer/interviews/{id}/outcome
```

### Seeker
```
GET    /seeker/interviews
GET    /seeker/interviews/{id}
```

---

## Status Flow

```
Application Created
    ↓
Employer Reviews
    ↓
Employer Schedules Interview
    ↓
Status: "interview"
    ↓
Interview Happens
    ↓
Employer Sets Outcome
    ↓
Status: "interview" + Outcome: "selected/rejected/pending"
```

---

## Notifications

When an interview is scheduled or outcome is set:
- Seeker receives automatic notification
- Communication record is created
- Seeker can see message in interview detail view

---

## Validation

### Schedule Interview
- Date must be in the future
- Interview type required
- Interviewer name required
- Link must be valid URL (if provided)

### Set Outcome
- Outcome must be: selected, rejected, or pending
- Feedback optional (max 1000 chars)

---

## Tips

✓ Always provide a meeting link for video/phone interviews
✓ Add notes to help the seeker prepare
✓ Set outcome immediately after interview
✓ Provide constructive feedback to candidates
✓ Check unread messages before interviews
