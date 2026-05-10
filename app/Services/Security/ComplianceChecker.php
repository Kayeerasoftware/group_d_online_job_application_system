<?php

namespace App\Services\Security;

class ComplianceChecker
{
    public function flagSuspiciousTerms(string $content): bool
    {
        $terms = [
            'only male',
            'only female',
            'age <',
            'age less than',
            'young candidate',
            'married',
            'unmarried',
            'christian only',
            'muslim only',
        ];

        $haystack = strtolower($content);

        foreach ($terms as $term) {
            if (str_contains($haystack, $term)) {
                return true;
            }
        }

        return false;
    }
}
