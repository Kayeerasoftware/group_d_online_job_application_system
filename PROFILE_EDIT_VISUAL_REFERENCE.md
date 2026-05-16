# Profile Edit Page - Visual Reference & Component Guide

## Page Layout Overview

```
┌─────────────────────────────────────────────────────────────────┐
│                      HEADER SECTION                             │
│  ┌──────────────────────────────────────────────────────────┐   │
│  │ Profile Studio Badge                                     │   │
│  │ Build Your Professional Profile                          │   │
│  │ Complete your profile to increase visibility...          │   │
│  │                                                          │   │
│  │ [Completion: 65%] [Skills: 8] [Resume: ✓]              │   │
│  └──────────────────────────────────────────────────────────┘   │
└─────────────────────────────────────────────────────────────────┘

┌──────────────────────────────────────────┬─────────────────────┐
│                                          │                     │
│  MAIN CONTENT (Left Column)              │  SIDEBAR (Right)    │
│  ┌────────────────────────────────────┐  │ ┌─────────────────┐ │
│  │ Contact Information                │  │ │ Completion      │ │
│  │ ├─ Full Name (disabled)            │  │ │ Guide           │ │
│  │ ├─ Email (disabled)                │  │ │ ┌─────────────┐ │ │
│  │ ├─ Phone (disabled)                │  │ │ │ Progress: 65%│ │ │
│  │ └─ Location (editable)             │  │ │ └─────────────┘ │ │
│  └────────────────────────────────────┘  │ │ ✓ Add location  │ │
│                                          │ │ ✓ List skills   │ │
│  ┌────────────────────────────────────┐  │ │ ✓ Upload resume │ │
│  │ Career Information                 │  │ │ ✓ Save changes  │ │
│  │ ├─ Education Level                 │  │ └─────────────────┘ │
│  │ └─ Years of Experience             │  │                     │
│  └────────────────────────────────────┘  │ ┌─────────────────┐ │
│                                          │ │ Profile         │ │
│  ┌────────────────────────────────────┐  │ │ Snapshot        │ │
│  │ Personal Information               │  │ │ Location: —     │ │
│  │ ├─ Date of Birth                   │  │ │ Experience: —   │ │
│  │ └─ Gender                          │  │ │ Skills: 8       │ │
│  └────────────────────────────────────┘  │ │ Resume: ✓       │ │
│                                          │ └─────────────────┘ │
│  ┌────────────────────────────────────┐  │                     │
│  │ Professional Skills                │  │ ┌─────────────────┐ │
│  │ [Textarea with skills]             │  │ │ [Save Changes]  │ │
│  │ [Skill tags preview]               │  │ │ [Back to Profile]│ │
│  └────────────────────────────────────┘  │ └─────────────────┘ │
│                                          │                     │
│  ┌────────────────────────────────────┐  │                     │
│  │ Resume/CV                          │  │                     │
│  │ [Drag & drop upload area]          │  │                     │
│  │ [Current resume display]           │  │                     │
│  └────────────────────────────────────┘  │                     │
│                                          │                     │
└──────────────────────────────────────────┴─────────────────────┘
```

---

## Section Components

### 1. Header Section

```
┌─────────────────────────────────────────────────────────────┐
│ [●] PROFILE STUDIO                                          │
│                                                             │
│ Build Your Professional Profile                            │
│ Complete your profile to increase visibility to employers  │
│ and improve your chances of landing your dream job.        │
│                                                             │
│ ┌──────────────┐  ┌──────────────┐  ┌──────────────┐      │
│ │ Completion   │  │ Skills       │  │ Resume       │      │
│ │ 65%          │  │ 8            │  │ ✓            │      │
│ │ ▓▓▓▓▓░░░░░░░ │  │ Added        │  │ Uploaded     │      │
│ └──────────────┘  └──────────────┘  └──────────────┘      │
└─────────────────────────────────────────────────────────────┘
```

### 2. Contact Information Section

```
┌─────────────────────────────────────────────────────────────┐
│ [👤] Contact Information                                    │
│     Your basic contact details                              │
├─────────────────────────────────────────────────────────────┤
│                                                             │
│ Full Name                    │ Email                        │
│ [John Doe (disabled)]        │ [john@example.com (disabled)]│
│ Managed in account settings  │ Managed in account settings  │
│                                                             │
│ Phone                        │ Location                     │
│ [+256 701 234567 (disabled)] │ [Kampala, Uganda          ] │
│ Managed in account settings  │                              │
│                                                             │
└─────────────────────────────────────────────────────────────┘
```

### 3. Career Information Section

```
┌─────────────────────────────────────────────────────────────┐
│ [💼] Career Information                                     │
│     Your professional background                            │
├─────────────────────────────────────────────────────────────┤
│                                                             │
│ Education Level              │ Years of Experience         │
│ [Bachelor's in CS         ]  │ [5                        ] │
│                              │                             │
└─────────────────────────────────────────────────────────────┘
```

### 4. Personal Information Section

```
┌─────────────────────────────────────────────────────────────┐
│ [📅] Personal Information                                   │
│     Additional personal details                             │
├─────────────────────────────────────────────────────────────┤
│                                                             │
│ Date of Birth                │ Gender                      │
│ [1990-05-15               ]  │ [Male                    ▼] │
│                              │                             │
└─────────────────────────────────────────────────────────────┘
```

### 5. Professional Skills Section

```
┌─────────────────────────────────────────────────────────────┐
│ [⭐] Professional Skills                                    │
│     Highlight your key competencies                         │
├─────────────────────────────────────────────────────────────┤
│                                                             │
│ Skills List                                    8 skills    │
│ ┌─────────────────────────────────────────────────────────┐ │
│ │ Laravel, Vue.js, MySQL, Project Management,            │ │
│ │ Team Leadership, REST APIs, Docker, Git                │ │
│ └─────────────────────────────────────────────────────────┘ │
│ Use commas to separate skills. Be specific and relevant.   │
│                                                             │
│ Your Skills:                                                │
│ [Laravel] [Vue.js] [MySQL] [Project Management]            │
│ [Team Leadership] [REST APIs] [Docker] [Git]               │
│                                                             │
└─────────────────────────────────────────────────────────────┘
```

### 6. Resume/CV Section

```
┌─────────────────────────────────────────────────────────────┐
│ [📄] Resume/CV                                              │
│     Upload your latest resume                               │
├─────────────────────────────────────────────────────────────┤
│                                                             │
│ ┌─────────────────────────────────────────────────────────┐ │
│ │                                                         │ │
│ │              ☁️  Click to upload or drag and drop      │ │
│ │                                                         │ │
│ │              PDF, DOC, or DOCX (max 5MB)              │ │
│ │                                                         │ │
│ │              Selected: resume.pdf                      │ │
│ │                                                         │ │
│ └─────────────────────────────────────────────────────────┘ │
│                                                             │
│ ┌─────────────────────────────────────────────────────────┐ │
│ │ ✓ Current Resume                                        │ │
│ │   resume.pdf                                            │ │
│ └─────────────────────────────────────────────────────────┘ │
│                                                             │
└─────────────────────────────────────────────────────────────┘
```

### 7. Sidebar - Completion Guide

```
┌──────────────────────────────┐
│ [💡] Completion Guide        │
├──────────────────────────────┤
│                              │
│ Overall Progress             │
│ 65%                          │
│ ▓▓▓▓▓░░░░░░░░░░░░░░░░░░░░░ │
│                              │
│ ✓ Add location and exp.      │
│ ✓ List 5+ relevant skills    │
│ ✓ Upload latest resume       │
│ ✓ Review and save changes    │
│                              │
└──────────────────────────────┘
```

### 8. Sidebar - Profile Snapshot

```
┌──────────────────────────────┐
│ Profile Snapshot             │
├──────────────────────────────┤
│ Location        Kampala      │
│ Experience      5 yrs        │
│ Skills          8            │
│ Resume          ✓            │
└──────────────────────────────┘
```

### 9. Sidebar - Action Buttons

```
┌──────────────────────────────┐
│ [💾 Save Changes]            │
│ [← Back to Profile]          │
└──────────────────────────────┘
```

---

## Color Scheme

### Section Headers
| Section | Color | Icon | Hex |
|---------|-------|------|-----|
| Contact | Blue | 👤 | #3b82f6 |
| Career | Purple | 💼 | #a855f7 |
| Personal | Amber | 📅 | #f59e0b |
| Skills | Green | ⭐ | #22c55e |
| Resume | Red | 📄 | #ef4444 |
| Guide | Emerald | 💡 | #10b981 |

---

## Form Field States

### Default State
```
┌─────────────────────────────────┐
│ [Input field placeholder text]  │
└─────────────────────────────────┘
```

### Focused State
```
┌─────────────────────────────────┐
│ [Input field with value]        │ ← Blue border + ring
└─────────────────────────────────┘
```

### Disabled State
```
┌─────────────────────────────────┐
│ [Disabled field value]          │ ← Gray background
└─────────────────────────────────┘
Managed in account settings
```

### Error State
```
┌─────────────────────────────────┐
│ [Input field]                   │
└─────────────────────────────────┘
❌ This field is required
```

---

## Responsive Breakpoints

### Mobile (< 768px)
```
┌─────────────────────────────┐
│     HEADER SECTION          │
├─────────────────────────────┤
│   MAIN CONTENT              │
│   (Single column)           │
│                             │
│   Section 1                 │
│   Section 2                 │
│   Section 3                 │
│   Section 4                 │
│   Section 5                 │
│                             │
├─────────────────────────────┤
│   SIDEBAR                   │
│   (Below content)           │
│                             │
│   Guide                     │
│   Snapshot                  │
│   Buttons                   │
└─────────────────────────────┘
```

### Tablet (768px - 1024px)
```
┌──────────────────────────────────────┐
│        HEADER SECTION                │
├──────────────────────────────────────┤
│  MAIN CONTENT (2-col grids)          │
│                                      │
│  Section 1 (2 cols)                  │
│  Section 2 (2 cols)                  │
│  Section 3 (2 cols)                  │
│  Section 4 (full)                    │
│  Section 5 (full)                    │
│                                      │
├──────────────────────────────────────┤
│  SIDEBAR (Below)                     │
│  Guide | Snapshot | Buttons          │
└──────────────────────────────────────┘
```

### Desktop (> 1024px)
```
┌────────────────────────────────────────────────────────┐
│              HEADER SECTION                            │
├────────────────────────────────────────────────────────┤
│                                                        │
│  MAIN CONTENT (Left)      │  SIDEBAR (Right - Sticky) │
│  ┌──────────────────────┐ │ ┌────────────────────────┐│
│  │ Section 1 (2 cols)   │ │ │ Guide                  ││
│  │ Section 2 (2 cols)   │ │ │                        ││
│  │ Section 3 (2 cols)   │ │ │ Snapshot               ││
│  │ Section 4 (full)     │ │ │                        ││
│  │ Section 5 (full)     │ │ │ Buttons                ││
│  └──────────────────────┘ │ └────────────────────────┘│
│                                                        │
└────────────────────────────────────────────────────────┘
```

---

## Typography Scale

| Element | Size | Weight | Color |
|---------|------|--------|-------|
| Page Title | 2xl/3xl | Bold | slate-900 |
| Section Title | lg | Semibold | slate-900 |
| Field Label | xs | Semibold | slate-600 |
| Body Text | sm | Regular | slate-600 |
| Helper Text | xs | Regular | slate-500 |
| Error Text | xs | Medium | red-600 |
| Placeholder | sm | Regular | slate-400 |

---

## Spacing System

| Element | Spacing |
|---------|---------|
| Section padding | 24px (6 units) |
| Field gap | 20px (5 units) |
| Column gap | 24px (6 units) |
| Sidebar gap | 24px (6 units) |
| Header gap | 24px (6 units) |
| Button gap | 12px (3 units) |

---

## Interactive Elements

### Buttons

**Primary Button (Save Changes)**
```
┌─────────────────────────────┐
│ 💾 Save Changes             │
└─────────────────────────────┘
Background: Blue-600
Hover: Blue-700
Active: Scale 95%
```

**Secondary Button (Back to Profile)**
```
┌─────────────────────────────┐
│ ← Back to Profile           │
└─────────────────────────────┘
Background: White
Border: Slate-200
Hover: Slate-50
```

### File Upload Area

**Default State**
```
┌─────────────────────────────┐
│                             │
│      ☁️  Click to upload    │
│      or drag and drop       │
│                             │
│  PDF, DOC, DOCX (max 5MB)  │
│                             │
│  No file selected           │
│                             │
└─────────────────────────────┘
```

**Hover State**
```
┌─────────────────────────────┐
│                             │
│      ☁️  Click to upload    │ ← Blue border
│      or drag and drop       │ ← Blue background
│                             │
│  PDF, DOC, DOCX (max 5MB)  │
│                             │
│  No file selected           │
│                             │
└─────────────────────────────┘
```

**File Selected State**
```
┌─────────────────────────────┐
│                             │
│      ☁️  Click to upload    │
│      or drag and drop       │
│                             │
│  PDF, DOC, DOCX (max 5MB)  │
│                             │
│  Selected: resume.pdf       │ ← Blue text
│                             │
└─────────────────────────────┘

✓ Current Resume
  resume.pdf
```

---

## Accessibility Features

### Focus Indicators
- Blue border on focus
- Blue ring (2px)
- Clear visual indication
- Keyboard navigable

### Color Contrast
- Text: WCAG AA compliant
- Buttons: High contrast
- Icons: Visible on backgrounds
- Error messages: Red with sufficient contrast

### Semantic HTML
- Proper label associations
- Form structure
- Heading hierarchy
- ARIA attributes

---

## Animation & Transitions

### Hover Effects
- Input fields: Border color change
- Buttons: Background color change
- Upload area: Border and background change
- Icons: Scale up on hover

### Transitions
- Duration: 150-300ms
- Easing: ease-in-out
- Properties: color, background, border, transform

---

## Component Reusability

### Input Field Component
```blade
<div class="space-y-2">
    <label class="text-xs font-semibold uppercase tracking-wider text-slate-600">
        Label Text
    </label>
    <input
        type="text"
        name="field_name"
        placeholder="Placeholder text"
        class="w-full rounded-lg border border-slate-200 bg-white px-4 py-2.5 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-blue-400 focus:ring-2 focus:ring-blue-100"
    >
    @error('field_name')
        <p class="text-xs font-medium text-red-600">{{ $message }}</p>
    @enderror
</div>
```

### Section Header Component
```blade
<div class="border-b border-slate-100 bg-gradient-to-r from-[color]-50 to-[color]-100 px-6 py-5">
    <div class="flex items-center gap-3">
        <span class="inline-flex h-10 w-10 items-center justify-center rounded-lg bg-[color]-500 text-white">
            <i class="fas fa-[icon]"></i>
        </span>
        <div>
            <h2 class="text-lg font-semibold text-slate-900">Section Title</h2>
            <p class="text-sm text-slate-600">Section description</p>
        </div>
    </div>
</div>
```

---

## Browser Compatibility

| Browser | Support | Notes |
|---------|---------|-------|
| Chrome | ✓ | Full support |
| Firefox | ✓ | Full support |
| Safari | ✓ | Full support |
| Edge | ✓ | Full support |
| IE 11 | ✗ | Not supported |

---

## Performance Metrics

- **Page Load:** < 2s
- **Form Interaction:** < 100ms
- **File Upload:** Real-time feedback
- **Validation:** Instant feedback

---

## Conclusion

This visual reference provides a comprehensive guide to the profile edit page design, including layout, components, colors, typography, and responsive behavior. Use this as a reference when implementing or modifying the page.
