# Employer Pages - Visual Design Summary

## Design Consistency Overview

All employer pages follow a unified design system with consistent components, spacing, and interactions.

---

## Page Structure Template

Every employer page follows this structure:

```
┌─────────────────────────────────────────────────────────────┐
│  GRADIENT HEADER (Color varies by page)                     │
│  ┌─────────────────────────────────────────────────────────┐│
│  │ [Icon] Title                                            ││
│  │ Description                                             ││
│  │                                    [Optional Action]    ││
│  └─────────────────────────────────────────────────────────┘│
└─────────────────────────────────────────────────────────────┘

┌─────────────────────────────────────────────────────────────┐
│  KEY METRICS (4 Cards in responsive grid)                   │
│  ┌──────────────┬──────────────┬──────────────┬──────────────┐
│  │ [Icon] Stat1 │ [Icon] Stat2 │ [Icon] Stat3 │ [Icon] Stat4 │
│  │ 123          │ 45           │ 67           │ 89           │
│  └──────────────┴──────────────┴──────────────┴──────────────┘
└─────────────────────────────────────────────────────────────┘

┌─────────────────────────────────────────────────────────────┐
│  MAIN CONTENT (Responsive grid layout)                      │
│  ┌──────────────────────────────┬──────────────────────────┐
│  │ Primary Content              │ Sidebar                  │
│  │ (2/3 width on desktop)       │ (1/3 width on desktop)   │
│  │                              │                          │
│  │ ┌──────────────────────────┐ │ ┌────────────────────┐  │
│  │ │ Content Card             │ │ │ Sidebar Card 1     │  │
│  │ └──────────────────────────┘ │ └────────────────────┘  │
│  │                              │                          │
│  │ ┌──────────────────────────┐ │ ┌────────────────────┐  │
│  │ │ Content Card             │ │ │ Sidebar Card 2     │  │
│  │ └──────────────────────────┘ │ └────────────────────┘  │
│  └──────────────────────────────┴──────────────────────────┘
└─────────────────────────────────────────────────────────────┘
```

---

## Color Palette by Page

### Dashboard (Emerald/Teal)
```
Header:     #059669 → #0d9488 (Emerald to Teal)
Metrics:    Emerald, Blue, Purple, Orange
Primary:    #059669
Accent:     #0d9488
```

### Applications (Blue)
```
Header:     #2563eb → #1d4ed8 (Blue)
Metrics:    Blue, Yellow, Green, Red
Primary:    #2563eb
Accent:     #1d4ed8
```

### Interviews (Purple)
```
Header:     #a855f7 → #9333ea (Purple)
Metrics:    Purple, Orange, Green, Red
Primary:    #a855f7
Accent:     #9333ea
```

### Messages (Green)
```
Header:     #16a34a → #15803d (Green)
Metrics:    Green, Red, Blue, Gray
Primary:    #16a34a
Accent:     #15803d
```

### Notifications (Orange)
```
Header:     #ea580c → #dc2626 (Orange)
Metrics:    Orange, Red, Blue, Purple
Primary:    #ea580c
Accent:     #dc2626
```

### Settings (Gray)
```
Header:     #4b5563 → #374151 (Gray)
Metrics:    Gray, Red, Blue, Purple
Primary:    #4b5563
Accent:     #374151
```

---

## Component Specifications

### 1. Gradient Header
```
Height:     80-100px (responsive)
Padding:    p-3 md:p-4
Gradient:   from-[color]-600 to-[color]-700
Shadow:     shadow-lg
Border:     rounded-lg
Content:    Icon (24-32px) + Title + Description + Optional Button
```

### 2. Metric Cards
```
Grid:       grid-cols-2 sm:grid-cols-3 lg:grid-cols-4
Gap:        gap-2 md:gap-3
Padding:    p-2 md:p-3
Background: gradient-to-r from-[color]-50 to-[color]-100
Border:     border border-[color]-200
Radius:     rounded-lg
Shadow:     shadow-md
Hover:      shadow-lg scale-105
Icon:       w-12 h-12 gradient background
```

### 3. Content Cards
```
Background: bg-white
Padding:    p-4 md:p-6
Border:     rounded-xl
Shadow:     shadow-xl
Hover:      shadow-2xl
Spacing:    space-y-3 or space-y-4
```

### 4. Status Badges
```
Padding:    px-3 py-1
Font:       text-xs font-semibold
Radius:     rounded-full
Colors:
  - Pending:     bg-yellow-100 text-yellow-800
  - Shortlisted: bg-green-100 text-green-800
  - Rejected:    bg-red-100 text-red-800
  - Open:        bg-green-100 text-green-800
  - Closed:      bg-gray-100 text-gray-800
```

### 5. Buttons
```
Primary:
  - Background: bg-gradient-to-r from-[color]-600 to-[color]-700
  - Text:       text-white
  - Padding:    px-4 py-2 or px-6 py-3
  - Radius:     rounded-lg
  - Hover:      shadow-lg scale-105
  - Font:       font-semibold text-sm

Secondary:
  - Background: bg-white
  - Border:     border border-[color]-200
  - Text:       text-[color]-600
  - Hover:      bg-[color]-50

Danger:
  - Background: bg-red-600
  - Text:       text-white
  - Hover:      bg-red-700
```

---

## Responsive Breakpoints

### Mobile (< 640px)
- Single column layout
- Smaller padding (p-3)
- Smaller text (text-sm)
- 2-column metric grid
- Full-width buttons

### Tablet (640px - 1024px)
- 2-column layout where applicable
- Medium padding (p-4)
- Medium text (text-base)
- 3-column metric grid
- Flexible buttons

### Desktop (1024px+)
- 3-column layout (2/3 + 1/3)
- Larger padding (p-6)
- Larger text (text-lg)
- 4-column metric grid
- Inline buttons

---

## Typography Scale

```
Page Title:     text-2xl md:text-3xl font-bold
Section Title:  text-lg font-bold
Card Title:     text-base font-semibold
Label:          text-sm font-medium
Body:           text-sm
Caption:        text-xs
```

---

## Spacing System

```
Micro:      gap-1, p-1
Small:      gap-2, p-2, mb-2
Medium:     gap-3, p-3, mb-3, gap-4, p-4, mb-4
Large:      gap-6, p-6, mb-6
Extra:      gap-8, p-8, mb-8
```

---

## Icon Usage

All pages use Font Awesome icons:

```
Header Icons:       fas fa-[icon] (24-32px)
Metric Icons:       fas fa-[icon] (16-20px)
Button Icons:       fas fa-[icon] (14-16px)
List Icons:         fas fa-[icon] (12-14px)
```

---

## Animation & Transitions

```
Hover Effects:
  - Cards:         shadow-lg, scale-105
  - Buttons:       shadow-lg, scale-105
  - Links:         underline, color-change
  - Toggles:       smooth color transition

Transitions:
  - Duration:      duration-300
  - Timing:        ease-out, ease-in-out
  - Properties:    all, shadow, transform, color
```

---

## Form Elements

```
Input/Select:
  - Border:        border border-gray-300
  - Padding:       px-4 py-2
  - Radius:        rounded-lg
  - Focus:         focus:ring-2 focus:ring-[color]-500 focus:border-transparent
  - Font:          text-sm

Textarea:
  - Same as input
  - Min height:    min-h-[120px]

Toggle Switch:
  - Width:         w-11
  - Height:        h-6
  - Radius:        rounded-full
  - Checked:       peer-checked:bg-[color]-600
```

---

## Data Display

### Tables
```
Header:     bg-gray-100, font-semibold
Rows:       border-b border-gray-200
Hover:      bg-gray-50
Padding:    px-4 py-3
```

### Lists
```
Item:       p-3 md:p-4
Border:     border border-gray-200
Hover:      bg-[color]-50
Radius:     rounded-lg
```

### Cards
```
Header:     flex justify-between items-center
Content:    space-y-3
Footer:     flex gap-2
```

---

## Empty States

```
Icon:       fas fa-[icon] text-5xl text-gray-400
Title:      text-xl font-bold text-gray-900
Message:    text-gray-600
Action:     Optional button or link
```

---

## Accessibility

- All interactive elements have focus states
- Color is not the only indicator (use icons + text)
- Sufficient color contrast (WCAG AA)
- Semantic HTML structure
- ARIA labels where needed
- Keyboard navigation support

---

## Performance Metrics

- Page Load:     < 2 seconds
- First Paint:   < 1 second
- Interaction:   < 100ms
- CSS Size:      ~50KB (Tailwind)
- JS Size:       Minimal (Alpine.js)

---

## Browser Compatibility

- Chrome 90+
- Firefox 88+
- Safari 14+
- Edge 90+
- Mobile browsers (iOS 14+, Android 10+)

---

## Design Files

All pages are built with:
- **Framework**: Laravel Blade
- **CSS**: Tailwind CSS
- **Icons**: Font Awesome 6
- **JS**: Alpine.js (minimal)
- **Responsive**: Mobile-first approach

---

## Quick Reference

### Add a New Page
1. Copy dashboard structure
2. Change header color
3. Update metric cards
4. Add content sections
5. Add sidebar if needed
6. Test responsiveness

### Update Colors
1. Change gradient in header
2. Update metric card colors
3. Update button colors
4. Update badge colors
5. Test contrast

### Add New Metric
1. Copy metric card HTML
2. Change icon and label
3. Update color scheme
4. Add data binding
5. Test on all breakpoints
