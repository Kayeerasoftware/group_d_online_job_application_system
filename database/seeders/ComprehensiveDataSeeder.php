<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\JobSeekerProfile;
use App\Models\EmployerProfile;
use App\Models\Job;
use App\Models\Application;
use App\Models\SavedJob;
use App\Models\InterviewCommunication;
use App\Models\RegulatoryReport;
use App\Models\AuditLog;
use App\Enums\JobType;
use App\Enums\JobStatus;
use App\Enums\ApplicationStatus;
use App\Enums\ReportStatus;
use Illuminate\Database\Seeder;

class ComprehensiveDataSeeder extends Seeder
{
    public function run(): void
    {
        // Create comprehensive job seeker profiles
        $this->seedJobSeekerProfiles();

        // Create comprehensive employer profiles
        $this->seedEmployerProfiles();

        // Create jobs
        $this->seedJobs();

        // Create applications
        $this->seedApplications();

        // Create saved jobs
        $this->seedSavedJobs();

        // Create interview communications
        $this->seedInterviewCommunications();

        // Create regulatory reports
        $this->seedRegulatoryReports();

        // Create audit logs
        $this->seedAuditLogs();
    }

    private function seedJobSeekerProfiles(): void
    {
        $seekers = User::where('role', 'seeker')->get();

        $skills = [
            ['PHP', 'Laravel', 'MySQL', 'REST API', 'Git'],
            ['Python', 'Django', 'PostgreSQL', 'Docker', 'AWS'],
            ['JavaScript', 'React', 'Node.js', 'MongoDB', 'CSS'],
            ['Java', 'Spring Boot', 'Microservices', 'Kubernetes', 'CI/CD'],
            ['C#', '.NET', 'Azure', 'SQL Server', 'Entity Framework'],
            ['Go', 'Rust', 'System Design', 'Linux', 'Networking'],
            ['Data Science', 'Machine Learning', 'Python', 'TensorFlow', 'SQL'],
            ['DevOps', 'Kubernetes', 'Docker', 'Jenkins', 'Terraform'],
            ['UI/UX Design', 'Figma', 'Prototyping', 'User Research', 'Wireframing'],
            ['Project Management', 'Agile', 'Scrum', 'Leadership', 'Communication'],
        ];

        $jobTitles = [
            'Senior PHP Developer',
            'Full Stack Developer',
            'Frontend Developer',
            'Backend Developer',
            'DevOps Engineer',
            'Data Scientist',
            'UI/UX Designer',
            'Project Manager',
            'QA Engineer',
            'Systems Administrator',
        ];

        $educationLevels = ['High School', 'Diploma', 'Bachelor', 'Master', 'PhD'];
        $genders = ['Male', 'Female', 'Other'];
        $experienceLevels = ['Entry Level', 'Mid Level', 'Senior', 'Lead', 'Executive'];

        $locations = [
            'Kampala, Uganda',
            'Nairobi, Kenya',
            'Dar es Salaam, Tanzania',
            'Kigali, Rwanda',
            'Accra, Ghana',
            'Lagos, Nigeria',
            'Johannesburg, South Africa',
            'Addis Ababa, Ethiopia',
            'Lusaka, Zambia',
            'Harare, Zimbabwe',
        ];

        foreach ($seekers as $index => $seeker) {
            JobSeekerProfile::updateOrCreate(
                ['user_id' => $seeker->id],
                [
                    'date_of_birth' => now()->subYears(random_int(22, 55))->subDays(random_int(0, 365)),
                    'gender' => $genders[array_rand($genders)],
                    'location' => $locations[array_rand($locations)],
                    'education_level' => $educationLevels[array_rand($educationLevels)],
                    'years_experience' => random_int(0, 20),
                    'job_title' => $jobTitles[array_rand($jobTitles)],
                    'experience_level' => $experienceLevels[array_rand($experienceLevels)],
                    'bio' => 'Passionate professional with expertise in ' . implode(', ', array_slice($skills[$index % count($skills)], 0, 3)) . '. Seeking challenging opportunities to grow and contribute.',
                    'skills' => $skills[$index % count($skills)],
                    'notification_preferences' => [
                        'job_recommendations' => true,
                        'application_updates' => true,
                        'interview_reminders' => true,
                        'email_digest' => true,
                    ],
                ]
            );
        }
    }

    private function seedEmployerProfiles(): void
    {
        $employers = User::where('role', 'employer')->get();

        $companies = [
            [
                'name' => 'TechForge Solutions',
                'description' => 'Leading software development and digital transformation consultancy.',
                'website' => 'https://techforge.co.ug',
                'industry' => 'Software Development',
                'tax_id' => 'TAX-TECH-001',
            ],
            [
                'name' => 'Equity Bank Uganda',
                'description' => 'Premier financial services provider in East Africa.',
                'website' => 'https://equitybank.co.ug',
                'industry' => 'Banking & Finance',
                'tax_id' => 'TAX-BANK-001',
            ],
            [
                'name' => 'MTN Uganda',
                'description' => 'Leading telecommunications company in Uganda.',
                'website' => 'https://mtn.co.ug',
                'industry' => 'Telecommunications',
                'tax_id' => 'TAX-TELECOM-001',
            ],
            [
                'name' => 'Stanbic Bank Uganda',
                'description' => 'International banking services and solutions.',
                'website' => 'https://stanbic.co.ug',
                'industry' => 'Banking & Finance',
                'tax_id' => 'TAX-BANK-002',
            ],
            [
                'name' => 'Pearl Insurance',
                'description' => 'Comprehensive insurance solutions for individuals and businesses.',
                'website' => 'https://pearlinsurance.co.ug',
                'industry' => 'Insurance',
                'tax_id' => 'TAX-INS-001',
            ],
            [
                'name' => 'Airtel Uganda',
                'description' => 'Mobile and broadband services provider.',
                'website' => 'https://airtel.co.ug',
                'industry' => 'Telecommunications',
                'tax_id' => 'TAX-TELECOM-002',
            ],
            [
                'name' => 'Kampala International University',
                'description' => 'Leading private university in Uganda.',
                'website' => 'https://kiu.ac.ug',
                'industry' => 'Education',
                'tax_id' => 'TAX-EDU-001',
            ],
            [
                'name' => 'Uganda Revenue Authority',
                'description' => 'Government revenue collection agency.',
                'website' => 'https://ura.go.ug',
                'industry' => 'Government',
                'tax_id' => 'TAX-GOV-001',
            ],
            [
                'name' => 'Makerere University',
                'description' => 'Premier public university in Uganda.',
                'website' => 'https://mak.ac.ug',
                'industry' => 'Education',
                'tax_id' => 'TAX-EDU-002',
            ],
            [
                'name' => 'Kampala Capital City Authority',
                'description' => 'City administration and development.',
                'website' => 'https://kcca.go.ug',
                'industry' => 'Government',
                'tax_id' => 'TAX-GOV-002',
            ],
        ];

        foreach ($employers as $index => $employer) {
            $company = $companies[$index % count($companies)];
            EmployerProfile::updateOrCreate(
                ['user_id' => $employer->id],
                [
                    'company_name' => $company['name'],
                    'company_description' => $company['description'],
                    'company_website' => $company['website'],
                    'industry' => $company['industry'],
                    'tax_id' => $company['tax_id'],
                    'verified_by_admin' => true,
                    'verification_date' => now()->subDays(random_int(1, 90)),
                ]
            );
        }
    }

    private function seedJobs(): void
    {
        $employers = User::where('role', 'employer')->get();

        $jobTitles = [
            'Senior PHP Developer',
            'Full Stack Developer',
            'Frontend Developer',
            'Backend Developer',
            'DevOps Engineer',
            'Data Scientist',
            'UI/UX Designer',
            'Project Manager',
            'QA Engineer',
            'Systems Administrator',
            'Mobile Developer',
            'Cloud Architect',
            'Security Engineer',
            'Database Administrator',
            'Business Analyst',
        ];

        $descriptions = [
            'We are looking for an experienced developer to join our growing team. You will work on challenging projects and collaborate with talented professionals.',
            'Join our innovative team and help us build the future of technology. We offer competitive compensation and excellent benefits.',
            'Seeking a skilled professional to contribute to our mission of digital transformation. Great opportunity for career growth.',
            'Be part of a dynamic team working on cutting-edge solutions. We value creativity, collaboration, and continuous learning.',
            'Help us deliver world-class services to our clients. You will have the opportunity to work on diverse projects and expand your skills.',
        ];

        $requirements = [
            'Bachelor\'s degree in Computer Science or related field, 3+ years of experience, proficiency in relevant technologies, strong problem-solving skills',
            '5+ years of professional experience, proven track record of successful projects, excellent communication skills, team player mentality',
            'Master\'s degree preferred, 2+ years of experience, knowledge of industry best practices, ability to work independently and in teams',
            'Advanced degree in relevant field, 7+ years of experience, leadership experience, strategic thinking abilities',
            'High school diploma or equivalent, 1+ years of experience, willingness to learn, strong work ethic',
        ];

        $locations = [
            'Kampala, Uganda',
            'Nairobi, Kenya',
            'Dar es Salaam, Tanzania',
            'Kigali, Rwanda',
            'Accra, Ghana',
            'Remote',
            'Hybrid - Kampala',
            'Hybrid - Nairobi',
        ];

        $jobTypes = [JobType::FullTime, JobType::PartTime, JobType::Contract, JobType::Internship];
        $workArrangements = ['On-site', 'Remote', 'Hybrid'];
        $levels = ['Entry Level', 'Mid Level', 'Senior', 'Lead', 'Executive'];
        $categories = ['Technology', 'Finance', 'Healthcare', 'Education', 'Retail', 'Manufacturing', 'Government'];
        $statuses = [JobStatus::Open, JobStatus::Closed];

        foreach ($employers as $employer) {
            for ($i = 0; $i < random_int(2, 5); $i++) {
                Job::create([
                    'employer_id' => $employer->id,
                    'title' => $jobTitles[array_rand($jobTitles)],
                    'description' => $descriptions[array_rand($descriptions)],
                    'requirements' => $requirements[array_rand($requirements)],
                    'location' => $locations[array_rand($locations)],
                    'salary_min' => random_int(1000000, 3000000),
                    'salary_max' => random_int(3000000, 8000000),
                    'job_type' => $jobTypes[array_rand($jobTypes)],
                    'category' => $categories[array_rand($categories)],
                    'level' => $levels[array_rand($levels)],
                    'work_arrangement' => $workArrangements[array_rand($workArrangements)],
                    'deadline' => now()->addDays(random_int(7, 60)),
                    'status' => $statuses[array_rand($statuses)],
                    'views_count' => random_int(10, 500),
                ]);
            }
        }
    }

    private function seedApplications(): void
    {
        $jobs = Job::where('status', JobStatus::Open->value)->get();
        $seekers = User::where('role', 'seeker')->get();

        $statuses = [
            ApplicationStatus::Pending,
            ApplicationStatus::Reviewed,
            ApplicationStatus::Shortlisted,
            ApplicationStatus::Interview,
            ApplicationStatus::Rejected,
            ApplicationStatus::Hired,
        ];
        $interviewTypes = ['Phone', 'Video', 'In-person', 'Technical Test'];

        foreach ($jobs as $job) {
            $applicantCount = random_int(3, 10);
            $randomSeekers = $seekers->random(min($applicantCount, $seekers->count()));

            foreach ($randomSeekers as $seeker) {
                $status = $statuses[array_rand($statuses)];
                $isInterviewStatus = in_array($status, [ApplicationStatus::Interview, ApplicationStatus::Hired]);

                Application::updateOrCreate(
                    ['job_id' => $job->id, 'job_seeker_id' => $seeker->id],
                    [
                        'cover_letter' => 'I am very interested in this position. My skills and experience align well with the requirements. I am confident I can contribute significantly to your team.',
                        'status' => $status,
                        'applied_date' => now()->subDays(random_int(1, 30)),
                        'scheduled_date' => $isInterviewStatus ? now()->addDays(random_int(1, 14)) : null,
                        'employer_notes' => 'Promising candidate with relevant experience.',
                        'interview_type' => $isInterviewStatus ? $interviewTypes[array_rand($interviewTypes)] : null,
                        'interviewer_name' => $isInterviewStatus ? 'John Smith' : null,
                        'interview_link' => $isInterviewStatus ? 'https://meet.google.com/abc-defg-hij' : null,
                        'interview_notes' => $status === ApplicationStatus::Hired ? 'Excellent technical knowledge and communication skills.' : null,
                        'feedback' => $status === ApplicationStatus::Hired ? 'Strong candidate, recommended for next round.' : null,
                        'interview_outcome' => $status === ApplicationStatus::Hired ? 'passed' : null,
                        'interview_completed_at' => $status === ApplicationStatus::Hired ? now()->subDays(random_int(1, 7)) : null,
                    ]
                );
            }
        }
    }

    private function seedSavedJobs(): void
    {
        $jobs = Job::where('status', JobStatus::Open->value)->get();
        $seekers = User::where('role', 'seeker')->get();

        foreach ($seekers as $seeker) {
            $savedCount = random_int(2, 8);
            $randomJobs = $jobs->random(min($savedCount, $jobs->count()));

            foreach ($randomJobs as $job) {
                SavedJob::updateOrCreate(
                    ['job_seeker_id' => $seeker->id, 'job_id' => $job->id],
                    ['saved_date' => now()->subDays(random_int(1, 30))]
                );
            }
        }
    }

    private function seedInterviewCommunications(): void
    {
        $applications = Application::where('status', ApplicationStatus::Interview->value)
            ->orWhere('status', ApplicationStatus::Hired->value)
            ->get();

        $messages = [
            'Thank you for your interest in our position. We would like to schedule an interview with you.',
            'Your interview is scheduled for tomorrow at 2:00 PM. Please join via the provided link.',
            'We were impressed with your interview. We would like to move forward with the next stage.',
            'Thank you for your time. We will get back to you with our decision soon.',
            'Congratulations! We are pleased to offer you the position.',
            'Unfortunately, we have decided to move forward with other candidates.',
            'Can you confirm your availability for the interview?',
            'Please send us your updated CV and portfolio.',
        ];

        $messageTypes = ['text', 'email', 'notification'];

        foreach ($applications as $application) {
            for ($i = 0; $i < random_int(2, 5); $i++) {
                InterviewCommunication::create([
                    'application_id' => $application->id,
                    'sender_id' => $application->job->employer_id,
                    'receiver_id' => $application->job_seeker_id,
                    'message' => $messages[array_rand($messages)],
                    'message_type' => $messageTypes[array_rand($messageTypes)],
                    'metadata' => [
                        'subject' => 'Interview Communication',
                        'priority' => 'high',
                    ],
                    'read_at' => random_int(0, 1) ? now()->subDays(random_int(1, 5)) : null,
                ]);
            }
        }
    }

    private function seedRegulatoryReports(): void
    {
        $regulators = User::where('role', 'regulator')->get();

        $reportTypes = [
            'Monthly Activity Report',
            'Compliance Report',
            'User Statistics Report',
            'Job Posting Analysis',
            'Application Trends Report',
            'System Performance Report',
            'Security Audit Report',
            'Data Privacy Report',
        ];

        foreach ($regulators as $regulator) {
            for ($i = 0; $i < 3; $i++) {
                RegulatoryReport::create([
                    'report_type' => $reportTypes[array_rand($reportTypes)],
                    'generated_by' => $regulator->id,
                    'date_range_start' => now()->subMonths(1)->startOfMonth(),
                    'date_range_end' => now()->endOfMonth(),
                    'aggregated_data' => [
                        'total_users' => random_int(100, 1000),
                        'total_jobs' => random_int(50, 500),
                        'total_applications' => random_int(200, 2000),
                        'active_employers' => random_int(10, 100),
                        'active_seekers' => random_int(50, 500),
                        'successful_placements' => random_int(5, 50),
                    ],
                    'status' => ReportStatus::Submitted,
                    'notes' => 'Report generated for regulatory compliance and system monitoring.',
                ]);
            }
        }
    }

    private function seedAuditLogs(): void
    {
        $admins = User::where('role', 'admin')->get();

        $actions = [
            'user_created',
            'user_updated',
            'user_deleted',
            'job_posted',
            'job_closed',
            'application_reviewed',
            'application_rejected',
            'profile_verified',
            'profile_flagged',
            'report_generated',
            'system_setting_changed',
            'user_suspended',
            'user_activated',
        ];

        $targetTypes = ['User', 'Job', 'Application', 'EmployerProfile', 'JobSeekerProfile'];

        foreach ($admins as $admin) {
            for ($i = 0; $i < random_int(5, 15); $i++) {
                AuditLog::create([
                    'admin_id' => $admin->id,
                    'action' => $actions[array_rand($actions)],
                    'target_type' => $targetTypes[array_rand($targetTypes)],
                    'target_id' => random_int(1, 100),
                    'old_values' => [
                        'status' => 'pending',
                        'verified' => false,
                    ],
                    'new_values' => [
                        'status' => 'approved',
                        'verified' => true,
                    ],
                    'ip_address' => '192.168.' . random_int(0, 255) . '.' . random_int(0, 255),
                    'reason' => 'Routine verification and compliance check.',
                ]);
            }
        }
    }
}
