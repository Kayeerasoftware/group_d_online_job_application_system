<?php

namespace App\Observers;

use App\Models\Job;
use App\Models\Notification;
use App\Models\User;

class JobObserver
{
    public function created(Job $job): void
    {
        $seekers = User::where('role', 'seeker')->get();
        $jobType = $job->job_type instanceof \App\Enums\JobType ? $job->job_type->value : $job->job_type;

        foreach ($seekers as $seeker) {
            Notification::create([
                'user_id' => $seeker->id,
                'type' => 'job_match',
                'subject' => 'New Job Posted',
                'title' => 'New Job: ' . $job->title,
                'message' => "A new {$jobType} position has been posted: {$job->title} at {$job->location}",
                'action_url' => route('seeker.jobs.show', $job),
                'read_at' => null,
                'sent_at' => now(),
                'delivery_status' => 'sent',
            ]);
        }
    }
}
