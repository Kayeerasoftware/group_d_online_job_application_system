<?php

namespace Database\Factories;

use App\Models\RegulatoryReport;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<RegulatoryReport>
 */
class RegulatoryReportFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'report_type' => 'Hiring by Industry',
            'generated_by' => \App\Models\User::factory(),
            'date_range_start' => now()->subMonths(3)->startOfMonth(),
            'date_range_end' => now()->endOfMonth(),
            'aggregated_data' => ['jobs' => 10, 'applications' => 40],
            'status' => 'draft',
            'notes' => null,
        ];
    }
}
