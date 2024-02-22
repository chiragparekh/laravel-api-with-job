<?php

namespace App\Jobs;

use App\Events\SubmissionSaved;
use App\Models\Submission;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class ProcessSubmission implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        protected string $name,
        protected string $email,
        protected string $message,
    )
    {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        DB::transaction(function() {
            $submission = Submission::create([
                'name' => $this->name,
                'email' => $this->email,
                'message' => $this->message,
            ]);

            SubmissionSaved::dispatch($submission->id);
        });
    }
}
