<?php

namespace Tests\Feature\Http\Controllers;

use App\Events\SubmissionSaved;
use App\Models\Submission;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class SubmissionControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_gives_validation_errors_if_invalid_data_provided(): void
    {
        Event::fake([
            SubmissionSaved::class
        ]);

        $this->postJson('/api/submit')
            ->assertStatus(422)
            ->assertJsonValidationErrors([
                'name',
                'email',
                'message'
            ]);

        Event::assertNotDispatched(SubmissionSaved::class);
    }

    public function test_it_creates_the_submission_in_database(): void
    {
        Event::fake([
            SubmissionSaved::class
        ]);

        $data = [
            'name' => 'Test Submission',
            'email' => 'john@doe.com',
            'message' => 'Test submission message.'
        ];

        $this->assertCount(0, Submission::get());

        $this->postJson('/api/submit', $data)
            ->assertSuccessful();

        $submissions = Submission::get();

        $this->assertCount(1, $submissions);
        $this->assertEquals($data['name'], $submissions->first()->name);
        $this->assertEquals($data['email'], $submissions->first()->email);
        $this->assertEquals($data['message'], $submissions->first()->message);
        Event::assertDispatched(SubmissionSaved::class);
    }
}
