@extends('layouts.jobseeker')

@section('content')
<div style="background: white; border-radius: 12px; box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1); padding: 24px;">
    <h1 style="font-size: 28px; font-weight: bold; color: #1f2937; margin-bottom: 8px;">Notifications</h1>
    <p style="color: #6b7280; margin-bottom: 24px;">Stay updated with your job search</p>
    <div style="border-left: 4px solid #2563eb; background: #eff6ff; padding: 16px; border-radius: 4px; margin-bottom: 12px;">
        <h3 style="font-weight: 600; color: #1f2937; margin-bottom: 4px;">New Job Match</h3>
        <p style="color: #6b7280; font-size: 14px;">A new job matching your profile has been posted</p>
        <p style="color: #9ca3af; font-size: 12px; margin-top: 8px;">2 hours ago</p>
    </div>
    <div style="border-left: 4px solid #16a34a; background: #f0fdf4; padding: 16px; border-radius: 4px;">
        <h3 style="font-weight: 600; color: #1f2937; margin-bottom: 4px;">Application Shortlisted</h3>
        <p style="color: #6b7280; font-size: 14px;">Your application for Senior Developer has been shortlisted</p>
        <p style="color: #9ca3af; font-size: 12px; margin-top: 8px;">1 day ago</p>
    </div>
</div>
@endsection
