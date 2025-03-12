<?php

namespace Database\Seeders;

use App\Models\ModerationReason;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ModerationReasonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $reasons = config('moderation.reasons');

        foreach ($reasons as $reason) {
            ModerationReason::create([
                'name' => $reason['name'],
            ]);
        }
    }
}
