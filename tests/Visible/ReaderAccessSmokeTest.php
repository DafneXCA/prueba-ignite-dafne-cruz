<?php

namespace Tests\Visible;

use App\Models\Title;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ReaderAccessSmokeTest extends TestCase
{
    use RefreshDatabase;

    public function test_public_title_can_be_opened_without_authentication(): void
    {
        $title = Title::query()->create([
            'name' => 'Título público de demostración',
            'requires_sso' => false,
        ]);

        $response = $this->getJson("/api/reader/{$title->id}");

        $response
            ->assertOk()
            ->assertExactJson([
                'code' => 'READER_ACCESS_GRANTED',
                'data' => [
                    'title_id' => $title->id,
                    'title_name' => 'Título público de demostración',
                ],
            ]);
    }
}
