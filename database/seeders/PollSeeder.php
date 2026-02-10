<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Poll;

class PollSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Poll::create([
          'label' => 'test poll',
          'ends_at' => '2026-02-10 23:59:00'
        ]);

        Poll::create([
          'label' => 'test poll 2',
          'ends_at' => '2026-01-08 23:59:00'
        ]);

        Poll::create([
          'label' => 'test poll 3',
          'ends_at' => '2026-01-12 23:59:00'
        ]);

        Poll::create([
          'label' => 'test poll 4',
          'ends_at' => '2026-01-24 23:59:00'
        ]);
    }
}
