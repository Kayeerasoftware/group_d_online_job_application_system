<?php

namespace Database\Seeders;

use App\Models\Application;
use App\Models\JobListing;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Demo employer
        $employer = User::create([
            'name'     => 'Acme Corp HR',
            'email'    => 'employer@demo.com',
            'password' => Hash::make('password'),
            'role'     => 'employer',
        ]);

        // Demo applicant
        $applicant = User::create([
            'name'     => 'John Doe',
            'email'    => 'applicant@demo.com',
            'password' => Hash::make('password'),
            'role'     => 'applicant',
        ]);

        $jobs = [
            ['title' => 'Software Engineer', 'company_name' => 'Acme Corp', 'location' => 'Kampala, Uganda', 'salary' => 3500000, 'job_type' => 'full-time', 'description' => "We are looking for a skilled Software Engineer to join our team.\n\nResponsibilities:\n- Design and develop software solutions\n- Collaborate with cross-functional teams\n- Write clean, maintainable code\n\nRequirements:\n- Bachelor's degree in Computer Science\n- 2+ years experience in PHP/Laravel\n- Strong problem-solving skills"],
            ['title' => 'UI/UX Designer', 'company_name' => 'Creative Studio', 'location' => 'Entebbe, Uganda', 'salary' => 2800000, 'job_type' => 'full-time', 'description' => "Join our creative team as a UI/UX Designer.\n\nResponsibilities:\n- Create wireframes and prototypes\n- Conduct user research\n- Design intuitive interfaces\n\nRequirements:\n- Portfolio of design work\n- Proficiency in Figma/Adobe XD\n- 1+ years experience"],
            ['title' => 'Data Analyst', 'company_name' => 'DataTech Uganda', 'location' => 'Kampala, Uganda', 'salary' => 3000000, 'job_type' => 'full-time', 'description' => "We need a Data Analyst to help us make data-driven decisions.\n\nResponsibilities:\n- Analyze large datasets\n- Create reports and dashboards\n- Identify trends and insights\n\nRequirements:\n- Proficiency in SQL and Python\n- Experience with Power BI or Tableau\n- Strong analytical skills"],
            ['title' => 'Remote Web Developer', 'company_name' => 'Global Tech', 'location' => 'Remote', 'salary' => 4000000, 'job_type' => 'remote', 'description' => "Work from anywhere as a Web Developer.\n\nResponsibilities:\n- Build and maintain web applications\n- Optimize performance\n- Participate in code reviews\n\nRequirements:\n- Strong JavaScript/React skills\n- Experience with REST APIs\n- Good communication skills"],
            ['title' => 'Marketing Assistant', 'company_name' => 'BrandUg', 'location' => 'Jinja, Uganda', 'salary' => 1500000, 'job_type' => 'part-time', 'description' => "Part-time marketing role for a growing brand.\n\nResponsibilities:\n- Manage social media accounts\n- Create marketing content\n- Support campaigns\n\nRequirements:\n- Degree in Marketing or related field\n- Social media savvy\n- Creative mindset"],
            ['title' => 'IT Support Specialist', 'company_name' => 'TechSupport Ltd', 'location' => 'Kampala, Uganda', 'salary' => 2000000, 'job_type' => 'contract', 'description' => "6-month contract for IT Support.\n\nResponsibilities:\n- Provide technical support to staff\n- Maintain hardware and software\n- Document issues and resolutions\n\nRequirements:\n- CompTIA A+ or equivalent\n- Experience with Windows/Linux\n- Good communication skills"],
        ];

        foreach ($jobs as $jobData) {
            JobListing::create($jobData + ['user_id' => $employer->id, 'deadline' => now()->addDays(rand(10, 60))]);
        }

        // Demo application
        Application::create([
            'job_id'       => JobListing::first()->id,
            'user_id'      => $applicant->id,
            'cv_path'      => 'cvs/demo-cv.pdf',
            'cover_letter' => 'I am very interested in this position and believe my skills are a great match.',
            'status'       => 'reviewed',
        ]);
    }
}
