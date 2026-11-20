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
                'strengths_km' => [
                    'មានព័ត៌មានទំនាក់ទំនងច្បាស់លាស់ និងប្រវត្តិការងារតាមលំដាប់ត្រឹមត្រូវ។',
                    'មានសញ្ញាបត្រវិទ្យាសាស្ត្រកុំព្យូទ័រពាក់ព័ន្ធពីសាកលវិទ្យាល័យភូមិន្ទភ្នំពេញ។',
                    'មានតួលេខបង្ហាញលទ្ធផលការងារជាក់លាក់ (ដោះស្រាយបញ្ហា 40+ ក្នុងមួយថ្ងៃ)។',
                ],
                'weaknesses_km' => [
                    'សេចក្តីសង្ខេបវិជ្ជាជីវៈនៅទូទៅពេក និងខ្វះចំណងជើងការងារគោលដៅ។',
                    'ចំណុចការងាររៀបរាប់តែភារកិច្ច មិនទាន់បង្ហាញលទ្ធផលសម្រេចបាន។',
                    'មានកំហុសវេយ្យាករណ៍ និងកាលៈទេសៈពាក្យតិចតួចក្នុងតួនាទីមុនៗ។',
                ],
                'suggestions_km' => [
                    'បន្ថែមសេចក្តីសង្ខេប ២ បន្ទាត់ដែលត្រូវនឹងតួនាទី Junior Backend Developer ឬ IT Support។',
                    'ចាប់ផ្តើមប្រយោគនីមួយៗដោយកិរិយាស័ព្ទសកម្ម (Built, Reduced, Automated)។',
                    'បែងចែកជំនាញបច្ចេកទេសជាក្រុម៖ Languages, Frameworks, និង Tools។',
                ],
                'improved_cv' => "NGOYTRY LYHUOR\nIT Support & Junior Developer\nPhnom Penh, Cambodia | ngoytry.lyhuor@demo-cv.kh | +855 12 889 412\n\nPROFESSIONAL SUMMARY\nDetail-oriented IT Graduate with 1+ year of experience in technical support and Laravel web development. Proven ability to resolve 40+ daily user tickets with 95% satisfaction.\n\nEXPERIENCE\nIT Support & Junior Developer — Phnom Penh Fintech Co. (2025 – Present)\n- Resolved 40+ daily hardware, network, and internal portal tickets.\n- Automated daily CSV reconciliation reports using PHP and SQL, saving 4 hours/week.\n\nEDUCATION\nB.Sc. in Computer Science — Royal University of Phnom Penh (2021 – 2025)",
                'translated_cv' => '',
                'structured_cv' => [
                    'full_name' => 'NGOYTRY LYHUOR',
                    'job_title' => 'IT Support & Junior Developer',
                    'email' => 'ngoytry.lyhuor@demo-cv.kh',
                    'phone' => '+855 12 889 412',
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
