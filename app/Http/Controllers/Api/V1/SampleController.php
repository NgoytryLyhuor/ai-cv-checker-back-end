<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class SampleController extends Controller
{
    public function show(): JsonResponse
    {
        return response()->json([
            'data' => [
                'token' => '00000000-0000-0000-0000-000000000000',
                'service' => 'full',
                'status' => 'COMPLETED',
                'score' => 78,
                'label' => 'Good',
                'strengths' => [
                    'Clear contact details and logical reverse-chronological work history.',
                    'Relevant degree in Computer Science from Royal University of Phnom Penh.',
                    'Includes measurable customer support metrics (handled 40+ tickets/day).',
                ],
                'weaknesses' => [
                    'Professional summary is too generic and lacks target job title.',
                    'Bullet points describe duties instead of outcomes and achievements.',
                    'Several minor grammar and tense inconsistencies in past roles.',
                ],
                'suggestions' => [
                    'Add a 2-line summary tailored to Junior Backend Developer or IT Support roles.',
                    'Start each bullet with strong action verbs (Built, Reduced, Automated).',
                    'Group technical skills into Languages, Frameworks, and Tools.',
                ],
                'improved_cv' => "SOKHA CHAN\nIT Support & Junior Developer\nPhnom Penh, Cambodia | sokha.chan@example.com | +855 12 345 678\n\nPROFESSIONAL SUMMARY\nDetail-oriented IT Graduate with 1+ year of experience in technical support and Laravel web development. Proven ability to resolve 40+ daily user tickets with 95% satisfaction.\n\nEXPERIENCE\nIT Support & Junior Developer — Phnom Penh Fintech Co. (2025 – Present)\n- Resolved 40+ daily hardware, network, and internal portal tickets.\n- Automated daily CSV reconciliation reports using PHP and SQL, saving 4 hours/week.\n\nEDUCATION\nB.Sc. in Computer Science — Royal University of Phnom Penh (2021 – 2025)",
                'translated_cv' => '',
                'structured_cv' => [
                    'full_name' => 'Sokha Chan',
                    'job_title' => 'IT Support & Junior Developer',
                    'email' => 'sokha.chan@example.com',
                    'phone' => '+855 12 345 678',
                    'location' => 'Phnom Penh, Cambodia',
                    'summary' => 'Detail-oriented IT Graduate with 1+ year of experience in technical support and Laravel web development. Proven ability to resolve 40+ daily user tickets with 95% user satisfaction.',
                    'experience' => [
                        [
                            'role' => 'IT Support & Junior Developer',
                            'company' => 'Phnom Penh Fintech Co.',
                            'period' => '2025 – Present',
                            'bullets' => [
                                'Resolved 40+ daily hardware, network, and internal portal support tickets.',
                                'Automated daily CSV reconciliation reports using PHP and SQL, saving 4 hours/week.',
                            ],
                        ],
                        [
                            'role' => 'IT Intern',
                            'company' => 'Cambodia Digital Solutions',
                            'period' => '2024 – 2025',
                            'bullets' => [
                                'Assisted senior engineers with testing REST APIs and documenting onboarding guides.',
                            ],
                        ],
                    ],
                    'education' => [
                        [
                            'degree' => 'B.Sc. in Computer Science',
                            'school' => 'Royal University of Phnom Penh',
                            'period' => '2021 – 2025',
                        ],
                    ],
                    'skills' => ['PHP', 'Laravel', 'Vue.js', 'TypeScript', 'SQL', 'Git', 'IT Support'],
                    'languages' => ['Khmer (Native)', 'English (Professional)'],
                ],
                'error_message' => null,
                'expires_at' => now()->addDays(7)->toIso8601ZuluString(),
                'created_at' => now()->toIso8601ZuluString(),
            ],
        ]);
    }
}
