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
                'score' => 72,
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
                'improved_cv' => "SOKHA CHAN\nPhnom Penh, Cambodia | sokha.chan@example.com | +855 12 345 678\n\nPROFESSIONAL SUMMARY\nDetail-oriented IT Graduate with 1+ year of experience in technical support and Laravel web development. Proven ability to resolve 40+ daily user tickets with 95% satisfaction.\n\nEXPERIENCE\nIT Support & Junior Developer — Phnom Penh Fintech Co. (2025 – Present)\n- Resolved 40+ daily hardware, network, and internal portal tickets.\n- Automated daily CSV reconciliation reports using PHP and SQL, saving 4 hours/week.\n\nEDUCATION\nB.Sc. in Computer Science — Royal University of Phnom Penh (2021 – 2025)",
                'translated_cv' => "សុខា ចាន់\nភ្នំពេញ កម្ពុជា | sokha.chan@example.com | +855 12 345 678\n\nសេចក្តីសង្ខេបវិជ្ជាជីវៈ\nនិស្សិតបញ្ចប់ការសិក្សាផ្នែកព័ត៌មានវិទ្យា ដែលមានបទពិសោធន៍ជាង ១ ឆ្នាំក្នុងការគាំទ្របច្ចេកទេស និងការអភិវឌ្ឍគេហទំព័រ Laravel។\n\nបទពិសោធន៍ការងារ\nអ្នកគាំទ្របច្ចេកទេស និងអ្នកអភិវឌ្ឍន៍កម្រិតដំបូង — Phnom Penh Fintech Co. (២០២៥ – បច្ចុប្បន្ន)\n- ដោះស្រាយបញ្ហាបច្ចេកទេសជាង ៤០ ករណីក្នុងមួយថ្ងៃ ដោយទទួលបានការពេញចិត្ត ៩៥%។\n- បង្កើតប្រព័ន្ធរបាយការណ៍ស្វ័យប្រវត្តិដោយប្រើ PHP និង SQL ជួយសន្សំពេល ៤ ម៉ោងក្នុងមួយសប្តាហ៍។",
                'error_message' => null,
                'expires_at' => now()->addDays(7)->toIso8601ZuluString(),
                'created_at' => now()->toIso8601ZuluString(),
            ],
        ]);
    }
}
