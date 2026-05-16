# Seeker Dashboard - Design System & Component Library

## 🎨 Color Palette

### Primary Colors
```
Blue (#3b82f6)
- Primary actions
- Links and highlights
- Active states
- Primary buttons
```

### Success Colors
```
Green (#22c55e)
- Success states
- Positive actions
- Approved status
- Checkmarks
```

### Alert Colors
```
Red (#ef4444)
- Alerts and errors
- Rejections
- Delete actions
- Warnings
```

### Secondary Colors
```
Purple (#a855f7)
- Secondary actions
- Alternative highlights
- Special features

Orange (#f59e0b)
- Warnings
- Important notices
- Pending states

Teal (#14b8a6)
- Tertiary actions
- Additional highlights
```

### Neutral Colors
```
Gray (#6b7280)
- Text and borders
- Disabled states
- Secondary information
- Backgrounds
```

## 📐 Typography

### Headings
```
H1: text-3xl font-bold
H2: text-2xl font-bold
H3: text-xl font-bold
H4: text-lg font-bold
```

### Body Text
```
Regular: text-base
Small: text-sm
Extra Small: text-xs
```

### Font Weights
```
Regular: font-normal
Semibold: font-semibold
Bold: font-bold
```

## 🧩 Component Library

### 1. Stats Cards
```html
<div class="bg-gradient-to-r from-blue-50 to-blue-100 rounded-lg shadow-md p-4 hover:shadow-lg hover:scale-105 transition-all duration-300 border border-blue-200">
    <div class="flex items-center gap-3">
        <div class="bg-gradient-to-br from-blue-500 to-blue-600 p-2.5 rounded-lg shadow">
            <i class="fas fa-icon text-white"></i>
        </div>
        <div class="flex-1">
            <p class="text-sm text-gray-600 font-semibold">Label</p>
            <h3 class="text-3xl font-bold text-gray-900">Value</h3>
        </div>
    </div>
</div>
```

### 2. Buttons

#### Primary Button
```html
<button class="px-6 py-2 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition">
    <i class="fas fa-icon mr-2"></i>Action
</button>
```

#### Secondary Button
```html
<button class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg font-semibold hover:bg-gray-50 transition">
    <i class="fas fa-icon mr-2"></i>Action
</button>
```

#### Danger Button
```html
<button class="px-6 py-2 bg-red-600 text-white rounded-lg font-semibold hover:bg-red-700 transition">
    <i class="fas fa-trash mr-2"></i>Delete
</button>
```

### 3. Cards

#### Standard Card
```html
<div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition">
    <h3 class="text-lg font-bold text-gray-800 mb-4">Title</h3>
    <!-- Content -->
</div>
```

#### Job Card
```html
<div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition border-l-4 border-blue-600">
    <div class="flex items-center gap-4 mb-3">
        <div class="w-16 h-16 rounded-lg bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center">
            <i class="fas fa-icon text-white text-2xl"></i>
        </div>
        <div>
            <h3 class="text-lg font-bold text-gray-900">Title</h3>
            <p class="text-gray-600">Subtitle</p>
        </div>
    </div>
</div>
```

### 4. Input Fields

#### Text Input
```html
<input type="text" placeholder="Placeholder..." class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
```

#### Select Dropdown
```html
<select class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
    <option>Option 1</option>
    <option>Option 2</option>
</select>
```

### 5. Badges & Tags

#### Status Badge
```html
<span class="px-4 py-2 bg-green-100 text-green-800 rounded-full text-sm font-semibold">
    Status
</span>
```

#### Skill Tag
```html
<span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-xs font-semibold">
    Skill
</span>
```

### 6. Progress Bar
```html
<div class="w-full bg-gray-200 rounded-full h-2">
    <div class="bg-blue-600 h-2 rounded-full" style="width: 85%"></div>
</div>
```

### 7. Toggle Switch
```html
<label class="relative inline-flex items-center cursor-pointer">
    <input type="checkbox" class="sr-only peer" checked>
    <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
</label>
```

### 8. Notification Card
```html
<div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-green-600">
    <div class="flex items-start gap-4">
        <div class="w-12 h-12 rounded-full bg-gradient-to-br from-green-400 to-green-600 flex items-center justify-center">
            <i class="fas fa-icon text-white"></i>
        </div>
        <div class="flex-1">
            <h3 class="text-lg font-bold text-gray-900">Title</h3>
            <p class="text-gray-600 mt-1">Description</p>
        </div>
    </div>
</div>
```

### 9. Header Section
```html
<div class="bg-gradient-to-r from-blue-600 to-indigo-600 rounded-lg shadow-lg p-6">
    <h1 class="text-3xl font-bold text-white mb-2">Title</h1>
    <p class="text-blue-100">Subtitle</p>
</div>
```

### 10. Tab Navigation
```html
<div class="flex flex-wrap gap-2">
    <button class="px-4 py-2 bg-blue-600 text-white rounded-lg font-semibold">
        <i class="fas fa-icon mr-2"></i>Active Tab
    </button>
    <button class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg font-semibold hover:bg-gray-200">
        <i class="fas fa-icon mr-2"></i>Inactive Tab
    </button>
</div>
```

## 🎯 Spacing System

```
xs: 0.25rem (4px)
sm: 0.5rem (8px)
md: 1rem (16px)
lg: 1.5rem (24px)
xl: 2rem (32px)
2xl: 3rem (48px)
```

## 🔲 Border Radius

```
Small: rounded-lg (0.5rem)
Medium: rounded-xl (0.75rem)
Large: rounded-2xl (1rem)
Full: rounded-full (9999px)
```

## 🎬 Animations & Transitions

### Hover Effects
```css
hover:shadow-lg
hover:shadow-xl
hover:scale-105
hover:bg-gray-50
hover:text-blue-600
```

### Transitions
```css
transition
transition-all
duration-300
ease-in-out
```

### Animations
```css
animate-pulse
animate-slide-right
animate-slide-text
```

## 📱 Responsive Breakpoints

```
Mobile: < 640px (sm)
Tablet: 640px - 1024px (md, lg)
Desktop: > 1024px (xl, 2xl)
```

### Grid Layouts
```
Mobile: grid-cols-1
Tablet: md:grid-cols-2
Desktop: lg:grid-cols-3 or lg:grid-cols-4
```

## 🎨 Gradient Backgrounds

### Header Gradients
```
Blue to Indigo: from-blue-600 to-indigo-600
Green to Teal: from-green-600 to-teal-600
Purple to Pink: from-purple-600 to-pink-600
```

### Card Gradients
```
Light Blue: from-blue-50 to-blue-100
Light Green: from-green-50 to-green-100
Light Purple: from-purple-50 to-purple-100
```

### Icon Gradients
```
Blue: from-blue-400 to-blue-600
Green: from-green-400 to-green-600
Purple: from-purple-400 to-purple-600
```

## 🔤 Icon Usage

### Icon Sizes
```
Small: text-lg
Medium: text-2xl
Large: text-4xl
Extra Large: text-6xl
```

### Icon Spacing
```
With Text: mr-2 (margin-right)
Standalone: text-center
```

## 📊 Chart Configuration

### Common Options
```javascript
responsive: true
maintainAspectRatio: true
aspectRatio: 2
interaction: { mode: 'index', intersect: true }
```

### Chart Types
- Line Chart (Trends)
- Bar Chart (Comparisons)
- Doughnut Chart (Distributions)
- Pie Chart (Percentages)
- Radar Chart (Analytics)
- Polar Area Chart (Breakdowns)

## 🎯 Design Principles

1. **Consistency** - Same components used across all pages
2. **Hierarchy** - Clear visual hierarchy with typography
3. **Color Coding** - Status indicated by color
4. **Spacing** - Consistent padding and margins
5. **Responsiveness** - Works on all screen sizes
6. **Accessibility** - Proper contrast and readable text
7. **Interactivity** - Hover effects and transitions
8. **Performance** - Optimized CSS and minimal JavaScript

## 📋 Component Checklist

- ✅ Stats Cards
- ✅ Buttons (Primary, Secondary, Danger)
- ✅ Cards (Standard, Job, Notification)
- ✅ Input Fields
- ✅ Badges & Tags
- ✅ Progress Bars
- ✅ Toggle Switches
- ✅ Headers
- ✅ Tab Navigation
- ✅ Pagination
- ✅ Modals (Ready for implementation)
- ✅ Dropdowns (Ready for implementation)

## 🚀 Usage Tips

1. **Consistency** - Always use the same component styles
2. **Colors** - Use the defined color palette
3. **Spacing** - Follow the spacing system
4. **Typography** - Use defined heading and text styles
5. **Icons** - Use Font Awesome icons consistently
6. **Responsive** - Test on mobile, tablet, and desktop
7. **Accessibility** - Ensure proper contrast and labels
8. **Performance** - Minimize custom CSS

## 📚 Component Examples

All components are implemented in the seeker dashboard pages:
- Dashboard: Stats cards, charts, headers
- Profile: Cards, buttons, sections
- Applications: List cards, badges, filters
- Jobs: Job cards, tags, buttons
- Messages: Chat cards, input fields
- Notifications: Notification cards, badges
- Settings: Toggle switches, form inputs
- Resume: File cards, buttons, sections

---

**Design System Version**: 1.0
**Last Updated**: December 2024
**Status**: Production Ready
