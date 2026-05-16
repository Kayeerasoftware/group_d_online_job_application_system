# Profile Edit Page - Design & Organization Guide

## Overview
The `/seeker/profile/edit` page has been redesigned with improved organization, better UX, and comprehensive sections for managing job seeker profiles.

---

## Page Structure

### 1. Header Section
**Purpose:** Introduce the profile editing experience and show quick stats

**Components:**
- Profile Studio badge with animated indicator
- Main heading: "Build Your Professional Profile"
- Descriptive subtitle
- Three quick stat cards:
  - Completion percentage with progress bar
  - Skills count
  - Resume status (✓ or ○)

**Design:**
- Gradient background (blue to slate)
- Responsive grid layout (1 column on mobile, 2 on desktop)
- Clean typography with clear hierarchy

---

### 2. Main Form Layout

#### Left Column (Main Content)
Contains all editable profile sections organized logically:

##### A. Contact Information Section
**Fields:**
- Full Name (disabled - managed in account settings)
- Email (disabled - managed in account settings)
- Phone (disabled - managed in account settings)
- Location (editable)

**Design:**
- Blue header with icon
- 2-column grid on desktop
- Disabled fields show as read-only with explanation
- Editable location field with focus states

**Purpose:** Display contact info and allow location updates

---

##### B. Career Information Section
**Fields:**
- Education Level (text input)
- Years of Experience (number input)

**Design:**
- Purple header with briefcase icon
- 2-column grid
- Number input with min/max constraints (0-70)
- Placeholder text for guidance

**Purpose:** Capture professional background

---

##### C. Personal Information Section
**Fields:**
- Date of Birth (date picker)
- Gender (dropdown select)

**Design:**
- Amber header with calendar icon
- 2-column grid
- Date picker with proper formatting
- Gender dropdown with 4 options:
  - Male
  - Female
  - Other
  - Prefer not to say

**Purpose:** Store personal details for profile completeness

---

##### D. Professional Skills Section
**Features:**
- Large textarea for comma-separated skills
- Real-time skill count display
- Visual skill tags preview (when skills are entered)
- Helper text explaining format

**Design:**
- Green header with star icon
- 6-row textarea with placeholder examples
- Skill counter in top-right
- Blue preview box showing parsed skills as tags
- Each skill displayed as a badge

**Purpose:** Allow users to list and preview their professional skills

---

##### E. Resume/CV Section
**Features:**
- Drag-and-drop file upload area
- File type restrictions (PDF, DOC, DOCX)
- File size limit (5MB)
- Current resume display (if uploaded)
- File name preview

**Design:**
- Red header with PDF icon
- Dashed border upload area
- Cloud upload icon with hover scale effect
- Success message showing current resume
- File name display with checkmark

**Purpose:** Allow users to upload and manage their resume

---

#### Right Sidebar (360px)
Sticky sidebar with helpful information and actions

##### A. Completion Guide
**Content:**
- Overall progress bar with percentage
- 4-point checklist:
  1. Add location and experience
  2. List 5+ relevant skills
  3. Upload latest resume
  4. Review and save changes

**Design:**
- Emerald header with lightbulb icon
- Progress bar with gradient
- Checkmark icons for each item
- Sticky positioning on desktop

**Purpose:** Guide users through profile completion

---

##### B. Profile Snapshot
**Displays:**
- Current Location
- Years of Experience
- Skills Count
- Resume Status

**Design:**
- Dark gradient background (slate-900 to slate-800)
- White text for contrast
- Semi-transparent white backgrounds for each item
- Real-time updates as user types

**Purpose:** Show current profile state at a glance

---

##### C. Action Buttons
**Buttons:**
1. Save Changes (primary - blue)
2. Back to Profile (secondary - white)

**Design:**
- Full width buttons
- Icon + text
- Hover and active states
- Proper spacing

**Purpose:** Allow users to save or cancel changes

---

## Design System

### Color Palette
- **Primary Blue:** `#2563eb` (bg-blue-600)
- **Purple:** `#a855f7` (bg-purple-500)
- **Amber:** `#d97706` (bg-amber-500)
- **Green:** `#22c55e` (bg-green-500)
- **Red:** `#ef4444` (bg-red-500)
- **Emerald:** `#10b981` (bg-emerald-500)
- **Slate:** `#64748b` (bg-slate-600)

### Typography
- **Headings:** Bold, clear hierarchy
- **Labels:** Uppercase, small, semibold
- **Body:** Regular weight, readable size
- **Placeholders:** Muted color, helpful examples

### Spacing
- **Section padding:** 6 units (24px)
- **Field spacing:** 5 units (20px)
- **Gap between columns:** 6 units (24px)
- **Sidebar gap:** 6 units (24px)

### Borders & Shadows
- **Borders:** 1px solid slate-200
- **Shadows:** Shadow-lg for sections
- **Rounded corners:** 2xl (16px) for sections, lg (8px) for inputs

### Focus States
- **Border color:** Blue-400
- **Ring:** 2px ring-blue-100
- **Transition:** Smooth

---

## Responsive Design

### Mobile (< 768px)
- Single column layout
- Full-width sections
- Sidebar moves below main content
- 2-column grids become single column
- Sticky sidebar becomes static

### Tablet (768px - 1024px)
- 2-column grids in sections
- Sidebar still below content
- Improved spacing

### Desktop (> 1024px)
- Main content + sticky sidebar layout
- 2-column grids maintained
- Sidebar sticks to top (top: 6)
- Full responsive experience

---

## Form Validation

### Field Validation
- **Location:** Optional text field
- **Education Level:** Optional text field
- **Years of Experience:** Number 0-70
- **Date of Birth:** Valid date format
- **Gender:** Dropdown selection
- **Skills:** Comma-separated text
- **Resume:** PDF, DOC, DOCX, max 5MB

### Error Display
- Error messages appear below fields
- Red text color (#dc2626)
- Small font size (xs)
- Medium font weight

### Success Feedback
- Green success box for current resume
- Checkmark icon
- Clear file name display

---

## User Experience Features

### 1. Real-time Feedback
- Skill count updates as user types
- Skill tags preview in real-time
- Resume file name updates on selection
- Progress bar updates dynamically

### 2. Helpful Guidance
- Placeholder text with examples
- Helper text below fields
- Completion guide in sidebar
- Profile snapshot showing current state

### 3. Accessibility
- Proper label associations
- Clear focus states
- Semantic HTML
- ARIA-friendly structure

### 4. Disabled Fields
- Contact info fields are disabled
- Explanation text directs to account settings
- Visual indication of disabled state
- Cursor shows not-allowed

---

## Data Flow

### On Page Load
1. Fetch user data from `auth()->user()`
2. Fetch profile data from `$profile`
3. Calculate completion percentage
4. Parse skills into array
5. Extract resume filename
6. Calculate skill count

### On Form Submit
1. Validate all fields
2. Parse skills from comma-separated to array
3. Handle file upload if present
4. Update profile in database
5. Redirect with success message

### On File Upload
1. Accept PDF, DOC, DOCX only
2. Validate file size (max 5MB)
3. Store in `storage/app/public/resumes`
4. Update resume_path in database

---

## Sections Organization

### Logical Grouping
1. **Contact** - Basic contact information
2. **Career** - Professional background
3. **Personal** - Personal details
4. **Skills** - Professional competencies
5. **Resume** - Document upload

### Visual Hierarchy
- Each section has distinct color header
- Icons help identify sections
- Clear spacing between sections
- Sidebar provides context

### Progressive Disclosure
- All sections visible at once
- No hidden content
- Clear field labels
- Helper text for guidance

---

## Accessibility Features

### Keyboard Navigation
- Tab through all form fields
- Enter to submit form
- Proper focus indicators
- Logical tab order

### Screen Readers
- Semantic HTML structure
- Proper label associations
- ARIA attributes where needed
- Descriptive button text

### Visual Accessibility
- High contrast text
- Clear focus states
- Readable font sizes
- Color not sole indicator

---

## Performance Considerations

### Optimization
- Minimal JavaScript (Alpine.js for file name)
- CSS-only animations
- Efficient form structure
- No unnecessary requests

### File Upload
- Client-side validation
- File size check
- Type validation
- Progress indication

---

## Browser Support
- Chrome/Edge (latest)
- Firefox (latest)
- Safari (latest)
- Mobile browsers

---

## Future Enhancements

### Potential Additions
1. **Experience Section** - Add/edit work experience
2. **Education Section** - Add/edit education history
3. **Certifications** - Add professional certifications
4. **Portfolio Links** - Add portfolio/GitHub links
5. **Languages** - Add language proficiencies
6. **Auto-save** - Save changes automatically
7. **Preview Mode** - Preview profile as employers see it
8. **Validation Feedback** - Real-time field validation
9. **Undo/Redo** - Undo recent changes
10. **Profile Strength** - AI-powered profile strength indicator

---

## Testing Checklist

- [ ] All form fields accept input correctly
- [ ] Validation messages display properly
- [ ] File upload works for PDF, DOC, DOCX
- [ ] File size validation works (5MB limit)
- [ ] Skills preview updates in real-time
- [ ] Completion percentage calculates correctly
- [ ] Disabled fields cannot be edited
- [ ] Form submits successfully
- [ ] Success message displays
- [ ] Responsive design works on all breakpoints
- [ ] Keyboard navigation works
- [ ] Focus states are visible
- [ ] Error messages are clear
- [ ] Sidebar sticks on desktop
- [ ] Mobile layout is clean

---

## File References

### View File
- `resources/views/jobseeker/profile-edit.blade.php`

### Controller
- `app/Http/Controllers/JobSeekerProfileController.php`

### Model
- `app/Models/JobSeekerProfile.php`

### Routes
- `GET /seeker/profile/edit` → Edit form
- `PUT /seeker/profile` → Update profile

### Requests
- `app/Http/Requests/UpdateJobSeekerProfileRequest.php`

---

## Styling Classes

### Section Headers
```html
<div class="border-b border-slate-100 bg-gradient-to-r from-[color]-50 to-[color]-100 px-6 py-5">
```

### Form Fields
```html
<input class="w-full rounded-lg border border-slate-200 bg-white px-4 py-2.5 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-blue-400 focus:ring-2 focus:ring-blue-100">
```

### Buttons
```html
<button class="w-full inline-flex items-center justify-center gap-2 rounded-lg bg-blue-600 px-4 py-3 text-sm font-semibold text-white transition hover:bg-blue-700 active:scale-95">
```

---

## Conclusion

The profile edit page provides a comprehensive, well-organized interface for job seekers to manage their professional profiles. With clear sections, helpful guidance, and responsive design, users can easily complete and maintain their profiles to increase visibility to employers.
