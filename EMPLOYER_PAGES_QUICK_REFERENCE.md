# Employer Pages - Quick Reference Guide

## All Pages at a Glance

| Page | Route | Color | Metrics | Key Features |
|------|-------|-------|---------|--------------|
| Dashboard | `/employer/dashboard` | Emerald | 4 | Jobs, Apps, Shortlisted, Interviews |
| Applications | `/employer/applications` | Blue | 4 | Total, Pending, Shortlisted, Rejected |
| Interviews | `/employer/interviews` | Purple | 4 | Scheduled, Today, Completed, Cancelled |
| Messages | `/employer/messages` | Green | 4 | Total, Unread, Active, Archived |
| Notifications | `/employer/notifications` | Orange | 4 | Total, Unread, Applications, System |
| Settings | `/employer/settings` | Gray | N/A | Account, Notifications, Privacy, Billing |
| Profile | `/employer/profile` | Emerald | N/A | Company info, description, location |
| All Employers | `/employer/all-employers` | Blue | N/A | Browse employers, search, filter |

---

## Page Features Matrix

### Dashboard
- ✅ Welcome header with profile
- ✅ 4 key metrics
- ✅ Recent jobs section
- ✅ Recent applications
- ✅ Company profile card
- ✅ Quick actions
- ✅ Notifications feed

### Applications
- ✅ Blue header
- ✅ 4 status metrics
- ✅ Search & filter
- ✅ Application cards
- ✅ Candidate info
- ✅ Action buttons
- ✅ Pagination

### Interviews
- ✅ Purple header
- ✅ 4 interview metrics
- ✅ Upcoming interviews
- ✅ Recent results
- ✅ Statistics sidebar
- ✅ Quick actions
- ✅ Tips section

### Messages
- ✅ Green header
- ✅ 4 conversation metrics
- ✅ Conversation list
- ✅ Chat interface
- ✅ Message history
- ✅ Call/video options
- ✅ Search conversations

### Notifications
- ✅ Orange header
- ✅ 4 notification metrics
- ✅ Filter tabs
- ✅ Notification cards
- ✅ Type-specific icons
- ✅ Mark as read
- ✅ Delete option

### Settings
- ✅ Gray header
- ✅ Sidebar navigation
- ✅ Account settings
- ✅ Notification preferences
- ✅ Privacy & security
- ✅ Billing info
- ✅ Danger zone

---

## Color Scheme Quick Reference

```
Dashboard:      #059669 (Emerald)
Applications:   #2563eb (Blue)
Interviews:     #a855f7 (Purple)
Messages:       #16a34a (Green)
Notifications:  #ea580c (Orange)
Settings:       #4b5563 (Gray)
```

---

## Component Checklist

### Every Page Should Have:
- [ ] Gradient header with icon, title, description
- [ ] 4 metric cards (or N/A for settings)
- [ ] Main content area
- [ ] Responsive grid layout
- [ ] Consistent spacing
- [ ] Hover effects
- [ ] Mobile-friendly design
- [ ] Proper color scheme

### Optional Components:
- [ ] Sidebar navigation (settings)
- [ ] Search/filter (applications, messages)
- [ ] Action buttons (header or cards)
- [ ] Statistics section (interviews)
- [ ] Tips/help section (interviews)
- [ ] Empty state message

---

## File Locations

```
resources/views/employer/
├── dashboard.blade.php              ✅ Complete
├── applications.blade.php           ✅ Complete
├── interviews.blade.php             ✅ Complete
├── messages.blade.php               ✅ Complete
├── notifications.blade.php          ✅ Complete
├── settings.blade.php               ✅ Complete
├── profile.blade.php                (Existing)
├── profile-edit.blade.php           (Existing)
├── all-employers.blade.php          ✅ Complete
├── browse-jobs.blade.php            (Existing)
├── applications-show.blade.php      (Existing)
├── job-search.blade.php             (Existing)
└── ...
```

---

## Responsive Design Checklist

### Mobile (< 640px)
- [ ] Single column layout
- [ ] 2-column metric grid
- [ ] Readable text size
- [ ] Touch-friendly buttons
- [ ] No horizontal scroll

### Tablet (640px - 1024px)
- [ ] 2-column layout
- [ ] 3-column metric grid
- [ ] Balanced spacing
- [ ] Visible sidebar (if applicable)

### Desktop (1024px+)
- [ ] 3-column layout (2/3 + 1/3)
- [ ] 4-column metric grid
- [ ] Full sidebar
- [ ] Optimal spacing

---

## Common Patterns

### Metric Card
```blade
<div class="bg-gradient-to-r from-[color]-50 to-[color]-100 rounded-lg shadow-md p-2 md:p-3 hover:shadow-lg hover:scale-105 transition-all duration-300 border border-[color]-200">
    <div class="flex items-center gap-2 md:gap-3">
        <div class="bg-gradient-to-br from-[color]-500 to-[color]-600 p-2 md:p-2.5 rounded-lg shadow">
            <i class="fas fa-[icon] text-white text-base md:text-lg"></i>
        </div>
        <div class="flex-1">
            <p class="text-xs md:text-sm text-gray-600 font-semibold leading-tight">Label</p>
            <h3 class="text-xl md:text-3xl font-bold text-gray-900 leading-tight">{{ $value }}</h3>
        </div>
    </div>
</div>
```

### Content Card
```blade
<div class="bg-white rounded-xl shadow-xl p-6 hover:shadow-2xl transition">
    <div class="flex justify-between items-center mb-4">
        <h3 class="text-lg font-bold text-gray-800 flex items-center">
            <i class="fas fa-[icon] text-[color]-600 mr-2"></i>Title
        </h3>
        <a href="#" class="text-[color]-600 text-sm hover:underline font-semibold">View All →</a>
    </div>
    <!-- Content here -->
</div>
```

### Status Badge
```blade
<span class="px-3 py-1 text-xs rounded-full font-semibold bg-[color]-100 text-[color]-800">
    {{ $status }}
</span>
```

### Primary Button
```blade
<button class="px-4 py-2 bg-gradient-to-r from-[color]-600 to-[color]-700 text-white rounded-lg hover:shadow-lg transition-all duration-300 font-semibold text-sm">
    <i class="fas fa-[icon] mr-2"></i>Label
</button>
```

---

## Data Binding Examples

### Metrics
```blade
{{ $totalApplications ?? 0 }}
{{ $pendingApplications ?? 0 }}
{{ $shortlistedApplications ?? 0 }}
{{ $rejectedApplications ?? 0 }}
```

### Lists
```blade
@forelse($applications ?? [] as $application)
    <!-- Display item -->
@empty
    <!-- Empty state -->
@endforelse
```

### Conditionals
```blade
@if($notification->read_at)
    <!-- Read state -->
@else
    <!-- Unread state -->
@endif
```

---

## Testing Checklist

### Functionality
- [ ] All links work
- [ ] Forms submit
- [ ] Filters work
- [ ] Search works
- [ ] Pagination works
- [ ] Buttons trigger actions
- [ ] Modals open/close

### Design
- [ ] Colors match spec
- [ ] Spacing is consistent
- [ ] Fonts are correct
- [ ] Icons display
- [ ] Shadows render
- [ ] Gradients show

### Responsive
- [ ] Mobile layout works
- [ ] Tablet layout works
- [ ] Desktop layout works
- [ ] No horizontal scroll
- [ ] Touch targets are large enough
- [ ] Text is readable

### Performance
- [ ] Page loads quickly
- [ ] No console errors
- [ ] Images optimized
- [ ] CSS minified
- [ ] JS minimal

### Accessibility
- [ ] Keyboard navigation works
- [ ] Focus indicators visible
- [ ] Color contrast sufficient
- [ ] Alt text on images
- [ ] ARIA labels present
- [ ] Semantic HTML used

---

## Common Issues & Solutions

### Issue: Metric cards not aligned
**Solution**: Check grid classes - should be `grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4`

### Issue: Header text not visible
**Solution**: Ensure text is white and has proper contrast with gradient

### Issue: Sidebar not sticky
**Solution**: Add `sticky top-20` to sidebar container

### Issue: Buttons not responsive
**Solution**: Use `px-4 py-2` for small, `px-6 py-3` for large, adjust with `md:` breakpoint

### Issue: Cards not hovering
**Solution**: Add `hover:shadow-lg transition` classes

### Issue: Mobile layout broken
**Solution**: Check responsive classes - use `md:` and `lg:` prefixes

---

## Quick Start for New Pages

1. **Copy template**
   ```bash
   cp resources/views/employer/dashboard.blade.php resources/views/employer/new-page.blade.php
   ```

2. **Update header**
   - Change gradient color
   - Update icon
   - Update title and description

3. **Update metrics**
   - Change metric labels
   - Update icons
   - Update colors
   - Bind data

4. **Update content**
   - Replace sections
   - Add your content
   - Update data bindings

5. **Test**
   - Check all breakpoints
   - Verify data displays
   - Test interactions
   - Check accessibility

---

## Resources

- **Tailwind CSS**: https://tailwindcss.com/docs
- **Font Awesome**: https://fontawesome.com/icons
- **Laravel Blade**: https://laravel.com/docs/blade
- **Alpine.js**: https://alpinejs.dev/

---

## Support

For questions or issues:
1. Check the design system documentation
2. Review existing pages for patterns
3. Test on multiple devices
4. Validate HTML/CSS
5. Check browser console for errors

---

## Version History

- **v1.0** - Initial design system
  - Dashboard
  - Applications
  - Interviews
  - Messages
  - Notifications
  - Settings
  - All Employers

---

## Notes

- All pages use Tailwind CSS utility classes
- Responsive design is mobile-first
- Colors are consistent across pages
- Spacing follows a 4px grid system
- Animations are subtle and performant
- Accessibility is built-in
